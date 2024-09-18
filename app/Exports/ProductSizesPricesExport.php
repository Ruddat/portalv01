<?php

namespace App\Exports;

use App\Models\ModProductSizesPrices;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductSizesPricesExport implements FromQuery, WithHeadings
{
    protected $shopId;

    public function __construct($shopId)
    {
        $this->shopId = $shopId;
    }

    // Methode zur Abfrage der Daten
    public function query()
    {
        return ModProductSizesPrices::query()->where('shop_id', $this->shopId);
    }

    // Kopfzeilen für die Excel-Datei
    public function headings(): array
    {
        return [
            'ID',
            'Parent',
            'Size ID',
            'Shop ID',
            'Price',
            'Visibility',
            'Action ID',
            'Action Price',
            'Ordering',
            'Created At',
            'Updated At'
        ];
    }
}
