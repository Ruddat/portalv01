<?php

namespace App\Http\Controllers\Backend\GlobalController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BidController extends Controller
{
    //

    public function increaseBid($shop_id, $current_price)
    {
        // Ermitteln Sie den aktuellen Höchstpreis
        $maxPrice = DB::table('mod_top_rank_prices')
            ->where('shop_id', '!=', $shop_id)
            ->max('current_price');

        // Erhöhen Sie den Preis des Shops so, dass er höher ist als der aktuelle Höchstpreis
        $newPrice = $maxPrice + 0.10;

        // Aktualisieren Sie den Preis und den Rang des Shops
        DB::table('mod_top_rank_prices')
            ->where('shop_id', $shop_id)
            ->update(['current_price' => $newPrice, 'rank' => 1]);

        // Optional: Aktualisieren Sie die Ränge der anderen Shops
        DB::table('mod_top_rank_prices')
            ->where('shop_id', '!=', $shop_id)
            ->where('current_price', '<', $newPrice)
            ->increment('rank');

        return redirect()->route('home')->with('success', 'Your bid has been increased and your shop is now ranked first!');
    }


}
