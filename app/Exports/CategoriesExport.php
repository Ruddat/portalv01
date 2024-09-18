<?php

namespace App\Exports;

use App\Models\ModCategory;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class CategoriesExport implements FromCollection, WithHeadings, WithMapping
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
            'ID', 'Shop ID', 'Sizes Category', 'Category Name', 'Category Slug',
            'Category Image', 'Category Image From Gallery', 'Category Description',
            'Ordering', 'Show in List', 'Published', 'Parent', 'Created At', 'Updated At',
        ];
    }

    public function map($category): array
    {
        return [
            $category->id,
            $category->shop_id,
            $category->sizes_category,
            $category->category_name,
            $category->category_slug,
            $category->category_image,
            $category->category_image_from_gallery,
            $category->category_description,
            $category->ordering,
            $category->show_in_list,
            $category->published,
            $category->parent,
            $category->created_at,
            $category->updated_at,
        ];
    }
}
