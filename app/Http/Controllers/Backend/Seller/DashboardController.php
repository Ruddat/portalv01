<?php

namespace App\Http\Controllers\backend\seller;

use App\Models\ModShop;
use App\Models\DeliveryArea;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    //

    public function switchShop(Request $request)
    {
        // Hier kannst du Logik implementieren, um Daten abzurufen oder zu verarbeiten
        $id = $request->query('id');

        $currentShopId = $request->query('id');
        $shop = ModShop::find($request->query('id'));
//dd($shop);
        // Setzen der Shop-ID in der Sitzung
        Session::put('currentShopId', $currentShopId);
        Session::put('currentShopTitle', $shop->title); // Speichere den Shop-Titel in der Session

     //   dd($request);
        return view('backend.pages.seller.dashboard-shop-edit', [
            'currentShopId' => $currentShopId,
            'id' => $id,
            'shop' => $shop,
            // Weitere Daten hier hinzufügen, falls erforderlich
        ]);

    }



    public function sellerDetails(Request $request)
    {
        // Hier kannst du Logik implementieren, um Daten abzurufen oder zu verarbeiten
        $currentShopId = $request->query('id');
        $id = $request->query('id'); // Annahme: Falls es eine andere ID gibt
        $shop = ModShop::find($currentShopId);

        // Setzen der Shop-ID in der Sitzung
        Session::put('currentShopId', $currentShopId);
        Session::put('shop', $shop);
        Session::put('currentShopTitle', $shop->title); // Speichere den Shop-Titel in der Session
//dd($currentShopId, $id, $shop);



        return view('backend.pages.seller.dashboard-shop-edit', [
            'currentShopId' => $currentShopId,
            'id' => $id,
            'shop' => $shop,
            // Weitere Daten hier hinzufügen, falls erforderlich
        ]);
    }


    public function copyShop(ModShop $shop)
    {
    // Den Master-Shop abrufen
    $masterShop = ModShop::findOrFail($shop->id);

    // Ein neues Shop-Objekt erstellen und die Eigenschaften des Master-Shops kopieren
    $newShop = new ModShop();
    $newShop->title = $masterShop->title . ' Copy'; // Anpassen des Titels nach Bedarf
    $newShop->street = $masterShop->street;
    $newShop->zip = $masterShop->zip;
    $newShop->city = $masterShop->city;
    $newShop->phone = $masterShop->phone;
    $newShop->email = $masterShop->email;
    $newShop->progress = $masterShop->progress;
    $newShop->published = $masterShop->published;
    $newShop->status  = $masterShop->status;
    $newShop->lat = $masterShop->lat;
    $newShop->lng = $masterShop->lng;


    // Weitere Eigenschaften des neuen Shops setzen, indem du sie vom Master-Shop kopierst
    // Beispiel: $newShop->property_name = $masterShop->property_name;

    // Eindeutige Shop-Nummer generieren und setzen
    $timestamp = now()->format('ymdHi');
    $randomNumber = mt_rand(10, 99);
    $uniqueShopNumber = sprintf('%s-%s', $timestamp, $randomNumber);
    $newShop->shop_nr = $uniqueShopNumber;

    // Speichern des neuen Shop-Objekts
    $newShop->save();

    // Die Beziehung zwischen dem neuen Shop und dem aktuellen Verkäufer eintragen
    auth()->user()->shops()->attach($newShop->id);

    // Aufruf der Funktion copyDeliveryArea mit den IDs des Master-Shops und des neuen Shops
    $this->copyDeliveryArea($masterShop->id, $newShop->id);

    // Optional: Eine Benachrichtigung oder Bestätigung anzeigen
    return redirect()->back()->with('success', 'Shop erfolgreich kopiert.');
    // Aufruf der Funktion copyDeliveryArea
   // $this->copyDeliveryArea($newShop);

    }

    public function copyDeliveryArea($masterShopId, $newShopId)
    {
        // Den Master-Shop abrufen
        $masterShop = ModShop::findOrFail($masterShopId);

        // Das Liefergebiet des Master-Shops abrufen
        $masterDeliveryArea = DeliveryArea::where('shop_id', $masterShopId)->get();

        // Für jedes Liefergebiet des Master-Shops ein neues Liefergebiet erstellen und kopieren
        foreach ($masterDeliveryArea as $deliveryArea) {
            $newDeliveryArea = new DeliveryArea();
            $newDeliveryArea->shop_id = $newShopId;
            $newDeliveryArea->distance_km = $deliveryArea->distance_km;
            $newDeliveryArea->delivery_cost = $deliveryArea->delivery_cost;
            $newDeliveryArea->delivery_charge = $deliveryArea->delivery_charge;
            $newDeliveryArea->free_delivery_threshold = $deliveryArea->free_delivery_threshold;
            $newDeliveryArea->latitude = $deliveryArea->latitude;
            $newDeliveryArea->longitude = $deliveryArea->longitude;
            $newDeliveryArea->radius = $deliveryArea->radius;
            $newDeliveryArea->color = $deliveryArea->color;
            $newDeliveryArea->save();
        }

        // Optional: Eine Benachrichtigung oder Bestätigung anzeigen
        return redirect()->back()->with('success', 'Liefergebiet erfolgreich kopiert.');
    }



    public function deleteShop(ModShop $shop)
{
    // Den Shop aus der Datenbank abrufen
    $shopToDelete = ModShop::findOrFail($shop->id);

    // Den Shop löschen
    $shopToDelete->delete();

    // Optional: Eine Benachrichtigung oder Bestätigung anzeigen
    return redirect()->back()->with('success', 'Shop erfolgreich gelöscht.');
}


public function deliveryArea(Request $request, $shop)
{


  //  $shop = ModShop::find($request->query('id'));


    // Verwende den Wert von $shop als currentShopId
    $currentShopId = $shop;
//dd($currentShopId);
    // Verwende $currentShopId, um den Wert von $id zu setzen (optional)
    $id = $currentShopId;

    // Setze die aktuelle Shop-ID in der Sitzung, um sie später zu verwenden
    session(['currentShopId' => $id]);

    // Debugging: Gib $currentShopId und $id aus, um sicherzustellen, dass sie korrekt initialisiert wurden
//    dd($currentShopId, $id);
    // Gib die Ansicht mit den erforderlichen Daten zurück
    return view('backend.pages.shops.mod-liefergebiet', [
        'currentShopId' => $currentShopId,
        'id' => $id,
        'shop' => $shop,
        // Weitere Daten hier hinzufügen, falls erforderlich
    ]);
}

}
