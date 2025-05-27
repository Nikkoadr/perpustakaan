<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Data_bukuController;

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


//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
