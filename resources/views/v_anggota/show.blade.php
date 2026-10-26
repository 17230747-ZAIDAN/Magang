@extends('v_layouts.app')

@section('title', $member->name . ' - Anggota DPR RI')
@section('meta_description', 'Profil ' . $member->name . ', anggota DPR RI dari ' . ($member->province ?? 'Indonesia'))

@section('content')

<!-- Breadcrumb -->
<section class="bg-soft pt-3 pb-3">
    <div class="container">
        <nav style="font-size: 0.875rem;">
            <a href="{{ route('beranda') }}" style="color: var(--text-muted);">Beranda</a>
            <span style="margin: 0 0.5rem; color: var(--text-light);">/</span>
            <a href="{{ route('anggota.index') }}" style="color: var(--text-muted);">Anggota DPR RI</a>
            <span style="margin: 0 0.5rem; color: var(--text-light);">/</span>
            <span style="color: var(--text);">{{ $member->name }}</span>
        </nav>
    </div>
</section>

<!-- Member Profile Section -->
<section class="pt-6 pb-8">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 350px; gap: 3rem;">
            <!-- Main Content -->
            <div>
                <!-- Profile Card -->
                <div class="card" style="margin-bottom: 2rem;">
                    <div style="padding: 2rem;">
                        <div style="display: flex; gap: 2rem; align-items: start;">
                            <!-- Photo -->
                            <div style="flex-shrink: 0;">
                                @if($member->photo)
                                <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" style="width: 200px; height: 200px; border-radius: var(--radius-lg); object-fit: cover; border: 4px solid var(--bg-soft);">
                                @else
                                <div style="width: 200px; height: 200px; border-radius: var(--radius-lg); background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 5rem; border: 4px solid var(--bg-soft);">
                                    <i class="fas fa-user"></i>
                                </div>
                                @endif
                            </div>
                            
                            <!-- Info -->
                            <div style="flex: 1;">
                                <h1 style="font-size: 2rem; margin-bottom: 0.75rem;">{{ $member->name }}</h1>
                                
                                <div style="display: flex; flex-wrap: wrap; gap: 0.5rem; margin-bottom: 1rem;">
                                    <span class="badge badge-primary">{{ $member->party }}</span>
                                    @if($member->is_active)
                                    <span class="badge badge-success">Aktif</span>
                                    @endif
                                </div>
                                
                                <div style="display: grid; gap: 0.75rem; font-size: 0.9375rem;">
                                    @if($member->position)
                                    <div style="display: flex; gap: 1rem;">
                                        <div style="color: var(--text-muted); min-width: 140px;">
                                            <i class="fas fa-briefcase" style="width: 20px;"></i> Jabatan
                                        </div>
                                        <div style="font-weight: 600;">{{ $member->position }}</div>
                                    </div>
                                    @endif
                                    
                                    @if($member->commission)
                                    <div style="display: flex; gap: 1rem;">
                                        <div style="color: var(--text-muted); min-width: 140px;">
                                            <i class="fas fa-layer-group" style="width: 20px;"></i> Komisi
                                        </div>
                                        <div style="font-weight: 600;">{{ $member->commission }}</div>
                                    </div>
                                    @endif
                                    
                                    @if($member->faction)
                                    <div style="display: flex; gap: 1rem;">
                                        <div style="color: var(--text-muted); min-width: 140px;">
                                            <i class="fas fa-users" style="width: 20px;"></i> Fraksi
                                        </div>
                                        <div style="font-weight: 600;">{{ $member->faction }}</div>
                                    </div>
                                    @endif
                                    
                                    @if($member->province)
                                    <div style="display: flex; gap: 1rem;">
                                        <div style="color: var(--text-muted); min-width: 140px;">
                                            <i class="fas fa-map-marker-alt" style="width: 20px;"></i> Provinsi
                                        </div>
                                        <div style="font-weight: 600;">{{ $member->province }}</div>
                                    </div>
                                    @endif
                                    
                                    @if($member->electoral_district)
                                    <div style="display: flex; gap: 1rem;">
                                        <div style="color: var(--text-muted); min-width: 140px;">
                                            <i class="fas fa-map" style="width: 20px;"></i> Daerah Pemilihan
                                        </div>
                                        <div style="font-weight: 600;">{{ $member->electoral_district }}</div>
                                    </div>
                                    @endif
                                    
                                    @if($member->start_period && $member->end_period)
                                    <div style="display: flex; gap: 1rem;">
                                        <div style="color: var(--text-muted); min-width: 140px;">
                                            <i class="fas fa-calendar" style="width: 20px;"></i> Periode
                                        </div>
                                        <div style="font-weight: 600;">
                                            {{ $member->start_period->format('Y') }} - {{ $member->end_period->format('Y') }}
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Biography Section -->
                @if($member->biography)
                <div class="card" style="margin-bottom: 2rem;">
                    <div style="padding: 2rem;">
                        <h2 style="font-size: 1.5rem; margin-bottom: 1rem; padding-bottom: 0.75rem; border-bottom: 2px solid var(--primary);">
                            Biografi
                        </h2>
                        <div style="line-height: 1.8; color: var(--text);">
                            {!! nl2br(e($member->biography)) !!}
                        </div>
                    </div>
                </div>
                @endif
                
                <!-- Education Section -->
                @if($member->education)
                <div class="card" style="margin-bottom: 2rem;">
                    <div style="padding: 2rem;">
                        <h2 style="font-size: 1.5rem; margin-bottom: 1rem; padding-bottom: 0.75rem; border-bottom: 2px solid var(--accent);">
                            <i class="fas fa-graduation-cap"></i> Pendidikan
                        </h2>
                        <div style="line-height: 1.8; color: var(--text);">
                            {!! nl2br(e($member->education)) !!}
                        </div>
                    </div>
                </div>
                @endif
                
                <!-- Contact Section -->
                <div class="card">
                    <div style="padding: 2rem;">
                        <h2 style="font-size: 1.5rem; margin-bottom: 1rem; padding-bottom: 0.75rem; border-bottom: 2px solid var(--success);">
                            <i class="fas fa-envelope"></i> Kontak
                        </h2>
                        <div style="display: grid; gap: 1rem;">
                            @if($member->email)
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <div style="width: 40px; height: 40px; background: var(--bg-soft); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--primary);">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div>
                                    <div style="font-size: 0.875rem; color: var(--text-muted);">Email</div>
                                    <a href="mailto:{{ $member->email }}" style="color: var(--primary); font-weight: 500;">{{ $member->email }}</a>
                                </div>
                            </div>
                            @endif
                            
                            @if($member->phone)
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <div style="width: 40px; height: 40px; background: var(--bg-soft); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--primary);">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div>
                                    <div style="font-size: 0.875rem; color: var(--text-muted);">Telepon</div>
                                    <a href="tel:{{ $member->phone }}" style="color: var(--primary); font-weight: 500;">{{ $member->phone }}</a>
                                </div>
                            </div>
                            @endif
                            
                            @if(!$member->email && !$member->phone)
                            <p class="text-muted">Informasi kontak belum tersedia</p>
                            @endif
                        </div>
                        
                        <!-- Social Media -->
                        @if($member->social_media && is_array($member->social_media))
                        <div style="margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid var(--border);">
                            <h3 style="font-size: 1rem; margin-bottom: 1rem;">Media Sosial</h3>
                            <div style="display: flex; gap: 0.75rem;">
                                @foreach($member->social_media as $platform => $url)
                                <a href="{{ $url }}" target="_blank" class="social-link" rel="noopener noreferrer">
                                    <i class="fab fa-{{ $platform }}"></i>
                                </a>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Sidebar -->
            <aside>
                <!-- Same Party Members -->
                @if($samePartyMembers->count() > 0)
                <div class="card" style="margin-bottom: 2rem;">
                    <div class="card-body">
                        <h3 style="font-size: 1.125rem; margin-bottom: 1.5rem; padding-bottom: 0.75rem; border-bottom: 2px solid var(--primary);">
                            Anggota {{ $member->party }}
                        </h3>
                        <div style="display: flex; flex-direction: column; gap: 1rem;">
                            @foreach($samePartyMembers as $sameMember)
                            <a href="{{ route('anggota.show', $sameMember->slug) }}" style="display: flex; gap: 1rem; align-items: center; text-decoration: none; padding: 0.75rem; border-radius: var(--radius-sm); transition: background 0.2s;">
                                @if($sameMember->photo)
                                <img src="{{ $sameMember->photo_url }}" alt="{{ $sameMember->name }}" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover;">
                                @else
                                <div style="width: 60px; height: 60px; border-radius: 50%; background: var(--bg-soft); display: flex; align-items: center; justify-content: center; color: var(--text-light);">
                                    <i class="fas fa-user"></i>
                                </div>
                                @endif
                                <div style="flex: 1; min-width: 0;">
                                    <h4 style="font-size: 0.9375rem; margin-bottom: 0.25rem; color: var(--text); overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                        {{ $sameMember->name }}
                                    </h4>
                                    @if($sameMember->commission)
                                    <p style="font-size: 0.75rem; color: var(--text-muted); margin: 0;">{{ $sameMember->commission }}</p>
                                    @endif
                                </div>
                            </a>
                            @endforeach
                        </div>
                        <a href="{{ route('anggota.party', $member->party) }}" class="btn btn-sm btn-secondary" style="width: 100%; margin-top: 1rem;">
                            Lihat Semua
                        </a>
                    </div>
                </div>
                @endif
                
                <!-- Same Commission Members -->
                @if($sameCommissionMembers->count() > 0)
                <div class="card" style="margin-bottom: 2rem;">
                    <div class="card-body">
                        <h3 style="font-size: 1.125rem; margin-bottom: 1.5rem; padding-bottom: 0.75rem; border-bottom: 2px solid var(--accent);">
                            Anggota {{ $member->commission }}
                        </h3>
                        <div style="display: flex; flex-direction: column; gap: 1rem;">
                            @foreach($sameCommissionMembers as $sameMember)
                            <a href="{{ route('anggota.show', $sameMember->slug) }}" style="display: flex; gap: 1rem; align-items: center; text-decoration: none; padding: 0.75rem; border-radius: var(--radius-sm); transition: background 0.2s;">
                                @if($sameMember->photo)
                                <img src="{{ $sameMember->photo_url }}" alt="{{ $sameMember->name }}" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover;">
                                @else
                                <div style="width: 60px; height: 60px; border-radius: 50%; background: var(--bg-soft); display: flex; align-items: center; justify-content: center; color: var(--text-light);">
                                    <i class="fas fa-user"></i>
                                </div>
                                @endif
                                <div style="flex: 1; min-width: 0;">
                                    <h4 style="font-size: 0.9375rem; margin-bottom: 0.25rem; color: var(--text); overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                        {{ $sameMember->name }}
                                    </h4>
                                    <p style="font-size: 0.75rem; color: var(--text-muted); margin: 0;">{{ $sameMember->party }}</p>
                                </div>
                            </a>
                            @endforeach
                        </div>
                        <a href="{{ route('anggota.commission', $member->commission) }}" class="btn btn-sm btn-secondary" style="width: 100%; margin-top: 1rem;">
                            Lihat Semua
                        </a>
                    </div>
                </div>
                @endif
                
                <!-- Quick Actions -->
                <div class="card">
                    <div class="card-body">
                        <h3 style="font-size: 1.125rem; margin-bottom: 1.5rem; padding-bottom: 0.75rem; border-bottom: 2px solid var(--success);">
                            Layanan
                        </h3>
                        <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                            <a href="{{ route('aspirasi.create') }}" class="btn btn-sm btn-primary" style="width: 100%;">
                                <i class="fas fa-paper-plane"></i> Kirim Aspirasi
                            </a>
                            <a href="{{ route('berita.index') }}" class="btn btn-sm btn-secondary" style="width: 100%;">
                                <i class="fas fa-newspaper"></i> Berita Terkini
                            </a>
                            <a href="{{ route('kegiatan.agenda') }}" class="btn btn-sm btn-secondary" style="width: 100%;">
                                <i class="fas fa-calendar"></i> Agenda Kegiatan
                            </a>
                            <a href="{{ route('anggota.index') }}" class="btn btn-sm btn-secondary" style="width: 100%;">
                                <i class="fas fa-users"></i> Semua Anggota
                            </a>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
/* Responsive layout */
@media (max-width: 1023px) {
    section .container > div[style*="grid-template-columns"] {
        grid-template-columns: 1fr !important;
    }
    
    .card > div[style*="display: flex"] {
        flex-direction: column !important;
        text-align: center !important;
    }
}

/* Hover effects */
a[style*="display: flex"]:hover {
    background: var(--bg-soft) !important;
}
</style>
@endpush
