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

    //    Route::get('/login', 'Broker\Auth\LoginController@showLoginForm')->name('login');
   //     Route::post('/login', 'Broker\Auth\LoginController@login')->name('login');
  //      Route::post('/logout', 'Broker\Auth\LoginController@logout')->name('logout');

        Route::view('/register', 'backend.pages.broker.auth.register')->name('register');
        Route::post('/register_handler', [BrokerController::class, 'registerHandler'])->name('register_handler');
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



});
