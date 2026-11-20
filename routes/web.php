<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

// Publik
Route::get('/', fn () => redirect()->route('recipes.index'));
Route::get('/resepmakanan', [RecipeController::class, 'index'])->name('recipes.index');
Route::get('/resepmakanan/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');

// Setelah login, Breeze mengarah ke route bernama "dashboard"
Route::get('/dashboard', fn () => redirect()->route('admin.dashboard'))
    ->middleware('auth')
    ->name('dashboard');

// Admin (wajib login)
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', Admin\DashboardController::class)->name('dashboard');
    Route::resource('recipes', Admin\RecipeController::class)->except('show');
    Route::resource('categories', Admin\CategoryController::class)->only(['index', 'store', 'destroy']);
});

// Rute login/logout dari Laravel Breeze
require __DIR__.'/auth.php';