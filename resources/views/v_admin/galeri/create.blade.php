@extends('v_admin.layouts.app')

@section('title', 'Tambah Foto Galeri')

@section('content')
<div class="page-header">
    <div>
        <h1>Tambah Foto Galeri</h1>
        <p>Unggah dokumentasi foto kegiatan dewan dan kegiatan kedewanan.</p>
    </div>
    <div>
        <a href="{{ route('admin.galeri.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Galeri
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label class="form-label" for="title">Judul / Kegiatan <span style="color: red;">*</span></label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" placeholder="Contoh: Rapat Paripurna Istimewa HUT Kota Tangsel" required>
            </div>

            <div class="grid grid-cols-2">
                <div class="form-group">
                    <label class="form-label" for="category">Kategori Kegiatan <span style="color: red;">*</span></label>
                    <select id="category" name="category" class="form-control" required>
                        @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="event_date">Tanggal Pelaksanaan</label>
                    <input type="date" id="event_date" name="event_date" class="form-control" value="{{ old('event_date', date('Y-m-d')) }}">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="image">Berkas Foto <span style="color: red;">*</span></label>
                <input type="file" id="image" name="image" class="form-control" accept="image/*" required>
                <div class="form-text">Format didukung: JPG, JPEG, PNG, WEBP (Maksimal 3MB).</div>
            </div>

            <div class="form-group">
                <label class="form-label" for="description">Deskripsi / Keterangan Tambahan</label>
                <textarea id="description" name="description" class="form-control" style="min-height: 100px;" placeholder="Tuliskan keterangan singkat kegiatan yang berlangsung...">{{ old('description') }}</textarea>
            </div>

            <div style="margin-top: 1.5rem; display: flex; gap: 0.75rem;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-upload"></i> Unggah Foto
                </button>
                <a href="{{ route('admin.galeri.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
