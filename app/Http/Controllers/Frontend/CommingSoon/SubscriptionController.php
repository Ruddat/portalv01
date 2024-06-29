<?php

namespace App\Http\Controllers\Frontend\CommingSoon;

use Illuminate\Http\Request;
use App\Models\ModSysNewsletter;
use App\Http\Controllers\Controller;


class SubscriptionController extends Controller
{
    public function subscribeComingSoon(Request $request)
    {
dd($request->all());


        $validatedData = $request->validate([
            'email' => 'required|email|unique:newsletters',
       //     'name' => 'nullable|string|max:255'
        ]);

        Newsletter::create($validatedData);

        return redirect()->back()->with('success', 'Subscription successful! We will notify you when we are back online.');
    }
}
