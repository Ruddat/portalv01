<?php

namespace App\Http\Controllers\Backend\Admin\ShopExportImport;

use App\Models\ModShop;
use App\Imports\ShopImport;
use Illuminate\Http\Request;
use App\Exports\FullShopDataExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelExcel;

class ShopInExDataController extends Controller
{
    /**
     * Zeigt das Formular zur Auswahl eines Shops und zum Hochladen einer Datei für den Import
     */
    public function index()
    {
        // Shops nach dem neuesten Erstellungsdatum sortiert laden
        $shops = ModShop::orderBy('created_at', 'desc')->get();
        return view('backend.pages.admin.shopexportimport.shop_data_index', compact('shops'));
    }

    /**
     * Exportiert die Shop-Daten in eine Excel-Datei.
     */
    public function export($shopId)
    {
        // Den Shop anhand der shopId abrufen
        $shop = ModShop::findOrFail($shopId);

        // Erstelle einen Dateinamen basierend auf dem Shop-Namen und der ID
        $fileName = $shop->title . '_shop_' . $shopId . '.xlsx';

        // Exportiere die Daten mit dem dynamischen Dateinamen
        return Excel::download(new FullShopDataExport($shopId), $fileName);
    }

    /**
     * Importiert die Daten aus einer hochgeladenen Excel-Datei.
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
            'shop_id' => 'required|exists:mod_shops,id',
        ]);

        // Starte den Multi-Sheet-Import mit Mapping
        Excel::import(new ShopImport($request->shop_id), $request->file('file'));

        return redirect()->back()->with('success', 'Daten erfolgreich importiert.');
    }
}
