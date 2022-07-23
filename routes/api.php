<?php

use App\Http\Controllers\Api\CashRegisterController;
use App\Http\Controllers\Api\MovementController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('localization')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);

    Route::middleware('auth:api')->group(function () {
        Route::apiResource('cash-registers', CashRegisterController::class)->except(['create', 'edit']);
        Route::post('cash-registers/{cash_register}/open', [CashRegisterController::class, 'open'])->name('cash-registers.open');
        Route::post('cash-registers/{cash_register}/close', [CashRegisterController::class, 'close'])->name('cash-registers.close');
        Route::post('cash-registers/{cash_register}/settlement', [CashRegisterController::class, 'settlement'])->name('cash-registers.settlement');
        Route::apiResource('products', ProductController::class)->except(['create', 'edit']);
        Route::apiResource('movements', MovementController::class)->except(['create', 'edit']);
        Route::apiResource('users', UserController::class)->except(['create', 'edit']);
    });
});
