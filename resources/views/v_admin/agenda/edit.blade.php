@extends('v_admin.layouts.app')

@section('title', 'Edit Agenda Sidang')

@section('content')
<div class="page-header">
    <div>
        <h1>Edit Agenda Sidang</h1>
        <p>Perbarui status, waktu, atau rincian agenda.</p>
    </div>
    <div>
        <a href="{{ route('admin.agenda.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Agenda
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.agenda.update', $agenda->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label" for="title">Nama / Topik Agenda <span style="color: red;">*</span></label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $agenda->title) }}" required>
            </div>

            <div class="grid grid-cols-3">
                <div class="form-group">
                    <label class="form-label" for="type">Tipe Agenda <span style="color: red;">*</span></label>
                    <select id="type" name="type" class="form-control" required>
                        @foreach($types as $t)
                        <option value="{{ $t }}" {{ old('type', $agenda->type) == $t ? 'selected' : '' }}>{{ $t }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="commission">Komisi / Penyelenggara</label>
                    <input type="text" id="commission" name="commission" class="form-control" value="{{ old('commission', $agenda->commission) }}">
                </div>

                <div class="form-group">
                    <label class="form-label" for="status">Status Pelaksanaan <span style="color: red;">*</span></label>
                    <select id="status" name="status" class="form-control" required>
                        <option value="scheduled" {{ old('status', $agenda->status) == 'scheduled' ? 'selected' : '' }}>Terjadwal</option>
                        <option value="ongoing" {{ old('status', $agenda->status) == 'ongoing' ? 'selected' : '' }}>Berlangsung</option>
                        <option value="completed" {{ old('status', $agenda->status) == 'completed' ? 'selected' : '' }}>Selesai</option>
                        <option value="cancelled" {{ old('status', $agenda->status) == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-3">
                <div class="form-group">
                    <label class="form-label" for="start_time">Waktu Mulai <span style="color: red;">*</span></label>
                    <input type="datetime-local" id="start_time" name="start_time" class="form-control" value="{{ old('start_time', \Carbon\Carbon::parse($agenda->start_time)->format('Y-m-d\TH:i')) }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="end_time">Waktu Selesai (Opsional)</label>
                    <input type="datetime-local" id="end_time" name="end_time" class="form-control" value="{{ old('end_time', $agenda->end_time ? \Carbon\Carbon::parse($agenda->end_time)->format('Y-m-d\TH:i') : '') }}">
                </div>

                <div class="form-group">
                    <label class="form-label" for="location">Tempat / Ruangan</label>
                    <input type="text" id="location" name="location" class="form-control" value="{{ old('location', $agenda->location) }}">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="description">Deskripsi / Detail Rapat</label>
                <textarea id="description" name="description" class="form-control" style="min-height: 90px;">{{ old('description', $agenda->description) }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label" for="note">Catatan Khusus (Internal/Umum)</label>
                <input type="text" id="note" name="note" class="form-control" value="{{ old('note', $agenda->note) }}">
            </div>

            <div style="margin-top: 1.5rem; display: flex; gap: 0.75rem;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.agenda.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
