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
    $userLatitude = $request->session()->get('userLatitude');
    $userLongitude = $request->session()->get('userLongitude');
    $selectedDistance = $request->session()->get('selectedDistance', 20); // Standardwert setzen
    $selectedLocation = $request->session()->get('selectedLocation');

    // Debugging (falls nötig)
    // dd($selectedLocation);

    $restaurants = collect(); // Leere Sammlung für Restaurants

    // Wenn Geokoordinaten vorhanden sind, Restaurants nach Entfernung filtern
    if (!is_null($userLatitude) && !is_null($userLongitude)) {
        $restaurants = ModShop::select('*')
            ->selectRaw(
                '(6371 * acos(cos(radians(?)) * cos(radians(lat))
                * cos(radians(lng) - radians(?))
                + sin(radians(?)) * sin(radians(lat)))) AS distance',
                [$userLatitude, $userLongitude, $userLatitude]
            )
            ->having('distance', '<', $selectedDistance)
            ->orderBy('voting_average', 'desc')
            ->where('published', true)
            ->where('show_voting', true)
            ->whereIn('status', ['on', 'limited']) // Status-Filter hinzufügen
            ->take(6)
            ->get();
    } else {
        // Falls keine Koordinaten vorhanden sind, den Benutzer informieren und zufällige Restaurants auswählen
        session()->flash('message', 'Keine Standortdaten gefunden. Zufällige Restaurants werden angezeigt.');
        $restaurants = ModShop::where('published', true)
            ->where('show_voting', true)
            ->whereIn('status', ['on', 'limited']) // Status-Filter hinzufügen
            ->orderBy('voting_average', 'desc')
            ->take(6)
            ->inRandomOrder()
            ->get();
    }

    // Meta-Daten und OpenGraph-Daten abrufen
    $appName = config('app.name', 'Laravel');
    $defaultDescription = "Finde die besten Restaurants in deiner Nähe. Genieße eine Vielzahl von köstlichen Gerichten.";
    $defaultKeywords = "Restaurants, Essen, Lieferung, Qualität, Service";

    // Meta-Beschreibung und Keywords aus den Einstellungen abrufen, falls nicht vorhanden, Standardwerte nutzen
    $metaDescription = get_settings()->site_meta_description ?: $defaultDescription;
    $metaKeywords = get_settings()->site_meta_keywords ?: $defaultKeywords;
    $ogTitle = "Entdecke die besten Restaurants in deiner Nähe";
    $ogDescription = $metaDescription;
    $ogImage = asset('images/default-og-image.jpg');
    $title = "$appName - Willkommen bei unserem Restaurantführer";

    return view('frontend.pages.index.index-10', [
        'restaurants' => $restaurants,
        'metaDescription' => $metaDescription,
        'metaKeywords' => $metaKeywords,
        'ogTitle' => $ogTitle,
        'ogDescription' => $ogDescription,
        'ogImage' => $ogImage,
        'title' => $title
    ]);
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

            // SEO-Daten definieren
    $metaDescription = "Finde //die besten Restaurants in deiner Nähe. Genieße eine Vielzahl von köstlichen Gerichten.";
    $metaKeywords = "Restaurants, Essen, Lieferung, Qualität, Service";

    $ogTitle = "Entdecke die besten Restaurants in deiner Nähe";
    $ogDescription = $metaDescription;
    $ogImage = asset('images/default-og-image.jpg');
    $title = "Willkommen bei unserem Restaurantführer";

    return view('frontend.pages.index.index', compact(
        'restaurants',
        'metaDescription',
        'metaKeywords',
        'ogTitle',
        'ogDescription',
        'ogImage',
        'title'
    ));

    }




/**
 * Durchsucht nach Restaurants basierend auf der Benutzereingabe.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\JsonResponse|\Illuminate\Contracts\View\View
 */
