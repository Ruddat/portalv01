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

            // Logo kopieren
            if (isset($options['logo']) && $options['logo']) {
                $this->copyLogo($originalShop, $newShop);
            }


            // Kategorien, Größen und Produkte kopieren
            $categoryIdMap = [];
            $sizeIdMap = [];
            if (isset($options['articles']) && $options['articles']) {

                // Kategorien kopieren
                $categoryIdMap = $this->copyCategories($originalShop, $newShop);

                // Größen kopieren
                $sizeIdMap = $this->copySizes($originalShop, $newShop);

                // Kategorien mit neuen Größen-IDs aktualisieren
                $this->updateCategorySizes($newShop, $categoryIdMap, $sizeIdMap);

                // Produkte kopieren
                $productIdMap = $this->copyProducts($originalShop, $newShop, $categoryIdMap, $sizeIdMap);


                // Produktgrößenpreise kopieren
                $this->copyProductSizesPrices($originalShop, $newShop, $productIdMap, $sizeIdMap);


                // Zutaten kopieren
                $ingredientIdMap = $this->copyIngredients($originalShop, $newShop, $sizeIdMap);

                $this->copyIngredientNodes($originalShop, $newShop, $productIdMap, $ingredientIdMap);


                Log::info('Produkt ID Karte: ' . print_r($productIdMap, true));
                Log::info('Zutaten ID Karte: ' . print_r($ingredientIdMap, true));
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

            // Öffnungszeiten kopieren, wenn ausgewählt
            if (isset($options['openingHours']) && $options['openingHours']) {
                $this->copyOpeningHours($originalShop, $newShop);
            }


            // Liefergebiet kopieren, wenn ausgewählt
            if (isset($options['deliveryArea']) && $options['deliveryArea']) {
                $this->copyDeliveryAreas($originalShop, $newShop);
            }

            DB::commit();

            return $newShop;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

    }




    protected function copyCategories($originalShop, $newShop)
    {
        $categoryIdMap = [];

        // Alle Kategorien des Originalshops abrufen
        $originalCategories = ModCategory::where('shop_id', $originalShop->id)->get();

        foreach ($originalCategories as $originalCategory) {
            // Kategorie replizieren
            $newCategory = $originalCategory->replicate();
            $newCategory->shop_id = $newShop->id;
            $newCategory->save();

             // Kopiere das Kategoriebild, falls vorhanden
            $this->copyCategoryImage($originalCategory, $newCategory);

            // Kategorie-ID-Karte erstellen
            $categoryIdMap[$originalCategory->id] = $newCategory->id;

            Log::info("Kategorie kopiert: Original ID {$originalCategory->id} -> Neue ID {$newCategory->id}");
        }

        return $categoryIdMap;
    }

    protected function copySizes($originalShop, $newShop)
    {
        $sizeIdMap = [];

        // Alle Größen des Originalshops abrufen
        $originalSizes = ModProductSizes::where('shop_id', $originalShop->id)->get();

        foreach ($originalSizes as $originalSize) {
            // Größe replizieren
            $newSize = $originalSize->replicate();
            $newSize->shop_id = $newShop->id;
            $newSize->save();

            // Größen-ID-Karte erstellen
            $sizeIdMap[$originalSize->id] = $newSize->id;

            Log::info("Größe kopiert: Original ID {$originalSize->id} -> Neue ID {$newSize->id}");
        }

        return $sizeIdMap;
    }

    protected function copyProductSizesPrices($originalShop, $newShop, $productIdMap, $sizeIdMap)
    {
        // Alle Preise des Originalshops abrufen
        $originalPrices = ModProductSizesPrices::where('shop_id', $originalShop->id)->get();

        foreach ($originalPrices as $originalPrice) {
            // Preis replizieren
            $newPrice = $originalPrice->replicate();
            $newPrice->shop_id = $newShop->id;
            $newPrice->size_id = $sizeIdMap[$originalPrice->size_id] ?? $originalPrice->size_id;
            $newPrice->parent = $productIdMap[$originalPrice->parent] ?? $originalPrice->parent;
            $newPrice->id = null; // Letting Laravel handle the ID
            $newPrice->save();

            Log::info("Preis kopiert: Original ID {$originalPrice->id} -> Neue ID {$newPrice->id}");
        }
    }



    protected function copyIngredients($originalShop, $newShop, $sizeIdMap)
    {
        $ingredientIdMap = [];

        // Alle Zutaten des Originalshops abrufen
        $originalIngredients = ModProductsIngredients::where('shop_id', $originalShop->id)->get();

        foreach ($originalIngredients as $originalIngredient) {
            // Zutat replizieren
            $newIngredient = $originalIngredient->replicate();
            $newIngredient->shop_id = $newShop->id;
            $newIngredient->parent = $ingredientIdMap[$originalIngredient->parent] ?? $originalIngredient->parent;

            // Sicherstellen, dass sizes_category ein Array ist
            $sizesCategoryArray = json_decode($originalIngredient->sizes_category, true);
            if (!is_array($sizesCategoryArray)) {
                $sizesCategoryArray = [];
            }

            $newIngredient->sizes_category = json_encode(array_map(function ($sizeCategoryId) use ($sizeIdMap) {
                return $sizeIdMap[$sizeCategoryId] ?? $sizeCategoryId;
            }, $sizesCategoryArray));

            $newIngredient->id = null; // Letting Laravel handle the ID
            $newIngredient->save();

            // Zutaten-ID-Karte erstellen
            $ingredientIdMap[$originalIngredient->id] = $newIngredient->id;

            // Preise kopieren
            $this->copyIngredientPrices($originalIngredient, $newIngredient, $sizeIdMap);

            Log::info("Zutat kopiert: Original ID {$originalIngredient->id} -> Neue ID {$newIngredient->id}");
        }

        return $ingredientIdMap;
    }

    protected function copyIngredientPrices($originalIngredient, $newIngredient, $sizeIdMap)
    {
        $originalPrices = ModProductsIngredientsPrices::where('parent', $originalIngredient->id)->get();

        foreach ($originalPrices as $originalPrice) {
            $newPrice = $originalPrice->replicate();
            $newPrice->parent = $newIngredient->id;
            $newPrice->size_id = $sizeIdMap[$originalPrice->size_id] ?? $originalPrice->size_id;
            $newPrice->id = null; // Letting Laravel handle the ID
            $newPrice->save();

            Log::info("Zutatenpreis kopiert: Original ID {$originalPrice->id} -> Neue ID {$newPrice->id}");
        }
    }

    protected function copyIngredientNodes($originalShop, $newShop, $productIdMap, $ingredientIdMap)
    {
        // Alle Nodes des Originalshops abrufen
        $originalNodes = ModProductIngredientsNodes::where('shop_id', $originalShop->id)->get();

        foreach ($originalNodes as $originalNode) {
            // Node replizieren
            $newNode = $originalNode->replicate();
            $newNode->shop_id = $newShop->id;
            $newNode->parent = $productIdMap[$originalNode->parent] ?? $originalNode->parent;
            $newNode->ingredients_id = $ingredientIdMap[$originalNode->ingredients_id] ?? $originalNode->ingredients_id;
            $newNode->id = null; // Letting Laravel handle the ID
            $newNode->save();

            Log::info("Node kopiert: Original ID {$originalNode->id} -> Neue ID {$newNode->id}");
        }
    }

    protected function updateCategorySizes($newShop, $categoryIdMap, $sizeIdMap)
    {
        // Alle Kategorien des neuen Shops abrufen
        $newCategories = ModCategory::where('shop_id', $newShop->id)->get();

        foreach ($newCategories as $newCategory) {
            if (isset($sizeIdMap[$newCategory->sizes_category])) {
                $newCategory->sizes_category = $sizeIdMap[$newCategory->sizes_category];
                $newCategory->save();

                Log::info("Kategorie aktualisiert: Neue Kategorie ID {$newCategory->id} mit neuer Größenkategorie ID {$newCategory->sizes_category}");
            }
        }
    }


    protected function copyProducts($originalShop, $newShop, $categoryIdMap, $sizeIdMap)
    {
        $productIdMap = [];

        // Alle Produkte des Originalshops abrufen
        $originalProducts = ModProducts::where('shop_id', $originalShop->id)->get();

        foreach ($originalProducts as $originalProduct) {
            // Produkt replizieren
            $newProduct = $originalProduct->replicate();
            $newProduct->shop_id = $newShop->id;
            $newProduct->category_id = $categoryIdMap[$originalProduct->category_id] ?? $originalProduct->category_id;
            $newProduct->save();

            // Bild kopieren
            $this->copyProductImage($originalProduct, $newProduct);

            // Produkt-ID-Karte erstellen
            $productIdMap[$originalProduct->id] = $newProduct->id;

            Log::info("Produkt kopiert: Original ID {$originalProduct->id} -> Neue ID {$newProduct->id}");
        }

        return $productIdMap;
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


    protected function generateNewShopNr()
    {
        return 'NEW_SHOP_NR_' . uniqid();
    }

    protected function copyLogo($originalShop, $newShop)
    {
        if ($originalShop->logo) {
            $newLogoDirectory = public_path('uploads/shops/' . $newShop->id . '/images/');
            $newLogoPath = $newLogoDirectory . basename($originalShop->logo);

            $originalLogoPath = public_path('uploads/shops/' . $originalShop->id . '/images/' . basename($originalShop->logo));

            // Erstellen des neuen Verzeichnisses, falls es nicht existiert und Schreibrechte setzen
            if (!File::exists($newLogoDirectory)) {
                File::makeDirectory($newLogoDirectory, 0777, true);
            }

            // Kopieren des Logos
            File::copy($originalLogoPath, $newLogoPath);

            // Aktualisieren des neuen Shop-Eintrags mit dem neuen Logo-Pfad
            $newShop->logo = $originalShop->logo;
            $newShop->save();

            Log::info("Logo kopiert für neuen Shop mit ID: {$newShop->id} nach {$newLogoPath}");
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


    protected function copyOpeningHours($originalShop, $newShop)
    {
        // Öffnungszeiten kopieren
        $originalOpeningHours = $originalShop->openingHours()->get();
        foreach ($originalOpeningHours as $originalOpeningHour) {
            $newOpeningHour = $originalOpeningHour->replicate();
            $newOpeningHour->shop_id = $newShop->id;
            $newOpeningHour->save();
        }

        // Feiertage kopieren, aber nur zukünftige
        $originalHolidays = $originalShop->holidays()->get();
        $currentDate = now()->format('Y-m-d'); // Aktuelles Datum im Format YYYY-MM-DD

        foreach ($originalHolidays as $originalHoliday) {
            // Annahme: das Datum des Feiertages ist in einem Feld namens 'holiday_date'
            if ($originalHoliday->holiday_date >= $currentDate) {
                $newHoliday = $originalHoliday->replicate();
                $newHoliday->shop_id = $newShop->id;
                $newHoliday->save();
            }
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


}
