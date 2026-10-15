@extends('v_layouts.app')

@section('content')
    <!-- HERO SECTION (Ucapan Selamat Datang) -->
    <section class="bg-light py-5 text-center">
        <div class="container">
            <h1 class="display-4 fw-bold">Selamat Datang di DPRD Kota Tangerang Selatan</h1>
            <p class="lead">Pusat informasi, jadwal kegiatan, dan dokumentasi resmi DPRD Kota Tangerang Selatan.</p>
        </div>
    </section>

    <div class="container mt-5">
        <div class="row">
            <!-- INFO TERKINI / BERITA SINGKAT -->
            <div class="col-md-8">
                <h3 class="mb-4">Berita Terkini</h3>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Pelaksanaan Kegiatan Tahunan 2026</h5>
                        <p class="card-text text-muted">Ditulis pada 13 Oktober 2026</p>
                        <p class="card-text">Kegiatan rutin tahunan akan segera dilaksanakan pada akhir bulan ini. Seluruh anggota diharap mempersiapkan diri...</p>
                        <a href="#" class="btn btn-sm btn-primary">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>

            <!-- JADWAL KEGIATAN TERDEKAT -->
            <div class="col-md-4">
                <h3 class="mb-4">Jadwal Terdekat</h3>
                <ul class="list-group">
                    <li class="list-group-item">
                        <strong>15 Okt 2026</strong> - Rapat Koordinasi
                    </li>
                    <li class="list-group-item">
                        <strong>20 Okt 2026</strong> - Kunjungan Lapangan
                    </li>
                    <li class="list-group-item">
                        <strong>28 Okt 2026</strong> - Upacara Sumpah Pemuda
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection