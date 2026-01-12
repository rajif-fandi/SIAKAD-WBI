<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Krs;
use App\Models\Notifikasi;
use App\Models\SemesterAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KrsMahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $dosen = Auth::user()->dosen;
        $activeSemester = SemesterAjaran::where('is_active', true)->first();

        if (!$activeSemester) {
            return redirect()->back()->with('error', 'Tidak ada semester aktif.');
        }

        $query = Krs::with(['mahasiswa.prodi', 'details.kelas.matakuliah', 'semesterAjaran'])
            ->whereHas('mahasiswa', function ($q) use ($dosen) {
                $q->where('dosen_wali_id', $dosen->dosen_id);
            })
            ->where('semester_ajaran_id', $activeSemester->semester_ajaran_id);

        // Apply filters
        if ($request->status && $request->status !== 'all') {
            $query->where('status', $request->status);
        } else {
            // Default to 'diajukan' if no filter
            $query->whereIn('status', ['diajukan', 'disetujui_wali', 'ditolak']);
        }

        if ($request->search) {
            $query->whereHas('mahasiswa', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('npm', 'like', '%' . $request->search . '%');
            });
        }

        $krsList = $query->orderBy('tanggal_pengajuan', 'desc')->paginate(10);

        // Efficient Stats Calculation
        $allStats = Krs::whereHas('mahasiswa', function ($q) use ($dosen) {
                $q->where('dosen_wali_id', $dosen->dosen_id);
            })
            ->where('semester_ajaran_id', $activeSemester->semester_ajaran_id)
            ->select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get()
            ->pluck('count', 'status');

        $stats = [
            'pending' => $allStats->get('diajukan', 0),
            'approved' => $allStats->get('disetujui_wali', 0),
            'rejected' => $allStats->get('ditolak', 0),
            'total' => $allStats->get('diajukan', 0) + $allStats->get('disetujui_wali', 0) + $allStats->get('ditolak', 0),
        ];

        return view('dosen.KRSMahasiswa', compact('krsList', 'stats', 'activeSemester'));
    }

    public function approve(Request $request, $id)
    {
        Log::info("KRS Approval REQUEST START for ID: {$id}");
        $start = microtime(true);
        
        try {
            $data = DB::transaction(function () use ($request, $id, $start) {
                Log::info("KRS Approval: Entering Transaction for ID: {$id}");
                
                $krs = Krs::with(['mahasiswa:mahasiswa_id,user_id', 'semesterAjaran:semester_ajaran_id,tahun_ajaran,semester'])->findOrFail($id);
                Log::info("KRS Approval: Found KRS for ID: {$id}");
                
                $krs->update([
                    'status' => 'disetujui_wali',
                    'catatan' => $request->catatan,
                    'tanggal_validasi' => now(),
                ]);
                Log::info("KRS Approval: Updated KRS for ID: {$id}");

                // Send notification to student
                Notifikasi::create([
                    'user_id' => $krs->mahasiswa->user_id,
                    'judul' => 'KRS Disetujui',
                    'pesan' => 'KRS Anda untuk semester ' . $krs->semesterAjaran->nama_semester . ' telah disetujui oleh Dosen Wali.',
                    'tipe' => 'krs',
                    'link' => route('KRS.index'),
                ]);
                Log::info("KRS Approval: Created Notifikasi for ID: {$id}");

                return ['message' => 'KRS berhasil disetujui.'];
            });
            
            $time = microtime(true) - $start;
            Log::info("KRS Approval SUCCESS for ID: {$id} in {$time} seconds");
            return response()->json(array_merge($data, ['time' => $time]));

        } catch (\Exception $e) {
            $time = microtime(true) - $start;
            Log::error("KRS Approval FAILED for ID: {$id} after {$time} seconds. Error: " . $e->getMessage());
            return response()->json(['message' => 'Gagal: ' . $e->getMessage()], 500);
        }
    }

    public function reject(Request $request, $id)
    {
        Log::info("KRS Rejection REQUEST START for ID: {$id}");
        $start = microtime(true);
        
        $request->validate([
            'catatan' => 'required|string',
        ]);

        try {
            $data = DB::transaction(function () use ($request, $id, $start) {
                Log::info("KRS Rejection: Entering Transaction for ID: {$id}");
                
                $krs = Krs::with(['mahasiswa:mahasiswa_id,user_id', 'semesterAjaran:semester_ajaran_id,tahun_ajaran,semester'])->findOrFail($id);
                Log::info("KRS Rejection: Found KRS for ID: {$id}");
                
                $krs->update([
                    'status' => 'ditolak',
                    'catatan' => $request->catatan,
                    'tanggal_validasi' => now(),
                ]);
                Log::info("KRS Rejection: Updated KRS for ID: {$id}");

                // Send notification to student
                Notifikasi::create([
                    'user_id' => $krs->mahasiswa->user_id,
                    'judul' => 'KRS Ditolak',
                    'pesan' => 'KRS Anda untuk semester ' . $krs->semesterAjaran->nama_semester . ' ditolak oleh Dosen Wali. Alasan: ' . $request->catatan,
                    'tipe' => 'krs',
                    'link' => route('KRS.index'),
                ]);
                Log::info("KRS Rejection: Created Notifikasi for ID: {$id}");

                return ['message' => 'KRS berhasil ditolak.'];
            });
            
            $time = microtime(true) - $start;
            Log::info("KRS Rejection SUCCESS for ID: {$id} in {$time} seconds");
            return response()->json(array_merge($data, ['time' => $time]));

        } catch (\Exception $e) {
            $time = microtime(true) - $start;
            Log::error("KRS Rejection FAILED for ID: {$id} after {$time} seconds. Error: " . $e->getMessage());
            return response()->json(['message' => 'Gagal: ' . $e->getMessage()], 500);
        }
    }
}
