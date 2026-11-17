@extends('v_admin.layouts.app')

@section('title', 'Edit Akun Magang')

@section('content')
<div class="page-header">
    <div>
        <h1>Edit Akun Peserta Magang</h1>
        <p>Perbarui data profil, asal kampus, atau ganti password akun magang.</p>
    </div>
    <div>
        <a href="{{ route('admin.magang.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>
</div>

<div class="card" style="max-width: 800px;">
    <div class="card-body">
        <form action="{{ route('admin.magang.update', $magang->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2">
                <div class="form-group">
                    <label class="form-label" for="name">Nama Lengkap Peserta Magang <span style="color: red;">*</span></label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $magang->name) }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="institution">Asal Kampus / Sekolah <span style="color: red;">*</span></label>
                    <input type="text" id="institution" name="institution" class="form-control" value="{{ old('institution', $magang->institution) }}" required>
                </div>
            </div>

            <div class="grid grid-cols-2">
                <div class="form-group">
                    <label class="form-label" for="email">Alamat Email (Untuk Login) <span style="color: red;">*</span></label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $magang->email) }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Ganti Password (Opsional)</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Biarkan kosong jika tidak ingin mengubah password">
                </div>
            </div>

            <div class="grid grid-cols-2">
                <div class="form-group">
                    <label class="form-label" for="internship_period">Periode / Durasi Magang</label>
                    <input type="text" id="internship_period" name="internship_period" class="form-control" value="{{ old('internship_period', $magang->internship_period) }}">
                </div>

                <div class="form-group">
                    <label class="form-label" for="phone">Nomor Telepon / WhatsApp</label>
                    <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', $magang->phone) }}">
                </div>
            </div>

            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $magang->is_active) ? 'checked' : '' }}>
                    <span style="font-weight: 600; font-size: 0.875rem;">Status Akun Aktif (Beri tanda centang agar anak magang bisa login)</span>
                </label>
            </div>

            <div style="margin-top: 1.5rem; display: flex; gap: 0.75rem;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.magang.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
