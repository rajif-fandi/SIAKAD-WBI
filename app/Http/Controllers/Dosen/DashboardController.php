<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\Krs;
use App\Models\Kelas;
use App\Models\SemesterAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $dosen = $user->dosen;

        if (!$dosen) {
            return redirect()->route('login')->with('error', 'Data dosen tidak ditemukan.');
        }

        // 1. Get Active Semester
        $activeSemester = SemesterAjaran::where('is_active', true)->first() ?? SemesterAjaran::orderBy('semester_ajaran_id', 'desc')->first();

        // 2. Stats
        // Total Matakuliah Diampu (Distinct through Kelas)
        $totalMatkul = Kelas::whereHas('dosenPengampu', function($query) use ($dosen) {
            $query->where('dosen_id', $dosen->dosen_id);
        })->where('semester_ajaran_id', $activeSemester->semester_ajaran_id)
          ->distinct('matakuliah_id')
          ->count();

        // Total Mahasiswa Bimbingan
        $totalBimbingan = $dosen->bimbingan()->count();

        // KRS Pending (from bimbingan)
        $krsPendingCount = Krs::whereIn('mahasiswa_id', $dosen->bimbingan->pluck('mahasiswa_id'))
            ->where('status', 'diajukan')
            ->where('semester_ajaran_id', $activeSemester->semester_ajaran_id)
            ->count();

        // Nilai Pending (Classes taught by dosen in current semester that don't have all grades inputed)
        // For simplicity, let's just count classes taught
        $totalKelas = Kelas::whereHas('dosenPengampu', function($query) use ($dosen) {
            $query->where('dosen_id', $dosen->dosen_id);
        })->where('semester_ajaran_id', $activeSemester->semester_ajaran_id)->count();

        // 3. Jadwal Hari Ini
        $dayNames = [
            'Sunday' => 'Sun',
            'Monday' => 'Mon',
            'Tuesday' => 'Tue',
            'Wednesday' => 'Wed',
            'Thursday' => 'Thu',
            'Friday' => 'Fri',
            'Saturday' => 'Sat'
        ];
        $today = $dayNames[Carbon::now()->format('l')];

        $todaySchedules = Jadwal::where('hari', $today)
            ->whereHas('kelas.dosenPengampu', function($query) use ($dosen) {
                $query->where('dosen_id', $dosen->dosen_id);
            })
            ->whereHas('kelas', function($query) use ($activeSemester) {
                $query->where('semester_ajaran_id', $activeSemester->semester_ajaran_id);
            })
            ->with(['kelas.matakuliah'])
            ->orderBy('jam_mulai', 'asc')
            ->get();

        // 4. Recent KRS Submissions
        $recentKrs = Krs::whereIn('mahasiswa_id', $dosen->bimbingan->pluck('mahasiswa_id'))
            ->with(['mahasiswa'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('dosen.dashboard', compact(
            'dosen', 
            'activeSemester', 
            'totalMatkul', 
            'totalBimbingan', 
            'krsPendingCount', 
            'totalKelas',
            'todaySchedules',
            'recentKrs'
        ));
    }
}
