<?php

use App\Http\Controllers\Api\CashRegisterController;
use App\Http\Controllers\Api\MovementController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\SelectListController;
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
        Route::get('cash-registers/{cash_register}/detail', [CashRegisterController::class, 'detail'])->name('cash-registers.detail');
        Route::get('cash-registers/{cash_register}/report', [CashRegisterController::class, 'report'])->name('cash-registers.report');
        Route::apiResource('products', ProductController::class)->except(['create', 'edit']);
        Route::apiResource('movements', MovementController::class)->except(['create', 'edit']);
        Route::apiResource('users', UserController::class)->except(['create', 'edit']);

        //Lists
        Route::get('lists/{type}', [SelectListController::class, 'index']);
        Route::get('lists/{type}/{id}', [SelectListController::class, 'show']);

        /* Route::prefix('reports')->group(function () {
            Route::controller(ReportController::class)->group(function () {
                Route::get('/cash-register/{detail}', 'byCashRegister');
            });
        }); */
    });
});
