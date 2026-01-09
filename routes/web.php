<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Auth;

// ===== AUTH =====
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginProcess']);

Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'registerProcess']);

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/dashboard');
})->middleware('auth')->name('logout');

// ===== PUBLIC DASHBOARD =====
Route::get('/dashboard', [ArticleController::class, 'index']);

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [ArticleController::class, 'adminIndex']);
});

// ===== PROTECTED CRUD =====
Route::middleware('auth')->group(function () {
    Route::get('/articles/create', [ArticleController::class, 'create']);
    Route::post('/articles', [ArticleController::class, 'store']);

    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit']);
    Route::put('/articles/{article}', [ArticleController::class, 'update']);

    Route::delete('/articles/{article}', [ArticleController::class, 'destroy']);
});