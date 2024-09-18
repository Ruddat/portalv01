<?php

namespace App\Imports;

use App\Models\ModProducts;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class ProductsSheetImport implements ToCollection, WithHeadingRow
{
    protected $shopId;
    protected $categoryMap;
    protected $productMap;

    /**
     * Constructor to initialize the import class with shop ID and maps.
     *
     * @param int $shopId The ID of the shop.
     * @param array $categoryMap Reference to the category mapping array.
     * @param array $productMap Reference to the product mapping array.
     */
    public function __construct($shopId, &$categoryMap, &$productMap)
    {
        $this->shopId = $shopId;
        $this->productMap = &$productMap;    // Use reference

        // Log the initialization of the maps
        // Log::info('Initializing ProductsSheetImport with shop ID: ' . $shopId);
        // Log::info('Initial CategoryMap:', $categoryMap);
        // Log::info('Initial ProductMap:', $this->productMap);
    }

    /**
     * Process each row of the Excel sheet and import/update products.
     *
     * @param Collection $rows Collection of rows from the Excel sheet.
     */
    public function collection(Collection $rows)
    {
        // Initialisiere das productSizeMap Array
        $productSizeMap = [];
        $productNewIds = [];

        $categoryMap = Session::get('categoryMap');

        foreach ($rows as $row) {
            // Check if the category exists
            $categoryId = $categoryMap[$row['category_id']] ?? null;

            if ($categoryId) {
                // Create product image directory for the shop if it doesn't exist
                $shopFolderPath = public_path("uploads/shops/{$this->shopId}/images/products");
                if (!File::exists($shopFolderPath)) {
                    File::makeDirectory($shopFolderPath, 0755, true);
                }

                // Image processing
                $oldShopId = $row['shop_id'];
                $productImage = $row['product_image'] ?? null;
                if ($productImage && !is_dir($productImage)) {
                    $oldImagePath = public_path("uploads/shops/{$oldShopId}/images/products/{$productImage}");
                    if (File::exists($oldImagePath)) {
                        $newImagePath = $shopFolderPath . '/' . $productImage;
                        File::copy($oldImagePath, $newImagePath);
                    } else {
                        $productImage = null;
                    }
                } else {
                    $productImage = null;
                }

                // Überprüfen, ob size_id vorhanden ist und nicht 0 oder null ist
                if (!empty($row['size_id'])) {
                    // Produkt-ID und zugehörige size_id zur Map hinzufügen
                    $productSizeMap[$row['id']] = $row['size_id'];
                }

                // Create or update the product
                $product = ModProducts::updateOrCreate(
                    ['product_slug' => $row['product_slug'], 'shop_id' => $this->shopId],
                    [
                        'category_id' => $categoryId,
                        'size_id' => $row['size_id'],
                        'bottles_id' => $row['bottles_id'],
                        'product_code' => $row['product_code'],
                        'product_title' => $row['product_title'],
                        'product_anonce' => $row['product_anonce'] ?? null,
                        'product_description' => $row['product_description'] ?? null,
                        'base_price' => $row['base_price'] ?? 0,
                        'sales_count' => $row['sales_count'] ?? 0,
                        'product_amount' => $row['product_amount'] ?? 0,
                        'product_image' => $productImage,
                        'product_image_from_gallery' => $row['product_image_from_gallery'] ?? null,
                        'additives_ids' => $row['additives_ids'] ?? null,
                        'allergens_ids' => $row['allergens_ids'] ?? null,
                        'product_date' => $row['product_date'] ?? null,
                        'product_ordering' => $row['product_ordering'] ?? 100000,
                        'produckt_show_in_list' => $row['produckt_show_in_list'] ?? 1,
                        'product_published' => $row['product_published'] ?? 1,
                        'deleted' => $row['deleted'] ?? 0,
                        'product_featured' => $row['product_featured'] ?? 0,
                        'product_parent' => $row['product_parent'] ?? null
                    ]
                );

                // Map the old product ID to the new product ID
                $this->productMap[$row['id']] = $product->id;
                // Überprüfen, ob size_id vorhanden ist und nicht 0 oder null ist
                if (!empty($row['size_id'])) {
                    // Produkt-ID und zugehörige size_id zur Map hinzufügen
                    $productNewIds[$row['id']] = $product->id;
                }

                // Log the mapping information
                // Log::info('Mapping Product ID:', [
                //     'original_product_id' => $row['id'],
                //     'new_product_id' => $product->id
                // ]);
            }
        }

        // Save the updated productMap in the session
        Session::put('productMap', $this->productMap);

        // Speichern der productSizeMap in der Session
        Session::put('productSizeMap', $productSizeMap);

        // Speichern der productNewIds in der Session
        Session::put('productNewIds', $productNewIds);

        // Log the final productMap
        // Log::info('Final ProductMap:', $this->productMap);
    }
}
