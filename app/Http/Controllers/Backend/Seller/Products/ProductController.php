<?php

namespace App\Http\Controllers\Backend\Seller\Products;

use App\Models\ModShop;
use App\Models\ModBottles;
use App\Models\ModCategory;
use App\Models\ModProducts;
use Illuminate\Support\Str;
use App\Models\ModAdditives;
use App\Models\ModAllergens;
use Illuminate\Http\Request;
use App\Models\ModSysTaxRates;
use App\Rules\UniqueArticleNo;
use App\Models\ModProductSizes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Models\ModProductSizesPrices;
use Intervention\Image\Facades\Image;
use SawaStacks\Utils\Library\Kropify;
use App\Models\ModProductsIngredients;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
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

        // Abrufen der aktuellen Produktgrößen für die angegebene Kategorie
        $currentProductSizes = ModProductSizes::where('parent', 0)
            ->where('shop_id', $shopId)
            ->where('id', $currentCategory->sizes_category) // Hier wird die Kategorie-ID verwendet
            ->orderBy('ordering')
            ->get();

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

        // Abrufen des Shops, um den country_code zu erhalten
        $shop = ModShop::findOrFail($shopId);
        $countryCode = $shop->country_code;
//dd($countryCode);

        // Abrufen der MwSt-Sätze basierend auf dem country_code
        $taxRates = ModSysTaxRates::where('country_code', $countryCode)->get();
//dd($taxRates);

    // Aufbereiten der MwSt-Sätze für die Anzeige im Dropdown
    $taxRateOptions = $taxRates->map(function ($taxRate) {
        $rate = $taxRate->standard_rate ?? $taxRate->reduced_rate;
        return [
            'id' => $taxRate->id,
            'name' => $taxRate->category . ' - ' . $rate . '%',
        ];
    });
        // Debugging-Ausgabe
        // dd($sizesCategoryIdsString, $sizesCategoryIdsInt, $ingredientCategories);

        $data = [
            'pageTitle' => 'Add Product',
            'currentCategory' => $currentCategory, // Die aktuelle Kategorie an die Ansicht übergeben
            'ingredientCategories' => $ingredientCategories, // Die Hauptkategorie für Zutaten an die Ansicht übergeben
            'taxRateOptions' => $taxRateOptions, // Die aufbereiteten MwSt-Sätze an die Ansicht übergeben
        ];

        // Abrufen der Bottles, Additives und Allergene aus der Datenbank
        $bottles = ModBottles::all();
        $additives = ModAdditives::all();
        $allergens = ModAllergens::all();

        // Die Bottles, Additives, Allergene und aktuellen Produktgrößen an die View übergeben
        return view('backend.pages.seller.products.add-product', $data, compact('bottles', 'additives', 'shopId', 'menuId', 'categoryId', 'allergens', 'currentProductSizes'));
    }



/**
 * Stores a new product with its details, including image processing, sizes, and ingredients.
 *
 * @param Request $request
 * @return \Illuminate\Http\RedirectResponse
 */
