<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShopCardController extends Controller
{
    //

    public function index($restaurantName)
{
    // ... (andere Logik)

    return view('frontend.pages.detailrestaurant.detail-restaurant', compact('restaurantName'));

}
}
