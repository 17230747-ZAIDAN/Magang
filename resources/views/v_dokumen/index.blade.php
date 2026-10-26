@extends('v_layouts.app')

@section('title', 'Dokumen DPR RI')
@section('meta_description', 'Database dokumen resmi DPR RI: risalah rapat, laporan kinerja, dan dokumen legislasi')

@section('content')

<!-- Page Header -->
<section style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); padding: 4rem 0; color: white;">
    <div class="container">
        <h1 style="color: white; margin-bottom: 0.5rem;">Dokumen DPR RI</h1>
        <p style="color: rgba(255,255,255,0.9); font-size: 1.125rem;">Database dokumen resmi dan publikasi DPR RI</p>
    </div>
</section>

<!-- Filter & Search Section -->
<section class="pt-4 pb-4 bg-soft">
    <div class="container">
        <form action="{{ route('dokumen.index') }}" method="GET">
            <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                <!-- Search -->
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500; font-size: 0.875rem;">Cari Dokumen</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Judul atau nomor dokumen..." style="width: 100%; padding: 0.625rem 1rem; border: 1px solid var(--border); border-radius: var(--radius); font-size: 0.875rem;">
                </div>
                
                <!-- Type Filter -->
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500; font-size: 0.875rem;">Jenis Dokumen</label>
                    <select name="type" style="width: 100%; padding: 0.625rem 1rem; border: 1px solid var(--border); border-radius: var(--radius); font-size: 0.875rem;">
                        <option value="">Semua Jenis</option>
                        @foreach($types as $type)
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
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Filter
                </button>
                @if(request()->hasAny(['search', 'type', 'year']))
                <a href="{{ route('dokumen.index') }}" class="btn btn-secondary">
                    <i class="fas fa-redo"></i> Reset
                </a>
                @endif
            </div>
        </form>
    </div>
</section>

