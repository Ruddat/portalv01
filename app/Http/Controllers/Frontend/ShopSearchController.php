<?php

namespace App\Http\Controllers\Frontend;

use App\Models\ModShop;
use Illuminate\Support\Facades\View;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use NominatimLaravel\Content\Nominatim;
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




        $query = $request->input('query', ''); // Setze leere Zeichenkette als Standardwert, wenn kein Wert übergeben wird
        $userLatitude = null;
        $userLongitude = null;

        $selectedDistance = $request->input('distance', Session::get('selectedDistance', 20));

        // Überprüfe, ob die Nominatim-Anfrage durchgeführt werden soll
        if ($request->isMethod('post') && $query !== '') {
            $url = "http://nominatim.openstreetmap.org/";
            $nominatim = new Nominatim($url);

            $search = $nominatim->newSearch();

            // Führe die Nominatim-Anfrage nur durch, wenn $query nicht null ist
            if ($query !== null) {
                $search->query($query);
                $results = $nominatim->find($search);

                // Überprüfe, ob Ergebnisse vorhanden sind und setze $userLatitude und $userLongitude
                if (!empty($results) && isset($results[0]['lat']) && isset($results[0]['lon'])) {
                    $userLatitude = $results[0]['lat'];
                    $userLongitude = $results[0]['lon'];

                    // Speichere die Werte in der Session
                    $request->session()->put('userLatitude', $userLatitude);
                    $request->session()->put('userLongitude', $userLongitude);

                    // Speichere den ausgewählten Ort in der Session
                    $request->session()->put('selectedLocation', $query);
                }
            }
        }


        // Versuche die Werte aus der Session zu erhalten
        $userLatitude = $request->session()->get('userLatitude', null);
        $userLongitude = $request->session()->get('userLongitude', null);

        // Überprüfe, ob $userLatitude und $userLongitude vorhanden sind
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
                ->having('distance', '<', $selectedDistance)
                ->orderBy('distance')
                ->paginate(12);

                // Speichere die ausgewählte Entfernung in der Session
        Session::put('selectedDistance', $selectedDistance);
        } else {
            // Führe eine einfache Datenbankabfrage ohne Entfernungs- und Sortierlogik durch
            $restaurants = ModShop::select('title', 'street', 'zip', 'city', 'id', 'lat as latitude', 'lng as longitude', 'no_abholung', 'no_lieferung')
                ->paginate(12);
        }

        return view('frontend.pages.listingrestaurant.grid-listing-filterscol', [
            'restaurants' => $restaurants,
            'userLatitude' => $userLatitude,
            'userLongitude' => $userLongitude,
            'selectedDistance' => $selectedDistance,
        ]);

    } catch (\Exception $e) {
        // Handle die Ausnahme, z.B. gib eine Fehlermeldung aus oder logge den Fehler.


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
        ->having('distance', '<', $selectedDistance)
        ->orderBy('distance')
        ->paginate(12);
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
    // Verarbeite den Standort hier
    $latitude = $request->input('latitude');
    $longitude = $request->input('longitude');


  //  dd($latitude, $longitude);

    // Speichere die Werte in der Session
    $request->session()->put('userLatitude', $latitude);
    $request->session()->put('userLongitude', $longitude);

    // Überprüfe, ob die Nominatim-Anfrage durchgeführt werden soll
    if ($request->isMethod('post')) {
        $query = ''; // Setze den Ort hier entsprechend deiner Logik
        $url = "http://nominatim.openstreetmap.org/";
        $nominatim = new Nominatim($url);

       // $search = $nominatim->newSearch();
       $reverse = $nominatim->newReverse()
       ->latlon($latitude, $longitude);
       $result = $nominatim->find($reverse);

        // Überprüfe, ob Ergebnisse vorhanden sind und setze $selectedLocation
        if (!empty($result) && isset($result[0]['display_name'])) {
            $selectedLocation = $result[0]['display_name'];

            // Speichere den ausgewählten Ort in der Session
            $request->session()->put('selectedLocation', $selectedLocation);
        }
    }

    // Führe die Suche basierend auf der geografischen Entfernung durch
    $selectedDistance = 20; // Beispiel: Entfernungsintervall von 10 Kilometern

    if ($latitude !== null && $longitude !== null) {
        $restaurants = ModShop::select('title', 'street', 'zip', 'city', 'id', 'lat as latitude', 'lng as longitude', 'no_abholung', 'no_lieferung')
            ->selectRaw(
                '( 6371 * acos( cos( radians(?) ) *
                cos( radians( lat ) ) *
                cos( radians( lng ) - radians(?) ) +
                sin( radians(?) ) *
                sin( radians( lat ) ) ) ) AS distance',
                [$latitude, $longitude, $latitude]
            )
            ->having('distance', '<', $selectedDistance)
            ->orderBy('distance')
            ->paginate(12);

        // Speichere die ausgewählte Entfernung in der Session
        $request->session()->put('selectedDistance', $selectedDistance);

        // Zeige die Ergebnisse mit der Blade-Ansicht an
      // dd($request->session()->get('selectedLocation'));

        return view('frontend.pages.listingrestaurant.grid-listing-filterscol', [
            'restaurants' => $restaurants,
            'userLatitude' => $latitude,
            'userLongitude' => $longitude,
            'selectedDistance' => $selectedDistance,
        ]);
    }

    // Fehlerbehandlung, falls die Koordinaten nicht verfügbar sind
    dd('Fehler beim Abrufen der Standortkoordinaten');
    return response()->json(['error' => 'Fehler beim Abrufen der Standortkoordinaten'], 400);
}





}
