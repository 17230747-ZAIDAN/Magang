@extends('v_admin.layouts.app')

@section('title', 'Ganti Password Akun')

@section('content')
<div class="page-header">
    <div>
        <h1>Keamanan Akun & Ganti Password</h1>
        <p>Perbarui kata sandi akun Anda secara berkala untuk menjaga keamanan portal.</p>
    </div>
    <div>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>
</div>

<div class="grid grid-cols-3">
    <!-- Form Ganti Password (2 Kolom) -->
    <div style="grid-column: span 2;">
        <div class="card">
            <div class="card-header">
                <h3>Formulir Pembaruan Password</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.password.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="form-label" for="current_password">Password Saat Ini <span style="color: red;">*</span></label>
                        <div style="position: relative;">
                            <input type="password" id="current_password" name="current_password" class="form-control" placeholder="Masukkan password yang aktif saat ini" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-2">
                        <div class="form-group">
                            <label class="form-label" for="new_password">Password Baru <span style="color: red;">*</span></label>
                            <input type="password" id="new_password" name="new_password" class="form-control" placeholder="Minimal 6 karakter" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="new_password_confirmation">Ulangi Password Baru <span style="color: red;">*</span></label>
                            <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" placeholder="Ketik ulang password baru" required>
                        </div>
                    </div>

                    <div style="margin-top: 1.5rem; display: flex; gap: 0.75rem;">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-key"></i> Simpan Password Baru
                        </button>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Informasi Akun (1 Kolom) -->
    <div>
        <div class="card">
            <div class="card-header">
                <h3>Informasi Login Anda</h3>
            </div>
            <div class="card-body" style="font-size: 0.875rem;">
                <div style="text-align: center; padding: 1rem 0;">
                    <div style="width: 60px; height: 60px; border-radius: 50%; background: var(--adm-primary); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 700; margin: 0 auto 0.75rem;">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div style="font-weight: 700; font-size: 1.05rem; color: var(--adm-primary);">{{ $user->name }}</div>
                    <div style="margin-top: 0.25rem;">
                        @if($user->isAdmin())
                            <span class="badge badge-warning"><i class="fas fa-shield-alt"></i> Administrator Utama</span>
                        @else
                            <span class="badge badge-info"><i class="fas fa-graduation-cap"></i> Peserta Magang</span>
                        @endif
                    </div>
                </div>

                <div style="border-top: 1px solid var(--adm-border); padding-top: 1rem; margin-top: 0.5rem;">
                    <div style="margin-bottom: 0.75rem;">
                        <div style="font-size: 0.75rem; color: var(--adm-text-muted); font-weight: 600;">EMAIL TERDAFTAR</div>
                        <div style="font-weight: 500;">{{ $user->email }}</div>
                    </div>

                    @if($user->institution)
                    <div style="margin-bottom: 0.75rem;">
                        <div style="font-size: 0.75rem; color: var(--adm-text-muted); font-weight: 600;">ASAL INSTANSI</div>
                        <div style="font-weight: 500;">{{ $user->institution }}</div>
                    </div>
                    @endif

                    <div style="background: #F8FAFC; border: 1px solid var(--adm-border); border-radius: 8px; padding: 0.85rem; margin-top: 1rem;">
                        <div style="font-weight: 600; font-size: 0.8rem; color: var(--adm-primary); margin-bottom: 0.25rem;">
                            <i class="fas fa-lightbulb" style="color: var(--adm-accent);"></i> Tips Password Kuat:
                        </div>
                        <ul style="padding-left: 1.25rem; font-size: 0.78rem; color: var(--adm-text-muted); line-height: 1.5;">
                            <li>Gunakan kombinasi huruf besar, kecil, angka, dan simbol.</li>
                            <li>Hindari tanggal lahir atau kata umum.</li>
                            <li>Jangan bagikan password kepada pihak lain.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
