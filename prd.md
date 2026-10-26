# PRD: Portal Informasi Parlemen (Referensi: dpr.go.id)

> Dokumen ini dibuat sebagai **latihan belajar** berdasarkan struktur website resmi DPR RI.
> Ini bukan dokumen resmi DPR RI. Isinya adalah hasil analisis dan penyederhanaan untuk pemula.

---

## 1. Ringkasan Produk

Sebuah portal web resmi lembaga legislatif yang memberi masyarakat akses mudah ke informasi parlemen: berita, agenda sidang, profil anggota, dokumen hukum, siaran langsung, dan kanal aspirasi.

**Nama proyek (versi latihan):** Portal Parlemen
**Bahasa:** Indonesia (dengan opsi Inggris)
**Jenis:** Website informasi publik (sebagian besar konten bersifat baca)

---

## 2. Latar Belakang dan Masalah

- Masyarakat sulit mencari informasi tentang kerja lembaga legislatif (RUU, jadwal sidang, anggota dewan).
- Dokumen hukum dan risalah rapat tersebar dan sulit ditemukan.
- Masyarakat butuh jalur resmi untuk menyampaikan aspirasi dan meminta informasi publik.

## 3. Tujuan

1. Memberi informasi lembaga yang **transparan dan mudah dicari**.
2. Memudahkan masyarakat **memantau proses pembentukan undang-undang**.
3. Menyediakan **kanal partisipasi** (aspirasi, masukan RUU, permintaan informasi).
4. Menyediakan **media** (berita, TV, radio, majalah) dalam satu tempat.

## 4. Target Pengguna

| Pengguna | Kebutuhan utama |
|---|---|
| Masyarakat umum | Baca berita, cari wakil di dewan, kirim aspirasi |
| Pelajar dan mahasiswa | Sejarah DPR, dokumen, jurnal, kunjungan edukasi |
| Peneliti dan akademisi | Risalah rapat, arsip, UU, e-Journal |
| Jurnalis | Berita, naskah pidato, jadwal sidang, kontak humas |
| Praktisi hukum | Database peraturan (UUD, UU, PP, Perpres, peraturan DPR) |

## 5. Struktur Menu (Sitemap)

```
Beranda
├── Tentang / Profil DPR RI
│   ├── Informasi Anggota DPR RI
│   ├── Alat Kelengkapan Dewan (AKD)
│   ├── Sejarah DPR RI
│   └── Sekretariat Jenderal
├── Kegiatan DPR RI
│   ├── Berita
│   ├── Media (TV Parlemen, Radio, Majalah & Buletin, Lensa Parlementaria)
│   ├── Agenda
│   ├── Fungsi Legislasi
│   ├── Fungsi Anggaran
│   ├── Fungsi Pengawasan
│   └── Diplomasi Parlemen
├── Dokumen
│   ├── Laporan Kinerja (Renstra, Laporan Kinerja)
│   ├── Persidangan Paripurna (Jadwal, Risalah, Naskah Pidato, Laporan Pansus/Panja)
│   ├── JDIH (UUD 1945, UU, PP, Perpres, Peraturan DPR, Peraturan Sekjen)
│   ├── Arsip
│   └── e-Journal
└── Lainnya
    ├── Kunjungan Edukasi
    ├── Museum DPR RI
    ├── Glosarium
    └── FAQ
```

## 6. Daftar Fitur

### 6.1 Fitur Wajib (MVP, dibuat lebih dulu)

| ID | Fitur | Deskripsi | Prioritas |
|---|---|---|---|
| F-01 | Beranda | Halaman utama berisi ringkasan semua layanan | Tinggi |
| F-02 | Menu navigasi | Menu dropdown (mega menu) dengan deskripsi singkat tiap item | Tinggi |
| F-03 | Pencarian | Kolom cari untuk berita, dokumen, anggota | Tinggi |
| F-04 | Layanan cepat | Kartu pintasan: Berita, Aspirasi, Partisipasi UU, Anggota, Informasi Publik, Risalah | Tinggi |
| F-05 | Berita | Daftar berita terkini dan halaman detail berita | Tinggi |
| F-06 | Informasi anggota | Daftar dan profil anggota dewan | Tinggi |
| F-07 | Dokumen | Daftar dokumen (risalah, UU, laporan) yang bisa dilihat dan diunduh | Tinggi |
| F-08 | Footer | Kontak, alamat, media sosial, tautan aplikasi mobile | Sedang |

### 6.2 Fitur Tambahan (tahap berikutnya)

