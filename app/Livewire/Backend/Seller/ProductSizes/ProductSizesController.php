<?php

namespace App\Livewire\Backend\Seller\ProductSizes;

use Livewire\Component;
use App\Models\ModProducts;
use Illuminate\Http\Request;
use App\Models\ModProductSizes;
use App\Models\ModProductSizesPrices;
use Illuminate\Support\Facades\Session;


class ProductSizesController extends Component
{


    public $sizes;
    public $subSize; // Initialisiere die Variable
    public $newParentSizeTitle;
    public $selectedParentSize;
    public $newChildSizeTitle;
    public $published = null; // Initialisierung der Variable
    public $subSizeId;
    public $newMainSizeTitle = ''; // Initialisierung der Variable
    public $editingMainSize = false;
    public $mainSizeToEdit;
    public $childSizes = [];
    public $parentId; // Definieren Sie die Eigenschaft $parentId hier
    public $shopId;

    protected $rules = [
        'mainSizeToEdit.title' => 'required' // Hier kannst du weitere Validierungsregeln hinzufügen, wenn nötig
    ];


    public function mount()
    {
        $this->sizes = ModProductSizes::where('parent', 0)->orderBy('ordering')->get();
    //  dd($this->sizes);

        //  $this->selectedParentSize = null; // Setze den Wert der Eigenschaft auf null oder einen Standardwert
        $this->mainSizeToEdit = null; // Initialisierung der Variable
    }


    public function loadSizes()
    {
        $currentShopId = Session::get('currentShopId');

        // Lade Hauptgrößen mit sortierten Untergrößen
        $this->sizes = ModProductSizes::where('parent', 0)
            ->where('shop_id', $currentShopId)
            ->with(['children' => function ($query) {
                $query->orderBy('ordering');
            }])
            ->orderBy('ordering')
            ->get();
    }


    public function addSize(Request $request)
    {

        // Shop-ID aus der Session abrufen
        $currentShopId = Session::get('currentShopId');

//        $shopId = $request->route('shopId');

        if ($this->newParentSizeTitle) {
            ModProductSizes::create([
                'title' => $this->newParentSizeTitle,
                'parent' => 0,
                'shop_id' => $currentShopId, // Bei Bedarf shop_id aktualisieren


            ]);

            $this->newParentSizeTitle = '';
            $this->loadSizes();
        }
    }

    public function loadChildSizes()
    {
        if ($this->selectedParentSize) {
            $this->newChildSizeTitle = ''; // Reset the new child size input field
        }
        if ($this->selectedParentSize) {
            $this->childSizes = ModProductSizes::where('parent', $this->selectedParentSize)
                ->orderBy('ordering') // Sortiere nach der 'ordering'-Spalte
                ->get();
        }
    }


    public function addChildSize()
    {

        // Shop-ID aus der Session abrufen
        $currentShopId = Session::get('currentShopId');


        if ($this->newChildSizeTitle && $this->selectedParentSize) {
            $maxOrdering = ModProductSizes::where('parent', $this->selectedParentSize)->max('ordering');
            $ordering = ($maxOrdering !== null) ? $maxOrdering + 1 : 0;

            ModProductSizes::create([
                'title' => $this->newChildSizeTitle,
                'parent' => $this->selectedParentSize,
                'ordering' => $ordering,
                'shop_id' =>  $currentShopId, // Verwenden Sie $shopId anstelle von $this->shopId
            ]);

            $this->newChildSizeTitle = '';
            $this->loadSizes();
        }
    }


