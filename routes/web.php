<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;

// login
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginProcess']);

// register
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'registerProcess']);

// logout
Route::post('/logout', [AuthController::class, 'logout']);

// role admin & superadmin
Route::get('/admin/dashboard', [ArticleController::class, 'index']);

// articles
Route::get('/dashboard', [ArticleController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ArticleController::class, 'index']);

    Route::get('/articles/create', [ArticleController::class, 'create']);
    Route::post('/articles', [ArticleController::class, 'store']);

    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit']);
    Route::put('/articles/{article}', [ArticleController::class, 'update']);

    Route::delete('/articles/{article}', [ArticleController::class, 'destroy']);
});