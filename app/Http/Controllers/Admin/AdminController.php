<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\ActivityLog;
use App\Models\Krs;

class AdminController extends Controller
{
    public function dashboard()
    {
        // General Stats
        $stats = [
            'total_mahasiswa' => Mahasiswa::count(),
            'total_dosen' => Dosen::count(),
            'total_prodi' => Prodi::count(),
            'total_kelas' => Kelas::count(),
            
            // System Stats
            'mahasiswa_aktif' => Mahasiswa::where('status', 'Aktif')->count(),
            'kelas_dibuka' => Kelas::count(), // Assuming all classes are open for now
            'krs_disetujui' => Krs::where('status', 'Disetujui')->count(),
            
            // Pending Items
            'pending_accounts' => Mahasiswa::whereDoesntHave('user')->count(),
        ];

        // Recent Registrations (Mahasiswa Pending Activation)
        $pendingRegistrations = Mahasiswa::whereDoesntHave('user')
            ->with(['prodi'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Recent Activities
        $recentActivities = ActivityLog::with('user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboardAdmin', compact('stats', 'pendingRegistrations', 'recentActivities'));
    }

    // --- DOSEN MANAGEMENT ---
    public function indexDosen()
    {
        $dosens = Dosen::with('prodi', 'user')->get();
        $prodis = Prodi::all();
        
        $stats = [
            'total' => Dosen::count(),
            'aktif' => Dosen::where('status_dosen', 'Aktif')->count(),
            'tetap' => Dosen::where('status_kepegawaian', 'Dosen Tetap')->count(),
            'profesor' => Dosen::where('jabatan', 'Profesor')->count(),
        ];

        return view('admin.dosen.index', compact('dosens', 'prodis', 'stats'));
    }

    public function storeDosen(Request $request)
    {
        $request->validate([
            'nidn' => 'required|unique:dosen,nip',
            'nama' => 'required|string|max:150',
            'prodi_id' => 'required|exists:prodi,prodi_id',
            'email' => 'nullable|email|unique:users,email', // Optional manual email
            'nik' => 'nullable|numeric',
            'jenis_kelamin' => 'required|in:L,P',
            'no_telp' => 'required|numeric',
        ]);

        // Generate Email
        // 1. Remove Rear Titles (text after first comma)
        $nameParts = explode(',', $request->nama);
        $nameWithoutDegree = trim($nameParts[0]);

        // 2. Remove Front Titles (Prof., Dr., etc.)
        $frontTitles = [
            'Prof\.?', 'Dr\.?', 'Ir\.?', 'Drs\.?', 'Dra\.?', 
            'H\.?', 'Hj\.?', 'Ns\.?', 'Apt\.?', 'dr\.?', 'S\.?'
        ];
        $pattern = '/\b(' . implode('|', $frontTitles) . ')\b/i';
        $cleanName = preg_replace($pattern, '', $nameWithoutDegree);

        // 3. Cleanup special chars & extra spaces
        $cleanName = preg_replace('/[^a-zA-Z\s]/', '', $cleanName);
        $names = explode(' ', preg_replace('/\s+/', ' ', trim($cleanName)));

        // 4. Formulate Base User
        $firstName = strtolower($names[0] ?? 'user');
        $lastName = count($names) > 1 ? strtolower(end($names)) : '';
        $baseEmail = $firstName . ($lastName ? '.' . $lastName : '');
        $loginEmail = $baseEmail . '@wbi.ac.id';
        
        // Handle Email Duplicates
        $counter = 1;
        while (User::where('email', $loginEmail)->exists()) {
            $loginEmail = $baseEmail . $counter . '@wbi.ac.id';
            $counter++;
        }

        $defaultPassword = '12345678';

        DB::transaction(function () use ($request, $loginEmail, $defaultPassword) {
            $user = User::create([
                'name' => $request->nama,
                'email' => $loginEmail,
                'password' => Hash::make($defaultPassword),
                'role' => 'dosen',
            ]);

            Dosen::create([
                'user_id' => $user->id,
                'nip' => $request->nidn, // Map NIDN input to NIP column
                'nama' => $request->nama,
                'nik' => $request->nik,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $request->tanggal_lahir,
                'tempat_lahir' => $request->tempat_lahir,
                'alamat_detail' => $request->alamat,
                'no_hp' => $request->no_telp,
                'bidang_keahlian' => $request->bidang_keahlian,
                'sinta_id' => $request->sinta_id,
                'status_kepegawaian' => $request->status_kepegawaian,
                'status_dosen' => $request->status_dosen,
                'tanggal_mulai' => $request->tanggal_mulai,
                'no_sertifikat' => $request->no_sertifikat,
                'prodi_id' => $request->prodi_id,
                'jabatan' => $request->jabatan,
                // Education
                's1_univ' => $request->s1_univ, 's1_prodi' => $request->s1_prodi, 's1_tahun' => $request->s1_tahun, 's1_gelar' => $request->s1_gelar,
                's2_univ' => $request->s2_univ, 's2_prodi' => $request->s2_prodi, 's2_tahun' => $request->s2_tahun, 's2_gelar' => $request->s2_gelar,
                's3_univ' => $request->s3_univ, 's3_prodi' => $request->s3_prodi, 's3_tahun' => $request->s3_tahun, 's3_gelar' => $request->s3_gelar,
            ]);
        });

        return redirect()->back()->with('success', 'Dosen berhasil ditambahkan')->with('credentials', [
            'email' => $loginEmail,
            'password' => $defaultPassword,
            'name' => $request->nama
        ]);
    }

    public function updateDosen(Request $request, $id)
    {
        $dosen = Dosen::findOrFail($id);
        
        $request->validate([
            'nidn' => 'required|unique:dosen,nip,'.$id.',dosen_id',
            'nama' => 'required|string|max:150',
            'prodi_id' => 'required|exists:prodi,prodi_id',
        ]);

        DB::transaction(function () use ($request, $dosen) {
            $dosen->update([
                'nip' => $request->nidn,
                'nama' => $request->nama,
                'nik' => $request->nik,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $request->tanggal_lahir,
                'tempat_lahir' => $request->tempat_lahir,
                'alamat_detail' => $request->alamat,
                'no_hp' => $request->no_telp,
                'bidang_keahlian' => $request->bidang_keahlian,
                'sinta_id' => $request->sinta_id,
                'status_kepegawaian' => $request->status_kepegawaian,
                'status_dosen' => $request->status_dosen,
                'tanggal_mulai' => $request->tanggal_mulai,
                'no_sertifikat' => $request->no_sertifikat,
                'prodi_id' => $request->prodi_id,
                'jabatan' => $request->jabatan,
                // Education
                's1_univ' => $request->s1_univ, 's1_prodi' => $request->s1_prodi, 's1_tahun' => $request->s1_tahun, 's1_gelar' => $request->s1_gelar,
                's2_univ' => $request->s2_univ, 's2_prodi' => $request->s2_prodi, 's2_tahun' => $request->s2_tahun, 's2_gelar' => $request->s2_gelar,
                's3_univ' => $request->s3_univ, 's3_prodi' => $request->s3_prodi, 's3_tahun' => $request->s3_tahun, 's3_gelar' => $request->s3_gelar,
            ]);

            $dosen->user->update([
                'name' => $request->nama,
            ]);

            if ($request->password) {
                $dosen->user->update([
                    'password' => Hash::make($request->password),
                ]);
            }
        });

        return redirect()->back()->with('success', 'Data dosen berhasil diupdate');
    }

    public function destroyDosen($id)
    {
        $dosen = Dosen::findOrFail($id);
        $user = $dosen->user;
        
        $dosen->delete();
        $user->delete();

        return redirect()->back()->with('success', 'Dosen berhasil dihapus');
    }

    // --- MAHASISWA MANAGEMENT ---
    public function indexMahasiswa(Request $request)
    {
        $query = Mahasiswa::with('prodi', 'user');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('npm', 'like', "%{$search}%");
            });
        }

