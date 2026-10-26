@extends('v_layouts.app')

@section('title', 'Anggota DPR RI')
@section('meta_description', 'Daftar lengkap anggota Dewan Perwakilan Rakyat Republik Indonesia')

@section('content')

<!-- Page Header -->
<section style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); padding: 4rem 0; color: white;">
    <div class="container">
        <h1 style="color: white; margin-bottom: 0.5rem;">Anggota DPR RI</h1>
        <p style="color: rgba(255,255,255,0.9); font-size: 1.125rem;">Temukan wakil rakyat dari daerah Anda</p>
    </div>
</section>

<!-- Filter Section -->
<section class="pt-4 pb-4 bg-soft">
    <div class="container">
        <form action="{{ route('anggota.index') }}" method="GET">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 1rem;">
                <!-- Search -->
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500; font-size: 0.875rem;">Cari Nama</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama anggota..." style="width: 100%; padding: 0.625rem 1rem; border: 1px solid var(--border); border-radius: var(--radius); font-size: 0.875rem;">
                </div>
                
                <!-- Party Filter -->
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500; font-size: 0.875rem;">Partai Politik</label>
                    <select name="party" style="width: 100%; padding: 0.625rem 1rem; border: 1px solid var(--border); border-radius: var(--radius); font-size: 0.875rem;">
                        <option value="">Semua Partai</option>
                        @foreach($parties as $party)
                        <option value="{{ $party }}" {{ request('party') == $party ? 'selected' : '' }}>{{ $party }}</option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Province Filter -->
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500; font-size: 0.875rem;">Provinsi</label>
                    <select name="province" style="width: 100%; padding: 0.625rem 1rem; border: 1px solid var(--border); border-radius: var(--radius); font-size: 0.875rem;">
                        <option value="">Semua Provinsi</option>
                        @foreach($provinces as $province)
                        <option value="{{ $province }}" {{ request('province') == $province ? 'selected' : '' }}>{{ $province }}</option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Commission Filter -->
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500; font-size: 0.875rem;">Komisi</label>
                    <select name="commission" style="width: 100%; padding: 0.625rem 1rem; border: 1px solid var(--border); border-radius: var(--radius); font-size: 0.875rem;">
                        <option value="">Semua Komisi</option>
                        @foreach($commissions as $commission)
                        <option value="{{ $commission }}" {{ request('commission') == $commission ? 'selected' : '' }}>{{ $commission }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div style="display: flex; gap: 0.75rem;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Filter
                </button>
                @if(request()->hasAny(['search', 'party', 'province', 'commission', 'faction']))
                <a href="{{ route('anggota.index') }}" class="btn btn-secondary">
                    <i class="fas fa-redo"></i> Reset
                </a>
                @endif
            </div>
        </form>
    </div>
</section>

<!-- Members List Section -->
<section class="pt-6 pb-8">
    <div class="container">
        @if($members->count() > 0)
            <!-- Results Info -->
            <div style="margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center;">
                <div style="color: var(--text-muted);">
                    Menampilkan {{ $members->firstItem() }} - {{ $members->lastItem() }} dari {{ $members->total() }} anggota
                </div>
                <div style="color: var(--text-muted); font-size: 0.875rem;">
                    <i class="fas fa-users"></i> Total: <strong>{{ $members->total() }}</strong> anggota
                </div>
            </div>
            
            <!-- Members Grid -->
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
                @foreach($members as $member)
                <div class="card">
                    <div style="padding: 1.5rem; text-align: center;">
                        <!-- Photo -->
                        <div style="margin-bottom: 1rem;">
                            @if($member->photo)
                            <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover; border: 4px solid var(--bg-soft);">
                            @else
                            <div style="width: 120px; height: 120px; border-radius: 50%; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); display: inline-flex; align-items: center; justify-content: center; color: white; font-size: 3rem; border: 4px solid var(--bg-soft);">
                                <i class="fas fa-user"></i>
                            </div>
                            @endif
                        </div>
                        
                        <!-- Name -->
                        <h3 style="font-size: 1.125rem; margin-bottom: 0.5rem; color: var(--text);">
                            {{ $member->name }}
                        </h3>
                        
                        <!-- Party Badge -->
                        <span class="badge badge-primary" style="margin-bottom: 0.75rem;">{{ $member->party }}</span>
                        
                        <!-- Info -->
                        <div style="font-size: 0.875rem; color: var(--text-muted); margin-bottom: 1rem; line-height: 1.6;">
                            @if($member->position)
                            <div><i class="fas fa-briefcase" style="width: 20px; text-align: center;"></i> {{ $member->position }}</div>
                            @endif
                            @if($member->commission)
                            <div><i class="fas fa-layer-group" style="width: 20px; text-align: center;"></i> {{ $member->commission }}</div>
                            @endif
                            @if($member->province)
                            <div><i class="fas fa-map-marker-alt" style="width: 20px; text-align: center;"></i> {{ $member->province }}</div>
                            @endif
                            @if($member->electoral_district)
                            <div style="font-size: 0.8125rem; color: var(--text-light); margin-top: 0.25rem;">
                                Dapil: {{ $member->electoral_district }}
                            </div>
                            @endif
                        </div>
                        
                        <!-- View Profile Button -->
                        <a href="{{ route('anggota.show', $member->slug) }}" class="btn btn-sm btn-primary" style="width: 100%;">
                            Lihat Profil
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div style="display: flex; justify-content: center;">
                {{ $members->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div style="text-align: center; padding: 4rem 0; color: var(--text-muted);">
                <i class="fas fa-users" style="font-size: 5rem; opacity: 0.3; margin-bottom: 1.5rem;"></i>
                <h3>Tidak Ada Anggota Ditemukan</h3>
                <p>Coba ubah filter pencarian Anda</p>
                <a href="{{ route('anggota.index') }}" class="btn btn-primary" style="margin-top: 1rem;">Tampilkan Semua Anggota</a>
            </div>
        @endif
    </div>
</section>

<!-- Quick Links Section -->
<section class="bg-soft pt-6 pb-6">
    <div class="container">
        <h3 class="text-center mb-4">Cari Berdasarkan</h3>
        <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 1rem;">
            <a href="{{ route('tentang.alat-kelengkapan') }}" class="btn btn-secondary">
                <i class="fas fa-layer-group"></i> Alat Kelengkapan Dewan
            </a>
            <a href="{{ route('kegiatan.legislasi') }}" class="btn btn-secondary">
                <i class="fas fa-gavel"></i> Fungsi Legislasi
            </a>
            <a href="{{ route('kegiatan.anggaran') }}" class="btn btn-secondary">
                <i class="fas fa-money-bill-wave"></i> Fungsi Anggaran
            </a>
            <a href="{{ route('kegiatan.pengawasan') }}" class="btn btn-secondary">
                <i class="fas fa-eye"></i> Fungsi Pengawasan
            </a>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
/* Pagination styling */
.pagination {
    display: flex;
    list-style: none;
    gap: 0.5rem;
    padding: 0;
    margin: 0;
}

.pagination li a,
.pagination li span {
    display: block;
    padding: 0.5rem 0.75rem;
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    color: var(--text);
    text-decoration: none;
    transition: all 0.2s ease;
}

.pagination li a:hover {
    background: var(--bg-soft);
    border-color: var(--primary);
    color: var(--primary);
}

.pagination li.active span {
    background: var(--primary);
    color: white;
    border-color: var(--primary);
}

.pagination li.disabled span {
    color: var(--text-light);
    cursor: not-allowed;
}
</style>
@endpush
