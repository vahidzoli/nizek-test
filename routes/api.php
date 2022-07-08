<?php

use App\Http\Controllers\API\StockPriceController;
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

Route::post('/uploadExcel', [StockPriceController::class, 'uploadExcel']);
Route::get('/showChanges', [StockPriceController::class, 'showChanges']);
Route::post('/showChangesInDuration', [StockPriceController::class, 'showChangesInSpecificDuration']);