        if ($request->filled('prodi')) {
            $query->whereHas('prodi', function($q) use ($request) {
                $q->where('nama_prodi', $request->prodi);
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $mahasiswas = $query->get();
        
        $stats = [
            'total' => Mahasiswa::count(),
            'aktif' => Mahasiswa::where('status', 'Aktif')->count(),
            'cuti' => Mahasiswa::where('status', 'Cuti')->count(),
            'non_aktif' => Mahasiswa::where('status', 'Non-Aktif')->count(),
        ];

        $prodis = Prodi::all();

        return view('admin.mahasiswa.mahasiswa', compact('mahasiswas', 'stats', 'prodis'));
    }

    public function createMahasiswa()
    {
        $prodis = Prodi::all();
        $dosens = Dosen::all();
        return view('admin.mahasiswa.form', compact('prodis', 'dosens'));
    }

    public function storeMahasiswa(Request $request)
    {
        $request->validate([
            'npm' => 'required|unique:mahasiswa,npm',
            'nama' => 'required|string|max:150',
            'email' => 'required|email',
            'prodi_id' => 'required|exists:prodi,prodi_id',
            'angkatan' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        // Format email: nim@wbi.ac.id
        $loginEmail = $request->npm . '@wbi.ac.id';
        $defaultPassword = '12345678';

        // Check if login email already exists in users table
        if (User::where('email', $loginEmail)->exists()) {
            return redirect()->back()->withErrors(['npm' => 'Akun login ' . $loginEmail . ' sudah terdaftar.'])->withInput();
        }

        DB::transaction(function () use ($request, $loginEmail, $defaultPassword) {
            $user = User::create([
                'name' => $request->nama,
                'email' => $loginEmail,
                'password' => Hash::make($defaultPassword),
                'role' => 'mahasiswa',
            ]);

            Mahasiswa::create([
                'user_id' => $user->id,
                'npm' => $request->npm,
                'nama' => $request->nama,
                'nik' => $request->nik,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'agama' => $request->agama,
                'kewarganegaraan' => $request->kewarganegaraan ?? 'Indonesia',
                'no_hp' => $request->no_telp,
                'email_pribadi' => $request->email,
                'nama_ayah' => $request->nama_ayah,
                'nama_ibu' => $request->nama_ibu,
                'alamat_detail' => $request->alamat,
                'prodi_id' => $request->prodi_id,
                'angkatan' => $request->angkatan,
                'dosen_wali_id' => $request->dosen_wali_id,
                'semester_sekarang' => 1,
                // Extra fields from form
                'no_hp_ortu' => $request->telp_wali,
                'status_beasiswa' => $request->status_beasiswa,
                'ukt_nominal' => $request->ukt_nominal,
            ]);
        });

        return redirect()->route('admin.mahasiswa.mahasiswa')->with('success', 'Mahasiswa berhasil ditambahkan')->with('credentials', [
            'email' => $loginEmail,
            'password' => $defaultPassword,
            'name' => $request->nama
        ]);
    }

    public function editMahasiswa($id)
    {
        $mahasiswa = Mahasiswa::with('user')->findOrFail($id);
        $prodis = Prodi::all();
        $dosens = Dosen::all();
        return view('admin.mahasiswa.form', compact('mahasiswa', 'prodis', 'dosens'));
    }

    public function updateMahasiswa(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        
        $request->validate([
            'npm' => 'required|unique:mahasiswa,npm,'.$id.',mahasiswa_id',
            'nama' => 'required|string|max:150',
            'prodi_id' => 'required|exists:prodi,prodi_id',
            'angkatan' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        DB::transaction(function () use ($request, $mahasiswa) {
            $mahasiswa->update([
                'npm' => $request->npm,
                'nama' => $request->nama,
                'nik' => $request->nik,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'agama' => $request->agama,
                'kewarganegaraan' => $request->kewarganegaraan,
                'no_hp' => $request->no_telp,
                'email_pribadi' => $request->email,
                'nama_ayah' => $request->nama_ayah,
                'nama_ibu' => $request->nama_ibu,
                'alamat_detail' => $request->alamat,
                'prodi_id' => $request->prodi_id,
                'angkatan' => $request->angkatan,
                'dosen_wali_id' => $request->dosen_wali_id,
                'no_hp_ortu' => $request->telp_wali,
            ]);

            if ($mahasiswa->user) {
                $mahasiswa->user->update([
                    'name' => $request->nama,
                ]);

                if ($request->password) {
                    $mahasiswa->user->update([
                        'password' => Hash::make($request->password),
                    ]);
                }
            }
        });

        return redirect()->route('admin.mahasiswa.mahasiswa')->with('success', 'Data mahasiswa berhasil diupdate');
    }

    public function destroyMahasiswa($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $user = $mahasiswa->user;

        DB::transaction(function () use ($mahasiswa, $user) {
            $mahasiswa->delete();
            if ($user) $user->delete();
        });

        return redirect()->back()->with('success', 'Mahasiswa berhasil dihapus');
    }

    public function indexAktivasiAkun(Request $request)
    {
        $query = Mahasiswa::whereDoesntHave('user')->with('prodi');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('npm', 'like', "%{$search}%");
            });
        }

        if ($request->filled('prodi')) {
            $query->whereHas('prodi', function($q) use ($request) {
                $q->where('nama_prodi', $request->prodi);
            });
        }

        $mahasiswas = $query->paginate(10);
        
        $stats = [
            'pending' => Mahasiswa::whereDoesntHave('user')->count(),
            'active' => Mahasiswa::whereHas('user')->where('status', 'Aktif')->count(),
            'inactive' => Mahasiswa::whereHas('user')->where('status', 'Non-Aktif')->count(),
            'total' => Mahasiswa::count(),
        ];

        $prodis = Prodi::all();

        return view('admin.mahasiswa.aktivasiAkun', compact('mahasiswas', 'stats', 'prodis'));
    }

    public function generateAkun(Request $request)
    {
        $mahasiswa = Mahasiswa::where('npm', $request->nim)->firstOrFail();
        
        if ($mahasiswa->user_id) {
            return back()->with('error', 'Mahasiswa ini sudah memiliki akun.');
        }

        // Generate Password
        $password = Str::random(8);
        
        // Create User
        $user = User::create([
            'name' => $mahasiswa->nama,
            'email' => $mahasiswa->email_pribadi ?? $mahasiswa->npm . '@student.wbi.ac.id', // Fallback email
            'password' => Hash::make($password),
            'role' => 'mahasiswa',
        ]);

        // Link User to Mahasiswa
        $mahasiswa->update(['user_id' => $user->id]);

        return back()->with('success', 'Akun berhasil digenerate')->with('credentials', [
            'username' => $mahasiswa->npm,
            'password' => $password,
            'email' => $user->email
        ]);
    }

    // --- AKADEMIK STAFF MANAGEMENT ---
    public function indexAkademikStaff()
    {
        $staffs = User::where('role', 'akademik')->get();
        return view('admin.akademik_staff.index', compact('staffs'));
    }

    public function storeAkademikStaff(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:150',
        ]);

        // Format email: namadepan.namabelang@wbi.ac.id
        $names = explode(' ', preg_replace('/\s+/', ' ', trim($request->nama)));
        $firstName = strtolower($names[0] ?? 'staff');
        $lastName = count($names) > 1 ? strtolower(end($names)) : '';
        $emailName = $firstName . ($lastName ? '.' . $lastName : '');
        $loginEmail = $emailName . '@wbi.ac.id';
        $defaultPassword = '12345678';

        if (User::where('email', $loginEmail)->exists()) {
            return redirect()->back()->withErrors(['nama' => 'Akun login ' . $loginEmail . ' sudah terdaftar.'])->withInput();
        }

        User::create([
            'name' => $request->nama,
            'email' => $loginEmail,
            'password' => Hash::make($defaultPassword),
            'role' => 'akademik',
        ]);

        return redirect()->back()->with('success', 'Staf Akademik berhasil ditambahkan')->with('credentials', [
            'email' => $loginEmail,
            'password' => $defaultPassword,
            'name' => $request->nama
        ]);
    }

    public function updateAkademikStaff(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'nama' => 'required|string|max:150',
            'email' => 'required|email|unique:users,email,'.$id,
        ]);

        $user->update([
            'name' => $request->nama,
            'email' => $request->email,
        ]);

        if ($request->password) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->back()->with('success', 'Data staf akademik berhasil diupdate');
    }

    public function destroyAkademikStaff($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'Staf Akademik berhasil dihapus');
    }
}
