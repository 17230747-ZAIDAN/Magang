@extends('v_layouts.app')

@section('title', 'Beranda')
@section('meta_description', 'Portal resmi Dewan Perwakilan Rakyat Republik Indonesia - Informasi berita, agenda, anggota dewan, dokumen legislasi, dan aspirasi masyarakat')

@section('content')

<!-- Hero / Layanan Cepat Section -->
<section class="bg-soft pt-6 pb-8">
    <div class="container">
        <div class="text-center mb-6">
            <h2>Layanan Informasi DPR RI</h2>
            <p class="text-muted">Akses cepat ke informasi dan layanan utama</p>
        </div>
        
        <div class="grid grid-cols-3">
            <!-- Berita -->
            <a href="{{ route('berita.index') }}" class="card" style="text-decoration: none;">
                <div class="card-body text-center">
                    <div style="font-size: 3rem; color: var(--primary); margin-bottom: 1rem;">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <h3 class="card-title">Berita Terkini</h3>
                    <p class="card-text">Informasi dan berita terbaru seputar kegiatan DPR RI</p>
                </div>
            </a>
            
            <!-- Anggota -->
            <a href="{{ route('anggota.index') }}" class="card" style="text-decoration: none;">
                <div class="card-body text-center">
                    <div style="font-size: 3rem; color: var(--primary); margin-bottom: 1rem;">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="card-title">Temukan Wakil Anda</h3>
                    <p class="card-text">Cari dan hubungi anggota DPR RI dari daerah Anda</p>
                </div>
            </a>
            
            <!-- Aspirasi -->
            <a href="{{ route('aspirasi.create') }}" class="card" style="text-decoration: none;">
                <div class="card-body text-center">
                    <div style="font-size: 3rem; color: var(--primary); margin-bottom: 1rem;">
                        <i class="fas fa-comments"></i>
                    </div>
                    <h3 class="card-title">Aspirasi Masyarakat</h3>
                    <p class="card-text">Sampaikan pendapat dan aspirasi Anda kepada DPR RI</p>
                </div>
            </a>
            
            <!-- Dokumen -->
            <a href="{{ route('dokumen.index') }}" class="card" style="text-decoration: none;">
                <div class="card-body text-center">
                    <div style="font-size: 3rem; color: var(--primary); margin-bottom: 1rem;">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h3 class="card-title">Dokumen & Risalah</h3>
                    <p class="card-text">Akses dokumen rapat, risalah, dan laporan kinerja</p>
                </div>
            </a>
            
            <!-- JDIH -->
            <a href="{{ route('dokumen.jdih') }}" class="card" style="text-decoration: none;">
                <div class="card-body text-center">
                    <div style="font-size: 3rem; color: var(--primary); margin-bottom: 1rem;">
                        <i class="fas fa-gavel"></i>
                    </div>
                    <h3 class="card-title">JDIH</h3>
                    <p class="card-text">Database peraturan: UU, PP, Perpres, dan lainnya</p>
                </div>
            </a>
            
            <!-- Lacak Aspirasi -->
            <a href="{{ route('aspirasi.track') }}" class="card" style="text-decoration: none;">
                <div class="card-body text-center">
                    <div style="font-size: 3rem; color: var(--primary); margin-bottom: 1rem;">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3 class="card-title">Lacak Aspirasi</h3>
                    <p class="card-text">Cek status aspirasi yang telah Anda kirimkan</p>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- TV Parlemen Section -->
<section class="pt-8 pb-8">
    <div class="container">
        <div class="text-center mb-4">
            <span class="badge badge-live">● LIVE</span>
            <h2 class="mt-2">TV Parlemen</h2>
            <p class="text-muted">Saksikan siaran langsung kegiatan DPR RI</p>
        </div>
        
        <div style="max-width: 900px; margin: 0 auto;">
            <div style="position: relative; padding-bottom: 56.25%; background: #000; border-radius: var(--radius-lg); overflow: hidden;">
                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; color: white;">
                    <i class="fas fa-play-circle" style="font-size: 4rem; margin-bottom: 1rem; opacity: 0.7;"></i>
                    <p>TV Parlemen akan segera hadir</p>
                    <a href="{{ route('media.tv') }}" class="btn btn-primary mt-3">Tonton Sekarang</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Tugas dan Fungsi DPR Section -->
