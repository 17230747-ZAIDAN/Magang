# Design Guide: Portal Informasi Parlemen (Referensi: dpr.go.id)

> **Catatan penting:** Saya hanya bisa membaca **struktur dan teks** website, bukan file CSS-nya. Jadi warna, font, dan ukuran di bawah adalah **usulan desain** yang sesuai dengan karakter situs lembaga negara (resmi, bersih, terpercaya), **bukan** nilai persis dari situs asli. Kamu bebas menyesuaikan.
>
> Kalau ingin nilai persis, buka dpr.go.id di browser → klik kanan → **Inspect** → lihat tab **Styles**.

---

## 1. Prinsip Desain

1. **Resmi dan terpercaya:** tampilan rapi, tidak ramai.
2. **Informasi di depan:** pengguna harus cepat menemukan berita, anggota, dan dokumen.
3. **Mudah dibaca:** teks jelas, spasi lega, kontras tinggi.
4. **Konsisten:** komponen yang sama selalu terlihat sama.
5. **Mobile first:** rancang untuk HP dulu, baru layar besar.

---

## 2. Palet Warna (Usulan)

| Nama | Hex | Dipakai untuk |
|---|---|---|
| Primary (biru tua) | `#0B3C6F` | Header, tombol utama, judul |
| Primary terang | `#1E6BB8` | Link, hover tombol |
| Aksen (emas) | `#C9A227` | Garis hias, label, ikon penting |
| Merah LIVE | `#D62828` | Penanda siaran langsung |
| Latar utama | `#FFFFFF` | Background halaman |
| Latar abu muda | `#F4F6F9` | Section selang-seling, kartu |
| Teks utama | `#1F2933` | Isi paragraf |
| Teks sekunder | `#52606D` | Deskripsi, tanggal |
| Border | `#D9E2EC` | Garis pemisah, outline kartu |

**Aturan:** gunakan warna aksen secukupnya (maksimal 10% tampilan). Pastikan kontras teks terhadap latar minimal **4.5:1**.

### Variabel CSS siap pakai

```css
:root {
  --primary: #0B3C6F;
  --primary-light: #1E6BB8;
  --accent: #C9A227;
  --live: #D62828;
  --bg: #FFFFFF;
  --bg-soft: #F4F6F9;
  --text: #1F2933;
  --text-muted: #52606D;
  --border: #D9E2EC;
  --radius: 8px;
  --shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
}
```

---

## 3. Tipografi

| Elemen | Font | Ukuran | Berat |
|---|---|---|---|
| Judul besar (H1) | Poppins / Inter | 32–40px | 700 |
| Judul section (H2) | Poppins / Inter | 24–28px | 600 |
| Sub judul (H3) | Poppins / Inter | 18–20px | 600 |
| Isi teks | Inter / Open Sans | 16px | 400 |
| Teks kecil (tanggal, label) | Inter | 13–14px | 400 |

- **Tinggi baris (line-height):** 1.6 untuk paragraf.
- **Lebar baris:** maksimal sekitar 70 karakter agar nyaman dibaca.
- Font gratis dari **Google Fonts**, dan siapkan font cadangan: `font-family: 'Inter', Arial, sans-serif;`

---

## 4. Jarak dan Layout

**Skala jarak (kelipatan 8px):** 8, 16, 24, 32, 48, 64.

| Item | Nilai |
|---|---|
| Lebar maksimum konten | 1200px, di tengah (`margin: 0 auto`) |
| Padding samping di HP | 16px |
| Jarak antar section | 64px (desktop), 40px (HP) |
| Jarak antar kartu | 24px |

**Grid:**
- Desktop: 12 kolom
- Tablet: 8 kolom
- HP: 1 kolom (konten bertumpuk)

### Breakpoint (titik responsif)

| Perangkat | Lebar layar |
|---|---|
| HP | di bawah 640px |
| Tablet | 640px – 1023px |
| Desktop | 1024px ke atas |

---

## 5. Komponen UI

### 5.1 Header dan Navigasi
- **Baris atas (kecil):** link TV Parlemen, Kontak, pilihan bahasa (ID/EN).
- **Baris utama:** logo di kiri, menu di tengah/kanan, ikon pencarian.
- **Menu utama:** Tentang DPR RI, Kegiatan DPR RI, Profil DPR RI, Dokumen, Lainnya.
- **Mega menu:** saat menu di-hover/diklik, tampil panel berisi tautan beserta deskripsi singkat.
- **HP:** menu berubah jadi ikon hamburger (☰) yang membuka panel samping.
- Header bersifat **sticky** (tetap di atas saat scroll).

### 5.2 Kartu Layanan Cepat
- Susunan: 3 kolom × 2 baris (desktop), 2 kolom (tablet), 1 kolom (HP).
- Isi: gambar latar, judul, deskripsi singkat, tautan "Selengkapnya".
- Efek hover: naik sedikit (`transform: translateY(-4px)`) dan bayangan menebal.

```css
.card {
  background: var(--bg);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  box-shadow: var(--shadow);
  padding: 24px;
  transition: transform .2s, box-shadow .2s;
}
.card:hover {
  transform: translateY(-4px);
  box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
}
```

### 5.3 Tombol

