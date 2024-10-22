<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Broker\BrokerController;

/*
|--------------------------------------------------------------------------
| Broker Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('broker')->name('broker.')->group(function(){

    Route::middleware('PreventBackHistory')->group(function (){
        Route::view('/login', 'backend.pages.broker.auth.login')->name('login');
        Route::post('/login_handler', [BrokerController::class, 'loginHandler'])->name('login_handler');

        Route::view('/register', 'backend.pages.broker.auth.register')->name('register');
        Route::view('/register_first_step', 'dreamposadmin.broker.auth.register_first_step')->name('register_first_step');

        //Route::view('/email_send', 'backend.pages.broker.auth.email-verificaton')->name('email_send');
        Route::view('/email_send', 'dreamposadmin.broker.auth.email-verification')->name('email_send');


        Route::get('/verify/{token}', [BrokerController::class, 'verifyEmail'])->name('verify-email');
        Route::post('/register_last_step_handler', [BrokerController::class, 'registerLastStepHandler'])->name('register_last_step_handler');
        Route::view('/forgot_password', 'backend.pages.broker.auth.forgot-password')->name('forgot-password');
        Route::post('/send-password-reset-link', [BrokerController::class, 'sendPasswordResetLink'])->name('send-password-reset-link');
        Route::get('/password/reset/{token}', [BrokerController::class, 'resetPassword'])->name('reset-password');
        Route::post('/reset-password-handler', [BrokerController::class, 'resetPasswordHandler'])->name('reset-password-handler');
    });

    Route::middleware(['auth:broker', 'PreventBackHistory'])->group(function () {
        Route::get('/dashboard', [BrokerController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout_handler', [BrokerController::class, 'logoutHandler'])->name('logout_handler');
    });
});