<!-- Documents List Section -->
<section class="pt-6 pb-8">
    <div class="container">
        @if($documents->count() > 0)
            <!-- Results Info -->
            <div style="margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center;">
                <div style="color: var(--text-muted);">
                    Menampilkan {{ $documents->firstItem() }} - {{ $documents->lastItem() }} dari {{ $documents->total() }} dokumen
                </div>
                <a href="{{ route('dokumen.jdih') }}" class="btn btn-sm btn-accent">
                    <i class="fas fa-gavel"></i> JDIH (Database Hukum)
                </a>
            </div>
            
            <!-- Documents List -->
            <div style="display: flex; flex-direction: column; gap: 1rem; margin-bottom: 3rem;">
                @foreach($documents as $document)
                <div class="card">
                    <div style="padding: 1.5rem;">
                        <div style="display: flex; gap: 2rem; align-items: start;">
                            <!-- Icon -->
                            <div style="flex-shrink: 0; width: 60px; height: 60px; background: var(--bg-soft); border-radius: var(--radius); display: flex; align-items: center; justify-content: center; color: var(--danger); font-size: 1.75rem;">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                            
                            <!-- Content -->
                            <div style="flex: 1; min-width: 0;">
                                <!-- Badges -->
                                <div style="display: flex; flex-wrap: wrap; gap: 0.5rem; margin-bottom: 0.75rem;">
                                    <span class="badge badge-accent">{{ $document->type }}</span>
                                    @if($document->year)
                                    <span class="badge" style="background: var(--bg-gray); color: var(--text);">{{ $document->year }}</span>
                                    @endif
                                </div>
                                
                                <!-- Title -->
                                <h3 style="font-size: 1.125rem; margin-bottom: 0.5rem;">
                                    <a href="{{ route('dokumen.show', $document->slug) }}" style="color: var(--text); text-decoration: none;">
                                        {{ $document->title }}
                                    </a>
                                </h3>
                                
                                <!-- Number -->
                                @if($document->number)
                                <p style="color: var(--text-muted); font-size: 0.875rem; margin-bottom: 0.75rem;">
                                    <strong>Nomor:</strong> {{ $document->full_number }}
                                </p>
                                @endif
                                
                                <!-- Description -->
                                @if($document->description)
                                <p style="color: var(--text-muted); font-size: 0.9375rem; line-height: 1.6; margin-bottom: 0.75rem;">
                                    {{ Str::limit($document->description, 200) }}
                                </p>
                                @endif
                                
                                <!-- Meta Info -->
                                <div style="display: flex; flex-wrap: wrap; gap: 1.5rem; font-size: 0.8125rem; color: var(--text-light);">
                                    <span><i class="far fa-calendar"></i> {{ $document->formatted_document_date }}</span>
                                    @if($document->file_size)
                                    <span><i class="fas fa-file"></i> {{ $document->formatted_file_size }}</span>
                                    @endif
                                    <span><i class="fas fa-download"></i> {{ $document->downloads }} downloads</span>
                                </div>
                            </div>
                            
                            <!-- Actions -->
                            <div style="flex-shrink: 0; display: flex; flex-direction: column; gap: 0.5rem;">
                                <a href="{{ route('dokumen.show', $document->slug) }}" class="btn btn-sm btn-secondary" style="white-space: nowrap;">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                                @if($document->download_url)
                                <a href="{{ route('dokumen.download', $document->slug) }}" class="btn btn-sm btn-primary" style="white-space: nowrap;">
                                    <i class="fas fa-download"></i> Unduh
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div style="display: flex; justify-content: center;">
                {{ $documents->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div style="text-align: center; padding: 4rem 0; color: var(--text-muted);">
                <i class="fas fa-file-alt" style="font-size: 5rem; opacity: 0.3; margin-bottom: 1.5rem;"></i>
                <h3>Tidak Ada Dokumen Ditemukan</h3>
                <p>Coba ubah filter atau kata kunci pencarian Anda</p>
                <a href="{{ route('dokumen.index') }}" class="btn btn-primary" style="margin-top: 1rem;">Tampilkan Semua Dokumen</a>
            </div>
        @endif
    </div>
</section>

<!-- Document Categories Section -->
<section class="bg-soft pt-6 pb-6">
    <div class="container">
        <h3 class="text-center mb-4">Kategori Dokumen</h3>
        <div class="grid grid-cols-4">
            <a href="{{ route('dokumen.jdih') }}" class="card" style="text-decoration: none;">
                <div class="card-body text-center">
                    <div style="font-size: 2.5rem; color: var(--accent); margin-bottom: 1rem;">
                        <i class="fas fa-gavel"></i>
                    </div>
                    <h4 style="font-size: 1rem; margin-bottom: 0.5rem;">JDIH</h4>
                    <p class="text-muted" style="font-size: 0.875rem;">Database Peraturan</p>
                </div>
            </a>
            
            <a href="{{ route('dokumen.index', ['type' => 'Risalah']) }}" class="card" style="text-decoration: none;">
                <div class="card-body text-center">
                    <div style="font-size: 2.5rem; color: var(--primary); margin-bottom: 1rem;">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h4 style="font-size: 1rem; margin-bottom: 0.5rem;">Risalah</h4>
                    <p class="text-muted" style="font-size: 0.875rem;">Rapat Paripurna</p>
                </div>
            </a>
            
            <a href="{{ route('dokumen.index', ['type' => 'Laporan Kinerja']) }}" class="card" style="text-decoration: none;">
                <div class="card-body text-center">
                    <div style="font-size: 2.5rem; color: var(--success); margin-bottom: 1rem;">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h4 style="font-size: 1rem; margin-bottom: 0.5rem;">Laporan</h4>
                    <p class="text-muted" style="font-size: 0.875rem;">Kinerja & Renstra</p>
                </div>
            </a>
            
            <a href="{{ route('dokumen.index', ['type' => 'Naskah Pidato']) }}" class="card" style="text-decoration: none;">
                <div class="card-body text-center">
                    <div style="font-size: 2.5rem; color: var(--info); margin-bottom: 1rem;">
                        <i class="fas fa-microphone"></i>
                    </div>
                    <h4 style="font-size: 1rem; margin-bottom: 0.5rem;">Naskah</h4>
                    <p class="text-muted" style="font-size: 0.875rem;">Pidato & Sambutan</p>
                </div>
            </a>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
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
    border-color: var(--primary);
    color: var(--primary);
}

.pagination li.active span {
    background: var(--primary);
    color: white;
    border-color: var(--primary);
}

.pagination li.disabled span {
    color: var(--text-light);
    cursor: not-allowed;
}

/* Responsive adjustments */
@media (max-width: 1023px) {
    .card > div > div[style*="display: flex"] {
        flex-direction: column !important;
    }
    
    .card > div > div > div[style*="flex-direction: column"] {
        flex-direction: row !important;
        width: 100%;
    }
}
</style>
@endpush