public function storeProduct(Request $request)
{
    // Step 1: Validate form inputs
    $request->validate([
        'product_article_no' => [new UniqueArticleNo], // Validate unique product article number
        'product_title' => 'required',
        'product_description' => 'required',
        'product_short_description' => 'required|min:5',
        'base_price' => 'required|numeric|min:0.00',
        'tax_rate' => 'required|exists:mod_sys_tax_rates,id', // Validate tax rate
    ]);

    // Step 2: Retrieve shop and category IDs
    $shopId = $request->input('shop_id');
    $categoryId = $request->input('category_id');

    if (!$shopId || !$categoryId) {
        return back()->with('error', 'Shop ID or Category ID not provided.');
    }

    // Step 3: Retrieve size category from the selected category
    $category = ModCategory::find($categoryId);
    $sizeId = $category->sizes_category ?? null;

    // Step 4: Create and save the product in the database
    $product = new ModProducts();
    $product->shop_id = $shopId;
    $product->category_id = $categoryId;
    $product->product_title = trim($request->input('product_title'));
    $product->product_description = $request->input('product_description');
    $product->product_anonce = $request->input('product_short_description');
    $product->base_price = $request->input('base_price');
    $product->product_code = $request->input('product_article_no');
    $product->bottles_id = $request->input('bottle_id');
    $product->product_published = $request->input('product_published');
    $product->tax_rate_id = $request->input('tax_rate'); // Save tax rate ID
    $product->size_id = $sizeId; // Save size ID

    // Step 5: Store allergens and additives as JSON
    $product->allergens_ids = json_encode($request->input('allergens'));
    $product->additives_ids = json_encode($request->input('additives'));

    // Step 6: Process and save product image (if available)
    $imageInfo = session()->get('temporary_image_info');
    if ($imageInfo !== null) {
        $imageName = $imageInfo['name'] . '.png'; // Append .png extension
        $tempImagePath = $imageInfo['path'] . '.png'; // Append .png extension

        // Check if the image file exists and is readable
        if (!File::exists($tempImagePath) || !File::isReadable($tempImagePath)) {
            \Log::error('Image not readable or does not exist: ' . $tempImagePath);
            return back()->with('error', 'The image could not be processed.');
        }

        // Create the destination path for the product images
        $destinationPath = public_path('uploads/shops/' . $shopId . '/images/products/');
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }

        // Create a new filename for the image
        $newFilename = Str::slug($product->product_title) . '_' . date('YmdHis') . '.png';

        // Resize and save the image
        try {
            $resizedImage = Image::make($tempImagePath)->resize(290, 170);
            $resizedImage->save($destinationPath . $newFilename);
        } catch (\Exception $e) {
            \Log::error('Error processing image: ' . $e->getMessage());
            return back()->with('error', 'Image could not be processed.');
        }

        // Delete the temporary image
        unlink($tempImagePath);

        // Assign the image filename to the product
        $product->product_image = $newFilename;
        session()->forget('temporary_image_info');
    }

    // Step 7: Save the product in the database
    $product->save();

    // Step 8: Save product prices for different sizes
    foreach ($request->all() as $key => $value) {
        if (strpos($key, 'product_price_') === 0) {
            $sizeId = str_replace('product_price_', '', $key);
            if ($value > 0) {
                ModProductSizesPrices::create([
                    'parent' => $product->id,
                    'size_id' => $sizeId,
                    'shop_id' => $shopId,
                    'price' => $value,
                ]);
            }
        }
    }

    // Step 9: Save ingredients nodes
    if ($request->has('ingredients')) {
        foreach ($request->input('ingredients') as $categoryId => $ingredient) {
            $freeIngredients = $ingredient['free_ingredients'] ?? 0;
            $minIngredients = $ingredient['min_ingredients'] ?? 0;
            $maxIngredients = $ingredient['max_ingredients'] ?? 0;
            $ingredientActive = isset($ingredient['active']) ? $ingredient['active'] : 0;

            $active = ($ingredientActive == 1 || $freeIngredients > 0 || $minIngredients > 0 || $maxIngredients > 0);

            ModProductIngredientsNodes::create([
                'parent' => $product->id,
                'shop_id' => $shopId,
                'ingredients_id' => $categoryId,
                'free_ingredients' => $freeIngredients,
                'min_ingredients' => $minIngredients,
                'max_ingredients' => $maxIngredients,
                'active' => $active,
            ]);
        }
    }

    // Step 10: Redirect back with a success message
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

    // Überprüfen, ob die Kategorie gefunden wurde
    $currentCategory = ModCategory::findOrFail($categoryId);

    // Abrufen der aktuellen Produktgrößen für die angegebene Kategorie
    $currentProductSizes = ModProductSizes::where('parent', 0)
        ->where('shop_id', $shopId)
        ->where('id', $currentCategory->sizes_category) // Hier wird die Kategorie-ID verwendet
        ->orderBy('ordering')
        ->get();

    // Eine Liste aller Größen für das Produkt erstellen
    $sizes = ModProductSizes::where('parent', $currentCategory->sizes_category)->get();

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

    // Überprüfen, ob bereits Nodes für das Produkt vorhanden sind
    $existingNodes = ModProductIngredientsNodes::where('parent', $productId)
        ->where('shop_id', $currentShopId)
        ->get();

    // Holen Sie sich die Zutaten für das Produkt aus der Tabelle mod_products_ingredients
    $productIngredients = ModProductsIngredients::where('shop_id', $currentShopId)
        ->where(function ($query) use ($currentCategory) {
            $query->whereJsonContains('sizes_category', [(int)$currentCategory->sizes_category])
                ->orWhereJsonContains('sizes_category', [(string)$currentCategory->sizes_category]);
        })
        ->where('parent', 0)
        ->get();

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

    // Abrufen des Shops, um den country_code zu erhalten
    $shop = ModShop::findOrFail($shopId);
    $countryCode = $shop->country_code;

    // Abrufen der MwSt-Sätze basierend auf dem country_code
    $taxRates = ModSysTaxRates::where('country_code', $countryCode)->get();

    // Aufbereiten der MwSt-Sätze für die Anzeige im Dropdown
    $taxRateOptions = $taxRates->map(function ($taxRate) {
        $rate = $taxRate->standard_rate ?? $taxRate->reduced_rate;
        return [
            'id' => $taxRate->id,
            'name' => $taxRate->category . ' - ' . $rate . '%',
        ];
    });

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
        'ingredientNodes',
        'taxRateOptions'
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
    $product->product_title = trim($request->input('product_title'));
    $product->product_description = $request->input('product_description');
    $product->product_anonce = $request->input('product_short_description');
    $product->product_code = $request->input('product_article_no');
    $product->base_price = $request->input('product_basic_price');
    $product->product_published = $request->input('product_published');
    $product->bottles_id = $request->input('bottle_id');
    $product->tax_rate_id = $request->input('tax_rate'); // Save tax rate ID

    // Speichern der ausgewählten Allergene als Array
    $selectedAllergens = $request->input('allergens'); // Ein Array von ausgewählten Allergenen
    $product->allergens_ids = json_encode($selectedAllergens); // Speichern Sie das Array als JSON

    // Speichern der ausgewählten Zusätze als Array
    $selectedAdditives = $request->input('additives'); // Ein Array von ausgewählten Zusätzen
    $product->additives_ids = json_encode($selectedAdditives); // Speichern Sie das Array als JSON

    // Überprüfen, ob Preise angegeben sind und es sich um ein Array handelt
    if (is_array($request->prices)) {
        // Durchlaufen der Eingaben und Speichern der Preise in die Datenbank
        foreach ($request->prices as $sizeId => $price) {
            // Überprüfen, ob der Preis null ist, falls ja, setze ihn auf 0
            if ($price === null) {
                $price = 0; // Setze den Preis auf 0, wenn keiner angegeben ist
            }

            // Preis in der Datenbank updaten oder anlegen
            ModProductSizesPrices::updateOrCreate(
                ['parent' => $product->id, 'size_id' => $sizeId],
                ['shop_id' => $request->shop_id, 'price' => $price]
            );
        }
    } else {
        // Preise wurden nicht angegeben, handle das hier falls nötig (z.B. Log-Nachricht)
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
        if ($request->hasFile('product_image') && $request->file('product_image')->isValid()) {
            // Neues Bild speichern
            $file = $request->file('product_image');
            $filename = time() . '_' . $file->getClientOriginalName(); // Eindeutigen Dateinamen generieren
            $imagePath = 'uploads/shops/' . $product->shop_id . '/images/products/';
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

    // Überprüfen, ob ein neues Bild in der Session vorhanden ist
    $imageInfo = session()->get('temporary_image_info');
    if ($imageInfo !== null) {
        $imageName = $imageInfo['name'] . '.png'; // Append .png extension
        $tempImagePath = $imageInfo['path'] . '.png'; // Append .png extension

        // Check if the image file exists and is readable
        if (!File::exists($tempImagePath) || !File::isReadable($tempImagePath)) {
            \Log::error('Image not readable or does not exist: ' . $tempImagePath);
            return back()->with('error', 'The image could not be processed.');
        }

        // Create the destination path for the product images
        $destinationPath = public_path('uploads/shops/' . $shopId . '/images/products/');
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }

        // Create a new filename for the image
        $newFilename = Str::slug($product->product_title) . '_' . date('YmdHis') . '.png';

        // Resize and save the image
        try {
            $resizedImage = Image::make($tempImagePath)->resize(290, 170);
            $resizedImage->save($destinationPath . $newFilename);
        } catch (\Exception $e) {
            \Log::error('Error processing image: ' . $e->getMessage());
            return back()->with('error', 'Image could not be processed.');
        }

        // Delete the temporary image
        unlink($tempImagePath);

        // Assign the image filename to the product
        $product->product_image = $newFilename;
        session()->forget('temporary_image_info');
    }

    // Überprüfen, ob bereits Nodes für das Produkt vorhanden sind
    $existingNodes = ModProductIngredientsNodes::where('parent', $productId)
        ->where('shop_id', $shopId)
        ->get();

    // Durchlaufen der Eingaben und Aktualisieren der vorhandenen Nodes
    foreach ($request->input('ingredients', []) as $nodeId => $nodeData) {
        // Überprüfen, ob die Node bereits vorhanden ist
        $existingNode = $existingNodes->firstWhere('ingredients_id', $nodeId);

        if ($existingNode) {
            // Aktualisieren der vorhandenen Node
            $existingNode->update([
                'free_ingredients' => $nodeData['free_ingredients'] ?? $existingNode->free_ingredients,
                'min_ingredients' => $nodeData['min_ingredients'] ?? $existingNode->min_ingredients,
                'max_ingredients' => $nodeData['max_ingredients'] ?? $existingNode->max_ingredients,
                'active' => $nodeData['active'] ?? 0,
            ]);
        }
    }

    // Produkt speichern
    if ($product->save()) {
        // Erfolgreich gespeichert
        return redirect()->route('seller.manage-products.products-list', [
            'shopId' => $product->shop_id,
            'categoryId' => $product->category_id,
        ])->with('success', ucfirst($product->product_title) . ' product updated successfully.');
    } else {
        // Fehler beim Speichern
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
        if ($request->hasFile('productImageUpload')) {
            $file = $request->file('productImageUpload');

         //   dd($productImageUpload);

            // Hole den Dateinamen ohne Endung und die tatsächliche Endung
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension(); // Dateiendung

            // Generiere einen eindeutigen Dateinamen mit der Endung
            $filename = time() . '_' . Str::slug($originalName) . '' . $extension;

            // Temporärer Ordner Pfad
            $tempFolder = storage_path('app/uploads/temp/');
            if (!Storage::disk('local')->exists($tempFolder)) {
                Storage::disk('local')->makeDirectory($tempFolder);
            }

            // Bild hochladen und verarbeiten
            $uploadedImage = Kropify::getFile($file, $filename)->save($tempFolder);
            if (!$uploadedImage) {
                return response()->json([
                    'success' => false,
                    'message' => 'Image processing failed.',
                ], 500);
            }

            // Bildinformationen abrufen
            $imageInfo = Kropify::getInfo();

            // Session mit vollständigem Dateinamen und Pfad speichern
            session()->put('temporary_image_info', [
                'name' => $filename, // Hier ist jetzt der richtige Dateiname mit Endung
                'path' => $tempFolder . $filename,
            ]);

            \Log::info('Temporäres Bild gespeichert: ' . $tempFolder . $filename);

            // Bilddaten zurückgeben
            return response()->json([
                'status' => '1',
                'success' => true,
                'infos' => $imageInfo,
                'msg' => 'Your Product Picture has been uploaded successfully.',
                'processed_image' => asset('uploads/temp/' . $filename),
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No image uploaded.',
            ], 400);
        }
    }





}
