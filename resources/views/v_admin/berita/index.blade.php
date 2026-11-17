@extends('v_admin.layouts.app')

@section('title', 'Manajemen Berita')

@section('content')
<div class="page-header">
    <div>
        <h1>Manajemen Berita</h1>
        <p>Kelola artikel, berita legislasi, dan rilis pers kegiatan dewan.</p>
    </div>
    <div>
        <a href="{{ route('admin.berita.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Berita Baru
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <form method="GET" action="{{ route('admin.berita.index') }}" style="display: flex; gap: 0.75rem; flex-wrap: wrap; width: 100%;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul berita..." class="form-control" style="max-width: 280px;">
            <select name="category" class="form-control" style="max-width: 200px;">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i> Cari</button>
            @if(request('search') || request('category'))
            <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-redo"></i> Reset</a>
            @endif
        </form>
    </div>

    <div class="card-body" style="padding: 0;">
        <div class="table-responsive">
            <table class="adm-table">
                <thead>
                    <tr>
                        <th style="width: 70px;">Foto</th>
                        <th>Judul & Excerpt</th>
                        <th>Kategori</th>
                        <th>Penulis</th>
                        <th>Featured</th>
                        <th>Tanggal Terbit</th>
                        <th style="width: 140px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($news as $item)
                    <tr>
                        <td>
                            @if($item->image && file_exists(public_path($item->image)))
                            <img src="{{ asset($item->image) }}" alt="Thumbnail" style="width: 55px; height: 42px; object-fit: cover; border-radius: 6px;">
                            @else
                            <div style="width: 55px; height: 42px; background: #E2E8F0; border-radius: 6px; display: flex; align-items: center; justify-content: center; color: #A0AEC0;">
                                <i class="fas fa-image"></i>
                            </div>
                            @endif
                        </td>
                        <td>
                            <div style="font-weight: 600; color: var(--adm-primary);">{{ $item->title }}</div>
                            <div style="font-size: 0.78rem; color: var(--adm-text-muted); margin-top: 2px;">
                                {{ Str::limit(strip_tags($item->excerpt), 70) }}
                            </div>
                        </td>
                        <td><span class="badge badge-info">{{ $item->category }}</span></td>
                        <td style="font-size: 0.82rem;">{{ $item->author ?? '-' }}</td>
                        <td>
                            @if($item->is_featured)
                                <span class="badge badge-warning"><i class="fas fa-star"></i> Featured</span>
                            @else
                                <span style="color: var(--adm-text-muted); font-size: 0.8rem;">-</span>
                            @endif
                        </td>
                        <td style="font-size: 0.8rem; color: var(--adm-text-muted);">
                            {{ $item->published_at ? $item->published_at->format('d/m/Y') : '-' }}
                        </td>
                        <td style="text-align: center;">
                            <div style="display: flex; gap: 0.4rem; justify-content: center;">
                                <a href="{{ route('admin.berita.edit', $item->id) }}" class="btn btn-sm btn-outline" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.berita.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 2rem; color: var(--adm-text-muted);">
                            Tidak ada data berita yang ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($news->hasPages())
    <div style="padding: 1rem 1.35rem; border-top: 1px solid var(--adm-border);">
        {{ $news->links() }}
    </div>
    @endif
</div>
@endsection
