<?php

namespace App\Livewire\Backend\Seller\Categories;

use Livewire\Component;
use App\Models\ModCategory;
use App\Models\ModProducts;
use Illuminate\Support\Facades\Session;

class CategoriesSubcategoriesList extends Component
{

    protected $listeners = [
        'updateCategoriesOrdering'
    ];

    public function updateCategoriesOrdering($positions){

        dd($positions);

        foreach($positions as $position){
            ModCategory::where('id', $position['value'])->update(['ordering' => $position['order']]);
        }
    }

    public function render()
    {
        // Shop-ID aus der Session abrufen
        $currentShopId = Session::get('currentShopId');

        // Kategorien basierend auf der Shop-ID abrufen und nach 'ordering' sortieren
        $categories = ModCategory::where('shop_id', $currentShopId)->orderBy('ordering', 'ASC')->get();

        // Anzahl der Produkte für jede Kategorie abrufen und in ein Array speichern
        $productCounts = ModProducts::where('shop_id', $currentShopId)
            ->whereIn('category_id', $categories->pluck('id'))
            ->groupBy('category_id')
            ->selectRaw('category_id, count(*) as count')
            ->get()
            ->pluck('count', 'category_id');

        return view('livewire.backend.seller.categories.categories-subcategories-list', compact('categories', 'productCounts'));
    }
}
