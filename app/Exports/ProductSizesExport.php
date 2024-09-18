<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\ModProductSizes;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductSizesExport implements FromQuery, WithHeadings, WithMapping // Implementiert WithMapping
{
    protected $shopId;

    public function __construct($shopId)
    {
        $this->shopId = $shopId;
    }

    // Methode zur Abfrage der Daten
    public function query()
    {
        return ModProductSizes::query()->where('shop_id', $this->shopId);
    }

    // Kopfzeilen für die Excel-Datei
    public function headings(): array
    {
        return [
            'ID',
            'Shop ID',
            'Parent',
            'Product ID',
            'Title',
            'Date',
            'Ordering',
            'Published',
            'Current',
            'Display',
            'Created At',
            'Updated At'
        ];
    }

    // Methode zum Mapping der Daten (Anpassen der Ausgabe)
    public function map($row): array
    {
        return [
            $row->id,
            $row->shop_id,
            $row->parent ? $row->parent : 'None', // Null-Wert für Parent behandeln
            $row->product_id,
            $row->title,
            Carbon::parse($row->date)->format('d-m-Y H:i:s'), // Datum formatieren
            $row->ordering,
            $row->published,
            $row->current,
            $row->display,
            Carbon::parse($row->created_at)->format('d-m-Y H:i:s'), // Created At formatieren
            Carbon::parse($row->updated_at)->format('d-m-Y H:i:s')  // Updated At formatieren
        ];
    }
}
