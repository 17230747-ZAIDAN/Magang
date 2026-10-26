<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'Portal resmi DPR RI - Informasi berita, anggota dewan, dokumen legislasi, dan aspirasi masyarakat')">
    <meta name="keywords" content="@yield('meta_keywords', 'DPR RI, parlemen, legislasi, anggota dewan, berita dpr')">
    <title>@yield('title', 'Portal Parlemen') - DPR RI</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/Logo.png') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Main Stylesheet -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')
</head>
<body>
    <!-- Header -->
    <header class="header">
        <!-- Header Top -->
        <div class="header-top">
            <div class="container">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div style="display: flex; gap: 1.5rem;">
                        <a href="{{ route('media.tv') }}">
                            <i class="fas fa-tv"></i> TV Parlemen
                        </a>
                        <a href="{{ route('kontak') }}">
                            <i class="fas fa-phone"></i> Kontak
                        </a>
                    </div>
                    <div>
                        <a href="#" onclick="alert('Bahasa Indonesia aktif')">ID</a> | 
                        <a href="#" onclick="alert('English version coming soon')">EN</a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Header Main -->
        <div class="header-main">
            <div class="container">
                <div class="header-content">
                    <!-- Logo -->
                    <a href="{{ route('beranda') }}" class="logo">
                        <img src="{{ asset('images/Logo.png') }}" alt="Logo DPR RI">
                        <div class="logo-text">
                            <h1>Dewan Perwakilan Rakyat</h1>
                            <p>Republik Indonesia</p>
                        </div>
                    </a>
                    
                    <!-- Navigation -->
                    <nav class="nav-main">
                        <button class="menu-toggle" id="menuToggle">
                            <i class="fas fa-bars"></i>
                        </button>
                        
                        <ul class="nav-menu" id="navMenu">
                            <li class="nav-item">
                                <a href="{{ route('beranda') }}" class="nav-link {{ request()->routeIs('beranda') ? 'active' : '' }}">Beranda</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Tentang DPR RI</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Kegiatan DPR RI</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('anggota.index') }}" class="nav-link {{ request()->routeIs('anggota.*') ? 'active' : '' }}">Anggota</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('berita.index') }}" class="nav-link {{ request()->routeIs('berita.*') ? 'active' : '' }}">Berita</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dokumen.index') }}" class="nav-link {{ request()->routeIs('dokumen.*') ? 'active' : '' }}">Dokumen</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Lainnya</a>
                            </li>
                        </ul>
                        
                        <!-- Search Box -->
                        <form action="{{ route('search') }}" method="GET" class="search-box">
                            <input type="text" name="q" class="search-input" placeholder="Cari..." value="{{ request('q') }}">
                            <button type="submit" class="search-btn">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <!-- About Section -->
                <div class="footer-section">
                    <h3>Dewan Perwakilan Rakyat RI</h3>
                    <p>Lembaga negara yang memegang kekuasaan membentuk undang-undang, fungsi anggaran, dan fungsi pengawasan.</p>
                    <div class="social-links">
                        <a href="#" class="social-link" aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="YouTube">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Contact Section -->
                <div class="footer-section">
                    <h3>Kontak</h3>
                    <ul>
                        <li><i class="fas fa-map-marker-alt"></i> Jl. Gatot Subroto, Jakarta Pusat 10270</li>
                        <li><i class="fas fa-phone"></i> (021) 5715.409</li>
                        <li><i class="fas fa-fax"></i> (021) 5715.245</li>
                        <li><i class="fas fa-envelope"></i> humas@dpr.go.id</li>
                    </ul>
                </div>
                
                <!-- Quick Links -->
                <div class="footer-section">
                    <h3>Tautan Cepat</h3>
                    <ul>
                        <li><a href="{{ route('berita.index') }}">Berita Terkini</a></li>
                        <li><a href="{{ route('anggota.index') }}">Anggota DPR RI</a></li>
                        <li><a href="{{ route('dokumen.jdih') }}">JDIH</a></li>
                        <li><a href="{{ route('aspirasi.create') }}">Aspirasi Masyarakat</a></li>
                        <li><a href="{{ route('kontak') }}">Hubungi Kami</a></li>
                    </ul>
                </div>
                
                <!-- Apps Section -->
                <div class="footer-section">
                    <h3>Aplikasi Mobile</h3>
                    <p>Unduh aplikasi DPR RI untuk akses lebih mudah</p>
                    <div style="display: flex; flex-direction: column; gap: 0.5rem; margin-top: 1rem;">
                        <a href="#" style="display: inline-block;">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg" alt="Get it on Google Play" style="height: 40px;">
                        </a>
                        <a href="#" style="display: inline-block;">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/3/3c/Download_on_the_App_Store_Badge.svg" alt="Download on the App Store" style="height: 40px;">
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <p>&copy; 2026 Dewan Perwakilan Rakyat Republik Indonesia. Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Mobile Menu Toggle
        const menuToggle = document.getElementById('menuToggle');
        const navMenu = document.getElementById('navMenu');
        
        if (menuToggle) {
            menuToggle.addEventListener('click', function() {
                navMenu.style.display = navMenu.style.display === 'flex' ? 'none' : 'flex';
            });
        }
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.nav-main')) {
                if (window.innerWidth < 1024) {
                    navMenu.style.display = 'none';
                }
            }
        });
        
        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                navMenu.style.display = 'flex';
            } else {
                navMenu.style.display = 'none';
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>