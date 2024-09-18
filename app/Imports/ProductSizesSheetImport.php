<?php

namespace App\Imports;

use App\Models\ModCategory;
use App\Models\ModProducts;
use App\Models\ModProductSizes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductSizesSheetImport implements ToCollection, WithHeadingRow
{
    protected $shopId;
    protected $productMap = [];
    protected $sizeMap = [];
    protected $newSizeMap = [];
    protected $categoryMap = [];
    protected $productSizeArray = []; // Neues Array zum Speichern der Produktgrößen

    public function __construct($shopId)
    {
        $this->shopId = $shopId;
        $this->productMap = Session::get('productMap', []);
        $this->sizeMap = Session::get('sizeMap', []);
        $this->newSizeMap = Session::get('newSizeMap', []);
        $this->categoryMap = Session::get('categoryMap', []);
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Wenn keine Parent ID vorhanden ist (Hauptgröße)
            if (empty($row['parent']) || $row['parent'] == 0) {
                $existingProduct = ModProductSizes::where('shop_id', $this->shopId)
                    ->where('parent', 0)
                    ->where('title', $row['title'])
                    ->first();

                $newData = [
                    'shop_id' => $this->shopId,
                    'parent' => 0,
                    'title' => $row['title'],
                    'date' => $row['date'] ?? now(),
                    'ordering' => $row['ordering'] ?? 10000,
                    'published' => $row['published'] ?? 1,
                    'current' => $row['current'] ?? 1,
                    'display' => $row['display'] ?? 1,
                    'created_at' => $row['created_at'] ?? now(),
                    'updated_at' => $row['updated_at'] ?? now(),
                ];

                if ($existingProduct) {
                    $existingProduct->update($newData);
                    $this->productMap[$row['id']] = $existingProduct->id;
                   // $this->productSizeArray[$existingProduct->id] = $existingProduct->title;
                } else {
                    $product = ModProductSizes::create($newData);
                    $this->productMap[$row['id']] = $product->id;
                 //   $this->productSizeArray[$product->id] = $product->title; // Hauptgröße zur Array-Liste hinzufügen
                }
            } else {
                // Wenn eine Parent ID vorhanden ist (Untergröße)
                $parentId = $this->productMap[$row['parent']] ?? null;

                if ($parentId) {
                    $existingProduct = ModProductSizes::where('shop_id', $this->shopId)
                        ->where('parent', $parentId)
                        ->where('title', $row['title'])
                        ->first();

                    $newData = [
                        'shop_id' => $this->shopId,
                        'parent' => $parentId,
                        'title' => $row['title'],
                        'date' => $row['date'] ?? now(),
                        'ordering' => $row['ordering'] ?? 10000,
                        'published' => $row['published'] ?? 1,
                        'current' => $row['current'] ?? 1,
                        'display' => $row['display'] ?? 1,
                        'created_at' => $row['created_at'] ?? now(),
                        'updated_at' => $row['updated_at'] ?? now(),
                    ];

                    if ($existingProduct) {
                        $existingProduct->update($newData);
                        $this->sizeMap[$row['id']] = $existingProduct->id;
                        $this->newSizeMap[$existingProduct->id] = $row['id'];
                   //     $this->productSizeArray[$existingProduct->id] = $existingProduct->title; // Untergröße zur Array-Liste hinzufügen
                        $this->productSizeArray[$existingProduct->id] = $existingProduct->id; // ID statt Titel
                    } else {
                        $product = ModProductSizes::create($newData);
                        $this->sizeMap[$row['id']] = $product->id;
                        $this->newSizeMap[$product->id] = $row['id'];
                     //   $this->productSizeArray[$product->id] = $product->title; // Untergröße zur Array-Liste hinzufügen
                        $this->productSizeArray[$product->id] = $product->id; // ID statt Titel

                    }
                }
            }
        }

        // Mappings in der Session speichern
        Session::put('productMap', $this->productMap);
        Session::put('sizeMap', $this->sizeMap);
        Session::put('newSizeMap', $this->newSizeMap);

        // Produktgrößen-Array in der Session speichern (oder verwenden)
        Session::put('productSizeArray', $this->productSizeArray);

        // Optional: Größen in den Produkten aktualisieren
        $this->updateProductSizesWithNewIds();
    }

    protected function updateProductSizesWithNewIds()
    {
        $products = ModProducts::where('shop_id', $this->shopId)->get();

        foreach ($products as $product) {
            $oldSizeId = $product->size_id;
            $newSizeId = $this->sizeMap[$oldSizeId] ?? null;

            if ($newSizeId) {
                $product->update(['size_id' => $newSizeId]);
            }
        }
    }
}
