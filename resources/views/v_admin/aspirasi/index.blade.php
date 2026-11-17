@extends('v_admin.layouts.app')

@section('title', 'Aspirasi Masyarakat')

@section('content')
<div class="page-header">
    <div>
        <h1>Aspirasi Masyarakat Masuk</h1>
        <p>Pantau dan tindak lanjuti pesan, saran, dan aduan dari masyarakat.</p>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <form method="GET" action="{{ route('admin.aspirasi.index') }}" style="display: flex; gap: 0.75rem; flex-wrap: wrap; width: 100%;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, email, atau subjek..." class="form-control" style="max-width: 280px;">
            <select name="status" class="form-control" style="max-width: 200px;">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu Tanggapan</option>
                <option value="reviewed" {{ request('status') == 'reviewed' ? 'selected' : '' }}>Sedang Ditinjau</option>
                <option value="responded" {{ request('status') == 'responded' ? 'selected' : '' }}>Sudah Dibalas</option>
            </select>
            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i> Filter</button>
            @if(request('search') || request('status'))
            <a href="{{ route('admin.aspirasi.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-redo"></i> Reset</a>
            @endif
        </form>
    </div>

    <div class="card-body" style="padding: 0;">
        <div class="table-responsive">
            <table class="adm-table">
                <thead>
                    <tr>
                        <th>Waktu Masuk</th>
                        <th>Pengirim</th>
                        <th>Subjek & Kategori</th>
                        <th>Kota / Domisili</th>
                        <th>Status</th>
                        <th style="width: 140px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($aspirations as $item)
                    <tr>
                        <td style="font-size: 0.8rem; color: var(--adm-text-muted);">
                            {{ $item->created_at ? $item->created_at->format('d/m/Y H:i') : '-' }}
                        </td>
                        <td>
                            <div style="font-weight: 600; color: var(--adm-primary);">{{ $item->name }}</div>
                            <div style="font-size: 0.78rem; color: var(--adm-text-muted);">{{ $item->email }}</div>
                            @if($item->phone)
                            <div style="font-size: 0.75rem; color: var(--adm-text-muted);"><i class="fas fa-phone-alt"></i> {{ $item->phone }}</div>
                            @endif
                        </td>
                        <td>
                            <div style="font-weight: 600;">{{ $item->subject }}</div>
                            <span class="badge badge-info">{{ $item->category }}</span>
                        </td>
                        <td style="font-size: 0.82rem;">{{ $item->city ?? '-' }}</td>
                        <td>
                            @if($item->status === 'pending')
                                <span class="badge badge-warning">Menunggu</span>
                            @elseif($item->status === 'reviewed')
                                <span class="badge badge-info">Ditinjau</span>
                            @else
                                <span class="badge badge-success">Dibalas</span>
                            @endif
                        </td>
                        <td style="text-align: center;">
                            <div style="display: flex; gap: 0.4rem; justify-content: center;">
                                <a href="{{ route('admin.aspirasi.show', $item->id) }}" class="btn btn-sm btn-primary" title="Tinjau & Balas">
                                    <i class="fas fa-eye"></i> Tinjau
                                </a>
                                <form action="{{ route('admin.aspirasi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus aspirasi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 2rem; color: var(--adm-text-muted);">
                            Belum ada aspirasi masuk.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($aspirations->hasPages())
    <div style="padding: 1rem 1.35rem; border-top: 1px solid var(--adm-border);">
        {{ $aspirations->links() }}
    </div>
    @endif
</div>
@endsection
