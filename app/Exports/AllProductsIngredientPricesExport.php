<?php

namespace App\Exports;

use App\Models\ModProductsIngredientsPrices;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class AllProductsIngredientPricesExport implements FromCollection, WithHeadings
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
            'ID', 'Parent', 'Size ID', 'Shop ID', 'Price', 'Created At', 'Updated At'
        ];
    }
}