| ID | Fitur | Deskripsi | Prioritas |
|---|---|---|---|
| F-09 | Live streaming TV Parlemen | Pemutar video siaran langsung (HLS) | Sedang |
| F-10 | Pemantauan legislasi | Status pembahasan RUU | Sedang |
| F-11 | Statistik kinerja | Angka ringkas, contoh: jumlah RUU selesai | Sedang |
| F-12 | Agenda hari ini | Kalender kegiatan dan sidang | Sedang |
| F-13 | Aspirasi masyarakat | Formulir pengiriman aspirasi | Sedang |
| F-14 | Simasleg | Sistem masukan masyarakat untuk pembentukan UU | Rendah |
| F-15 | Permintaan informasi publik | Tautan ke layanan PPID | Rendah |
| F-16 | Ganti bahasa | Indonesia / Inggris | Rendah |
| F-17 | Kunjungan edukasi | Formulir pengajuan kunjungan | Rendah |

## 7. Alur Pengguna (User Flow)

**Alur 1: Mencari wakil rakyat**
Beranda → klik kartu "Temukan Wakil Anda" → daftar anggota → pilih nama → halaman profil.

**Alur 2: Membaca berita**
Beranda → bagian "Berita Terkini" → klik berita → halaman detail.

**Alur 3: Mencari dokumen hukum**
Menu Dokumen → JDIH → pilih jenis (misal Undang-Undang) → cari → unduh.

**Alur 4: Menyampaikan aspirasi**
Beranda → kartu "Aspirasi Masyarakat" → isi formulir → kirim.

## 8. Susunan Halaman Beranda (dari atas ke bawah)

1. Header (logo, TV Parlemen, Kontak, bahasa, menu utama, pencarian)
2. Layanan cepat (6 kartu)
3. TVR Parlemen (siaran langsung)
4. DPR Bicara / Pemantauan Legislasi
5. Tugas dan fungsi DPR (tab: Legislasi, Anggaran, Pengawasan, Diplomasi) beserta statistik
6. Berita terkini
7. Dokumen terbaru dan rapat persidangan
8. Permintaan layanan informasi publik
9. Agenda hari ini dan media sosial
10. Ruang informasi (tautan ke situs terkait: Setjen, Badan Keahlian, Perpustakaan, dll.)
11. Footer (kontak, alamat, aplikasi mobile)

## 9. Kebutuhan Non-Fungsional

- **Responsif:** nyaman di HP, tablet, dan komputer.
- **Performa:** halaman dimuat cepat (gambar dioptimalkan).
- **Aksesibilitas:** teks terbaca jelas, kontras warna cukup, bisa dipakai dengan keyboard.
- **SEO:** judul, deskripsi, dan Open Graph terisi agar mudah ditemukan dan dibagikan.
- **Keamanan:** HTTPS, validasi formulir, perlindungan dari spam.
- **Bahasa:** konten utama Bahasa Indonesia.

## 10. Saran Teknologi

> Dari hasil membaca halaman, situs aslinya terlihat dibangun dengan **Next.js** (React). Untuk latihan pemula, pilih salah satu:

| Opsi | Cocok untuk | Catatan |
|---|---|---|
| HTML + CSS + JavaScript | Paling pemula | Mudah dipahami, tanpa framework |
| Laravel + MySQL | Kamu sudah pernah pakai Laravel | Cocok jika ingin ada admin dan database berita |
| Next.js | Ingin meniru stack aslinya | Butuh belajar React dulu |

**Rekomendasi:** mulai dari HTML + CSS dulu untuk halaman Beranda, lalu naik ke Laravel kalau ingin berita dan dokumen dikelola lewat database.

## 11. Di Luar Cakupan (Out of Scope)

- Sistem login anggota dewan
- Penyiaran video sungguhan (cukup tempel video contoh)
- Sinkronisasi data real-time dengan sistem DPR asli

## 12. Kriteria Berhasil

- [ ] Semua menu utama bisa diklik dan menuju halaman yang benar
- [ ] Beranda tampil rapi di HP dan komputer
- [ ] Pencarian menampilkan hasil
- [ ] Minimal 3 halaman dalam: Berita, Anggota, Dokumen
- [ ] Skor Lighthouse minimal 80 untuk performa dan aksesibilitas

## 13. Rencana Pengerjaan Bertahap

| Tahap | Pekerjaan |
|---|---|
| 1 | Buat `design.md` dan kerangka HTML Beranda |
| 2 | Header, menu, dan footer |
| 3 | Bagian layanan cepat, fungsi DPR, berita |
| 4 | Halaman daftar dan detail (berita, anggota, dokumen) |
| 5 | Pencarian dan formulir aspirasi |
| 6 | Uji di HP, perbaiki, dan rilis |
