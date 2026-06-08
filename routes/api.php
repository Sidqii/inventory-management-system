<?php

use App\Http\Controllers\Api\Attachments\AttachmentController;
use App\Http\Controllers\Api\Authentication\AuthController;
use App\Http\Controllers\Api\Catalog\CategoryController;
use App\Http\Controllers\Api\Catalog\ProductController;
use App\Http\Controllers\Api\Catalog\UnitController;
use App\Http\Controllers\Api\Catalog\WarehouseController;
use App\Http\Controllers\Api\Inventory\StockController;
use App\Http\Controllers\Api\Transaction\StockMovementController;
use App\Http\Controllers\Api\Transaction\StockRequestController;
use App\Http\Controllers\EmailVerificationController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    Route::prefix('authentication')->group(function () {
        Route::post('/register', [AuthController::class, 'store']);
        Route::post('/login', [AuthController::class, 'login']);

        Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend']);
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('/user', AuthController::class);

        Route::prefix('catalog')->group(function () {
            Route::apiResource('/unit', UnitController::class);
            Route::apiResource('/category', CategoryController::class);

            Route::apiResource('/product', ProductController::class);

            Route::post('/product/{product}/attachments', [AttachmentController::class, 'store']);
            Route::delete('/attachments/{attachment}', [AttachmentController::class, 'destroy']);

            Route::apiResource('/warehouse', WarehouseController::class);
            Route::apiResource('/stock', StockController::class);
        });

        Route::prefix('transaction')->group(function () {
            Route::post('/request', [StockRequestController::class, 'store']);

            Route::post('/approve/{stockRequest}', [StockRequestController::class, 'approve']);
            Route::post('/reject/{stockRequest}', [StockRequestController::class, 'reject']);

            Route::post('/fulfill/{stockRequest}', [StockRequestController::class, 'fulfill']);

            Route::put('/update/{stockRequest}', [StockRequestController::class, 'update']);

            Route::get('/request-item', [StockRequestController::class, 'index']);
            Route::get('/request-item/{stockRequest}', [StockRequestController::class, 'show']);

            Route::apiResource('/request-log', StockMovementController::class)->parameters(['request-log' => 'stockMovement']);
        });

        Route::post('/logout', [AuthController::class, 'logout']);
    });
});
