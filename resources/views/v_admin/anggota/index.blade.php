@extends('v_admin.layouts.app')

@section('title', 'Manajemen Anggota Dewan')

@section('content')
<div class="page-header">
    <div>
        <h1>Data Anggota Dewan</h1>
        <p>Kelola profil anggota dewan, fraksi, komisi, dan daerah pemilihan.</p>
    </div>
    <div>
        <a href="{{ route('admin.anggota.create') }}" class="btn btn-primary">
            <i class="fas fa-user-plus"></i> Tambah Anggota Baru
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <form method="GET" action="{{ route('admin.anggota.index') }}" style="display: flex; gap: 0.75rem; flex-wrap: wrap; width: 100%;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau komisi..." class="form-control" style="max-width: 280px;">
            <select name="party" class="form-control" style="max-width: 200px;">
                <option value="">Semua Partai</option>
                @foreach($parties as $p)
                <option value="{{ $p }}" {{ request('party') == $p ? 'selected' : '' }}>{{ $p }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i> Filter</button>
            @if(request('search') || request('party'))
            <a href="{{ route('admin.anggota.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-redo"></i> Reset</a>
            @endif
        </form>
    </div>

    <div class="card-body" style="padding: 0;">
        <div class="table-responsive">
            <table class="adm-table">
                <thead>
                    <tr>
                        <th style="width: 60px;">Foto</th>
                        <th>Nama & Jabatan</th>
                        <th>Partai / Fraksi</th>
                        <th>Dapil</th>
                        <th>Komisi</th>
                        <th>Status</th>
                        <th style="width: 140px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($members as $m)
                    <tr>
                        <td>
                            @if($m->photo && file_exists(public_path($m->photo)))
                            <img src="{{ asset($m->photo) }}" alt="{{ $m->name }}" style="width: 44px; height: 44px; border-radius: 50%; object-fit: cover; border: 1px solid var(--adm-border);">
                            @else
                            <div style="width: 44px; height: 44px; border-radius: 50%; background: #E2E8F0; display: flex; align-items: center; justify-content: center; color: #718096; font-size: 1.1rem;">
                                <i class="fas fa-user"></i>
                            </div>
                            @endif
                        </td>
                        <td>
                            <div style="font-weight: 600; color: var(--adm-primary);">{{ $m->name }}</div>
                            <div style="font-size: 0.78rem; color: var(--adm-accent-hover); font-weight: 600;">
                                {{ $m->position ?? 'Anggota DPRD' }}
                            </div>
                        </td>
                        <td>
                            <div style="font-weight: 500;">{{ $m->party }}</div>
                            <div style="font-size: 0.75rem; color: var(--adm-text-muted);">{{ $m->faction ?? '-' }}</div>
                        </td>
                        <td style="font-size: 0.85rem;">{{ $m->electoral_district }}</td>
                        <td><span class="badge badge-info">{{ $m->commission ?? '-' }}</span></td>
                        <td>
                            @if($m->is_active)
                                <span class="badge badge-success">Aktif</span>
                            @else
                                <span class="badge badge-danger">Non-Aktif</span>
                            @endif
                        </td>
                        <td style="text-align: center;">
                            <div style="display: flex; gap: 0.4rem; justify-content: center;">
                                <a href="{{ route('admin.anggota.edit', $m->id) }}" class="btn btn-sm btn-outline" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.anggota.destroy', $m->id) }}" method="POST" onsubmit="return confirm('Hapus anggota dewan ini?')">
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
                        <td colspan="7" style="text-align: center; padding: 2rem; color: var(--adm-text-muted);">
                            Tidak ada data anggota dewan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($members->hasPages())
    <div style="padding: 1rem 1.35rem; border-top: 1px solid var(--adm-border);">
        {{ $members->links() }}
    </div>
    @endif
</div>
@endsection
