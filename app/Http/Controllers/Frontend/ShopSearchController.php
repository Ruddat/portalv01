<?php

namespace App\Http\Controllers\Frontend;

use App\Models\ModShop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
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

        return view('frontend.pages.listingrestaurantopenstreet.grid-listing-filterscol-openstreetmap', [
            'restaurants' => $restaurants,
            'userLatitude' => $userLatitude,
            'userLongitude' => $userLongitude,
            'selectedDistance' => $selectedDistance,
        ]);

    } catch (\Exception $e) {
        // Handle die Ausnahme, z.B. gib eine Fehlermeldung aus oder logge den Fehler.
        return view('frontend.pages.listingrestaurantopenstreet.grid-listing-filterscol-openstreetmap', [
            'restaurants' => [],
        ]);
    }
}








}
