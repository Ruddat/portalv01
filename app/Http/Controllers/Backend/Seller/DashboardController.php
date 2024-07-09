<?php

namespace App\Http\Controllers\Backend\Seller;

use App\Models\ModShop;
use App\Models\ModCategory;
use App\Models\ModProducts;
use App\Models\DeliveryArea;
use Illuminate\Http\Request;
use App\Models\ModProductSizes;
use App\Services\CopyShopService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\ModProductSizesPrices;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    //


    protected $copyShopService;

    public function __construct(CopyShopService $copyShopService)
    {
        $this->copyShopService = $copyShopService;
    }


    public function switchShop(Request $request)
    {
        // Hier kannst du Logik implementieren, um Daten abzurufen oder zu verarbeiten
        $id = $request->query('id');

        $currentShopId = $request->query('id');
        $shop = ModShop::find($request->query('id'));
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
        $ShopId = $request->query('id');

        $id = $request->query('id'); // Annahme: Falls es eine andere ID gibt
        $shop = ModShop::find($currentShopId);

        // Setzen der Shop-ID in der Sitzung
        Session::put('currentShopId', $currentShopId);
        Session::put('shop', $shop);
        Session::put('currentShopTitle', $shop->title); // Speichere den Shop-Titel in der Session

        return view('backend.pages.seller.dashboard-shop-edit', [
            'currentShopId' => $currentShopId,
            'id' => $id,
            'shop' => $shop,
           // 'shopid' => $shopId,
            // Weitere Daten hier hinzufügen, falls erforderlich
        ]);
    }


    public function copyShop(Request $request, ModShop $shop)
    {
        // Debugging-Ausgabe
        // Log::info('copyShop Methode aufgerufen', ['shop_id' => $shop->id, 'request' => $request->all()]);
        // dd('Method called', $shop->id, $request->all());

        $copyOptions = $request->input('copyOptions', [
            'shopData' => true,
            'logo' => true,
            'articles' => true,
            'openingHours' => true,
            'deliveryArea' => true,
            'orders' => false,
            'votes' => false,
        ]);


        try {
            // Weitere Debugging-Ausgabe
            // Log::info('Versuch den Shop zu kopieren', ['shop' => $shop, 'copyOptions' => $copyOptions]);

            // Den neuen Shop erstellen und Daten kopieren
            $newShop = $this->copyShopService->copyShop($shop->id, $copyOptions);

            // Debugging-Ausgabe nach Kopieren
            // Log::info('Shop kopiert', ['newShop' => $newShop]);
            // dd($newShop, $shop, $copyOptions); // Debugging-Ausgabe

            // Die Beziehung zwischen dem neuen Shop und dem aktuellen Verkäufer eintragen
            auth()->user()->shops()->attach($newShop->id);

            // Optional: Eine Benachrichtigung oder Bestätigung anzeigen
            return redirect()->back()->with('success', 'Shop erfolgreich kopiert.');
        } catch (\Exception $e) {
            Log::error('Fehler beim Kopieren des Shops', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Fehler beim Kopieren des Shops: ' . $e->getMessage());
        }
    }


    public function newcopyShop(Request $request, ModShop $shop)
    {

dd($copyOptions, $masterShop);


    // Ein neues Shop-Objekt erstellen und die Eigenschaften des Master-Shops kopieren


    // Den Master-Shop abrufen
    $masterShop = ModShop::findOrFail($shop->id);

    // Ein neues Shop-Objekt erstellen und die Eigenschaften des Master-Shops kopieren
    $newShop = new ModShop();
    $newShop->title = $masterShop->title . ' Ghost'; // Anpassen des Titels nach Bedarf
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

    $this->copyCategories($masterShop->id, $newShop->id);

    $this->copyProducts($masterShop->id, $newShop->id);
    // ProductSizes Copy
    $this->copyProductsSizes($masterShop->id, $newShop->id);
   // $this->copyProductSizesPrices($masterShop->id, $newShop->id);

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

    public function copyCategories($masterShopId, $newShopId)
    {
        // Kategorien des Master-Shops abrufen
        $masterCategories = ModCategory::where('shop_id', $masterShopId)->get();

        $imagePath = 'uploads/shops/';

        // Für jede Kategorie ein neues Objekt erstellen und kopieren
        foreach ($masterCategories as $category) {
            $newCategory = new ModCategory();
            $newCategory->shop_id = $newShopId;
            $newCategory->category_name = $category->category_name;
            $newCategory->category_description = $category->category_description;
            $newCategory->category_image = $category->category_image;
            $newCategory->category_image_from_gallery = $category->category_image_from_gallery;
            $newCategory->show_in_list = $category->show_in_list;
            $newCategory->ordering = $category->ordering;
            $newCategory->published = $category->published;


// Kopieren des Bildes, wenn ein Bild vorhanden ist
if ($category->category_image) {
    // Bildpfad des alten Bildes
    $oldImagePath = public_path($imagePath . $category->shop_id . '/images/category/' . $category->category_image);

    // Prüfen, ob das alte Bild existiert, bevor es kopiert wird
    if (file_exists($oldImagePath)) {
        // Neuer Bildpfad für das kopierte Bild im neuen Shop
        $newImagePath = public_path($imagePath . $newShopId . '/images/category/' . $category->category_image);

        // Erstellen des Verzeichnisses für das neue Shop-Bild, falls es nicht existiert
        if (!file_exists(dirname($newImagePath))) {
            mkdir(dirname($newImagePath), 0777, true);
        }

        // Kopieren des Bildes an den neuen Speicherort
        copy($oldImagePath, $newImagePath);

        // Speichern des Dateipfads des kopierten Bildes in der neuen Kategorie
        $newCategory->category_image = $category->category_image;
    }
}




            // Weitere Eigenschaften nach Bedarf kopieren
            $newCategory->save();
        }
    }

    public function copyProducts($masterShopId, $newShopId)
    {
        // Produkte des Master-Shops abrufen
        $masterProducts = ModProducts::where('shop_id', $masterShopId)->get();

// Kategorien des Master-Shops abrufen
$masterCategories = ModCategory::where('shop_id', $masterShopId)->get();

// Kategorien des neuen Shops abrufen
$newCategories = ModCategory::where('shop_id', $newShopId)->get();

// Array für die Zuordnung der alten Kategorie-ID zur neuen Kategorie-ID erstellen
$categoryIdMap = [];

// Schleife über die Kategorien des neuen Shops und fügen Sie die Zuordnung hinzu
foreach ($newCategories as $newCategory) {
    // Bestimmen der alten Kategorie-ID anhand des Kategoriennamens
    $oldCategoryId = $masterCategories->where('category_name', $newCategory->category_name)->first()->id;

    // Die Zuordnung zwischen alter und neuer Kategorie-ID erstellen
    $categoryIdMap[$oldCategoryId] = $newCategory->id;
}

// Debuggen, um sicherzustellen, dass das $categoryIdMap-Array richtig gefüllt ist
//dd($categoryIdMap);
// Festlegen des Bildpfads
$imagePath = 'uploads/shops/';

// Für jedes Produkt ein neues Objekt erstellen und kopieren
foreach ($masterProducts as $product) {
    $newProduct = new ModProducts();
    $newProduct->shop_id = $newShopId;

    // Bestimmen der neuen Kategorie-ID anhand der Zuordnungstabelle
    $newCategoryId = $categoryIdMap[$product->category_id] ?? null;

    // Wenn die neue Kategorie-ID gefunden wurde, setzen Sie sie, ansonsten überspringen Sie dieses Produkt
    if ($newCategoryId) {
        $newProduct->category_id = $newCategoryId;
        $newProduct->product_title = $product->product_title;
        $newProduct->product_description = $product->product_description;
        $newProduct->product_anonce = $product->product_anonce;
        $newProduct->base_price = $product->base_price;
        $newProduct->product_code = $product->product_code;
        $newProduct->product_image = $product->product_image;
        $newProduct->product_image_from_gallery = $product->product_image_from_gallery;
        $newProduct->product_amount = $product->product_amount;
        $newProduct->additives_ids = $product->additives_ids;
        $newProduct->allergens_ids = $product->allergens_ids;
        $newProduct->product_slug = $product->product_slug;
        $newProduct->product_date = $product->product_date;
        $newProduct->product_ordering = $product->product_ordering;
        $newProduct->produckt_show_in_list = $product->produckt_show_in_list;
        $newProduct->product_published = $product->product_published;
        $newProduct->deleted = $product->deleted;
        $newProduct->product_featured = $product->product_featured;
        $newProduct->product_parent = $product->product_parent;



        // Kopieren des Bildes, wenn ein Bild vorhanden ist
        if ($product->product_image) {
            // Bildpfad des alten Bildes
            $oldImagePath = public_path($imagePath . $product->shop_id . '/images/products/' . $product->product_image);

            // Prüfen, ob das alte Bild existiert, bevor es kopiert wird
            if (file_exists($oldImagePath)) {
                // Neuer Bildpfad für das kopierte Bild im neuen Shop
                $newImagePath = public_path($imagePath . $newShopId . '/images/products/' . $product->product_image);

                // Erstellen des Verzeichnisses für das neue Shop-Bild, falls es nicht existiert
                if (!file_exists(dirname($newImagePath))) {
                    mkdir(dirname($newImagePath), 0777, true);
                }

                // Kopieren des Bildes an den neuen Speicherort
                copy($oldImagePath, $newImagePath);

                // Speichern des Dateipfads des kopierten Bildes im neuen Produkt
                $newProduct->product_image = $product->product_image;
            }
        }


        // Weitere Eigenschaften nach Bedarf kopieren
        $newProduct->save();
    }
}

    }





    public function copyProductsSizes($masterShopId, $newShopId)
    {
        // Kopieren der Produktgrößen
        $masterProductSizes = ModProductSizes::where('shop_id', $masterShopId)->where('parent', 0)->get();

        // Array für die Zuordnung der alten Größen-ID zur neuen Größen-ID erstellen
        $sizeIdMap = [];

        foreach ($masterProductSizes as $masterProductSize) {
            // Duplizieren der Hauptgröße
            $newMainSize = $masterProductSize->replicate();
            $newMainSize->shop_id = $newShopId;
            $newMainSize->parent = 0; // Die Hauptgröße hat kein übergeordnetes Element mehr
            $newMainSize->save();

            // Zuordnung zwischen alter und neuer Hauptgröße erstellen
            $sizeIdMap[$masterProductSize->id] = $newMainSize->id;

            // Kopieren der zugehörigen Untergrößen für diese Hauptgröße
            $subSizes = ModProductSizes::where('parent', $masterProductSize->id)->get();

            // Überprüfen, ob Untergrößen vorhanden sind
            if ($subSizes->isNotEmpty()) {
                foreach ($subSizes as $subSize) {
                    // Duplizieren der Untergröße
                    $newSubSize = $subSize->replicate();
                    $newSubSize->shop_id = $newShopId;
                    $newSubSize->parent = $sizeIdMap[$masterProductSize->id]; // Verweisen auf die neue Hauptgröße
                    $newSubSize->save();

                    // Zuordnung zwischen alter und neuer Untergröße erstellen
                    $sizeIdMap[$subSize->id] = $newSubSize->id;
                }
            }
        }

// Neue Kategorien aus der Datenbank abrufen
$newCategoryCopy = ModCategory::where('shop_id', $newShopId)->get();

foreach ($newCategoryCopy as $category) {
    // Den Titel der Kategorie abrufen
    $categoryTitle = $category->category_name;

    // Neue Produktgröße aus der Datenbank abrufen, die den gleichen Titel hat wie die Kategorie
    $newProductSize = ModProductSizes::where('shop_id', $newShopId)
                                      ->where('parent', 0)
                                      ->where('title', $categoryTitle)
                                      ->first();

    // Wenn eine passende Produktgröße gefunden wurde, aktualisieren Sie die sizes_category-Spalte der Kategorie
    if ($newProductSize) {
        $category->sizes_category = $newProductSize->id; // ID der gefundenen Hauptgröße setzen
        $category->save(); // Änderungen speichern
    }
}



        // Optional: Eine Benachrichtigung oder Bestätigung anzeigen
        // return redirect()->back()->with('success', 'Produktgrößen erfolgreich kopiert.');
      //  dd($sizeIdMap, $newCategoryCopy, $newProductSizesCopy);

    }

    public function copyProductSizesPrices($masterShopId, $newShopId)
    {
        // Suchen nach Preisen der Produktgrößen und Kopieren in den neuen Shop
        ModProductSizesPrices::whereHas('size', function ($query) use ($masterShopId) {
            $query->where('shop_id', $masterShopId);
        })->get()->each(function ($price) use ($newShopId) {
            // Duplizieren des Preises und Aktualisieren des Shop-IDs
            $newPrice = $price->replicate();
            $newPrice->shop_id = $newShopId;
            $newPrice->save();
        });
    }






    public function getNewCategoryId($oldCategoryName, $newCategoryNames)
    {
        // Überprüfen Sie, ob der Kategorienname des alten Shops im Array der Kategorienamen des neuen Shops enthalten ist
        $index = array_search($oldCategoryName, $newCategoryNames);
        if ($index !== false) {
            // Wenn der Kategorienname gefunden wurde, geben Sie die entsprechende neue Kategorie-ID zurück
            return $index + 1; // Annahme: Die Kategorie-IDs beginnen bei 1 und erhöhen sich sequenziell
        } else {
            // Fallback: Wenn der Kategorienname nicht gefunden wurde, geben Sie eine Standard-Kategorie-ID zurück
            return DEFAULT_CATEGORY_ID;
        }
    }


    public function deleteShop(ModShop $shop)
    {
        // Den Shop aus der Datenbank abrufen und löschen
        ModShop::findOrFail($shop->id)->delete();

        // Optional: Eine Benachrichtigung oder Bestätigung anzeigen
        return redirect()->back()->with('success', 'Shop und zugehörige Daten erfolgreich gelöscht.');
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
