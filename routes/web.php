<?php

use App\Models\ModAdminBlogTag;
use App\Models\ModAdminBlogPost;
use App\Models\ModAdminBlogCategory;
use Illuminate\Support\Facades\Route;
use App\Livewire\Frontend\ShopSearchResults;
use App\Http\Livewire\Frontend\Card\ProductList;
use App\Http\Controllers\Test\TemplateController;
use App\Http\Controllers\GoogleTranslateController;
use App\Http\Controllers\Frontend\ShopCardController;
use App\Http\Controllers\Frontend\Card\CardController;
use App\Http\Controllers\MobileApp\ManifestController;
use App\Http\Controllers\Frontend\ShopSearchController;
use App\Http\Controllers\Frontend\Cart\NewCartController;
use App\Http\Controllers\SystemComponent\RobotsController;
use App\Http\Controllers\Frontend\Geoip\LocationController;
use App\Http\Controllers\Frontend\Search\GeocodeController;
use App\Http\Controllers\Backend\GlobalController\BidController;
use App\Http\Controllers\SystemComponent\BuyerAccountController;
use App\Http\Controllers\Frontend\MediaData\MediaStatsController;
use App\Http\Controllers\Soap\WinorderSoap\WinOrderSOAPController;
use App\Http\Controllers\Backend\Admin\Invoice\CsvExportController;
use App\Http\Controllers\Backend\Admin\Invoice\InvoicePdfController;
use App\Http\Controllers\Frontend\CommingSoon\SubscriptionController;
use App\Http\Controllers\Frontend\LifeTracking\LifeTrackingController;
use App\Http\Controllers\Backend\Admin\Invoice\InvoiceExportController;
use App\Http\Controllers\SystemComponent\CommentVerificationController;
use App\Http\Controllers\Backend\Seller\Categories\CategoriesController;
use App\Http\Controllers\Backend\Seller\WebTemplates\WebTemplatePreviewController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/print', [App\Http\Controllers\TestComponent\PrintController::class, 'printReceipt']);

