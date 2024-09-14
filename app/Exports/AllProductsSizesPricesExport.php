<?php

namespace App\Exports;

use App\Models\ModProductSizesPrices;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class AllProductsSizesPricesExport implements FromCollection, WithHeadings
{
    protected $shopId;

    public function __construct($shopId)
    {
        $this->shopId = $shopId;
    }

    public function collection()
    {
        return ModProductSizesPrices::where('shop_id', $this->shopId)->get();
    }

    public function headings(): array
    {
        return [
            'ID', 'Parent', 'Size ID', 'Price', 'Visibility', 'Action ID', 'Action Price', 'Ordering', 'Created At', 'Updated At'
        ];
    }
}
