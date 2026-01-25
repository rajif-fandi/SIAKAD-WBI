<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            $userId = DB::table('users')
                ->where('email', '2023010001@wbi.ac.id')
                ->value('id');

            if (!$userId) {
                throw new \Exception('User mahasiswa belum ada. Jalankan UserSeeder dulu.');
            }


            // 2. PRODI (Use existing from ProdiSeeder or create if missing)
            $prodiId = DB::table('prodi')->where('kode_prodi', 'TRPL')->value('prodi_id');

            if (!$prodiId) {
                $prodiId = DB::table('prodi')->insertGetId([
                    'kode_prodi' => 'TRPL',
                    'nama_prodi' => 'Teknik Informatika',
                    'jenjang' => 'D4',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // 3. WILAYAH
            $wilayahProvinsi = DB::table('wilayah')->updateOrInsert(
                ['nama' => 'Jawa Barat', 'tipe' => 'provinsi'],
                ['parent_id' => null, 'created_at' => now(), 'updated_at' => now()]
            );
            $provinsiId = DB::table('wilayah')->where('nama', 'Jawa Barat')->value('wilayah_id');

            $wilayahKabupaten = DB::table('wilayah')->updateOrInsert(
                ['nama' => 'Bandung', 'tipe' => 'kabupaten'],
                ['parent_id' => $provinsiId, 'created_at' => now(), 'updated_at' => now()]
            );
            $kabupatenId = DB::table('wilayah')->where('nama', 'Bandung')->value('wilayah_id');

            $wilayahKecamatan = DB::table('wilayah')->updateOrInsert(
                ['nama' => 'Coblong', 'tipe' => 'kecamatan'],
                ['parent_id' => $kabupatenId, 'created_at' => now(), 'updated_at' => now()]
            );
            $kecamatanId = DB::table('wilayah')->where('nama', 'Coblong')->value('wilayah_id');

            $wilayahKelurahan = DB::table('wilayah')->updateOrInsert(
                ['nama' => 'Dago', 'tipe' => 'kelurahan'],
                ['parent_id' => $kecamatanId, 'created_at' => now(), 'updated_at' => now()]
            );
            $kelurahanId = DB::table('wilayah')->where('nama', 'Dago')->value('wilayah_id');

            // 4. DOSEN (wali)
            $dosenUserId = DB::table('users')
                ->where('email', '1987654321@wbi.ac.id')
                ->value('id');

            if (!$dosenUserId) {
                throw new \Exception('User dosen belum ada.');
            }

            DB::table('dosen')->updateOrInsert(
                ['user_id' => $dosenUserId],
                [
                    'nip' => '1987654321',
                    'nama' => 'Dr. Dosen Wali',
                    'prodi_id' => $prodiId,
                    'is_wali' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
            $dosenId = DB::table('dosen')->where('user_id', $dosenUserId)->value('dosen_id');

            // 5. MAHASISWA
            DB::table('mahasiswa')->updateOrInsert(
                ['user_id' => $userId],
                [
                    'npm' => '2023010001',
                    'nama' => 'Rajif Fandi',
                    'tempat_lahir' => 'Pematang Siantar',
                    'tanggal_lahir' => '2004-10-10',
                    'jenis_kelamin' => 'L',
                    'nik' => '1277010101040001',
                    'agama' => 'Islam',
                    'kewarganegaraan' => 'Indonesia',
                    'no_hp' => '082274646271',
                    'nama_ayah' => 'Bapak Rajif',
                    'nama_ibu' => 'Ibu Rajif',
                    'no_hp_ortu' => '082274000000',
                    'email_pribadi' => 'rajif.fandi@gmail.com',
                    'alamat_detail' => 'Jl. Bukit Tinggi No. 28, Kota Medan',
                    'angkatan' => 2023,
                    'semester_sekarang' => 3,
                    'prodi_id' => $prodiId,
                    'wilayah_id' => $kelurahanId,
                    'dosen_wali_id' => $dosenId,
                    'ukt_nominal' => 4500000,
                    'status_beasiswa' => '0%',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        });
    }
}
