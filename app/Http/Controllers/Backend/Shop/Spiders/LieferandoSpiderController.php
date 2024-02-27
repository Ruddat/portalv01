<?php

namespace App\Http\Controllers\Backend\Shop\Spiders;

use RoachPHP\Roach;
use Illuminate\Http\Request;
use App\Spiders\LaravelDocsSpider;
use App\Http\Controllers\Controller;

class LieferandoSpiderController extends Controller
{
    //


    public function indexAction()
    {


      //  Roach::startSpider(LaravelDocsSpider::class);




        $items = Roach::collectSpider(LaravelDocsSpider::class);

//dd($items);

        return view('backend.spiders.lieferando', [
            'items' => $items,
        ]);
    }
}
