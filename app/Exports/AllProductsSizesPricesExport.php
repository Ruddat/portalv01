<?php

namespace App\Exports;

use App\Models\ModProductSizesPrices;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class AllProductsSizesPricesExport implements FromCollection, WithHeadings, WithTitle
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
            'id',
            'parent',
            'size_id',
            'shop_id',
            'price',
            'visibility',
            'action_id',
            'action_price',
            'ordering',
            'created_at',
            'updated_at'
        ];
    }

    // Hier wird der Tabellenblattname angegeben
    public function title(): string
    {
        return 'ProductSizesPrices';  // Hier kannst du den gewünschten Blattnamen angeben
    }
}
