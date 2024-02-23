<?php

namespace App\Http\Controllers\Backend\Seller\Shop;

use App\Models\ModShop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ShopDataController extends Controller
{
    //
    public function restoData(Request $request)
    {
        $currentShopId = $request->route('shop');
        $id = $currentShopId; // Annahme: Falls es eine andere ID gibt
        $shop = ModShop::find($currentShopId);



return view('backend.pages.seller.shopdata.mod-shopdaten', [
    'currentShopId' => $currentShopId,
    'id' => $id,
    'shop' => $shop,
    // Weitere Daten hier hinzufügen, falls erforderlich
]);

    }

    public function changeLogoPictures(Request $request)
    {
        // Überprüfen, ob eine Datei hochgeladen wurde
        if ($request->hasFile('site_logo')) {
       //     $path = 'images/site/';
            // Pfad für den Bildupload basierend auf der Shop-ID zusammenstellen
            $path = 'uploads/shops/' . $request->session()->get('currentShopId') . '/images/';
            $file = $request->file('site_logo');

            // Eindeutigen Dateinamen generieren
            $filename = 'LOGO_IMG_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Datei verschieben und Überprüfen, ob der Vorgang erfolgreich war
            if ($file->move(public_path($path), $filename)) {
                // Wenn die Datei erfolgreich verschoben wurde, alte Datei löschen
                $shopId = session('currentShopId');
                $shop = ModShop::find($shopId);

                if (!$shop) {
                    return response()->json(['status' => 0, 'msg' => 'Shop not found.']);
                }

                $old_logo = $shop->logo;
                if ($old_logo != null && File::exists(public_path($path . $old_logo))) {
                    File::delete(public_path($path . $old_logo));
                }

                // Datenbank aktualisieren
                $shop->logo = $filename;
                $shop->save();

                // Erfolgreiche Antwort zurückgeben
                return response()->json(['status' => 1, 'msg' => 'Your logo has been successfully updated.']);
            } else {
                // Fehlermeldung, wenn Datei nicht verschoben werden konnte
                return response()->json(['status' => 0, 'msg' => 'Failed to upload file.']);
            }
        } else {
            // Fehlermeldung, wenn keine Datei hochgeladen wurde
            return response()->json(['status' => 0, 'msg' => 'No file uploaded.']);
        }
    }


}

