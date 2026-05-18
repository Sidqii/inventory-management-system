<?php

use App\Http\Controllers\Api\Authentication\AuthController;
use App\Http\Controllers\Api\Catalog\CategoryController;
use App\Http\Controllers\Api\Catalog\ProductController;
use App\Http\Controllers\Api\Catalog\UnitController;
use App\Http\Controllers\Api\Catalog\WarehouseController;
use App\Http\Controllers\Api\Inventory\StockController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'store']);

Route::post('/login', [AuthController::class, 'login']);

Route::apiResource('/user', AuthController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/unit', UnitController::class);
    Route::apiResource('/category', CategoryController::class);

    Route::apiResource('/product', ProductController::class);

    Route::apiResource('/warehouse', WarehouseController::class);

    Route::apiResource('/stock', StockController::class);
});
