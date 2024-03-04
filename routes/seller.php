<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Seller\SellerController;
use App\Http\Controllers\Backend\Seller\DashboardController;
use App\Http\Controllers\Backend\Seller\Shop\ShopDataController;
use App\Http\Controllers\Backend\Seller\Products\ProductController;
use App\Http\Controllers\Backend\Seller\Categories\CategoriesController;
use App\Http\Controllers\Backend\Shop\Spiders\LieferandoSpiderController;





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

        // DeliveryArea Routes
        Route::prefix('deliveryarea')->middleware(['auth:seller', 'PreventBackHistory'])->group(function() {
        //    Route::view('/shops/{shop}/deliveryarea', 'backend/pages/shops/mod-liefergebiet')->name('deliveryarea');
            Route::get('/shops/{shop}/deliveryarea', [DashboardController::class, 'deliveryArea'])->name('deliveryarea');
        });

// Shopdaten
Route::prefix('shopdata')->middleware(['auth:seller', 'PreventBackHistory'])->group(function() {
    Route::view('/shops/{shop}/shopdata', 'backend/pages/seller/shopdata/mod-shopdaten')->name('shopData');
    Route::get('/shop/{shop}/shopdata', [ShopDataController::class, 'restoData'])->name('restoData');
    Route::post('/change-logo-pictures', [ShopDataController::class, 'changeLogoPictures'])->name('change-logo-pictures');
});

// Categories Routes
Route::prefix('manage-categories')->name('manage-categories.')->middleware(['auth:seller', 'PreventBackHistory'])->group(function() {
    Route::get('/', [CategoriesController::class, 'catSubcatList'])->name('cats-subcats-list');
    Route::get('/add-category', [CategoriesController::class, 'addCategory'])->name('add-category');
    Route::post('/store-category', [CategoriesController::class, 'storeCategory'])->name('store-category');
    Route::get('/edit-category', [CategoriesController::class, 'editCategory'])->name('edit-category');
    Route::post('/update-category', [CategoriesController::class, 'updateCategory'])->name('update-category');
    // update-ordering with ajax request
    Route::post('/update-ordering', [CategoriesController::class, 'updateOrdering'])->name('update-ordering');
    Route::post('toggle-category-status', [CategoriesController::class, 'toggleCategoryStatus'])->name('toggle-category-status');
    Route::post('/toggle-show-in-list', [CategoriesController::class, 'toggleShowInList'])->name('toggle-show-in-list');
    Route::post('/toggle-show-status', [CategoriesController::class, 'toggleShowStatus'])->name('toggle-show-status');

});

// Products Routes
Route::prefix('manage-products')->name('manage-products.')->middleware(['auth:seller', 'PreventBackHistory'])->group(function() {
    Route::get('/', [ProductController::class, 'productsList'])->name('products-list');
    Route::get('/add-product', [ProductController::class, 'addProduct'])->name('add-product');
    Route::post('/store-product', [ProductController::class, 'storeProduct'])->name('store-product');
    Route::get('/edit-product', [ProductController::class, 'editProduct'])->name('edit-product');
    Route::get('/delete-product', [ProductController::class, 'deleteProduct'])->name('delete-product');
    Route::post('/update-product', [ProductController::class, 'updateProduct'])->name('update-product');
    Route::post('/toggle-product-status', [ProductController::class, 'toggleProductStatus'])->name('toggle-product-status');
    Route::post('/toggle-show-status', [ProductController::class, 'toggleShowStatus'])->name('toggle-show-status');
    Route::post('/toggle-show-in-list', [ProductController::class, 'toggleShowInList'])->name('toggle-show-in-list');
    Route::post('/update-ordering', [ProductController::class, 'updateOrdering'])->name('update-ordering');
});




// Testing Methods
    Route::prefix('test')->middleware(['auth:seller', 'PreventBackHistory'])->group(function() {
        Route::get('/test', [LieferandoSpiderController::class, 'indexAction'])->name('indexAction');
    });



});



