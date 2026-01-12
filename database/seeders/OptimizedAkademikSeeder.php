<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;
use App\Models\Krs;
use App\Models\KrsDetail;
use App\Models\SemesterAjaran;
use App\Models\Matakuliah;
use App\Models\Kelas;
use App\Models\Dosen;
use App\Models\DosenPengampu;
use Illuminate\Support\Facades\DB;

class OptimizedAkademikSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Fix Rajif Fandi (Mahasiswa ID 1)
        $rajif = Mahasiswa::find(1);
        if (!$rajif) {
            $this->command->error("Mahasiswa ID 1 (Rajif) not found!");
            return;
        }

        // Set Rajif to Semester 5 (Consistent with 2025/2026 Ganjil for 2023 intake)
        $rajif->update(['semester_sekarang' => 5]);

        $activeSemester = SemesterAjaran::where('is_active', true)->first();
        if (!$activeSemester) {
            $this->command->error("Active semester not found!");
            return;
        }

        // 2. Ensure Classes for Semester 5 exist
        $matkulsS5 = Matakuliah::where('semester_paket', 5)->get();
        if ($matkulsS5->isEmpty()) {
            $this->command->warn("No Matakuliah for Semester 5 found. Please run MatakuliahSeeder first.");
            return;
        }

        $dosen = Dosen::first(); // Assumed Dosen Wali

        // Clean up Rajif's old KRS for this semester to avoid duplicates
        Krs::where('mahasiswa_id', $rajif->mahasiswa_id)
           ->where('semester_ajaran_id', $activeSemester->semester_ajaran_id)
           ->delete();

        // 3. Create NEW Pending KRS for Rajif
        $krs = Krs::create([
            'mahasiswa_id' => $rajif->mahasiswa_id,
            'semester_ajaran_id' => $activeSemester->semester_ajaran_id,
            'status' => 'diajukan',
            'total_sks' => 0,
            'tanggal_pengajuan' => now()->subHours(2),
            'catatan' => null
        ]);

        $totalSks = 0;
        foreach ($matkulsS5 as $mk) {
            // Create Class for this course if not exists
            $kelas = Kelas::updateOrCreate(
                [
                    'matakuliah_id' => $mk->matakuliah_id, 
                    'prodi_id' => $rajif->prodi_id, 
                    'semester_ajaran_id' => $activeSemester->semester_ajaran_id
                ],
                [
                    'kode_kelas' => $mk->kode_mk . '-S5-A'
                ]
            );

            // Ensure Dosen is teaching this class
            DosenPengampu::updateOrCreate(
                ['kelas_id' => $kelas->kelas_id, 'dosen_id' => $dosen->dosen_id],
                ['is_ketua' => true]
            );

            // Add to Rajif's KRS
            KrsDetail::create([
                'krs_id' => $krs->krs_id,
                'kelas_id' => $kelas->kelas_id,
                'tipe_pengambilan' => 'normal',
                'status' => 'diambil'
            ]);

            $totalSks += $mk->sks;
        }

        $krs->update(['total_sks' => $totalSks]);

        $this->command->info("Rajif Fandi's data fixed and KRS for Semester 5 (Pending) created successfully!");
    }
}
