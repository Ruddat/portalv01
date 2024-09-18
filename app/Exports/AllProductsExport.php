<?php

namespace App\Exports;

use App\Models\ModProducts;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class AllProductsExport implements FromCollection, WithHeadings, WithTitle
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
            'id',
            'shop_id',
            'category_id',
            'size_id',
            'bottles_id',
            'product_code',
            'product_title',
            'product_anonce',
            'product_description',
            'base_price',
            'sales_count',
            'product_amount',
            'product_image',
            'product_image_from_gallery',
            'additives_ids',
            'allergens_ids',
            'product_slug',
            'product_date',
            'product_ordering',
            'produckt_show_in_list',
            'product_published',
            'deleted',
            'product_featured',
            'product_parent',
            'created_at',
            'updated_at'
        ];
    }

    // Hier wird der Tabellenblattname angegeben
    public function title(): string
    {
        return 'Products';  // Hier kannst du den gewünschten Blattnamen angeben
    }
}
