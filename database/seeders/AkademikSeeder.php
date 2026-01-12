<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kurikulum;
use App\Models\Matakuliah;
use App\Models\KurikulumMatkul;
use App\Models\PrasyaratMatkul;
use App\Models\Nilai;
use App\Models\Khs;
use App\Models\KhsDetail;
use App\Models\Jadwal;
use App\Models\DosenPengampu;
use App\Models\Pertemuan;
use App\Models\Presensi;
use App\Models\PembayaranUkt;
use App\Models\Mahasiswa;
use App\Models\Kelas;
use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\SemesterAjaran;
use App\Models\User;

class AkademikSeeder extends Seeder
{
    public function run(): void
    {
        $prodi = Prodi::where('kode_prodi', 'TRPL')->first();
        $user = User::where('role', 'dosen')->first(); 
        $mahasiswa = Mahasiswa::first();
        $dosen = Dosen::first();

        // 1. Kurikulum
        $kurikulum = Kurikulum::updateOrCreate(
            ['nama_kurikulum' => 'Kurikulum TRPL 2024'],
            [
                'prodi_id' => $prodi->prodi_id,
                'tahun_berlaku' => 2024,
                'created_by' => $user->id
            ]
        );

        // 2. Kurikulum Matkul & Kelas Setup
        $matkuls = Matakuliah::all();
        foreach ($matkuls as $mk) {
            KurikulumMatkul::updateOrCreate(
                ['kurikulum_id' => $kurikulum->kurikulum_id, 'matkul_id' => $mk->matakuliah_id],
                [
                    'semester_ke' => $mk->semester_paket ?? 1,
                    'tipe_semester' => ($mk->semester_paket % 2 == 0) ? 'genap' : 'ganjil',
                    'wajib' => true
                ]
            );
        }

        // 3. Populate KHS for multiple semesters (Semester 1, 2, & 3)
        // Current student is in semester 3, but let's assume they've finished 3 semesters for visual impact.
        $semesters = SemesterAjaran::orderBy('semester_ajaran_id', 'asc')->take(3)->get();
        
        $cumulativeSks = 0;
        $cumulativePoints = 0;

        foreach ($semesters as $index => $sem) {
            $semesterNum = $index + 1;
            $matkulsInSemester = Matakuliah::where('semester_paket', $semesterNum)->get();
            
            $semesterSks = 0;
            $semesterPoints = 0;

            $khs = Khs::updateOrCreate(
                ['mahasiswa_id' => $mahasiswa->mahasiswa_id, 'semester_ajaran_id' => $sem->semester_ajaran_id],
                [
                    'total_sks' => 0, // placeholder
                    'total_bobot' => 0, // placeholder
                    'ip' => 0, // placeholder
                    'ipk' => 0, // placeholder
                    'nasehat' => 'Tetap semangat, perbaiki nilai yang masih kurang di semester ini. Jangan lupa konsultasi dengan dosen wali.',
                    'show_nasehat' => true
                ]
            );

            foreach ($matkulsInSemester as $mkIdx => $mk) {
                // Introduce some failing grades for testing
                if ($semesterNum == 2 && $mkIdx == 0) {
                    $bobot = 1.0; // D
                    $nilaiHuruf = 'D';
                } elseif ($semesterNum == 2 && $mkIdx == 1) {
                    $bobot = 0.0; // E
                    $nilaiHuruf = 'E';
                } else {
                    $gradePoints = [4.0, 3.75, 3.5, 3.0, 2.75]; // A, A-, B+, B, B-
                    $bobot = $gradePoints[array_rand($gradePoints)];
                    
                    $nilaiHuruf = 'B';
                    if ($bobot == 4.0) $nilaiHuruf = 'A';
                    elseif ($bobot == 3.75) $nilaiHuruf = 'A-';
                    elseif ($bobot == 3.5) $nilaiHuruf = 'B+';
                    elseif ($bobot == 3.0) $nilaiHuruf = 'B';
                    elseif ($bobot == 2.75) $nilaiHuruf = 'B-';
                }

                KhsDetail::updateOrCreate(
                    ['khs_id' => $khs->khs_id, 'matakuliah_id' => $mk->matakuliah_id],
                    [
                        'sks' => $mk->sks,
                        'nilai_angka' => $bobot * 25, // simple mapping
                        'nilai_huruf' => $nilaiHuruf,
                        'bobot' => $bobot
                    ]
                );

                $semesterSks += $mk->sks;
                $semesterPoints += ($bobot * $mk->sks);

                // Initialize Nilai record too
                // Find or create a class for this matkul in this semester
                $kelas = Kelas::updateOrCreate(
                    ['matakuliah_id' => $mk->matakuliah_id, 'prodi_id' => $prodi->prodi_id, 'semester_ajaran_id' => $sem->semester_ajaran_id],
                    ['kode_kelas' => $mk->kode_mk . '-A-' . $sem->semester_ajaran_id]
                );

                Nilai::updateOrCreate(
                    ['mahasiswa_id' => $mahasiswa->mahasiswa_id, 'kelas_id' => $kelas->kelas_id],
                    [
                        'dosen_id' => $dosen->dosen_id,
                        'nilai_angka' => $bobot * 25,
                        'nilai_huruf' => $nilaiHuruf,
                        'bobot' => $bobot,
                        'status_kunci' => true
                    ]
                );
            }

            $cumulativeSks += $semesterSks;
            $cumulativePoints += $semesterPoints;

            $khs->update([
                'total_sks' => $semesterSks,
                'total_bobot' => $semesterPoints,
                'ip' => $semesterPoints / $semesterSks,
                'ipk' => $cumulativePoints / $cumulativeSks
            ]);

            // Payment for this semester
            PembayaranUkt::updateOrCreate(
                ['mahasiswa_id' => $mahasiswa->mahasiswa_id, 'semester_ajaran_id' => $sem->semester_ajaran_id],
                [
                    'nominal' => 4500000,
                    'tanggal_bayar' => now()->subMonths((3 - $semesterNum) * 6),
                    'status' => 'lunas',
                    'metode' => 'Virtual Account'
                ]
            );
        }

        // 4. Seed Notifications
        \App\Models\Notifikasi::updateOrCreate(
            ['user_id' => $mahasiswa->user_id, 'judul' => 'KRS Disetujui'],
            [
                'pesan' => 'KRS Anda untuk semester 3 telah disetujui oleh dosen wali. Silakan cek jadwal perkuliahan.',
                'tipe' => 'krs',
                'is_read' => false,
                'link' => route('KRS.index')
            ]
        );

        \App\Models\Notifikasi::updateOrCreate(
            ['user_id' => $mahasiswa->user_id, 'judul' => 'Mata Kuliah Mengulang'],
            [
                'pesan' => 'Ada 2 mata kuliah dari semester 2 yang perlu Anda ambil kembali karena nilai di bawah C. Segera hubungi dosen wali.',
                'tipe' => 'info',
                'is_read' => false,
                'link' => route('KRS.create')
            ]
        );

        \App\Models\Notifikasi::updateOrCreate(
            ['user_id' => $mahasiswa->user_id, 'judul' => 'Pembayaran Terverifikasi'],
            [
                'pesan' => 'Pembayaran UKT Semester Ganjil 2024/2025 telah berhasil diverifikasi oleh tim keuangan.',
                'tipe' => 'pembayaran',
                'is_read' => true,
                'link' => '#'
            ]
        );

        // 5. Additional Data for Dosen Dashboard Demonstration
        // Create more students for bimbingan
        $extraStudents = [
            ['npm' => '2023010002', 'nama' => 'Budi Doremi', 'user_email' => 'budi@gmail.com'],
            ['npm' => '2023010003', 'nama' => 'Siti Aminah', 'user_email' => 'siti@gmail.com'],
            ['npm' => '2023010004', 'nama' => 'Ahmad Fadli', 'user_email' => 'ahmad@gmail.com'],
        ];

        $activeSemester = SemesterAjaran::where('is_active', true)->first() ?? SemesterAjaran::orderBy('semester_ajaran_id', 'desc')->first();

        foreach ($extraStudents as $sData) {
            $sUser = User::updateOrCreate(
                ['email' => $sData['user_email']],
                [
                    'name' => $sData['nama'],
                    'password' => \Illuminate\Support\Facades\Hash::make('123456'),
                    'role' => 'mahasiswa'
                ]
            );

            $mhs = Mahasiswa::updateOrCreate(
                ['user_id' => $sUser->id],
                [
                    'npm' => $sData['npm'],
                    'nama' => $sData['nama'],
                    'prodi_id' => $prodi->prodi_id,
                    'dosen_wali_id' => $dosen->dosen_id,
                    'semester_sekarang' => 3,
                    'angkatan' => 2023
                ]
            );

            // Create KRS submissions for them
            $status = ($sData['npm'] == '2023010004') ? 'disetujui_wali' : 'diajukan';
            \App\Models\Krs::updateOrCreate(
                ['mahasiswa_id' => $mhs->mahasiswa_id, 'semester_ajaran_id' => $activeSemester->semester_ajaran_id],
                [
                    'status' => $status,
                    'total_sks' => 20,
                    'tanggal_pengajuan' => now()->subHours(rand(1, 24))
                ]
            );
        }

        // 6. Create many more students for testing grading lists
        $studentNames = [
            'Rizky Pratama', 'Salsabila Putri', 'Arif Budiman', 'Dewi Lestari', 
            'Farhan Maulana', 'Gita Permata', 'Hendra Kusuma', 'Indah Cahyani',
            'Joko Susilo', 'Kartika Sari', 'Lutfi Hakim', 'Maya Indah'
        ];

        foreach ($studentNames as $idx => $name) {
            $email = strtolower(str_replace(' ', '.', $name)) . '@example.com';
            $sUser = User::updateOrCreate(
                ['email' => $email],
                [
                    'name' => $name,
                    'password' => \Illuminate\Support\Facades\Hash::make('123456'),
                    'role' => 'mahasiswa'
                ]
            );

            $mhs = Mahasiswa::updateOrCreate(
                ['user_id' => $sUser->id],
                [
                    'npm' => '20230101' . str_pad($idx, 2, '0', STR_PAD_LEFT),
                    'nama' => $name,
                    'prodi_id' => $prodi->prodi_id,
                    'dosen_wali_id' => $dosen->dosen_id,
                    'semester_sekarang' => 3,
                    'angkatan' => 2023
                ]
            );

            // Create KRS Approved
            \App\Models\Krs::updateOrCreate(
                ['mahasiswa_id' => $mhs->mahasiswa_id, 'semester_ajaran_id' => $activeSemester->semester_ajaran_id],
                ['status' => 'disetujui_wali', 'total_sks' => 20, 'tanggal_pengajuan' => now()]
            );
        }

        // 7. Assign Dosen as pengampu and create schedules for today (Thursday)
        $myMatkuls = Matakuliah::whereIn('kode_mk', ['TRPL201', 'TRPL202', 'TRPL201'])->take(3)->get();
        $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'];
        $times = [
            ['08:00:00', '10:00:00'],
            ['10:00:00', '12:00:00'],
            ['13:00:00', '15:00:00'],
        ];

        foreach ($myMatkuls as $idx => $mk) {
            $myKelas = Kelas::updateOrCreate(
                ['matakuliah_id' => $mk->matakuliah_id, 'prodi_id' => $prodi->prodi_id, 'semester_ajaran_id' => $activeSemester->semester_ajaran_id],
                [
                    'kode_kelas' => $mk->kode_mk . '-A',
                    'bobot_kehadiran' => 10,
                    'bobot_tugas' => 20,
                    'bobot_uts' => 30,
                    'bobot_uas' => 40
                ]
            );

            DosenPengampu::updateOrCreate(
                ['kelas_id' => $myKelas->kelas_id, 'dosen_id' => $dosen->dosen_id],
                ['is_ketua' => true]
            );

            // Enroll ALL students to my classes
            $allMhsInProdi = Mahasiswa::where('prodi_id', $prodi->prodi_id)->get();
            foreach ($allMhsInProdi as $mhs) {
                $krs = \App\Models\Krs::where('mahasiswa_id', $mhs->mahasiswa_id)->where('semester_ajaran_id', $activeSemester->semester_ajaran_id)->first();
                if ($krs) {
                    \App\Models\KrsDetail::updateOrCreate(
                        ['krs_id' => $krs->krs_id, 'kelas_id' => $myKelas->kelas_id],
                        ['tipe_pengambilan' => 'normal', 'status' => 'diambil']
                    );
                }
            }

            // Create schedule
            $day = $days[$idx % count($days)];
            if ($idx == 0) $day = 'Thu'; 

            Jadwal::updateOrCreate(
                ['kelas_id' => $myKelas->kelas_id, 'hari' => $day],
                [
                    'jam_mulai' => $times[$idx % count($times)][0],
                    'jam_selesai' => $times[$idx % count($times)][1],
                    'ruangan' => 'Lab Komputer ' . ($idx + 1)
                ]
            );
        }
    }
}
