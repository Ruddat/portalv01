<?php

namespace App\Http\Controllers\SystemComponent;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\ModBuyerDeleteToken;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class BuyerAccountController extends Controller
{
    //
    public function confirmDeletion($token)
    {
        $deleteToken = ModBuyerDeleteToken::where('token', $token)
                                  ->where('expires_at', '>', now())
                                  ->first();

        if (!$deleteToken) {
            return redirect('/')->with('error', 'The token is invalid or has expired.');
        }

        $client = Client::find($deleteToken->client_id);
        $client->delete();

        // Optionally, delete the token
        $deleteToken->delete();

        return redirect('/')->with('message', 'Your account has been deleted.');
    }
}
