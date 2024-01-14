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
