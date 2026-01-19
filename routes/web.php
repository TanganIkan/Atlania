<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExportController;
use Illuminate\Support\Facades\Auth;

// ===== AUTH =====
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'loginProcess'])->name('auth.login.process');

    Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/register', [AuthController::class, 'registerProcess'])->name('auth.register.process');
});

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
})->middleware('auth')->name('auth.logout');

// ===== PUBLIC DASHBOARD =====
Route::get('/', [ArticleController::class, 'index'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [ArticleController::class, 'adminIndex'])->name('admin.dashboard');
});

// ===== PROTECTED CRUD =====
Route::middleware('auth')->group(function () {
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');

    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');

    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
});

// ===== PUBLIC ARTICLE VIEW =====
Route::get('/articles/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::middleware('auth')->group(function () {
    Route::get('/my-articles', [ArticleController::class, 'myArticles'])->name('articles.my');
});

// PDF DOWNLOAD
Route::get('/articles/{id}/download-pdf', [ExportController::class, 'downloadPdf'])->name('articles.download.pdf');

// EXCEL DOWNLOAD
Route::get('/admin/export/chart/{type}', [ExportController::class, 'downloadExcel'])->name('admin.export.chart');

// ADMIN
// 1. Gabungkan semua rute Admin ke dalam satu grup PREFIX dan MIDDLEWARE yang ketat
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {

    // Pastikan ini memanggil AdminController, bukan ArticleController
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Grouping Chart
    Route::get('/chart/users', [AdminController::class, 'chartUsers'])->name('admin.chart.users');
    Route::get('/chart/articles', [AdminController::class, 'chartArticles'])->name('admin.chart.articles');
    Route::get('/chart/popular-articles', [AdminController::class, 'chartPopularArticles'])->name('admin.chart.popular');

    // Perbaikan path: cukup 'admin-articles' karena sudah ada prefix 'admin'
    Route::get('/admin-articles', [ArticleController::class, 'adminArticles'])->name('admin.articles');
});

// ABOUT PAGE
Route::view('/about', 'about')->name('about');
