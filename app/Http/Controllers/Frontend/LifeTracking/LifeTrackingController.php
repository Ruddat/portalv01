<?php

namespace App\Http\Controllers\Frontend\LifeTracking;

use App\Models\ModShop;
use App\Models\ModOrders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class LifeTrackingController extends Controller
{
    public function show($orderHash)
    {
        try {
            $order = ModOrders::where('hash', $orderHash)->first();

            if (!$order) {
                Log::warning("Order not found for hash: $orderHash");
                return response()->json(['error' => 'Order not found'], 404);
            }

            $trackshop = ModShop::where('id', $order->parent)->first();
            if (!$trackshop) {
                Log::warning("Shop not found for order: $orderHash");
            }

            return view('frontend.lifetracking.life-tracking', compact('order', 'trackshop', 'orderHash'));
        } catch (Exception $e) {
            Log::error("Error fetching order information: " . $e->getMessage());
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }
}
