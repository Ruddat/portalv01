<?php

namespace App\Http\Controllers\Frontend;

use DateTime;
use Carbon\Carbon;

use App\Models\ModShop;
use Illuminate\Http\Request;

use App\Models\ModSearchPlaces;
use App\Models\ModTopRankPrice;
use App\Services\GeocodeService;
use App\Models\ModSellerWorktimes;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ModVendorAddressData;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Http\Requests\LogSideRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use NominatimLaravel\Content\Nominatim;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;


class ShopSearchController extends Controller
{


    protected $perPage = 24; // Anzahl der Ergebnisse pro Seite für die Pagination

    protected $geocodeService;

    public function __construct(GeocodeService $geocodeService)
    {
        $this->geocodeService = $geocodeService;
    }


    /**
     * Zeigt die normale Indexseite, z.B. das Suchformular.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        // Session-Werte abrufen
        $userLatitude = $request->session()->get('userLatitude', null);
        $userLongitude = $request->session()->get('userLongitude', null);

        // Standardwert für die Entfernung verwenden, wenn nicht gesetzt
        $selectedDistance = $request->session()->get('selectedDistance', 20);
        $selectedLocation = $request->session()->get('selectedLocation');
//dd($selectedLocation);

        if ($userLatitude !== null && $userLongitude !== null) {
            // Wenn Geokoordinaten in der Session vorhanden sind, Restaurants in der Umgebung auswählen
            $restaurants = ModShop::select('*')
                ->selectRaw(
                    '( 6371 * acos( cos( radians(?) ) *
                    cos( radians( lat ) )
                    * cos( radians( lng ) - radians(?) )
                    + sin( radians(?) ) *
                    sin( radians( lat ) ) ) ) AS distance',
                    [$userLatitude, $userLongitude, $userLatitude]
                )
                ->having('distance', '<', $selectedDistance)
                ->orderBy('voting_average', 'desc')
                ->where('published', true)
                ->where('show_voting', true)
                ->whereIn('status', ['on', 'limited']) // Add status condition
                ->take(6)
                ->get();
        } else {
            // Wenn keine Geokoordinaten in der Session vorhanden sind, zufällig die besten Restaurants auswählen
            $restaurants = ModShop::where('published', 1)
                ->where('show_voting', 1)
                ->whereIn('status', ['on', 'limited']) // Add status condition
                ->orderBy('voting_average', 'desc')
                ->take(6)
                ->inRandomOrder()
                ->get();
        }

        // Debugging für Koordinaten
        // dd($userLatitude, $userLongitude);

        return view('frontend.pages.index.index', compact('restaurants'));
    }


    public function viewAll(Request $request)
    {
        // Get user's latitude and longitude from session
        $userLatitude = $request->session()->get('userLatitude', null);
        $userLongitude = $request->session()->get('userLongitude', null);

        // Use default distance if not set
        $selectedDistance = $request->session()->get('selectedDistance', 20);

        $restaurants = []; // Initialize $restaurants as an empty array

        if ($userLatitude !== null && $userLongitude !== null) {
            // If user's location is available, select restaurants within specified distance
            $restaurants = ModShop::select('*')
                ->selectRaw(
                    '( 6371 * acos( cos( radians(?) ) *
                    cos( radians( lat ) )
                    * cos( radians( lng ) - radians(?) )
                    + sin( radians(?) ) *
                    sin( radians( lat ) ) ) ) AS distance',
                    [$userLatitude, $userLongitude, $userLatitude]
                )
                ->having('distance', '<', $selectedDistance)
                ->orderBy('voting_average', 'desc')
                ->where('published', 1)
                ->where('show_voting', 1)
                ->whereIn('status', ['on', 'limited'])
                ->take(30) // Limit to 30 restaurants
                ->get(); // Retrieve results as a collection
        } else {
            // If user's location is not available, select top restaurants regardless of location
            $restaurants = ModShop::where('published', 1)
                ->where('show_voting', 1)
                ->whereIn('status', ['on', 'limited'])
                ->orderBy('voting_average', 'desc')
                ->take(30) // Limit to 30 restaurants
                ->get(); // Retrieve results as a collection
        }

        // Paginate the results with 10 restaurants per page
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 9;
        $currentPageItems = collect($restaurants)->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $paginatedRestaurants = new LengthAwarePaginator($currentPageItems, count($restaurants), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath()
        ]);

        return view('frontend.pages.index.index-2', compact('paginatedRestaurants'));
    }




/**
 * Durchsucht nach Restaurants basierend auf der Benutzereingabe.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\JsonResponse|\Illuminate\Contracts\View\View
 */
public function search(Request $request)
{
    try {
        $query = $request->input('query', '');
        $selectedDistance = $request->input('distance', Session::get('selectedDistance', 20)); // Standardwert: 20 Kilometer

        if (!empty($query)) {
            // Adresse parsen
            $parsedAddress = $this->parseAddress($query);

            if ($parsedAddress) {
                // Adresse in der Datenbank suchen
                $addressData = ModVendorAddressData::where('street', $parsedAddress['street'])
                    ->where('housenumber', $parsedAddress['housenumber'])
                    ->where('postal_code', $parsedAddress['postal_code'])
                    ->where('city', $parsedAddress['city'])
                    ->first();

//dd($addressData);

                if ($addressData) {
                    // Adresse aus der Datenbank verwenden
                    $userLatitude = $addressData->latitude;
                    $userLongitude = $addressData->longitude;

                    session(['userLatitude' => $userLatitude]);
                    session(['userLongitude' => $userLongitude]);
                    session(['selectedLocation' => $query]);
                } else {
                    // Geocoding-Service verwenden, um Geokoordinaten zu erhalten
                    $results = $this->geocodeService->searchByAddress($query);

                    if (!empty($results) && isset($results[0]['lat']) && isset($results[0]['lon'])) {
                        $userLatitude = $results[0]['lat'];
                        $userLongitude = $results[0]['lon'];
                        $userCity = $results[0]['name'];

                        // Adresse in der Datenbank speichern
                        ModVendorAddressData::create([
                            'street' => $parsedAddress['street'],
                            'housenumber' => $parsedAddress['housenumber'],
                            'postal_code' => $parsedAddress['postal_code'],
                            'city' => $parsedAddress['city'],
                            'latitude' => $userLatitude,
                            'longitude' => $userLongitude,
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);

                        session(['userLatitude' => $userLatitude]);
                        session(['userLongitude' => $userLongitude]);
                        session(['selectedLocation' => $query]);
                    }
                }
            }
        }

        // Session-Werte abrufen
        $userLatitude = $request->session()->get('userLatitude', null);
        $userLongitude = $request->session()->get('userLongitude', null);

        // Wenn der Filterwert für den Umkreis im Request vorhanden ist, speichern wir ihn in der Session
        if ($request->filled('distance')) {
            $selectedDistance = $request->input('distance');
            $request->session()->put('selectedDistance', $selectedDistance);
        } else {
            // Wenn der Filterwert nicht im Request vorhanden ist, verwenden wir den Wert aus der Session
            $selectedDistance = Session::get('selectedDistance', 20);
        }

        // Abrufen der gesponserten Restaurants
        $currentDateTime = Carbon::now('Europe/Berlin');

        // Füge Distanzberechnung für gesponserte Restaurants hinzu
        $sponsoredRestaurants = ModTopRankPrice::join('mod_shops', 'mod_top_rank_prices.shop_id', '=', 'mod_shops.id')
            ->where('mod_top_rank_prices.start_time', '<=', $currentDateTime)
            ->where('mod_top_rank_prices.end_time', '>=', $currentDateTime)
            ->where('mod_shops.published', true)
            ->select('mod_shops.id', 'mod_shops.title', 'mod_shops.street', 'mod_shops.zip', 'mod_shops.city', 'mod_shops.lat', 'mod_shops.lng', 'mod_shops.logo', 'mod_shops.votes_count', 'mod_shops.voting_average', 'mod_shops.shop_slug')
            ->selectRaw(
                '( 6371 * acos( cos( radians(?) ) *
                cos( radians( mod_shops.lat ) ) *
                cos( radians( mod_shops.lng ) - radians(?) ) +
                sin( radians(?) ) *
                sin( radians( mod_shops.lat ) ) ) ) AS distance',
                [$userLatitude, $userLongitude, $userLatitude]
            )
            ->having('distance', '<', $selectedDistance)
            ->get();
//dd($sponsoredRestaurants);

        // Restaurants basierend auf den Geokoordinaten und der Entfernung abrufen
        if ($userLatitude !== null && $userLongitude !== null) {
            $restaurants = ModShop::select('title', 'street', 'zip', 'city', 'id', 'lat as latitude', 'lng as longitude', 'no_abholung', 'no_lieferung', 'logo', 'votes_count', 'voting_average', 'shop_slug')
                ->selectRaw(
                    '( 6371 * acos( cos( radians(?) ) *
                    cos( radians( lat ) ) *
                    cos( radians( lng ) - radians(?) ) +
                    sin( radians(?) ) *
                    sin( radians( lat ) ) ) ) AS distance',
                    [$userLatitude, $userLongitude, $userLatitude]
                )
                ->having('distance', '<', $selectedDistance)
                ->where('published', true)
                ->orderBy('distance')
                ->paginate($this->perPage);
//dd($sponsoredRestaurants, $restaurants);