public function search(Request $request)
{

//dd($request);

    try {
        // Eingabewerte und Session-Werte abrufen
        $query = $request->input('query', '');
        $latitude = $request->input('latitude', session('userLatitude'));
        $longitude = $request->input('longitude', session('userLongitude'));
        $selectedDistance = $request->input('distance', session('selectedDistance', 20));

        // Überprüfen, ob eine Suchanfrage oder Standortdaten vorhanden sind
        if (empty($query) && (empty($latitude) || empty($longitude))) {
            return redirect()->back()->withErrors(['query' => 'Bitte geben Sie eine Adresse ein oder nutzen Sie die Standorterkennung.']);
        }

        // Adresse parsen, falls eine Suchanfrage existiert
        if (!empty($query)) {
            $parsedAddress = $this->parseAddress($query);
            if ($parsedAddress && $this->isAddressComplete($parsedAddress)) {
                // Erstellt oder holt einen bestehenden Address-Datensatz
                $addressData = ModVendorAddressData::firstOrNew(
                    [
                        'street' => $parsedAddress['street'],
                        'housenumber' => $parsedAddress['housenumber'],
                        'postal_code' => $parsedAddress['postal_code'],
                        'city' => $parsedAddress['city'],
           //             'latitude' => 0.0, // Setze einen Standardwert
           //             'longitude' => 0.0, // Setze einen Standardwert
                    ],
                    ['created_at' => now(), 'updated_at' => now()]
                );
//dd($addressData);

                // Hole die Geocodierungsergebnisse
                $geocodeResults = $this->getGeocodeResults($query, $addressData);
//dd($geocodeResults);

                // Prüfe, ob die Geocodierung erfolgreich war
                if (isset($geocodeResults['lat']) && isset($geocodeResults['lon'])) {
                    $latitude = $geocodeResults['lat'];
                    $longitude = $geocodeResults['lon'];

                    // Aktualisiere den Address-Datensatz mit den Koordinaten
                    $addressData->latitude = $latitude;
                    $addressData->longitude = $longitude;
                    $addressData->save();

                    // Setze die Session-Werte
                    session([
                        'userLatitude' => $latitude,
                        'userLongitude' => $longitude,
                        'selectedLocation' => $query,
                        'selectedName' => $geocodeResults['name']
                    ]);
                } else {
                    return redirect()->back()->withErrors(['query' => 'Die Adresse konnte nicht gefunden werden. Bitte versuchen Sie es erneut.']);
                }
            } else {
             //   return redirect()->back()->withErrors(['query' => 'Bitte geben Sie eine vollständige Adresse ein.']);
            }
        }

        // Überprüfen, ob gültige Koordinaten vorhanden sind
        if (empty($latitude) || empty($longitude)) {
            return redirect()->back()->withErrors(['query' => 'Standortinformationen fehlen. Bitte geben Sie eine gültige Adresse ein oder nutzen Sie die Standorterkennung.']);
        }

        // Cache-Schlüssel generieren basierend auf den Suchparametern
        $cacheKey = "search_restaurants_{$query}_{$latitude}_{$longitude}_{$selectedDistance}";

        // Überprüfen, ob die Daten im Cache vorhanden sind
        $cachedResults = Cache::remember($cacheKey, 10, function () use ($query, $latitude, $longitude, $selectedDistance) {
            $results = [];

            // Abrufen der gesponserten Restaurants und Entfernung berechnen
            $currentDateTime = Carbon::now('Europe/Berlin');
            $sponsoredRestaurants = $this->getSponsoredRestaurants($latitude, $longitude, $selectedDistance, $currentDateTime);
//dd($sponsoredRestaurants);
            // Restaurants basierend auf den Geokoordinaten abrufen
            $restaurants = $this->getNearbyRestaurants($latitude, $longitude, $selectedDistance, $query);
//dd($restaurants);

            // Öffnungsstatus der Restaurants bestimmen
            $restaurantStatus = $this->determineRestaurantStatus($restaurants, $currentDateTime);

            $results['restaurants'] = $restaurants;
            $results['sponsoredRestaurants'] = $sponsoredRestaurants;
            $results['restaurantStatus'] = $restaurantStatus;

            return $results;
        });

        // Session-Werte erneut abrufen, falls sie aktualisiert wurden
        $latitude = session('userLatitude');
        $longitude = session('userLongitude');
        $findCityName = session('selectedName');

        // Meta-Daten abrufen
        $metaDescription = get_settings()->site_meta_description ?: "Finde die besten Restaurants in $findCityName. Genieße eine Vielzahl von köstlichen Gerichten.";
        $metaKeywords = get_settings()->site_meta_keywords ?: "Restaurants, Essen, Lieferung, Qualität, Service";
        $ogTitle = "Entdecke die besten Restaurants in $findCityName";
        $ogImage = asset('images/default-og-image.jpg');
        $title = config('app.name', 'Laravel') . " - Willkommen bei unserem Restaurantführer";

        // return view('frontend.pages.listingrestaurant.grid-listing-filterscol', [
        return view('frontend.pages.listingrestaurantopenstreet.grid-listing-masonry-openstreetmap', [
            'restaurants' => $cachedResults['restaurants'],
            'userLatitude' => $latitude,
            'userLongitude' => $longitude,
            'selectedDistance' => $selectedDistance,
            'findCityName' => $findCityName,
            'restaurantStatus' => $cachedResults['restaurantStatus'],
            'sponsoredRestaurants' => $cachedResults['sponsoredRestaurants'],
            'metaDescription' => $metaDescription,
            'metaKeywords' => $metaKeywords,
            'ogTitle' => $ogTitle,
            'ogDescription' => $metaDescription,
            'ogImage' => $ogImage,
            'title' => $title
        ]);

    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}




/**
 * Prüft, ob die Adresse vollständig ist.
 */
protected function isAddressComplete($parsedAddress)
{
    return !is_null($parsedAddress['street']) && !is_null($parsedAddress['housenumber']) && !is_null($parsedAddress['postal_code']);
}

/**
 * Handhabung bei Eingabe nur der Stadt.
 */
protected function handleCityInput($query)
{
    $results = $this->geocodeService->searchByAddress($query);
    if (!empty($results) && isset($results[0]['lat']) && isset($results[0]['lon'])) {
        session([
            'userLatitude' => $results[0]['lat'],
            'userLongitude' => $results[0]['lon'],
            'selectedLocation' => $query,
            'selectedName' => $results[0]['name']
        ]);
    }
}

/**
 * Geocode-Ergebnisse abrufen und speichern.
 */
protected function getGeocodeResults($query, $addressData)
{

    // Überprüfen, ob beide Argumente übergeben wurden
    if (empty($query) || empty($addressData)) {
        return null;
    }

    $results = $this->geocodeService->searchByAddress($query);
 //   dd($results);
    if (!empty($results) && isset($results[0]['lat']) && isset($results[0]['lon'])) {
        $latitude = $results[0]['lat'];
        $longitude = $results[0]['lon'];

        // Überprüfe, ob der Name leer oder null ist
        if (empty($results[0]['name'])) {
            $name = $results[0]['address']['village'];
        } else {
            $name = $results[0]['name'];
        }

        if (!$addressData->exists) {
            $addressData->update(['latitude' => $latitude, 'longitude' => $longitude]);
        }

        return ['lat' => $latitude, 'lon' => $longitude, 'name' => $name];
    }
}

/**
 * Gesponserte Restaurants abrufen.
 */
protected function getSponsoredRestaurants($latitude, $longitude, $selectedDistance, $currentDateTime)
{
    return ModTopRankPrice::join('mod_shops', 'mod_top_rank_prices.shop_id', '=', 'mod_shops.id')
        ->where('mod_top_rank_prices.start_time', '<=', $currentDateTime)
        ->where('mod_top_rank_prices.end_time', '>=', $currentDateTime)
        ->where('mod_shops.published', true)
        ->select('mod_shops.*')
        ->selectRaw(
            '( 6371 * acos( cos( radians(?) ) * cos( radians( mod_shops.lat ) ) *
            cos( radians( mod_shops.lng ) - radians(?) ) + sin( radians(?) ) *
            sin( radians( mod_shops.lat ) ) ) ) AS distance',
            [$latitude, $longitude, $latitude]
        )
        ->having('distance', '<', $selectedDistance)
        ->get();
}

