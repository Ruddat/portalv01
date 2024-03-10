<?php

namespace App\Http\Controllers\Backend\Seller\Products;

use App\Models\ModBottles;
use App\Models\ModCategory;
use App\Models\ModProducts;
use App\Models\ModAdditives;
use App\Models\ModAllergens;
use Illuminate\Http\Request;
use App\Rules\UniqueArticleNo;
use App\Models\ModProductSizes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Models\ModProductSizesPrices;


class ProductController extends Controller
{
    //
    public function productsList(Request $request)
    {
        // Abrufen der Shop-ID, Menu-ID und Kategorie-ID aus dem Request
        $shopId = $request->shopId;
        $menuId = $request->menuId;
        $categoryId = $request->categoryId;

        // Überprüfen, ob alle erforderlichen IDs vorhanden sind
        if (!$shopId || !$categoryId) {
            // Hier kann eine Fehlerbehandlung durchgeführt werden, falls benötigt
            return back()->with('error', 'Missing Shop ID, Menu ID, or Category ID.');
        }

        $products = ModProducts::where('shop_id', $shopId)
        ->where('category_id', $categoryId)
        ->orderBy('product_ordering')
        ->with(['productSizesPrices' => function ($query) {
            $query->orderBy('ordering', 'asc'); // Sortiere die Preise nach der Bestellung aufsteigend
        }, 'productSizesPrices.size']) // Lade die Beziehung zu den Größen
        ->get();
        // Weitergeben der IDs und Produkte an die Ansicht
        return view('backend.pages.seller.products.products-list', compact('shopId', 'menuId', 'categoryId', 'products'));
    }




    public function addProduct(Request $request)
    {
        // Abrufen der Shop-ID, Menu-ID und Kategorie-ID aus dem Request
        $shopId = $request->shopId;
        $menuId = $request->menuId;
        $categoryId = $request->categoryId;

        // Überprüfen, ob alle erforderlichen IDs vorhanden sind
        if (!$shopId || !$categoryId) {
            // Hier kann eine Fehlerbehandlung durchgeführt werden, falls benötigt
            return back()->with('error', 'Missing Shop ID, Menu ID, or Category ID.');
        }

        $currentCategory = ModCategory::findOrFail($categoryId);

        // Abrufen der aktuellen Produktgrößen für die angegebene Kategorie
        $currentProductSizes = ModProductSizes::where('parent', 0)
            ->where('shop_id', $shopId)
            ->where('id', $currentCategory->sizes_category) // Hier wird die Kategorie-ID verwendet
            ->orderBy('ordering')
            ->get();

        $data = [
            'pageTitle' => 'Add Product',
            'currentCategory' => $currentCategory, // Die aktuelle Kategorie an die Ansicht übergeben
        ];

        // Abrufen der Bottles, Additives und Allergene aus der Datenbank
        $bottles = ModBottles::all();
        $additives = ModAdditives::all();
        $allergens = ModAllergens::all();

        // Die Bottles, Additives, Allergene und aktuellen Produktgrößen an die View übergeben
        return view('backend.pages.seller.products.add-product', $data, compact('bottles', 'additives', 'shopId', 'menuId', 'categoryId', 'allergens', 'currentProductSizes'));
    }



