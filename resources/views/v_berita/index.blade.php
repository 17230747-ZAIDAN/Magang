@extends('v_layouts.app')

@section('title', 'Berita Terkini')
@section('meta_description', 'Berita terbaru seputar kegiatan dan program DPR RI')

@section('content')

<!-- Page Header -->
<section style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); padding: 4rem 0; color: white;">
    <div class="container">
        <h1 style="color: white; margin-bottom: 0.5rem;">Berita Terkini</h1>
        <p style="color: rgba(255,255,255,0.9); font-size: 1.125rem;">Informasi terbaru seputar kegiatan DPR RI</p>
    </div>
</section>

<!-- Filter & Search Section -->
<section class="pt-4 pb-4 bg-soft">
    <div class="container">
        <form action="{{ route('berita.index') }}" method="GET" style="display: flex; gap: 1rem; flex-wrap: wrap; align-items: end;">
            <!-- Search -->
            <div style="flex: 1; min-width: 250px;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 500; font-size: 0.875rem;">Cari Berita</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Masukkan kata kunci..." style="width: 100%; padding: 0.625rem 1rem; border: 1px solid var(--border); border-radius: var(--radius); font-size: 0.875rem;">
            </div>
            
            <!-- Category Filter -->
            <div style="min-width: 200px;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 500; font-size: 0.875rem;">Kategori</label>
                <select name="category" style="width: 100%; padding: 0.625rem 1rem; border: 1px solid var(--border); border-radius: var(--radius); font-size: 0.875rem;">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            
            <!-- Submit Button -->
            <div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Filter
                </button>
                @if(request('search') || request('category'))
                <a href="{{ route('berita.index') }}" class="btn btn-secondary">
                    <i class="fas fa-redo"></i> Reset
                </a>
                @endif
            </div>
        </form>
    </div>
</section>

<!-- News List Section -->
<section class="pt-6 pb-8">
    <div class="container">
        @if($news->count() > 0)
            <!-- Results Info -->
            <div style="margin-bottom: 2rem; color: var(--text-muted);">
                Menampilkan {{ $news->firstItem() }} - {{ $news->lastItem() }} dari {{ $news->total() }} berita
                @if(request('search'))
                    untuk "<strong>{{ request('search') }}</strong>"
                @endif
                @if(request('category'))
                    di kategori "<strong>{{ request('category') }}</strong>"
                @endif
            </div>
            
            <!-- News Grid -->
            <div class="grid grid-cols-3" style="margin-bottom: 3rem;">
                @foreach($news as $item)
                <a href="{{ route('berita.show', $item->slug) }}" class="card" style="text-decoration: none;">
                    @if($item->image)
                    <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" class="card-img">
                    @else
                    <div class="card-img" style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-image" style="font-size: 3rem; color: rgba(255,255,255,0.5);"></i>
                    </div>
                    @endif
                    <div class="card-body">
                        <div class="card-meta" style="margin-bottom: 0.75rem;">
                            <span><i class="far fa-calendar"></i> {{ $item->formatted_date }}</span>
                            <span class="badge badge-primary">{{ $item->category }}</span>
                        </div>
                        <h3 class="card-title">{{ $item->title }}</h3>
                        <p class="card-text">{{ $item->excerpt }}</p>
                        <div style="margin-top: 1rem; color: var(--text-light); font-size: 0.8125rem;">
                            <i class="far fa-eye"></i> {{ $item->views }} views
                            @if($item->author)
                            <span style="margin-left: 1rem;"><i class="far fa-user"></i> {{ $item->author }}</span>
                            @endif
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div style="display: flex; justify-content: center;">
                {{ $news->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div style="text-align: center; padding: 4rem 0; color: var(--text-muted);">
                <i class="fas fa-newspaper" style="font-size: 5rem; opacity: 0.3; margin-bottom: 1.5rem;"></i>
                <h3>Tidak Ada Berita Ditemukan</h3>
                <p>Coba ubah kata kunci atau filter kategori Anda</p>
                <a href="{{ route('berita.index') }}" class="btn btn-primary" style="margin-top: 1rem;">Tampilkan Semua Berita</a>
            </div>
        @endif
    </div>
</section>

<!-- Categories Quick Links -->
<section class="bg-soft pt-6 pb-6">
    <div class="container">
        <h3 class="text-center mb-4">Kategori Berita</h3>
        <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 1rem;">
            @foreach($categories as $cat)
            <a href="{{ route('berita.index', ['category' => $cat]) }}" class="btn {{ request('category') == $cat ? 'btn-primary' : 'btn-secondary' }}">
                {{ $cat }}
            </a>
            @endforeach
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
</style>
@endpush
