<?php

use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\Web\Authentication\AuthController;
use App\Http\Controllers\Web\Authentication\CredentialController;
use App\Http\Controllers\Web\Catalog\DashboardController;
use App\Http\Controllers\Web\Catalog\HistoryController;
use App\Http\Controllers\Web\Catalog\InventoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('auth.form');
});

Route::get('/auth', [AuthController::class, 'form'])->name('auth.form');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
    ->middleware(['signed'])->name('verification.verify');

Route::middleware(['auth'])->group(function () {
    Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend'])
        ->name('verification.send');

    Route::prefix('catalog')->group(function () {
        Route::resource('/dashboard', DashboardController::class);

        Route::resource('/inventory', InventoryController::class);

        Route::resource('/history', HistoryController::class);

        Route::resource('/credential', CredentialController::class);
    });
});
