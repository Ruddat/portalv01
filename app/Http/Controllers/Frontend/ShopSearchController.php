<?php

namespace App\Http\Controllers\Frontend;

use App\Models\ModShop;
use Illuminate\Http\Request;

use App\Models\ModSearchPlaces;
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




    //
public function index(Request $request)
{
    // Zeige die normale Indexseite, z.B. das Suchformular
    return view('frontend.pages.index.index');
}



public function search(Request $request)
{




    try {
        // Abfrageparameter erhalten
        $query = $request->input('query', '');
        $selectedDistance = $request->input('distance', Session::get('selectedDistance', 20)); // Standardwert: 20 Kilometer

        // Nominatim-Anfrage durchführen, um Geokoordinaten zu erhalten, wenn eine Abfrage vorhanden ist
        if (!empty($query)) {
            $url = "http://nominatim.openstreetmap.org/";
            $nominatim = new Nominatim($url);
            $search = $nominatim->newSearch()->query($query);
            $results = $nominatim->find($search);



            // Geokoordinaten aus den Ergebnissen extrahieren und in der Session speichern, falls vorhanden
            if (!empty($results) && isset($results[0]['lat']) && isset($results[0]['lon'])) {
                $userLatitude = $results[0]['lat'];
                $userLongitude = $results[0]['lon'];
                $request->session()->put('userLatitude', $userLatitude);
                $request->session()->put('userLongitude', $userLongitude);
                $request->session()->put('selectedLocation', $query);
            }

        }
//dd($request);


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
      //  dd($osmId);
        // Überprüfen, ob der Eintrag bereits in der Datenbank vorhanden ist
        $existingPlace = ModSearchPlaces::where(function($query) use ($placeId, $osmId) {
            $query->where('place_id', $placeId)
                  ->where('osm_id', $osmId);
        })->first();

        if (!$existingPlace) {
            // Eintrag in der Datenbank speichern, falls noch nicht vorhanden
            ModSearchPlaces::create([
                'place_id' => $placeId,
                // Weitere Felder speichern
                'licence' => $result_neu['licence'],
                'osm_type' => $result_neu['osm_type'],
                'osm_id' => $result_neu['osm_id'],
                'lat' => $result_neu['lat'],
                'lon' => $result_neu['lon'],
                // Weitere Felder speichern ...
                'display_name' => $result_neu['display_name'],
            ]);
        }
    }



        // Restaurants basierend auf den Geokoordinaten und der Entfernung abrufen
        if ($userLatitude !== null && $userLongitude !== null) {
            $restaurants = ModShop::select('title', 'street', 'zip', 'city', 'id', 'lat as latitude', 'lng as longitude', 'no_abholung', 'no_lieferung')
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
                ->paginate(12);



            // Entfernung in der Session speichern, wenn eine neue Suche durchgeführt wurde
            if (!empty($query)) {
                $request->session()->put('selectedDistance', $selectedDistance);
            }
        } else {
            // Wenn keine Geokoordinaten vorhanden sind, eine einfache Datenbankabfrage durchführen
            $restaurants = ModShop::select('title', 'street', 'zip', 'city', 'id', 'lat as latitude', 'lng as longitude', 'no_abholung', 'no_lieferung')
                ->paginate(12);
        }

        // Die aktuellen Abfrageparameter für die Pagination beibehalten
        $restaurants->appends($request->only(['query', 'distance']));

     //   dd($restaurants);

        return view('frontend.pages.listingrestaurant.grid-listing-filterscol', [
            'restaurants' => $restaurants,
            'userLatitude' => $userLatitude,
            'userLongitude' => $userLongitude,
            'selectedDistance' => $selectedDistance,
        ]);


    } catch (\Exception $e) {
        // Fehlerbehandlung

       // dd($restaurants);
        return view('frontend.pages.listingrestaurant.grid-listing-filterscol', [
            'restaurants' => [],
        ]);
    }
}




