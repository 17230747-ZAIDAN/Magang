<!-- Lokasi: resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Instansi</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome untuk Ikon Media Sosial dan Kontak -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Kustomisasi warna aksen seperti di gambar referensi (merah keunguan) */
        .text-accent { color: #b00045; }
        .bg-dark-footer { background-color: #160a12; }
        .footer-link { color: #d1d1d1; text-decoration: none; }
        .footer-link:hover { color: #ffffff; }
        .social-icon-box {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 40px;
            height: 40px;
            border: 1px solid #b00045;
            border-radius: 5px;
            color: #b00045;
            transition: all 0.3s;
        }
        .social-icon-box:hover {
            background-color: #b00045;
            color: white;
        }
    </style>
</head>
<body class="bg-light">

    <!-- HEADER (Sesuai Referensi Gambar 1) -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom py-2 sticky-top">
        <div class="container">
            <!-- Logo dan Nama Instansi -->
            <a class="navbar-brand d-flex align-items-center" href="/">
                <!-- Ganti src dengan logo instansi yang sebenarnya -->
                <img src="{{ asset('images/logo.png') }}"  alt="Logo" width="40" class="me-2">
                <div style="line-height: 1.2;">
                    <span class="d-block fw-bold" style="font-size: 14px;">DPRD</span>
                    <span class="d-block text-muted" style="font-size: 11px;">Kota Tangerang Selatan</span>
                </div>
            </a>
            
            <!-- Tombol Hamburger Menu untuk Mobile -->
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto fw-semibold">
                    <li class="nav-item"><a class="nav-link text-dark" href="/">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="#">Berita</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="#">Jadwal</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="#">Profil</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="#">Galeri</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- KONTEN UTAMA DINAMIS (Halaman Beranda dll akan masuk di sini) -->
    <main style="min-height: 50vh;">
        @yield('content')
    </main>

    <!-- BAGIAN MEDIA SOSIAL (Sesuai Referensi Gambar 2) -->
    <section class="bg-white border-top pt-4 pb-3 mt-5">
        <div class="container">
            <h6 class="text-uppercase fw-bold text-accent mb-3 border-bottom pb-2">Media Sosial Instansi</h6>
            <div class="d-flex justify-content-around text-center mt-3">
                <a href="https://www.facebook.com/share/1J4U6PB2gA/" target="_blank" rel="noopener noreferrer" class="social-icon-box">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://instagram.com/dprdtangselkota?cplk=ZndqeG51d3dzbjky" target="_blank" rel="noopener noreferrer" class="social-icon-box">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://x.com/dprdtangselkota" target="_blank" rel="noopener noreferrer" class="social-icon-box">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="https://youtube.com/@dprdtangerangselatan?si=4IozaipKzvcaxDaM" target="_blank" rel="noopener noreferrer" class="social-icon-box">
                    <i class="fab fa-youtube"></i>
                </a>
                <a href="https://www.tiktok.com/@dprdtangerangselatan" target="_blank" rel="noopener noreferrer" class="social-icon-box">
                    <i class="fab fa-tiktok"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- FOOTER GELAP (Sesuai Referensi Gambar 2) -->
    <footer class="bg-dark-footer text-white pt-5 pb-3">
        <div class="container">
            <div class="row">
                <!-- Kontak -->
                <div class="col-md-6 mb-4">
                    <h6 class="fw-bold mb-4">Kontak</h6>
                    <ul class="list-unstyled footer-link" style="font-size: 14px; line-height: 2;">
                        <li><i class="fas fa-phone me-3"></i> 021-1234567</li>
                        <li><i class="fas fa-fax me-3"></i> 021-7654321</li>
                        <li><i class="fas fa-envelope me-3"></i> humas@instansikita.go.id</li>
                        <li><i class="fas fa-map-marker-alt me-3"></i> Jl. Raya Serpong No.1, Setu, Kec. Setu, Kota Tangerang Selatan, Banten 15314</li>
                    </ul>
                </div>

                <!-- Web Lainnya / Link Terkait -->
                <div class="col-md-6 mb-4">
                    <h6 class="fw-bold mb-4">Web Lainnya</h6>
                    <ul class="list-unstyled" style="font-size: 14px; line-height: 2;">
                        <li><a href="#" class="footer-link"><i class="fas fa-building me-2"></i> Sekretariat Jenderal</a></li>
                        <li><a href="#" class="footer-link"><i class="fas fa-users me-2"></i> Badan Keahlian</a></li>
                        <li><a href="#" class="footer-link"><i class="fas fa-gavel me-2"></i> Inspektorat Utama</a></li>
                    </ul>
                </div>
            </div>

            <hr style="border-color: rgba(255,255,255,0.1);">

            <!-- Copyright & Ikon Kecil -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center" style="font-size: 12px; color: #a0a0a0;">
                <div class="mb-2 mb-md-0 d-flex align-items-center">
                    <img src="{{ asset('images/logo.png') }}" width="20" class="me-2" alt="Logo">
                    &copy; 2026 DPRD Kota Tangerang Selatan. All rights reserved.
                </div>
                <div>
                    <a href="https://www.facebook.com/share/1J4U6PB2gA/" target="_blank" rel="noopener noreferrer" class="text-white me-3">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                     <a href="https://instagram.com/dprdtangselkota?cplk=ZndqeG51d3dzbjky" target="_blank" rel="noopener noreferrer" class="text-white me-3">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://x.com/dprdtangselkota" target="_blank" rel="noopener noreferrer" class="text-white me-3">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://youtube.com/@dprdtangerangselatan?si=4IozaipKzvcaxDaM" target="_blank" rel="noopener noreferrer" class="text-white me-3">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="https://www.tiktok.com/@dprdtangerangselatan" target="_blank" rel="noopener noreferrer" class="text-white">
                        <i class="fab fa-tiktok"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>