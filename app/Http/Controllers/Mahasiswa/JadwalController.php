<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
use App\Models\Krs;
use App\Models\KrsDetail;
use App\Models\Kelas;
use App\Models\SemesterAjaran;
use App\Models\Nilai;
use App\Models\DosenPengampu;

class JadwalController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        if (!$mahasiswa) {
            return redirect('/dashboard')->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        $activeSemester = SemesterAjaran::where('is_active', true)->first();

        if (!$activeSemester) {
            return view('jadwal.index', [
                'schedules' => collect([]),
                'total_courses' => 0,
                'joined_classes' => 0,
                'not_joined' => 0
            ]);
        }

        // Get student's KRS for active semester - MUST be approved or final
        $krs = Krs::where('mahasiswa_id', $mahasiswa->mahasiswa_id)
            ->where('semester_ajaran_id', $activeSemester->semester_ajaran_id)
            ->whereIn('status', ['disetujui_wali', 'final'])
            ->first();

        if (!$krs) {
            return view('jadwal.index', [
                'schedules' => collect([]),
                'total_courses' => 0,
                'joined_classes' => 0,
                'not_joined' => 0,
                'krs_not_approved' => true
            ]);
        }

        // Get ALL classes from approved KRS (removed semester_paket filter to allow retakes)
        $krsDetails = KrsDetail::with(['kelas.matakuliah', 'kelas.jadwals', 'kelas.dosenPengampu.dosen'])
            ->where('krs_id', $krs->krs_id)
            ->get();

        $schedules = [];
        $joinedCount = 0;
        $total_courses = $krsDetails->count();

        foreach ($krsDetails as $detail) {
            $isJoined = $detail->status === 'terverifikasi';
            if ($isJoined) {
                $joinedCount++;
            }
            
            $kelas = $detail->kelas;
            if ($kelas) {
                $dosenNames = $kelas->dosenPengampu->map(function($dp) {
                    return $dp->dosen->nama;
                })->implode(', ');

                // If class has schedules, show each one
                if ($kelas->jadwals->isNotEmpty()) {
                    foreach ($kelas->jadwals as $jadwal) {
                        $schedules[] = [
                            'kelas_id' => $kelas->kelas_id,
                            'kode' => $kelas->kode_kelas,
                            'nama' => $kelas->matakuliah->nama_mk,
                            'dosen' => $dosenNames ?: 'Belum ditentukan',
                            'ruang' => 'Ruang: ' . ($jadwal->ruangan ?: '-'),
                            'hari' => $this->translateHari($jadwal->hari),
                            'jam' => substr($jadwal->jam_mulai, 0, 5) . ' - ' . substr($jadwal->jam_selesai, 0, 5),
                            'status' => $detail->status
                        ];
                    }
                } else {
                    // Class has no schedule yet
                    $schedules[] = [
                        'kelas_id' => $kelas->kelas_id,
                        'kode' => $kelas->kode_kelas,
                        'nama' => $kelas->matakuliah->nama_mk,
                        'dosen' => $dosenNames ?: 'Belum ditentukan',
                        'ruang' => 'Belum ditentukan',
                        'hari' => 'Belum ditentukan',
                        'jam' => '-',
                        'status' => $detail->status
                    ];
                }
            }
        }

        $not_joined = $total_courses - $joinedCount;

        return view('jadwal.index', [
            'schedules' => $schedules,
            'total_courses' => $total_courses,
            'joined_classes' => $joinedCount,
            'not_joined' => $not_joined
        ]);
    }

    public function joinKelas(Request $request)
    {
        $kelas_id = $request->input('kelas_id');
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        if (!$mahasiswa) {
            return back()->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        $activeSemester = SemesterAjaran::where('is_active', true)->first();
        
        // Find the KRS Detail, ensuring it belongs to the student's approved KRS
        $krsDetail = KrsDetail::whereHas('krs', function($q) use ($mahasiswa, $activeSemester) {
            $q->where('mahasiswa_id', $mahasiswa->mahasiswa_id)
              ->where('semester_ajaran_id', $activeSemester->semester_ajaran_id)
              ->whereIn('status', ['disetujui_wali', 'final']);
        })
        ->where('kelas_id', $kelas_id)->first();

        if (!$krsDetail) {
            return back()->with('error', 'Mata kuliah tidak ditemukan atau tidak tersedia untuk Paket Semester Anda.');
        }

        if ($krsDetail->status === 'terverifikasi') {
            return back()->with('info', 'Anda sudah bergabung dalam kelas ini.');
        }

        // Update status to terverifikasi
        $krsDetail->update(['status' => 'terverifikasi']);

        // Initialize Nilai record for the lecturer
        $dosenPengampu = DosenPengampu::where('kelas_id', $kelas_id)->first();
        if ($dosenPengampu) {
            Nilai::updateOrCreate(
                [
                    'mahasiswa_id' => $mahasiswa->mahasiswa_id,
                    'kelas_id' => $kelas_id,
                ],
                [
                    'dosen_id' => $dosenPengampu->dosen_id,
                    'nilai_angka' => null,
                    'nilai_huruf' => null,
                    'bobot' => null,
                    'status_kunci' => false
                ]
            );
        }

        return back()->with('success', 'Berhasil bergabung ke kelas ' . ($krsDetail->kelas->matakuliah->nama_mk ?? ''));
    }

    private function translateHari($hari)
    {
        $map = [
            'Mon' => 'Senin',
            'Tue' => 'Selasa',
            'Wed' => 'Rabu',
            'Thu' => 'Kamis',
            'Fri' => 'Jumat',
            'Sat' => 'Sabtu',
            'Sun' => 'Minggu',
        ];

        return $map[$hari] ?? $hari;
    }
}
