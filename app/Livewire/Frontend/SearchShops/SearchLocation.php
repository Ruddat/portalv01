<?php

namespace App\Livewire\Frontend\SearchShops;

use Livewire\Component;
use App\Models\ModSearchLocation;
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

       // dd($this->latitude, $this->longitude); // Debugging

        // Toleranz für den Vergleich festlegen
        $tolerance = 0.0011;

        // Überprüfen, ob die Longitude und Latitude in der Datenbank vorhanden sind
        $location = ModSearchLocation::whereBetween('lat', [$latitude - $tolerance, $latitude + $tolerance])
                                      ->whereBetween('lon', [$longitude - $tolerance, $longitude + $tolerance])
                                      ->first();

        if ($location) {
            // Standort in der Datenbank gefunden, verwenden
         //   dd($location); // Debugging++;
            $this->processLocation($location);
        } else {
            // Standort nicht in der Datenbank gefunden, Nominatim API aufrufen
            $this->retrieveLocationFromNominatim($latitude, $longitude);
        }
    }

    private function processLocation($location)
    {
        // Extrahiere Dorfnamen und Anzeigenamen aus dem Standort
        $village = $location['address']['village'] ?? null;
        $display_name = $location['display_name'] ?? null;

        // Wähle den Stadtnamen basierend auf Verfügbarkeit aus
        $cityName = $village ?? $display_name;

        // Speichere den Stadtnamen in der Session, wenn vorhanden
        if ($cityName) {
            Session::put('selectedName', $cityName);
        }

        // Speichere die Standortdaten (Latitude und Longitude) in der Session
        Session::put('userLatitude', $location['lat']);
        Session::put('userLongitude', $location['lon']);

        // Jetzt, da wir die Standortdaten haben, können wir den Controller aufrufen
        return redirect()->route('search.index');
    }

    private function retrieveLocationFromNominatim($latitude, $longitude)
    {

      //  dd($latitude, $longitude); // Debugging

        // Nominatim API aufrufen, um den Standort zu ermitteln
        $response = Http::get("http://nominatim.openstreetmap.org/reverse", [
            'format' => 'json',
            'lat' => $latitude,
            'lon' => $longitude,
            'zoom' => 18,
        ]);

        if ($response->successful()) {
            $data = $response->json();

            if (!empty($data)) {
                // Standortdaten verarbeiten
               // dd($data);
                $this->processLocationData($data);
            } else {
                // Keine Daten erhalten
                // Füge hier deine Fehlerbehandlung hinzu
            }
        } else {
            // API-Aufruf fehlgeschlagen
            // Füge hier deine Fehlerbehandlung hinzu
        }

    //    dd($data);
    }

    private function processLocationData($data)
    {
        // Extrahiere und verarbeite die relevanten Standortdaten
        $locationData = [
            'place_id' => $data['place_id'] ?? null,
            'licence' => $data['licence'] ?? null,
            'osm_type' => $data['osm_type'] ?? null,
            'osm_id' => $data['osm_id'] ?? null,
            'lat' => $data['lat'] ?? null,
            'lon' => $data['lon'] ?? null,
            'class' => $data['class'] ?? null,
            'type' => $data['type'] ?? null,
            'place_rank' => $data['place_rank'] ?? null,
            'importance' => $data['importance'] ?? null,
            'addresstype' => $data['addresstype'] ?? null,
            'name' => $data['name'] ?? null,
            'display_name' => $data['display_name'] ?? null,
            'address' => $data['address'] ?? null,
            'boundingbox' => $data['boundingbox'] ?? null,
        ];

        // Speichere die Standortdaten in der Datenbank
        ModSearchLocation::create($locationData);

        // Verarbeite den Standort weiter
        $this->processLocation($locationData);
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
