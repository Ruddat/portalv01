<?php

namespace App\Http\Controllers\Test;

use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StripeTestController extends Controller
{
    public function createCheckoutSession()
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $checkoutSession = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => 'Test Product',
                        ],
                        'unit_amount' => 5000, // Betrag in Cent (z.B. 50,00 EUR)
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('checkout.success'),
            'cancel_url' => route('checkout.cancel'),
        ]);

        return redirect()->to($checkoutSession->url);
    }

    public function checkoutSuccess()
    {
        return view('checkout-success');
    }

    public function checkoutCancel()
    {
        return view('checkout-cancel');
    }
}
