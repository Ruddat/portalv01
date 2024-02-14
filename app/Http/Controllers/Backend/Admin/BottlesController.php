<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\ModBottles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BottlesController extends Controller
{
    //
    Public function BottlesList(Request $request)
    {

        // Hole alle Flaschen aus der Datenbank
        $bottles = ModBottles::all();

        $data = [
            'pageTitle' => 'Bottles deposit',
            'bottles' => $bottles
        ];

        return view('backend.pages.admin.bottles-list', $data);
    }
}
