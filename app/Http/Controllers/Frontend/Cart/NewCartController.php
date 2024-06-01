<?php

namespace App\Http\Controllers\Frontend\Cart;

use App\Models\ModShop;
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

class NewCartController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $restaurantId
     * @return \Illuminate\Http\Response
     */
    public function index($restaurantIdOrSlug)
    {

    // Restaurant anhand des Slugs finden
    $restaurant = ModShop::where('shop_slug', $restaurantIdOrSlug)->first();

    // Wenn das Restaurant nicht anhand des Slugs gefunden wurde, versuchen es anhand der ID zu finden
    if (!$restaurant) {
        $restaurant = ModShop::find($restaurantIdOrSlug);
    }

    // Überprüfen ob das Restaurant gefunden wurde
    if ($restaurant) {
        // Das Restaurant wurde gefunden, verwenden der $restaurant->id oder $restaurant->slug je nach Bedarf
        // Hier können Sie die weitere Logik für die Restaurant-Ansicht implementieren
        $restaurantId = $restaurant->id;
       // dd($restaurant->id);
    } else {
        // Wenn weder der Slug noch die ID ein gültiges Restaurant ergeben haben, entsprechend reagieren
        // Zum Beispiel eine Fehlermeldung anzeigen oder auf eine Standardseite weiterleiten
        abort(404); // Seite nicht gefunden
    }


    // Überprüfen, ob die Session-Variablen vorhanden sind
    if (!session()->has('userLatitude') || !session()->has('userLongitude')) {
        // Session-Variablen nicht vorhanden, leite zur Startseite zurück mit einer Meldung
        return redirect()->route('home')->with('error', 'Die Standortdaten sind nicht verfügbar. Bitte erlauben Sie den Zugriff auf Ihren Standort.');

    }

        // Restaurant anhand der ID finden
        $restaurant = ModShop::findOrFail($restaurantId);

        if ($restaurant) {
            // Produkte des Geschäfts mit den dazugehörigen Kategorien abrufen
            $productsByCategory = [];

            // Kategorien des Shops abrufen
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
//dd($sizesWithPrices);
            // Berechnen Sie die Gesamtbewertung für das Restaurant
         //   $overallRating = $this->calculateOverallRating($restaurant->id);
        // Berechnen Sie die Gesamtbewertung für das Restaurant



            // Für jede Kategorie die entsprechenden Produkte abrufen und zuweisen
            foreach ($categories as $category) {
                // Produkte der Kategorie abrufen und nach deinem Kriterium sortieren
                $products = ModProducts::where('shop_id', $restaurant->id)
                                        ->where('category_id', $category->id)
                                        ->where('product_published', true)
                                        ->orderBy('product_ordering', 'ASC')
                                        ->get();


             //   dd($products);
                // Für jedes Produkt den richtigen Preis abrufen und zuweisen
                foreach ($products as $product) {
                    // Hier wird die Methode getProductPrice aufgerufen, um den Preis für das aktuelle Produkt abzurufen
                    $product->minPrice = $this->getProductPrice($product->id);
                }

                $productsByCategory[$category->category_name] = $products;
            }



            // Retrieve latitude and longitude from session // TODO - Shop Sperren fuer lieferungen // TODO - Lieferkosten berechnen
            $userLatitude = session('userLatitude');
            $userLongitude = session('userLongitude');


            // Holen des Standort vom Restaurant
            $shopLocation = ModShop::where('id', $restaurant->id)->first();
            $distance = $this->calculateDistance($userLatitude, $userLongitude, $shopLocation->lat, $shopLocation->lng);
            $distance = round($distance, 2);

            // Holen der Lieferbereiche für den bestimmten Shop
            $deliveryAreas = DeliveryArea::where('shop_id', $restaurant->id)
            ->orderBy('distance_km', 'asc')
            ->get();

            // Überprüfen, ob der Benutzer innerhalb eines Lieferbereichs liegt
            $foundInDeliveryArea = false;
            foreach ($deliveryAreas as $area) {
                // Überprüfen, ob die Entfernung des Benutzers innerhalb der maximalen Entfernung des Lieferbereichs liegt
                if ($distance <= $area->distance_km) {

                    // Der Benutzer liegt innerhalb dieses Lieferbereichs
                    // Hier können Sie weitere Aktionen ausführen, wenn der Benutzer innerhalb des Lieferbereichs liegt
                    // Zum Beispiel, eine Bestellung zulassen, spezielle Nachrichten anzeigen usw.
                    // Für jetzt drucken wir nur eine Nachricht aus
                //    echo "Der Benutzer liegt innerhalb des Lieferbereichs mit einer maximalen Entfernung von " . $area->distance_km . " km";
                //    echo "Kosten" . $area->delivery_cost . " euro";
                //    echo "Frei ab" . $area->free_delivery_threshold . " euro";


// Lösche die alten Daten für den vorherigen Shop, wenn vorhanden
$oldShopId = Session::get('shopId');
if ($oldShopId !== null) {
    Session::forget('delivery_cost_' . $oldShopId);
    Session::forget('delivery_charge_' . $oldShopId);
    Session::forget('delivery_free_' . $oldShopId);
}

// Speichere die Lieferkosten in der Sitzung für den neuen Shop
session(['delivery_cost_' . $restaurantId => $area->delivery_cost]);
// Speichere den Mindestbestellwert in der Sitzung für den neuen Shop
session(['delivery_charge_' . $restaurantId => $area->delivery_charge]);
// Speichere Anfahrtkostenfrei in der Sitzung für den neuen Shop
session(['delivery_free_' . $restaurantId => $area->free_delivery_threshold]);

// Speichere die ID des neuen Shops in der Sitzung
session(['shopId' => $restaurantId]);

                //   dd(session()->all());


               //     dd($area->delivery_cost);


                    $foundInDeliveryArea = true;
                    $modalScript = false;
                    break; // Keine Notwendigkeit, andere Bereiche zu überprüfen, sobald ein Übereinstimmung gefunden wurde
                }
            }

            // Wenn der Benutzer nicht in einem Lieferbereich gefunden wurde
            if (!$foundInDeliveryArea) {
                // echo "Der Benutzer liegt nicht innerhalb eines Lieferbereichs.";
                $oldShopId = Session::get('shopId');
if ($oldShopId !== null) {
    Session::forget('delivery_cost_' . $oldShopId);
    Session::forget('delivery_charge_' . $oldShopId);
    Session::forget('delivery_free_' . $oldShopId);
}
                $modalScript = true;
            }

//dd($productsByCategory);

            // Restaurant gefunden, geben Sie die Detailansicht zurück
            return view('frontend.pages.detailrestaurant.detail-restaurant-2', [
                'restaurant' => $restaurant,
                'categories' => $categories,
                'productsByCategory' => $productsByCategory, // Übergeben Sie die Produkte nach Kategorien an die Blade-Vorlage
               // 'overallRating' => $overallRating, // Übergeben Sie die Gesamtbewertung an die Blade-Vorlage
              //  'numberOfRatings' => $numberOfRatings, // Übergeben Sie die Anzahl der Bewertungen an die Blade-Vorlage
              //  'overallRatingProgress' => $overallRatingProgress, // Übergeben Sie die Fortschrittsbalken für die Gesamtbewertung an die Blade-Vorlage
             //   'ratings' => $ratings, // Übergeben Sie die Ratings an die Blade-Vorlage
                'modalScript' => $modalScript, // Das Skript für das Modal übergeben
                'sizesWithPrices' => $sizesWithPrices,
           //     'overallRatingSingle' => $ratingData['overallRatingSingle'], // Übergeben Sie die Gesamtbewertung für jede Kategorie an die Blade-Vorlage

            ]);
        } else {
            // Restaurant nicht gefunden, geben Sie eine Fehlermeldung zurück oder leiten Sie weiter
            return redirect()->route('home')->with('error', 'Restaurant nicht gefunden.');
        }
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
