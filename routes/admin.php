<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Backend\AdminSettings;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\Admin\AdditivesController;
use App\Http\Controllers\Backend\Admin\AllergensController;
use App\Livewire\Backend\Admin\PromoBanner\PromoBannerEdit;
use App\Livewire\Backend\Admin\PromoBanner\PromoBannerIndex;
use App\Livewire\Backend\Admin\PromoBanner\PromoBannerCreate;
use App\Livewire\Backend\Admin\DesignTemplates\CreateTemplate;
use App\Http\Controllers\Backend\Admin\PromoBanner\PromoBannerController;
use App\Livewire\Backend\Admin\DesignTemplates\TemplateSectionsController;
use App\Http\Controllers\Backend\Admin\Controllcenter\LiveOrdersController;
use App\Http\Controllers\Backend\Admin\DesignTemplates\DesignTemplatesController;
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
    Route::prefix('bottles')->middleware(['auth:admin', 'PreventBackHistory'])->group(function() {
        Route::get('/list', [BottlesController::class, 'BottlesList'])->name('bottles-list');
        Route::get('/add', [BottlesController::class, 'addBottle'])->name('add-bottle');
        Route::get('/edit/{id}', [BottlesController::class, 'editBottle'])->name('edit-bottle');
        Route::post('/save', [BottlesController::class, 'saveBottle'])->name('save-bottle');
        Route::post('/toggle-bottle-status', [BottlesController::class, 'toggleBottleStatus'])->name('toggle-bottle-status');
        Route::delete('/delete', [BottlesController::class, 'deleteBottle'])->name('delete-bottle');
        Route::put('/bottle/{id}', [BottlesController::class, 'updateBottle'])->name('update-bottle');
    });

    // Additives Routes
    Route::prefix('additives')->middleware(['auth:admin', 'PreventBackHistory'])->group(function() {
        Route::get('/list', [AdditivesController::class, 'AdditivesList'])->name('additives-list');
        Route::get('/add', [AdditivesController::class, 'addAdditive'])->name('add-additive');
        Route::get('/edit/{id}', [AdditivesController::class, 'editAdditive'])->name('edit-additive');
        Route::delete('/delete', [AdditivesController::class, 'deleteAdditive'])->name('delete-additive');
        Route::post('/additive', [AdditivesController::class, 'saveAdditive'])->name('save-additive');
        Route::put('/additive/{id}', [AdditivesController::class, 'updateAdditive'])->name('update-additive');
        Route::post('/toggle-additive-status', [AdditivesController::class, 'toggleAdditiveStatus'])->name('toggle-additive-status');


    });

    // Allergens Routes
    Route::prefix('allergenes')->middleware(['auth:admin', 'PreventBackHistory'])->group(function() {
        Route::get('/list', [AllergensController::class, 'AllergensList'])->name('allergens-list');
        Route::get('/add', [AllergensController::class, 'addAllergen'])->name('add-allergen');
        Route::get('/edit/{id}', [AllergensController::class, 'editAllergen'])->name('edit-allergen');
        Route::post('/save', [AllergensController::class, 'saveAllergen'])->name('save-allergen');
        Route::post('/toggle-allergen-status', [AllergensController::class, 'toggleAllergenStatus'])->name('toggle-allergen-status');
        Route::delete('/delete', [AllergensController::class, 'deleteAllergen'])->name('delete-allergen');
        Route::put('/allergen/{id}', [AllergensController::class, 'updateAllergen'])->name('update-allergen');
    });


    // Live Orders Routes
    Route::prefix('live-orders')->middleware(['auth:admin', 'PreventBackHistory'])->group(function() {
        Route::get('/list', [LiveOrdersController::class, 'index'])->name('live-orders-list');
      //  Route::match(['get', 'post'], '/list', [LiveOrdersController::class, 'handleListRequest'])->name('live-orders-list');

    });


    Route::prefix('promobanner')->middleware(['auth:admin', 'PreventBackHistory'])->group(function() {
        Route::get('/promo-banners/list', [PromoBannerController::class, 'index'])->name('promo-banner-index');
        Route::get('/promo-banners', PromoBannerIndex::class)->name('promo-banners.index');
    });

    Route::prefix('invoices')->middleware(['auth:admin', 'PreventBackHistory'])->group(function() {
        Route::view('/invoices_all', 'backend.pages.admin.blog.invoices-index')->name('invoices-all');
        Route::view('/storno_manager', 'backend.pages.admin.invoices.storno-manager-index')->name('storno-manager');

        //  Route::get('/promo-banners/list', [PromoBannerController::class, 'index'])->name('promo-banner-index');
      //  Route::get('/promo-banners', PromoBannerIndex::class)->name('promo-banners.index');
    });


    Route::prefix('blog')->middleware(['auth:admin', 'PreventBackHistory'])->group(function() {
        Route::view('/blog_all', 'backend.pages.admin.blog.blog-index')->name('blog-all');
        Route::view('/reply_all', 'backend.pages.admin.blog.reply-index')->name('reply-all');
//        Route::view('/storno_manager', 'backend.pages.admin.invoices.storno-manager-index')->name('storno-manager');

        //  Route::get('/promo-banners/list', [PromoBannerController::class, 'index'])->name('promo-banner-index');
      //  Route::get('/promo-banners', PromoBannerIndex::class)->name('promo-banners.index');
    });


        // Managers
        Route::prefix('manager')->middleware(['auth:admin', 'PreventBackHistory'])->group(function() {
            Route::view('/translations', 'backend.pages.admin.manager.translations-manager')->name('translations');
            Route::view('/shopmanagement', 'backend.pages.admin.manager.shop-manager')->name('shopmanagement');
            Route::view('/badwords-list', 'backend.pages.admin.manager.badwords-index')->name('badwords-list');
          //  Route::match(['get', 'post'], '/list', [LiveOrdersController::class, 'handleListRequest'])->name('live-orders-list');

        });


        // Managers
        Route::prefix('gallery')->middleware(['auth:admin', 'PreventBackHistory'])->group(function() {
            Route::view('/gallery-manager', 'backend.pages.admin.globalgallery.gallery-manager')->name('gallerymananer');

        });

        // Templates
        Route::prefix('templates')->middleware(['auth:admin', 'PreventBackHistory'])->group(function() {
            //Route::view('/design-templates', 'backend.pages.admin.templates.admin-templates')->name('adminteamplates');
            Route::get('/design-templates', [DesignTemplatesController::class, 'index'])->name('design-templates-index');
            Route::get('/admin/templates/create', CreateTemplate::class)->name('templates.create');
            Route::get('/edit/{id}/sections', TemplateSectionsController::class)->name('templates.sections.edit');

        });



});



