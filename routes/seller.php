<?php

use Illuminate\Support\Facades\Route;


Route::get('/client', function () {
    return view('welcome');
});
