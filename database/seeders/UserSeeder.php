<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Akun Admin
        User::updateOrCreate(
            ['email' => 'admin@sinau.test'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        // 2. Akun Guru
        User::updateOrCreate(
            ['email' => 'guru@sinau.test'],
            [
                'name' => 'Bapak Hendra Kurnia',
                'password' => Hash::make('password123'),
                'role' => 'guru',
            ]
        );

        // 3. Akun Siswa
        User::updateOrCreate(
            ['email' => 'siswa@sinau.test'],
            [
                'name' => 'Kelompok 8',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
            ]
        );
    }
}
