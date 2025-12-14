<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentClassController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\WaliController;
use App\Models\BillPackage;
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

    Route::controller(StudentController::class)->group(function () {
        Route::get('/student', 'index')->name('student.index');
        Route::post('/student', 'store')->name('student.store');
        Route::put('/student/{studentClass}', 'update')->name('student.update');
        Route::delete('/student/{studentClass}', 'destroy')->name('student.destroy');
    });

    Route::controller(StudentClassController::class)->group(function () {
        Route::get('/student-classes', 'index')->name('student-classes.index');
        Route::post('/student-classes', 'store')->name('student-classes.store');
        Route::put('/student-classes/{studentClass}', 'update')->name('student-classes.update');
        Route::delete('/student-classes/{studentClass}', 'destroy')->name('student-classes.destroy');
    });

    Route::controller(BillController::class)->group(function () {
        Route::get('/bill', 'index')->name('bill.index');
        Route::post('/bill', 'store')->name('bill.store');
        Route::put('/bill/{id}', 'update')->name('bill.update');
        Route::delete('/bill/{id}', 'destroy')->name('bill.destroy');

        Route::get('/bill/{id}/show', 'show')->name('bill.show');
        Route::get('/bill/{id}/detail/{month}', 'detail')->name('bill.detail');
        Route::put('/bill/{id}/detail/{month}/update', 'detailUpdate')->name('bill.detail.update');
        Route::put('/bill/{id}/once/update', 'detailOnceUpdate')->name('bill.detail.update.once');
    });
});