    public function storeProduct(Request $request)
    {

        // Validierung der Formulardaten
        $request->validate([
            'product_article_no' => [new UniqueArticleNo], // benutzerdefinierte Regel, die 0-Werte zulässt und sicherstellt, dass die Artikelnummer eindeutig ist
            'product_title' => 'required',
            'product_description' => 'required',
            'product_short_description' => 'required|min:5',
            'base_price' => 'required|numeric|min:0.00',
            // Weitere Validierungsregeln hier hinzufügen
        ], [
            // fehlermeldungen in deutsch
            'product_article_no.unique_article_no' => 'The article number is already in use.',
            'product_article_no.required' => 'The article number is required.',
            'product_title.required' => 'The product title is required.',
            'product_description.required' => 'The product description is required.',
            'product_short_description.required' => 'The product short description is required.',
            'base_price.required' => 'The base price is required.',
            'base_price.numeric' => 'The base price must be a number.',
            'base_price.min' => 'The base price must be at least 0.01.',
        ]);

        // Abrufen der Shop-ID und Kategorie-ID aus dem Formular
        $shopId = $request->input('shop_id');
        $categoryId = $request->input('category_id');

        // Überprüfen, ob die Shop-ID und Kategorie-ID vorhanden sind
        if (!$shopId || !$categoryId) {
            return back()->with('error', 'Shop ID or Category ID not provided.');
        }

        // Speichern Sie die Produktinformationen in der Datenbank
        $product = new ModProducts();
        $product->shop_id = $shopId;
        $product->category_id = $categoryId;
        $product->product_title = $request->input('product_title');
        $product->product_description = $request->input('product_description');
        $product->product_anonce = $request->input('product_short_description');
        $product->base_price = $request->input('base_price');
        $product->product_code = $request->input('product_article_no');
        $product->bottles_id = $request->input('bottle_id');
        $product->product_published = $request->input('product_published');

        // Speichern der ausgewählten Allergene als JSON
        $product->allergens_ids = json_encode($request->input('allergens'));
        // Speichern der ausgewählten Zusatzstoffe als JSON
        $product->additives_ids = json_encode($request->input('additives'));
        $product->save();

        // Produkt-ID des gerade gespeicherten Produkts
        $productId = $product->id;

     //   dd($request->all());

// Durchlaufen der Eingaben und Speichern der Preise in die Datenbank
foreach ($request->all() as $key => $value) {
    // Überprüfen, ob das Feld mit 'product_price_' beginnt
    if (strpos($key, 'product_price_') === 0) {
        // Extrahieren der Größen-ID aus dem Schlüssel
        $sizeId = str_replace('product_price_', '', $key);

        // Überprüfen, ob der Preis größer als 0 ist
        if ($value > 0) {
            // Speichern des Preises in die Datenbank
            ModProductSizesPrices::create([
                'parent' => $productId, // ID des gerade gespeicherten Produkts
                'size_id' => $sizeId,
                'shop_id' => $shopId,
                'price' => $value,
                // Weitere Felder entsprechend der Tabelle
            ]);
        }
    }
}

        // Speichern des Produktbildes, falls vorhanden
        if ($request->hasFile('product_image')) {
            $path = 'uploads/shops/' . $shopId . '/images/products/';
            $file = $request->file('product_image');
            $filename = time() . '_' . $file->getClientOriginalName();

            if ($file->move(public_path($path), $filename)) {
                $product->product_image = $filename;
                $product->save();
            } else {
                return redirect()->back()->with('error', 'Error uploading product image');
            }
        }

        // Weiterleiten oder eine Bestätigungsnachricht anzeigen
        return redirect()->back()->with('success', ucfirst($product->product_title) . ' product created successfully.');
    }




