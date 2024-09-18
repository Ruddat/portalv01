<?php

namespace App\Exports;

use App\Models\ModProductsIngredients;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class AllProductsIngredientExport implements FromCollection, WithHeadings, WithTitle
{
    protected $shopId;

    public function __construct($shopId)
    {
        $this->shopId = $shopId;
    }

    public function collection()
    {
        return ModProductsIngredients::where('shop_id', $this->shopId)->get();
    }

    public function headings(): array
    {
        return [
            'id',
            'parent',
            'shop_id',
            'code_nr',
            'sizes_category',
            'max_spices',
            'base_price',
            'title',
            'count_as_extra',
            'ordering',
            'published',
            'created_at',
            'updated_at'
        ];
    }

    // Hier wird der Tabellenblattname angegeben
    public function title(): string
    {
        return 'ProductsIngredients';  // Hier kannst du den gewünschten Blattnamen angeben
    }
}
