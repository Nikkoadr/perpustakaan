<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Data_bukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\ProfileController;


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
    'register' => false,
    'reset' => true,
    'verify' => false,
]);

Route::get('/admin/dashboard', [DashboardController::class, 'dashboard']);
Route::resource('/admin/data_buku', Data_bukuController::class);
Route::resource('/admin/kategori', KategoriController::class);
Route::resource('/admin/pengguna', PenggunaController::class);
Route::get('/admin/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
Route::post('/admin/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');

Route::get('/autocomplete/pengguna', [PeminjamanController::class, 'autocompletePengguna']);
Route::get('/autocomplete/buku', [PeminjamanController::class, 'autocompleteBuku']);

Route::put('/peminjaman/{id}/kembalikan', [PeminjamanController::class, 'kembalikan'])->name('peminjaman.kembalikan');
Route::get('/peminjaman/{id}/perpanjang', [PeminjamanController::class, 'perpanjang'])->name('peminjaman.perpanjang');

Route::get('/admin/laporan/harian', [LaporanController::class, 'index'])->name('laporan.index');
Route::get('/admin/laporan/bulanan', [LaporanController::class, 'bulanan'])->name('laporan.bulanan');
Route::get('/admin/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::put('/admin/profile', [ProfileController::class, 'update'])->name('profile.update');
