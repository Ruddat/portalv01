<?php

namespace App\Imports;

use App\Models\ModCategory;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CategoriesImport implements ToCollection
{
    protected $newShopId;

    public function __construct($newShopId)
    {
        $this->newShopId = $newShopId;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if ($row[0] === 'ID') {
                continue; // Skip the header row
            }

            // Überprüfen, ob der Slug bereits existiert
            $originalSlug = $row[4];
            $slug = $originalSlug;
            $counter = 1;

            while (ModCategory::where('category_slug', $slug)->where('shop_id', $this->newShopId)->exists()) {
                $slug = $originalSlug . '-' . $counter; // Slug wird geändert
                $counter++;
            }

            // Erstelle das Zielverzeichnis, falls es nicht existiert
            $targetDirectory = public_path("uploads/shops/{$this->newShopId}/images/category");
            if (!File::exists($targetDirectory)) {
                File::makeDirectory($targetDirectory, 0755, true, true);
            }

            // Kopiere das Bild, falls es existiert
            if (!empty($row[5])) {
                $oldImagePath = public_path("uploads/shops/{$row[1]}/images/category/{$row[5]}");
                if (File::exists($oldImagePath)) {
                    $newImagePath = "uploads/shops/{$this->newShopId}/images/category/{$row[5]}";
                    File::copy($oldImagePath, public_path($newImagePath));
                }
            }

            // Kopiere das Bild aus der Gallery, falls es existiert
            if (!empty($row[6])) {
                $oldImagePath = public_path("uploads/shops/{$row[1]}/images/category/{$row[6]}");
                if (File::exists($oldImagePath)) {
                    $newImagePath = "uploads/shops/{$this->newShopId}/images/category/{$row[6]}";
                    File::copy($oldImagePath, public_path($newImagePath));
                }
            }

            ModCategory::updateOrCreate(
                [
                    // 'category_slug' => $slug,
                    'shop_id' => $this->newShopId
                ],
                [
                    'sizes_category' => $row[2],
                    'category_name' => $row[3],
                    'category_image' => $row[5],
                    'category_image_from_gallery' => $row[6],
                    'category_description' => $row[7],
                    'ordering' => $row[8],
                    'show_in_list' => $row[9],
                    'published' => $row[10],
                    'parent' => $row[11],
                ]
            );
        }
    }
}