private function performRestaurantSearch($userLatitude, $userLongitude, $selectedDistance)
{
    return ModShop::select('title', 'street', 'zip', 'city', 'id', 'lat as latitude', 'lng as longitude', 'no_abholung', 'no_lieferung')
        ->selectRaw(
            '( 6371 * acos( cos( radians(?) ) *
            cos( radians( lat ) ) *
            cos( radians( lng ) - radians(?) ) +
            sin( radians(?) ) *
            sin( radians( lat ) ) ) ) AS distance',
            [$userLatitude, $userLongitude, $userLatitude]
        )
        ->where('published', true) // Nur aktive Geschäfte berücksichtigen
        ->having('distance', '<', $selectedDistance)
        ->orderBy('distance')
        ->paginate(12);

dd($restaurants);

    }

private function paginateResults($results, $perPage)
{
    $page = LengthAwarePaginator::resolveCurrentPage();
    $items = collect($results);
    $paginator = new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page);

    return $paginator;
}


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


    // Überprüfen, ob Ergebnisse vorhanden sind und den ausgewählten Ort speichern
    $selectedLocation = null;
    if (!empty($result) && isset($result[0]['display_name'])) {
        $selectedLocation = $result[0]['display_name'];
        $request->session()->put('selectedLocation', $selectedLocation);
    }



    // Geografische Entfernung für die Restaurantsuche festlegen
    $selectedDistance = $request->input('distance', Session::get('selectedDistance', 20)); // Standardwert: 20 Kilometer

//dd($result['osm_id']);

// Speichern des Standorts in der Datenbank, wenn er noch nicht vorhanden ist
$existingLocation = ModSearchPlaces::where('lat', $latitude)
    ->where('lon', $longitude)
    ->where('osm_id', $result['osm_id'])
    ->first();

if (!$existingLocation) {
    // Create a new record if the location doesn't exist
    $newLocation = new ModSearchPlaces();
    $newLocation->lat = $latitude;
    $newLocation->lon = $longitude;
    $newLocation->osm_id = $result['osm_id'];
    $newLocation->display_name = $result['display_name'];
    $newLocation->place_id = $result['place_id'];
    $newLocation->licence = $result['licence'];
    $newLocation->osm_type = $result['osm_type'];
    $newLocation->class = $result['class'];
    $newLocation->type = $result['type'];
    $newLocation->place_rank = $result['place_rank'];
    $newLocation->importance = $result['importance'];
    $newLocation->addresstype = $result['addresstype'];
    $newLocation->name = $result['name'];
    // Optionally, you can assign other attributes to $newLocation as needed
    // $newLocation->attribute = value;

    // Save the new location to the database
    $newLocation->save();
} else {
    // Location already exists, handle accordingly
}

    // Restaurants basierend auf der Entfernung suchen
    $restaurants = ModShop::select('title', 'street', 'zip', 'city', 'id', 'lat as latitude', 'lng as longitude', 'no_abholung', 'no_lieferung')
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
        ->paginate(12);

    // Standortinformationen an die Blade-Ansicht übergeben
    // Hier wird die Erfolgsmeldung für die Koordinaten zurückgegeben
    return response()->json(['success' => true, 'message' => 'Geokoordinaten erfolgreich gespeichert'], 200);
}






private function saveSearchResults($results)
{
    // Überprüfen, ob die Ergebnisse nicht leer sind
    if (!empty($results)) {
        $result = $results[0]; // Nur den ersten Eintrag verwenden

        $placeId = $result['place_id'];
        // Überprüfen, ob der Eintrag bereits in der Datenbank vorhanden ist
        $existingPlace = ModSearchPlaces::where('place_id', $placeId)->first();
        if (!$existingPlace) {
            // Eintrag in der Datenbank speichern, falls noch nicht vorhanden
            ModSearchPlaces::create([
                'place_id' => $placeId,
                // Weitere Felder speichern
                'licence' => $result['licence'],
                'osm_type' => $result['osm_type'],
                // Weitere Felder speichern ...
                'display_name' => $result['display_name'],
            ]);
        }
    }
}

}
