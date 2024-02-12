<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BottlesController extends Controller
{
    //
    Public function BottlesList(Request $request)
    {
        $data = [
            'pageTitle' => 'Bottles deposit',

        ];

        return view('backend.pages.admin.bottles-list', $data);
    }


    public function AdditivesList(Request $request)
    {
        $data = [
            'pageTitle' => 'Zusatzstoffe',

        ];

        return view('backend.pages.admin.additives-list', $data);
    }


    public function AllergensList(Request $request)
    {
        $data = [
            'pageTitle' => 'Zusatzstoffe',

        ];

        return view('backend.pages.admin.additives-list', $data);
    }

}
