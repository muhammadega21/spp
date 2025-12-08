<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentClassController;
use App\Http\Controllers\WaliController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    return redirect()->route('dashboard.index');
})->name('home');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Admin
Route::middleware(['auth'])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::controller(StudentClassController::class)->group(function () {
        Route::get('/student-classes', 'index')->name('student-classes.index');
        Route::post('/student-classes', 'store')->name('student-classes.store');
        Route::put('/student-classes/{studentClass}', 'update')->name('student-classes.update');
        Route::delete('/student-classes/{studentClass}', 'destroy')->name('student-classes.destroy');
    });
});
