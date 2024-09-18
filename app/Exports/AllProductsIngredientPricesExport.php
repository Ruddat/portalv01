<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithTitle;
use App\Models\ModProductsIngredientsPrices;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class AllProductsIngredientPricesExport implements FromCollection, WithHeadings, WithTitle
{
    protected $shopId;

    public function __construct($shopId)
    {
        $this->shopId = $shopId;
    }

    public function collection()
    {
        return ModProductsIngredientsPrices::where('shop_id', $this->shopId)->get();
    }

    public function headings(): array
    {
        return [
            'id',
            'parent',
            'size_id',
            'shop_id',
            'price',
            'created_at',
            'updated_at'
        ];
    }

    // Hier wird der Tabellenblattname angegeben
    public function title(): string
    {
        return 'ProductsIngredientsPrices';  // Hier kannst du den gewünschten Blattnamen angeben
    }
}
