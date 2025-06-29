<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\ProjectController;

Route::get('/', [PortfolioController::class, 'index'])->name('home');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::get('/profiles', [ProfileController::class, 'index'])->name('profiles.index');
    Route::post('/profiles', [ProfileController::class, 'store'])->name('profiles.store');

    Route::resource('skills', SkillController::class);
    Route::resource('projects', ProjectController::class);
});

require __DIR__.'/auth.php';
