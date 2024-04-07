<?php

namespace App\Http\Controllers\Backend\Seller\Worktimes;

use Illuminate\Http\Request;
use App\Models\ModSellerWorktimes;
use App\Http\Controllers\Controller;

class WorktimesController extends Controller
{
    public function index(Request $request, $shopId)
    {

            $worktimes = ModSellerWorktimes::where('shop_id', $shopId)
                                    ->orderBy('created_at', 'desc')
                                    ->get();

                // Daten an die Ansicht übergeben
                $data = [
                    'pageTitle' => 'Liste aller Bewertungen',
              //      'reviews' => $reviews,
              //      'shopId' => $shopId, // Falls Sie die Shop-ID im Blade benötigen
               //     'shopName' => $shopData ? $shopData->shop_name : null,
                    // Weitere Daten hier hinzufügen, falls erforderlich
                ];

        return view('backend.pages.seller.worktimes.worktimes' , $data);
    }
}
