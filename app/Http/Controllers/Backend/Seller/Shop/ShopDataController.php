<?php

namespace App\Http\Controllers\Backend\Seller\Shop;

use App\Models\ModShop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Console\View\Components\Alert;

class ShopDataController extends Controller
{
    //
    public function restoData(Request $request)
    {
        $currentShopId = $request->route('shop');
        $id = $currentShopId; // Annahme: Falls es eine andere ID gibt
        $shop = ModShop::find($currentShopId);

        $url = URL::to('api/v1/GetNewOrders');

return view('backend.pages.seller.shopdata.mod-shopdaten', [
    'currentShopId' => $currentShopId,
    'id' => $id,
    'shop' => $shop,
    'url' => $url,
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


    public function changeShopDataRestApi(Request $request)
    {

 //       dd($request->all());

        // Überprüfen, ob die erforderlichen Daten vorhanden sind
        if ($request->has('transfer_type') && $request->has('username') && $request->has('password')) {

            $request->validate([
                'transfer_type' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        if ($value === 'Choose...') {
                            $fail('The transfer type field must be selected.');
                        }
                    },
                ],
                'username' => 'required',
                'password' => 'required',
            ]);

            // Shopdaten aktualisieren
            $shopId = session('currentShopId');
            $shop = ModShop::find($shopId);

//dd($shop);

            if (!$shop) {
                return response()->json(['status' => 0, 'msg' => 'Shop not found.']);
            }

            $shop->transfer = $request->transfer_type;
            $shop->api_username = $request->username;
            $shop->api_password = $request->password;

            // Speichern der aktualisierten Daten
            $shop->save();

            return redirect()->back()->with('success', 'Your shop data has been successfully updated.');

            // Erfolgreiche Antwort zurückgeben
            return response()->json(['status' => 1, 'msg' => 'Your shop data has been successfully updated.']);
        } else {
            // Fehlermeldung, wenn nicht alle erforderlichen Daten vorhanden sind
            return response()->json(['status' => 0, 'msg' => 'Please provide all required data.']);
        }
    }


}

