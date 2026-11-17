<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\AspirationController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\MemberController as AdminMemberController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\DocumentController as AdminDocumentController;
use App\Http\Controllers\Admin\AgendaController as AdminAgendaController;
use App\Http\Controllers\Admin\AspirationController as AdminAspirationController;
use App\Http\Controllers\Admin\InternController as AdminInternController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// ========== BERANDA ==========
Route::get('/', [BerandaController::class, 'index'])->name('beranda');

// ========== PENCARIAN GLOBAL ==========
Route::get('/search', [SearchController::class, 'index'])->name('search');

// ========== BERITA ==========
Route::prefix('berita')->name('berita.')->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('index');
    Route::get('/kategori/{category}', [NewsController::class, 'category'])->name('category');
    Route::get('/{slug}', [NewsController::class, 'show'])->name('show');
});

// ========== ANGGOTA DPR ==========
Route::prefix('anggota')->name('anggota.')->group(function () {
    Route::get('/', [MemberController::class, 'index'])->name('index');
    Route::get('/partai/{party}', [MemberController::class, 'byParty'])->name('party');
    Route::get('/komisi/{commission}', [MemberController::class, 'byCommission'])->name('commission');
    Route::get('/{slug}', [MemberController::class, 'show'])->name('show');
});

// ========== DOKUMEN ==========
Route::prefix('dokumen')->name('dokumen.')->group(function () {
    Route::get('/', [DocumentController::class, 'index'])->name('index');
    Route::get('/jdih', [DocumentController::class, 'jdih'])->name('jdih');
    Route::get('/tipe/{type}', [DocumentController::class, 'byType'])->name('type');
    Route::get('/{slug}', [DocumentController::class, 'show'])->name('show');
    Route::get('/{slug}/download', [DocumentController::class, 'download'])->name('download');
});

// ========== ASPIRASI MASYARAKAT ==========
Route::prefix('aspirasi')->name('aspirasi.')->group(function () {
    Route::get('/', [AspirationController::class, 'create'])->name('create');
    Route::post('/', [AspirationController::class, 'store'])->name('store');
    Route::get('/sukses', [AspirationController::class, 'success'])->name('success');
    Route::get('/lacak', [AspirationController::class, 'track'])->name('track');
    Route::post('/lacak', [AspirationController::class, 'checkStatus'])->name('checkStatus');
});

// ========== HALAMAN STATIS (Untuk fase berikutnya) ==========
Route::prefix('tentang')->name('tentang.')->group(function () {
    Route::get('/profil', function () {
        return view('v_tentang.profil');
    })->name('profil');
    
    Route::get('/sejarah', function () {
        return view('v_tentang.sejarah');
    })->name('sejarah');
    
    Route::get('/alat-kelengkapan', function () {
        return view('v_tentang.alat-kelengkapan');
    })->name('alat-kelengkapan');
    
    Route::get('/sekretariat-jenderal', function () {
        return view('v_tentang.sekretariat');
    })->name('sekretariat');
});

Route::prefix('kegiatan')->name('kegiatan.')->group(function () {
    Route::get('/legislasi', function () {
        return view('v_kegiatan.legislasi');
    })->name('legislasi');
    
    Route::get('/anggaran', function () {
        return view('v_kegiatan.anggaran');
    })->name('anggaran');
    
    Route::get('/pengawasan', function () {
        return view('v_kegiatan.pengawasan');
    })->name('pengawasan');
    
    Route::get('/diplomasi', function () {
        return view('v_kegiatan.diplomasi');
    })->name('diplomasi');
    
    Route::get('/agenda', function () {
        return view('v_kegiatan.agenda');
    })->name('agenda');
});

Route::prefix('media')->name('media.')->group(function () {
    Route::get('/tv-parlemen', function () {
        return view('v_media.tv');
    })->name('tv');
    
    Route::get('/radio', function () {
        return view('v_media.radio');
    })->name('radio');
    
    Route::get('/majalah', function () {
        return view('v_media.majalah');
    })->name('majalah');
});

Route::prefix('lainnya')->name('lainnya.')->group(function () {
    Route::get('/kunjungan-edukasi', function () {
        return view('v_lainnya.kunjungan');
    })->name('kunjungan');
    
    Route::get('/museum', function () {
        return view('v_lainnya.museum');
    })->name('museum');
    
    Route::get('/glosarium', function () {
        return view('v_lainnya.glosarium');
    })->name('glosarium');
    
    Route::get('/faq', function () {
        return view('v_lainnya.faq');
    })->name('faq');
});

Route::get('/kontak', function () {
    return view('v_kontak.index');
})->name('kontak');

// ========== BACKEND ADMIN ROUTES ==========
Route::prefix('admin')->name('admin.')->group(function () {
    // Auth
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    // Protected Admin Panel
    Route::middleware('auth')->group(function () {
        Route::get('/', fn() => redirect()->route('admin.dashboard'));
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Ganti Password Akun Sendiri
        Route::get('/ganti-password', [AdminProfileController::class, 'editPassword'])->name('password');
        Route::put('/ganti-password', [AdminProfileController::class, 'updatePassword'])->name('password.update');

        // CRUD Berita
        Route::resource('berita', AdminNewsController::class)->parameters(['berita' => 'berita'])->except(['show']);

        // CRUD Anggota Dewan
        Route::resource('anggota', AdminMemberController::class)->parameters(['anggota' => 'anggota'])->except(['show']);

        // CRUD Galeri
        Route::resource('galeri', AdminGalleryController::class)->parameters(['galeri' => 'galeri'])->except(['show']);

        // CRUD Dokumen & JDIH
        Route::resource('dokumen', AdminDocumentController::class)->parameters(['dokumen' => 'dokumen'])->except(['show']);

        // CRUD Agenda
        Route::resource('agenda', AdminAgendaController::class)->parameters(['agenda' => 'agenda'])->except(['show']);

        // Manajemen Aspirasi Warga
        Route::get('/aspirasi', [AdminAspirationController::class, 'index'])->name('aspirasi.index');
        Route::get('/aspirasi/{aspirasi}', [AdminAspirationController::class, 'show'])->name('aspirasi.show');
        Route::put('/aspirasi/{aspirasi}', [AdminAspirationController::class, 'update'])->name('aspirasi.update');
        Route::delete('/aspirasi/{aspirasi}', [AdminAspirationController::class, 'destroy'])->name('aspirasi.destroy');

        // CRUD Akun Magang (Khusus Administrator Utama)
        Route::middleware('admin.only')->group(function () {
            Route::resource('magang', AdminInternController::class)->parameters(['magang' => 'magang'])->except(['show']);
            Route::patch('magang/{magang}/toggle', [AdminInternController::class, 'toggleStatus'])->name('magang.toggle');
        });
    });
});