<section class="bg-soft pt-8 pb-8">
    <div class="container">
        <div class="text-center mb-6">
            <h2>Tugas dan Fungsi DPR RI</h2>
            <p class="text-muted">Peran DPR RI dalam sistem ketatanegaraan Indonesia</p>
        </div>
        
        <div class="grid grid-cols-4">
            <!-- Legislasi -->
            <div class="card">
                <div class="card-body text-center">
                    <div style="font-size: 2.5rem; color: var(--accent); margin-bottom: 1rem;">
                        <i class="fas fa-file-contract"></i>
                    </div>
                    <h3 style="font-size: 1.125rem; margin-bottom: 0.5rem;">Legislasi</h3>
                    <p class="text-muted" style="font-size: 0.875rem; margin-bottom: 1rem;">Pembentukan Undang-Undang</p>
                    <div style="margin-bottom: 1rem;">
                        <div style="font-size: 2rem; font-weight: 700; color: var(--primary);">{{ $statistics['legislasi']['ruu_selesai'] }}</div>
                        <div style="font-size: 0.75rem; color: var(--text-muted);">RUU Selesai</div>
                    </div>
                    <a href="{{ route('kegiatan.legislasi') }}" class="btn btn-sm btn-secondary">Lihat Detail</a>
                </div>
            </div>
            
            <!-- Anggaran -->
            <div class="card">
                <div class="card-body text-center">
                    <div style="font-size: 2.5rem; color: var(--accent); margin-bottom: 1rem;">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <h3 style="font-size: 1.125rem; margin-bottom: 0.5rem;">Anggaran</h3>
                    <p class="text-muted" style="font-size: 0.875rem; margin-bottom: 1rem;">Penetapan APBN</p>
                    <div style="margin-bottom: 1rem;">
                        <div style="font-size: 1.5rem; font-weight: 700; color: var(--primary);">{{ $statistics['anggaran']['apbn_tahun_ini'] }}</div>
                        <div style="font-size: 0.75rem; color: var(--text-muted);">APBN 2026</div>
                    </div>
                    <a href="{{ route('kegiatan.anggaran') }}" class="btn btn-sm btn-secondary">Lihat Detail</a>
                </div>
            </div>
            
            <!-- Pengawasan -->
            <div class="card">
                <div class="card-body text-center">
                    <div style="font-size: 2.5rem; color: var(--accent); margin-bottom: 1rem;">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h3 style="font-size: 1.125rem; margin-bottom: 0.5rem;">Pengawasan</h3>
                    <p class="text-muted" style="font-size: 0.875rem; margin-bottom: 1rem;">Mengawasi Pemerintah</p>
                    <div style="margin-bottom: 1rem;">
                        <div style="font-size: 2rem; font-weight: 700; color: var(--primary);">{{ $statistics['pengawasan']['rapat_dengar'] }}</div>
                        <div style="font-size: 0.75rem; color: var(--text-muted);">Rapat Dengar</div>
                    </div>
                    <a href="{{ route('kegiatan.pengawasan') }}" class="btn btn-sm btn-secondary">Lihat Detail</a>
                </div>
            </div>
            
            <!-- Diplomasi -->
            <div class="card">
                <div class="card-body text-center">
                    <div style="font-size: 2.5rem; color: var(--accent); margin-bottom: 1rem;">
                        <i class="fas fa-globe"></i>
                    </div>
                    <h3 style="font-size: 1.125rem; margin-bottom: 0.5rem;">Diplomasi</h3>
                    <p class="text-muted" style="font-size: 0.875rem; margin-bottom: 1rem;">Hubungan Internasional</p>
                    <div style="margin-bottom: 1rem;">
                        <div style="font-size: 2rem; font-weight: 700; color: var(--primary);">{{ $statistics['diplomasi']['kunjungan_luar'] }}</div>
                        <div style="font-size: 0.75rem; color: var(--text-muted);">Kunjungan</div>
                    </div>
                    <a href="{{ route('kegiatan.diplomasi') }}" class="btn btn-sm btn-secondary">Lihat Detail</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Berita Terkini Section -->
<section class="pt-8 pb-8">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <div>
                <h2>Berita Terkini</h2>
                <p class="text-muted">Informasi terbaru seputar kegiatan DPR RI</p>
            </div>
            <a href="{{ route('berita.index') }}" class="btn btn-primary">Lihat Semua Berita</a>
        </div>
        
        @if($latestNews->count() > 0)
        <div class="grid grid-cols-3">
            @foreach($latestNews as $news)
            <a href="{{ route('berita.show', $news->slug) }}" class="card" style="text-decoration: none;">
                @if($news->image)
                <img src="{{ asset($news->image) }}" alt="{{ $news->title }}" class="card-img">
                @else
                <div class="card-img" style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-image" style="font-size: 3rem; color: rgba(255,255,255,0.5);"></i>
                </div>
                @endif
                <div class="card-body">
                    <div class="card-meta mb-2">
                        <span><i class="far fa-calendar"></i> {{ $news->formatted_date }}</span>
                        <span class="badge badge-primary">{{ $news->category }}</span>
                    </div>
                    <h3 class="card-title">{{ $news->title }}</h3>
                    <p class="card-text">{{ $news->excerpt }}</p>
                </div>
            </a>
            @endforeach
        </div>
        @else
        <div class="text-center text-muted py-6">
            <i class="fas fa-newspaper" style="font-size: 4rem; opacity: 0.3; margin-bottom: 1rem;"></i>
            <p>Belum ada berita tersedia</p>
        </div>
        @endif
    </div>
</section>

<!-- Dokumen Terbaru Section -->
<section class="bg-soft pt-8 pb-8">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <div>
                <h2>Dokumen Terbaru</h2>
                <p class="text-muted">Dokumen dan risalah rapat terkini</p>
            </div>
            <a href="{{ route('dokumen.index') }}" class="btn btn-primary">Lihat Semua Dokumen</a>
        </div>
        
        @if($latestDocuments->count() > 0)
        <div style="background: white; border-radius: var(--radius); overflow: hidden; box-shadow: var(--shadow);">
            @foreach($latestDocuments as $index => $document)
            <div style="padding: 1.5rem; {{ $index < $latestDocuments->count() - 1 ? 'border-bottom: 1px solid var(--border);' : '' }}">
                <div style="display: flex; justify-content: space-between; align-items: start; gap: 2rem;">
                    <div style="flex: 1;">
                        <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.5rem;">
                            <i class="fas fa-file-pdf" style="color: var(--danger); font-size: 1.5rem;"></i>
                            <span class="badge badge-accent">{{ $document->type }}</span>
                            @if($document->year)
                            <span class="text-muted" style="font-size: 0.875rem;">{{ $document->year }}</span>
                            @endif
                        </div>
                        <h3 style="font-size: 1.125rem; margin-bottom: 0.5rem;">
                            <a href="{{ route('dokumen.show', $document->slug) }}" style="color: var(--text); text-decoration: none;">
                                {{ $document->title }}
                            </a>
                        </h3>
                        @if($document->number)
                        <p class="text-muted" style="font-size: 0.875rem; margin-bottom: 0.5rem;">{{ $document->full_number }}</p>
                        @endif
                        <div style="display: flex; gap: 1.5rem; font-size: 0.8125rem; color: var(--text-light);">
                            <span><i class="far fa-calendar"></i> {{ $document->formatted_document_date }}</span>
                            @if($document->file_size)
                            <span><i class="fas fa-file"></i> {{ $document->formatted_file_size }}</span>
                            @endif
                            <span><i class="fas fa-download"></i> {{ $document->downloads }}x</span>
                        </div>
                    </div>
                    <div style="display: flex; gap: 0.5rem;">
                        <a href="{{ route('dokumen.show', $document->slug) }}" class="btn btn-sm btn-secondary">Detail</a>
                        @if($document->download_url)
                        <a href="{{ route('dokumen.download', $document->slug) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-download"></i> Unduh
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center text-muted py-6">
            <i class="fas fa-file-alt" style="font-size: 4rem; opacity: 0.3; margin-bottom: 1rem;"></i>
            <p>Belum ada dokumen tersedia</p>
        </div>
        @endif
    </div>
</section>

<!-- Agenda Hari Ini Section -->
<section class="pt-8 pb-8">
    <div class="container">
        <div class="text-center mb-4">
            <h2>Agenda Hari Ini</h2>
            <p class="text-muted">{{ now()->isoFormat('dddd, D MMMM Y') }}</p>
        </div>
        
        @if($todayAgendas->count() > 0)
        <div style="max-width: 800px; margin: 0 auto;">
            @foreach($todayAgendas as $agenda)
            <div class="card mb-3">
                <div class="card-body">
                    <div style="display: flex; gap: 2rem; align-items: start;">
                        <div style="text-align: center; min-width: 80px;">
                            <div style="font-size: 1.5rem; font-weight: 700; color: var(--primary);">
                                {{ $agenda->start_time->format('H:i') }}
                            </div>
                            <div style="font-size: 0.75rem; color: var(--text-muted);">WIB</div>
                        </div>
                        <div style="flex: 1;">
                            <div style="margin-bottom: 0.5rem;">
                                <span class="badge" style="background: var(--{{ $agenda->status_color }});">{{ $agenda->status_label }}</span>
                                @if($agenda->commission)
                                <span class="badge badge-accent">{{ $agenda->commission }}</span>
                                @endif
                            </div>
                            <h3 style="font-size: 1.125rem; margin-bottom: 0.5rem;">{{ $agenda->title }}</h3>
                            @if($agenda->description)
                            <p class="text-muted" style="font-size: 0.875rem; margin-bottom: 0.5rem;">{{ Str::limit($agenda->description, 150) }}</p>
                            @endif
                            @if($agenda->location)
                            <p style="font-size: 0.875rem; color: var(--text-light);">
                                <i class="fas fa-map-marker-alt"></i> {{ $agenda->location }}
                            </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center text-muted py-6">
            <i class="fas fa-calendar-day" style="font-size: 4rem; opacity: 0.3; margin-bottom: 1rem;"></i>
            <p>Tidak ada agenda hari ini</p>
        </div>
        @endif
        
        <div class="text-center mt-4">
            <a href="{{ route('kegiatan.agenda') }}" class="btn btn-secondary">Lihat Semua Agenda</a>
        </div>
    </div>
</section>

@endsection