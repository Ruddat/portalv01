<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\OrderStreamController;

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
    // Alte Order-API-Routen
    Route::apiResource('orders', OrderController::class);
    Route::post('orders/{ordersid}/tracking-status', [OrderController::class, 'tracking_status'])->name('orders.tracking_status');
    Route::apiResource('GetNewOrders', OrderController::class);
    Route::apiResource('SendTrackingStatus', OrderController::class);

    // Neue OrderStream-API-Routen
    Route::group(['prefix' => 'orderstream'], function () {
        Route::post('verifyActivationCode', [OrderStreamController::class, 'verifyActivationCode']);
        Route::post('checkActivationStatus', [OrderStreamController::class, 'checkActivationStatus']);

     //   Route::apiResource('verifyActivationCode', OrderStreamController::class);

        Route::apiResource('orders', OrderStreamController::class);
        Route::post('orders/{ordersid}/tracking-status', [OrderStreamController::class, 'tracking_status'])->name('orderstream.orders.tracking_status');
        Route::get('orders/year/{year}', [OrderStreamController::class, 'getOrdersFromYear'])->name('orders.fromYear');
        //        Route::apiResource('GetOrdersYear', OrderStreamController::class)->name('orders.fromYear');
        Route::get('fetchAllOrders', [OrderStreamController::class, 'fetchAllOrders']);
        Route::get('getOrderDetails/{orderhash}', [OrderStreamController::class, 'getOrderDetails']);



        Route::apiResource('GetNewOrders', OrderStreamController::class);
        Route::apiResource('SendTrackingStatus', OrderStreamController::class);
        // Neue Route für fetchConfirmedOrder
        Route::get('fetchConfirmedOrder', [OrderStreamController::class, 'fetchConfirmedOrder']);
         // Neue Route für updateOrderStatus
       //  Route::post('UpdateOrderStatus', [OrderStreamController::class, 'updateOrderStatus'])->name('updateOrderStatus');

       Route::apiResource('updateOrderStatus', OrderStreamController::class);

       Route::get('getOrderDetails', [OrderStreamController::class, 'getOrderDetails']);

    });
});
