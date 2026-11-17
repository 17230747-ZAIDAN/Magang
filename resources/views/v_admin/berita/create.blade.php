@extends('v_admin.layouts.app')

@section('title', 'Tambah Berita')

@section('content')
<div class="page-header">
    <div>
        <h1>Tambah Berita Baru</h1>
        <p>Publikasikan artikel, berita, atau rilis informasi terbaru.</p>
    </div>
    <div>
        <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label class="form-label" for="title">Judul Berita <span style="color: red;">*</span></label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" placeholder="Contoh: DPRD Gelar Rapat Paripurna Penetapan APBD" required>
            </div>

            <div class="grid grid-cols-3">
                <div class="form-group">
                    <label class="form-label" for="category">Kategori <span style="color: red;">*</span></label>
                    <select id="category" name="category" class="form-control" required>
                        @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="author">Penulis / Sumber</label>
                    <input type="text" id="author" name="author" class="form-control" value="{{ old('author', Auth::user()->name) }}" placeholder="Humas DPRD">
                </div>

                <div class="form-group">
                    <label class="form-label" for="published_at">Tanggal Publikasi</label>
                    <input type="datetime-local" id="published_at" name="published_at" class="form-control" value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="image">Foto Utama / Gambar Sampul</label>
                <input type="file" id="image" name="image" class="form-control" accept="image/*">
                <div class="form-text">Format didukung: JPG, PNG, WEBP (Maksimal 2MB).</div>
            </div>

            <div class="form-group">
                <label class="form-label" for="excerpt">Ringkasan Berita (Excerpt)</label>
                <textarea id="excerpt" name="excerpt" class="form-control" style="min-height: 80px;" placeholder="Tuliskan 1-2 kalimat ringkasan (opsional, jika dikosongkan akan digenerate otomatis)">{{ old('excerpt') }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label" for="content">Isi Lengkap Berita <span style="color: red;">*</span></label>
                <textarea id="content" name="content" class="form-control" style="min-height: 250px;" placeholder="Tuliskan isi berita selengkapnya..." required>{{ old('content') }}</textarea>
            </div>

            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                    <span style="font-weight: 600; font-size: 0.875rem;">Jadikan Berita Utama / Featured (Tampil di Headline Beranda)</span>
                </label>
            </div>

            <div style="margin-top: 1.5rem; display: flex; gap: 0.75rem;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan & Terbitkan
                </button>
                <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
