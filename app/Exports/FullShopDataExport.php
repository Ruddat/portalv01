<?php

namespace App\Exports;

use App\Models\ModShop;
use App\Exports\AllProductsExport;
use App\Exports\AllCategoriesExport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class FullShopDataExport implements WithMultipleSheets
{
    protected $shopId;

    public function __construct($shopId)
    {
        $this->shopId = $shopId;
    }

    public function sheets(): array
    {
        return [
            'Categories' => new AllCategoriesExport($this->shopId),
            'Products' => new AllProductsExport($this->shopId),
            'Product Sizes' => new AllProductsSizesExport($this->shopId),
            'Product Sizes Prices' => new AllProductsSizesPricesExport($this->shopId),
            'Ingredients' => new AllProductsIngredientExport($this->shopId),
            'Ingredient Prices' => new AllProductsIngredientPricesExport($this->shopId),
            'Ingredients Nodes' => new AllProductsIngredientNodesExport($this->shopId),
        ];
    }
}
