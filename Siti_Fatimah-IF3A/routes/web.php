<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DetailPinjamController;

Route::get('/', function () {
    return view('app'); 
})->name('app.blade.php');

Route::resource('anggota', AnggotaController::class);
Route::resource('buku', BukuController::class);
Route::resource('detailpinjam', DetailPinjamController::class);