/**
 * Restaurants in der Nähe abrufen.
 */
protected function getNearbyRestaurants($latitude, $longitude, $selectedDistance, $query)
{
    $queryBuilder = ModShop::select('title', 'street', 'zip', 'city', 'id', 'lat as latitude', 'lng as longitude', 'logo', 'votes_count', 'voting_average', 'shop_slug', 'no_abholung', 'no_lieferung')
        ->where('published', true)
        ->where('show_voting', true)
        ->whereIn('status', ['on', 'limited']);

    if ($latitude && $longitude) {
        $queryBuilder->selectRaw(
            '( 6371 * acos( cos( radians(?) ) * cos( radians( lat ) ) *
            cos( radians( lng ) - radians(?) ) + sin( radians(?) ) *
            sin( radians( lat ) ) ) ) AS distance',
            [$latitude, $longitude, $latitude]
        )
        ->having('distance', '<', $selectedDistance)
        ->orderBy('distance');
    }

    // Hier wird 'selectedDistance' anstelle von 'distance' verwendet
    return $queryBuilder->paginate($this->perPage)->appends(compact('query', 'selectedDistance'));
}


/**
 * Öffnungsstatus der Restaurants ermitteln.
 */
protected function determineRestaurantStatus($restaurants, $currentDateTime)
{
    $restaurantStatus = [];
    foreach ($restaurants as $restaurant) {
        $openingHours = ModSellerWorktimes::where('shop_id', $restaurant->id)->get();
        $restaurantStatus[$restaurant->id] = $this->getOpeningStatus($openingHours, $currentDateTime);
    }
    return $restaurantStatus;
}

