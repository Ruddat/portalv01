<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Buyer\ClientController;



Route::prefix('client')->name('client.')->group(function(){
    Route::middleware('PreventBackHistory')->group(function (){

        Route::view('/login', 'frontend.pages.buyer.auth.login')->name('login');
        Route::post('/login_handler', [ClientController::class, 'loginHandler'])->name('login_handler');
        Route::get('/logout', [ClientController::class, 'logoutHandler'])->name('logout-handler');
        Route::view('/forgot_password', 'frontend.pages.buyer.auth.forgot-password')->name('forgot-password');
        Route::post('/send-password-reset-link', [ClientController::class, 'sendPasswordResetLink'])->name('send-password-reset-link');
        Route::get('/password/reset/{token}', [ClientController::class, 'resetPassword'])->name('reset-password');
        Route::post('/reset-password-handler', [ClientController::class, 'resetPasswordHandler'])->name('reset-password-handler');
        Route::view('/register', 'frontend.pages.buyer.auth.register')->name('register');
        Route::post('/register_handler', [ClientController::class, 'registerHandler'])->name('register_handler');
        Route::get('/verify/{token}', [ClientController::class, 'verifyEmail'])->name('verify-email');
        Route::post('/register_last_step_handler', [ClientController::class, 'registerLastStepHandler'])->name('register_last_step_handler');
    });



    Route::middleware(['auth:client', 'PreventBackHistory'])->group(function () {
        Route::view('/dashboard', 'frontend.pages.buyer.dashboard-index')->name('dashboard');
       // Route::get('/dashboard', [ClientController::class, 'dashboard'])->name('dashboard');

  //      Route::post('/logout_handler', [SellerController::class, 'logoutHandler'])->name('logout_handler');
  //      Route::get('/settings', [SellerController::class, 'settings'])->name('settings');
  //      Route::get('/profile', [SellerController::class, 'profileView'])->name('profile');
  //      Route::post('/change-profile-picture', [SellerController::class, 'changeProfilePicture'])->name('change-profile-picture');
    });





});









