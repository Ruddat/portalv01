<?php

namespace App\Exports;

use App\Models\ModProducts;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductsExport implements FromCollection, WithHeadings, WithMapping
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
            'ID', 'Shop ID', 'Category ID', 'Bottles ID', 'Product Code', 'Product Title',
            'Product Anonce', 'Product Description', 'Base Price', 'Sales Count', 'Product Amount',
            'Product Image', 'Product Image From Gallery', 'Additives IDs', 'Allergens IDs',
            'Product Slug', 'Product Date', 'Product Ordering', 'Product Show in List',
            'Product Published', 'Deleted', 'Product Featured', 'Product Parent', 'Created At', 'Updated At',
        ];
    }

    public function map($product): array
    {
        return [
            $product->id,
            $product->shop_id,
            $product->category_id,
            $product->bottles_id,
            $product->product_code,
            $product->product_title,
            $product->product_anonce,
            $product->product_description,
            $product->base_price,
            $product->sales_count,
            $product->product_amount,
            $product->product_image,
            $product->product_image_from_gallery,
            $product->additives_ids,
            $product->allergens_ids,
            $product->product_slug,
            $product->product_date,
            $product->product_ordering,
            $product->produckt_show_in_list,
            $product->product_published,
            $product->deleted,
            $product->product_featured,
            $product->product_parent,
            $product->created_at,
            $product->updated_at,
        ];
    }
}
