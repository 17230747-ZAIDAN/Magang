@extends('v_admin.layouts.app')

@section('title', 'Galeri Kegiatan')

@section('content')
<div class="page-header">
    <div>
        <h1>Galeri Kegiatan & Dokumentasi</h1>
        <p>Kelola dokumentasi foto kegiatan, sidang paripurna, dan kunjungan dewan.</p>
    </div>
    <div>
        <a href="{{ route('admin.galeri.create') }}" class="btn btn-primary">
            <i class="fas fa-camera"></i> Tambah Foto Galeri
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <form method="GET" action="{{ route('admin.galeri.index') }}" style="display: flex; gap: 0.75rem; flex-wrap: wrap; width: 100%;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul galeri..." class="form-control" style="max-width: 280px;">
            <select name="category" class="form-control" style="max-width: 200px;">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i> Cari</button>
            @if(request('search') || request('category'))
            <a href="{{ route('admin.galeri.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-redo"></i> Reset</a>
            @endif
        </form>
    </div>

    <div class="card-body">
        <div class="grid grid-cols-4">
            @forelse($galleries as $gal)
            <div class="card" style="margin-bottom: 0; box-shadow: none; border: 1px solid var(--adm-border);">
                <div style="height: 160px; overflow: hidden; position: relative;">
                    @if($gal->image && file_exists(public_path($gal->image)))
                    <img src="{{ asset($gal->image) }}" alt="{{ $gal->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                    <div style="width: 100%; height: 100%; background: #E2E8F0; display: flex; align-items: center; justify-content: center; color: #A0AEC0;">
                        <i class="fas fa-image" style="font-size: 2rem;"></i>
                    </div>
                    @endif
                    <span class="badge badge-info" style="position: absolute; top: 10px; right: 10px;">{{ $gal->category }}</span>
                </div>
                <div style="padding: 1rem;">
                    <h4 style="font-size: 0.95rem; font-weight: 600; color: var(--adm-primary); margin-bottom: 0.25rem;">
                        {{ Str::limit($gal->title, 40) }}
                    </h4>
                    <div style="font-size: 0.75rem; color: var(--adm-text-muted); margin-bottom: 0.75rem;">
                        <i class="far fa-calendar-alt"></i> {{ $gal->event_date ? $gal->event_date->format('d M Y') : '-' }}
                    </div>
                    <div style="display: flex; gap: 0.5rem;">
                        <a href="{{ route('admin.galeri.edit', $gal->id) }}" class="btn btn-sm btn-outline" style="flex: 1; justify-content: center;">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.galeri.destroy', $gal->id) }}" method="POST" onsubmit="return confirm('Hapus foto ini?')" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 3rem; color: var(--adm-text-muted);">
                Belum ada dokumentasi galeri foto. Silakan klik tombol "Tambah Foto Galeri".
            </div>
            @endforelse
        </div>
    </div>

    @if($galleries->hasPages())
    <div style="padding: 1rem 1.35rem; border-top: 1px solid var(--adm-border);">
        {{ $galleries->links() }}
    </div>
    @endif
</div>
@endsection
