<?php

namespace App\Imports;

use App\Models\ModProducts;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Session;

class ProductsImport implements ToCollection
{
    protected $newShopId;

    public function __construct($newShopId)
    {
        $this->newShopId = $newShopId;
    }

    public function collection(Collection $rows)
    {
        // Initialisiere das productSize Array
        $productSizeMap = [];

        foreach ($rows as $row) {
            if ($row[0] === 'ID') {
                continue; // Überspringe die Kopfzeile
            }

            // Werte für sales_count, product_amount, deleted, product_featured setzen
            $salesCount = $row[9] !== null ? $row[9] : 0;
            $productAmount = $row[10] !== null ? $row[10] : 0;
            $deleted = $row[20] !== null ? $row[20] : 0;
            $productfeatured = $row[21] !== null ? $row[21] : 0;

            // Überprüfen, ob size_id vorhanden ist und nicht 0 oder null ist
            if (!empty($row[3])) {
                // Produkt-ID und zugehörige size_id zur Map hinzufügen
                $productSizeMap[$row[0]] = $row[3];
            }

            // Produktdaten aktualisieren oder erstellen
            ModProducts::updateOrCreate(
                ['id' => $row[0]], // Update existing or create new
                [
                    'shop_id' => $this->newShopId,
                    'category_id' => $row[2],
                    'bottles_id' => $row[3],
                    'product_code' => $row[4],
                    'product_title' => $row[5],
                    'product_anonce' => $row[6],
                    'product_description' => $row[7],
                    'base_price' => $row[8],
                    'sales_count' => $salesCount,
                    'product_amount' => $productAmount,
                    'product_image' => $row[11],
                    'product_image_from_gallery' => $row[12],
                    'additives_ids' => $row[13],
                    'allergens_ids' => $row[14],
                    'product_slug' => $row[15],
                    'product_date' => $row[16],
                    'product_ordering' => $row[17],
                    'produckt_show_in_list' => $row[18],
                    'product_published' => $row[19],
                    'deleted' => $deleted,
                    'product_featured' => $productfeatured,
                    'product_parent' => $row[22],
                ]
            );
        }

        // Speichern der productSizeMap in der Session
        Session::put('productSizeMap', $productSizeMap);
    }
}
