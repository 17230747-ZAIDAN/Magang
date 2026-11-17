@extends('v_admin.layouts.app')

@section('title', 'Manajemen Dokumen & JDIH')

@section('content')
<div class="page-header">
    <div>
        <h1>Dokumen Legislasi & JDIH</h1>
        <p>Kelola peraturan daerah, keputusan DPRD, dan risalah sidang.</p>
    </div>
    <div>
        <a href="{{ route('admin.dokumen.create') }}" class="btn btn-primary">
            <i class="fas fa-file-upload"></i> Tambah Dokumen
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <form method="GET" action="{{ route('admin.dokumen.index') }}" style="display: flex; gap: 0.75rem; flex-wrap: wrap; width: 100%;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul atau nomor dokumen..." class="form-control" style="max-width: 280px;">
            <select name="type" class="form-control" style="max-width: 200px;">
                <option value="">Semua Tipe</option>
                @foreach($types as $t)
                <option value="{{ $t }}" {{ request('type') == $t ? 'selected' : '' }}>{{ $t }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i> Cari</button>
            @if(request('search') || request('type'))
            <a href="{{ route('admin.dokumen.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-redo"></i> Reset</a>
            @endif
        </form>
    </div>

    <div class="card-body" style="padding: 0;">
        <div class="table-responsive">
            <table class="adm-table">
                <thead>
                    <tr>
                        <th>Tipe & Nomor</th>
                        <th>Judul Dokumen</th>
                        <th>Tahun</th>
                        <th>Berkas</th>
                        <th>Unduhan</th>
                        <th style="width: 140px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($documents as $doc)
                    <tr>
                        <td>
                            <span class="badge badge-info">{{ $doc->type }}</span>
                            <div style="font-size: 0.78rem; color: var(--adm-text-muted); margin-top: 3px;">
                                {{ $doc->number ?? 'Tanpa Nomor' }}
                            </div>
                        </td>
                        <td>
                            <div style="font-weight: 600; color: var(--adm-primary);">{{ $doc->title }}</div>
                            @if($doc->description)
                            <div style="font-size: 0.78rem; color: var(--adm-text-muted);">{{ Str::limit($doc->description, 60) }}</div>
                            @endif
                        </td>
                        <td style="font-weight: 600;">{{ $doc->year ?? '-' }}</td>
                        <td>
                            @if($doc->file_path && file_exists(public_path($doc->file_path)))
                                <a href="{{ asset($doc->file_path) }}" target="_blank" class="btn btn-sm btn-outline" style="color: var(--adm-primary-light);">
                                    <i class="fas fa-file-pdf"></i> PDF
                                </a>
                            @elseif($doc->file_url)
                                <a href="{{ $doc->file_url }}" target="_blank" class="btn btn-sm btn-outline">
                                    <i class="fas fa-link"></i> Link
                                </a>
                            @else
                                <span style="color: var(--adm-text-muted); font-size: 0.8rem;">-</span>
                            @endif
                        </td>
                        <td style="font-size: 0.85rem;"><i class="fas fa-download"></i> {{ $doc->downloads ?? 0 }}</td>
                        <td style="text-align: center;">
                            <div style="display: flex; gap: 0.4rem; justify-content: center;">
                                <a href="{{ route('admin.dokumen.edit', $doc->id) }}" class="btn btn-sm btn-outline" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.dokumen.destroy', $doc->id) }}" method="POST" onsubmit="return confirm('Hapus dokumen ini?')">
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
                            Tidak ada dokumen yang ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($documents->hasPages())
    <div style="padding: 1rem 1.35rem; border-top: 1px solid var(--adm-border);">
        {{ $documents->links() }}
    </div>
    @endif
</div>
@endsection
