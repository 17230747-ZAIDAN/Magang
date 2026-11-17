<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - DPRD Tangsel</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --adm-primary: #0F2A4A;
            --adm-primary-light: #1A3E6B;
            --adm-accent: #C9A227;
            --adm-accent-hover: #b38e1f;
            --adm-bg: #F4F6F9;
            --adm-card-bg: #FFFFFF;
            --adm-text: #2D3748;
            --adm-text-muted: #718096;
            --adm-border: #E2E8F0;
            --adm-success: #10B981;
            --adm-warning: #F59E0B;
            --adm-danger: #EF4444;
            --adm-info: #3B82F6;
            --adm-sidebar-w: 260px;
            --adm-radius: 10px;
            --adm-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: var(--adm-bg);
            color: var(--adm-text);
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .admin-sidebar {
            width: var(--adm-sidebar-w);
            background: var(--adm-primary);
            color: #fff;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .sidebar-brand {
            padding: 1.5rem 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-brand img {
            width: 38px;
            height: 38px;
            object-fit: contain;
        }

        .sidebar-brand-text h2 {
            font-size: 1.05rem;
            font-weight: 700;
            letter-spacing: -0.3px;
        }

        .sidebar-brand-text p {
            font-size: 0.75rem;
            color: var(--adm-accent);
            text-transform: uppercase;
            font-weight: 600;
        }

        .sidebar-menu {
            list-style: none;
            padding: 1rem 0.75rem;
            flex: 1;
            overflow-y: auto;
        }

        .menu-title {
            font-size: 0.7rem;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.4);
            font-weight: 700;
            padding: 0.75rem 0.75rem 0.25rem;
            letter-spacing: 0.5px;
        }

        .menu-item {
            margin-bottom: 0.25rem;
        }

        .menu-link {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            padding: 0.75rem 0.85rem;
            color: rgba(255, 255, 255, 0.75);
            text-decoration: none;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .menu-link:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.08);
        }

        .menu-link.active {
            color: #fff;
            background: var(--adm-primary-light);
            border-left: 4px solid var(--adm-accent);
            font-weight: 600;
        }

        .menu-link i {
            width: 20px;
            text-align: center;
            font-size: 1rem;
        }

        .menu-badge {
            margin-left: auto;
            background: var(--adm-danger);
            color: #fff;
            font-size: 0.7rem;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 10px;
        }

        /* Main Content */
        .admin-main {
            margin-left: var(--adm-sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        /* Topbar */
        .admin-topbar {
            height: 65px;
            background: #fff;
            border-bottom: 1px solid var(--adm-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.75rem;
            position: sticky;
            top: 0;
            z-index: 99;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .sidebar-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.25rem;
            cursor: pointer;
            color: var(--adm-text);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 1.25rem;
        }

        .user-dropdown {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: var(--adm-primary);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.95rem;
        }

        .user-info .name {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--adm-text);
        }

        .user-info .role {
            font-size: 0.75rem;
            color: var(--adm-text-muted);
        }

        /* Page Body */
        .admin-content {
            padding: 1.75rem;
            flex: 1;
        }

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .page-header h1 {
            font-size: 1.45rem;
            font-weight: 700;
            color: var(--adm-primary);
        }

        .page-header p {
            font-size: 0.85rem;
            color: var(--adm-text-muted);
            margin-top: 2px;
        }

        /* Cards */
        .card {
            background: #fff;
            border-radius: var(--adm-radius);
            border: 1px solid var(--adm-border);
            box-shadow: var(--adm-shadow);
            margin-bottom: 1.5rem;
            overflow: hidden;
        }

        .card-header {
            padding: 1.15rem 1.35rem;
            border-bottom: 1px solid var(--adm-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #fff;
        }

        .card-header h2, .card-header h3 {
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--adm-primary);
        }

        .card-body {
            padding: 1.35rem;
        }

        /* Grid System */
        .grid {
            display: grid;
            gap: 1.25rem;
        }

        .grid-cols-4 { grid-template-columns: repeat(4, 1fr); }
        .grid-cols-3 { grid-template-columns: repeat(3, 1fr); }
        .grid-cols-2 { grid-template-columns: repeat(2, 1fr); }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.1rem;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            border: 1px solid transparent;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-sm {
            padding: 0.35rem 0.75rem;
            font-size: 0.78rem;
        }

        .btn-primary {
            background: var(--adm-primary);
            color: #fff;
        }
        .btn-primary:hover { background: var(--adm-primary-light); }

        .btn-accent {
            background: var(--adm-accent);
            color: #fff;
        }
        .btn-accent:hover { background: var(--adm-accent-hover); }

        .btn-success { background: var(--adm-success); color: #fff; }
        .btn-danger { background: var(--adm-danger); color: #fff; }
        .btn-secondary { background: #E2E8F0; color: #4A5568; }
        .btn-secondary:hover { background: #CBD5E0; }

        .btn-outline {
            background: transparent;
            border-color: var(--adm-border);
            color: var(--adm-text);
        }
        .btn-outline:hover { background: #F7FAFC; }

        /* Tables */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        table.adm-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 0.875rem;
        }

        table.adm-table th {
            background: #F8FAFC;
            color: #64748B;
            font-weight: 600;
            padding: 0.85rem 1rem;
            border-bottom: 1px solid var(--adm-border);
            text-transform: uppercase;
            font-size: 0.72rem;
            letter-spacing: 0.5px;
        }

        table.adm-table td {
            padding: 0.95rem 1rem;
            border-bottom: 1px solid var(--adm-border);
            vertical-align: middle;
        }

        table.adm-table tr:hover td {
            background-color: #F8FAFC;
        }

        /* Badges */
        .badge {
            display: inline-block;
            padding: 0.25rem 0.6rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-success { background: #DEF7EC; color: #03543F; }
        .badge-warning { background: #FEF3C7; color: #92400E; }
        .badge-danger { background: #FDE8E8; color: #9B1C1C; }
        .badge-info { background: #E1EFFE; color: #1E429F; }

        /* Forms */
        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.45rem;
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--adm-text);
        }

        .form-control {
            width: 100%;
            padding: 0.65rem 0.95rem;
            border: 1px solid var(--adm-border);
            border-radius: 8px;
            font-size: 0.875rem;
            outline: none;
            transition: border-color 0.2s ease;
            background: #fff;
        }

        .form-control:focus {
            border-color: var(--adm-primary-light);
            box-shadow: 0 0 0 3px rgba(26, 62, 107, 0.1);
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .form-text {
            font-size: 0.75rem;
            color: var(--adm-text-muted);
            margin-top: 0.35rem;
        }

        /* Alerts */
        .alert {
            padding: 0.95rem 1.25rem;
            border-radius: 8px;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.875rem;
        }

        .alert-success { background: #DEF7EC; color: #03543F; border: 1px solid #BCF0DA; }
        .alert-danger { background: #FDE8E8; color: #9B1C1C; border: 1px solid #FBD5D5; }

        /* Responsive */
        @media (max-width: 992px) {
            .admin-sidebar {
                left: calc(-1 * var(--adm-sidebar-w));
            }
            .admin-sidebar.show {
                left: 0;
            }
            .admin-main {
                margin-left: 0;
            }
            .sidebar-toggle {
                display: block;
            }
            .grid-cols-4, .grid-cols-3 {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .grid-cols-4, .grid-cols-3, .grid-cols-2 {
                grid-template-columns: 1fr;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Sidebar -->
    <aside class="admin-sidebar" id="adminSidebar">
        <div class="sidebar-brand">
            <img src="{{ asset('images/Logo.png') }}" alt="Logo">
            <div class="sidebar-brand-text">
                <h2>Admin DPRD</h2>
                <p>Tangsel Portal</p>
            </div>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-title">Utama</li>
            <li class="menu-item">
                <a href="{{ route('admin.dashboard') }}" class="menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-gauge"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="menu-title">Konten & Publikasi</li>
            <li class="menu-item">
                <a href="{{ route('admin.berita.index') }}" class="menu-link {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
                    <i class="fas fa-newspaper"></i>
                    <span>Berita Dewan</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('admin.anggota.index') }}" class="menu-link {{ request()->routeIs('admin.anggota.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    <span>Anggota Dewan</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('admin.galeri.index') }}" class="menu-link {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}">
                    <i class="fas fa-images"></i>
                    <span>Galeri Kegiatan</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('admin.dokumen.index') }}" class="menu-link {{ request()->routeIs('admin.dokumen.*') ? 'active' : '' }}">
                    <i class="fas fa-file-contract"></i>
                    <span>Dokumen & JDIH</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('admin.agenda.index') }}" class="menu-link {{ request()->routeIs('admin.agenda.*') ? 'active' : '' }}">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Agenda Sidang</span>
                </a>
            </li>

            <li class="menu-title">Layanan Publik</li>
            <li class="menu-item">
                <a href="{{ route('admin.aspirasi.index') }}" class="menu-link {{ request()->routeIs('admin.aspirasi.*') ? 'active' : '' }}">
                    <i class="fas fa-comments"></i>
                    <span>Aspirasi Warga</span>
                </a>
            </li>

            @if(Auth::check() && Auth::user()->isAdmin())
            <li class="menu-title">Pengaturan Sistem</li>
            <li class="menu-item">
                <a href="{{ route('admin.magang.index') }}" class="menu-link {{ request()->routeIs('admin.magang.*') ? 'active' : '' }}">
                    <i class="fas fa-user-graduate"></i>
                    <span>Akun Magang</span>
                </a>
            </li>
            @endif

            <li class="menu-title">Akun & Keamanan</li>
            <li class="menu-item">
                <a href="{{ route('admin.password') }}" class="menu-link {{ request()->routeIs('admin.password') ? 'active' : '' }}">
                    <i class="fas fa-key"></i>
                    <span>Ganti Password</span>
                </a>
            </li>

            <li class="menu-title">Navigasi Luar</li>
            <li class="menu-item">
                <a href="{{ route('beranda') }}" target="_blank" class="menu-link">
                    <i class="fas fa-external-link-alt"></i>
                    <span>Lihat Web Publik</span>
                </a>
            </li>
        </ul>
    </aside>

    <!-- Main Content Area -->
    <div class="admin-main">
        <!-- Topbar -->
        <header class="admin-topbar">
            <div class="topbar-left">
                <button class="sidebar-toggle" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <div style="font-size: 0.85rem; color: var(--adm-text-muted);">
                    <i class="far fa-clock"></i> {{ now()->translatedFormat('l, d F Y') }}
                </div>
            </div>

            <div class="topbar-right">
                <div class="user-dropdown">
                    <div class="user-avatar" title="{{ Auth::user()->name }}">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="user-info">
                        <div class="name">{{ Auth::user()->name ?? 'Admin' }}</div>
                        <div class="role">{{ Auth::user()->role_name ?? 'Administrator' }}</div>
                    </div>
                    <div style="display: flex; gap: 0.4rem; margin-left: 0.75rem;">
                        <a href="{{ route('admin.password') }}" class="btn btn-sm btn-outline" title="Ganti Password">
                            <i class="fas fa-key"></i> Ganti Password
                        </a>
                        <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger" title="Keluar">
                                <i class="fas fa-sign-out-alt"></i> Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="admin-content">
            @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <div>{{ session('success') }}</div>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <div>{{ session('error') }}</div>
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i>
                <div>
                    <strong>Mohon periksa kembali input Anda:</strong>
                    <ul style="margin-top: 0.25rem; margin-left: 1.25rem;">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script>
        const toggleBtn = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('adminSidebar');
        if (toggleBtn && sidebar) {
            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('show');
            });
        }
    </script>
    @stack('scripts')
</body>
</html>
