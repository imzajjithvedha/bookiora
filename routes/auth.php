<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;

Route::middleware('redirectIfAuthenticated')->group(function () {
    Route::get('login', [AuthenticationController::class, 'login'])->name('login');
    Route::post('login', [AuthenticationController::class, 'store'])->name('login.store');

    Route::get('register', [RegisterController::class, 'register'])->name('register');
    Route::post('register', [RegisterController::class, 'store'])->name('register.store');

    Route::get('forgot-password', [ForgotPasswordController::class, 'index'])->name('forgot-password');
    Route::post('forgot-password', [ForgotPasswordController::class, 'store'])->name('forgot-password.store');

    Route::get('reset-password/{email}/{token}', [ResetPasswordController::class, 'index'])->name('reset-password');
    Route::post('reset-password', [ResetPasswordController::class, 'store'])->name('reset-password.store');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticationController::class, 'logout'])->name('logout');
});