/**
 * Öffnungsstatus bestimmen.
 */
protected function getOpeningStatus($openingHours, $currentDateTime)
{
    if ($openingHours->isNotEmpty()) {
        $currentDayOfWeek = strtolower($currentDateTime->format('l'));
        foreach ($openingHours as $hour) {
            if ($hour->day_of_week === $currentDayOfWeek) {
                if ($hour->is_open == 1 && $currentDateTime->between(Carbon::parse($hour->open_time), Carbon::parse($hour->close_time))) {
                    return "open";
                }
            }
        }
        return "closed";
    }
    return "no opening hours available";
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

dd($latitude, $longitude);

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
    // Entferne überflüssige Leerzeichen und Kommas
    $query = trim($query);
    $query = preg_replace('/\s+/', ' ', $query);

    // Prüft auf vollständige Adresse: Straße Hausnummer, PLZ Stadt
    $patternFullAddress = '/^(.+?)\s+(\d+),\s+(\d{5})\s+(.+)$/';
    if (preg_match($patternFullAddress, $query, $matches)) {
        return [
            'street' => $matches[1],
            'housenumber' => $matches[2],
            'postal_code' => $matches[3],
            'city' => $matches[4]
        ];
    }

    // Prüft auf Adresse ohne Hausnummer: Straße, PLZ Stadt
    $patternStreetPostalCity = '/^(.+?),\s+(\d{5})\s+(.+)$/';
    if (preg_match($patternStreetPostalCity, $query, $matches)) {
        return [
            'street' => $matches[1],
            'housenumber' => null,
            'postal_code' => $matches[2],
            'city' => $matches[3]
        ];
    }

    // Prüft auf Adresse mit Kommas: Straße, Hausnummer, PLZ, Stadt
    $patternCommaSeparated = '/^(.+?),\s*(\d+),\s*(\d{5}),\s*(.+)$/';
    if (preg_match($patternCommaSeparated, $query, $matches)) {
        return [
            'street' => $matches[1],
            'housenumber' => $matches[2],
            'postal_code' => $matches[3],
            'city' => $matches[4]
        ];
    }

    // Prüft auf Eingabe nur einer Stadt
    $patternCityOnly = '/^(.+?)$/';
    if (preg_match($patternCityOnly, $query, $matches)) {
        return [
            'street' => null,
            'housenumber' => null,
            'postal_code' => null,
            'city' => $matches[1]
        ];
    }

    // Falls kein Muster passt, gib null zurück
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
