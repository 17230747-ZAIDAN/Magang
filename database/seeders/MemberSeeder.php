<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parties = ['PDI Perjuangan', 'Golkar', 'Gerindra', 'PKB', 'Nasdem', 'PKS', 'Demokrat', 'PAN', 'PPP'];
        $commissions = ['Komisi I', 'Komisi II', 'Komisi III', 'Komisi IV', 'Komisi V', 'Komisi VI', 'Komisi VII', 'Komisi VIII', 'Komisi IX', 'Komisi X', 'Komisi XI'];
        $positions = ['Ketua', 'Wakil Ketua', 'Anggota'];
        $provinces = ['DKI Jakarta', 'Jawa Barat', 'Jawa Tengah', 'Jawa Timur', 'Sumatera Utara', 'Sumatera Selatan', 'Kalimantan Timur', 'Sulawesi Selatan', 'Bali', 'Papua'];

        $sampleMembers = [
            [
                'name' => 'Dr. Ahmad Basuki, S.H., M.H.',
                'party' => 'PDI Perjuangan',
                'position' => 'Ketua',
                'commission' => 'Komisi I',
                'province' => 'DKI Jakarta',
                'biography' => 'Dr. Ahmad Basuki adalah anggota DPR RI yang memiliki pengalaman panjang di bidang hukum dan politik. Beliau aktif dalam pembahasan isu-isu pertahanan, intelijen, dan komunikasi.',
                'education' => 'S3 Ilmu Hukum - Universitas Indonesia',
            ],
            [
                'name' => 'Ir. Siti Nurhaliza, M.T.',
                'party' => 'Golkar',
                'position' => 'Wakil Ketua',
                'commission' => 'Komisi VII',
                'province' => 'Jawa Barat',
                'biography' => 'Ir. Siti Nurhaliza memiliki latar belakang teknik dan berpengalaman dalam sektor energi dan sumber daya mineral. Beliau berkomitmen untuk mendorong transisi energi terbarukan di Indonesia.',
                'education' => 'S2 Teknik Lingkungan - Institut Teknologi Bandung',
            ],
            [
                'name' => 'Prof. Dr. Bambang Sutrisno',
                'party' => 'Gerindra',
                'position' => 'Anggota',
                'commission' => 'Komisi X',
                'province' => 'Jawa Tengah',
                'biography' => 'Prof. Bambang adalah akademisi senior yang concern terhadap isu pendidikan dan kebudayaan. Beliau aktif mendorong peningkatan kualitas pendidikan nasional.',
                'education' => 'S3 Ilmu Pendidikan - Universitas Negeri Jakarta',
            ],
            [
                'name' => 'Dra. Ratna Dewi Kusuma',
                'party' => 'PKB',
                'position' => 'Anggota',
                'commission' => 'Komisi IX',
                'province' => 'Jawa Timur',
                'biography' => 'Dra. Ratna memiliki perhatian khusus pada isu kesehatan masyarakat dan jaminan sosial. Beliau aktif memperjuangkan akses kesehatan yang merata bagi seluruh rakyat.',
                'education' => 'S1 Kesehatan Masyarakat - Universitas Airlangga',
            ],
        ];

        foreach ($sampleMembers as $data) {
            Member::create([
                'name' => $data['name'],
                'slug' => Str::slug($data['name']),
                'party' => $data['party'],
                'electoral_district' => 'Dapil ' . $data['province'] . ' ' . rand(1, 5),
                'province' => $data['province'],
                'position' => $data['position'],
                'commission' => $data['commission'],
                'faction' => 'Fraksi ' . $data['party'],
                'biography' => $data['biography'],
                'education' => $data['education'],
                'email' => strtolower(str_replace([' ', '.', ','], '', explode(' ', $data['name'])[0])) . '@dpr.go.id',
                'phone' => '021-' . rand(5000000, 5999999),
                'start_period' => now()->subYears(2),
                'end_period' => now()->addYears(3),
                'is_active' => true,
            ]);
        }

        // Create more sample members
        for ($i = 1; $i <= 50; $i++) {
            $party = $parties[array_rand($parties)];
            $province = $provinces[array_rand($provinces)];
            $name = fake()->name();
            
            Member::create([
                'name' => $name,
                'slug' => Str::slug($name . '-' . $i),
                'party' => $party,
                'electoral_district' => 'Dapil ' . $province . ' ' . rand(1, 5),
                'province' => $province,
                'position' => $positions[array_rand($positions)],
                'commission' => $commissions[array_rand($commissions)],
                'faction' => 'Fraksi ' . $party,
                'biography' => fake()->paragraph(3),
                'education' => fake()->randomElement([
                    'S1 Hukum - Universitas Indonesia',
                    'S2 Ekonomi - Universitas Gadjah Mada',
                    'S1 Teknik - Institut Teknologi Bandung',
                    'S2 Administrasi Publik - Universitas Brawijaya'
                ]),
                'email' => strtolower(str_replace(' ', '', explode(' ', $name)[0])) . $i . '@dpr.go.id',
                'phone' => '021-' . rand(5000000, 5999999),
                'start_period' => now()->subYears(2),
                'end_period' => now()->addYears(3),
                'is_active' => true,
            ]);
        }
    }
}