            if (!empty($query)) {
                $request->session()->put('selectedDistance', $selectedDistance);
            }
        } else {
            $restaurants = ModShop::select('title', 'street', 'zip', 'city', 'id', 'lat as latitude', 'lng as longitude', 'no_abholung', 'no_lieferung', 'logo', 'votes_count', 'voting_average', 'shop_slug')
                ->paginate($this->perPage);
        }

        // Ein leeres Array erstellen, um die Meldungen für jedes Restaurant zu speichern
        $restaurantStatus = [];

        // Durch die Restaurants iterieren
        foreach ($restaurants as $restaurant) {
            $openingHours = ModSellerWorktimes::where('shop_id', $restaurant->id)->get();
            if ($openingHours->isNotEmpty()) {
                $currentDayOfWeek = strtolower($currentDateTime->format('l'));
                $currentOpenStatus = [];
                foreach ($openingHours as $hour) {
                    if ($hour->day_of_week === $currentDayOfWeek) {
                        $currentOpenStatus[] = [
                            'isOpen' => $hour->is_open == 1,
                            'times' => [
                                'start' => $hour->open_time ? Carbon::parse($hour->open_time) : null,
                                'end' => $hour->close_time ? Carbon::parse($hour->close_time) : null,
                            ],
                        ];
                    }
                }
                $isOpen = false;
                foreach ($currentOpenStatus as $status) {
                    $openingTimes = $status['times'];
                    if ($openingTimes['start'] && $openingTimes['end']) {
                        if ($currentDateTime->between($openingTimes['start'], $openingTimes['end'])) {
                            $isOpen = true;
                            break;
                        }
                    }
                }
                $restaurantStatus[$restaurant->id] = $isOpen ? "open" : "closed";
            } else {
                $restaurantStatus[$restaurant->id] = "no opening hours available";
            }
        }

        $restaurants->appends($request->only(['query', 'distance']));
        $findCityName = $request->session()->get('selectedName');

        return view('frontend.pages.listingrestaurant.grid-listing-filterscol', [
            'restaurants' => $restaurants,
            'userLatitude' => $userLatitude,
            'userLongitude' => $userLongitude,
            'selectedDistance' => $selectedDistance,
            'findCityName' => $findCityName,
            'restaurantStatus' => $restaurantStatus,
            'sponsoredRestaurants' => $sponsoredRestaurants, // Gesponserte Restaurants hinzufügen
        ]);

    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}



    /**
     * Speichert den ausgewählten Standort in der Session und sucht nach Restaurants in der Nähe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function speichereStandort(Request $request)
    {


        // Geokoordinaten aus dem Request erhalten
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');


        // Fehlerbehandlung für fehlende Koordinaten
        if (!$latitude || !$longitude) {
            return response()->json(['error' => 'Fehlende Geokoordinaten im Request'], 400);
        }

        // Standort in der Session speichern
        $request->session()->put('userLatitude', $latitude);
        $request->session()->put('userLongitude', $longitude);


     dd($request);


        // Nominatim-Anfrage durchführen, um den ausgewählten Ort zu erhalten
        $url = "http://nominatim.openstreetmap.org/";
        $nominatim = new Nominatim($url);
        $reverse = $nominatim->newReverse()->latlon($latitude, $longitude);
        $result = $nominatim->find($reverse);

//dd($result);

        // Überprüfen, ob die Ergebnisse nicht leer sind
        if (!empty($result)) {
        // return response()->json($result);
        // Stadtnamen aus den Ergebnissen extrahieren
        $name = $result['name'] ?? null;
        $display_name = $result['display_name'] ?? null;
        // Überprüfen, ob ein Stadtnamen gefunden wurde
        if ($name) {
        // Stadtnamen und Ortsnamen in der Session speichern
        $request->session()->put('selectedName', $display_name);
        }

        $this->saveLocation([$result]);
        }

        // Überprüfen, ob Ergebnisse vorhanden sind und den ausgewählten Ort speichern
        $selectedLocation = null;
        if (!empty($result) && isset($result[0]['display_name'])) {
            $selectedLocation = $result[0]['display_name'];
            $request->session()->put('selectedLocation', $selectedLocation);
            $request->session()->put('selectedName', $selectedLocation);
          //  $this->saveLocation($request);

       //   dd($request);
        }
        // Geografische Entfernung für die Restaurantsuche festlegen
        $selectedDistance = $request->input('distance', Session::get('selectedDistance', 20)); // Standardwert: 20 Kilometer

        // Restaurants basierend auf der Entfernung suchen
        $restaurants = ModShop::select('title', 'street', 'zip', 'city', 'id', 'lat as latitude', 'lng as longitude', 'no_abholung', 'no_lieferung', 'logo')
            ->selectRaw(
                '( 6371 * acos( cos( radians(?) ) *
                cos( radians( lat ) ) *
                cos( radians( lng ) - radians(?) ) +
                sin( radians(?) ) *
                sin( radians( lat ) ) ) ) AS distance',
                [$latitude, $longitude, $latitude]
            )
            ->where('published', true) // Nur aktive Geschäfte berücksichtigen
            ->having('distance', '<', $selectedDistance)
            ->orderBy('distance')
            ->paginate($this->perPage);




// Ein leeres Array erstellen, um die Meldungen für jedes Restaurant zu speichern
$restaurantStatus = [];

// Aktuelle Zeit mit der richtigen Zeitzone erstellen
$currentDateTime = Carbon::now('Europe/Berlin');

// Durch die Restaurants iterieren
foreach ($restaurants as $restaurant) {
    // Öffnungszeiten für das aktuelle Restaurant abrufen
    $openingHours = ModSellerWorktimes::where('shop_id', $restaurant->id)->get();

    // Überprüfen, ob Öffnungszeiten vorhanden sind
    if ($openingHours->isNotEmpty()) {
        // Öffnungsstatus für den aktuellen Tag berechnen und dem Restaurantobjekt anhängen
        $currentDayOfWeek = strtolower($currentDateTime->format('l'));

        $currentOpenStatus = [];
        $nextOpenStatus = [];
        foreach ($openingHours as $hour) {
            if ($hour->day_of_week === $currentDayOfWeek) {
                // Wenn die Öffnungszeit in der Zukunft liegt, wird sie als nächste Öffnungszeit betrachtet
                if ($currentDateTime->lte(Carbon::parse($hour->open_time))) {
                    $nextOpenStatus = [
                        'isOpen' => true,
                        'times' => [
                            'start' => Carbon::parse($hour->open_time),
                            'end' => Carbon::parse($hour->close_time),
                        ],
                    ];
                }
                // Die aktuelle Öffnungszeit wird verwendet, wenn sie nicht in der Zukunft liegt
                else {
                    $currentOpenStatus = [
                        'isOpen' => $hour->is_open == 1,
                        'times' => [
                            'start' => Carbon::parse($hour->open_time),
                            'end' => Carbon::parse($hour->close_time),
                        ],
                    ];
                }
            }
        }

        // Überprüfen, ob das Restaurant geöffnet ist und die entsprechende Meldung generieren
        if (!empty($currentOpenStatus)) {
            $isOpen = $currentOpenStatus['isOpen'];
            $openingTimes = $currentOpenStatus['times'];

            // Meldung generieren
            if ($isOpen) {
                $restaurantStatus[$restaurant->id] = "open until {$openingTimes['end']->format('H:i')}";
            } else {
                $restaurantStatus[$restaurant->id] = "closed";
            }
        } elseif (!empty($nextOpenStatus)) {
            // Wenn das Restaurant geschlossen ist, aber eine nächste Öffnungszeit vorhanden ist
            $nextOpeningTimes = $nextOpenStatus['times'];
            $restaurantStatus[$restaurant->id] = "closed. Next opening: {$nextOpeningTimes['start']->format('H:i')}";
        } else {
            // Wenn keine Öffnungszeiten für das Restaurant vorhanden sind
            $restaurantStatus[$restaurant->id] = "no opening hours available";
        }
    } else {
        // Wenn keine Öffnungszeiten für das Restaurant vorhanden sind
        $restaurantStatus[$restaurant->id] = "no opening hours available";
    }
}



        // Standortinformationen an die Blade-Ansicht übergeben
// Standortinformationen und Stadtnamen an die Blade-Ansicht übergeben
return response()->json(['success' => true, 'message' => 'Geokoordinaten erfolgreich gespeichert', 'name' => $name ], 200);
    }





    /**
     * Parst die Adresse und extrahiert die Komponenten.
     *
     * @param string $query
     * @return array|null
     */
    private function parseAddress($query)
    {
        $pattern = '/^(.+?)\s+(\d+),\s+(\d{5})\s+(.+)$/';
        if (preg_match($pattern, $query, $matches)) {
            return [
                'street' => $matches[1],
                'housenumber' => $matches[2],
                'postal_code' => $matches[3],
                'city' => $matches[4]
            ];
        }
        return null;
    }


    /**
     * Speichert den Standort in der Datenbank, wenn er noch nicht vorhanden ist.
     *
     * @param  array  $result
     * @return void
     */
    protected function saveLocation($result)
    {
    // Debugging: Ausgabe des gesamten $result-Arrays
  //  dd($result);

    // Überprüfen, ob das Array mindestens ein Element enthält
    if (count($result) > 0) {
        // Zugriff auf den ersten Eintrag des Arrays
        $firstResult = $result[0];

        // Suchen des Standorts in der Datenbank
        $existingLocation = ModSearchPlaces::where('osm_id', $firstResult['osm_id'])
            ->where('place_id', $firstResult['place_id'])
            ->first();

        // Debugging: Ausgabe des gefundenen Standorts
     //   dd($existingLocation);

        if (!$existingLocation) {
            // Erstellen eines neuen Standorts, wenn er nicht vorhanden ist
            $newLocation = new ModSearchPlaces();
            $newLocation->lat = $firstResult['lat'];
            $newLocation->lon = $firstResult['lon'];
            $newLocation->osm_id = $firstResult['osm_id'];
            $newLocation->display_name = $firstResult['display_name'];
            $newLocation->place_id = $firstResult['place_id'];
            $newLocation->licence = $firstResult['licence'];
            $newLocation->osm_type = $firstResult['osm_type'];
            $newLocation->class = $firstResult['class'];
            $newLocation->type = $firstResult['type'];
            $newLocation->place_rank = $firstResult['place_rank'];
            $newLocation->importance = $firstResult['importance'];
            $newLocation->addresstype = $firstResult['addresstype'];
            $newLocation->name = $firstResult['name'];
            // Weitere Attribute können optional zugewiesen werden
            // $newLocation->attribute = value;

            // Speichern des neuen Standorts in der Datenbank
            $newLocation->save();
        } else {
            // Standort existiert bereits, entsprechend behandeln
        }
    } else {
        // Handhabung, wenn das $result-Array leer ist
    }
}

}
