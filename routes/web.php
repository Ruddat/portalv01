<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Frontend\ShopSearchResults;
use App\Http\Controllers\GoogleTranslateController;
use App\Http\Controllers\Frontend\ShopCardController;
use App\Http\Controllers\Frontend\ShopSearchController;


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

//Route::get('/', function () {
//    return view('welcome');
//});

//Route::get('/', function () {
//    return view('frontend/pages/index.index');
//});

Route::get('/index-2', function () {
    return view('frontend/pages/index.index-2');
});

Route::get('/index-3', function () {
    return view('frontend/pages/index.index-3');
});

Route::get('/index-4', function () {
    return view('frontend/pages/index.index-4');
});


Route::get('/index-5', function () {
    return view('frontend/pages/index.index-5');
});


Route::get('/index-6', function () {
    return view('frontend/pages/index.index-6');
});


Route::get('/index-7', function () {
    return view('frontend/pages/index.index-7');
});

Route::get('/index-8', function () {
    return view('frontend/pages/index.index-8');
});

Route::get('/index-9', function () {
    return view('frontend/pages/index.index-9');
});

Route::get('/index-10', function () {
    return view('frontend/pages/index.index-10');
});

Route::get('/index-11', function () {
    return view('frontend/pages/index.index-11');
});

Route::get('/index-12', function () {
    return view('frontend/pages/index.index-12');
});

Route::get('/index-13', function () {
    return view('frontend/pages/index.index-13');
});

Route::get('/detail-restaurant', function () {
    return view('frontend/pages/detailrestaurant.detail-restaurant');
});

Route::get('/detail-restaurant-2', function () {
    return view('frontend/pages/detailrestaurant.detail-restaurant-2');
});

Route::get('/detail-restaurant-3', function () {
    return view('frontend/pages/detailrestaurant.detail-restaurant-3');
});

Route::get('/detail-restaurant-4', function () {
    return view('frontend/pages/detailrestaurant.detail-restaurant-4');
});

Route::get('/blog', function () {
    return view('frontend/pages/blog.blog');
});

Route::get('/blog-post', function () {
    return view('frontend/pages/blog.blog-post');
});


Route::get('/grid-listing-filterscol', function () {
    return view('frontend/pages/listingrestaurant.grid-listing-filterscol');
});

Route::get('/grid-listing-filterscol-map', function () {
    return view('frontend/pages/listingrestaurant.grid-listing-filterscol-map');
});


Route::get('/grid-listing-masonry', function () {
    return view('frontend/pages/listingrestaurant.grid-listing-masonry');
});

Route::get('/listing-map', function () {
    return view('frontend/pages/listingrestaurant.listing-map');
});

Route::get('/grid-listing-filterscol-openstreetmap', function () {
    return view('frontend/pages/listingrestaurantopenstreet.grid-listing-filterscol-openstreetmap');
});

Route::get('/listing-map-openstreetmap', function () {
    return view('frontend/pages/listingrestaurantopenstreet.listing-map-openstreetmap');
});

Route::get('/grid-listing-masonry-openstreetmap', function () {
    return view('frontend/pages/listingrestaurantopenstreet.grid-listing-masonry-openstreetmap');
});

Route::get('/leave-review', function () {
    return view('frontend/pages/otherpages/leave-review');
});

Route::get('/submit-restaurant', function () {
    return view('frontend/pages/otherpages/submit-restaurant');
});

Route::get('/register', function () {
    return view('frontend/pages/otherpages/register');
});

Route::get('/login', function () {
    return view('frontend/pages/otherpages/login');
});

Route::get('/contacts', function () {
    return view('frontend/pages/otherpages/contacts');
});

Route::get('/order-details', function () {
    return view('frontend/pages/cardorder/order-details');
});

Route::get('/confirm-order', function () {
    return view('frontend/pages/cardorder/confirm-order');
});




Route::get('/index-black', function () {
    return view('backend/pages/index/index-black');
});


Route::get('/index-normal', function () {
    return view('backend/pages/index/index-normal');
});


//// Ab hier aktiv

/// -- sprache wechseln --> google translate
Route::get('lang/change', [GoogleTranslateController::class, 'change'])->name('change.lang');


Route::get('/', [ShopSearchController::class, 'index'])->name('index');

Route::match(['get', 'post'], '/search', [ShopSearchController::class, 'search'])->name('search.index');

Route::post('/speichere-standort', [ShopSearchController::class, 'speichereStandort'])->name('speichere-standort');




Route::get('/detail-restaurant/{restaurantName}', [ShopCardController::class, 'index'])->name('detail-restaurant.index');



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
