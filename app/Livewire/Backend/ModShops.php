<?php

namespace App\Livewire\Backend;

use App\Models\ModShop;
use Livewire\Component;
use Livewire\WithPagination;

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
    // Variable, um das Formular anzuzeigen oder zu verstecken
    public $showCreateForm = false;
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
        // Setze die Standardwerte für "status" und "published"
   //     $this->newShop['status'] = $this->status;
   //     $this->newShop['published'] = $this->published;
 //  dd($this->status, $this->published);

        // Validiere die Eingabe
        $this->validate([
            'newShop.shop_nr' => 'required|numeric',
            'newShop.title' => 'required',
            'newShop.email' => 'required|email',
            'newShop.status' => 'required|in:on,off,closed,limited',
            'newShop.published' => 'required|in:0,1',
            // Weitere Validierungsregeln für andere Eigenschaften deines Shop-Modells
        ]);

        // Füge feste Werte hinzu
   //     $this->newShop['fixed_property'] = 'Wert1';
   //     $this->newShop['another_fixed_property'] = 'Wert2';

   //dd($this->newShop);

        // Füge hier die Logik zum Erstellen eines neuen Shops hinzu
        ModShop::create($this->newShop);



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
        $this->showCreateForm = !$this->showCreateForm;


                // Setze die Standardwerte für "status" und "published"
        $this->newShop['status'] = $this->status;
        $this->newShop['published'] = $this->published;

    // Wenn das Formular angezeigt wird, setze die Kundennummer und deaktiviere das Eingabefeld
    if ($this->showCreateForm) {
        $timestamp = now()->format('YmdHis');
        $randomNumber = mt_rand(100, 999); // Ändere die Anzahl der Ziffern nach Bedarf
        $uniqueCustomerNumber = $timestamp . '-' . substr($randomNumber, 0, 2) . '-' . substr($randomNumber, 2);
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

}
