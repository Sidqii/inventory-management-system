<?php

use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\Web\Authentication\AuthController;
use App\Http\Controllers\Web\Catalog\CategoryController;
use App\Http\Controllers\Web\Catalog\DashboardController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

Route::get('/auth', [AuthController::class, 'form'])->name('auth.form');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
    ->middleware(['signed'])->name('verification.verify');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend'])
        ->name('verification.send');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
