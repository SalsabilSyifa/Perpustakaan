<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StatusBukuController;

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');

    Route::get('/anggota', [AnggotaController::class, 'index'])
    ->name('anggota.index');

    Route::get('/anggota/create', [AnggotaController::class, 'create'])
    ->name('anggota.create');

    Route::get('/anggota/{id}/edit', [AnggotaController::class, 'edit'])
    ->name('anggota.edit');

    Route::put('/anggota/{id}', [AnggotaController::class, 'update'])
    ->name('anggota.update');

    Route::post('/anggota', [AnggotaController::class, 'store'])
    ->name('anggota.store');

    Route::delete('/anggota/{id}', [AnggotaController::class, 'destroy'])->name('anggota.destroy');

    Route::get('/buku', [BukuController::class, 'index'])
    ->name('buku.index');

    Route::get('/buku/create', [BukuController::class, 'create'])
    ->name('buku.create');

    Route::get('/buku/{id}/edit', [BukuController::class, 'edit'])
    ->name('buku.edit');

    Route::put('/buku/{id}', [BukuController::class, 'update'])
    ->name('buku.update');

    Route::post('/buku', [BukuController::class, 'store'])
    ->name('buku.store');

    Route::delete('/buku/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');

    Route::resource('status_buku', StatusBukuController::class);

