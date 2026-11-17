@extends('v_admin.layouts.app')

@section('title', 'Tinjau Aspirasi Warga')

@section('content')
<div class="page-header">
    <div>
        <h1>Tinjau & Tanggapi Aspirasi</h1>
        <p>Lihat detail aspirasi yang dikirim masyarakat serta berikan tanggapan resmi.</p>
    </div>
    <div>
        <a href="{{ route('admin.aspirasi.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>
</div>

<div class="grid grid-cols-3">
    <!-- Detail Aspirasi (2 Kolom) -->
    <div style="grid-column: span 2;">
        <div class="card">
            <div class="card-header">
                <h3>Isi Pesan Aspirasi</h3>
                <span class="badge badge-info">{{ $aspirasi->category }}</span>
            </div>
            <div class="card-body">
                <h2 style="font-size: 1.25rem; color: var(--adm-primary); margin-bottom: 0.75rem;">
                    {{ $aspirasi->subject }}
                </h2>
                <div style="font-size: 0.82rem; color: var(--adm-text-muted); margin-bottom: 1.5rem; display: flex; gap: 1.5rem;">
                    <span><i class="far fa-clock"></i> Masuk: {{ $aspirasi->created_at ? $aspirasi->created_at->format('d F Y - H:i') : '-' }} WIB</span>
                </div>

                <div style="background: #F8FAFC; border: 1px solid var(--adm-border); border-radius: 8px; padding: 1.25rem; font-size: 0.95rem; line-height: 1.7; white-space: pre-line;">
                    {{ $aspirasi->message }}
                </div>
            </div>
        </div>

        <!-- Form Tanggapan -->
        <div class="card">
            <div class="card-header">
                <h3>Tanggapan / Tindak Lanjut Admin</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.aspirasi.update', $aspirasi->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="form-label" for="status">Perbarui Status Aspirasi <span style="color: red;">*</span></label>
                        <select id="status" name="status" class="form-control" required style="max-width: 250px;">
                            <option value="pending" {{ $aspirasi->status === 'pending' ? 'selected' : '' }}>Menunggu Tanggapan</option>
                            <option value="reviewed" {{ $aspirasi->status === 'reviewed' ? 'selected' : '' }}>Sedang Ditinjau (Diproses)</option>
                            <option value="responded" {{ $aspirasi->status === 'responded' ? 'selected' : '' }}>Sudah Diberi Tanggapan (Selesai)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="response">Pesan Tanggapan Resmi</label>
                        <textarea id="response" name="response" class="form-control" style="min-height: 150px;" placeholder="Tuliskan tanggapan atau penjelasan tindak lanjut atas aspirasi ini...">{{ old('response', $aspirasi->response) }}</textarea>
                        <div class="form-text">Tanggapan ini dapat dilihat oleh pengirim ketika mengecek status aspirasi mereka di website.</div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Simpan Status & Tanggapan
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Data Pengirim (1 Kolom) -->
    <div>
        <div class="card">
            <div class="card-header">
                <h3>Informasi Pengirim</h3>
            </div>
            <div class="card-body" style="font-size: 0.875rem;">
                <div style="margin-bottom: 1rem;">
                    <div style="font-size: 0.75rem; color: var(--adm-text-muted); font-weight: 600;">NAMA PENGIRIM</div>
                    <div style="font-weight: 600; color: var(--adm-primary); font-size: 1rem;">{{ $aspirasi->name }}</div>
                </div>

                <div style="margin-bottom: 1rem;">
                    <div style="font-size: 0.75rem; color: var(--adm-text-muted); font-weight: 600;">EMAIL</div>
                    <div><a href="mailto:{{ $aspirasi->email }}" style="color: var(--adm-primary-light); text-decoration: none;">{{ $aspirasi->email }}</a></div>
                </div>

                <div style="margin-bottom: 1rem;">
                    <div style="font-size: 0.75rem; color: var(--adm-text-muted); font-weight: 600;">NOMOR TELEPON / WA</div>
                    <div>{{ $aspirasi->phone ?? '-' }}</div>
                </div>

                <div style="margin-bottom: 1rem;">
                    <div style="font-size: 0.75rem; color: var(--adm-text-muted); font-weight: 600;">DOMISILI</div>
                    <div>{{ $aspirasi->city ?? '-' }}, {{ $aspirasi->province ?? '-' }}</div>
                </div>

                <div style="margin-bottom: 1rem;">
                    <div style="font-size: 0.75rem; color: var(--adm-text-muted); font-weight: 600;">ALAMAT LENGKAP</div>
                    <div>{{ $aspirasi->address ?? '-' }}</div>
                </div>

                <div style="padding-top: 1rem; border-top: 1px solid var(--adm-border);">
                    <div style="font-size: 0.75rem; color: var(--adm-text-muted); font-weight: 600;">STATUS SAAT INI</div>
                    <div style="margin-top: 0.35rem;">
                        @if($aspirasi->status === 'pending')
                            <span class="badge badge-warning">Menunggu Tanggapan</span>
                        @elseif($aspirasi->status === 'reviewed')
                            <span class="badge badge-info">Sedang Ditinjau</span>
                        @else
                            <span class="badge badge-success">Sudah Dibalas</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
