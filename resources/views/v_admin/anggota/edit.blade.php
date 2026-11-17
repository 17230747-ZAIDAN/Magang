@extends('v_admin.layouts.app')

@section('title', 'Edit Anggota Dewan')

@section('content')
<div class="page-header">
    <div>
        <h1>Edit Anggota Dewan</h1>
        <p>Perbarui informasi biodata, jabatan, dan foto anggota.</p>
    </div>
    <div>
        <a href="{{ route('admin.anggota.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.anggota.update', $member->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2">
                <div class="form-group">
                    <label class="form-label" for="name">Nama Lengkap & Gelar <span style="color: red;">*</span></label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $member->name) }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="party">Partai Politik <span style="color: red;">*</span></label>
                    <input type="text" id="party" name="party" class="form-control" value="{{ old('party', $member->party) }}" required>
                </div>
            </div>

            <div class="grid grid-cols-3">
                <div class="form-group">
                    <label class="form-label" for="electoral_district">Daerah Pemilihan (Dapil) <span style="color: red;">*</span></label>
                    <input type="text" id="electoral_district" name="electoral_district" class="form-control" value="{{ old('electoral_district', $member->electoral_district) }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="position">Jabatan</label>
                    <input type="text" id="position" name="position" class="form-control" value="{{ old('position', $member->position) }}">
                </div>

                <div class="form-group">
                    <label class="form-label" for="commission">Komisi</label>
                    <input type="text" id="commission" name="commission" class="form-control" value="{{ old('commission', $member->commission) }}">
                </div>
            </div>

            <div class="grid grid-cols-3">
                <div class="form-group">
                    <label class="form-label" for="faction">Fraksi</label>
                    <input type="text" id="faction" name="faction" class="form-control" value="{{ old('faction', $member->faction) }}">
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">Alamat Email</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $member->email) }}">
                </div>

                <div class="form-group">
                    <label class="form-label" for="phone">Nomor Telepon</label>
                    <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', $member->phone) }}">
                </div>
            </div>

            <div class="grid grid-cols-2">
                <div class="form-group">
                    <label class="form-label" for="photo">Ganti Foto Profil Anggota</label>
                    @if($member->photo && file_exists(public_path($member->photo)))
                    <div style="margin-bottom: 0.75rem; display: flex; align-items: center; gap: 0.75rem;">
                        <img src="{{ asset($member->photo) }}" alt="Preview" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; border: 1px solid var(--adm-border);">
                        <span style="font-size: 0.8rem; color: var(--adm-text-muted);">Foto saat ini</span>
                    </div>
                    @endif
                    <input type="file" id="photo" name="photo" class="form-control" accept="image/*">
                    <div class="form-text">Biarkan kosong jika tidak ingin mengganti foto.</div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="education">Riwayat Pendidikan Terakhir</label>
                    <input type="text" id="education" name="education" class="form-control" value="{{ old('education', $member->education) }}">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="biography">Biografi Singkat / Profil</label>
                <textarea id="biography" name="biography" class="form-control" style="min-height: 140px;">{{ old('biography', $member->biography) }}</textarea>
            </div>

            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $member->is_active) ? 'checked' : '' }}>
                    <span style="font-weight: 600; font-size: 0.875rem;">Status Aktif Sebagai Anggota Dewan</span>
                </label>
            </div>

            <div style="margin-top: 1.5rem; display: flex; gap: 0.75rem;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.anggota.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
