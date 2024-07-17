<?php

namespace App\Http\Controllers\Backend\Seller\Products;

use App\Models\ModBottles;
use App\Models\ModCategory;
use App\Models\ModProducts;
use Illuminate\Support\Str;
use App\Models\ModAdditives;
use App\Models\ModAllergens;
use Illuminate\Http\Request;
use App\Rules\UniqueArticleNo;
use App\Models\ModProductSizes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Models\ModProductSizesPrices;
use Intervention\Image\Facades\Image;
use App\Models\ModProductsIngredients;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Mberecall\Services\Library\Kropify;
use App\Models\ModProductIngredientsNodes;


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

     // dd($currentCategory);



        // Abrufen der aktuellen Produktgrößen für die angegebene Kategorie
        $currentProductSizes = ModProductSizes::where('parent', 0)
            ->where('shop_id', $shopId)
            ->where('id', $currentCategory->sizes_category) // Hier wird die Kategorie-ID verwendet
            ->orderBy('ordering')
            ->get();
//dd($currentCategory->sizes_category);
//dd($currentProductSizes);

// Konvertiere sizes_category in ein PHP-Array, falls es noch nicht ist
$sizesCategoryIds = json_decode($currentCategory->sizes_category, true);

// Überprüfe, ob die Konvertierung erfolgreich war und $sizesCategoryIds ein Array ist
if (!is_array($sizesCategoryIds)) {
    $sizesCategoryIds = [$currentCategory->sizes_category]; // Fallback, falls es kein JSON-Array ist
}

// Konvertiere alle IDs in Strings und Integers
$sizesCategoryIdsString = array_map('strval', $sizesCategoryIds);
$sizesCategoryIdsInt = array_map('intval', $sizesCategoryIds);

// Abrufen aller Hauptkategorien für Zutaten
$ingredientCategories = ModProductsIngredients::where('parent', 0) // Annahme: Hauptkategorien haben parent = 0
    ->where('shop_id', $shopId) // Filtern nach Shop-ID
    ->where(function ($query) use ($sizesCategoryIdsString, $sizesCategoryIdsInt) {
        foreach ($sizesCategoryIdsString as $id) {
            $query->orWhereJsonContains('sizes_category', $id);
        }
        foreach ($sizesCategoryIdsInt as $id) {
            $query->orWhereJsonContains('sizes_category', $id);
        }
    })
    ->get(); // Alle übereinstimmenden Kategorien abrufen

// Debugging-Ausgabe
//dd($sizesCategoryIdsString, $sizesCategoryIdsInt, $ingredientCategories);





        // Abrufen aller Hauptkategorien für Zutaten
   //     $ingredientCategories = ModProductsIngredients::where('parent', 0) // Annahme: Hauptkategorien haben parent = 0
  //      ->where('shop_id', $shopId) // Filtern nach Shop-ID
 //       ->whereJsonContains('sizes_category', [$currentCategory->sizes_category]) // Überprüfen, ob die sizes_category die Produktskategorie enthält
      //  ->where('sizes_category', 'LIKE', '%"'.$currentCategory->sizes_category.'"%')
  //      ->get(); // Alle übereinstimmenden Kategorien abrufen