    public function deleteSubSize($subSizeId)
    {
        // Finde die Untergröße anhand der übergebenen ID
        $subSize = ModProductSizes::find($subSizeId);

        if ($subSize) {
            // Lösche die zugehörigen Preise aus der Tabelle product_sizes_prices
            ModProductSizesPrices::where('size_id', $subSize->id)->delete();

            // Lösche die Untergröße, wenn sie gefunden wurde
            $subSize->delete();

            // Lade die Größen erneut, um die aktualisierte Liste anzuzeigen
            $this->loadSizes();
        }
    }


public function deleteMainSize($mainSizeId)
{
    // Finde die Hauptgröße anhand der übergebenen ID
    $mainSize = ModProductSizes::find($mainSizeId);

    if ($mainSize) {
        // Überprüfe, ob keine Untergrößen vorhanden sind
        if ($mainSize->children->isEmpty()) {
            // Lösche die Hauptgröße, wenn keine Untergrößen vorhanden sind
            $mainSize->delete();
            // Lade die Größen erneut, um die aktualisierte Liste anzuzeigen
            $this->loadSizes();
        } else {
            // Wenn Untergrößen vorhanden sind, setze eine Fehlermeldung oder eine entsprechende Variable
            // z.B. $this->subSizesExist = true;
        }
    }
}


public function toggleSubSizePublished($subSizeId)
{
    $subSize = ModProductSizes::find($subSizeId);

    if ($subSize) {
        // Ändere den Wert von 'published' um
        $subSize->published = !$subSize->published;
        $subSize->save();

        // Lade die Daten erneut, um die aktualisierten Daten anzuzeigen
        $this->loadSizes();
    }
}

public function togglePublished($subSizeId)
{
    $subSize = ModProductSizes::find($subSizeId);

    if ($subSize) {
        $subSize->published = !$subSize->published;
        $subSize->save();
        $this->loadSizes();
    }

}

// Beispiel: Methode, die $subSizeId setzt
public function setSubSizeId($id)
{
    $this->subSizeId = $id;
}

// Methode, die togglePublished mit $subSizeId aufruft
public function callTogglePublished()
{
    $this->togglePublished($this->subSizeId);

}

public function toggleDisplay($subSizeId)
{
    $subSize = ModProductSizes::find($subSizeId);

    if ($subSize) {
        $subSize->display = !$subSize->display;
        $subSize->save();
        $this->loadSizes();
    }

}

public function turnOnDisplay($subSizeId)
{
    $subSize = ModProductSizes::find($subSizeId);

    if ($subSize) {
        $subSize->display = true;
        $subSize->save();

    }

}

public function changeOrder($subSizeId, $direction)
{
    $subSize = ModProductSizes::find($subSizeId);
//dd($subSize);

    if ($subSize && $subSize->parent !== null) {
        $siblings = ModProductSizes::where('parent', $subSize->parent)->orderBy('ordering')->get();



        $currentIndex = $siblings->search(function ($item) use ($subSizeId) {
            return $item->id === $subSizeId;
        });

        if ($direction === 'up' && $currentIndex > 0) {
            $siblings[$currentIndex]->decrement('ordering');
            $siblings[$currentIndex - 1]->increment('ordering');
        } elseif ($direction === 'down' && $currentIndex < $siblings->count() - 1) {
            $siblings[$currentIndex]->increment('ordering');
            $siblings[$currentIndex + 1]->decrement('ordering');
        }
        $this->loadSizes();

   //    dd($siblings);
    }
    return $this->render();
}

public function editMainSize($mainSizeId)
{

    $mainSize = ModProductSizes::find($mainSizeId);
    dd($mainSize->title);

    // Überprüfe, ob $mainSize existiert, bevor du darauf zugreifst
    if ($mainSize) {
        $this->editingMainSize = true;
        $this->mainSizeToEdit = $mainSize;
        $this->newMainSizeTitle = $mainSize->title; // Füge diese Zeile hinzu, um den alten Titel im Formular anzuzeigen
    }
}

public function saveMainSize()
{


    if ($this->mainSizeToEdit) {
        // Überprüfen, ob die Hauptgröße existiert, bevor Sie darauf zugreifen
        $this->validate([
            'mainSizeToEdit.title' => 'required', // Hier die Validierungsregeln für den Titel
        ]);

        $mainSize = ModProductSizes::find($this->mainSizeToEdit->id); // Anpassung hier

        if ($mainSize) {
            $mainSize->title = $this->mainSizeToEdit->title; // Anpassung hier
            $mainSize->save();

            $this->editingMainSize = false; // Schließe das Bearbeitungsfeld nach dem Speichern
        }
    }

    $this->loadSizes();
}




    public function render()
    {
            //  $this->loadChildSizes(); // Lade die Child-Sizes beim Rendern der Seite
      $this->loadSizes(); // Lade die Größen beim Rendern der Seite

        return view('livewire.backend.seller.product-sizes.product-sizes-controller', [
            'sizes' => $this->sizes, // Übergebe die sortierten ChildSizes an das Blade-Template
        ]);



    }
}