Route::get('/template/{templateName}', [TemplateController::class, 'show'])
    ->name('template.show');

    // Login Logout Routes
    Route::view('/login', 'frontend.pages.buyer.auth.login')->name('login');
    Route::view('/forgot_password', 'frontend.pages.buyer.auth.forgot-password')->name('forgot-password');
    Route::view('/register', 'frontend.pages.buyer.auth.register')->name('register');



    // Shopping card  routes
    Route::prefix('card')->group(function() {
        Route::post('/add', [CardController::class, 'addCard'])->name('cart-add');
      //  Route::get('/products/{restaurantId}', [ProductList::class, '__invoke'])->name('products');
        Route::get('/order/{restaurantId}', [App\Http\Controllers\Frontend\Cart\OrderController::class, 'index'])->name('order');
    });

    // Bid Routes
    Route::get('/increase-bid/{shop_id}/{current_price}', [BidController::class, 'increaseBid'])->name('increaseBid');

    // Account Delete route
    Route::get('/delete-account/{token}', [BuyerAccountController::class, 'confirmDeletion'])->name('account.confirmDeletion');

    Route::get('/life-tracking/{orderHash}', [LifeTrackingController::class, 'show'])->name('life-tracking');
    //Route::view('/life-tracking/{orderHash}', 'frontend.lifetracking.life-tracking')->name('life-tracking');

    Route::view('/restaurantvoting/{orderHash}', 'frontend.votingsrestaurant.restaurant-voting')->name('votings-restaurant');

    // WinOrder SOAP routes
    Route::post('/winorder/get-new-orders', [WinOrderSOAPController::class, 'getNewOrders']);
    Route::post('/winorder/send-tracking-status', [WinOrderSOAPController::class, 'sendTrackingStatus']);
    Route::post('/winorder/call-soap-service', [WinOrderSOAPController::class, 'callSoapService'])->name('call.soap.service');

    // Frontend routes CartController methods
 //   Route::get('/detail-restaurant-2/{restaurantId}', [NewCartController::class, 'index'])->name('detail-restaurant-2.index');
   // Route::get('/restaurant/{slug}', [NewCartController::class, 'index'])->name('restaurant.index');
    //Route::get('/detail-restaurant-2/{shop_slug}', [NewCartController::class, 'index'])->name('detail-restaurant-2.index');

    Route::post('/vote', [NewCartController::class, 'vote'])->name('vote-restaurant.vote');
    Route::post('/reply', [NewCartController::class, 'reply'])->name('vote-restaurant.reply');



    Route::view('/help/', 'frontend.pages.otherpages.help')->name('help');


    // Blog routes start



    Route::group(['prefix' => '{locale}', 'where' => ['locale' => '[a-zA-Z]{2}'], 'middleware' => 'prevent-back-history'], function () {
        Route::view('/bugzilla/', 'frontend.pages.otherpages.bugzilla')->name('bugzilla');
        Route::view('/blog', 'frontend.pages.blog.blog')->name('blog');
        Route::get('/restaurant/{slug}', [NewCartController::class, 'index'])->name('restaurant.index');
        // Seller routes
        Route::view('/seller/register', 'backend.pages.seller.auth.register')->name('seller.register');
    });



    Route::get('seller/web-templates/preview/{shopId}/{templateId}', [WebTemplatePreviewController::class, 'preview'])
    ->name('seller.web-templates.preview');



    Route::get('/blog-post/{identifier}', function ($identifier) {
        $post = ModAdminBlogPost::with(['comments' => function ($query) {
            $query->whereNull('parent_id')
                  ->where('approved', true)
                  ->with(['replies' => function ($query) {
                      $query->where('approved', true);
                  }]);
        }])
        ->where('slug', $identifier)
        ->orWhere('id', $identifier)
        ->firstOrFail();

        $latestPosts = ModAdminBlogPost::latest()->take(3)->get();
        $categories = ModAdminBlogCategory::withCount(['posts' => function ($query) {
            $query->where('start_date', '<=', now());
        }])->get();
        $allTags = ModAdminBlogTag::all();

        $breadcrumbs = [
            ['label' => 'Home', 'url' => url('/')],
            ['label' => 'Blog', 'url' => url('/blog')],
            ['label' => $post->category->name ?? 'No Category', 'url' => url('/category', $post->category->id ?? '')],
            ['label' => $post->title]
        ];

        return view('frontend.pages.blog.blog-post', compact('post', 'latestPosts', 'categories', 'allTags', 'breadcrumbs'));
    })->name('blog-post');

    Route::get('/category/{categoryId}', function ($categoryId) {
        $category = ModAdminBlogCategory::findOrFail($categoryId);
        $posts = ModAdminBlogPost::where('category_id', $categoryId)->latest()->paginate(6);
        $latestPosts = ModAdminBlogPost::latest()->take(3)->get();
        $categories = ModAdminBlogCategory::withCount(['posts' => function ($query) {
            $query->where('start_date', '<=', now());
        }])->get();
        $allTags = ModAdminBlogTag::all();

        return view('frontend.pages.blog.blog', compact('posts', 'latestPosts', 'categories', 'allTags', 'category'));
    });

    Route::get('/tag/{tagId}', function ($tagId) {
        $tag = ModAdminBlogTag::findOrFail($tagId);
        $posts = ModAdminBlogPost::whereHas('tags', function ($query) use ($tagId) {
            $query->where('tag_id', $tagId);
        })->latest()->paginate(6);
        $latestPosts = ModAdminBlogPost::latest()->take(3)->get();
        $categories = ModAdminBlogCategory::withCount(['posts' => function ($query) {
            $query->where('start_date', '<=', now());
        }])->get();
        $allTags = ModAdminBlogTag::all();

        return view('frontend.pages.blog.blog', compact('posts', 'latestPosts', 'categories', 'allTags', 'tag'));
    });
    //Route::get('/verify-comment/{token}/{email}', [CommentVerificationController::class, 'verify'])->name('comment-verify-email');
    Route::get('/verify-comment/{token}', [CommentVerificationController::class, 'verify'])->name('comment-verify-email');

    // Blog routes end





