<?php

namespace App\Exports;

use App\Models\ModProductsIngredients;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class AllProductsIngredientExport implements FromCollection, WithHeadings
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
            'ID', 'Parent', 'Shop ID', 'Code Nr', 'Sizes Category', 'Max Spices', 'Base Price', 'Title', 'Count as Extra', 'Ordering', 'Published', 'Created At', 'Updated At'
        ];
    }
}
