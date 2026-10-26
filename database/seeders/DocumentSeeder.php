<?php

namespace Database\Seeders;

use App\Models\Document;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['UU', 'PP', 'Perpres', 'Peraturan DPR', 'Risalah', 'Laporan Kinerja', 'Naskah Pidato'];
        
        $sampleDocuments = [
            [
                'title' => 'Undang-Undang Republik Indonesia Nomor 17 Tahun 2023 tentang Kesehatan',
                'type' => 'UU',
                'number' => 'Nomor 17',
                'year' => 2023,
                'description' => 'Undang-undang ini mengatur penyelenggaraan kesehatan yang bertujuan untuk meningkatkan derajat kesehatan masyarakat yang setinggi-tingginya melalui pendekatan promotif, preventif, kuratif, dan rehabilitatif yang dilaksanakan secara menyeluruh, terpadu, dan berkesinambungan.',
            ],
            [
                'title' => 'Peraturan Pemerintah Nomor 46 Tahun 2023 tentang Jaminan Kesehatan Nasional',
                'type' => 'PP',
                'number' => 'Nomor 46',
                'year' => 2023,
                'description' => 'Peraturan Pemerintah ini mengatur mengenai penyelenggaraan Jaminan Kesehatan Nasional yang bertujuan memberikan perlindungan kesehatan kepada seluruh penduduk Indonesia.',
            ],
            [
                'title' => 'Risalah Rapat Paripurna DPR RI tentang Pengesahan RUU Kesehatan',
                'type' => 'Risalah',
                'number' => 'Rapat Paripurna ke-15',
                'year' => 2023,
                'description' => 'Risalah lengkap Rapat Paripurna DPR RI yang membahas dan mengesahkan Rancangan Undang-Undang tentang Kesehatan menjadi Undang-Undang.',
            ],
            [
                'title' => 'Laporan Kinerja DPR RI Tahun 2023',
                'type' => 'Laporan Kinerja',
                'year' => 2023,
                'description' => 'Laporan ini memuat capaian kinerja DPR RI dalam menjalankan fungsi legislasi, anggaran, dan pengawasan selama tahun anggaran 2023.',
            ],
            [
                'title' => 'Peraturan DPR RI Nomor 1 Tahun 2023 tentang Tata Tertib',
                'type' => 'Peraturan DPR',
                'number' => 'Nomor 1',
                'year' => 2023,
                'description' => 'Peraturan ini mengatur tata tertib dan mekanisme kerja DPR RI dalam menjalankan tugas dan fungsinya sebagai lembaga legislatif.',
            ],
        ];

        foreach ($sampleDocuments as $data) {
            Document::create([
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'description' => $data['description'],
                'type' => $data['type'],
                'number' => $data['number'] ?? null,
                'year' => $data['year'],
                'file_size' => rand(500000, 5000000), // 500KB - 5MB
                'downloads' => rand(10, 500),
                'document_date' => now()->subDays(rand(30, 365)),
                'published_at' => now()->subDays(rand(1, 30)),
            ]);
        }

        // Create more UU documents
        for ($i = 1; $i <= 10; $i++) {
            Document::create([
                'title' => 'Undang-Undang Nomor ' . $i . ' Tahun ' . (2020 + rand(0, 3)) . ' tentang ' . fake()->words(3, true),
                'slug' => Str::slug('UU ' . $i . ' tahun ' . (2020 + rand(0, 3))),
                'description' => fake()->paragraph(2),
                'type' => 'UU',
                'number' => 'Nomor ' . $i,
                'year' => 2020 + rand(0, 3),
                'file_size' => rand(1000000, 8000000),
                'downloads' => rand(50, 1000),
                'document_date' => now()->subDays(rand(30, 1000)),
                'published_at' => now()->subDays(rand(1, 100)),
            ]);
        }

        // Create PP documents
        for ($i = 1; $i <= 8; $i++) {
            Document::create([
                'title' => 'Peraturan Pemerintah Nomor ' . ($i + 20) . ' Tahun 2023 tentang ' . fake()->words(4, true),
                'slug' => Str::slug('PP ' . ($i + 20) . ' tahun 2023'),
                'description' => fake()->paragraph(2),
                'type' => 'PP',
                'number' => 'Nomor ' . ($i + 20),
                'year' => 2023,
                'file_size' => rand(800000, 4000000),
                'downloads' => rand(30, 600),
                'document_date' => now()->subDays(rand(10, 365)),
                'published_at' => now()->subDays(rand(1, 60)),
            ]);
        }

        // Create Risalah documents
        for ($i = 1; $i <= 12; $i++) {
            Document::create([
                'title' => 'Risalah Rapat Paripurna DPR RI ke-' . $i . ' Masa Sidang IV Tahun 2023',
                'slug' => Str::slug('risalah rapat paripurna ' . $i . ' 2023'),
                'description' => 'Risalah lengkap Rapat Paripurna DPR RI yang membahas ' . fake()->sentence(6),
                'type' => 'Risalah',
                'number' => 'Rapat Paripurna ke-' . $i,
                'year' => 2023,
                'file_size' => rand(2000000, 10000000),
                'downloads' => rand(20, 300),
                'document_date' => now()->subDays(rand(1, 180)),
                'published_at' => now()->subDays(rand(1, 30)),
            ]);
        }

        // Create other document types
        foreach (['Perpres', 'Peraturan DPR', 'Laporan Kinerja', 'Naskah Pidato'] as $type) {
            for ($i = 1; $i <= 5; $i++) {
                Document::create([
                    'title' => $type . ' - ' . fake()->sentence(5),
                    'slug' => Str::slug($type . ' ' . $i . ' ' . fake()->word()),
                    'description' => fake()->paragraph(2),
                    'type' => $type,
                    'number' => $type === 'Laporan Kinerja' ? null : 'Nomor ' . $i,
                    'year' => 2020 + rand(0, 3),
                    'file_size' => rand(500000, 6000000),
                    'downloads' => rand(10, 400),
                    'document_date' => now()->subDays(rand(1, 500)),
                    'published_at' => now()->subDays(rand(1, 60)),
                ]);
            }
        }
    }
}
