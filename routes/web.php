<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\ProjectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini adalah tempat Anda dapat mendaftarkan rute web untuk aplikasi Anda.
|
*/

// ======================================================================
// RUTE UNTUK HALAMAN UTAMA (PUBLIK)
// ======================================================================
// Ini memastikan bahwa setiap permintaan ke halaman utama akan ditangani
// oleh PortfolioController, yang akan menyiapkan semua data yang diperlukan.
Route::get('/', [PortfolioController::class, 'index'])->name('home');


// ======================================================================
// RUTE UNTUK PANEL ADMIN
// ======================================================================
// Semua rute di dalam grup ini akan memiliki awalan '/admin'
// dan memerlukan pengguna untuk login terlebih dahulu (middleware 'auth').
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // Rute untuk Dashboard bawaan Breeze
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rute untuk mengelola profil
    // Karena profil hanya satu, kita hanya perlu rute untuk menampilkan form (index) dan menyimpan (store)
    Route::get('/profiles', [ProfileController::class, 'index'])->name('profiles.index');
    Route::post('/profiles', [ProfileController::class, 'store'])->name('profiles.store');

    // Rute resource untuk mengelola Skills dan Projects
    // Ini secara otomatis membuat semua rute yang diperlukan (index, create, store, edit, update, destroy)
    Route::resource('skills', SkillController::class);
    Route::resource('projects', ProjectController::class);
});


// ======================================================================
// RUTE OTENTIKASI (LOGIN, REGISTER, DLL.)
// ======================================================================
// File ini berisi semua rute yang diperlukan untuk sistem login
// yang dibuat oleh Laravel Breeze.
require __DIR__.'/auth.php';
