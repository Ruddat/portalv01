<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithTitle;
use App\Models\ModProductIngredientsNodes;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class AllProductsIngredientNodesExport implements FromCollection, WithHeadings, WithTitle
{
    protected $shopId;

    public function __construct($shopId)
    {
        $this->shopId = $shopId;
    }

    public function collection()
    {
        return ModProductIngredientsNodes::where('shop_id', $this->shopId)->get();
    }

    public function headings(): array
    {
        return [
            'id',
            'parent',
            'shop_id',
            'ingredients_id',
            'free_ingredients',
            'min_ingredients',
            'max_ingredients',
            'active',
            'created_at',
            'updated_at'
        ];
    }

    // Hier wird der Tabellenblattname angegeben
    public function title(): string
    {
        return 'ProductIngredientsNodes';  // Hier kannst du den gewünschten Blattnamen angeben
    }
}
