<?php

namespace App\Exports;


use App\Models\ModProductSizes;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class AllProductsSizesExport implements FromCollection, WithHeadings, WithTitle
{
    protected $shopId;

    public function __construct($shopId)
    {
        $this->shopId = $shopId;
    }

    public function collection()
    {
        return ModProductSizes::where('shop_id', $this->shopId)->get();
    }

    public function headings(): array
    {
        return [
            'id',
            'shop_id',
            'parent',
            'title',
            'date',
            'ordering',
            'published',
            'current',
            'display',
            'created_at',
            'updated_at'
        ];
    }

    // Hier wird der Tabellenblattname angegeben
    public function title(): string
    {
        return 'ProductSizes';  // Hier kannst du den gewünschten Blattnamen angeben
    }
}
