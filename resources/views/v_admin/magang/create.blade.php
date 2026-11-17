@extends('v_admin.layouts.app')

@section('title', 'Tambah Akun Magang')

@section('content')
<div class="page-header">
    <div>
        <h1>Tambah Akun Peserta Magang</h1>
        <p>Buat akun login baru khusus untuk mahasiswa/pelajar magang.</p>
    </div>
    <div>
        <a href="{{ route('admin.magang.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>
</div>

<div class="card" style="max-width: 800px;">
    <div class="card-body">
        <form action="{{ route('admin.magang.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-2">
                <div class="form-group">
                    <label class="form-label" for="name">Nama Lengkap Peserta Magang <span style="color: red;">*</span></label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" placeholder="Contoh: Muhammad Rizki" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="institution">Asal Kampus / Sekolah <span style="color: red;">*</span></label>
                    <input type="text" id="institution" name="institution" class="form-control" value="{{ old('institution') }}" placeholder="Contoh: Universitas Pamulang / UIN Syarif Hidayatullah" required>
                </div>
            </div>

            <div class="grid grid-cols-2">
                <div class="form-group">
                    <label class="form-label" for="email">Alamat Email (Untuk Login) <span style="color: red;">*</span></label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="magang.rizki@gmail.com" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password Akun <span style="color: red;">*</span></label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required>
                </div>
            </div>

            <div class="grid grid-cols-2">
                <div class="form-group">
                    <label class="form-label" for="internship_period">Periode / Durasi Magang</label>
                    <input type="text" id="internship_period" name="internship_period" class="form-control" value="{{ old('internship_period') }}" placeholder="Contoh: 1 Januari - 31 Maret 2026">
                </div>

                <div class="form-group">
                    <label class="form-label" for="phone">Nomor Telepon / WhatsApp</label>
                    <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="08123456789">
                </div>
            </div>

            <div style="background: #EFF6FF; border: 1px solid #BFDBFE; border-radius: 8px; padding: 1rem; margin-bottom: 1.5rem; font-size: 0.85rem; color: #1E40AF;">
                <i class="fas fa-info-circle"></i> <strong>Informasi Hak Akses:</strong> Akun ini akan otomatis memiliki role <strong>Peserta Magang</strong>. Mereka dapat membantu menginput data berita, galeri, agenda, dan dokumen, namun <strong>tidak memiliki hak</strong> untuk mengelola akun pengguna lain.
            </div>

            <div style="display: flex; gap: 0.75rem;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Buat Akun Magang
                </button>
                <a href="{{ route('admin.magang.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