    public function editProduct(Request $request)
    {
        // Abrufen der Shop-ID, Menu-ID, Kategorie-ID und Produkt-ID aus dem Request
        $shopId = $request->shopId;
        $menuId = $request->menuId;
        $categoryId = $request->categoryId;
        $productId = $request->productId;

        // Überprüfen, ob alle erforderlichen IDs vorhanden sind
        if (!$shopId || !$categoryId || !$productId) {
            // Hier kann eine Fehlerbehandlung durchgeführt werden, falls benötigt
            return back()->with('error', 'Missing Shop ID, Menu ID, Category ID, or Product ID.');
        }

        // Produkt aus der Datenbank abrufen
        $product = ModProducts::findOrFail($productId);

        // Bottles und Additives aus der Datenbank abrufen
        $bottles = ModBottles::all();
        $additives = ModAdditives::all();
        $allergens = ModAllergens::all();

// Vorhandene Preise für das Produkt abrufen
$productPrices = $product->productSizesPrices()->with('size')->get();


// ID der Zeile, deren Spaltenwert Sie abrufen möchten
//$categoryId = 2;



    // Überprüfen, ob die Kategorie gefunden wurde

$currentCategory = ModCategory::findOrFail($categoryId);


        // Abrufen der aktuellen Produktgrößen für die angegebene Kategorie
        $currentProductSizes = ModProductSizes::where('parent', 0)
            ->where('shop_id', $shopId)
            ->where('id', $currentCategory->sizes_category) // Hier wird die Kategorie-ID verwendet
            ->orderBy('ordering')
            ->get();

        //dd($currentProductSizes);

        // Eine Liste aller Größen für das Produkt erstellen
        $sizes = ModProductSizes::where('parent', $currentCategory->sizes_category)->get();

//dd($sizes);

        // Laden der ausgewählten Additive und Allergene aus der Datenbank
        $selectedAdditives = json_decode($product->additives_ids);
        $selectedAllergens = json_decode($product->allergens_ids);

        // Überprüfen, ob die Decodierung erfolgreich war und die Variablen Arrays sind
        if (is_array($selectedAdditives) && is_array($selectedAllergens)) {
            // Die Arrays von Zeichenketten in Arrays von IDs umwandeln
            $selectedAdditives = array_map('intval', $selectedAdditives);
            $selectedAllergens = array_map('intval', $selectedAllergens);
        } else {
            // Fehlerbehandlung, falls die Decodierung fehlschlägt
            $selectedAdditives = [];
            $selectedAllergens = [];
        }

    // Die Bottles, Additives, Preise und Produkt an die View übergeben
    return view('backend.pages.seller.products.edit-product', compact('shopId', 'selectedAllergens', 'selectedAdditives', 'menuId', 'categoryId', 'product', 'bottles', 'additives', 'allergens', 'productId', 'productPrices', 'sizes'));

    }



