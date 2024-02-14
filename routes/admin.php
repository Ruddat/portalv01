<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Backend\AdminSettings;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\Admin\AdditivesController;
use App\Http\Controllers\Backend\Admin\BottlesController; // Importiere den BottlesController

Route::prefix('admin')->name('admin.')->group(function(){

    Route::middleware('PreventBackHistory')->group(function (){
        Route::view('/login', 'backend.pages.admin.auth.login')->name('login');
        Route::post('/login_handler', [AdminController::class, 'loginHandler'])->name('login_handler');
        Route::view('/forgot_password', 'backend.pages.admin.auth.forgot-password')->name('forgot-password');
        Route::post('/send-password-reset-link', [AdminController::class, 'sendPasswordResetLink'])->name('send-password-reset-link');
        Route::get('/password/reset/{token}', [AdminController::class, 'resetPassword'])->name('reset-password');
        Route::post('/reset-password-handler', [AdminController::class, 'resetPasswordHandler'])->name('reset-password-handler');

    });

    Route::middleware(['auth:admin', 'PreventBackHistory'])->group(function () {
        Route::view('/home', 'backend.pages.admin.home')->name('home');
        Route::post('/logout_handler', [AdminController::class, 'logoutHandler'])->name('logout_handler');
        Route::get('/profile', [AdminController::class, 'profileView'])->name('profile');
        Route::post('/change-profile-picture', [AdminController::class, 'changeProfilePicture'])->name('change-profile-picture');
        Route::view('/settings', 'backend.pages.admin.settings')->name('settings');
        Route::post('/update-general-settings', [AdminSettings::class, 'updateGeneralSettings'])->name('update-general-settings');
        Route::post('/change-logo', [AdminController::class, 'changeLogo'])->name('change-logo');
        Route::post('/change-favicon', [AdminController::class, 'changeFavicon'])->name('change-favicon');
        Route::post('/update-social-networks', [AdminSettings::class, 'updateSocialNetworks'])->name('update-social-networks');

    });

    // Bottles Routes
    Route::prefix('bottles')->group(function() {
        Route::get('/list', [BottlesController::class, 'BottlesList'])->name('bottles-list');
        Route::get('/add', [BottlesController::class, 'addBottle'])->name('add-bottle');
        Route::get('/edit/{id}', [BottlesController::class, 'editBottle'])->name('edit-bottle');
        Route::post('/save', [BottlesController::class, 'saveBottle'])->name('save-bottle');
    });

    // Additives Routes
    Route::prefix('additives')->group(function() {
        Route::get('/list', [AdditivesController::class, 'AdditivesList'])->name('additives-list');
        Route::get('/add', [AdditivesController::class, 'addAdditive'])->name('add-additive');
        Route::get('/edit/{id}', [AdditivesController::class, 'editAdditive'])->name('edit-additive');
        Route::post('/save', [AdditivesController::class, 'saveAdditive'])->name('save-additive');
    });

    // Allergens Routes
    Route::get('/allergens-list', [BottlesController::class, 'AllergensList'])->name('allergens-list');

});



