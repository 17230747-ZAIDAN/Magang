@extends('v_admin.layouts.app')

@section('title', 'Edit Dokumen')

@section('content')
<div class="page-header">
    <div>
        <h1>Edit Dokumen</h1>
        <p>Perbarui rincian atau ganti berkas dokumen.</p>
    </div>
    <div>
        <a href="{{ route('admin.dokumen.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Dokumen
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.dokumen.update', $dokumen->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label" for="title">Judul Dokumen <span style="color: red;">*</span></label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $dokumen->title) }}" required>
            </div>

            <div class="grid grid-cols-3">
                <div class="form-group">
                    <label class="form-label" for="type">Tipe Dokumen <span style="color: red;">*</span></label>
                    <select id="type" name="type" class="form-control" required>
                        @foreach($types as $t)
                        <option value="{{ $t }}" {{ old('type', $dokumen->type) == $t ? 'selected' : '' }}>{{ $t }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="number">Nomor Dokumen</label>
                    <input type="text" id="number" name="number" class="form-control" value="{{ old('number', $dokumen->number) }}">
                </div>

                <div class="form-group">
                    <label class="form-label" for="year">Tahun Dokumen</label>
                    <input type="number" id="year" name="year" class="form-control" value="{{ old('year', $dokumen->year) }}">
                </div>
            </div>

            <div class="grid grid-cols-2">
                <div class="form-group">
                    <label class="form-label" for="document_date">Tanggal Penetapan / Pengesahan</label>
                    <input type="date" id="document_date" name="document_date" class="form-control" value="{{ old('document_date', $dokumen->document_date ? $dokumen->document_date->format('Y-m-d') : '') }}">
                </div>

                <div class="form-group">
                    <label class="form-label" for="file">Ganti Berkas File (PDF/DOC)</label>
                    @if($dokumen->file_path && file_exists(public_path($dokumen->file_path)))
                    <div style="margin-bottom: 0.5rem;">
                        <a href="{{ asset($dokumen->file_path) }}" target="_blank" class="btn btn-sm btn-outline">
                            <i class="fas fa-file-pdf"></i> Lihat Berkas Saat Ini
                        </a>
                    </div>
                    @endif
                    <input type="file" id="file" name="file" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx">
                    <div class="form-text">Biarkan kosong jika tidak ingin mengganti file.</div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="file_url">Tautan / URL Eksternal (Opsional)</label>
                <input type="url" id="file_url" name="file_url" class="form-control" value="{{ old('file_url', $dokumen->file_url) }}">
            </div>

            <div class="form-group">
                <label class="form-label" for="description">Keterangan / Abstrak Singkat</label>
                <textarea id="description" name="description" class="form-control" style="min-height: 100px;">{{ old('description', $dokumen->description) }}</textarea>
            </div>

            <div style="margin-top: 1.5rem; display: flex; gap: 0.75rem;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.dokumen.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
