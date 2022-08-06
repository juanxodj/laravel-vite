<?php

use App\Http\Controllers\Api\ReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return 'API LARAVEL VITE';
});

/* Route::get('/', function () {
    return view('app');
});
Route::view('/{any}', 'app')->where('any', '.*'); */

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

Route::prefix('reports')->group(function () {
    Route::controller(ReportController::class)->group(function () {
        Route::get('/cash-register/{cash_register}', 'byCashRegister');
        Route::get('/product', 'byProduct');
    });
});
