<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnggotaController; 

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');
Route::resource('anggota', AnggotaController::class);
