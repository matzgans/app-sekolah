<?php

use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index']);
Route::get('/berita/{slug}', [LandingController::class, 'berita'])->name('berita.detail');
Route::get('/prestasi/{slug}', [LandingController::class, 'prestasi'])->name('prestasi.detail');
Route::get('/jurusan/{slug}', [LandingController::class, 'jurusan'])->name('jurusan.detail');
Route::get('/kalender', [LandingController::class, 'kalender'])->name('kalender');


Route::get('/pengaduan', [LandingController::class, 'pengaduan'])->name('pengaduan');
