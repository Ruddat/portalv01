<?php

namespace App\Http\Controllers\Backend\Seller\Review;

use App\Models\ModOrders;
use Illuminate\Http\Request;
use App\Models\ModSellerVotings;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    public function sellerReviewsIndex(Request $request, $shopId) // TODO - ReviewController anpassen
    {


    // Alle Bewertungen für den bestimmten Shop abrufen und nach dem Erstellungsdatum absteigend sortieren
    $reviews = ModSellerVotings::where('shop_id', $shopId)
                            ->orderBy('created_at', 'desc')
                            ->get();

   // dd($reviews);

        // Daten an die Ansicht übergeben
        $data = [
            'pageTitle' => 'Liste aller Bewertungen',
            'reviews' => $reviews,
            'shopId' => $shopId, // Falls Sie die Shop-ID im Blade benötigen
       //     'shopName' => $shopData ? $shopData->shop_name : null,
            // Weitere Daten hier hinzufügen, falls erforderlich
        ];

        return view('backend.pages.seller.reviewOverview.reviewsIndex', $data);
    }
}
