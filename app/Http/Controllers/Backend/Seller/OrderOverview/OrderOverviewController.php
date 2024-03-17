<?php

namespace App\Http\Controllers\Backend\Seller\OrderOverview;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderOverviewController extends Controller
{
    //

    public function indexOrderOverview()
    {


        $data = [
            'pageTitle' => 'Order Overwiev Management',
         ];
            return view('backend.pages.seller.OrderOverview.order-overview', $data);
        }
}
