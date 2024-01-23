<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use NominatimLaravel\Content\Nominatim;

class ShopSearch extends Component
{
    public $userInput = 'Address, neighborhood...';
    public $results;
    public $resultCount;
    public $autocompleteResults;
    public $selectedAutocompleteItem = null;


    public function mount($userInput)
    {
        $this->userInput = $userInput;
    }


    public function render()
    {

        // Ansonsten zeige das Standard-Suchformular-Blade an
        return view('livewire.frontend.shop-search', ['results' => $this->results]);
    }

    public function search()
    {
        $url = "http://nominatim.openstreetmap.org/";
        $nominatim = new Nominatim($url);

        $search = $nominatim->newSearch();
        $search->query($this->userInput);

        $results = $nominatim->find($search);




        if (!empty($results)) {
            $userLatitude = $results[0]['lat'];
            $userLongitude = $results[0]['lon'];


            $this->results = $results;

                        // Berechne die Anzahl der Ergebnisse
   //$this->resultCount = count($this->results);
    // Berechne die Entfernungen
    $this->calculateDistances();



            foreach ($results as $result) {
                // Überprüfe, ob ein Datensatz mit der gleichen place_id bereits existiert
                $existingRecord = DB::table('mod_search_places')->where('osm_id', $result['osm_id'])->first();

                // Füge nur ein, wenn kein existierender Datensatz gefunden wurde
                if (!$existingRecord) {
                DB::table('mod_search_places')->insert([
                    'place_id' => $result['place_id'],
                    'licence' => $result['licence'],
                    'osm_type' => $result['osm_type'],
                    'osm_id' => $result['osm_id'],
                    'lat' => $result['lat'],
                    'lon' => $result['lon'],
                    'class' => $result['class'],
                    'type' => $result['type'],
                    'place_rank' => $result['place_rank'],
                    'importance' => $result['importance'],
                    'addresstype' => $result['addresstype'],
                    'name' => $result['name'],
                    'display_name' => $result['display_name'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

            }
        }
            $restaurants = DB::table('mod_shops')
                ->select('title', 'id', 'lat as latitude', 'lng as longitude')
                ->selectRaw(
                    '( 6371 * acos( cos( radians(?) ) *
                    cos( radians( lat ) ) *
                    cos( radians( lng ) - radians(?) ) +
                    sin( radians(?) ) *
                    sin( radians( lat ) ) ) ) AS distance',
                    [$userLatitude, $userLongitude, $userLatitude]
                )
                ->having('distance', '<', 30) // Radius von 20 km
                ->orderBy('distance')
                ->get();

            // Berechne die Entfernungen und füge sie zu den Ergebnissen hinzu
            foreach ($restaurants as $restaurant) {
                $restaurant->distance = $restaurant->distance;
            }

            $this->results = $restaurants;

        } else {
            // Keine Ergebnisse gefunden
            $this->results = null;

        }
    }

    public function autocomplete()
    {
        // Suche nur durchführen, wenn die Länge des Benutzereingabe-Strings größer oder gleich 3 ist
        if (strlen($this->userInput) >= 3) {
            // Hier sollte die Logik für die Autocomplete-Suche implementiert werden
            // Beispiel: Nehmen wir an, die Autocomplete-Ergebnisse kommen aus einer Datenbank-Tabelle "searchplaces"
            $this->autocompleteResults = DB::table('mod_search_places')
                ->select('name')
                ->distinct()
                ->where('name', 'like', '%' . $this->userInput . '%')
                ->orWhere('display_name', 'like', '%' . $this->userInput . '%')
                ->take(5)
                ->get();
        } else {
            // Wenn die Länge des Benutzereingabe-Strings kleiner als 3 ist, leere die Autocomplete-Ergebnisse
            $this->autocompleteResults = [];
        }
    }


    public function selectAutocomplete($selectedValue)
    {
        // Diese Methode wird aufgerufen, wenn der Benutzer ein Autocomplete-Ergebnis auswählt
        // Verarbeite hier das ausgewählte Ergebnis nach Bedarf
        $this->userInput = $selectedValue;
        $this->autocompleteResults = []; // Setze die Autocomplete-Ergebnisse zurück
        $this->selectedAutocompleteItem = null; // Setze den ausgewählten Index zurück
    }

    public function moveSelection($direction)
    {
        if ($this->autocompleteResults) {
            if ($direction === 'up' && $this->selectedAutocompleteItem > 0) {
                $this->selectedAutocompleteItem--;
            } elseif ($direction === 'down' && $this->selectedAutocompleteItem < count($this->autocompleteResults) - 1) {
                $this->selectedAutocompleteItem++;
            }
        }
    }

    public function updatedSelectedAutocompleteItem()
    {
        if ($this->selectedAutocompleteItem !== null) {
            $selectedValue = $this->autocompleteResults[$this->selectedAutocompleteItem]->name;
            $this->userInput = $selectedValue;
        }
    }

    public function handleKeyDown($event)
    {
        // Hier kannst du spezifische Aktionen basierend auf der gedrückten Taste durchführen
        if ($event->key === 'Enter') {
            $this->selectAutocomplete();
        }
    }


// Methode zum Berechnen der Entfernungen
private function calculateDistances()
{
    // Logik zur Berechnung der Entfernungen hier

    // Beispiel: Fülle die Variable $distances mit Entfernungen
    // $this->distances = [10, 15, 20];
}

}
