<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\OrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::group(['prefix' => 'v1'], function () {
    Route::apiResource('orders', OrderController::class);

    Route::post('orders/{ordersid}/tracking-status', [OrderController::class, 'tracking_status'])->name('orders.tracking_status');

    Route::apiResource('GetNewOrders', OrderController::class);
    Route::apiResource('orders', OrderController::class);
    Route::apiResource('SendTrackingStatus', OrderController::class);

});
