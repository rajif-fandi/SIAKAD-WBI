<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'Mahasiswa',
                'email' => 'mahasiswa@gmail.com',
                'role' => 'mahasiswa',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Dosen',
                'email' => 'dosen@gmail.com',
                'role' => 'dosen',
                'password' => bcrypt('123456')
            ],
        ];

        foreach($userData as $key => $val){
            User::create($val);
        }
    }
}
