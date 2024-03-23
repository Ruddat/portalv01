<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
       // return $request->expectsJson() ? null : route('login');


        if (! $request->expectsJson()) {
            if($request->routeIs('admin.*')){
                session()->flash('fail', 'You must be logged in to access this page.');
                return route('admin.login');


            }elseif($request->is('seller/*')){
                return route('seller.login');
            }elseif($request->is('client/*')){
                return route('client.login');
            }
        }

    }
}
