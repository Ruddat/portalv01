<?php

namespace App\Http\Controllers\Frontend\Cart;

use App\Models\ModShop;
use App\Models\ModOrders;
use App\Models\ModCategory;
use App\Models\ModProducts;
use App\Models\DeliveryArea;
use Illuminate\Http\Request;
use App\Models\ModSellerReplays;
use App\Models\ModSellerVotings;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ModProductSizesPrices;
use Illuminate\Support\Facades\Session;
use App\Models\MarketingCampaignParticipants;

class NewCartController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $restaurantId
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $locale, $restaurantIdOrSlug = null)
    {
//dd($request->all());

        if ($request->query('source') == 'sponsored') {
            session(['came_from_sponsored' => true]);
        }


    // Überprüfung des 'voucher_code' Parameters
    if ($request->has('voucher_code')) {
        $voucherCode = $request->query('voucher_code');
        session(['came_from_marketing_email' => true]);

        // Hole den Eintrag in der Tabelle 'marketing_campaign_participants'
        $participant = MarketingCampaignParticipants::where('voucher_code', $voucherCode)->first();

        if ($participant) {
            // Hole die shop_id aus dem Eintrag
            $shopId = $participant->shop_id;

            // Finde die passenden Koordinaten aus der Tabelle 'ModShop'
            $shop = ModShop::find($shopId);

            if ($shop && $shop->lat && $shop->lng) {
                // Setze die Koordinaten in der Session
                session([
                    'userLatitude' => $shop->lat,
                    'userLongitude' => $shop->lng
                ]);

                // Optional: Gib eine Erfolgsnachricht aus
                // return response()->json(['message' => 'Koordinaten erfolgreich gesetzt']);
            } else {
                // Optional: Fehlerbehandlung, wenn keine gültigen Koordinaten gefunden wurden
                // return response()->json(['error' => 'Keine gültigen Koordinaten gefunden'], 404);
            }
        } else {
            // Optional: Fehlerbehandlung, wenn kein Teilnehmer gefunden wurde
            // return response()->json(['error' => 'Kein Teilnehmer für diesen Gutscheincode gefunden'], 404);
        }
    }


        $restaurant = ModShop::with('categories')->where('shop_slug', $restaurantIdOrSlug)->first();

//dd($restaurant);


        if (!$restaurant) {
            $restaurant = ModShop::with('categories')->find($restaurantIdOrSlug);
        }

        if ($restaurant) {
            $restaurantId = $restaurant->id;
        } else {
            abort(404); // Seite nicht gefunden
        }




        if (!session()->has('userLatitude') || !session()->has('userLongitude')) {

            return redirect()->route('home')->with('error', 'Die Standortdaten sind nicht verfügbar. Bitte erlauben Sie den Zugriff auf Ihren Standort.');
        }

        $restaurant = ModShop::with('categories')->findOrFail($restaurantId);

        if ($restaurant) {
            $productsByCategory = [];

            $categories = ModCategory::where('shop_id', $restaurant->id)
                ->where('show_in_list', true)
                ->where('published', true)
                ->orderBy('ordering')
                ->get();

            $sizesWithPrices = DB::table('mod_product_sizes')
                ->join('mod_product_sizes_prices', 'mod_product_sizes.id', '=', 'mod_product_sizes_prices.size_id')
                ->select('mod_product_sizes.title as size', 'mod_product_sizes_prices.price', 'mod_product_sizes_prices.size_id', 'mod_product_sizes_prices.parent')
                ->where('mod_product_sizes.shop_id', $restaurant->id)
                ->get();

            foreach ($categories as $category) {
                $products = ModProducts::where('shop_id', $restaurant->id)
                    ->where('category_id', $category->id)
                    ->where('product_published', true)
                    ->orderBy('product_ordering', 'ASC')
                    ->get();

                foreach ($products as $product) {
                    $product->minPrice = $this->getProductPrice($product->id);
                }

                $productsByCategory[$category->category_name] = $products;
            }

            $userLatitude = session('userLatitude');
            $userLongitude = session('userLongitude');

            $shopLocation = ModShop::where('id', $restaurant->id)->first();
            $distance = $this->calculateDistance($userLatitude, $userLongitude, $shopLocation->lat, $shopLocation->lng);
            $distance = round($distance, 2);

            $deliveryAreas = DeliveryArea::where('shop_id', $restaurant->id)
                ->orderBy('distance_km', 'asc')
                ->get();
//dd($deliveryAreas);

            $foundInDeliveryArea = false;
            foreach ($deliveryAreas as $area) {
                if ($distance <= $area->distance_km) {
                    $oldShopId = Session::get('shopId');
                    if ($oldShopId !== null) {
                        Session::forget('delivery_cost_' . $oldShopId);
                        Session::forget('delivery_charge_' . $oldShopId);
                        Session::forget('free_delivery_threshold_' . $oldShopId);
                    }



                    session(['delivery_cost_' . $restaurantId => $area->delivery_cost]);
                    session(['delivery_charge_' . $restaurantId => $area->delivery_charge]);
                    session(['free_delivery_threshold_' . $restaurantId => $area->free_delivery_threshold]);
                    session(['shopId' => $restaurantId]);
//dd($area->delivery_cost, $area->delivery_charge, $area->free_delivery_threshold, $restaurantId);

                    $foundInDeliveryArea = true;
                    $modalScript = false;
                    break;
                }
            }

            if (!$foundInDeliveryArea) {
                $oldShopId = Session::get('shopId');
                if ($oldShopId !== null) {
                    Session::forget('delivery_cost_' . $oldShopId);
                    Session::forget('delivery_charge_' . $oldShopId);
                    Session::forget('free_delivery_threshold_' . $oldShopId);
                }
                $modalScript = false;
            }

            $metaDescription = $restaurant->description ?? "Willkommen bei " . $restaurant->title . ", genießen Sie unser tolles Angebot an Speisen und Getränken.";
            $metaKeywords = implode(', ', $categories->pluck('category_name')->toArray());
            $ogTitle = $restaurant->title;
            $ogDescription = $metaDescription;
            $ogImage = $restaurant->logo_url ?? asset('default-image.jpg');

            $this->setShowButton($oldShopId, true);


            return view('frontend.pages.detailrestaurant.detail-restaurant-2', [
                'restaurant' => $restaurant,
                'categories' => $categories,
                'productsByCategory' => $productsByCategory,
                'modalScript' => $modalScript,
                'sizesWithPrices' => $sizesWithPrices,
                'metaDescription' => $metaDescription,
                'metaKeywords' => $metaKeywords,
                'ogTitle' => $ogTitle,
                'ogDescription' => $ogDescription,
                'ogImage' => $ogImage,
                'title' => $restaurant->title,
            ]);
        } else {
            return redirect()->route('home')->with('error', 'Restaurant nicht gefunden.');
        }
    }


    public function setShowButton($shopId, $value)
    {
        // Hier wird der Wert für das Anzeigen des Buttons in der Session gespeichert
        Session::put("show_button_{$shopId}", $value);
    }



    public function handleVoucherCode(Request $request)
    {
        // Prüfen, ob der Gutschein-Code 'sponsored' ist
        if ($request->query('voucher_code') == 'sponsored') {
            // Setze die Marketing-Session Variable
            session(['came_from_marketing_email' => true]);

            // Hole den Eintrag in der Tabelle 'marketing_campaign_participants'
            $voucherCode = $request->query('voucher_code');
            $participant = MarketingCampaignParticipants::where('voucher_code', $voucherCode)->first();

            if ($participant) {
                // Hole die Order-ID aus dem Eintrag
                $orderId = $participant->order_id;

                // Finde die passenden Koordinaten aus der Tabelle 'ModOrders'
                $order = ModOrders::find($orderId);

                if ($order && $order->shipping_lat && $order->shipping_lng) {
                    // Setze die Koordinaten in der Session
                    session([
                        'userLatitude' => $order->shipping_lat,
                        'userLongitude' => $order->shipping_lng
                    ]);

                    // Optional: Gib eine Erfolgsnachricht aus
                    return response()->json([
                        'message' => 'Koordinaten erfolgreich gesetzt',
                        'latitude' => $order->shipping_lat,
                        'longitude' => $order->shipping_lng
                    ]);
                } else {
                    return response()->json(['error' => 'Keine gültigen Koordinaten gefunden'], 404);
                }
            } else {
                return response()->json(['error' => 'Kein Teilnehmer für diesen Gutscheincode gefunden'], 404);
            }
        }

        return response()->json(['message' => 'Kein gültiger Gutscheincode'], 400);
    }



