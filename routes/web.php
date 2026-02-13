<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardAnggotaController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\StatusBukuController;
use App\Http\Controllers\UserController;

Route::get('/', [DashboardAnggotaController::class, 'index'])
    ->name('home');

/*
|--------------------------------------------------------------------------
| DASHBOARD ADMIN & PETUGAS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin,petugas'])->group(function () {
   
    Route::get('/admin', [DashboardController::class, 'index'])
        ->name('dashboard');

        Route::get('/laporan/peminjaman/excel',
    [PeminjamanController::class, 'exportExcel']
)->name('laporan.peminjaman.excel');

    /*
    |--------------------------------------------------------------------------
    | ANGGOTA
    |--------------------------------------------------------------------------
    */

    Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota.index');
    Route::get('/anggota/{id}/edit', [AnggotaController::class, 'edit'])->name('anggota.edit');
    Route::put('/anggota/{id}', [AnggotaController::class, 'update'])->name('anggota.update');

    Route::middleware('role:admin')->group(function () {
        Route::get('/anggota/create', [AnggotaController::class, 'create'])->name('anggota.create');
        Route::post('/anggota', [AnggotaController::class, 'store'])->name('anggota.store');
        Route::delete('/anggota/{id}', [AnggotaController::class, 'destroy'])->name('anggota.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | BUKU
    |--------------------------------------------------------------------------
    */

    Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
    Route::get('/buku/{id}/edit', [BukuController::class, 'edit'])->name('buku.edit');
    Route::put('/buku/{id}', [BukuController::class, 'update'])->name('buku.update');

    Route::middleware('role:admin')->group(function () {
        Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create');
        Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');
        Route::delete('/buku/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | STATUS & PEMINJAMAN
    |--------------------------------------------------------------------------
    */

    Route::resource('status_buku', StatusBukuController::class);
    Route::resource('peminjaman', PeminjamanController::class);

    Route::post('peminjaman/{id}/kembali', 
        [PeminjamanController::class, 'returnBook']
    )->name('peminjaman.kembali');

    Route::get('/laporan/peminjaman', 
        [PeminjamanController::class, 'laporan']
    )->name('laporan.peminjaman');
});


/*
|--------------------------------------------------------------------------
| DASHBOARD ANGGOTA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:anggota'])->group(function () {

    Route::get('/dashboard-anggota', function () {
        return view('anggota_view.dashboard');
    })->name('dashboard.anggota');
});



Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::resource('users', UserController::class)
        ->except(['create','store','show']);

});


require __DIR__.'/auth.php';
