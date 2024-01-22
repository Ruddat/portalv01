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
    public $showCreateForm = true; // Variable, um das Formular anzuzeigen oder zu verstecken

    public $newShop = [
        'title' => '',
        'email' => '',
        // Weitere Eigenschaften deines Shop-Modells
    ];

    public function showCreateForm()
    {
        $this->showCreateForm = true;
        // Aktualisiere die Tabelle oder führe andere notwendige Aktionen durch
        $this->render();

    }

    public function createShop()
    {

        // Füge hier die Logik zum Erstellen eines neuen Shops hinzu
        ModShop::create($this->newShop);

        // Zurücksetzen des Formulars und Ausblenden des Formulars nach dem Erstellen
        $this->reset('newShop');
        $this->showCreateForm = false;

        // Aktualisiere die Tabelle oder führe andere notwendige Aktionen durch
        $this->dispatch('refreshTable');
    }


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

    public function refreshTable()
    {
        $this->render(); // Diese Methode wird die Livewire-Komponente neu rendern und somit die Tabelle aktualisieren.
    }


    public function updatedSearch($value)
    {
        if (strlen($value) >= $this->minSearchChars || $value === '') {
            $this->render(); // Diese Methode wird die Livewire-Komponente neu rendern und somit die Tabelle aktualisieren.
        }
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

    }




    public function cancelCreateForm()
{
    $this->showCreateForm = false;
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
