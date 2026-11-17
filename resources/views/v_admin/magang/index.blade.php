@extends('v_admin.layouts.app')

@section('title', 'Manajemen Akun Magang')

@section('content')
<div class="page-header">
    <div>
        <h1>Manajemen Akun Peserta Magang</h1>
        <p>Kelola akun akses khusus untuk mahasiswa/pelajar magang di lingkungan DPRD.</p>
    </div>
    <div>
        <a href="{{ route('admin.magang.create') }}" class="btn btn-primary">
            <i class="fas fa-user-plus"></i> Tambah Akun Magang
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <form method="GET" action="{{ route('admin.magang.index') }}" style="display: flex; gap: 0.75rem; flex-wrap: wrap; width: 100%;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, email, kampus..." class="form-control" style="max-width: 280px;">
            <select name="status" class="form-control" style="max-width: 180px;">
                <option value="">Semua Status</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Non-Aktif</option>
            </select>
            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i> Cari</button>
            @if(request('search') || request('status'))
            <a href="{{ route('admin.magang.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-redo"></i> Reset</a>
            @endif
        </form>
    </div>

    <div class="card-body" style="padding: 0;">
        <div class="table-responsive">
            <table class="adm-table">
                <thead>
                    <tr>
                        <th>Nama & Email</th>
                        <th>Asal Kampus / Sekolah</th>
                        <th>Periode Magang</th>
                        <th>Kontak / WA</th>
                        <th>Status Akun</th>
                        <th style="width: 180px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($interns as $item)
                    <tr>
                        <td>
                            <div style="font-weight: 600; color: var(--adm-primary);">{{ $item->name }}</div>
                            <div style="font-size: 0.78rem; color: var(--adm-text-muted);">{{ $item->email }}</div>
                        </td>
                        <td>
                            <div style="font-weight: 500;">{{ $item->institution ?? '-' }}</div>
                            <span class="badge badge-info" style="font-size: 0.7rem;">Magang</span>
                        </td>
                        <td style="font-size: 0.82rem;">
                            {{ $item->internship_period ?? '-' }}
                        </td>
                        <td style="font-size: 0.82rem;">
                            {{ $item->phone ?? '-' }}
                        </td>
                        <td>
                            @if($item->is_active)
                                <span class="badge badge-success"><i class="fas fa-check-circle"></i> Aktif</span>
                            @else
                                <span class="badge badge-danger"><i class="fas fa-ban"></i> Non-Aktif</span>
                            @endif
                        </td>
                        <td style="text-align: center;">
                            <div style="display: flex; gap: 0.4rem; justify-content: center;">
                                <!-- Toggle Status -->
                                <form action="{{ route('admin.magang.toggle', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm {{ $item->is_active ? 'btn-secondary' : 'btn-success' }}" title="{{ $item->is_active ? 'Nonaktifkan Akun' : 'Aktifkan Akun' }}">
                                        <i class="fas {{ $item->is_active ? 'fa-user-slash' : 'fa-user-check' }}"></i>
                                    </button>
                                </form>

                                <!-- Edit -->
                                <a href="{{ route('admin.magang.edit', $item->id) }}" class="btn btn-sm btn-outline" title="Edit Akun">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Delete -->
                                <form action="{{ route('admin.magang.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus akun magang {{ $item->name }}?')">
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
                        <td colspan="6" style="text-align: center; padding: 2.5rem; color: var(--adm-text-muted);">
                            Belum ada akun peserta magang yang ditambahkan. Silakan klik tombol "Tambah Akun Magang".
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($interns->hasPages())
    <div style="padding: 1rem 1.35rem; border-top: 1px solid var(--adm-border);">
        {{ $interns->links() }}
    </div>
    @endif
</div>
@endsection
