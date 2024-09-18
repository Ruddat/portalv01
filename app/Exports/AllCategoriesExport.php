<?php

namespace App\Exports;

use App\Models\ModCategory;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;

class AllCategoriesExport implements FromCollection, WithHeadings, WithTitle
{
    protected $shopId;

    public function __construct($shopId)
    {
        $this->shopId = $shopId;
    }

    public function collection()
    {
        return ModCategory::where('shop_id', $this->shopId)->get();
    }

    public function headings(): array
    {
        return [
            'id',
            'shop_id',
            'sizes_category',
            'category_name',
            'category_slug',
            'category_image',
            'category_image_from_gallery',
            'category_description',
            'ordering',
            'show_in_list',
            'published',
            'parent',
            'created_at',
            'updated_at'
        ];
    }

    // Hier wird der Tabellenblattname angegeben
    public function title(): string
    {
        return 'Categories';  // Hier kannst du den gewünschten Blattnamen angeben
    }
}
