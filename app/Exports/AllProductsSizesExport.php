<?php

namespace App\Exports;


use App\Models\ModProductSizes;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class AllProductsSizesExport implements FromCollection, WithHeadings
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
            'ID', 'Shop ID', 'Parent', 'Title', 'Date', 'Ordering', 'Published', 'Current', 'Display', 'Created At', 'Updated At'
        ];
    }
}
