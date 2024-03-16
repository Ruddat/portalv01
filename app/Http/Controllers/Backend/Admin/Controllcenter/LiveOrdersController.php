<?php

namespace App\Http\Controllers\Backend\Admin\Controllcenter;

use App\Models\ModOrders;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LiveOrdersController extends Controller
{
    //



    public function index (request $request) {



        $orderList = ModOrders::all(); // alle Bestellungen abholen

        // Daten an die Ansicht übergeben
        $data = [
            'pageTitle' => 'Liveansicht der Bestellungen',
        ];

        return view('backend.pages.admin.controllcenter.liveorder-index', $data);

    }

}
