<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Seller\SellerController;
use App\Http\Controllers\backend\seller\DashboardController;





Route::prefix('seller')->name('seller.')->group(function(){

    Route::middleware('PreventBackHistory')->group(function (){
        Route::view('/login', 'backend.pages.seller.auth.login')->name('login');
        Route::post('/login_handler', [SellerController::class, 'loginHandler'])->name('login_handler');
        Route::view('/forgot_password', 'backend.pages.seller.auth.forgot-password')->name('forgot-password');
        Route::post('/send-password-reset-link', [SellerController::class, 'sendPasswordResetLink'])->name('send-password-reset-link');
        Route::get('/password/reset/{token}', [SellerController::class, 'resetPassword'])->name('reset-password');
        Route::post('/reset-password-handler', [SellerController::class, 'resetPasswordHandler'])->name('reset-password-handler');
        Route::view('/register', 'backend.pages.seller.auth.register')->name('register');
        Route::post('/register_handler', [SellerController::class, 'registerHandler'])->name('register_handler');
        Route::get('/verify/{token}', [SellerController::class, 'verifyEmail'])->name('verify-email');
        // register last step handler
        Route::post('/register_last_step_handler', [SellerController::class, 'registerLastStepHandler'])->name('register_last_step_handler');
    });

    Route::middleware(['auth:seller', 'PreventBackHistory'])->group(function () {
        Route::get('/dashboard', [SellerController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout_handler', [SellerController::class, 'logoutHandler'])->name('logout_handler');
        Route::get('/settings', [SellerController::class, 'settings'])->name('settings');
        Route::get('/profile', [SellerController::class, 'profileView'])->name('profile');
        Route::post('/change-profile-picture', [SellerController::class, 'changeProfilePicture'])->name('change-profile-picture');


    });
        // Dashboard routes
        Route::prefix('shop')->middleware(['auth:seller', 'PreventBackHistory'])->group(function() {
            Route::get('/details', [DashboardController::class, 'sellerDetails'])->name('sellerDetails');
            Route::post('/shops/{shop}/copy', [DashboardController::class, 'copyShop'])->name('copyShop');
            Route::delete('/shops/{shop}/delete', [DashboardController::class, 'deleteShop'])->name('deleteShop');
            Route::get('/switchshop', [DashboardController::class, 'switchShop'])->name('switchShop');
        });

        // Openinghours Routes
        Route::prefix('openinghours')->middleware(['auth:seller', 'PreventBackHistory'])->group(function() {
            Route::view('/worktimes', 'backend.pages.seller.worktimes.work-times')->name('worktimes');
        });

        // Openinghours Routes
        Route::prefix('deliveryarea')->middleware(['auth:seller', 'PreventBackHistory'])->group(function() {
        //    Route::view('/shops/{shop}/deliveryarea', 'backend/pages/shops/mod-liefergebiet')->name('deliveryarea');
            Route::get('/shops/{shop}/deliveryarea', [DashboardController::class, 'deliveryArea'])->name('deliveryarea');
        });



});



