<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ForgetPasswordController;
use App\Http\Controllers\Api\JenisSuratController;
use App\Http\Controllers\Api\PermohonanSuratController;
use App\Http\Controllers\Api\PusatBantuanController;
use App\Http\Controllers\Api\LayananKesehatanController;
use App\Http\Controllers\Api\DemografiController;
use App\Http\Controllers\Api\GeografisDesacontroller;

Route::post('login', [AuthController::class, 'login'])->name('api.login');

Route::prefix('forget-password')->group(function () {
    Route::post('request', [ForgetPasswordController::class, 'requestOtp'])->name('forget-password.request');
    Route::post('verify-otp', [ForgetPasswordController::class, 'verifyOtp'])->name('forget-password.verify-otp');
    Route::post('set-password', [ForgetPasswordController::class, 'setPassword'])->name('forget-password.set-password');
});


Route::middleware('auth:api')->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('detail', [UserController::class, 'detail'])->name('api.user.detail');
        Route::post('update-profile', [UserController::class, 'updateProfile'])->name('api.user.update-profile');
        Route::post('update-password', [UserController::class, 'updatePassword'])->name('api.user.update-password');
    });

    Route::prefix('surat')->group(function () {
        Route::get('jenis-surat', [JenisSuratController::class, 'index'])->name('api.surat.jenis-surat.index');

        Route::get('permohonan/riwayat', [PermohonanSuratController::class, 'index'])->name('api.surat.permohonan.index');
        Route::get('permohonan/detail/{id}', [PermohonanSuratController::class, 'detail'])->name('api.surat.permohonan.detail');
        Route::post('permohonan/store', [PermohonanSuratController::class, 'store'])->name('api.surat.permohonan.store');
    });

    Route::get('layanan-kesehatan', [LayananKesehatanController::class, 'index'])->name('api.layanan-kesehatan.index');
    Route::get('layanan-kesehatan/detail/{id}', [LayananKesehatanController::class, 'detail'])->name('api.layanan-kesehatan.detail');

    Route::get('geografis-desa', [GeografisDesaController::class, 'index'])->name('api.geografis-desa');
    Route::get('demografi', [DemografiController::class, 'index'])->name('api.demografi.index');
    Route::get('demografi/detail/{id}', [DemografiController::class, 'detail'])->name('api.demografi.detail');
    Route::get('pusat-bantuan', [PusatBantuanController::class, 'index'])->name('api.pusat-bantuan');

    Route::get('logout', [AuthController::class, 'logout'])->name('api.logout');
});
