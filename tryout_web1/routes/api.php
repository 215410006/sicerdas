<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StudentDashboardController;
use App\Http\Controllers\Api\MateriController;
use App\Http\Controllers\Api\TryoutController;
use App\Http\Controllers\Api\TryoutSiswaController;
use App\Http\Controllers\Api\ProfileApiController;
use App\Http\Controllers\Api\LatihanController;

// =============================
// AUTH
// =============================
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// =============================
// PROTECTED STUDENT ROUTES
// =============================
Route::middleware(['auth:sanctum', 'role:student'])->group(function () {

    // AUTH
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // DASHBOARD
    Route::get('/dashboard', [StudentDashboardController::class, 'index']);

    // PROFILE
    Route::get('/profile', [ProfileApiController::class, 'show']);
    Route::put('/profile/update', [ProfileApiController::class, 'update']);

    // MATERI
    Route::get('/materi', [MateriController::class, 'index']);
    Route::put('/materi/{id}', [MateriController::class, 'show']);

    // TRYOUT
    Route::get('/tryout', [TryoutController::class, 'index']);
    Route::get('/tryout/jadwal', [TryoutController::class, 'schedule']);
    Route::get('/tryout/result', [TryoutController::class, 'result']);
    Route::get('/leaderboard', [TryoutController::class, 'leaderboard']);
    Route::get('/tryout/history', [TryoutController::class, 'history']);


    // TRYOUT PENGERJAAN
    Route::get('/tryout/{id}/kerjakan', [TryoutSiswaController::class, 'kerjakan']);
    Route::post('/tryout/{id}/submit', [TryoutSiswaController::class, 'submit']);


    Route::get('/latihan/categories', [LatihanController::class, 'categories']);
    Route::get('/latihan/soal/{categoryId}', [LatihanController::class, 'soal']);
    Route::post('/latihan/submit', [LatihanController::class, 'submit']);
});
