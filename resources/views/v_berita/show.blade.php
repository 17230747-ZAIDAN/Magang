@extends('v_layouts.app')

@section('title', $news->title)
@section('meta_description', $news->excerpt)

@section('content')

<!-- Breadcrumb -->
<section class="bg-soft pt-3 pb-3">
    <div class="container">
        <nav style="font-size: 0.875rem;">
            <a href="{{ route('beranda') }}" style="color: var(--text-muted);">Beranda</a>
            <span style="margin: 0 0.5rem; color: var(--text-light);">/</span>
            <a href="{{ route('berita.index') }}" style="color: var(--text-muted);">Berita</a>
            <span style="margin: 0 0.5rem; color: var(--text-light);">/</span>
            <span style="color: var(--text);">{{ Str::limit($news->title, 50) }}</span>
        </nav>
    </div>
</section>

<!-- News Detail Section -->
<section class="pt-6 pb-8">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 350px; gap: 3rem;">
            <!-- Main Content -->
            <article>
                <!-- Category & Date -->
                <div style="margin-bottom: 1.5rem;">
                    <a href="{{ route('berita.index', ['category' => $news->category]) }}" class="badge badge-primary" style="text-decoration: none;">
                        {{ $news->category }}
                    </a>
                    <span style="margin: 0 0.75rem; color: var(--text-light);">•</span>
                    <span style="color: var(--text-muted); font-size: 0.875rem;">
                        <i class="far fa-calendar"></i> {{ $news->formatted_date }}
                    </span>
                </div>
                
                <!-- Title -->
                <h1 style="font-size: 2.25rem; line-height: 1.3; margin-bottom: 1rem;">{{ $news->title }}</h1>
                
                <!-- Meta Info -->
                <div style="display: flex; align-items: center; gap: 1.5rem; padding-bottom: 1.5rem; border-bottom: 1px solid var(--border); margin-bottom: 2rem; font-size: 0.875rem; color: var(--text-muted);">
                    @if($news->author)
                    <span><i class="far fa-user"></i> {{ $news->author }}</span>
                    @endif
                    <span><i class="far fa-eye"></i> {{ $news->views }} views</span>
                    <span><i class="far fa-clock"></i> {{ $news->published_at->diffForHumans() }}</span>
                </div>
                
                <!-- Featured Image -->
                @if($news->image)
                <div style="margin-bottom: 2rem; border-radius: var(--radius-lg); overflow: hidden;">
                    <img src="{{ asset($news->image) }}" alt="{{ $news->title }}" style="width: 100%; height: auto; display: block;">
                </div>
                @endif
                
                <!-- Content -->
                <div class="article-content" style="font-size: 1.0625rem; line-height: 1.8; color: var(--text);">
                    {!! nl2br(e($news->content)) !!}
                </div>
                
                <!-- Share Buttons -->
                <div style="margin-top: 3rem; padding-top: 2rem; border-top: 1px solid var(--border);">
                    <h4 style="font-size: 1rem; margin-bottom: 1rem;">Bagikan Berita Ini</h4>
                    <div style="display: flex; gap: 0.75rem;">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('berita.show', $news->slug)) }}" target="_blank" class="btn btn-sm btn-secondary" style="background: #1877F2; color: white; border: none;">
                            <i class="fab fa-facebook-f"></i> Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('berita.show', $news->slug)) }}&text={{ urlencode($news->title) }}" target="_blank" class="btn btn-sm btn-secondary" style="background: #1DA1F2; color: white; border: none;">
                            <i class="fab fa-twitter"></i> Twitter
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($news->title . ' ' . route('berita.show', $news->slug)) }}" target="_blank" class="btn btn-sm btn-secondary" style="background: #25D366; color: white; border: none;">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                        <button onclick="copyLink()" class="btn btn-sm btn-secondary">
                            <i class="fas fa-link"></i> Salin Link
                        </button>
                    </div>
                </div>
                
                <!-- Related News -->
                @if($relatedNews->count() > 0)
                <div style="margin-top: 4rem;">
                    <h3 style="margin-bottom: 1.5rem;">Berita Terkait</h3>
                    <div class="grid grid-cols-2">
                        @foreach($relatedNews as $related)
                        <a href="{{ route('berita.show', $related->slug) }}" class="card" style="text-decoration: none;">
                            @if($related->image)
                            <img src="{{ asset($related->image) }}" alt="{{ $related->title }}" class="card-img" style="height: 150px;">
                            @else
                            <div class="card-img" style="height: 150px; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-image" style="font-size: 2rem; color: rgba(255,255,255,0.5);"></i>
                            </div>
                            @endif
                            <div class="card-body">
                                <div class="card-meta" style="margin-bottom: 0.5rem;">
                                    <span style="font-size: 0.75rem;"><i class="far fa-calendar"></i> {{ $related->formatted_date }}</span>
                                </div>
                                <h4 class="card-title" style="font-size: 1rem;">{{ $related->title }}</h4>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </article>
            
            <!-- Sidebar -->
            <aside>
                <!-- Latest News -->
                <div class="card" style="margin-bottom: 2rem;">
                    <div class="card-body">
                        <h3 style="font-size: 1.125rem; margin-bottom: 1.5rem; padding-bottom: 0.75rem; border-bottom: 2px solid var(--primary);">
                            Berita Terbaru
                        </h3>
                        @if($latestNews->count() > 0)
                        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                            @foreach($latestNews as $latest)
                            <a href="{{ route('berita.show', $latest->slug) }}" style="text-decoration: none; display: flex; gap: 1rem;">
                                @if($latest->image)
                                <img src="{{ asset($latest->image) }}" alt="{{ $latest->title }}" style="width: 80px; height: 80px; object-fit: cover; border-radius: var(--radius-sm); flex-shrink: 0;">
                                @else
                                <div style="width: 80px; height: 80px; background: var(--bg-soft); border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fas fa-image" style="color: var(--text-light);"></i>
                                </div>
                                @endif
                                <div style="flex: 1; min-width: 0;">
                                    <h4 style="font-size: 0.9375rem; line-height: 1.4; margin-bottom: 0.25rem; color: var(--text); display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                        {{ $latest->title }}
                                    </h4>
                                    <p style="font-size: 0.75rem; color: var(--text-muted); margin: 0;">
                                        <i class="far fa-calendar"></i> {{ $latest->formatted_date }}
                                    </p>
                                </div>
                            </a>
                            @endforeach
                        </div>
                        @else
                        <p class="text-muted" style="font-size: 0.875rem;">Belum ada berita lain</p>
                        @endif
                        
                        <a href="{{ route('berita.index') }}" class="btn btn-sm btn-primary" style="width: 100%; margin-top: 1.5rem;">
                            Lihat Semua Berita
                        </a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div class="card">
                    <div class="card-body">
                        <h3 style="font-size: 1.125rem; margin-bottom: 1.5rem; padding-bottom: 0.75rem; border-bottom: 2px solid var(--accent);">
                            Tautan Cepat
                        </h3>
                        <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 0.75rem;">
                            <li>
                                <a href="{{ route('anggota.index') }}" style="display: flex; align-items: center; gap: 0.75rem; color: var(--text); text-decoration: none; font-size: 0.875rem;">
                                    <i class="fas fa-users" style="color: var(--primary); width: 20px;"></i>
                                    Anggota DPR RI
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('dokumen.index') }}" style="display: flex; align-items: center; gap: 0.75rem; color: var(--text); text-decoration: none; font-size: 0.875rem;">
                                    <i class="fas fa-file-alt" style="color: var(--primary); width: 20px;"></i>
                                    Dokumen & Risalah
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('dokumen.jdih') }}" style="display: flex; align-items: center; gap: 0.75rem; color: var(--text); text-decoration: none; font-size: 0.875rem;">
                                    <i class="fas fa-gavel" style="color: var(--primary); width: 20px;"></i>
                                    JDIH
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('aspirasi.create') }}" style="display: flex; align-items: center; gap: 0.75rem; color: var(--text); text-decoration: none; font-size: 0.875rem;">
                                    <i class="fas fa-comments" style="color: var(--primary); width: 20px;"></i>
                                    Kirim Aspirasi
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('kegiatan.agenda') }}" style="display: flex; align-items: center; gap: 0.75rem; color: var(--text); text-decoration: none; font-size: 0.875rem;">
                                    <i class="fas fa-calendar" style="color: var(--primary); width: 20px;"></i>
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

@push('scripts')
<script>
function copyLink() {
    const url = window.location.href;
    navigator.clipboard.writeText(url).then(() => {
        alert('Link berhasil disalin!');
    }).catch(() => {
        // Fallback for older browsers
        const input = document.createElement('input');
        input.value = url;
        document.body.appendChild(input);
        input.select();
        document.execCommand('copy');
        document.body.removeChild(input);
        alert('Link berhasil disalin!');
    });
}
</script>
@endpush

@push('styles')
<style>
/* Responsive layout for news detail */
@media (max-width: 1023px) {
    section .container > div[style*="grid-template-columns"] {
        grid-template-columns: 1fr !important;
    }
}

/* Article content styling */
.article-content p {
    margin-bottom: 1.25rem;
}

.article-content img {
    max-width: 100%;
    height: auto;
    border-radius: var(--radius);
    margin: 1.5rem 0;
}

.article-content h2,
.article-content h3 {
    margin-top: 2rem;
    margin-bottom: 1rem;
}

.article-content ul,
.article-content ol {
    margin-bottom: 1.25rem;
    padding-left: 2rem;
}

.article-content li {
    margin-bottom: 0.5rem;
}
</style>
@endpush
