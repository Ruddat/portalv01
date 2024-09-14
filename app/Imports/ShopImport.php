<?php

namespace App\Imports;

use App\Imports\CategoriesSheetImport;
use App\Imports\ProductsSheetImport;
use App\Imports\ProductSizesSheetImport;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ShopImport implements WithMultipleSheets
{
    protected $shopId;
    protected $categoryMap = [];
    protected $productMap = [];

    public function __construct($shopId)
    {
        $this->shopId = $shopId;
    }

    // Diese Methode definiert die verschiedenen Sheets, die importiert werden sollen
    public function sheets(): array
    {
        return [
            'Categories' => new CategoriesSheetImport($this->shopId, $this->categoryMap),
           // 'Products' => new ProductsSheetImport($this->shopId, $this->categoryMap, $this->productMap),
           // 'Product Sizes' => new ProductSizesSheetImport($this->shopId, $this->productMap),
            // Weitere Sheets können hier hinzugefügt werden
        ];
    }
}
