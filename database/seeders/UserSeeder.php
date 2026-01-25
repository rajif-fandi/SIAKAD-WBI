<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Mahasiswa
        User::updateOrCreate(
            ['email' => '2023010001@wbi.ac.id'],
            [
                'name' => 'Syafrizal',
                'password' => Hash::make('12345678'),
                'role' => 'mahasiswa',
            ]
        );

        // Dosen
        User::updateOrCreate(
            ['email' => '1987654321@wbi.ac.id'],
            [
                'name' => 'Rahmat',
                'password' => Hash::make('12345678'),
                'role' => 'dosen',
            ]
        );
        // Admin
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );
    }
}
