<?php

namespace App\Livewire\Backend;

use App\Models\ModShop;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use NominatimLaravel\Content\Nominatim;

class ModShops extends Component
{

    use WithPagination;

    public $shops;
    public $perPage = 10;
    public $search = '';
    public $orderBy = 'created_at';
    public $orderAsc = false;
    public $minSearchChars = 2;
    public $currentPage = 1;
    public $editingShopId;
    // Variable, um das Formular anzuzeigen oder zu verstecken
    public $showCreateForm = false;
    public $showEditForm = false;
    // Setze den Status standardmäßig auf "limited"
    public $status = 'limited';
    // Array mit den Eigenschaften des neuen Shops
    public $published = 0;


    public $newShop = [
        'title' => '',
        'shop_nr' => '',
        'street' => '',
        'zip' => '',
        'city' => '',
        'email' => '',
        'phone' => '',
        'status' => '',       // Hier sollte 'status' der Standardwert sein
        'published' => '',    // Hier sollte 'published' der Standardwert sein
        // Weitere Eigenschaften deines Shop-Modells
    ];

    public function render()
    {
        $modshop = ModShop::search($this->search)
            ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
            ->paginate($this->perPage)
            ->onEachSide(1);

        return view('livewire.backend.mod-shops', ['modshop' => $modshop]);
    }

    public function sortBy($field)
    {
        if ($this->orderBy == $field) {
            $this->orderAsc = !$this->orderAsc;
        } else {
            $this->orderBy = $field;
            $this->orderAsc = true;
        }
    }

    public function showCreateForm()
    {
        $this->showCreateForm = true;
        // Aktualisiere die Tabelle oder führe andere notwendige Aktionen durch
        $this->render();

    }

    public function createShop()
    {

    // Validiere die Eingabe
    $this->validate([
        'newShop.shop_nr' => 'required',
        'newShop.title' => 'required',
        'newShop.email' => 'required|email',
        'newShop.status' => 'required|in:on,off,closed,limited',
        'newShop.published' => 'required|in:0,1',
        'newShop.street' => 'required',
        'newShop.zip' => 'required',
        'newShop.city' => 'required',
    ]);


    // Kombiniere die Teile der Adresse aus dem Livewire-Daten-Array
    $street = $this->newShop['street'];
    $zip = $this->newShop['zip'];
    $city = $this->newShop['city'];

    // Baue die vollständige Adresse
    $userInput = "$street $zip $city";
    // $userInput = 'Heidkrugsweg 31, Edemissen'; // Die Adresse, die der Benutzer eingibt
    //dd($userInput);

    $url = "https://nominatim.openstreetmap.org/";
    $nominatim = new Nominatim($url);

    $search = $nominatim->newSearch();
    $search->query($userInput);

    $results = $nominatim->find($search);

    if (!empty($results)) {
        foreach ($results as $result) {
        $latitude = $result['lat'];
        $longitude = $result['lon'];
   //     echo "Latitude: $latitude, Longitude: $longitude<br>";
    }

        $this->newShop['lat'] = $latitude;
        $this->newShop['lng'] = $longitude;

        // Jetzt den Shop speichern
        ModShop::create($this->newShop);

    } else {
        // Keine Ergebnisse gefunden
        echo "Keine Ergebnisse gefunden für die angegebene Adresse";
    }

        // Zurücksetzen des Formulars und Ausblenden des Formulars nach dem Erstellen
        $this->reset('newShop');
        $this->showCreateForm = false;

        // Aktualisiere die Tabelle oder führe andere notwendige Aktionen durch
        $this->dispatch('refreshTable');
    }


    public function refreshTable()
    {
        $this->render(); // Diese Methode wird die Livewire-Komponente neu rendern und somit die Tabelle aktualisieren.
    }


    public function updatedSearch($value)
    {
        // Setzen Sie die aktuelle Seite auf 1, wenn die Suche aktualisiert wird.
        $this->currentPage = 1;


        if (strlen($value) >= $this->minSearchChars || $value === '') {
            // Führen Sie die Suche durch und aktualisieren Sie die Ergebnisse.
            $this->updateResults($value);
            $this->render(); // Diese Methode wird die Livewire-Komponente neu rendern und somit die Tabelle aktualisieren.
        }
    }

    private function updateResults($value)
    {
        // Führen Sie hier die Logik für die Suche durch und aktualisieren Sie die Ergebnisse.
        // Dies könnte bedeuten, dass Sie eine Abfrage an die Datenbank senden oder in einem Array filtern, je nachdem, wie Ihre Datenquelle aussieht.
        // Stellen Sie sicher, dass die aktualisierten Ergebnisse in einer Eigenschaft (z.B., $this->results) gespeichert werden, die von Ihrer Tabelle verwendet wird.
        $this->results = ModShop::search($value)->paginate($this->perPage);

    }




    public function toggleStatus($shopId)
    {
        $shop = ModShop::find($shopId);

        if ($shop) {
            $shop->update(['published' => !$shop->published]);
            $this->shops = ModShop::all(); // Aktualisiere die Daten

        }

     ///   $this->dispatch('refreshPage'); // Korrigierte Zeile
    }

