@extends('v_layouts.app')

@section('title', $document->title)
@section('meta_description', $document->description ?? 'Dokumen resmi DPR RI')

@section('content')

<!-- Breadcrumb -->
<section class="bg-soft pt-3 pb-3">
    <div class="container">
        <nav style="font-size: 0.875rem;">
            <a href="{{ route('beranda') }}" style="color: var(--text-muted);">Beranda</a>
            <span style="margin: 0 0.5rem; color: var(--text-light);">/</span>
            <a href="{{ route('dokumen.index') }}" style="color: var(--text-muted);">Dokumen</a>
            <span style="margin: 0 0.5rem; color: var(--text-light);">/</span>
            <span style="color: var(--text);">{{ Str::limit($document->title, 50) }}</span>
        </nav>
    </div>
</section>

<!-- Document Detail Section -->
<section class="pt-6 pb-8">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 350px; gap: 3rem;">
            <!-- Main Content -->
            <div>
                <!-- Document Card -->
                <div class="card" style="margin-bottom: 2rem;">
                    <div style="padding: 2.5rem;">
                        <!-- Type & Year -->
                        <div style="display: flex; flex-wrap: wrap; gap: 0.75rem; margin-bottom: 1.5rem;">
                            <span class="badge badge-accent" style="font-size: 0.875rem; padding: 0.5rem 1rem;">{{ $document->type }}</span>
                            @if($document->year)
                            <span class="badge" style="background: var(--bg-gray); color: var(--text); font-size: 0.875rem; padding: 0.5rem 1rem;">Tahun {{ $document->year }}</span>
                            @endif
                        </div>
                        
                        <!-- Title -->
                        <h1 style="font-size: 2rem; line-height: 1.3; margin-bottom: 1.5rem;">{{ $document->title }}</h1>
                        
                        <!-- Document Info Grid -->
                        <div style="display: grid; grid-template-columns: 200px 1fr; gap: 1rem; padding: 1.5rem; background: var(--bg-soft); border-radius: var(--radius); margin-bottom: 2rem;">
                            @if($document->number)
                            <div style="color: var(--text-muted); font-weight: 500;">Nomor Dokumen</div>
                            <div style="font-weight: 600;">{{ $document->full_number }}</div>
                            @endif
                            
                            @if($document->document_date)
                            <div style="color: var(--text-muted); font-weight: 500;">Tanggal Penetapan</div>
                            <div style="font-weight: 600;">{{ $document->formatted_document_date }}</div>
                            @endif
                            
                            @if($document->file_size)
                            <div style="color: var(--text-muted); font-weight: 500;">Ukuran File</div>
                            <div style="font-weight: 600;">{{ $document->formatted_file_size }}</div>
                            @endif
                            
                            <div style="color: var(--text-muted); font-weight: 500;">Total Unduhan</div>
                            <div style="font-weight: 600;">{{ $document->downloads }} kali</div>
                            
                            <div style="color: var(--text-muted); font-weight: 500;">Dipublikasikan</div>
                            <div style="font-weight: 600;">{{ $document->published_at->format('d F Y') }}</div>
                        </div>
                        
                        <!-- Description -->
                        @if($document->description)
                        <div style="margin-bottom: 2rem;">
                            <h2 style="font-size: 1.25rem; margin-bottom: 1rem; padding-bottom: 0.75rem; border-bottom: 2px solid var(--primary);">
                                Deskripsi
                            </h2>
                            <div style="line-height: 1.8; color: var(--text);">
                                {!! nl2br(e($document->description)) !!}
                            </div>
                        </div>
                        @endif
                        
                        <!-- Download Section -->
                        @if($document->download_url)
                        <div style="padding: 2rem; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); border-radius: var(--radius-lg); text-align: center; color: white;">
                            <div style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.9;">
                                <i class="fas fa-file-download"></i>
                            </div>
                            <h3 style="color: white; margin-bottom: 0.5rem;">Unduh Dokumen</h3>
                            <p style="color: rgba(255,255,255,0.9); margin-bottom: 1.5rem;">
                                File tersedia dalam format PDF
                            </p>
                            <a href="{{ route('dokumen.download', $document->slug) }}" class="btn btn-accent btn-lg">
                                <i class="fas fa-download"></i> Unduh Sekarang
                            </a>
                        </div>
                        @else
                        <div style="padding: 2rem; background: var(--bg-soft); border-radius: var(--radius-lg); text-align: center;">
                            <i class="fas fa-info-circle" style="font-size: 2rem; color: var(--text-muted); margin-bottom: 1rem;"></i>
                            <p style="color: var(--text-muted);">File dokumen belum tersedia untuk diunduh</p>
                        </div>
                        @endif
                    </div>
                </div>
                
                <!-- Related Documents -->
                @if($relatedDocuments->count() > 0)
                <div style="margin-top: 3rem;">
                    <h3 style="margin-bottom: 1.5rem;">Dokumen Terkait</h3>
                    <div style="display: flex; flex-direction: column; gap: 1rem;">
                        @foreach($relatedDocuments as $related)
                        <div class="card">
                            <div style="padding: 1.25rem; display: flex; gap: 1.5rem; align-items: start;">
                                <div style="flex-shrink: 0; width: 50px; height: 50px; background: var(--bg-soft); border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; color: var(--danger); font-size: 1.5rem;">
                                    <i class="fas fa-file-pdf"></i>
                                </div>
                                <div style="flex: 1; min-width: 0;">
                                    <h4 style="font-size: 1rem; margin-bottom: 0.25rem;">
                                        <a href="{{ route('dokumen.show', $related->slug) }}" style="color: var(--text); text-decoration: none;">
                                            {{ $related->title }}
                                        </a>
                                    </h4>
                                    <div style="font-size: 0.8125rem; color: var(--text-muted);">
                                        @if($related->number)
                                        {{ $related->full_number }} •
                                        @endif
                                        {{ $related->formatted_document_date }}
                                    </div>
                                </div>
                                <a href="{{ route('dokumen.show', $related->slug) }}" class="btn btn-sm btn-secondary">
                                    Lihat
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            
            <!-- Sidebar -->
            <aside>
                <!-- Latest Documents -->
                <div class="card" style="margin-bottom: 2rem;">
                    <div class="card-body">
                        <h3 style="font-size: 1.125rem; margin-bottom: 1.5rem; padding-bottom: 0.75rem; border-bottom: 2px solid var(--primary);">
                            Dokumen Terbaru
                        </h3>
                        @if($latestDocuments->count() > 0)
                        <div style="display: flex; flex-direction: column; gap: 1.25rem;">
                            @foreach($latestDocuments as $latest)
                            <a href="{{ route('dokumen.show', $latest->slug) }}" style="text-decoration: none; display: flex; gap: 1rem; padding-bottom: 1.25rem; border-bottom: 1px solid var(--border-light);">
                                <div style="flex-shrink: 0; width: 40px; height: 40px; background: var(--bg-soft); border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; color: var(--danger);">
                                    <i class="fas fa-file-pdf"></i>
                                </div>
                                <div style="flex: 1; min-width: 0;">
                                    <h4 style="font-size: 0.875rem; line-height: 1.4; margin-bottom: 0.25rem; color: var(--text); display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                        {{ $latest->title }}
                                    </h4>
                                    <p style="font-size: 0.75rem; color: var(--text-muted); margin: 0;">
                                        {{ $latest->formatted_document_date }}
                                    </p>
                                </div>
                            </a>
                            @endforeach
                        </div>
                        @endif
                        
                        <a href="{{ route('dokumen.index') }}" class="btn btn-sm btn-primary" style="width: 100%; margin-top: 1.5rem;">
                            Lihat Semua Dokumen
                        </a>
                    </div>
                </div>
                
                <!-- Quick Access -->
                <div class="card">
                    <div class="card-body">
                        <h3 style="font-size: 1.125rem; margin-bottom: 1.5rem; padding-bottom: 0.75rem; border-bottom: 2px solid var(--accent);">
                            Akses Cepat
                        </h3>
                        <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 0.75rem;">
                            <li>
                                <a href="{{ route('dokumen.jdih') }}" style="display: flex; align-items: center; gap: 0.75rem; color: var(--text); text-decoration: none; font-size: 0.875rem;">
                                    <i class="fas fa-gavel" style="color: var(--accent); width: 20px;"></i>
                                    JDIH
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('dokumen.index', ['type' => 'Risalah']) }}" style="display: flex; align-items: center; gap: 0.75rem; color: var(--text); text-decoration: none; font-size: 0.875rem;">
                                    <i class="fas fa-file-alt" style="color: var(--primary); width: 20px;"></i>
                                    Risalah Rapat
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('dokumen.index', ['type' => 'Laporan Kinerja']) }}" style="display: flex; align-items: center; gap: 0.75rem; color: var(--text); text-decoration: none; font-size: 0.875rem;">
                                    <i class="fas fa-chart-line" style="color: var(--success); width: 20px;"></i>
                                    Laporan Kinerja
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('berita.index') }}" style="display: flex; align-items: center; gap: 0.75rem; color: var(--text); text-decoration: none; font-size: 0.875rem;">
                                    <i class="fas fa-newspaper" style="color: var(--info); width: 20px;"></i>
                                    Berita Terkini
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('kegiatan.agenda') }}" style="display: flex; align-items: center; gap: 0.75rem; color: var(--text); text-decoration: none; font-size: 0.875rem;">
                                    <i class="fas fa-calendar" style="color: var(--warning); width: 20px;"></i>
                                    Agenda Kegiatan
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
/* Responsive layout */
@media (max-width: 1023px) {
    section .container > div[style*="grid-template-columns"] {
        grid-template-columns: 1fr !important;
    }
    
    .card > div > div[style*="grid-template-columns"] {
        grid-template-columns: 1fr !important;
        gap: 0.5rem !important;
    }
}
</style>
@endpush
