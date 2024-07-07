<?php

namespace App\Services;

use Log;
use App\Models\ModShop;
use App\Models\ModOrders;
use App\Models\ModCategory;
use App\Models\ModProducts;
use Illuminate\Support\Str;
use App\Models\ModProductSizes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\ModProductSizesPrices;
use App\Models\ModProductsIngredients;
use Illuminate\Support\Facades\Storage;
use App\Models\ModProductIngredientsNodes;
use App\Models\ModProductsIngredientsPrices;

class CopyShopService
{
    public function copyShop($shopId, $options)
    {
        DB::beginTransaction();

        try {
            // Original Shop finden
            $originalShop = ModShop::findOrFail($shopId);

            // Neuen Shop erstellen und Daten kopieren
            $newShop = $originalShop->replicate();
            $newShop->shop_nr = $this->generateNewShopNr();
            $newShop->title = $originalShop->title . ' - Copy';
            $newShop->save();

            Log::info("Neuer Shop erstellt mit ID: {$newShop->id}");

            // Shopdaten kopieren, wenn ausgewählt
            if (isset($options['shopData']) && $options['shopData']) {
                if (isset($originalShop->description)) {
                    $newShop->description = $originalShop->description;
                }
                if (isset($originalShop->address)) {
                    $newShop->address = $originalShop->address;
                }
            }

            // Öffnungszeiten kopieren, wenn ausgewählt
            if (isset($options['openingHours']) && $options['openingHours']) {
                $this->copyOpeningHours($originalShop, $newShop);
            }

            // Liefergebiet kopieren, wenn ausgewählt
            if (isset($options['deliveryArea']) && $options['deliveryArea']) {
                $this->copyDeliveryAreas($originalShop, $newShop);
            }

            // Kategorien kopieren und Kategorie-ID-Zuordnung erstellen
            $categoryIdMap = [];
            if (isset($options['sizesandprices']) && $options['sizesandprices']) {
                $sizeIdMap = [];
                // Kategorien kopieren und Kategorie-ID-Zuordnung erstellen
                $categoryIdMap = [];
                $originalCategories = ModCategory::where('shop_id', $shopId)->get();
                foreach ($originalCategories as $originalCategory) {
                    Log::info("Kopiere Kategorie mit ID: {$originalCategory->id}");
                    $newCategory = $this->copyCategories($originalCategory, $newShop->id, $sizeIdMap); // Hier wird der dritte Parameter hinzugefügt
                    $categoryIdMap[$originalCategory->id] = $newCategory->id;
                }

                $originalSizes = ModProductSizes::where('shop_id', $shopId)->get();

                foreach ($originalSizes as $originalSize) {
                    Log::info("Kopiere Größen und Preise für Kategorie mit ID: {$originalSize->id}");

            //        $sizeIdMap += $this->copySizesAndPrices($originalSize, $newShop->id, $categoryIdMap);
                }
            }

            // Produkte kopieren, wenn ausgewählt
            $productIdMap = [];
            if (isset($options['products']) && $options['products']) {
                $productIdMap = $this->copyProducts($originalShop, $newShop, $categoryIdMap);
          //  dd($productIdMap);
            }
         //   dd($productIdMap);
            // Produktgrößen und Preise kopieren, wenn ausgewählt
            if (isset($options['sizesandprices']) && $options['sizesandprices']) {
                $sizeIdMap = [];
                $originalSizes = ModProductSizes::where('shop_id', $shopId)->get();
                foreach ($originalSizes as $originalSize) {
                    Log::info("Kopiere Größen und Preise für Kategorie mit ID: {$originalSize->id}");
                    $sizeIdMap += $this->copySizesAndPrices($originalSize, $newShop->id, $productIdMap);
                }
            }

            // Ingredients kopieren, wenn ausgewählt
            if (isset($options['ingredients']) && $options['ingredients']) {
                $originalIngredients = ModProductsIngredients::where('shop_id', $shopId)->get();
                $ingredientIdMap = $this->copyIngredients($originalIngredients, $shopId, $newShop->id, $sizeIdMap);
                Log::info('Ingredient ID Map:', $ingredientIdMap);

                $originalIngredientNodes = ModProductIngredientsNodes::where('shop_id', $shopId)->get();
                $this->copyIngredientNodes($originalIngredientNodes, $newShop->id, $ingredientIdMap);
            }

            // Bestellungen kopieren und Zuordnung erhalten
            $orderIdMap = [];
            if (isset($options['orders']) && $options['orders']) {
                $orderIdMap = $this->copyOrders($originalShop, $newShop);
            }

            // Bewertungen kopieren, wenn ausgewählt
            if (isset($options['votes']) && $options['votes']) {
                $this->copyVotes($originalShop, $newShop, $orderIdMap);
            }

            DB::commit();

            return $newShop;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

    }

    protected function copyOpeningHours($originalShop, $newShop)
    {
        $originalOpeningHours = $originalShop->openingHours()->get();
        foreach ($originalOpeningHours as $originalOpeningHour) {
            $newOpeningHour = $originalOpeningHour->replicate();
            $newOpeningHour->shop_id = $newShop->id;
            $newOpeningHour->save();
        }

        $originalHolidays = $originalShop->holidays()->get();
        foreach ($originalHolidays as $originalHoliday) {
            $newHoliday = $originalHoliday->replicate();
            $newHoliday->shop_id = $newShop->id;
            $newHoliday->save();
        }
    }

    protected function copyDeliveryAreas($originalShop, $newShop)
    {
        $originalDeliveryAreas = $originalShop->deliveryAreas()->get();
        foreach ($originalDeliveryAreas as $originalDeliveryArea) {
            $newDeliveryArea = $originalDeliveryArea->replicate();
            $newDeliveryArea->shop_id = $newShop->id;
            $newDeliveryArea->save();
        }
    }

    protected function copyOrders($originalShop, $newShop)
    {
        $originalOrders = $originalShop->orders()->get();
        $orderIdMap = [];

        foreach ($originalOrders as $originalOrder) {
            $newOrder = $originalOrder->replicate();
            $newOrder->parent = $newShop->id;
            $newOrder->hash = $this->generateNewOrderHash();
            $newOrder->save();

            // Speichern der Zuordnung alter Bestell-ID zu neuer Bestell-ID
            $orderIdMap[$originalOrder->id] = $newOrder->id;
        }

        return $orderIdMap;
    }

    protected function generateNewOrderHash()
    {
        return hash('sha256', uniqid());
    }

    protected function generateNewShopNr()
    {
        return 'NEW_SHOP_NR_' . uniqid();
    }

    protected function copyVotes($originalShop, $newShop, $orderIdMap)
    {
        $originalVotes = $originalShop->votes()->get();

        foreach ($originalVotes as $originalVote) {
            $newVote = $originalVote->replicate();
            $newVote->shop_id = $newShop->id;

            // Verwenden der Zuordnung, um die neue `order_id` zu finden
            if (isset($orderIdMap[$originalVote->order_id])) {
                $newVote->order_id = $orderIdMap[$originalVote->order_id];
            } else {
                $newVote->order_id = null;
            }

            // Setze `order_hash` der neuen Bestellung, wenn vorhanden
            $newOrder = ModOrders::find($newVote->order_id);
            if ($newOrder) {
                $newVote->order_hash = $newOrder->hash;
            } else {
                $newVote->order_hash = null;
            }

            $newVote->save();
        }
    }

    protected function mapOldOrderIdToNew($oldOrderId, $newShopId)
    {
        $oldOrder = ModOrders::find($oldOrderId);
        if ($oldOrder) {
            $newOrder = ModOrders::where('hash', $oldOrder->hash)->where('parent', $newShopId)->first();
            if ($newOrder) {
                return $newOrder->id;
            }
        }
        return null;
    }



    protected function copySizesAndPrices($originalSize, $newShopId, $productIdMap)
    {
        $sizeIdMap = [];

        // Prüfen, ob die Kategorie eine Hauptkategorie ist
        if ($originalSize->parent == 0) {
            // Kopiere die Hauptgröße mit parent 0
            $originalMainSize = ModProductSizes::where('parent', 0)
                ->where('id', $originalSize->id)
                ->first();

            if ($originalMainSize) {
                $newMainSize = $originalMainSize->replicate();
                $newMainSize->shop_id = $newShopId;
                $newMainSize->parent = 0;
                $newMainSize->save();

                // Setze die neue Hauptgröße als sizes_category in der neuen Kategorie
                $sizeIdMap[$originalMainSize->id] = $newMainSize->id;
            }
        }

        // Kopiere die Größen, wenn vorhanden
        $originalSizes = ModProductSizes::where('parent', $originalSize->id)->get();

        if ($originalSizes->isNotEmpty()) {
            foreach ($originalSizes as $originalSize) {
                $newSize = $originalSize->replicate();
                $newSize->shop_id = $newShopId;
                $newSize->parent = isset($newMainSize) ? $newMainSize->id : ($productIdMap[$originalSize->parent] ?? 0); // Verwende die richtige Logik für parent
                $newSize->save();

                $sizeIdMap[$originalSize->id] = $newSize->id;

                // Kopiere die Preise für diese Größe, wenn vorhanden
                $originalPrices = ModProductSizesPrices::where('size_id', $originalSize->id)->get();
                if ($originalPrices->isNotEmpty()) {
                    foreach ($originalPrices as $originalPrice) {
                        if (!isset($productIdMap[$originalPrice->id])) {
                            // Wenn es keinen gültigen Parent gibt, überspringen wir diesen Preis
                            Log::warning("Kein gültiger parent-Wert für Preis mit ID: {$originalPrice->id}. Überspringe Kopiervorgang.");
                            continue;
                        }

                        $newPrice = $originalPrice->replicate();
                        $newPrice->shop_id = $newShopId;
                        $newPrice->size_id = $newSize->id;
                        $newPrice->parent = $productIdMap[$originalPrice->id]; // Verwende die richtige Logik für parent

                        // Füge Debugging hinzu
                        Log::info("Original Price ID: {$originalPrice->id}, New Price Parent: {$newPrice->parent}");

                        $newPrice->save();
                    }
                }
            }
        } else {
            Log::warning("Keine Größen gefunden für Kategorie mit ID: {$originalSize->id}. Überspringe Kopiervorgang.");
        }

        return $sizeIdMap;
    }






    // Kopiert die Kategorien für einen neuen Shop
    public function copyCategories($originalCategory, $newShopId, $sizeIdMap)
    {
        // Kopiere die Kategorie
        $newCategory = $originalCategory->replicate();
        $newCategory->shop_id = $newShopId;
        $newCategory->sizes_category = 0; // Setze sizes_category auf 0 für Hauptkategorie
        $newCategory->save();

        // Kopiere das Kategoriebild, falls vorhanden
        $this->copyCategoryImage($originalCategory, $newCategory);

        // Aktualisiere die sizes_category in der neuen Kategorie
        if ($originalCategory->sizes_category && isset($sizeIdMap[$originalCategory->sizes_category])) {
            $newCategory->sizes_category = $sizeIdMap[$originalCategory->sizes_category];
            $newCategory->save(); // Speichern der Änderungen an sizes_category
        } else {
            Log::warning("Keine passende sizes_category gefunden für Kategorie mit ID: {$originalCategory->id}. Setze auf null.");
            $newCategory->sizes_category = null; // Optional: Auf null setzen, wenn keine passende gefunden wurde
            $newCategory->save(); // Speichern der Änderungen an sizes_category
        }

        return $newCategory;
    }




    protected function copyCategoryImage($originalCategory, $newCategory)
    {
        $originalShopId = $originalCategory->shop_id;
        $newShopId = $newCategory->shop_id;

        // Pfad zum Originalbild
        $originalImagePath = public_path('uploads/shops/' . $originalShopId . '/images/category/' . $originalCategory->category_image);

        // Zielverzeichnis für das neue Bild im öffentlichen Verzeichnis
        $targetDirectory = public_path('uploads/shops/' . $newShopId . '/images/category/');

        // Dateiname des Bildes
        $imageName = basename($originalImagePath);

        // Überprüfen, ob das Originalbild existiert
        if (File::exists($originalImagePath)) {
            // Prüfen, ob das Zielverzeichnis existiert, andernfalls erstellen
            if (!File::exists($targetDirectory)) {
                File::makeDirectory($targetDirectory, 0777, true, true);
            }

            // Kopieren des Bildes
            File::copy($originalImagePath, $targetDirectory . $imageName);

            // Aktualisieren des Bildpfads in der neuen Kategorie
            $newCategory->category_image = $imageName;
            $newCategory->save();
        } else {
            Log::info("Bild nicht gefunden: $originalImagePath");
        }
    }

    // Kopiert die Produkte für einen neuen Shop
    public function copyProducts($originalShop, $newShop, $categoryIdMap)
    {
        $productIdMap = [];

        foreach ($originalShop->products as $originalProduct) {
            // Replizieren des Produkts
            $newProduct = $originalProduct->replicate();
            $newProduct->shop_id = $newShop->id;

            // Kategorie-ID anpassen
            if (isset($categoryIdMap[$originalProduct->category_id])) {
                $newProduct->category_id = $categoryIdMap[$originalProduct->category_id];
            }

            $newProduct->product_slug = Str::slug($newProduct->product_title . '-' . $newShop->id, '-');
            $newProduct->save();

            // Bild kopieren
            $this->copyProductImage($originalProduct, $newProduct);

            $productIdMap[$originalProduct->id] = $newProduct->id;
        }
        return $productIdMap;
    }

public function copyIngredients($originalIngredients, $oldShopId, $newShopId, $sizeIdMap)
{
    // Erstelle eine Map für sizes_category basierend auf den alten und neuen shop_id
    $sizesCategoryMap = $this->createSizesCategoryMap($oldShopId, $newShopId);

    $ingredientIdMap = [];
    $productIdMap = $this->createProductIdMap($oldShopId, $newShopId);

    try {
        // Starte eine Datenbank-Transaktion
        DB::beginTransaction();

        // Erste Schleife: Ingredients kopieren und neue IDs speichern
        foreach ($originalIngredients as $originalIngredient) {
            $newIngredient = $originalIngredient->replicate();
            $newIngredient->shop_id = $newShopId;

            // Aktualisiere die sizes_category falls vorhanden
            if (!empty($originalIngredient->sizes_category)) {
                // Extrahiere die sizes_category IDs
                $originalSizesCategories = json_decode($originalIngredient->sizes_category, true);

                // Falls nur eine ID vorliegt, mache es zu einem Array
                if (!is_array($originalSizesCategories)) {
                    $originalSizesCategories = [$originalSizesCategories];
                }

                // Ersetze jede alte ID durch die neue ID aus der Map
                $newSizesCategories = [];
                foreach ($originalSizesCategories as $originalSizeCategory) {
                    if (isset($sizesCategoryMap[$originalSizeCategory])) {
                        // ID als String speichern
                        $newSizesCategories[] = (string)$sizesCategoryMap[$originalSizeCategory];
                    } else {
                        $newSizesCategories[] = (string)$originalSizeCategory; // Falls keine Übereinstimmung gefunden wurde
                    }
                }

                // Setze die neue sizes_category als JSON-kodierte Zeichenkette
                $newIngredient->sizes_category = json_encode($newSizesCategories);
            }

            $newIngredient->save();
            $ingredientIdMap[$originalIngredient->id] = $newIngredient->id;
        }

        // Zweite Schleife: Parent-IDs aktualisieren
        foreach ($originalIngredients as $originalIngredient) {
            $newIngredientId = $ingredientIdMap[$originalIngredient->id];
            $newIngredient = ModProductsIngredients::find($newIngredientId);

            if ($originalIngredient->parent != 0 && isset($ingredientIdMap[$originalIngredient->parent])) {
                $newIngredient->parent = $ingredientIdMap[$originalIngredient->parent];
            } else {
                $newIngredient->parent = 0;
            }

            $newIngredient->save();

            // Kopiere die Preise für diese Zutat
            $originalPrices = ModProductsIngredientsPrices::where('parent', $originalIngredient->id)->get();
            if ($originalPrices->isNotEmpty()) {
                foreach ($originalPrices as $originalPrice) {
                    $newPrice = $originalPrice->replicate();
                    $newPrice->shop_id = $newShopId;
                    $newPrice->parent = $newIngredient->id;

                    // Aktualisiere die size_id falls vorhanden
                    if (isset($sizeIdMap[$originalPrice->size_id])) {
                        $newPrice->size_id = $sizeIdMap[$originalPrice->size_id];
                    } else {
                        $newPrice->size_id = $originalPrice->size_id;
                    }

                    $newPrice->save();
                }
            }
        }

        // Commit der Transaktion, wenn alles erfolgreich war
        DB::commit();
    } catch (\Exception $e) {
        // Bei einem Fehler Rollback der Transaktion
        DB::rollBack();
        throw $e; // Werfe den Fehler weiter, um ihn anderswo zu behandeln
    }

    return $ingredientIdMap;
}

private function createSizesCategoryMap($oldShopId, $newShopId)
{
    $sizesCategoryMap = [];

    // Durchsuche die alten sizes nach shop_id und parent = 0
    $originalSizes = ModProductSizes::where('shop_id', $oldShopId)->where('parent', 0)->pluck('title', 'id')->toArray();

    // Durchsuche die neuen sizes nach shop_id und parent = 0
    $newSizes = ModProductSizes::where('shop_id', $newShopId)->where('parent', 0)->pluck('id', 'title')->toArray();

    foreach ($originalSizes as $originalId => $title) {
        if (isset($newSizes[$title])) {
            $sizesCategoryMap[$originalId] = $newSizes[$title];
        }
    }

    // Debug: Map anzeigen
    Log::info('Sizes Category Map: ' . json_encode($sizesCategoryMap));

    return $sizesCategoryMap;
}

private function createProductIdMap($oldShopId, $newShopId)
{
    $productIdMap = [];

    // Holen Sie sich die Produkte aus dem alten Shop
    $oldProducts = ModProducts::where('shop_id', $oldShopId)->pluck('id', 'product_title')->toArray();

    // Holen Sie sich die Produkte aus dem neuen Shop
    $newProducts = ModProducts::where('shop_id', $newShopId)->pluck('id', 'product_title')->toArray();

    // Erstellen Sie das Mapping basierend auf den Produkt-Titeln
    foreach ($oldProducts as $title => $oldId) {
        if (isset($newProducts[$title])) {
            $productIdMap[$oldId] = $newProducts[$title];
        }
    }

    // Debug: Map anzeigen
    Log::info('Product ID Map: ' . json_encode($productIdMap));

    return $productIdMap;
}





    // Kopiert die Ingredients Knoten für einen neuen Shop
    public function copyIngredientNodes($originalIngredientNodes, $newShopId, $ingredientIdMap)
    {
        foreach ($originalIngredientNodes as $originalNode) {
            $newNode = $originalNode->replicate();
            $newNode->shop_id = $newShopId;

            // Aktualisiere die ingredient_id falls vorhanden
            if (isset($ingredientIdMap[$originalNode->ingredients_id])) {
                $newNode->ingredients_id = $ingredientIdMap[$originalNode->ingredients_id];
            }

            $newNode->save();
        }
    }


    protected function copyProductImage($originalProduct, $newProduct)
    {
        $shopId = $newProduct->shop_id;

        // Überprüfen, ob ein Bild vorhanden ist
        if ($originalProduct->product_image) {
            // Pfad zum Originalbild
            $originalImagePath = public_path('uploads/shops/' . $originalProduct->shop_id . '/images/products/' . $originalProduct->product_image);

            // Zielverzeichnis für das neue Bild im öffentlichen Verzeichnis
            $targetDirectory = public_path('uploads/shops/' . $shopId . '/images/products/');

            // Dateiname des Bildes
            $imageName = basename($originalImagePath);

            // Prüfen, ob das Originalbild existiert
            if (File::exists($originalImagePath)) {
                // Prüfen, ob das Zielverzeichnis existiert, andernfalls erstellen
                if (!File::exists($targetDirectory)) {
                    File::makeDirectory($targetDirectory, 0777, true, true);
                }

                // Kopieren des Bildes
                File::copy($originalImagePath, $targetDirectory . $imageName);

                // Aktualisieren des Bildpfads im neuen Produkt
                $newProduct->product_image = $imageName;
                $newProduct->save();
            } else {
                Log::info("Bild nicht gefunden: $originalImagePath");
            }
        }
    }
}
