<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Akun Admin Utama
        User::updateOrCreate(
            ['email' => 'admin@dprd.go.id'],
            [
                'name' => 'Administrator Utama DPRD',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );

        // 2. Akun Peserta Magang
        User::updateOrCreate(
            ['email' => 'magang@dprd.go.id'],
            [
                'name' => 'Peserta Magang DPRD',
                'password' => Hash::make('magang123'),
                'role' => 'magang',
                'institution' => 'Universitas Pamulang',
                'internship_period' => 'Januari - April 2026',
                'phone' => '081298765432',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
    }
}
