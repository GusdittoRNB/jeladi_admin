<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Management\UserController;
use App\Http\Controllers\Management\UserAdminController;
use App\Http\Controllers\Management\PermohonanSuratController;
use App\Http\Controllers\Management\HistoryPermohonanSuratController;
use App\Http\Controllers\Management\PusatBantuanController;
use App\Http\Controllers\Management\LayananKesehatanArticleController;
use App\Http\Controllers\Management\LayananKesehatanImageController;
use App\Http\Controllers\Management\DemografiJenisController;
use App\Http\Controllers\Management\DemografiKelompokController;
use App\Http\Controllers\Management\GeografisDesacontroller;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile-picture', [ProfileController::class, 'updatePhoto'])->name('profile.update-photo');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard/article/{id}', [HomeController::class, 'article'])->name('dashboard.article');
    Route::get('/dashboard/demografi/{id}', [HomeController::class, 'demografi'])->name('dashboard.demografi');

    Route::prefix('user-management')->group(function () {
        Route::get('admin', [UserAdminController::class, 'index'])->name('usermanagement.admin.index');
        Route::post('admin/store', [UserAdminController::class, 'store'])->name('usermanagement.admin.store');
        Route::get('admin/edit/{id}', [UserAdminController::class, 'edit'])->name('usermanagement.admin.edit');
        Route::patch('admin/edit/{id}', [UserAdminController::class, 'update'])->name('usermanagement.admin.update');
        Route::delete('admin/{id}', [UserAdminController::class, 'destroy'])->name('usermanagement.admin.destroy');

        Route::get('enduser', [UserController::class, 'index'])->name('usermanagement.enduser.index');
        Route::post('enduser/store', [UserController::class, 'store'])->name('usermanagement.enduser.store');
        Route::post('enduser/import', [UserController::class, 'importUser'])->name('usermanagement.enduser.import');
        Route::get('enduser/edit/{id}', [UserController::class, 'edit'])->name('usermanagement.enduser.edit');
        Route::patch('enduser/edit/{id}', [UserController::class, 'update'])->name('usermanagement.enduser.update');
        Route::delete('enduser/{id}', [UserController::class, 'destroy'])->name('usermanagement.enduser.destroy');
    });

    Route::prefix('surat')->group(function () {
        Route::get('permohonan', [PermohonanSuratController::class, 'index'])->name('surat.permohonan.index');
        Route::get('permohonan/detail/{id}', [PermohonanSuratController::class, 'detail'])->name('surat.permohonan.detail');
        Route::post('permohonan/update/{id}', [PermohonanSuratController::class, 'update'])->name('surat.permohonan.update');

        Route::get('history-permohonan', [HistoryPermohonanSuratController::class, 'index'])->name('surat.history-permohonan.index');
        Route::get('history-permohonan/detail/{id}', [HistoryPermohonanSuratController::class, 'detail'])->name('surat.history-permohonan.detail');
    });

    Route::prefix('layanan-kesehatan')->group(function () {
        Route::get('article', [LayananKesehatanArticleController::class, 'index'])->name('layanan-kesehatan.article.index');
        Route::get('article/create', [LayananKesehatanArticleController::class, 'create'])->name('layanan-kesehatan.article.create');
        Route::post('article/store', [LayananKesehatanArticleController::class, 'store'])->name('layanan-kesehatan.article.store');
        Route::get('article/edit/{id}', [LayananKesehatanArticleController::class, 'edit'])->name('layanan-kesehatan.article.edit');
        Route::patch('article/update/{id}', [LayananKesehatanArticleController::class, 'update'])->name('layanan-kesehatan.article.update');
        Route::delete('article/{id}', [LayananKesehatanArticleController::class, 'destroy'])->name('layanan-kesehatan.article.destroy');

        Route::get('article-image/{art_id}', [LayananKesehatanImageController::class, 'index'])->name('layanan-kesehatan.article-image.index');
        Route::post('article-image/store/{art_id}', [LayananKesehatanImageController::class, 'store'])->name('layanan-kesehatan.article-image.store');
        Route::get('article-image/edit/{id}', [LayananKesehatanImageController::class, 'edit'])->name('layanan-kesehatan.article-image.edit');
        Route::patch('article-image/update/{id}', [LayananKesehatanImageController::class, 'update'])->name('layanan-kesehatan.article-image.update');
        Route::delete('article-image/delete/{id}', [LayananKesehatanImageController::class, 'delete'])->name('layanan-kesehatan.article-image.delete');
    });

    Route::prefix('demografi')->group(function () {
        Route::get('jenis-demografi', [DemografiJenisController::class, 'index'])->name('demografi.jenis.index');
        Route::post('jenis-demografi/store', [DemografiJenisController::class, 'store'])->name('demografi.jenis.store');
        Route::get('jenis-demografi/edit/{id}', [DemografiJenisController::class, 'edit'])->name('demografi.jenis.edit');
        Route::patch('jenis-demografi/update/{id}', [DemografiJenisController::class, 'update'])->name('demografi.jenis.update');
        Route::delete('jenis-demografi/delete/{id}', [DemografiJenisController::class, 'delete'])->name('demografi.jenis.delete');

        Route::get('kelompok-demografi/{jenis_id}', [DemografiKelompokController::class, 'index'])->name('demografi.kelompok.index');
        Route::post('kelompok-demografi/store/{jenis_id}', [DemografiKelompokController::class, 'store'])->name('demografi.kelompok.store');
        Route::get('kelompok-demografi/edit/{id}', [DemografiKelompokController::class, 'edit'])->name('demografi.kelompok.edit');
        Route::patch('kelompok-demografi/update/{id}', [DemografiKelompokController::class, 'update'])->name('demografi.kelompok.update');
        Route::delete('kelompok-demografi/delete/{id}', [DemografiKelompokController::class, 'delete'])->name('demografi.kelompok.delete');
    });

    Route::prefix('geografis-desa')->group(function () {
        Route::get('/', [GeografisDesacontroller::class, 'index'])->name('geografis-desa.index');
        Route::post('store', [GeografisDesacontroller::class, 'store'])->name('geografis-desa.store');
        Route::get('edit/{id}', [GeografisDesacontroller::class, 'edit'])->name('geografis-desa.edit');
        Route::patch('update/{id}', [GeografisDesacontroller::class, 'update'])->name('geografis-desa.update');
        Route::delete('delete/{id}', [GeografisDesacontroller::class, 'delete'])->name('geografis-desa.delete');
    });

    Route::get('pusat-bantuan', [PusatBantuanController::class, 'index'])->name('pusat-bantuan.index');
    Route::patch('pusat-bantuan', [PusatBantuanController::class, 'update'])->name('pusat-bantuan.update');
});

require __DIR__.'/auth.php';
