<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\SemesterAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenilaianController extends Controller
{
    public function index()
    {
        $dosen = Auth::user()->dosen;
        $activeSemester = SemesterAjaran::where('is_active', true)->first() ?? SemesterAjaran::orderBy('semester_ajaran_id', 'desc')->first();

        $classes = Kelas::whereHas('dosenPengampu', function($q) use ($dosen) {
            $q->where('dosen_id', $dosen->dosen_id);
        })->where('semester_ajaran_id', $activeSemester->semester_ajaran_id)
          ->with(['matakuliah', 'krsDetails'])
          ->withCount(['krsDetails as total_students'])
          ->get();

        // Add grading progress to each class
        foreach ($classes as $class) {
            $gradedCount = Nilai::where('kelas_id', $class->kelas_id)->count();
            $class->graded_count = $gradedCount;
            $class->grading_progress = $class->total_students > 0 ? ($gradedCount / $class->total_students) * 100 : 0;
            
            // Calculate average grade (optional, can be expensive for large sets)
            $class->avg_grade_numeric = Nilai::where('kelas_id', $class->kelas_id)->avg('nilai_angka') ?? 0;
            $class->avg_grade_letter = $this->calculateGradeLetter($class->avg_grade_numeric);
        }

        $recentGrades = Nilai::where('dosen_id', $dosen->dosen_id)
            ->with(['mahasiswa', 'kelas.matakuliah'])
            ->orderBy('updated_at', 'desc')
            ->take(10)
            ->get();

        return view('dosen.penilaian', compact('classes', 'activeSemester', 'recentGrades'));
    }

    public function kelas($id)
    {
        $dosen = Auth::user()->dosen;
        $class = Kelas::whereHas('dosenPengampu', function($q) use ($dosen) {
            $q->where('dosen_id', $dosen->dosen_id);
        })->with(['matakuliah', 'krsDetails.krs.mahasiswa', 'semesterAjaran', 'jadwals.pertemuans'])
          ->findOrFail($id);

        // Get total meetings for this class across all schedules
        $pertemuanCount = $class->jadwals->flatMap->pertemuans->count();

        $students = $class->krsDetails->map(function($detail) use ($class, $pertemuanCount) {
            $mhs = $detail->krs->mahasiswa;
            $nilai = Nilai::where('mahasiswa_id', $mhs->mahasiswa_id)
                          ->where('kelas_id', $class->kelas_id)
                          ->first();
            
            // Auto calculate attendance if not exists or if we want to sync
            $hadirCount = \App\Models\Presensi::where('mahasiswa_id', $mhs->mahasiswa_id)
                ->whereIn('pertemuan_id', $class->jadwals->flatMap->pertemuans->pluck('pertemuan_id'))
                ->where('status', 'hadir')
                ->count();
            
            $attendancePercentage = $pertemuanCount > 0 ? ($hadirCount / $pertemuanCount) * 100 : 0;
            $mhs->auto_kehadiran = $attendancePercentage;
            
            $mhs->nilai = $nilai;
            return $mhs;
        });

        return view('dosen.penilaian.input_nilai', compact('class', 'students', 'pertemuanCount'));
    }

    public function updateWeights(Request $request, $id)
    {
        $request->validate([
            'bobot_kehadiran' => 'required|numeric|min:0|max:100',
            'bobot_tugas' => 'required|numeric|min:0|max:100',
            'bobot_uts' => 'required|numeric|min:0|max:100',
            'bobot_uas' => 'required|numeric|min:0|max:100',
        ]);

        $total = $request->bobot_kehadiran + $request->bobot_tugas + $request->bobot_uts + $request->bobot_uas;
        
        if ($total != 100) {
            return redirect()->back()->with('error', 'Total bobot harus 100%. Saat ini: ' . $total . '%');
        }

        $class = Kelas::findOrFail($id);
        $class->update($request->only(['bobot_kehadiran', 'bobot_tugas', 'bobot_uts', 'bobot_uas']));

        return redirect()->back()->with('success', 'Kontrak Kuliah (Bobot Nilai) berhasil diperbarui.');
    }

    public function store(Request $request)
    {
        $class = Kelas::findOrFail($request->kelas_id);
        $dosen = Auth::user()->dosen;

        $grades = $request->grades; // Array of [mahasiswa_id => [kehadiran, tugas, uts, uas]]

        foreach ($grades as $mhsId => $data) {
            // Check if existing grade is locked
            $existingNilai = Nilai::where('mahasiswa_id', $mhsId)
                                 ->where('kelas_id', $class->kelas_id)
                                 ->first();
            
            if ($existingNilai && $existingNilai->status_kunci) {
                continue; // Skip locked records
            }

            $numeric = ($data['kehadiran'] * ($class->bobot_kehadiran / 100)) +
                       ($data['tugas'] * ($class->bobot_tugas / 100)) +
                       ($data['uts'] * ($class->bobot_uts / 100)) +
                       ($data['uas'] * ($class->bobot_uas / 100));

            $letter = $this->calculateGradeLetter($numeric);
            $weight = $this->calculateGradeWeight($letter);

            Nilai::updateOrCreate(
                ['mahasiswa_id' => $mhsId, 'kelas_id' => $class->kelas_id],
                [
                    'dosen_id' => $dosen->dosen_id,
                    'nilai_kehadiran' => $data['kehadiran'],
                    'nilai_tugas' => $data['tugas'],
                    'nilai_uts' => $data['uts'],
                    'nilai_uas' => $data['uas'],
                    'nilai_angka' => $numeric,
                    'nilai_huruf' => $letter,
                    'bobot' => $weight,
                    'status_kunci' => $request->has('lock_grades')
                ]
            );
        }

        return redirect()->back()->with('success', 'Nilai mahasiswa berhasil disimpan.');
    }

    private function calculateGradeLetter($score)
    {
        if ($score >= 85) return 'A';
        if ($score >= 80) return 'A-';
        if ($score >= 75) return 'B+';
        if ($score >= 70) return 'B';
        if ($score >= 65) return 'B-';
        if ($score >= 60) return 'C+';
        if ($score >= 55) return 'C';
        if ($score >= 45) return 'D';
        return 'E';
    }

    private function calculateGradeWeight($letter)
    {
        $map = [
            'A' => 4.00,
            'A-' => 3.75,
            'B+' => 3.50,
            'B' => 3.00,
            'B-' => 2.75,
            'C+' => 2.50,
            'C' => 2.00,
            'D' => 1.00,
            'E' => 0.00
        ];
        return $map[$letter] ?? 0.00;
    }
}
