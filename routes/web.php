<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
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
        Route::get('/students', 'index')->name('student.index');
        Route::post('/students', 'store')->name('student.store');
        Route::put('/students/{studentClass}', 'update')->name('student.update');
        Route::delete('/students/{studentClass}', 'destroy')->name('student.destroy');
    });

    Route::controller(StudentClassController::class)->group(function () {
        Route::get('/student-classes', 'index')->name('student-classes.index');
        Route::post('/student-classes', 'store')->name('student-classes.store');
        Route::put('/student-classes/{studentClass}', 'update')->name('student-classes.update');
        Route::delete('/student-classes/{studentClass}', 'destroy')->name('student-classes.destroy');
    });

    Route::controller(BillController::class)->group(function () {
        Route::get('/bills', 'index')->name('bill.index');
        Route::post('/bills', 'store')->name('bill.store');
        Route::put('/bills/{id}', 'update')->name('bill.update');
        Route::delete('/bills/{id}', 'destroy')->name('bill.destroy');

        Route::get('/bills/{id}/show', 'show')->name('bill.show');
        Route::get('/bills/{id}/detail/{month}', 'detail')->name('bill.detail');
        Route::put('/bills/{id}/detail/{month}/update', 'detailUpdate')->name('bill.detail.update');
        Route::put('/bills/{id}/once/update', 'detailOnceUpdate')->name('bill.detail.update.once');
    });

    Route::controller(PaymentController::class)->group(function () {
        Route::get('/payments', 'index')->name('payment.index');
        Route::get('/payments/history', 'history')->name('payment.history');
        Route::post('/payments/{id}/approved', 'approve')->name('payment.approved');
        Route::post('/payments/{id}/reject', 'reject')->name('payment.reject');

        Route::post('/payments/{id}/pay/once', 'payOnce')->name('payment.pay.once');
        Route::post('/payments/{id}/pay/month', 'payMonth')->name('payment.pay.month');
    });

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'index')->name('profile.index');
        Route::put('/profile', 'update')->name('profile.update');
    });
});
