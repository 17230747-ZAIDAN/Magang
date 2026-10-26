@extends('v_layouts.app')

@section('title', 'JDIH - Jaringan Dokumentasi dan Informasi Hukum')
@section('meta_description', 'Database peraturan perundang-undangan Indonesia: UUD 1945, UU, PP, Perpres, dan Peraturan DPR RI')

@section('content')

<!-- Page Header -->
<section style="background: linear-gradient(135deg, var(--accent) 0%, #e0b830 100%); padding: 4rem 0; color: white;">
    <div class="container">
        <div style="text-align: center;">
            <div style="font-size: 4rem; margin-bottom: 1rem; opacity: 0.9;">
                <i class="fas fa-gavel"></i>
            </div>
            <h1 style="color: white; margin-bottom: 0.5rem;">JDIH DPR RI</h1>
            <p style="color: rgba(0,0,0,0.7); font-size: 1.125rem; font-weight: 500;">Jaringan Dokumentasi dan Informasi Hukum</p>
            <p style="color: rgba(0,0,0,0.6); max-width: 600px; margin: 1rem auto 0;">
                Database lengkap peraturan perundang-undangan Republik Indonesia
            </p>
        </div>
    </div>
</section>

<!-- Filter & Search Section -->
<section class="pt-4 pb-4 bg-soft">
    <div class="container">
        <form action="{{ route('dokumen.jdih') }}" method="GET">
            <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                <!-- Search -->
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500; font-size: 0.875rem;">Cari Peraturan</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Judul atau nomor peraturan..." style="width: 100%; padding: 0.625rem 1rem; border: 1px solid var(--border); border-radius: var(--radius); font-size: 0.875rem;">
                </div>
                
                <!-- Type Filter -->
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500; font-size: 0.875rem;">Jenis Peraturan</label>
                    <select name="type" style="width: 100%; padding: 0.625rem 1rem; border: 1px solid var(--border); border-radius: var(--radius); font-size: 0.875rem;">
                        <option value="">Semua Jenis</option>
                        @foreach($legalTypes as $type)
                        <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Year Filter -->
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500; font-size: 0.875rem;">Tahun</label>
                    <select name="year" style="width: 100%; padding: 0.625rem 1rem; border: 1px solid var(--border); border-radius: var(--radius); font-size: 0.875rem;">
                        <option value="">Semua Tahun</option>
                        @foreach($years as $year)
                        <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div style="display: flex; gap: 0.75rem;">
                <button type="submit" class="btn btn-accent">
                    <i class="fas fa-search"></i> Filter
                </button>
                @if(request()->hasAny(['search', 'type', 'year']))
                <a href="{{ route('dokumen.jdih') }}" class="btn btn-secondary">
                    <i class="fas fa-redo"></i> Reset
                </a>
                @endif
            </div>
        </form>
    </div>
</section>

<!-- Legal Types Categories -->
<section class="pt-6 pb-4">
    <div class="container">
        <h3 class="text-center mb-4">Jenis Peraturan</h3>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem; margin-bottom: 3rem;">
            @foreach($legalTypes as $type)
            <a href="{{ route('dokumen.jdih', ['type' => $type]) }}" class="card {{ request('type') == $type ? 'active-type' : '' }}" style="text-decoration: none; transition: all 0.2s;">
                <div class="card-body text-center" style="padding: 1.5rem 1rem;">
                    <div style="font-size: 2rem; color: var(--accent); margin-bottom: 0.5rem;">
                        <i class="fas fa-balance-scale"></i>
                    </div>
                    <h4 style="font-size: 0.9375rem; margin: 0; font-weight: 600;">{{ $type }}</h4>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Documents List Section -->