| Jenis | Tampilan | Kegunaan |
|---|---|---|
| Primary | Latar biru tua, teks putih | Aksi utama ("Tonton Sekarang") |
| Secondary | Outline biru, teks biru | Aksi kedua ("Lihat Lengkap") |
| Link | Teks biru + garis bawah saat hover | "Selengkapnya", "Lainnya" |

```css
.btn {
  display: inline-block;
  padding: 12px 24px;
  border-radius: var(--radius);
  font-weight: 600;
  cursor: pointer;
}
.btn-primary { background: var(--primary); color: #fff; }
.btn-primary:hover { background: var(--primary-light); }
.btn-secondary { border: 2px solid var(--primary); color: var(--primary); background: transparent; }
```

### 5.4 Pemutar TV Parlemen
- Rasio video **16:9**, sudut membulat.
- Lencana **LIVE** merah di pojok kiri atas.
- Tombol "Tonton Sekarang" di bawah atau di atas video.
- Tampilkan teks "Loading TV Parlemen..." saat video belum siap.

### 5.5 Tab Tugas dan Fungsi
- Empat tab: **Legislasi, Anggaran, Pengawasan, Diplomasi Parlemen**.
- Tab aktif: garis bawah emas + teks biru tua.
- Isi tab: judul, penjelasan singkat, tombol "Lihat Lengkap", dan **angka statistik** besar (contoh: "6 RUU Selesai").
- Siapkan status "Loading data..." dan tombol "Refresh" bila data gagal dimuat.

### 5.6 Daftar Berita
- Kartu dengan gambar (rasio 16:9), judul (maks 2 baris), tanggal, ringkasan.
- Desktop 3 kolom, tablet 2 kolom, HP 1 kolom.

### 5.7 Daftar Dokumen
- Berbentuk tabel atau daftar: ikon file, judul, tanggal, tombol unduh.
- Sediakan filter dan kolom pencarian di atas daftar.

### 5.8 Footer
- Latar biru tua, teks putih.
- 3 kolom: (1) logo dan nama lembaga + media sosial, (2) kontak (telepon, email, alamat), (3) tombol App Store dan Google Play.
- Baris paling bawah: hak cipta.

### 5.9 Formulir (Aspirasi, Kunjungan)
- Label di atas input, input tinggi minimal 44px.
- Pesan error berwarna merah di bawah input yang salah.
- Tombol kirim berwarna Primary.

---

## 6. Ikon dan Gambar

- Ikon: gunakan satu set saja, misalnya **Lucide** atau **Font Awesome**.
- Logo: tampil jelas, tinggi sekitar 40–48px di header.
- Pola latar: boleh memakai pola tipis bertema peta/mandala Indonesia dengan transparansi rendah di section tertentu.
- Gambar: format **WebP**, beri atribut `alt` yang deskriptif, dan gunakan `loading="lazy"`.

---

## 7. Animasi dan Interaksi

| Elemen | Efek | Durasi |
|---|---|---|
| Hover kartu | Naik + bayangan | 200ms |
| Hover tombol | Ganti warna | 150ms |
| Mega menu | Fade in | 200ms |
| Ganti tab | Fade | 250ms |

Gunakan animasi **seperlunya**. Hormati pengguna yang mengaktifkan "reduce motion":

```css
@media (prefers-reduced-motion: reduce) {
  * { animation: none !important; transition: none !important; }
}
```

---

## 8. Aksesibilitas (Checklist)

- [ ] Kontras warna teks minimal 4.5:1
- [ ] Semua gambar punya `alt`
- [ ] Semua tombol dan link bisa diakses dengan keyboard (Tab)
- [ ] Fokus terlihat jelas (`:focus-visible`)
- [ ] Pakai tag HTML yang benar: `<header>`, `<nav>`, `<main>`, `<section>`, `<footer>`
- [ ] Urutan heading logis (H1 → H2 → H3)
- [ ] Video punya kontrol dan tidak otomatis bersuara

---

## 9. Struktur Folder yang Disarankan

```
portal-parlemen/
├── index.html
├── css/
│   ├── variables.css
│   ├── base.css
│   ├── components.css
│   └── responsive.css
├── js/
│   ├── menu.js
│   ├── tabs.js
│   └── search.js
├── images/
├── pages/
│   ├── berita.html
│   ├── anggota.html
│   └── dokumen.html
├── prd.md
└── design.md
```

---

## 10. Contoh Kerangka HTML Beranda

```html
<body>
  <header>...</header>

  <main>
    <section id="layanan-cepat">...</section>
    <section id="tv-parlemen">...</section>
    <section id="tugas-fungsi">...</section>
    <section id="berita">...</section>
    <section id="dokumen">...</section>
    <section id="agenda">...</section>
    <section id="ruang-informasi">...</section>
  </main>

  <footer>...</footer>
</body>
```

---

## 11. Tips untuk Pemula

1. Mulai dari **HP dulu** (mobile first), lalu tambahkan `@media (min-width: 1024px)`.
2. Simpan semua warna di **variabel CSS** supaya mudah diganti.
3. Buat **satu komponen dulu** (misalnya kartu), lalu pakai ulang.
4. Jangan menyalin gambar dan logo resmi DPR RI untuk dipakai di luar latihan. Ganti dengan logo dan gambar milikmu sendiri.
5. Uji di **DevTools** browser (F12 → ikon HP) untuk melihat tampilan responsif.
