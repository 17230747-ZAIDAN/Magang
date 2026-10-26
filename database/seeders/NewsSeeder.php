<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Legislasi', 'Anggaran', 'Pengawasan', 'Diplomasi Parlemen', 'Umum'];
        
        $newsData = [
            [
                'title' => 'DPR RI Sahkan RUU Kesehatan sebagai Undang-Undang',
                'category' => 'Legislasi',
                'content' => 'Jakarta - Dewan Perwakilan Rakyat Republik Indonesia (DPR RI) dalam Rapat Paripurna hari ini resmi mengesahkan Rancangan Undang-Undang (RUU) tentang Kesehatan menjadi Undang-Undang. Pengesahan ini dilakukan setelah melalui pembahasan intensif di tingkat Komisi IX DPR RI bersama Pemerintah.

Ketua DPR RI menyampaikan bahwa pengesahan UU Kesehatan ini merupakan langkah strategis dalam memperkuat sistem kesehatan nasional. "Undang-undang ini akan menjadi payung hukum yang kuat untuk meningkatkan akses dan kualitas layanan kesehatan bagi seluruh rakyat Indonesia," ujarnya dalam sambutannya.

UU Kesehatan yang baru ini mengatur berbagai aspek penting dalam penyelenggaraan kesehatan, termasuk jaminan kesehatan universal, standar fasilitas kesehatan, tenaga kesehatan, serta pengawasan obat dan makanan. Salah satu poin penting dalam undang-undang ini adalah penguatan sistem rujukan kesehatan dan peningkatan anggaran kesehatan.

Anggota Komisi IX DPR RI menjelaskan bahwa dalam penyusunan RUU ini, DPR telah melakukan serangkaian kunjungan kerja ke berbagai daerah dan mendengar masukan dari berbagai pemangku kepentingan, termasuk tenaga kesehatan, organisasi profesi, dan masyarakat.

Pemerintah menyambut baik pengesahan ini dan berkomitmen untuk segera menyiapkan peraturan pelaksanaan. Menteri Kesehatan menyatakan akan segera berkoordinasi dengan kementerian terkait untuk memastikan implementasi UU ini berjalan efektif.

UU Kesehatan ini diharapkan dapat menjawab tantangan kesehatan di era modern, termasuk penanganan pandemi, peningkatan kesehatan ibu dan anak, serta percepatan transformasi digital dalam layanan kesehatan.',
                'author' => 'Humas DPR RI',
                'is_featured' => true,
            ],
            [
                'title' => 'Pembahasan APBN 2027 Memasuki Tahap Pembicaraan Tingkat II',
                'category' => 'Anggaran',
                'content' => 'Jakarta - Pembahasan Rancangan Anggaran Pendapatan dan Belanja Negara (RAPBN) Tahun Anggaran 2027 telah memasuki tahap Pembicaraan Tingkat II di DPR RI. Dalam tahap ini, komisi-komisi akan melakukan pembahasan detail bersama kementerian/lembaga terkait.

Ketua Komisi XI DPR RI mengatakan bahwa pembahasan APBN tahun ini fokus pada pemulihan ekonomi pascapandemi dan akselerasi pertumbuhan ekonomi yang inklusif. "Kami akan memastikan alokasi anggaran tepat sasaran dan dapat meningkatkan kesejahteraan rakyat," katanya.

RAPBN 2027 mengasumsikan pertumbuhan ekonomi 5,3-5,6 persen dengan inflasi terkendali pada kisaran 2,5 persen. Pemerintah juga menargetkan defisit anggaran tidak lebih dari 2,8 persen dari Produk Domestik Bruto (PDB).

Dalam pembahasan ini, DPR akan fokus pada beberapa isu strategis seperti alokasi anggaran pendidikan, kesehatan, infrastruktur, serta program perlindungan sosial. Anggota DPR juga akan mengkaji efektivitas program-program yang telah berjalan dan melakukan realokasi jika diperlukan.',
                'author' => 'Tim Liputan DPR',
                'is_featured' => true,
            ],
            [
                'title' => 'Komisi III DPR RI Gelar Rapat Dengar Pendapat dengan Kapolri',
                'category' => 'Pengawasan',
                'content' => 'Jakarta - Komisi III DPR RI yang membidangi Hukum, HAM, dan Keamanan menggelar Rapat Dengar Pendapat (RDP) dengan Kepala Kepolisian Negara Republik Indonesia (Kapolri) untuk membahas berbagai isu keamanan nasional.

Dalam RDP tersebut, Komisi III meminta penjelasan Kapolri terkait upaya pencegahan dan penanganan kejahatan transnasional, terorisme, serta kejahatan siber yang semakin marak. Ketua Komisi III menekankan pentingnya sinergi antara lembaga penegak hukum dalam menjaga keamanan dan ketertiban masyarakat.

Kapolri memaparkan berbagai program dan strategi Polri dalam menjaga kamtibmas, termasuk penguatan intelijen, peningkatan kapasitas personel, dan modernisasi sistem dan teknologi kepolisian. Kapolri juga melaporkan capaian kinerja Polri dalam menurunkan angka kriminalitas di berbagai daerah.',
                'author' => 'Redaksi DPR',
                'is_featured' => false,
            ],
            [
                'title' => 'Delegasi DPR RI Hadiri Forum Parlemen Internasional di Geneva',
                'category' => 'Diplomasi Parlemen',
                'content' => 'Geneva - Delegasi DPR RI yang dipimpin oleh Wakil Ketua DPR menghadiri Inter-Parliamentary Union (IPU) Assembly ke-148 di Geneva, Swiss. Forum ini dihadiri oleh delegasi parlemen dari berbagai negara untuk membahas isu-isu global.

Dalam forum tersebut, delegasi DPR RI menyampaikan pandangan Indonesia terkait isu perubahan iklim, ketahanan pangan, dan kerja sama multilateral. Indonesia juga berbagi pengalaman dalam penanganan pandemi dan pemulihan ekonomi.

Wakil Ketua DPR RI menegaskan komitmen Indonesia untuk terus berkontribusi dalam menjaga perdamaian dunia dan mendorong kerja sama antar negara. "Indonesia akan terus berperan aktif dalam forum-forum internasional untuk memperjuangkan kepentingan nasional dan global," ujarnya.

Selain mengikuti sidang utama, delegasi DPR juga melakukan pertemuan bilateral dengan delegasi parlemen dari beberapa negara sahabat untuk membahas peningkatan kerja sama bilateral.',
                'author' => 'Korespondensi Luar Negeri',
                'is_featured' => true,
            ],
            [
                'title' => 'DPR RI Terima Kunjungan Kerja Mahasiswa dari Berbagai Universitas',
                'category' => 'Umum',
                'content' => 'Jakarta - Gedung DPR RI menerima kunjungan kerja dari ratusan mahasiswa yang berasal dari berbagai universitas di Indonesia. Kunjungan ini merupakan bagian dari program edukasi parlemen untuk meningkatkan pemahaman generasi muda tentang sistem demokrasi dan peran lembaga legislatif.

Para mahasiswa mendapat kesempatan untuk mengikuti simulasi sidang paripurna, berdiskusi dengan anggota DPR, dan mengunjungi berbagai fasilitas di kompleks parlemen. Mereka juga diajak untuk memahami proses legislasi dan fungsi-fungsi DPR dalam sistem ketatanegaraan Indonesia.

Ketua Badan Urusan Rumah Tangga (BURT) DPR RI menyambut baik antusiasme generasi muda untuk belajar tentang parlemen. "Kami berharap melalui kunjungan ini, para mahasiswa dapat memahami pentingnya partisipasi dalam proses demokrasi," katanya.',
                'author' => 'Humas DPR RI',
                'is_featured' => false,
            ],
        ];

        foreach ($newsData as $index => $data) {
            News::create([
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'excerpt' => Str::limit(strip_tags($data['content']), 150),
                'content' => $data['content'],
                'category' => $data['category'],
                'author' => $data['author'],
                'is_featured' => $data['is_featured'],
                'views' => rand(100, 5000),
                'published_at' => now()->subDays(rand(0, 30)),
                'created_at' => now()->subDays(rand(0, 60)),
            ]);
        }

        // Create more sample news with random data
        for ($i = 1; $i <= 20; $i++) {
            News::create([
                'title' => 'Berita DPR RI Edisi ' . $i . ' - ' . fake()->sentence(6),
                'slug' => Str::slug('Berita DPR RI Edisi ' . $i . ' ' . fake()->word()),
                'excerpt' => fake()->paragraph(2),
                'content' => fake()->paragraphs(8, true),
                'category' => $categories[array_rand($categories)],
                'author' => fake()->randomElement(['Humas DPR RI', 'Tim Liputan DPR', 'Redaksi DPR']),
                'is_featured' => fake()->boolean(20),
                'views' => rand(50, 3000),
                'published_at' => now()->subDays(rand(1, 90)),
                'created_at' => now()->subDays(rand(1, 100)),
            ]);
        }
    }
}
