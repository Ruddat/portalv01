<?php

namespace App\Exports;

use App\Models\ModProductIngredientsNodes;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class AllProductsIngredientNodesExport implements FromCollection, WithHeadings
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
            'ID', 'Parent', 'Shop ID', 'Ingredients ID', 'Free Ingredients', 'Min Ingredients', 'Max Ingredients', 'Active', 'Created At', 'Updated At'
        ];
    }
}