/**
 * Methode zur Bestimmung des richtigen Preises für ein Produkt.
 *
 * @param int $productId Die ID des Produkts.
 * @return float Der Preis des Produkts.
 */
public function getProductPrice($productId)
{
    // Basispreis des Produkts abrufen
    $basePrice = ModProducts::find($productId)->base_price;

    // Wenn ein Basispreis vorhanden ist und größer als 0 ist, diesen zurückgeben
    if ($basePrice > 0) {
        return $basePrice;
    }

    // Ansonsten den günstigsten Preis der Produktgrößen zurückgeben
    $productSizesPrices = ModProductSizesPrices::where('parent', $productId)->pluck('price')->toArray();

    // Wenn Produktgrößen-Preise vorhanden sind, den günstigsten Preis zurückgeben
    if (!empty($productSizesPrices)) {
        return min($productSizesPrices);
    }

    // Falls keine Preise gefunden werden, Standardwert oder Null zurückgeben
    return 0;
}



    // Method to calculate the overall rating for a shop
    public function calculateOverallRating($restaurantId)
    {
        // Retrieve all the ratings for the shop
        $ratings = ModSellerVotings::where('shop_id', $restaurantId)->get();

    // Count the number of ratings
    $numberOfRatings = $ratings->count();

    // If there are no ratings, return null
    if ($numberOfRatings === 0) {
        return ['overallRating' => null, 'numberOfRatings' => null];
    }



        // Calculate the average rating for each aspect (e.g., food quality, service, etc.)
        $foodQualityTotal = $ratings->avg('food_quality');
        $serviceTotal = $ratings->avg('service');
        $priceTotal = $ratings->avg('price');
        $deliveryTimeTotal = $ratings->avg('punctuality');
        // Calculate the overall average rating
    //    $overallRatingSingle = ($foodQualityTotal + $serviceTotal + $priceTotal + $deliveryTimeTotal) / 4;
        // Gesamtbewertung berechnen
        $overallRating = $ratings->avg(function ($rating) {
            return ($rating->food_quality + $rating->service + $rating->punctuality + $rating->price) / 4;
        });

    // Create an object to hold the overall ratings for each category
    $overallRatingProgress = (object) [
        'foodQualityTotal' => $foodQualityTotal,
        'serviceTotal' => $serviceTotal,
        'priceTotal' => $priceTotal,
        'deliveryTimeTotal' => $deliveryTimeTotal,
    ];

//dd($overallRatingSingle);
        // Return the overall rating
        return ['overallRating' => $overallRating, 'numberOfRatings' => $numberOfRatings, 'overallRatingProgress' => $overallRatingProgress, 'ratings' => $ratings]; ;
    }


    public function vote(Request $request)
    {
        // Validieren der eingehenden Daten
        $request->validate([
            'restaurant_id' => 'required|exists:mod_shops,id',
            'type' => 'required|in:like,dislike',
            'order_id' => 'required', // Stellen Sie sicher, dass order_id vorhanden ist
        ]);

        // Überprüfen, ob der Gast bereits für dieselbe Bestellung abgestimmt hat
        $existingVote = ModSellerVotes::where('shop_id', $request->restaurant_id)
            ->where('order_hash', $request->session()->getId())
            ->where('voting_id', $request->order_id)
            ->first();

        // Restaurant-ID und Voting-Typ aus der Anfrage extrahieren
        $restaurantId = $request->restaurant_id;
        $type = $request->type;

        // Wenn bereits eine Abstimmung existiert
        if ($existingVote) {
            // Überprüfen, ob der Typ geändert wurde
            if ($existingVote->type === $type) {
                return response()->json(['success' => false, 'message' => 'You have already voted with the same vote type for this order.']);
            } else {
                // Typ aktualisieren
                $existingVote->type = $type;
                $existingVote->save();
            }
        } else {
            // Neuen Eintrag erstellen
            $voting = new ModSellerVotes();
            $voting->shop_id = $restaurantId;
            $voting->type = $type;
            $voting->order_hash = $request->session()->getId();
            $voting->voting_id = $request->order_id; // Falls erforderlich, passen Sie die Voting-ID entsprechend an
            $voting->save();
        }

    // Anzahl der Likes und Dislikes für diese Bestellung zählen und speichern
    $likesCount = ModSellerVotes::where('shop_id', $restaurantId)
        ->where('voting_id', $request->order_id)
        ->where('type', 'like')
        ->count();

    $dislikesCount = ModSellerVotes::where('shop_id', $restaurantId)
        ->where('voting_id', $request->order_id)
        ->where('type', 'dislike')
        ->count();

    // Den aktuellen Shop-Eintrag aktualisieren
    $currentShopVotes = ModSellerVotes::where('shop_id', $restaurantId)
        ->where('voting_id', $request->order_id)
        ->first();

    $currentShopVotes->likes_count = $likesCount;
    $currentShopVotes->dislikes_count = $dislikesCount;
    $currentShopVotes->save();

        // Erfolgsantwort zurückgeben
        return response()->json(['success' => true, 'message' => 'Vote saved successfully.']);
    }


    // Reply with the vote id for a specific order
    public function reply(request $request) // TODO - Clientabfrage machen ob client angemeldet ist sonst zum Login. Client Name dann eintragen
    {

    //    dd($request->all());

        // Validate the incoming data
        $request->validate([
            'rating_id' => 'required|exists:mod_seller_votings,id',
            'reply_title' => 'required|string',
            'reply_content' => 'required|string',
        ],[
            'rating_id.required' => 'The rating ID is required.',
            'rating_id.exists' => 'The rating ID does not exist.',
            'reply_title.required' => 'The reply title is required.',
            'reply_title.string' => 'The reply title must be a string.',
            'reply_content.required' => 'The reply content is required.',
            'reply_content.string' => 'The reply content must be a string.',
        ]);

   //     dd($request->all());


        // update ModSellerReplays
        $reply = new ModSellerReplays();
        $reply->voting_id = $request->rating_id;
        $reply->reply_author = 'Admin'; //
        $reply->reply_title = $request->reply_title;
        $reply->reply_content = $request->reply_content;
        $reply->save();

        // Return a success response
        return redirect()->back()->with('toast', [
            'message' => 'Reply saved successfully.',
            'notify' => 'success'
        ]);

    }



    /**
     * Calculate the distance between two coordinates using the Haversine formula.
     *
     * @param float $lat1 Latitude of the first point
     * @param float $lon1 Longitude of the first point
     * @param float $lat2 Latitude of the second point
     * @param float $lon2 Longitude of the second point
     * @param string $unit Unit of measurement for the result (default is kilometers)
     * @return float Distance between the two points
     */
    protected function calculateDistance($latitude1, $longitude1, $latitude2, $longitude2) {
        // Berechnung der Entfernung zwischen zwei Koordinaten
        // Hier können Sie Ihre spezifische Logik für die Entfernungsberechnung einfügen
        // Zum Beispiel mit der Haversine-Formel oder einer geeigneten Bibliothek

        // Beispielberechnung mit der Haversine-Formel:
        $earthRadius = 6371; // Radius der Erde in Kilometern

        $latitudeDifference = deg2rad($latitude2 - $latitude1);
        $longitudeDifference = deg2rad($longitude2 - $longitude1);

        $a = sin($latitudeDifference / 2) * sin($latitudeDifference / 2) +
             cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) *
             sin($longitudeDifference / 2) * sin($longitudeDifference / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c; // Entfernung in Kilometern

        return $distance;
    }
}
