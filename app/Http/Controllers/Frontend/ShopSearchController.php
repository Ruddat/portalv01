<?php

namespace App\Http\Controllers\Frontend;

use DateTime;
use Carbon\Carbon;

use App\Models\ModShop;
use Illuminate\Http\Request;

use App\Models\ModSearchPlaces;
use App\Models\ModSellerWorktimes;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use NominatimLaravel\Content\Nominatim;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;


class ShopSearchController extends Controller
{


    protected $perPage = 24; // Anzahl der Ergebnisse pro Seite für die Pagination

    /**
     * Zeigt die normale Indexseite, z.B. das Suchformular.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        return view('frontend.pages.index.index');
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
                // Nominatim-Anfrage durchführen, um Geokoordinaten zu erhalten
                $url = "http://nominatim.openstreetmap.org/";
                $nominatim = new Nominatim($url);
                $search = $nominatim->newSearch()->query($query);
                $results = $nominatim->find($search);
//dd($results);

                // Geokoordinaten aus den Ergebnissen extrahieren und in der Session speichern
                if (!empty($results) && isset($results[0]['lat']) && isset($results[0]['lon'])) {
                    $userLatitude = $results[0]['lat'];
                    $userLongitude = $results[0]['lon'];
                    $userCity = $results[0]['name'];

                    session(['userLatitude' => $userLatitude]);
                    session(['userLongitude' => $userLongitude]);
                    session(['selectedLocation' => $query]);
                }
            }

            // Weitere Logik zur Restaurant-Suche hier...
            //

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

            // Überprüfen, ob die Ergebnisse nicht leer sind
            if (!empty($results)) {
                $result_neu = $results[0]; // Nur den ersten Eintrag verwenden
                $placeId = $result_neu['place_id'];
                $osmId = $result_neu['osm_id'];
            // Stadtnamen aus den Ergebnissen extrahieren
         //   $city = $result[0]['display_name']['name'] ?? null;
            $name = $results[0]['name'] ?? null;
            $display_name = $results[0]['display_name'] ?? null;
            // Überprüfen, ob ein Stadtnamen gefunden wurde
          //  dd($name, $display_name);
            if ($display_name) {
            //    dd($name);
                // Stadtnamen und Ortsnamen in der Session speichern
             //   $request->session()->put('selectedCity', $city);
                $request->session()->put('selectedName', $display_name);
                }
            // Überprüfen, ob der Eintrag bereits in der Datenbank vorhanden ist
            $this->saveLocation($results);

            }

            // Restaurants basierend auf den Geokoordinaten und der Entfernung abrufen
            if ($userLatitude !== null && $userLongitude !== null) {
                $restaurants = ModShop::select('title', 'street', 'zip', 'city', 'id', 'lat as latitude', 'lng as longitude', 'no_abholung', 'no_lieferung', 'logo', 'votes_count', 'voting_average')
                    ->selectRaw(
                        '( 6371 * acos( cos( radians(?) ) *
                        cos( radians( lat ) ) *
                        cos( radians( lng ) - radians(?) ) +
                        sin( radians(?) ) *
                        sin( radians( lat ) ) ) ) AS distance',
                        [$userLatitude, $userLongitude, $userLatitude]
                )
                ->where('published', true)
                ->having('distance', '<', $selectedDistance)
                ->orderBy('distance')
                ->paginate($this->perPage);

            // Entfernung in der Session speichern, wenn eine neue Suche durchgeführt wurde
            if (!empty($query)) {
                $request->session()->put('selectedDistance', $selectedDistance);
                }
            } else {
            // Wenn keine Geokoordinaten vorhanden sind, eine einfache Datenbankabfrage durchführen
                $restaurants = ModShop::select('title', 'street', 'zip', 'city', 'id', 'lat as latitude', 'lng as longitude', 'no_abholung', 'no_lieferung', 'logo', 'votes_count', 'voting_average')
                ->paginate($this->perPage);
             }


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

        // Iteriere über die Öffnungszeiten für den aktuellen Tag
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

        // Überprüfen, ob das Restaurant geöffnet ist und die entsprechende Meldung generieren
        if (!empty($currentOpenStatus)) {
            $isOpen = false;

            // Durch die aktuellen Öffnungszeiten iterieren
            foreach ($currentOpenStatus as $status) {
                $openingTimes = $status['times'];

                // Überprüfen, ob das Restaurant geöffnet ist
                if ($openingTimes['start'] && $openingTimes['end']) {
                    if ($currentDateTime->between($openingTimes['start'], $openingTimes['end'])) {
                        $isOpen = true;
                        break;
                    }
                }
            }

            // Meldung generieren
            if ($isOpen) {
                $restaurantStatus[$restaurant->id] = "open";
            } else {
                $restaurantStatus[$restaurant->id] = "closed";
            }
        } else {
            // Wenn keine Öffnungszeiten für das Restaurant vorhanden sind
            $restaurantStatus[$restaurant->id] = "no opening hours available";
        }
    } else {
        // Wenn keine Öffnungszeiten für das Restaurant vorhanden sind
        $restaurantStatus[$restaurant->id] = "no opening hours available";
    }
}




//dd($restaurant);


            // Die aktuellen Abfrageparameter für die Pagination beibehalten
            $restaurants->appends($request->only(['query', 'distance']));
            // Stadtnamen aus der Session abrufen
            $findCityName = $request->session()->get('selectedName');

            // View zurückgeben
            return view('frontend.pages.listingrestaurant.grid-listing-filterscol', [
                'restaurants' => $restaurants,
                'userLatitude' => $userLatitude,
                'userLongitude' => $userLongitude,
                'selectedDistance' => $selectedDistance,
                'findCityName' => $findCityName,
                'restaurantStatus' => $restaurantStatus


            ]);

        } catch (\Exception $e) {
            // Fehlerbehandlung
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