    public function updateProduct(Request $request)
    {

      //  dd($request->all());

        $productId = $request->product_id;

        // Validierung der Formulardaten
        $rules = [
            'product_title' => 'required',
            'product_description' => 'required',
            // Weitere Validierungsregeln hier hinzufügen
        ];

        // Überprüfen, ob sich die Artikelnummer ändert
        if ($request->input('product_code') != $request->old('product_code')) {
            // Artikelnummer hat sich geändert, füge die Validierungsregel hinzu
            $rules['product_code'] = [new UniqueArticleNo($request->productId)];
        }

        $request->validate($rules);

        // Abrufen der Shop-ID und Kategorie-ID aus dem Formular
        $shopId = $request->input('shop_id');
        $categoryId = $request->input('category_id');

        // Überprüfen, ob die Shop-ID und Kategorie-ID vorhanden sind
        if (!$shopId || !$categoryId) {
            return back()->with('error', 'Shop ID or Category ID not provided.');
        }
//dd($request->product_id, $request->all());

        // Produkt aus der Datenbank abrufen
        $product = ModProducts::findOrFail($request->product_id);

        // Produktinformationen aktualisieren
        $product->shop_id = $shopId;
        $product->category_id = $categoryId;
        $product->product_title = $request->input('product_title');
        $product->product_description = $request->input('product_description');
        $product->product_anonce = $request->input('product_short_description');
        $product->product_code = $request->input('product_article_no');
        $product->base_price = $request->input('product_basic_price');
        $product->product_published = $request->input('product_published');
        $product->bottles_id = $request->input('bottle_id');
        // Speichern der ausgewählten Allergene als Array
        $selectedAllergens = $request->input('allergens'); // Ein Array von ausgewählten Allergenen
        $product->allergens_ids = json_encode($selectedAllergens); // Speichern Sie das Array als JSON

        // Speichern der ausgewählten Allergene als Array
        $selectedAdditives = $request->input('additives'); // Ein Array von ausgewählten Allergenen
        $product->additives_ids = json_encode($selectedAdditives); // Speichern Sie das Array als JSON


// Durchlaufen der Eingaben und Speichern der Preise in die Datenbank
foreach ($request->prices as $sizeId => $price) {
    // Überprüfen, ob der Preis nicht null ist
    if ($price !== null) {
        ModProductSizesPrices::updateOrCreate(
            ['parent' => $product->id, 'size_id' => $sizeId],
            ['shop_id' => $request->shop_id, 'price' => $price]
        );
    } else {
        // Preis ist null, Modellobjekt löschen
        ModProductSizesPrices::where('parent', $product->id)
            ->where('size_id', $sizeId)
            ->delete();
    }
}





        // Wenn ein neues Bild hochgeladen wurde oder das Bild entfernt werden soll
        if ($request->hasFile('product_image') || $request->has('remove_image')) {
            // Altes Bild löschen, wenn vorhanden und remove_image ist gesetzt
            if ($request->has('remove_image') && $request->input('remove_image') && $product->product_image) {
                $oldImagePath = 'uploads/shops/' . $product->shop_id . '/images/products/' . $product->product_image;
                if (file_exists(public_path($oldImagePath))) {
                    unlink(public_path($oldImagePath));
                }
                // Produktbild aus der Datenbank entfernen
                $product->product_image = null;
            }
            // Wenn ein neues Bild hochgeladen wurde und erfolgreich hochgeladen wurde
            if ($request->hasFile('product_image') && $request->file('product_image')->getError() == UPLOAD_ERR_OK) {
                // Neues Bild speichern
                $file = $request->file('product_image');
                $filename = time().'_'.$file->getClientOriginalName(); // Eindeutigen Dateinamen generieren
                $imagePath = 'uploads/shops/'.$product->shop_id.'/images/products/';
                if (!File::exists(public_path($imagePath))) {
                    File::makeDirectory(public_path($imagePath), 0777, true, true);
                }
                // Bild hochladen und speichern
                if ($file->move(public_path($imagePath), $filename)) {
                    // Produktbild aktualisieren
                    $product->product_image = $filename;
                } else {
                    // Fehlerbehandlung, wenn das Bild nicht hochgeladen werden kann
                    return redirect()->back()->with('error', 'Error uploading product image');
                }
            }
        }

        // Produkt speichern
        if ($product->save()) {
            // Erfolgreich gespeichert
            return redirect()->route('seller.manage-products.products-list', [
                'shopId' => $product->shop_id,
                'categoryId' => $product->category_id,
            ])->with('success', ucfirst($product->product_title).' product updated successfully.');
        } else {
            // Fehler beim Speichern
            dd($product->errors());
            return redirect()->back()->with('error', 'Failed to update product.');
        }
    }





    public function deleteProduct(Request $request){
        $productId = $request->productId;

//dd($productId);



ModProductSizesPrices::where('parent', $productId)->delete();
//dd($prices);

        $product = ModProducts::findOrFail($productId);

        // Überprüfen, ob das Produktbild vorhanden ist und löschen
        if ($product->product_image) {
            $imagePath = 'uploads/shops/' . $product->shop_id . '/images/products/' . $product->product_image;
            if (file_exists(public_path($imagePath))) {
                unlink(public_path($imagePath));
            }
        }

        // Produkt aus der Datenbank löschen
        $product->delete();

        // Weiterleiten oder eine Bestätigungsnachricht anzeigen
        return redirect()->back()->with('success', ucfirst($product->product_title).' Product deleted successfully.');

        // Erfolgsmeldung zurückgeben
        return response()->json(['success' => true, 'message' => 'Product deleted successfully']);
    }

    public function updateOrdering(Request $request)
    {
        // update order
        $positions = $request->positions;

        try {
            foreach ($positions as $position) {
                ModProducts::where('id', $position[0]) // Product-ID
                           ->update(['product_ordering' => $position[1]]);
            }

            // Erfolgreiche Antwort zurückgeben
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Bei Fehlern Fehlermeldung zurückgeben
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

}
