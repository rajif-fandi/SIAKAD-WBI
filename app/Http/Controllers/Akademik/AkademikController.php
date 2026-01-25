<?php

namespace App\Http\Controllers\Akademik;

use App\Http\Controllers\Controller;
use App\Models\Matakuliah;
use App\Models\Kurikulum;
use App\Models\Kelas;
use App\Models\Jadwal;
use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\Mahasiswa;
use App\Models\ActivityLog;
use App\Models\SemesterAjaran;
use App\Models\DosenPengampu;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AkademikController extends Controller
{
    // --- RUANGAN ---
    public function indexRuangan(Request $request)
    {
        $query = Ruangan::query();
        if ($request->search) {
            $query->where('nama_ruangan', 'like', "%{$request->search}%")
                  ->orWhere('kode_ruangan', 'like', "%{$request->search}%");
        }
        $ruangans = $query->paginate(10)->withQueryString();
        return view('akademik.ruangan.index', compact('ruangans'));
    }

    public function storeRuangan(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|unique:ruangan,kode_ruangan',
            'nama' => 'required|string',
            'kapasitas' => 'required|integer|min:1',
            'lokasi' => 'nullable|string',
            'status' => 'required|in:Tersedia,Perbaikan,Tidak Aktif'
        ]);

        $r = Ruangan::create([
            'kode_ruangan' => $validated['kode'],
            'nama_ruangan' => $validated['nama'],
            'kapasitas' => $validated['kapasitas'],
            'lokasi' => $validated['lokasi'],
            'status' => $validated['status']
        ]);

        $this->logActivity('CREATE', 'Ruangan', $r->ruangan_id, "Menambahkan ruangan baru: {$r->nama_ruangan}");
        return redirect()->back()->with('success', 'Ruangan berhasil ditambahkan');
    }

    public function updateRuangan(Request $request, $id)
    {
        $r = Ruangan::findOrFail($id);
        $validated = $request->validate([
            'kode' => 'required|unique:ruangan,kode_ruangan,'.$id.',ruangan_id',
            'nama' => 'required|string',
            'kapasitas' => 'required|integer|min:1',
            'lokasi' => 'nullable|string',
            'status' => 'required|in:Tersedia,Perbaikan,Tidak Aktif'
        ]);

        $r->update([
            'kode_ruangan' => $validated['kode'],
            'nama_ruangan' => $validated['nama'],
            'kapasitas' => $validated['kapasitas'],
            'lokasi' => $validated['lokasi'],
            'status' => $validated['status']
        ]);

        $this->logActivity('UPDATE', 'Ruangan', $id, "Memperbarui ruangan: {$r->nama_ruangan}");
        return redirect()->back()->with('success', 'Ruangan berhasil diperbarui');
    }

    public function destroyRuangan($id)
    {
        $r = Ruangan::findOrFail($id);
        $name = $r->nama_ruangan;
        $r->delete();
        $this->logActivity('DELETE', 'Ruangan', $id, "Menghapus ruangan: {$name}");
        return redirect()->back()->with('success', 'Ruangan berhasil dihapus');
    }

    private function hasConflict($hari, $jam_mulai, $jam_selesai, $ruangan_id, $dosen_id, $ignoreJadwalId = null)
    {
        return Jadwal::where('hari', $hari)
            ->where(function ($query) use ($jam_mulai, $jam_selesai) {
                $query->where('jam_mulai', '<', $jam_selesai)
                      ->where('jam_selesai', '>', $jam_mulai);
            })
            ->when($ignoreJadwalId, function ($query) use ($ignoreJadwalId) {
                return $query->where('jadwal_id', '!=', $ignoreJadwalId);
            })
            ->where(function ($query) use ($ruangan_id, $dosen_id) {
                $query->where('ruangan_id', $ruangan_id);
                if ($dosen_id) {
                    $query->orWhereHas('kelas.dosen', function($q) use ($dosen_id) {
                        $q->where('dosen_id', $dosen_id);
                    });
                }
            })
            ->first();
    }

    private function logActivity($action, $entityType, $entityId, $description)
    {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'entity_type' => $entityType,
            'entity_id' => $entityId,
            'description' => $description,
            'ip_address' => request()->ip()
        ]);
    }

    public function indexProdi(Request $request)
    {
        $query = Prodi::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_prodi', 'like', "%$search%")
                  ->orWhere('kode_prodi', 'like', "%$search%");
            });
        }

        $prodis = $query->paginate(10)->withQueryString();
        return view('akademik.prodi.index', compact('prodis'));
    }

    public function storeProdi(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|string|unique:prodi,kode_prodi',
            'nama' => 'required|string',
            'jenjang' => 'required|string',
        ]);

        $prodi = Prodi::create([
            'kode_prodi' => $validated['kode'],
            'nama_prodi' => $validated['nama'],
            'jenjang' => $validated['jenjang'],
        ]);

        $this->logActivity('CREATE', 'Prodi', $prodi->prodi_id, "Menambahkan Program Studi: {$prodi->nama_prodi}");

        return redirect()->back()->with('success', 'Program Studi berhasil ditambahkan');
    }

    public function updateProdi(Request $request, $id)
    {
        $prodi = Prodi::findOrFail($id);
        $validated = $request->validate([
            'kode' => 'required|string|unique:prodi,kode_prodi,'.$id.',prodi_id',
            'nama' => 'required|string',
            'jenjang' => 'required|string',
        ]);

        $prodi->update([
            'kode_prodi' => $validated['kode'],
            'nama_prodi' => $validated['nama'],
            'jenjang' => $validated['jenjang'],
        ]);

        $this->logActivity('UPDATE', 'Prodi', $id, "Memperbarui Program Studi: {$prodi->nama_prodi}");

        return redirect()->back()->with('success', 'Program Studi berhasil diperbarui');
    }

    public function destroyProdi($id)
    {
        $prodi = Prodi::findOrFail($id);
        $name = $prodi->nama_prodi;
        $prodi->delete();
        $this->logActivity('DELETE', 'Prodi', $id, "Menghapus Program Studi: {$name}");
        return redirect()->back()->with('success', 'Program Studi berhasil dihapus');
    }

    public function dashboard()
    {
        $stats = [
            'total_matakuliah' => Matakuliah::count(),
            'total_kurikulum' => Kurikulum::count(),
            'total_kelas' => Kelas::count(),
            'total_dosen' => Dosen::count(),
            'total_mahasiswa' => Mahasiswa::count(),
            'total_prodi' => Prodi::count(),
            'active_semester' => SemesterAjaran::where('is_active', true)->first(),
        ];

        // Advanced Stats for Dashboard
        $stats['mk_wajib'] = Matakuliah::where('status', 'Wajib')->count();
        $stats['mk_pilihan'] = Matakuliah::where('status', 'Pilihan')->count();
        $stats['total_sks'] = Matakuliah::sum('sks');
        $stats['kurikulum_aktif'] = Kurikulum::where('status', 'Aktif')->count();

        $recentActivities = ActivityLog::with('user')->latest()->take(5)->get();

        return view('akademik.dashboardAkademik', compact('stats', 'recentActivities'));
    }

    // --- MATAKULIAH ---
    public function indexMatakuliah(Request $request)
    {
        $query = Matakuliah::with('prodi');

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('kode_mk', 'like', '%' . $request->search . '%')
                  ->orWhere('nama_mk', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->prodi_id) {
            $query->where('prodi_id', $request->prodi_id);
        }

        if ($request->semester) {
            $query->where('semester_paket', $request->semester);
        }

        if ($request->jenis) {
            $query->where('jenis', $request->jenis);
        }

        $matakuliah = $query->paginate(10)->withQueryString();
        $prodis = Prodi::all();

        // Specific Stats
        $stats = [
            'total' => Matakuliah::count(),
            'wajib' => Matakuliah::where('status', 'Wajib')->count(),
            'pilihan' => Matakuliah::where('status', 'Pilihan')->count(),
            'total_sks' => Matakuliah::sum('sks'),
        ];

        return view('akademik.matakuliah.index', compact('matakuliah', 'prodis', 'stats'));
    }

    public function storeMatakuliah(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|unique:matakuliah,kode_mk',
            'nama' => 'required|string|max:150',
            'sks' => 'required|integer|min:1|max:8',
            'semester' => 'required|integer|min:1|max:8',
            'prodi_id' => 'required|exists:prodi,prodi_id',
            'jenis' => 'required|in:Teori,Praktikum,Gabungan',
            'status' => 'required|in:Wajib,Pilihan',
            'deskripsi' => 'nullable|string',
        ]);

        $mk = Matakuliah::create([
            'kode_mk' => $validated['kode'],
            'nama_mk' => $validated['nama'],
            'sks' => $validated['sks'],
            'semester_paket' => $validated['semester'],
            'prodi_id' => $validated['prodi_id'],
            'jenis' => $validated['jenis'],
            'status' => $validated['status'],
            'deskripsi' => $validated['deskripsi'],
        ]);

        $this->logActivity('CREATE', 'Matakuliah', $mk->matakuliah_id, "Menambahkan mata kuliah: {$mk->nama_mk}");

        return redirect()->back()->with('success', 'Mata kuliah berhasil ditambahkan');
    }

    public function updateMatakuliah(Request $request, $id)
    {
        $mk = Matakuliah::findOrFail($id);
        $validated = $request->validate([
            'kode' => 'required|unique:matakuliah,kode_mk,' . $id . ',matakuliah_id',
            'nama' => 'required|string|max:150',
            'sks' => 'required|integer|min:1|max:8',
            'semester' => 'required|integer|min:1|max:8',
            'prodi_id' => 'required|exists:prodi,prodi_id',
            'jenis' => 'required|in:Teori,Praktikum,Gabungan',
            'status' => 'required|in:Wajib,Pilihan',
            'deskripsi' => 'nullable|string',
        ]);

        $mk->update([
            'kode_mk' => $validated['kode'],
            'nama_mk' => $validated['nama'],
            'sks' => $validated['sks'],
            'semester_paket' => $validated['semester'],
            'prodi_id' => $validated['prodi_id'],
            'jenis' => $validated['jenis'],
            'status' => $validated['status'],
            'deskripsi' => $validated['deskripsi'],
        ]);

        $this->logActivity('UPDATE', 'Matakuliah', $mk->matakuliah_id, "Memperbarui mata kuliah: {$mk->nama_mk}");

        return redirect()->back()->with('success', 'Mata kuliah berhasil diperbarui');
    }

    public function destroyMatakuliah($id)
    {
        $mk = Matakuliah::findOrFail($id);
        $name = $mk->nama_mk;
        $mk->delete();
        $this->logActivity('DELETE', 'Matakuliah', $id, "Menghapus mata kuliah: {$name}");
        return redirect()->back()->with('success', 'Mata kuliah berhasil dihapus');
    }

    // --- KURIKULUM ---
    public function indexKurikulum(Request $request)
    {
        $query = Kurikulum::with('prodi');
        
        if($request->prodi_id) $query->where('prodi_id', $request->prodi_id);
        if($request->status) $query->where('status', $request->status);

        $kurikulums = $query->get();
        $prodis = Prodi::all();

        $stats = [
            'total' => Kurikulum::count(),
            'aktif' => Kurikulum::where('status', 'Aktif')->count(),
            'mk_count' => DB::table('kurikulum_matkul')->count(),
            'total_sks' => Kurikulum::sum('tahun_berlaku'), // Just placeholder, normally sum from matkul relation
        ];

        return view('akademik.kurikulum.index', compact('kurikulums', 'prodis', 'stats'));
    }

    public function storeKurikulum(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:150',
            'prodi_id' => 'required|exists:prodi,prodi_id',
            'tahun' => 'required',
            'status' => 'required|in:Aktif,Arsip',
            'deskripsi' => 'nullable',
        ]);

        $kur = Kurikulum::create([
            'nama_kurikulum' => $validated['nama'],
            'prodi_id' => $validated['prodi_id'],
            'tahun_berlaku' => $validated['tahun'],
            'status' => $validated['status'],
            'created_by' => auth()->id(),
        ]);

        $this->logActivity('CREATE', 'Kurikulum', $kur->kurikulum_id, "Menambahkan kurikulum: {$kur->nama_kurikulum}");

        return redirect()->back()->with('success', 'Kurikulum berhasil ditambahkan');
    }

    public function showKurikulum($id)
    {
        $kurikulum = Kurikulum::with(['prodi', 'matakuliah' => function($q) {
            $q->orderBy('kurikulum_matkul.semester_ke')->orderBy('matakuliah.kode_mk');
        }])->findOrFail($id);
        
        $allMatakuliah = Matakuliah::all(); // For adding new to kurikulum
        
        return view('akademik.kurikulum.show', compact('kurikulum', 'allMatakuliah'));
    }

    public function attachMatakuliah(Request $request, $id)
    {
        $kurikulum = Kurikulum::findOrFail($id);
        $validated = $request->validate([
            'matkul_id' => 'required|exists:matakuliah,matakuliah_id',
            'semester' => 'required|integer|min:1|max:8',
            'tipe' => 'required|in:ganjil,genap',
            'wajib' => 'required|boolean'
        ]);

        $kurikulum->matakuliah()->attach($validated['matkul_id'], [
            'semester_ke' => $validated['semester'],
            'tipe_semester' => $validated['tipe'],
            'wajib' => $validated['wajib']
        ]);

        $this->logActivity('UPDATE', 'Kurikulum', $id, "Menambahkan mata kuliah ke kurikulum: {$kurikulum->nama_kurikulum}");

        return redirect()->back()->with('success', 'Mata kuliah berhasil ditambahkan ke kurikulum');
    }

    public function detachMatakuliah($id, $matkul_id)
    {
        $kurikulum = Kurikulum::findOrFail($id);
        $kurikulum->matakuliah()->detach($matkul_id);

        $this->logActivity('UPDATE', 'Kurikulum', $id, "Menghapus mata kuliah dari kurikulum: {$kurikulum->nama_kurikulum}");

        return redirect()->back()->with('success', 'Mata kuliah berhasil dihapus dari kurikulum');
    }

    public function updateKurikulum(Request $request, $id)
    {
        $kurikulum = Kurikulum::findOrFail($id);
        $validated = $request->validate([
            'nama' => 'required|string|max:150',
            'prodi_id' => 'required|exists:prodi,prodi_id',
            'tahun' => 'required',
            'status' => 'required|in:Aktif,Arsip',
        ]);

        $kurikulum->update([
            'nama_kurikulum' => $validated['nama'],
            'prodi_id' => $validated['prodi_id'],
            'tahun_berlaku' => $validated['tahun'],
            'status' => $validated['status'],
        ]);

        $this->logActivity('UPDATE', 'Kurikulum', $kurikulum->kurikulum_id, "Memperbarui kurikulum: {$kurikulum->nama_kurikulum}");

        return redirect()->back()->with('success', 'Kurikulum berhasil diperbarui');
    }

    public function destroyKurikulum($id)
    {
        $kurikulum = Kurikulum::findOrFail($id);
        $name = $kurikulum->nama_kurikulum;
        $kurikulum->delete();
        $this->logActivity('DELETE', 'Kurikulum', $id, "Menghapus kurikulum: {$name}");
        return redirect()->back()->with('success', 'Kurikulum berhasil dihapus');
    }

    // --- KELAS ---
    public function indexKelas(Request $request)
    {
        $query = Kelas::with(['matakuliah', 'dosen.dosen', 'prodi', 'semesterAjaran'])
                      ->withCount('krsDetails');

        if($request->search) {
            $query->where('kode_kelas', 'like', '%' . $request->search . '%')
                  ->orWhereHas('matakuliah', function($q) use ($request) {
                      $q->where('nama_mk', 'like', '%' . $request->search . '%');
                  });
        }
        
        if($request->semester_id) $query->where('semester_ajaran_id', $request->semester_id);
        if($request->prodi_id) $query->where('prodi_id', $request->prodi_id);

        $kelas = $query->paginate(12)->withQueryString();
        $prodis = Prodi::all();
        $matakuliah = Matakuliah::all();
        $dosens = Dosen::all();
        $semesters = SemesterAjaran::all();

        $stats = [
            'total' => Kelas::count(),
            'active' => Kelas::where('status', 'Aktif')->count(),
            'total_students' => \App\Models\KrsDetail::count(), // rough estimate
            'avg_per_class' => Kelas::count() > 0 ? \App\Models\KrsDetail::count() / Kelas::count() : 0,
        ];

        return view('akademik.kelas.index', compact('kelas', 'prodis', 'matakuliah', 'dosens', 'semesters', 'stats'));
    }

    public function storeKelas(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|unique:kelas,kode_kelas',
            'matakuliah_id' => 'required|exists:matakuliah,matakuliah_id',
            'dosen_id' => 'required|exists:dosen,dosen_id',
            'semester_ajaran_id' => 'required|exists:semester_ajaran,semester_ajaran_id',
            'prodi_id' => 'required|exists:prodi,prodi_id',
            'kapasitas' => 'required|integer|min:1',
        ]);

        $kelasId = null;
        DB::transaction(function() use ($validated, &$kelasId) {
            $kelas = Kelas::create([
                'kode_kelas' => $validated['kode'],
                'matakuliah_id' => $validated['matakuliah_id'],
                'prodi_id' => $validated['prodi_id'],
                'semester_ajaran_id' => $validated['semester_ajaran_id'],
                'kapasitas' => $validated['kapasitas'],
            ]);

            $kelasId = $kelas->kelas_id;

            DosenPengampu::create([
                'kelas_id' => $kelas->kelas_id,
                'dosen_id' => $validated['dosen_id'],
                'is_ketua' => 1
            ]);
        });

        $this->logActivity('CREATE', 'Kelas', $kelasId, "Membuka seksi mata kuliah baru: {$validated['kode']}");

        return redirect()->back()->with('success', 'Seksi Mata Kuliah berhasil dibuat');
    }

    public function updateKelas(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);
        $validated = $request->validate([
            'kode' => 'required|unique:kelas,kode_kelas,' . $id . ',kelas_id',
            'matakuliah_id' => 'required|exists:matakuliah,matakuliah_id',
            'dosen_id' => 'required|exists:dosen,dosen_id',
            'kapasitas' => 'required|integer',
            'status' => 'required'
        ]);

        DB::transaction(function() use ($kelas, $validated) {
            $kelas->update([
                'kode_kelas' => $validated['kode'],
                'matakuliah_id' => $validated['matakuliah_id'],
                'kapasitas' => $validated['kapasitas'],
                'status' => $validated['status'],
            ]);

            DosenPengampu::where('kelas_id', $kelas->kelas_id)->where('is_ketua', 1)->update([
                'dosen_id' => $validated['dosen_id']
            ]);
        });

        $this->logActivity('UPDATE', 'Kelas', $kelas->kelas_id, "Memperbarui seksi mata kuliah: {$kelas->kode_kelas}");

        return redirect()->back()->with('success', 'Seksi Mata Kuliah berhasil diperbarui');
    }

    public function destroyKelas($id)
    {
        $kelas = Kelas::findOrFail($id);
        $name = $kelas->kode_kelas;
        $kelas->delete();
        $this->logActivity('DELETE', 'Kelas', $id, "Menghapus seksi mata kuliah: {$name}");
        return redirect()->back()->with('success', 'Seksi Mata Kuliah berhasil dihapus');
    }

    // --- JADWAL ---
    public function indexJadwal(Request $request)
    {
        $query = Jadwal::with(['kelas.matakuliah', 'kelas.dosen.dosen', 'ruangan', 'kelas.prodi', 'kelas.semesterAjaran']);

        // Filtering
        if($request->hari) $query->where('hari', $request->hari);
        if($request->ruangan_id) $query->where('ruangan_id', $request->ruangan_id);
        if($request->prodi_id) {
            $query->whereHas('kelas', function($q) use ($request) {
                $q->where('prodi_id', $request->prodi_id);
            });
        }
        if($request->semester_id) {
            $query->whereHas('kelas', function($q) use ($request) {
                $q->where('semester_ajaran_id', $request->semester_id);
            });
        }
        if($request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('kelas.matakuliah', function($mq) use ($search) {
                    $mq->where('nama_mk', 'like', "%{$search}%")->orWhere('kode_mk', 'like', "%{$search}%");
                })->orWhereHas('kelas', function($kq) use ($search) {
                    $kq->where('kode_kelas', 'like', "%{$search}%");
                });
            });
        }
        
        $jadwal = $query->get();

        // Calculate Stats
        $allJadwal = Jadwal::query();
        if($request->semester_id) {
            $allJadwal->whereHas('kelas', function($q) use ($request) {
                $q->where('semester_ajaran_id', $request->semester_id);
            });
        }

        $stats = [
            'total' => (clone $allJadwal)->count(),
            'senin' => (clone $allJadwal)->where('hari', 'Senin')->count(),
            'selasa' => (clone $allJadwal)->where('hari', 'Selasa')->count(),
            'rabu' => (clone $allJadwal)->where('hari', 'Rabu')->count(),
            'kamis' => (clone $allJadwal)->where('hari', 'Kamis')->count(),
            'jumat' => (clone $allJadwal)->where('hari', 'Jumat')->count(),
            'sabtu' => (clone $allJadwal)->where('hari', 'Sabtu')->count(),
        ];

        if ($request->ajax()) {
            return response()->json([
                'html' => view('akademik.jadwal._table', compact('jadwal'))->render(),
                'calendar' => view('akademik.jadwal._calendar', compact('jadwal'))->render(),
                'stats' => $stats
            ]);
        }

        $prodis = Prodi::all();
        $semesters = SemesterAjaran::all();
        $kelas_list = Kelas::withCount('krsDetails')->get();
        $ruangans = Ruangan::all();

        return view('akademik.jadwal.index', compact('jadwal', 'prodis', 'semesters', 'kelas_list', 'ruangans', 'stats'));
    }

    public function storeJadwal(Request $request)
    {
        $validated = $request->validate([
            'kelas_id' => 'required|exists:kelas,kelas_id',
            'ruangan_id' => 'required|exists:ruangan,ruangan_id',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        $kelas = Kelas::withCount('krsDetails')->findOrFail($validated['kelas_id']);
        $ruangan = Ruangan::findOrFail($validated['ruangan_id']);
        $dosen_id = $kelas->dosen->dosen_id ?? null;

        // 1. Capacity Check
        if ($kelas->krs_details_count + 1 > $ruangan->kapasitas) {
            return redirect()->back()->withErrors([
                'capacity' => "Kapasitas ruangan {$ruangan->nama_ruangan} ({$ruangan->kapasitas}) tidak mencukupi untuk jumlah mahasiswa ({$kelas->krs_details_count})."
            ])->withInput();
        }

        // 2. Conflict Check (Room & Dosen)
        $conflict = $this->hasConflict(
            $validated['hari'], 
            $validated['jam_mulai'], 
            $validated['jam_selesai'], 
            $validated['ruangan_id'], 
            $dosen_id
        );

        if ($conflict) {
            $msg = (string)$conflict->ruangan_id === (string)$validated['ruangan_id'] 
                ? "Ruangan {$ruangan->nama_ruangan} sudah terpakai pada waktu tersebut."
                : "Dosen pengampu kelas ini sudah mengajar di kelas lain pada waktu tersebut.";
            return redirect()->back()->withErrors(['conflict' => $msg])->withInput();
        }

        $j = Jadwal::create($validated);
        $this->logActivity('CREATE', 'Jadwal', $j->jadwal_id, "Menambahkan jadwal di {$ruangan->nama_ruangan} untuk seksi: {$kelas->kode_kelas}");
        
        return redirect()->back()->with('success', 'Jadwal berhasil ditambahkan');
    }

    public function updateJadwal(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $validated = $request->validate([
            'kelas_id' => 'required|exists:kelas,kelas_id',
            'ruangan_id' => 'required|exists:ruangan,ruangan_id',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        $kelas = Kelas::withCount('krsDetails')->findOrFail($validated['kelas_id']);
        $ruangan = Ruangan::findOrFail($validated['ruangan_id']);
        $dosen_id = $kelas->dosen->dosen_id ?? null;

        // 1. Capacity Check
        if ($kelas->krs_details_count + 1 > $ruangan->kapasitas) {
            return redirect()->back()->withErrors([
                'capacity' => "Kapasitas ruangan {$ruangan->nama_ruangan} ({$ruangan->kapasitas}) tidak mencukupi untuk jumlah mahasiswa ({$kelas->krs_details_count})."
            ])->withInput();
        }

        // 2. Conflict Check
        $conflict = $this->hasConflict(
            $validated['hari'], 
            $validated['jam_mulai'], 
            $validated['jam_selesai'], 
            $validated['ruangan_id'], 
            $dosen_id,
            $id
        );

        if ($conflict) {
            $msg = (string)$conflict->ruangan_id === (string)$validated['ruangan_id'] 
                ? "Ruangan {$ruangan->nama_ruangan} sudah terpakai pada waktu tersebut."
                : "Dosen pengampu kelas ini sudah mengajar di kelas lain pada waktu tersebut.";
            return redirect()->back()->withErrors(['conflict' => $msg])->withInput();
        }

        $jadwal->update($validated);
        $this->logActivity('UPDATE', 'Jadwal', $id, "Memperbarui jadwal seksi {$kelas->kode_kelas} ke {$ruangan->nama_ruangan}");
        
        return redirect()->back()->with('success', 'Jadwal berhasil diperbarui');
    }

    public function destroyJadwal($id)
    {
        $jadwal = Jadwal::with('kelas')->findOrFail($id);
        $className = $jadwal->kelas->kode_kelas ?? 'N/A';
        $jadwal->delete();
        $this->logActivity('DELETE', 'Jadwal', $id, "Menghapus jadwal untuk kelas: {$className}");
        return redirect()->back()->with('success', 'Jadwal berhasil dihapus');
    }

    public function listDosen()
    {
        $dosens = Dosen::with('prodi')->get();
        return view('akademik.dosen_list', compact('dosens'));
    }

    public function listMahasiswa()
    {
        $mahasiswas = Mahasiswa::with('prodi')->get();
        return view('akademik.mahasiswa_list', compact('mahasiswas'));
    }
}
