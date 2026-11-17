@extends('v_admin.layouts.app')

@section('title', 'Edit Berita')

@section('content')
<div class="page-header">
    <div>
        <h1>Edit Berita</h1>
        <p>Perbarui rincian, isi berita, atau gambar sampul.</p>
    </div>
    <div>
        <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label" for="title">Judul Berita <span style="color: red;">*</span></label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $berita->title) }}" required>
            </div>

            <div class="grid grid-cols-3">
                <div class="form-group">
                    <label class="form-label" for="category">Kategori <span style="color: red;">*</span></label>
                    <select id="category" name="category" class="form-control" required>
                        @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ old('category', $berita->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="author">Penulis / Sumber</label>
                    <input type="text" id="author" name="author" class="form-control" value="{{ old('author', $berita->author) }}">
                </div>

                <div class="form-group">
                    <label class="form-label" for="published_at">Tanggal Publikasi</label>
                    <input type="datetime-local" id="published_at" name="published_at" class="form-control" value="{{ old('published_at', $berita->published_at ? $berita->published_at->format('Y-m-d\TH:i') : '') }}">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="image">Ganti Foto Utama / Gambar Sampul</label>
                @if($berita->image && file_exists(public_path($berita->image)))
                <div style="margin-bottom: 0.75rem;">
                    <img src="{{ asset($berita->image) }}" alt="Preview" style="max-height: 120px; border-radius: 8px; border: 1px solid var(--adm-border);">
                    <div style="font-size: 0.75rem; color: var(--adm-text-muted);">Foto saat ini</div>
                </div>
                @endif
                <input type="file" id="image" name="image" class="form-control" accept="image/*">
                <div class="form-text">Biarkan kosong jika tidak ingin mengganti foto.</div>
            </div>

            <div class="form-group">
                <label class="form-label" for="excerpt">Ringkasan Berita (Excerpt)</label>
                <textarea id="excerpt" name="excerpt" class="form-control" style="min-height: 80px;">{{ old('excerpt', $berita->excerpt) }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label" for="content">Isi Lengkap Berita <span style="color: red;">*</span></label>
                <textarea id="content" name="content" class="form-control" style="min-height: 250px;" required>{{ old('content', $berita->content) }}</textarea>
            </div>

            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $berita->is_featured) ? 'checked' : '' }}>
                    <span style="font-weight: 600; font-size: 0.875rem;">Jadikan Berita Utama / Featured (Tampil di Headline Beranda)</span>
                </label>
            </div>

            <div style="margin-top: 1.5rem; display: flex; gap: 0.75rem;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
