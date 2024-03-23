<?php

namespace App\Http\Controllers\Frontend;

use App\Models\ModShop;
use App\Models\ModCategory;
use App\Models\ModProducts;
use Illuminate\Http\Request;
use App\Models\ModProductSizes;
use App\Http\Controllers\Controller;
use App\Models\ModProductSizesPrices;
use App\Models\ModSellerVotings; // Add the Voting model


class ShopCardController extends Controller
{
    //



    public function index($restaurantId)
    {
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

            // Berechnen Sie die Gesamtbewertung für das Restaurant
         //   $overallRating = $this->calculateOverallRating($restaurant->id);
        // Berechnen Sie die Gesamtbewertung für das Restaurant
        $ratingData = $this->calculateOverallRating($restaurant->id);
        $overallRating = $ratingData['overallRating'];
        $numberOfRatings = $ratingData['numberOfRatings'];
        // Setzen Sie `$overallRatingProgress` auf null, wenn keine Bewertungen vorhanden sind
        $overallRatingProgress = $ratingData['overallRatingProgress'] ?? null;

        // Ratings des Restaurants abrufen
     //   $ratings = ModSellerVotings::where('shop_id', $restaurantId)->get();
        // Bewertungen des Restaurants abrufen
      //  $ratings = ModSellerVotings::where('shop_id', $restaurantId)->get();
        $ratings = ModSellerVotings::where('shop_id', $restaurantId)->paginate(10);
     //   $ratings = $ratingData['ratings'];
     //dd($ratings);


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
//dd($restaurant);



            // Restaurant gefunden, geben Sie die Detailansicht zurück
            return view('frontend.pages.detailrestaurant.detail-restaurant', [
                'restaurant' => $restaurant,
                'categories' => $categories,
                'productsByCategory' => $productsByCategory, // Übergeben Sie die Produkte nach Kategorien an die Blade-Vorlage
                'overallRating' => $overallRating, // Übergeben Sie die Gesamtbewertung an die Blade-Vorlage
                'numberOfRatings' => $numberOfRatings, // Übergeben Sie die Anzahl der Bewertungen an die Blade-Vorlage
                'overallRatingProgress' => $overallRatingProgress, // Übergeben Sie die Fortschrittsbalken für die Gesamtbewertung an die Blade-Vorlage
                'ratings' => $ratings, // Übergeben Sie die Ratings an die Blade-Vorlage
                'overallRatingSingle' => $ratingData['overallRatingSingle'], // Übergeben Sie die Gesamtbewertung für jede Kategorie an die Blade-Vorlage

            ]);
        } else {
            // Restaurant nicht gefunden, geben Sie eine Fehlermeldung zurück oder leiten Sie weiter
            return redirect()->route('home')->with('error', 'Restaurant nicht gefunden.');
        }
    }

    // Methode zur Bestimmung des richtigen Preises für ein Produkt
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
        $overallRatingSingle = ($foodQualityTotal + $serviceTotal + $priceTotal + $deliveryTimeTotal) / 4;
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
        return ['overallRating' => $overallRating, 'numberOfRatings' => $numberOfRatings, 'overallRatingProgress' => $overallRatingProgress, 'ratings' => $ratings, 'overallRatingSingle' => $overallRatingSingle]; ;
    }




}
