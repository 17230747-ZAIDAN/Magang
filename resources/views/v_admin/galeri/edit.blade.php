@extends('v_admin.layouts.app')

@section('title', 'Edit Foto Galeri')

@section('content')
<div class="page-header">
    <div>
        <h1>Edit Foto Galeri</h1>
        <p>Perbarui judul, tanggal, kategori, atau ganti foto.</p>
    </div>
    <div>
        <a href="{{ route('admin.galeri.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Galeri
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label" for="title">Judul / Kegiatan <span style="color: red;">*</span></label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $galeri->title) }}" required>
            </div>

            <div class="grid grid-cols-2">
                <div class="form-group">
                    <label class="form-label" for="category">Kategori Kegiatan <span style="color: red;">*</span></label>
                    <select id="category" name="category" class="form-control" required>
                        @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ old('category', $galeri->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="event_date">Tanggal Pelaksanaan</label>
                    <input type="date" id="event_date" name="event_date" class="form-control" value="{{ old('event_date', $galeri->event_date ? $galeri->event_date->format('Y-m-d') : '') }}">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="image">Ganti Foto</label>
                @if($galeri->image && file_exists(public_path($galeri->image)))
                <div style="margin-bottom: 0.75rem;">
                    <img src="{{ asset($galeri->image) }}" alt="Preview" style="max-height: 120px; border-radius: 8px; border: 1px solid var(--adm-border);">
                    <div style="font-size: 0.75rem; color: var(--adm-text-muted);">Foto saat ini</div>
                </div>
                @endif
                <input type="file" id="image" name="image" class="form-control" accept="image/*">
                <div class="form-text">Biarkan kosong jika tidak ingin mengganti file foto.</div>
            </div>

            <div class="form-group">
                <label class="form-label" for="description">Deskripsi / Keterangan Tambahan</label>
                <textarea id="description" name="description" class="form-control" style="min-height: 100px;">{{ old('description', $galeri->description) }}</textarea>
            </div>

            <div style="margin-top: 1.5rem; display: flex; gap: 0.75rem;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.galeri.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
