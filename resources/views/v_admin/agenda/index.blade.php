@extends('v_admin.layouts.app')

@section('title', 'Agenda Sidang & Rapat')

@section('content')
<div class="page-header">
    <div>
        <h1>Agenda Sidang & Rapat</h1>
        <p>Jadwal sidang paripurna, rapat komisi, dan agenda resmi dewan.</p>
    </div>
    <div>
        <a href="{{ route('admin.agenda.create') }}" class="btn btn-primary">
            <i class="fas fa-calendar-plus"></i> Tambah Agenda
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <form method="GET" action="{{ route('admin.agenda.index') }}" style="display: flex; gap: 0.75rem; flex-wrap: wrap; width: 100%;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama agenda atau lokasi..." class="form-control" style="max-width: 280px;">
            <select name="status" class="form-control" style="max-width: 200px;">
                <option value="">Semua Status</option>
                <option value="scheduled" {{ request('status') == 'scheduled' ? 'selected' : '' }}>Terjadwal</option>
                <option value="ongoing" {{ request('status') == 'ongoing' ? 'selected' : '' }}>Berlangsung</option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i> Cari</button>
            @if(request('search') || request('status'))
            <a href="{{ route('admin.agenda.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-redo"></i> Reset</a>
            @endif
        </form>
    </div>

    <div class="card-body" style="padding: 0;">
        <div class="table-responsive">
            <table class="adm-table">
                <thead>
                    <tr>
                        <th>Waktu Pelaksanaan</th>
                        <th>Agenda</th>
                        <th>Tipe / Komisi</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th style="width: 140px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($agendas as $ag)
                    <tr>
                        <td>
                            <div style="font-weight: 600; color: var(--adm-primary);">
                                {{ \Carbon\Carbon::parse($ag->start_time)->format('d M Y') }}
                            </div>
                            <div style="font-size: 0.78rem; color: var(--adm-text-muted);">
                                {{ \Carbon\Carbon::parse($ag->start_time)->format('H:i') }} WIB
                                @if($ag->end_time)
                                 - {{ \Carbon\Carbon::parse($ag->end_time)->format('H:i') }} WIB
                                @endif
                            </div>
                        </td>
                        <td>
                            <div style="font-weight: 600;">{{ $ag->title }}</div>
                            @if($ag->description)
                            <div style="font-size: 0.78rem; color: var(--adm-text-muted);">{{ Str::limit($ag->description, 60) }}</div>
                            @endif
                        </td>
                        <td>
                            <span class="badge badge-info">{{ $ag->type }}</span>
                            @if($ag->commission)
                            <div style="font-size: 0.75rem; color: var(--adm-text-muted); margin-top: 2px;">{{ $ag->commission }}</div>
                            @endif
                        </td>
                        <td style="font-size: 0.85rem;"><i class="fas fa-map-marker-alt" style="color: var(--adm-accent);"></i> {{ $ag->location ?? 'Gedung DPRD' }}</td>
                        <td>
                            @if($ag->status === 'scheduled')
                                <span class="badge badge-warning">Terjadwal</span>
                            @elseif($ag->status === 'ongoing')
                                <span class="badge badge-info">Berlangsung</span>
                            @elseif($ag->status === 'completed')
                                <span class="badge badge-success">Selesai</span>
                            @else
                                <span class="badge badge-danger">Dibatalkan</span>
                            @endif
                        </td>
                        <td style="text-align: center;">
                            <div style="display: flex; gap: 0.4rem; justify-content: center;">
                                <a href="{{ route('admin.agenda.edit', $ag->id) }}" class="btn btn-sm btn-outline" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.agenda.destroy', $ag->id) }}" method="POST" onsubmit="return confirm('Hapus agenda ini?')">
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
                            Tidak ada data agenda sidang.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($agendas->hasPages())
    <div style="padding: 1rem 1.35rem; border-top: 1px solid var(--adm-border);">
        {{ $agendas->links() }}
    </div>
    @endif
</div>
@endsection
