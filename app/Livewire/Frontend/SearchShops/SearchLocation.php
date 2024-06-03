<?php

namespace App\Livewire\Frontend\SearchShops;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use NominatimLaravel\Content\Nominatim;

class SearchLocation extends Component
{
    public $latitude;
    public $longitude;
    public $loading = false;

    public function getLocation()
    {
        // Zeige den Ladezustand an
        $this->loading = true;

        // Zeige die Berechtigungsanfrage für den Standortzugriff an
        $this->dispatch('requestLocationPermission');
    }

    public function saveLocation($latitude, $longitude)
    {
        // Setze die Latitude und Longitude
        $this->latitude = $latitude;
        $this->longitude = $longitude;

        // Hier die Logik zur Speicherung des Standorts einfügen

        $url = "http://nominatim.openstreetmap.org/";
        $nominatim = new Nominatim($url);
        $reverse = $nominatim->newReverse()->latlon($latitude, $longitude);
        $result = $nominatim->find($reverse);


        // Speichere die Standortdaten in der Session
        Session::put('userLatitude', $latitude);
        Session::put('userLongitude', $longitude);


    // Überprüfen, ob die Ergebnisse nicht leer sind
    if (!empty($result)) {
        // Stadtnamen aus den Ergebnissen extrahieren
        $village = $result['address']['village'] ?? null;

        $display_name = $result['display_name'] ?? null;
        // Überprüfen, ob ein Dorfname gefunden wurde
        $cityName = $village ?? $display_name;

        if ($cityName) {
            // Stadtnamen und Ortsnamen in der Session speichern
            Session::put('selectedName', $cityName);
  //          dd($selectedName);
        }

    }

        // Verberge den Ladezustand
        $this->loading = false;



        // Jetzt, da wir die Standortdaten haben, können wir den Controller aufrufen
        return redirect()->route('search.index');
    }



    protected function callShopSearchController()
    {
        $response = Http::withOptions(['verify' => false])->get(route('search.index'), [
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'distance' => 20, // Beispielentfernung
        ]);

        if ($response->successful()) {
            // Hier kannst du die Antwort des Controllers weiterverarbeiten
            $data = $response->json();
            // Du könntest $data z.B. an die Ansicht übergeben oder weiterverarbeiten
        } else {
            // Fehlerbehandlung
            session()->flash('error', 'Es gab ein Problem beim Abrufen der Daten.');
        }
    }


    public function render()
    {
        return view('livewire.frontend.search-shops.search-location');
    }
}
