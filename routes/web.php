<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('frontend/pages/index.index');
});

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


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