    public function toggleCreateForm()
    {
        $this->resetValidation(); // Zurücksetzen der Validierungsfehler
        $this->showCreateForm = !$this->showCreateForm;
        $this->showEditForm = false;


                // Setze die Standardwerte für "status" und "published"
        $this->newShop['status'] = $this->status;
        $this->newShop['published'] = $this->published;

    // Wenn das Formular angezeigt wird, setze die Kundennummer und deaktiviere das Eingabefeld
    if ($this->showCreateForm) {
        $timestamp = now()->format('ymdHi');
        $randomNumber = mt_rand(10, 99);
        $uniqueCustomerNumber = sprintf('%s-%s', $timestamp, $randomNumber);
        $this->newShop['shop_nr'] = $uniqueCustomerNumber;

        // Deaktiviere das Eingabefeld
        $this->attributes['readonly'] = true;
    } else {
        // Aktiviere das Eingabefeld, wenn das Formular ausgeblendet wird
        $this->attributes['readonly'] = false;
    }

    }




    public function cancelCreateForm()
{
    $this->showCreateForm = false;
    $this->reset('newShop'); // Zurücksetzen der Eingabefelder
    // Zusätzliche Logik zum Zurücksetzen der Eingabefelder, falls erforderlich
}

    public function createNewShop()
    {
        // Führe hier die Logik zum Anlegen eines neuen Shops aus

        // Aktualisiere die Tabelle
        $this->refreshTable();
    }



    public function ShopDeletion($shopId)
    {
    // Füge hier deine Logik zum Löschen des Geschäfts basierend auf $shopId ein
    // Zum Beispiel:
    $shop = ModShop::find($shopId);

    if ($shop) {
        $shop->delete();

        // Nach dem Löschen kannst du die Seite aktualisieren oder eine Aktualisierung über Livewire durchführen
        $this->dispatch('refreshTable');
    }
    }


    public function updated($propertyName)
    {
        // Diese Methode wird nach einem Update der Daten aufgerufen
        // Hier können zusätzliche Aktionen ausgeführt werden
        // Zum Beispiel die Seite neu laden
        $this->dispatch('refreshPage');
    }



    public function editShop($shopId)
    {
        $shop = ModShop::find($shopId);

        if ($shop) {
            // Setze die Werte im Formular auf die Shop-Daten
            $this->newShop = $shop->toArray();
            // Setze die Bearbeitungs-ID
            $this->editingShopId = $shopId;
            $this->resetValidation();
            $this->showEditForm = true;
            $this->showCreateForm = false;
        }
    }
    public function cancelEditForm()
    {
        $this->resetValidation();
        $this->showEditForm = false;
        // ... Weitere Codezeilen ...
    }

public function updateShop()
{
    // Validiere die Eingabe
    $this->validate([
        'newShop.shop_nr' => 'required',
        'newShop.title' => 'required',
        'newShop.email' => 'required|email',
        'newShop.status' => 'required|in:on,off,closed,limited',
        'newShop.published' => 'required|in:0,1',
        // Weitere Validierungsregeln für andere Eigenschaften deines Shop-Modells
    ]);

    // Füge hier die Logik zum Aktualisieren eines vorhandenen Shops hinzu
    $shop = ModShop::find($this->newShop['id']);
    $shop->update($this->newShop);

    // Kombiniere die Teile der Adresse aus dem Livewire-Daten-Array
    $street = $this->newShop['street'];
    $zip = $this->newShop['zip'];
    $city = $this->newShop['city'];

    // Baue die vollständige Adresse
    $userInput = "$street $zip $city";

    $url = "https://nominatim.openstreetmap.org/";
    $nominatim = new Nominatim($url);

    $search = $nominatim->newSearch();
    $search->query($userInput);

    $results = $nominatim->find($search);

    // Überprüfe, ob Koordinaten gefunden wurden
    if (!empty($results)) {
        // Nutze die Koordinaten des ersten Ergebnisses
        $latitude = $results[0]['lat'];
        $longitude = $results[0]['lon'];

        // Aktualisiere die Koordinaten des Shops
        $shop->update([
            'lat' => $latitude,
            'lng' => $longitude,
        ]);
    }

    // Zurücksetzen des Formulars und Ausblenden des Formulars nach dem Aktualisieren
    $this->reset('newShop');
    $this->showCreateForm = false;
    $this->showEditForm = false;

    // Aktualisiere die Tabelle oder führe andere notwendige Aktionen durch
    $this->dispatch('refreshTable');
}


protected function getCoordinatesFromAddress($address)
{
    $url = "https://nominatim.openstreetmap.org/";
    $nominatim = new Nominatim($url);

    $search = $nominatim->newSearch();
    $search->query($address);

    $results = $nominatim->find($search);

    if (!empty($results)) {
        $result = reset($results); // Nehme das erste Ergebnis

        return $result->getCoordinates();
    }

    return null;
}

}
