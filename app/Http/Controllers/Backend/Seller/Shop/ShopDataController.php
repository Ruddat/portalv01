<?php

namespace App\Http\Controllers\Backend\Seller\Shop;

use App\Models\ModShop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ShopDataController extends Controller
{
    /**
     * Zeigt die Shopdaten an.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
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


    /**
     * Ändert das Logo des Shops.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeLogoPictures(Request $request)
    {
        if ($request->hasFile('site_logo')) {
            $path = 'uploads/shops/' . $request->session()->get('currentShopId') . '/images/';
            $file = $request->file('site_logo');
            $filename = 'LOGO_IMG_' . uniqid() . '.' . $file->getClientOriginalExtension();

            if ($file->move(public_path($path), $filename)) {
                $shopId = session('currentShopId');
                $shop = ModShop::find($shopId);

                if (!$shop) {
                    return response()->json(['status' => 0, 'msg' => 'Shop not found.']);
                }

                $old_logo = $shop->logo;
                if ($old_logo != null && File::exists(public_path($path . $old_logo))) {
                    File::delete(public_path($path . $old_logo));
                }

                $shop->logo = $filename;
                $shop->save();

                return response()->json(['status' => 1, 'msg' => 'Your logo has been successfully updated.']);
            } else {
                return response()->json(['status' => 0, 'msg' => 'Failed to upload file.']);
            }
        } else {
            return response()->json(['status' => 0, 'msg' => 'No file uploaded.']);
        }
    }


    /**
     * Ändert die Shopdaten für die REST-API.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function changeShopDataRestApi(Request $request)
    {
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

            $shopId = session('currentShopId');
            $shop = ModShop::find($shopId);

            if (!$shop) {
                return response()->json(['status' => 0, 'msg' => 'Shop not found.']);
            }

            $shop->transfer = $request->transfer_type;
            $shop->api_username = $request->username;
            $shop->api_password = $request->password;

            $shop->save();

            return redirect()->back()->with('success', 'Your shop data has been successfully updated.');
        } else {
            return response()->json(['status' => 0, 'msg' => 'Please provide all required data.']);
        }
    }
}

// Path: app/Http/Controllers/Backend/Seller/Shop/ShopDataController.php
