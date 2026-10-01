<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Admin (Pengelola Data)
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Administrator Utama',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // 2. Akun User biasa (Hanya Melihat Data)
        User::updateOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name' => 'Pengguna Mahasiswa',
                'password' => Hash::make('password'),
                'role' => 'user',
                'email_verified_at' => now(),
            ]
        );

        // 3. Seed Sample Data Mahasiswa
        $mahasiswaData = [
            [
                'nim' => '220101001',
                'nama' => 'Ahmad Rizky Pratama',
                'program_studi' => 'Teknik Informatika',
                'email' => 'ahmad.rizky@student.ac.id',
                'angkatan' => 2022,
            ],
            [
                'nim' => '220101002',
                'nama' => 'Siti Nurhaliza',
                'program_studi' => 'Sistem Informasi',
                'email' => 'siti.nurhaliza@student.ac.id',
                'angkatan' => 2022,
            ],
            [
                'nim' => '230101003',
                'nama' => 'Budi Santoso',
                'program_studi' => 'Teknik Informatika',
                'email' => 'budi.santoso@student.ac.id',
                'angkatan' => 2023,
            ],
            [
                'nim' => '230101004',
                'nama' => 'Dewi Anggraini',
                'program_studi' => 'Rekayasa Perangkat Lunak',
                'email' => 'dewi.anggraini@student.ac.id',
                'angkatan' => 2023,
            ],
            [
                'nim' => '240101005',
                'nama' => 'Fajar Kurnia',
                'program_studi' => 'Sains Data',
                'email' => 'fajar.kurnia@student.ac.id',
                'angkatan' => 2024,
            ],
        ];

        foreach ($mahasiswaData as $data) {
            Mahasiswa::updateOrCreate(
                ['nim' => $data['nim']],
                $data
            );
        }
    }
}
