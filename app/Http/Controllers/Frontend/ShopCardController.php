<?php

namespace App\Http\Controllers\Frontend;

use App\Models\ModShop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopCardController extends Controller
{
    //



    public function index($restaurantId)
    {
        // Restaurant anhand des Namens oder der ID finden
        $restaurant = $restaurantId ? ModShop::findOrFail($restaurantId) : ModShop::where('title', $restaurantName)->first();



        // Überprüfen, ob das Restaurant gefunden wurde
        if ($restaurant) {
            // Restaurant gefunden, geben Sie die Detailansicht zurück
            return view('frontend.pages.detailrestaurant.detail-restaurant', ['restaurant' => $restaurant]);
        } else {
            // Restaurant nicht gefunden, geben Sie eine Fehlermeldung zurück oder leiten Sie weiter
            return redirect()->route('home')->with('error', 'Restaurant nicht gefunden.');
        }
    }







}
