<?php

namespace App\Imports;

use App\Models\ModCategory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Session;

class CategoriesSheetImport implements ToCollection, WithHeadingRow
{
    protected $shopId;
    protected $categoryMap;

    /**
     * Constructor to initialize the import class with shop ID and category map.
     *
     * @param int $shopId The ID of the shop.
     * @param array $categoryMap Reference to the category mapping array.
     */
    public function __construct($shopId, &$categoryMap)
    {
        $this->shopId = $shopId;
        $this->categoryMap = &$categoryMap; // Use reference here

        // Log the initialization of the category map
        // Log::info('Initializing CategoriesSheetImport with shop ID: ' . $shopId);
        // Log::info('Initial CategoryMap:', $categoryMap);
    }

    /**
     * Process each row of the Excel sheet and import/update categories.
     *
     * @param Collection $rows Collection of rows from the Excel sheet.
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Create folder path for the new shop if it doesn't exist
            $shopFolderPath = public_path("uploads/shops/{$this->shopId}/images/category");
            if (!File::exists($shopFolderPath)) {
                File::makeDirectory($shopFolderPath, 0755, true); // Create the directory with correct permissions
            }

            // Image path from the old shop ID
            $oldShopId = $row['shop_id'];
            $oldImagePath = public_path("uploads/shops/{$oldShopId}/images/category/{$row['category_image']}");

            // If the image exists in the old folder, copy it to the new directory
            if (File::exists($oldImagePath)) {
                $newImagePath = $shopFolderPath . '/' . $row['category_image'];
                File::copy($oldImagePath, $newImagePath); // Copy the image to the new directory
            }

            // Create or update the category
            $category = ModCategory::updateOrCreate(
                ['shop_id' => $this->shopId, 'category_name' => $row['category_name']],
                [
                    'category_name' => $row['category_name'],
                    'category_image' => $row['category_image'] ?? 'default_image.jpg',
                    'category_description' => $row['category_description'] ?? null,
                    'ordering' => $row['ordering'] ?? 100000,
                    'show_in_list' => $row['show_in_list'] ?? 1,
                    'published' => $row['published'] ?? 1,
                    'parent' => $row['parent'] ?? null,
                ]
            );

            // Map the old ID (id in the Excel file) to the new ID
            $this->categoryMap[$row['id']] = $category->id;

            // Log the mapping information
            // Log::info('Mapping Category ID:', [
            //     'original_category_id' => $row['id'],
            //     'new_category_id' => $category->id
            // ]);
        }

        // Save the updated categoryMap in the session
        Session::put('categoryMap', $this->categoryMap);
        $storedCategoryMap = Session::get('categoryMap');

        // Log the final categoryMap
        // Log::info('Final CategoryMap:', $this->categoryMap);

        // Check if the value is saved in the session
        Session::put('testKey', '1');
    }
}
