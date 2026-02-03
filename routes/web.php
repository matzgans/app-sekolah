<?php

use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index']);
Route::get('/berita/{slug}', [LandingController::class, 'berita'])->name('berita.detail');
Route::get('/prestasi/{slug}', [LandingController::class, 'prestasi'])->name('prestasi.detail');
Route::get('/jurusan/{slug}', [LandingController::class, 'jurusan'])->name('jurusan.detail');
Route::get('/kalender', [LandingController::class, 'kalender'])->name('kalender');

Route::get('/pengumuman/{slug}', [LandingController::class, 'pengumuman'])->name('pengumuman.detail');

Route::get('/reload-captcha', function () {
    return response()->json(['captcha' => captcha_img()]);
});

Route::prefix('pengaduan')->group(function () {
    Route::get('/', [LandingController::class, 'pengaduan'])->name('pengaduan.index');
    Route::post('/store', [LandingController::class, 'store'])->name('pengaduan.store');
    Route::get('/{nomor_tiket}', [LandingController::class, 'show'])->name('pengaduan.show');
    Route::post('/{nomor_tiket}/balasan', [LandingController::class, 'storeBalasan'])->name('pengaduan.balasan.store');
});
