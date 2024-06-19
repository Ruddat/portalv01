<?php

namespace App\Http\Controllers\Backend\Admin\PromoBanner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PromoBannerController extends Controller
{
    //


    public function index (request $request) {

       // $orderList = ModOrders::all(); // alle Bestellungen abholen

        // Daten an die Ansicht übergeben
        $data = [
            'pageTitle' => 'Promo Banner',
        ];
        // go through liveOrders and livewire them
        return view('backend.pages.admin.promobanner.promobanner-index', $data);

    }


}
