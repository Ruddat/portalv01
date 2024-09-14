<?php

namespace App\Exports;

use App\Models\ModProducts;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class AllProductsExport implements FromCollection, WithHeadings
{
    protected $shopId;

    public function __construct($shopId)
    {
        $this->shopId = $shopId;
    }

    public function collection()
    {
        return ModProducts::where('shop_id', $this->shopId)->get();
    }

    public function headings(): array
    {
        return [
            'ID', 'Shop ID', 'Category ID', 'Bottles ID', 'Product Code', 'Product Title', 'Product Anonce', 'Product Description', 'Base Price', 'Sales Count', 'Product Amount', 'Product Image', 'Product Image from Gallery', 'Additives IDS', 'Allergens IDS', 'Product Slug', 'Product Date', 'Ordering', 'Show in LIst', 'Published', 'Deleted', 'Featured', 'Parent', 'Created At', 'Updated At'
        ];
    }
}
