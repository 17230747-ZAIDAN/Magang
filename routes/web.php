<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\AspirationController;
use App\Http\Controllers\SearchController;

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