<section class="pb-8">
    <div class="container">
        @if($documents->count() > 0)
            <!-- Results Info -->
            <div style="margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center;">
                <div style="color: var(--text-muted);">
                    Menampilkan {{ $documents->firstItem() }} - {{ $documents->lastItem() }} dari {{ $documents->total() }} peraturan
                </div>
            </div>
            
            <!-- Documents Table -->
            <div style="background: white; border-radius: var(--radius); overflow: hidden; box-shadow: var(--shadow);">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: var(--bg-soft);">
                            <th style="padding: 1rem; text-align: left; font-weight: 600; border-bottom: 2px solid var(--border);">Jenis</th>
                            <th style="padding: 1rem; text-align: left; font-weight: 600; border-bottom: 2px solid var(--border);">Nomor</th>
                            <th style="padding: 1rem; text-align: left; font-weight: 600; border-bottom: 2px solid var(--border);">Tentang</th>
                            <th style="padding: 1rem; text-align: center; font-weight: 600; border-bottom: 2px solid var(--border); width: 100px;">Tahun</th>
                            <th style="padding: 1rem; text-align: center; font-weight: 600; border-bottom: 2px solid var(--border); width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($documents as $index => $document)
                        <tr style="{{ $index % 2 == 0 ? '' : 'background: var(--bg-soft);' }}">
                            <td style="padding: 1rem; border-bottom: 1px solid var(--border-light);">
                                <span class="badge badge-accent">{{ $document->type }}</span>
                            </td>
                            <td style="padding: 1rem; border-bottom: 1px solid var(--border-light); font-weight: 500;">
                                {{ $document->number ?? '-' }}
                            </td>
                            <td style="padding: 1rem; border-bottom: 1px solid var(--border-light);">
                                <a href="{{ route('dokumen.show', $document->slug) }}" style="color: var(--text); text-decoration: none; font-weight: 500;">
                                    {{ $document->title }}
                                </a>
                                @if($document->description)
                                <p style="font-size: 0.875rem; color: var(--text-muted); margin: 0.25rem 0 0 0;">
                                    {{ Str::limit($document->description, 100) }}
                                </p>
                                @endif
                            </td>
                            <td style="padding: 1rem; border-bottom: 1px solid var(--border-light); text-align: center; font-weight: 600;">
                                {{ $document->year ?? '-' }}
                            </td>
                            <td style="padding: 1rem; border-bottom: 1px solid var(--border-light); text-align: center;">
                                <div style="display: flex; gap: 0.5rem; justify-content: center;">
                                    <a href="{{ route('dokumen.show', $document->slug) }}" class="btn btn-sm btn-secondary" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if($document->download_url)
                                    <a href="{{ route('dokumen.download', $document->slug) }}" class="btn btn-sm btn-accent" title="Unduh">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div style="display: flex; justify-content: center; margin-top: 2rem;">
                {{ $documents->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div style="text-align: center; padding: 4rem 0; color: var(--text-muted);">
                <i class="fas fa-gavel" style="font-size: 5rem; opacity: 0.3; margin-bottom: 1.5rem;"></i>
                <h3>Tidak Ada Peraturan Ditemukan</h3>
                <p>Coba ubah filter atau kata kunci pencarian Anda</p>
                <a href="{{ route('dokumen.jdih') }}" class="btn btn-accent" style="margin-top: 1rem;">Tampilkan Semua Peraturan</a>
            </div>
        @endif
    </div>
</section>

<!-- Info Section -->
<section class="bg-soft pt-6 pb-6">
    <div class="container">
        <div style="max-width: 800px; margin: 0 auto; text-align: center;">
            <h3 style="margin-bottom: 1rem;">Tentang JDIH</h3>
            <p style="color: var(--text-muted); line-height: 1.8;">
                Jaringan Dokumentasi dan Informasi Hukum (JDIH) merupakan wadah pendayagunaan bersama atas dokumen hukum 
                secara tertib, terpadu, dan berkesinambungan, serta merupakan sarana pemberian pelayanan informasi hukum 
                secara lengkap, akurat, mudah, dan cepat.
            </p>
            <div style="display: flex; justify-content: center; gap: 1rem; margin-top: 2rem;">
                <a href="{{ route('dokumen.index') }}" class="btn btn-secondary">
                    <i class="fas fa-file-alt"></i> Semua Dokumen
                </a>
                <a href="{{ route('kontak') }}" class="btn btn-primary">
                    <i class="fas fa-envelope"></i> Hubungi Kami
                </a>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
/* Active type card */
.active-type {
    border-color: var(--accent) !important;
    background: linear-gradient(to bottom, rgba(201, 162, 39, 0.05), white) !important;
}

/* Pagination styling */
.pagination {
    display: flex;
    list-style: none;
    gap: 0.5rem;
    padding: 0;
    margin: 0;
}

.pagination li a,
.pagination li span {
    display: block;
    padding: 0.5rem 0.75rem;
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    color: var(--text);
    text-decoration: none;
    transition: all 0.2s ease;
}

.pagination li a:hover {
    background: var(--bg-soft);
    border-color: var(--accent);
    color: var(--accent);
}

.pagination li.active span {
    background: var(--accent);
    color: var(--text);
    border-color: var(--accent);
}

.pagination li.disabled span {
    color: var(--text-light);
    cursor: not-allowed;
}

/* Responsive table */
@media (max-width: 1023px) {
    table {
        display: block;
        overflow-x: auto;
    }
}
</style>
@endpush
