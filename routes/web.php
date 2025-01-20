<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DisposisiController;
use App\Http\Controllers\KlasifikasiController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\SuratMasukController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('klasifikasi')->group(function () {
        Route::get('/', [KlasifikasiController::class, 'index'])->name('klasifikasi.index');
        Route::post('/', [KlasifikasiController::class, 'store'])->name('klasifikasi.store');
        Route::get('/edit/{id}', [KlasifikasiController::class, 'edit'])->name('klasifikasi.edit');
        Route::put('/update/{id}', [KlasifikasiController::class, 'update'])->name('klasifikasi.update');
        Route::get('/data', [KlasifikasiController::class, 'data'])->name('klasifikasi.data');
    });

    Route::prefix('surat')->group(function () {
        Route::prefix('suratmasuk')->group(function () {
            Route::get('/', [SuratMasukController::class, 'index'])->name('surat.suratmasuk.index');
            Route::get('/create', [SuratMasukController::class, 'create'])->name('surat.suratmasuk.create');
            Route::post('/create', [SuratMasukController::class, 'store'])->name('surat.suratmasuk.store');
            Route::get('/edit/{id}', [SuratMasukController::class, 'edit'])->name('surat.suratmasuk.edit');
            Route::put('/update/{id}', [SuratMasukController::class, 'update'])->name('surat.suratmasuk.update');
            Route::post('/hapus_lamp/{id}', [SuratMasukController::class, 'hapus_lamp'])->name('surat.suratmasuk.hapus_lamp');
            Route::post('/destroy/{id}', [SuratMasukController::class, 'destroy'])->name('surat.suratmasuk.destroy');
            Route::get('/data', [SuratMasukController::class, 'data'])->name('surat.suratmasuk.data');

            Route::prefix('disposisi')->group(function () {
                Route::get('/{suratMasuk}', [DisposisiController::class, 'index'])->name('surat.suratmasuk.disposisi.index');
                Route::get('/{suratMasuk}/create', [DisposisiController::class, 'create'])->name('surat.suratmasuk.disposisi.create');
                Route::post('/{suratMasuk}', [DisposisiController::class, 'store'])->name('surat.suratmasuk.disposisi.store');
                Route::get('/{id}/edit', [DisposisiController::class, 'edit'])->name('surat.suratmasuk.disposisi.edit');
                Route::put('/{id}/update', [DisposisiController::class, 'update'])->name('surat.suratmasuk.disposisi.update');
            });
        });

        Route::prefix('suratkeluar')->group(function () {
            Route::get('/', [SuratKeluarController::class, 'index'])->name('surat.suratkeluar.index');
            Route::get('/create', [SuratKeluarController::class, 'create'])->name('surat.suratkeluar.create');
            Route::post('/create', [SuratKeluarController::class, 'store'])->name('surat.suratkeluar.store');
            Route::get('/edit/{id}', [SuratKeluarController::class, 'edit'])->name('surat.suratkeluar.edit');
            Route::put('/update/{id}', [SuratKeluarController::class, 'update'])->name('surat.suratkeluar.update');
            Route::post('/hapus_lampiran/{id}', [SuratKeluarController::class, 'hapus_lampiran'])->name('surat.suratkeluar.hapus_lampiran');
            Route::post('/destroy/{id}', [SuratKeluarController::class, 'destroy'])->name('surat.suratkeluar.destroy');
            Route::get('/data', [SuratKeluarController::class, 'data'])->name('surat.suratkeluar.data');
        });
    });
});
