<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Data_bukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PenggunaController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' => true,
    'reset' => true,
    'verify' => false,
]);

Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
Route::resource('/admin/data_buku', Data_bukuController::class);
Route::resource('/admin/kategori', KategoriController::class);
Route::resource('/admin/pengguna', PenggunaController::class);
Route::get('/admin/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
Route::get('/admin/laporan/peminjaman', [LaporanController::class, 'peminjaman'])->name('laporan.peminjaman');
Route::get('/admin/laporan/pengembalian', [LaporanController::class, 'pengembalian'])->name('laporan.pengembalian');
