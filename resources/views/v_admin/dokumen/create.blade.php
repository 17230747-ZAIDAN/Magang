@extends('v_admin.layouts.app')

@section('title', 'Tambah Dokumen')

@section('content')
<div class="page-header">
    <div>
        <h1>Tambah Dokumen Baru</h1>
        <p>Unggah produk hukum, perda, atau risalah rapat dewan.</p>
    </div>
    <div>
        <a href="{{ route('admin.dokumen.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Dokumen
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.dokumen.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label class="form-label" for="title">Judul Dokumen <span style="color: red;">*</span></label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" placeholder="Contoh: Peraturan Daerah Kota Tangsel tentang Pajak Daerah" required>
            </div>

            <div class="grid grid-cols-3">
                <div class="form-group">
                    <label class="form-label" for="type">Tipe Dokumen <span style="color: red;">*</span></label>
                    <select id="type" name="type" class="form-control" required>
                        @foreach($types as $t)
                        <option value="{{ $t }}" {{ old('type') == $t ? 'selected' : '' }}>{{ $t }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="number">Nomor Dokumen</label>
                    <input type="text" id="number" name="number" class="form-control" value="{{ old('number') }}" placeholder="Contoh: No. 12 Tahun 2024">
                </div>

                <div class="form-group">
                    <label class="form-label" for="year">Tahun Dokumen</label>
                    <input type="number" id="year" name="year" class="form-control" value="{{ old('year', date('Y')) }}" placeholder="2024">
                </div>
            </div>

            <div class="grid grid-cols-2">
                <div class="form-group">
                    <label class="form-label" for="document_date">Tanggal Penetapan / Pengesahan</label>
                    <input type="date" id="document_date" name="document_date" class="form-control" value="{{ old('document_date', date('Y-m-d')) }}">
                </div>

                <div class="form-group">
                    <label class="form-label" for="file">Unggah Berkas File (PDF/DOC)</label>
                    <input type="file" id="file" name="file" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx">
                    <div class="form-text">Maksimal 10MB (Format PDF direkomendasikan).</div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="file_url">Tautan / URL Eksternal (Opsional)</label>
                <input type="url" id="file_url" name="file_url" class="form-control" value="{{ old('file_url') }}" placeholder="https://jdih.tangerangselatankota.go.id/dokumen/...">
                <div class="form-text">Gunakan ini jika file di-host di portal eksternal seperti JDIH Kota.</div>
            </div>

            <div class="form-group">
                <label class="form-label" for="description">Keterangan / Abstrak Singkat</label>
                <textarea id="description" name="description" class="form-control" style="min-height: 100px;" placeholder="Tuliskan ringkasan pokok-pokok isi dokumen...">{{ old('description') }}</textarea>
            </div>

            <div style="margin-top: 1.5rem; display: flex; gap: 0.75rem;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Dokumen
                </button>
                <a href="{{ route('admin.dokumen.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