//Route::get('/', function () {
//    return view('welcome');
//});

//Route::get('/', function () {
//    return view('frontend/pages/index.index');
//});

Route::get('invoices/{shopId}/{fileName}', [InvoicePdfController::class, 'show'])->name('invoices.show');

Route::get('/get-location', [LocationController::class, 'getLocation']);
Route::get('/media-stats', [MediaStatsController::class, 'index'])->name('media.stats.index');
Route::get('/impressum', function () {
    return view('frontend/pages/otherpages.impressum');
});

// Robots.txt file
Route::get('/robots.txt', [RobotsController::class, 'index']);
Route::get('/csv/download/{id}', [CsvExportController::class, 'download'])->name('csv.download');




// Mobile Application
//Route::get('/manifest.json/{shopSlug}', [ManifestController::class, 'index']);










Route::get('/index-black', function () {
    return view('backend/pages/index/index-black');
});


Route::get('/index-normal', function () {
    return view('backend/pages/index/index-normal');
});


//// Ab hier aktiv

// Subscribe Comming-Soon
Route::post('/subscribe-comming-soon', [SubscriptionController::class, 'subscribeComingSoon'])
    ->name('subscribe.commingsoon')
    ->middleware(\App\Http\Middleware\PreventRequestsDuringMaintenance::class);



Route::get('/geocode', [GeocodeController::class, 'getCoordinates']);


/// -- sprache wechseln --> google translate
Route::get('lang/change', [GoogleTranslateController::class, 'change'])->name('change.lang');


Route::get('/', [ShopSearchController::class, 'index'])->name('index');

//Route::match(['get', 'post'], '/search', [ShopSearchController::class, 'search'])->name('search.index');

Route::get('/search', [ShopSearchController::class, 'search'])
    ->middleware('prevent-back-history')
    ->name('search.index');


Route::post('/speichere-standort', [ShopSearchController::class, 'speichereStandort'])
    ->name('speichere-standort')
    ->middleware(LogRequests::class);
Route::get('/best-ratet-restaurants', [ShopSearchController::class, 'viewAll'])->name('best-ratet-restaurants.viewAll');



Route::get('/detail-restaurant/{restaurantId}', [ShopCardController::class, 'index'])->name('detail-restaurant.index');
Route::post('/vote', [ShopCardController::class, 'vote'])->name('vote-restaurant.vote');
Route::post('/reply', [ShopCardController::class, 'reply'])->name('vote-restaurant.reply');


// Match my own domain
Route::group(['domain' => config('app.domain_url')], function() {
    Route::any('/', function()
      {
          return 'My own domain';
      });
  });

  // Match a subdomain of my domain
  Route::group(['domain' => '{subdomain}.'.config('app.domain_url')], function() {
    Route::any('/', function()
      {
          return 'My own sub domain';
      });
  });

  // Match any other domains
  Route::group(['domain' => '{domain}'], function() {
    Route::any('/', function()
      {
          return 'other domain';
      });
  });



/// -- Backend

Route::get('/mod-shops', function () {
    return view('backend/pages/shops/mod-shops');
});

/// -- Backend -> Liefergebite

Route::get('/mod-liefergebiet', function () {
    return view('backend/pages/shops/mod-liefergebiet');
});

/// -- Backend -> Öffnugszeiten

Route::get('/mod-workingtimes', function () {
    return view('backend/pages/shops/mod-workingtimes');
});


/// -- Backend -> Öffnugszeiten

Route::get('/roles-permissons', function () {
    return view('backend/pages/roles/roles-and-permissons');
});


Route::get('/all-your-videos', ShopSearchResults::class)->name('shops.results');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::fallback(function () {
    return redirect()->route('home');
});

