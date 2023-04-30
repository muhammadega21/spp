<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

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

// Login
Route::get('/', [LoginController::class, 'index'])->middleware('guest');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// register
Route::get('/register', [LoginController::class, 'register'])->middleware('guest');
Route::post('/register', [LoginController::class, 'store_register']);

// Home
Route::get('/dashboard', [Controller::class, 'index'])->middleware('auth');
Route::get('/home', [Controller::class, 'index'])->middleware('auth');

// Siswa
Route::resource('/siswa', SiswaController::class)->middleware('auth');
Route::resource('/siswa/posts', SiswaController::class)->middleware('auth');

// Petugas
Route::resource('/petugas', PetugasController::class);
