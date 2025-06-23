<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\PustakawanAuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\Auth\AnggotaAuthController;

use App\Http\Controllers\{
    AdminController,
    PustakawanController,
    AnggotaController,
    KategoriBukuController
};

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::prefix('admin')->group(function () {
    Route::post('login', [AdminAuthController::class, 'login']);

    Route::middleware('auth:admin')->group(function () {
        Route::get('me', [AdminAuthController::class, 'me']);
        Route::post('logout', [AdminAuthController::class, 'logout']);
    });
});

Route::prefix('pustakawan')->group(function () {
    Route::post('login', [PustakawanAuthController::class, 'login']);

    Route::middleware('auth:pustakawan')->group(function () {
        Route::get('me', [PustakawanAuthController::class, 'me']);
        Route::post('logout', [PustakawanAuthController::class, 'logout']);
    });
});

Route::middleware('auth:pustakawan')->group(function () {
    Route::apiResource('buku', BukuController::class);
});

Route::prefix('anggota')->group(function () {
    Route::post('login', [AnggotaAuthController::class, 'login']);
    Route::middleware('auth:anggota')->group(function () {
        Route::get('me', [AnggotaAuthController::class, 'me']);
        Route::post('logout', [AnggotaAuthController::class, 'logout']);
    });
});
