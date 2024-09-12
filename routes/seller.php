<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Backend\Seller\SellerController;
use App\Http\Controllers\Backend\Seller\DashboardController;
use App\Http\Controllers\Backend\Seller\Review\ReviewController;
use App\Http\Controllers\Backend\Seller\Shop\ShopDataController;
use App\Http\Controllers\Backend\Seller\Products\ProductController;
use App\Http\Controllers\Backend\Seller\LottoSim\LottoSimController;
use App\Http\Controllers\Backend\Seller\Worktimes\WorktimesController;
use App\Livewire\Backend\Seller\WebTemplates\TemplatePreviewComponent;
use App\Http\Controllers\Backend\Seller\Categories\CategoriesController;
use App\Http\Controllers\Backend\Shop\Spiders\LieferandoSpiderController;
use App\Http\Controllers\Backend\Seller\Ingredients\IngredientsController;
use App\Http\Controllers\Backend\Seller\OrderOverview\OrderOverviewController;





Route::prefix('seller')->name('seller.')->group(function(){

    Route::middleware('PreventBackHistory')->group(function (){
        Route::view('/login', 'backend.pages.seller.auth.login')->name('login');
        Route::post('/login_handler', [SellerController::class, 'loginHandler'])->name('login_handler');
        Route::view('/forgot_password', 'backend.pages.seller.auth.forgot-password')->name('forgot-password');
        Route::post('/send-password-reset-link', [SellerController::class, 'sendPasswordResetLink'])->name('send-password-reset-link');
        Route::get('/password/reset/{token}', [SellerController::class, 'resetPassword'])->name('reset-password');
        Route::post('/reset-password-handler', [SellerController::class, 'resetPasswordHandler'])->name('reset-password-handler');
   //     Route::view('/register', 'backend.pages.seller.auth.register')->name('register');
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



    // Pos System
    Route::prefix('pos-system')->middleware(['auth:seller', 'PreventBackHistory'])->group(function() {
        Route::view('/liveorders/{shopId}', 'backend.pages.seller.pos-system.live-orders-connect')->name('liveorders-connect');
    });


    // Dashboard routes
    Route::prefix('shop')->middleware(['auth:seller', 'PreventBackHistory'])->group(function() {
        Route::get('/details', [DashboardController::class, 'sellerDetails'])->name('sellerDetails');
        Route::post('/shops/{shop}/copy', [DashboardController::class, 'copyShop'])->name('copyShop');
        Route::delete('/shops/{shop}/delete', [DashboardController::class, 'deleteShop'])->name('deleteShop');
        Route::get('/switchshop', [DashboardController::class, 'switchShop'])->name('switchShop');
    });


    Route::prefix('marketing')->middleware(['auth:seller', 'PreventBackHistory'])->group(function() {
        Route::view('/toprank/{shopId}', 'backend.pages.seller.marketing.toprank-index')->name('toprank');
        Route::view('/stampcard/{shopId}', 'backend.pages.seller.marketing.stampcard-index')->name('stampcard');
   //     Route::view('/storno_manager', 'backend.pages.admin.invoices.storno-manager-index')->name('storno-manager');

        //  Route::get('/promo-banners/list', [PromoBannerController::class, 'index'])->name('promo-banner-index');
      //  Route::get('/promo-banners', PromoBannerIndex::class)->name('promo-banners.index');
    });



    // Product Statistic
    Route::prefix('manage-product-statisti')->middleware(['auth:seller', 'PreventBackHistory'])->group(function() {
        Route::view('/productstatitik/{shopId}', 'backend.pages.seller.productstats.product-stats')->name('product-stats');
    });


        // Web Domains
        Route::prefix('manage-domains')->middleware(['auth:seller', 'PreventBackHistory'])->group(function() {
            Route::view('/shop/{shopId}/domains', 'backend.pages.seller.webdomains.web-domains')->name('web-domains');
        });


    Route::prefix('invoicesmanager')->middleware(['auth:seller', 'PreventBackHistory'])->group(function() {
        Route::view('/invoices_all/{shopId}', 'backend.pages.seller.invoices.invoices-index')->name('invoices-all');
   //     Route::view('/storno_manager', 'backend.pages.admin.invoices.storno-manager-index')->name('storno-manager');

        //  Route::get('/promo-banners/list', [PromoBannerController::class, 'index'])->name('promo-banner-index');
      //  Route::get('/promo-banners', PromoBannerIndex::class)->name('promo-banners.index');
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
            Route::post('/change-shop-restapi', [ShopDataController::class, 'changeShopDataRestApi'])->name('change-shop-restapi');
            Route::post('/change-shop-soap', [ShopDataController::class, 'changeShopDataSoap'])->name('change-shop-soap');
            Route::post('/generate-activation-code', [ShopDataController::class, 'generateActivationCode'])->name('generate-activation-code');
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
    // Neue Route für das Abrufen der Galerie mit der gefilterten Kategorie
    Route::get('/get-gallery-images/{categoryId}/{subcategoryId}', [CategoriesController::class, 'getGalleryImages']);

});

// Ingredients Routes
Route::prefix('manage-ingredients')->name('manage-ingredients.')->middleware(['auth:seller', 'PreventBackHistory'])->group(function() {
    Route::get('/', [IngredientsController::class, 'ingredientsIndex'])->name('ingredients-index');
    Route::get('/add-ingredient', [IngredientsController::class, 'addIngredient'])->name('add-ingredient');
    Route::post('/store-ingredient', [IngredientsController::class, 'storeIngredient'])->name('store-ingredient');
    Route::get('/edit-ingredient', [IngredientsController::class, 'editIngredient'])->name('edit-ingredient');
    Route::post('/update-ingredient', [IngredientsController::class, 'updateIngredient'])->name('update-ingredient');
    Route::post('/toggle-ingredient-status', [IngredientsController::class, 'toggleIngredientStatus'])->name('toggle-ingredient-status');
    Route::post('/toggle-show-status', [IngredientsController::class, 'toggleShowStatus'])->name('toggle-show-status');
    Route::post('/toggle-show-in-list', [IngredientsController::class, 'toggleShowInList'])->name('toggle-show-in-list');
    Route::post('/update-ordering', [IngredientsController::class, 'updateOrdering'])->name('update-ordering');
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
    Route::post('/process-product-image', [ProductController::class, 'processProductImage'])->name('process-product-image');
});



// Testing Methods
Route::prefix('test')->middleware(['auth:seller', 'PreventBackHistory'])->group(function() {
    Route::get('/test', [LieferandoSpiderController::class, 'indexAction'])->name('indexAction');
    Route::get('/simulate-lotto', [LottoSimController::class, 'simulate'])->name('simulateLotto');
});



// Product Sizes Neu
    Route::prefix('manage-product-sizes')->middleware(['auth:seller', 'PreventBackHistory'])->group(function() {
        Route::view('/shops/{shop}/productsize', 'backend.pages.seller.sizes.product-sizes')->name('product-sizes');
     });


// OrderOverview
Route::prefix('order-overview')->middleware(['auth:seller', 'PreventBackHistory'])->group(function() {
    // Mit optionaler Shop-ID
    Route::get('/orders/{shopId}', [OrderOverviewController::class, 'indexOrderOverview'])->name('indexOrderOverview');
    // Bestellungen für ein bestimmtes Jahr und einen bestimmten Monat abrufen
  //  Route::get('/months/{year}', [OrderOverviewController::class, 'getOrdersForYearAndMonth'])->name('getOrdersForYearAndMonth');
    // Bestellungen für ein bestimmtes Jahr und einen bestimmten Monat abrufen
    Route::get('/get-Orders-By-Month', [OrderOverviewController::class, 'getOrdersByMonth'])->name('getOrdersByMonth');
    Route::get('order-overview/{shopId}', [OrderOverviewController::class, 'indexOrderOverview'])->name('orderOverview');
    Route::get('/ajax-Get-Orders-By-Month', [OrderOverviewController::class, 'ajaxGetOrdersByMonth'])->name('AjaxGetOrdersByMonth');

});

Route::get('/download-pdf/{shopId}/{orderId}', function ($shopId, $orderId) {
    $filePath = 'uploads/shops/' . $shopId . '/orders/' . $orderId . '_bestellbestaetigung.pdf';
    return Storage::download($filePath);
})->name('download.pdf');


// Review Overview
Route::prefix('manage-rewiews')->middleware(['auth:seller', 'PreventBackHistory'])->group(function() {
  //  Route::view('/reviews/{shopId}/overwiews', 'backend.pages.seller.reviewOverview.reviewsIndex')->name('reviews-overview');
    Route::get('/reviews/{shopId}/overwiews', [ReviewController::class, 'sellerReviewsIndex'])->name('reviews-overview');
 });


        // Openinghours Routes
        Route::prefix('openinghours')->middleware(['auth:seller', 'PreventBackHistory'])->group(function() {
           // Route::view('/worktimes', 'backend.pages.seller.worktimes.opening-hours')->name('worktimes');
            Route::get('/worktimes/{shopId}/list', [WorktimesController::class, 'index'])->name('worktimes-list');
        });

// Templates Routes
Route::prefix('templates')->middleware(['auth:seller', 'PreventBackHistory'])->group(function() {
    Route::get('/webtemplates/{shopId}', function ($shopId) {
        return view('backend.pages.seller.WebTemplates.web-template-select', ['shopId' => $shopId]);
    })->name('webtemplates.list');

    Route::get('/shop/{shopId}/template/{templateId}/preview', TemplatePreviewComponent::class)
    ->name('template.preview');

});



});



