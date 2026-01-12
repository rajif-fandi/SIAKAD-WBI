<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
use App\Models\Krs;
use App\Models\KrsDetail;
use App\Models\SemesterAjaran;
use App\Models\Kelas;
use App\Models\Kurikulum;

class KrsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        if (!$mahasiswa) {
            return redirect('/dashboard')->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        $krsList = Krs::with(['semesterAjaran'])
            ->where('mahasiswa_id', $mahasiswa->mahasiswa_id)
            ->orderBy('semester_ajaran_id', 'desc')
            ->get();

        $activeSemester = SemesterAjaran::where('is_active', true)->first();
        $hasActiveKrs = false;
        $activeKrsStatus = null;
        if ($activeSemester) {
            $activeKrs = Krs::where('mahasiswa_id', $mahasiswa->mahasiswa_id)
                ->where('semester_ajaran_id', $activeSemester->semester_ajaran_id)
                ->first();
            
            if ($activeKrs) {
                $hasActiveKrs = true;
                $activeKrsStatus = $activeKrs->status;
            }
        }

        return view('KRS.index', compact('mahasiswa', 'krsList', 'activeSemester', 'hasActiveKrs', 'activeKrsStatus'));
    }

    public function create()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::with(['prodi', 'activeKrs.details.kelas.matakuliah'])->where('user_id', $user->id)->first();

        if (!$mahasiswa) {
            return redirect('/dashboard')->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        \Illuminate\Support\Facades\Log::info("KRS.create Access - User ID: " . $user->id);
        
        $activeSemester = SemesterAjaran::where('is_active', true)->first();
        if (!$activeSemester) {
            \Illuminate\Support\Facades\Log::warning("KRS.create Redirect - No Active Semester");
            return redirect()->route('KRS.index')->with('error', 'Semester aktif tidak ditemukan.');
        }

        $existingKrs = Krs::where('mahasiswa_id', $mahasiswa->mahasiswa_id)
            ->where('semester_ajaran_id', $activeSemester->semester_ajaran_id)
            ->first();

        \Illuminate\Support\Facades\Log::info("KRS.create - Existing status: " . ($existingKrs->status ?? 'none'));

        // If exists and NOT (rejected or draft), block access.
        if ($existingKrs && !in_array($existingKrs->status, ['ditolak', 'draft'])) {
             \Illuminate\Support\Facades\Log::warning("KRS.create Redirect - Status blocked: " . $existingKrs->status);
             return redirect()->route('KRS.index')->with('info', 'Anda sudah memiliki KRS untuk semester ini.');
        }

        // Fetch available classes based on Prodi, Active Semester, AND (Current Semester OR Failed Retakes)
        $availableClasses = Kelas::with(['matakuliah', 'dosenPengampu.dosen', 'jadwals'])
            ->where('prodi_id', $mahasiswa->prodi_id)
            ->where('semester_ajaran_id', $activeSemester->semester_ajaran_id)
            ->whereHas('matakuliah', function($q) use ($mahasiswa, $activeSemester) {
                // Check if MK matches current semester type (Ganjil/Genap)
                $q->whereHas('kurikulum', function($sq) use ($activeSemester) {
                    $sq->where('kurikulum_matkul.tipe_semester', $activeSemester->semester);
                });

                $q->where(function($sub) use ($mahasiswa) {
                    // 1. Must match student's current semester paket
                    $sub->where('semester_paket', $mahasiswa->semester_sekarang)
                        // OR 2. Failed courses from previous semesters (Retake)
                        ->orWhereIn('matakuliah_id', function($failedQuery) use ($mahasiswa) {
                            $failedQuery->select('k.matakuliah_id')
                                ->from('nilai as n')
                                ->join('kelas as k', 'n.kelas_id', '=', 'k.kelas_id')
                                ->where('n.mahasiswa_id', $mahasiswa->mahasiswa_id)
                                ->where('n.bobot', '<', 2.0);
                        });
                });
            })
            ->get();

        return view('KRS.create', compact('mahasiswa', 'activeSemester', 'availableClasses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas_ids' => 'required|array',
            'kelas_ids.*' => 'exists:kelas,kelas_id',
        ]);

        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
        $activeSemester = SemesterAjaran::where('is_active', true)->first();

        if (!$activeSemester) {
            return back()->with('error', 'Semester aktif tidak ditemukan.');
        }

        if ($activeSemester) {
            $existingKrs = Krs::where('mahasiswa_id', $mahasiswa->mahasiswa_id)
                ->where('semester_ajaran_id', $activeSemester->semester_ajaran_id)
                ->first();

            if ($existingKrs && !in_array($existingKrs->status, ['ditolak', 'draft'])) {
                return redirect()->route('KRS.index')->with('error', 'Anda sudah memiliki KRS untuk semester ini.');
            }
        }

        // Validate 25 SKS Limit
        $totalSksPengajuan = 0;
        foreach ($request->kelas_ids as $kelasId) {
            $kelas = Kelas::with('matakuliah')->find($kelasId);
            if ($kelas) {
                $totalSksPengajuan += $kelas->matakuliah->sks;
            }
        }

        if ($totalSksPengajuan > 25) {
            return back()->with('error', 'Total SKS yang dipilih ('.$totalSksPengajuan.' SKS) melebihi batas maksimal 25 SKS per semester.');
        }

        if ($existingKrs) {
            // Clean up old draft/rejected record
            $existingKrs->delete(); 
        }

        $status = $request->action === 'draft' ? 'draft' : 'diajukan';

        $krs = Krs::create([
            'mahasiswa_id' => $mahasiswa->mahasiswa_id,
            'semester_ajaran_id' => $activeSemester->semester_ajaran_id,
            'status' => $status, 
            'total_sks' => 0, 
            'tanggal_pengajuan' => $status === 'diajukan' ? now() : null,
        ]);

        $totalSks = 0;
        foreach ($request->kelas_ids as $kelasId) {
            $kelas = Kelas::with('matakuliah')->find($kelasId);
            KrsDetail::create([
                'krs_id' => $krs->krs_id,
                'kelas_id' => $kelasId,
                'tipe_pengambilan' => 'normal',
                'status' => 'diambil'
            ]);
            $totalSks += $kelas->matakuliah->sks;
        }

        $krs->update(['total_sks' => $totalSks]);

        $msg = $status === 'draft' ? 'Draft KRS berhasil disimpan.' : 'KRS berhasil diajukan.';
        return redirect()->route('KRS.index')->with('success', $msg);
    }

    public function show($id)
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
        
        $krs = Krs::with(['semesterAjaran', 'details.kelas.matakuliah', 'details.kelas.dosenPengampu.dosen'])
            ->where('mahasiswa_id', $mahasiswa->mahasiswa_id)
            ->findOrFail($id);

        if (request()->wantsJson()) {
            return response()->json($krs);
        }

        return view('KRS.show', compact('krs'));
    }
}