//dd($ingredientCategories);

        $data = [
            'pageTitle' => 'Add Product',
            'currentCategory' => $currentCategory, // Die aktuelle Kategorie an die Ansicht übergeben
            'ingredientCategories' => $ingredientCategories, // Die Hauptkategorie für Zutaten an die Ansicht übergeben
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
        //$product->product_title = $request->input('product_title');
        //$product->product_title = utf8_encode($request->input('product_title'));
        $product->product_description = $request->input('product_description');
        $product->product_anonce = $request->input('product_short_description');
        //$product->product_title = utf8_encode(trim($request->input('product_title')));
        $product->product_title = trim($request->input('product_title'));
        //$product->product_description = utf8_encode(trim($request->input('product_description')));
        //$product->product_anonce = utf8_encode(trim($request->input('product_short_description')));

        $product->base_price = $request->input('base_price');
        $product->product_code = $request->input('product_article_no');
        $product->bottles_id = $request->input('bottle_id');
        $product->product_published = $request->input('product_published');

        // Speichern der ausgewählten Allergene als JSON
        $product->allergens_ids = json_encode($request->input('allergens'));
        // Speichern der ausgewählten Zusatzstoffe als JSON
        $product->additives_ids = json_encode($request->input('additives'));





        // Hole die Bildinformationen aus der Sitzungsvariable
    //    $imageInfo = session()->get('temporary_image_info');
//dd($imageInfo);
$imageInfo = null;
        // Überprüfe, ob die Bildinformationen vorhanden sind und das Objekt nicht null ist
        if ($imageInfo !== null) {
            // Verarbeite das Bild weiter, z. B.
            $imageName = $imageInfo->getName; // Methode aufrufen, um den Dateinamen zu erhalten
            $imageSize = $imageInfo->getSize; // Methode aufrufen, um die Dateigröße zu erhalten
            $imageWidth = $imageInfo->getWidth; // Methode aufrufen, um die Breite zu erhalten
            $imageHeight = $imageInfo->getHeight; // Methode aufrufen, um die Höhe zu erhalten

            // Setze den Pfad zum temporären Bild
            $tempPath = public_path('uploads/temp/' . $imageName);

    // Definiere den Zielordner für das neue Bild
    $destinationPath = public_path('uploads/shops/' . $shopId . '/images/products/');

    if (!File::exists($destinationPath)) {
        File::makeDirectory($destinationPath, 0755, true);
    }



    // Neu generierter Dateiname für das Bild
    $newFilename = Str::slug($product->product_title) . '_' . date('YmdHis') . '.' . pathinfo($imageName, PATHINFO_EXTENSION);

    // Verwende Intervention Image, um das Bild zu rezisen
    $resizedImage = Image::make($tempPath)->resize(290, 170);

    // Speichere das rezisierte Bild im Zielordner
    $resizedImage->save($destinationPath . $newFilename);

    // Lösche das temporäre Bild
    unlink($tempPath);

    // Speichere den Dateinamen des neuen Bildes in der Datenbank
    $product->product_image = $newFilename; // Produktbild setzen

    // Speichere das Produkt
 //   $product->save();

    // Lösche die Bildinformationen aus der Sitzungsvariable
    session()->forget('temporary_image_info');

} else {
    // Fehlerbehandlung, wenn keine Bildinformationen vorhanden sind
}



//dd($imageInfo);







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

//dd($request->all());

// Durchlaufen der Ingredients-Nodes und Speichern in die Datenbank
if ($request->has('ingredients')) {
    foreach ($request->input('ingredients') as $categoryId => $ingredient) {
        // Standardwerte für Zutaten festlegen
        $freeIngredients = $ingredient['free_ingredients'] ?? 0;
        $minIngredients = $ingredient['min_ingredients'] ?? 0;
        $maxIngredients = $ingredient['max_ingredients'] ?? 0;

        // Überprüfen, ob der Schlüssel 'active' existiert und setze den Wert
        $ingredientActive = isset($ingredient['active']) ? $ingredient['active'] : 0;

        // Setzen des active-Status basierend auf den Bedingungen
        $active = false;

        // Überprüfung, ob eine der Zutaten-Einstellungen größer als 0 ist
        if ($freeIngredients > 0 || $minIngredients > 0 || $maxIngredients > 0) {
            $active = true;
        }

        // Wenn die Anfrage eine POST-Anfrage ist, setze active basierend auf den Eingabewerten
        if ($request->isMethod('post')) {
            $active = ($ingredientActive == 1 || $freeIngredients > 0 || $minIngredients > 0 || $maxIngredients > 0) ? true : false;
        } else {
            // Bei PUT/PATCH-Anfragen, übernehme den active-Status wie oben
            if ($ingredientActive == 1 || $freeIngredients > 0 || $minIngredients > 0 || $maxIngredients > 0) {
                $active = true;
            }
        }

        // Speichern der Ingredients-Nodes in die Datenbank
        ModProductIngredientsNodes::create([
            'parent' => $productId,
            'shop_id' => $shopId,
            'ingredients_id' => $categoryId, // Verwenden von $categoryId als die Zutaten-ID
            'free_ingredients' => $freeIngredients, // Verwenden von Standardwerten, wenn keine Werte vorhanden sind
            'min_ingredients' => $minIngredients, // Verwenden von Standardwerten, wenn keine Werte vorhanden sind
            'max_ingredients' => $maxIngredients, // Verwenden von Standardwerten, wenn keine Werte vorhanden sind
            'active' => $active, // Setzen des active-Status
        ]);
    }
}







        // Weiterleiten oder eine Bestätigungsnachricht anzeigen
        return redirect()->back()->with('success', ucfirst($product->product_title) . ' product created successfully.');
    }




    public function editProduct(Request $request) // TODO - Edit Product
    {
        // Shop-ID aus der aktuellen Sitzung abrufen
        $currentShopId = Session::get('currentShopId');
        // Abrufen der Shop-ID, Menu-ID, Kategorie-ID und Produkt-ID aus dem Request
        $shopId = $request->shopId;
        $menuId = $request->menuId;
        $categoryId = $request->categoryId;
        $productId = $request->productId;

        // Überprüfen, ob alle erforderlichen IDs vorhanden sind
        if (!$shopId || !$categoryId || !$productId || !$currentShopId) {
            // Hier kann eine Fehlerbehandlung durchgeführt werden, falls benötigt
    //        return back()->with('error', 'Missing Shop ID, Menu ID, Category ID, or Product ID.');

        return redirect()->route('seller.dashboard')->with('error', 'Missing Shop ID, Menu ID, Category ID, or Product ID.');

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

    //    dd($currentProductSizes);

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





        // Shop-ID aus der aktuellen Sitzung abrufen
$currentShopId = Session::get('currentShopId');
//dd($currentShopId);
//dd($sizes);
//dd($productId);

//$catId = ModProducts::where('id', $productId)->first()->category_id;
if ($currentProductSizes->isNotEmpty()) {
    $catId = $currentProductSizes->first()->id;


//dd($catId);
// Überprüfen, ob bereits Nodes für das Produkt vorhanden sind
$existingNodes = ModProductIngredientsNodes::where('parent', $productId)
    ->where('shop_id', $currentShopId)
    ->get();
//dd($existingNodes);
// Holen Sie sich die Zutaten für das Produkt aus der Tabelle mod_products_ingredients
$productIngredients = ModProductsIngredients::where('shop_id', $currentShopId)
    ->where(function ($query) use ($catId) {
        $query->whereJsonContains('sizes_category', [(int)$catId])
            ->orWhereJsonContains('sizes_category', [(string)$catId]);
    })
    ->where('parent', 0)
    ->get();



//dd($productIngredients);
// Iterieren Sie über die Zutaten und erstellen Sie Knoten, wenn sie nicht bereits existieren
foreach ($productIngredients as $ingredient) {
    // Überprüfen, ob der Knoten bereits existiert
    $existingNode = $existingNodes->where('ingredients_id', $ingredient->id)->first();
    if (!$existingNode) {
        // Wenn der Knoten nicht existiert, erstellen Sie ihn
        ModProductIngredientsNodes::create([
            'parent' => $productId,
            'shop_id' => $currentShopId,
            'ingredients_id' => $ingredient->id,
            'free_ingredients' => 0, // Standardwerte setzen
            'min_ingredients' => 0,
            'max_ingredients' => 0,
            'active' => false,
        ]);
    }
}

} else {


}

// Jetzt haben Sie entweder die vorhandenen Knoten oder neu erstellte Knoten für die Anzeige
//dd($existingNodes);
    // Laden Sie die neu erstellten Knoten erneut
    $existingNodes = ModProductIngredientsNodes::where('parent', $productId)
        ->where('shop_id', $currentShopId)
        ->get();

// Wenn vorhanden, die passenden Werte holen
if ($existingNodes->isNotEmpty()) {
    $ingredientNodes = [];
    foreach ($existingNodes as $node) {
        $ingredientNodes[$node->ingredients_id] = [
            'free_ingredients' => $node->free_ingredients,
            'min_ingredients' => $node->min_ingredients,
            'max_ingredients' => $node->max_ingredients,
            'active' => $node->active,
        ];
    }
} else {
    // Wenn nicht vorhanden, leere Werte setzen
    $ingredientNodes = [];
}




//dd($ingredientNodes);

        // Die Bottles, Additives, Preise und Produkt an die View übergeben
        return view('backend.pages.seller.products.edit-product', compact(
            'shopId',
            'selectedAllergens',
            'selectedAdditives',
            'menuId',
            'categoryId',
            'product',
            'bottles',
            'additives',
            'allergens',
            'productId',
            'productPrices',
            'sizes',
            'ingredientNodes'
        ));

    }



    /**
    * Aktualisiert die Produktinformationen und zugehörige Nodes.
    *
    * @param  \Illuminate\Http\Request  $request  Die Anfrage mit den aktualisierten Produktinformationen
    * @return \Illuminate\Http\RedirectResponse  Weiterleitung zur Liste der Produkte oder Fehlermeldung
    */
    public function updateProduct(Request $request)
    {
        // Produkt-ID aus der Anfrage abrufen
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

        // Validierung durchführen
        $request->validate($rules);

        // Shop-ID und Kategorie-ID aus der Anfrage abrufen
        $shopId = $request->input('shop_id');
        $categoryId = $request->input('category_id');

        // Überprüfen, ob die Shop-ID und Kategorie-ID vorhanden sind
        if (!$shopId || !$categoryId) {
            return back()->with('error', 'Shop ID or Category ID not provided.');
        }

        // Produkt aus der Datenbank abrufen
        $product = ModProducts::findOrFail($request->product_id);

        // Produktinformationen aktualisieren
        $product->shop_id = $shopId;
        $product->category_id = $categoryId;
        //$product->product_title = $request->input('product_title');
        $product->product_title = trim($request->input('product_title'));
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



        // Überprüfen, ob bereits Nodes für das Produkt vorhanden sind
        $existingNodes = ModProductIngredientsNodes::where('parent', $productId)
        ->where('shop_id', $shopId)
        ->get();
//dd($existingNodes);
// Durchlaufen der Eingaben und Aktualisieren der vorhandenen Nodes
//dd($request->input('ingredients', []));
foreach ($request->input('ingredients', []) as $nodeId => $nodeData) {
    // Überprüfen, ob die Node bereits vorhanden ist
    $existingNode = $existingNodes->firstWhere('ingredients_id', $nodeId);

    if ($existingNode) {
        // Aktualisieren der vorhandenen Node
        $existingNode->update([
            'free_ingredients' => isset($nodeData['free_ingredients']) ? $nodeData['free_ingredients'] : $existingNode->free_ingredients,
            'min_ingredients' => isset($nodeData['min_ingredients']) ? $nodeData['min_ingredients'] : $existingNode->min_ingredients,
            'max_ingredients' => isset($nodeData['max_ingredients']) ? $nodeData['max_ingredients'] : $existingNode->max_ingredients,
            'active' => isset($nodeData['active']) ? $nodeData['active'] : 0,
        ]);
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





    public function deleteProduct(Request $request){    // TODO - Delete Product
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

        // Nodes des Produkts löschen
        ModProductIngredientsNodes::where('parent', $productId)->delete();


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

    public function processProductImage(Request $request)
    {
        // Überprüfe, ob eine Datei hochgeladen wurde
        if ($request->hasFile('productImageUpload')) {
            // Dateiname generieren
            $filename = $request->file('productImageUpload')->getClientOriginalName();

            // Überprüfe, ob der temporäre Ordner existiert, andernfalls erstelle ihn
            $tempFolder = 'uploads/temp/';
            if (!Storage::exists($tempFolder)) {
                Storage::makeDirectory($tempFolder);
                // Setze die Zugriffsrechte für den temporären Ordner
                Storage::setVisibility($tempFolder, 'public');
            }

            $file = $request->file('productImageUpload');
            $filename = time() . '_' . $file->getClientOriginalName(); // Eindeutigen Dateinamen generieren
            $imagePath = 'uploads/temp/';

            // Hier wird das Bild auf 325x325 Pixel skaliert und gespeichert
          //  Image::make($file)
                //->resize(325, 325)
            //    ->save($imagePath . $filename);

       // Bilddatei hochladen und verarbeiten
       $uploadedImage = Kropify::getFile($file,$filename)
        //->maxWoH(325)
       ->save($imagePath);


       // Hole die Bildinformationen

       $imageInfo = Kropify::getInfo();
// Speichere die Bildinformationen in der Sitzungsvariable
session()->put('temporary_image_info', $imageInfo);


            // Bilddaten abrufen
            $infos = pathinfo($imagePath . $filename);
            $infos = Kropify::getInfo();
            // Protokolliere den Pfad des temporären Bildes
            \Log::info('Temporäres Bild gespeichert: ' . $tempFolder . $filename);

            // Hier könntest du weitere Verarbeitungsschritte durchführen, falls benötigt
            // Gib die verarbeiteten Bilddaten zurück
            return response()->json([
                'status' => '1',
                'success' => true,
                'infos' => $infos,
                'msg' => 'Your Product Picture has been uploaded successfully.',
                'processed_image' => Storage::url($tempFolder . $filename) // Verwende die URL des temporären Bildes
            ]);
        } else {
            // Fehlermeldung zurückgeben, wenn keine Datei hochgeladen wurde
            return response()->json([
                'success' => false,
                'message' => 'No image uploaded.',
                'msg' => 'Something went wrong. Please try again.',
            ], 400); // HTTP-Statuscode 400 für "Bad Request"
        }
    }





}
