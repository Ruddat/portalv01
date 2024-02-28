<?php

namespace App\Livewire\Backend\Seller\Categories;

use Livewire\Component;
use App\Models\ModCategory;
use Illuminate\Support\Facades\Session;

class CategoriesSubcategoriesList extends Component
{
    public function render()
    {
        // Shop-ID aus der Session abrufen
        $currentShopId = Session::get('currentShopId');

        // Kategorien basierend auf der Shop-ID abrufen und nach 'ordering' sortieren
        $categories = ModCategory::where('shop_id', $currentShopId)->orderBy('ordering', 'ASC')->get();

        return view('livewire.backend.seller.categories.categories-subcategories-list', compact('categories'));
    }
}
