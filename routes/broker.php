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

    //    Route::get('/login', 'Broker\Auth\LoginController@showLoginForm')->name('login');
   //     Route::post('/login', 'Broker\Auth\LoginController@login')->name('login');
  //      Route::post('/logout', 'Broker\Auth\LoginController@logout')->name('logout');

        Route::view('/register', 'backend.pages.broker.auth.register')->name('register');
  //      Route::post('/register_handler', [BrokerController::class, 'registerHandler'])->name('register_handler');
        Route::view('/email_send', 'backend.pages.broker.auth.email-verificaton')->name('email_send');
        Route::get('/verify/{token}', [BrokerController::class, 'verifyEmail'])->name('verify-email');
        Route::post('/register_last_step_handler', [BrokerController::class, 'registerLastStepHandler'])->name('register_last_step_handler');
        Route::view('/forgot_password', 'backend.pages.broker.auth.forgot-password')->name('forgot-password');
        Route::post('/send-password-reset-link', [BrokerController::class, 'sendPasswordResetLink'])->name('send-password-reset-link');
        Route::get('/password/reset/{token}', [BrokerController::class, 'resetPassword'])->name('reset-password');
        Route::post('/reset-password-handler', [BrokerController::class, 'resetPasswordHandler'])->name('reset-password-handler');


 //       Route::get('/register', 'Broker\Auth\RegisterController@showRegistrationForm')->name('register');
 //       Route::post('/register', 'Broker\Auth\BrokerController@register')->name('register');

  //      Route::get('/password/reset', 'Broker\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//        Route::post('/password/email', 'Broker\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
 //       Route::get('/password/reset/{token}', 'Broker\Auth\ResetPasswordController@showResetForm')->name('password.reset');
 //       Route::post('/password/reset', 'Broker\Auth\ResetPasswordController@reset')->name('password.update');

   //     Route::get('/email/verify', 'Broker\Auth\VerificationController@show')->name('verification.notice');
   //     Route::get('/email/verify/{id}/{hash}', 'Broker\Auth\VerificationController@verify')->name('verification.verify');
   //     Route::post('/email/resend', 'Broker\Auth\VerificationController@resend')->name('verification.resend');

    });

    Route::middleware(['auth:broker', 'PreventBackHistory'])->group(function () {
        Route::get('/dashboard', [BrokerController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout_handler', [BrokerController::class, 'logoutHandler'])->name('logout_handler');
      //  Route::get('/settings', [SellerController::class, 'settings'])->name('settings');
      //  Route::get('/profile', [SellerController::class, 'profileView'])->name('profile');
      //  Route::post('/change-profile-picture', [SellerController::class, 'changeProfilePicture'])->name('change-profile-picture');
    });





});
