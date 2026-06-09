<?php

use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\Web\Authentication\AuthController;
use App\Http\Controllers\Web\Authentication\CredentialController;
use App\Http\Controllers\Web\Catalog\DashboardController;
use App\Http\Controllers\Web\Catalog\HistoryController;
use App\Http\Controllers\Web\Catalog\InventoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard.view');
    }

    return redirect()->route('form');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'form'])->name('form');

    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::middleware('signed')->group(function () {
    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify');

    Route::get('/email/verify-notification', [EmailVerificationController::class, 'resend'])->name('email.resend');
});

Route::middleware(['auth', 'prevent-back-history'])->group(function () {
    Route::prefix('catalog')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.view');
        Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.view');
        Route::get('/credential', [CredentialController::class, 'index'])->name('credential.view');
        Route::get('/movement', [HistoryController::class, 'index'])->name('movement.view');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
