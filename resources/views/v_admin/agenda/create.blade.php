@extends('v_admin.layouts.app')

@section('title', 'Tambah Agenda Sidang')

@section('content')
<div class="page-header">
    <div>
        <h1>Tambah Agenda Sidang Baru</h1>
        <p>Jadwalkan rapat, sidang paripurna, atau dengar pendapat.</p>
    </div>
    <div>
        <a href="{{ route('admin.agenda.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Agenda
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.agenda.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label" for="title">Nama / Topik Agenda <span style="color: red;">*</span></label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" placeholder="Contoh: Rapat Paripurna Pandangan Umum Fraksi terhadap Raperda" required>
            </div>

            <div class="grid grid-cols-3">
                <div class="form-group">
                    <label class="form-label" for="type">Tipe Agenda <span style="color: red;">*</span></label>
                    <select id="type" name="type" class="form-control" required>
                        @foreach($types as $t)
                        <option value="{{ $t }}" {{ old('type') == $t ? 'selected' : '' }}>{{ $t }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="commission">Komisi / Penyelenggara</label>
                    <input type="text" id="commission" name="commission" class="form-control" value="{{ old('commission') }}" placeholder="Contoh: Komisi III / Pimpinan DPRD">
                </div>

                <div class="form-group">
                    <label class="form-label" for="status">Status Pelaksanaan <span style="color: red;">*</span></label>
                    <select id="status" name="status" class="form-control" required>
                        <option value="scheduled" {{ old('status') == 'scheduled' ? 'selected' : '' }}>Terjadwal</option>
                        <option value="ongoing" {{ old('status') == 'ongoing' ? 'selected' : '' }}>Berlangsung</option>
                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                        <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-3">
                <div class="form-group">
                    <label class="form-label" for="start_time">Waktu Mulai <span style="color: red;">*</span></label>
                    <input type="datetime-local" id="start_time" name="start_time" class="form-control" value="{{ old('start_time', now()->format('Y-m-d\TH:i')) }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="end_time">Waktu Selesai (Opsional)</label>
                    <input type="datetime-local" id="end_time" name="end_time" class="form-control" value="{{ old('end_time') }}">
                </div>

                <div class="form-group">
                    <label class="form-label" for="location">Tempat / Ruangan</label>
                    <input type="text" id="location" name="location" class="form-control" value="{{ old('location', 'Ruang Sidang Paripurna DPRD Tangsel') }}" placeholder="Contoh: Ruang Rapat Komisi I">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="description">Deskripsi / Detail Rapat</label>
                <textarea id="description" name="description" class="form-control" style="min-height: 90px;" placeholder="Tuliskan bahasan atau susunan acara rapat...">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label" for="note">Catatan Khusus (Internal/Umum)</label>
                <input type="text" id="note" name="note" class="form-control" value="{{ old('note') }}" placeholder="Contoh: Terbuka untuk umum / Khusus undangan">
            </div>

            <div style="margin-top: 1.5rem; display: flex; gap: 0.75rem;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Agenda
                </button>
                <a href="{{ route('admin.agenda.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
