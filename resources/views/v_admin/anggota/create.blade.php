@extends('v_admin.layouts.app')

@section('title', 'Tambah Anggota Dewan')

@section('content')
<div class="page-header">
    <div>
        <h1>Tambah Anggota Dewan Baru</h1>
        <p>Tambahkan data anggota DPRD, dapil, dan jabatan komisi.</p>
    </div>
    <div>
        <a href="{{ route('admin.anggota.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.anggota.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-2">
                <div class="form-group">
                    <label class="form-label" for="name">Nama Lengkap & Gelar <span style="color: red;">*</span></label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" placeholder="Contoh: Drs. H. Ahmad Fauzi, M.Si." required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="party">Partai Politik <span style="color: red;">*</span></label>
                    <input type="text" id="party" name="party" class="form-control" value="{{ old('party') }}" placeholder="Contoh: Partai Golkar / PDI Perjuangan / PKS" required>
                </div>
            </div>

            <div class="grid grid-cols-3">
                <div class="form-group">
                    <label class="form-label" for="electoral_district">Daerah Pemilihan (Dapil) <span style="color: red;">*</span></label>
                    <input type="text" id="electoral_district" name="electoral_district" class="form-control" value="{{ old('electoral_district') }}" placeholder="Contoh: Tangsel 1 (Ciputat)" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="position">Jabatan</label>
                    <input type="text" id="position" name="position" class="form-control" value="{{ old('position', 'Anggota') }}" placeholder="Contoh: Ketua DPRD / Anggota">
                </div>

                <div class="form-group">
                    <label class="form-label" for="commission">Komisi</label>
                    <input type="text" id="commission" name="commission" class="form-control" value="{{ old('commission') }}" placeholder="Contoh: Komisi I / Komisi II / Banggar">
                </div>
            </div>

            <div class="grid grid-cols-3">
                <div class="form-group">
                    <label class="form-label" for="faction">Fraksi</label>
                    <input type="text" id="faction" name="faction" class="form-control" value="{{ old('faction') }}" placeholder="Contoh: Fraksi Golkar">
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">Alamat Email</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="anggota@dprd.tangsel.go.id">
                </div>

                <div class="form-group">
                    <label class="form-label" for="phone">Nomor Telepon</label>
                    <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="0812xxxxxxxx">
                </div>
            </div>

            <div class="grid grid-cols-2">
                <div class="form-group">
                    <label class="form-label" for="photo">Foto Profil Anggota</label>
                    <input type="file" id="photo" name="photo" class="form-control" accept="image/*">
                    <div class="form-text">Format didukung: JPG, PNG, WEBP (Maksimal 2MB). Disarankan foto resmi.</div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="education">Riwayat Pendidikan Terakhir</label>
                    <input type="text" id="education" name="education" class="form-control" value="{{ old('education') }}" placeholder="Contoh: S2 Magister Manajemen Universitas Indonesia">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="biography">Biografi Singkat / Profil</label>
                <textarea id="biography" name="biography" class="form-control" style="min-height: 140px;" placeholder="Tuliskan ringkasan profil, visi misi, atau riwayat organisasi...">{{ old('biography') }}</textarea>
            </div>

            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }}>
                    <span style="font-weight: 600; font-size: 0.875rem;">Status Aktif Sebagai Anggota Dewan</span>
                </label>
            </div>

            <div style="margin-top: 1.5rem; display: flex; gap: 0.75rem;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Data Anggota
                </button>
                <a href="{{ route('admin.anggota.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
