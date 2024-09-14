<?php

namespace App\Http\Controllers\Backend\Admin\ShopExportImport;

use App\Models\ModShop;
use Illuminate\Http\Request;
use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use App\Exports\CategoriesExport;
use App\Imports\CategoriesImport;
use App\Exports\ProductSizesExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductSizesPricesExport;
use Maatwebsite\Excel\Excel as ExcelExcel;

class DataController extends Controller
{
    public function exportCategories($shopId)
    {
        return Excel::download(new CategoriesExport($shopId), 'categories_'.$shopId.'.xlsx');
    }

    public function exportProducts($shopId)
    {
        return Excel::download(new ProductsExport($shopId), 'products_'.$shopId.'.xlsx');
    }

    public function exportProductSizes($shopId)
    {
        return Excel::download(new ProductSizesExport($shopId), 'product_sizes_'.$shopId.'.xlsx');
    }

    public function exportProductSizesPrices($shopId)
{
    return Excel::download(new ProductSizesPricesExport($shopId), 'product_sizes_prices_'.$shopId.'.xlsx');
}



    public function importCategories(Request $request, $newShopId)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx'
        ]);

        Excel::import(new CategoriesImport($newShopId), $request->file('file'));

        return redirect()->back()->with('success', 'Categories imported successfully.');
    }

    public function importProducts(Request $request, $newShopId)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx'
        ]);

        Excel::import(new ProductsImport($newShopId), $request->file('file'));

        return redirect()->back()->with('success', 'Products imported successfully.');
    }

// Diese Methode lädt alle Shops, sortiert nach dem neuesten zuerst
public function showExportImportView()
{
    // Abrufen aller Shops, sortiert nach dem Erstellungsdatum (neueste zuerst)
    $shops = ModShop::orderBy('created_at', 'desc')->get();

    return view('backend.pages.admin.shopexportimport.export_import', compact('shops'));
}

}
