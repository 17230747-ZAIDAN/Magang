@extends('v_admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="page-header">
    <div>
        <h1>Dashboard Ringkasan</h1>
        <p>Selamat datang di panel manajemen portal DPRD Kota Tangerang Selatan.</p>
    </div>
    <div style="display: flex; gap: 0.5rem;">
        @if(Auth::user()->isAdmin())
        <a href="{{ route('admin.magang.create') }}" class="btn btn-secondary">
            <i class="fas fa-user-graduate"></i> Tambah Akun Magang
        </a>
        @endif
        <a href="{{ route('admin.berita.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Berita
        </a>
        <a href="{{ route('admin.anggota.create') }}" class="btn btn-accent">
            <i class="fas fa-user-plus"></i> Tambah Anggota
        </a>
    </div>
</div>

@if(Auth::user()->isMagang())
<div class="alert" style="background: #EFF6FF; border: 1px solid #BFDBFE; color: #1E40AF; margin-bottom: 1.5rem;">
    <i class="fas fa-graduation-cap" style="font-size: 1.5rem;"></i>
    <div>
        <strong>Halo, {{ Auth::user()->name }} (Peserta Magang)!</strong>
        <div style="font-size: 0.82rem; margin-top: 0.2rem;">
            Asal Instansi: <strong>{{ Auth::user()->institution ?? '-' }}</strong> &bull; Periode: <strong>{{ Auth::user()->internship_period ?? '-' }}</strong>. Anda memiliki akses untuk mengunggah Berita, Galeri Foto Kegiatan, Dokumen, dan Agenda Sidang Dewan.
        </div>
    </div>
</div>
@endif

<!-- Stat Cards -->
<div class="grid grid-cols-4" style="margin-bottom: 1.5rem;">
    <div class="card" style="padding: 1.25rem; display: flex; align-items: center; gap: 1rem;">
        <div style="width: 50px; height: 50px; border-radius: 10px; background: #E1EFFE; color: #1E429F; display: flex; align-items: center; justify-content: center; font-size: 1.4rem;">
            <i class="fas fa-newspaper"></i>
        </div>
        <div>
            <div style="font-size: 0.8rem; color: var(--adm-text-muted); font-weight: 600;">TOTAL BERITA</div>
            <div style="font-size: 1.45rem; font-weight: 700; color: var(--adm-primary);">{{ $stats['total_news'] }}</div>
        </div>
    </div>

    <div class="card" style="padding: 1.25rem; display: flex; align-items: center; gap: 1rem;">
        <div style="width: 50px; height: 50px; border-radius: 10px; background: #DEF7EC; color: #03543F; display: flex; align-items: center; justify-content: center; font-size: 1.4rem;">
            <i class="fas fa-users"></i>
        </div>
        <div>
            <div style="font-size: 0.8rem; color: var(--adm-text-muted); font-weight: 600;">ANGGOTA DEWAN</div>
            <div style="font-size: 1.45rem; font-weight: 700; color: var(--adm-primary);">{{ $stats['total_members'] }}</div>
        </div>
    </div>

    <div class="card" style="padding: 1.25rem; display: flex; align-items: center; gap: 1rem;">
        <div style="width: 50px; height: 50px; border-radius: 10px; background: #FEF3C7; color: #92400E; display: flex; align-items: center; justify-content: center; font-size: 1.4rem;">
            <i class="fas fa-file-contract"></i>
        </div>
        <div>
            <div style="font-size: 0.8rem; color: var(--adm-text-muted); font-weight: 600;">DOKUMEN & JDIH</div>
            <div style="font-size: 1.45rem; font-weight: 700; color: var(--adm-primary);">{{ $stats['total_documents'] }}</div>
        </div>
    </div>

    <div class="card" style="padding: 1.25rem; display: flex; align-items: center; gap: 1rem;">
        <div style="width: 50px; height: 50px; border-radius: 10px; background: #FDE8E8; color: #9B1C1C; display: flex; align-items: center; justify-content: center; font-size: 1.4rem;">
            <i class="fas fa-comments"></i>
        </div>
        <div>
            <div style="font-size: 0.8rem; color: var(--adm-text-muted); font-weight: 600;">ASPIRASI (PENDING)</div>
            <div style="font-size: 1.45rem; font-weight: 700; color: var(--adm-danger);">
                {{ $stats['pending_aspirations'] }} <span style="font-size: 0.85rem; font-weight: normal; color: var(--adm-text-muted);">/ {{ $stats['total_aspirations'] }}</span>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-2">
    <!-- Recent News Table -->
    <div class="card">
        <div class="card-header">
            <h3>Berita Terkini</h3>
            <a href="{{ route('admin.berita.index') }}" class="btn btn-sm btn-outline">Lihat Semua</a>
        </div>
        <div class="card-body" style="padding: 0;">
            <div class="table-responsive">
                <table class="adm-table">
                    <thead>
                        <tr>
                            <th>Judul Berita</th>
                            <th>Kategori</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentNews as $news)
                        <tr>
                            <td>
                                <a href="{{ route('admin.berita.edit', $news->id) }}" style="color: var(--adm-primary); font-weight: 600; text-decoration: none;">
                                    {{ Str::limit($news->title, 40) }}
                                </a>
                            </td>
                            <td><span class="badge badge-info">{{ $news->category }}</span></td>
                            <td style="color: var(--adm-text-muted); font-size: 0.8rem;">
                                {{ $news->created_at ? $news->created_at->format('d/m/Y') : '-' }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" style="text-align: center; color: var(--adm-text-muted);">Belum ada berita.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Recent Aspirations Table -->
    <div class="card">
        <div class="card-header">
            <h3>Aspirasi Masuk Terbaru</h3>
            <a href="{{ route('admin.aspirasi.index') }}" class="btn btn-sm btn-outline">Lihat Semua</a>
        </div>
        <div class="card-body" style="padding: 0;">
            <div class="table-responsive">
                <table class="adm-table">
                    <thead>
                        <tr>
                            <th>Pengirim</th>
                            <th>Subjek</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentAspirations as $asp)
                        <tr>
                            <td>
                                <div style="font-weight: 600;">{{ $asp->name }}</div>
                                <div style="font-size: 0.75rem; color: var(--adm-text-muted);">{{ $asp->email }}</div>
                            </td>
                            <td>
                                <a href="{{ route('admin.aspirasi.show', $asp->id) }}" style="color: var(--adm-primary); font-weight: 500; text-decoration: none;">
                                    {{ Str::limit($asp->subject, 30) }}
                                </a>
                            </td>
                            <td>
                                @if($asp->status === 'pending')
                                    <span class="badge badge-warning">Menunggu</span>
                                @elseif($asp->status === 'reviewed')
                                    <span class="badge badge-info">Ditinjau</span>
                                @else
                                    <span class="badge badge-success">Dibalas</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" style="text-align: center; color: var(--adm-text-muted);">Belum ada aspirasi masuk.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
