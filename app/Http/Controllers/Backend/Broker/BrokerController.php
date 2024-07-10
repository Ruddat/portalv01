<?php

namespace App\Http\Controllers\Backend\Broker;


use constGuards;
use constDefaults;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrokerController extends Controller
{
    //

    public function registerHandler(Request $request)
    {


dd($request->all());


        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        return response()->json([
            'message' => 'Broker Registered Successfully'
        ]);
    }
}
