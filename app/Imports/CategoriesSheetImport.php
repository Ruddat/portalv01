<?php

namespace App\Imports;

use App\Models\ModCategory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CategoriesSheetImport implements ToCollection, WithHeadingRow
{
    protected $shopId;
    protected $categoryMap;

    public function __construct($shopId, &$categoryMap)
    {
        $this->shopId = $shopId;
        $this->categoryMap = &$categoryMap; // Referenz auf Mapping-Array
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Ordnerpfad für den neuen Shop erstellen, falls nicht vorhanden
            $shopFolderPath = public_path("uploads/shops/{$this->shopId}/images/category");
            if (!File::exists($shopFolderPath)) {
                File::makeDirectory($shopFolderPath, 0755, true); // Erstelle das Verzeichnis mit korrekten Berechtigungen
            }

            // Bildpfad aus der alten Shop-ID
            $oldShopId = $row['shop_id'];
            $oldImagePath = public_path("uploads/shops/{$oldShopId}/images/category/{$row['category_image']}");

            // Wenn das Bild im alten Ordner existiert, kopiere es ins neue Verzeichnis
            if (File::exists($oldImagePath)) {
                $newImagePath = $shopFolderPath . '/' . $row['category_image'];
                File::copy($oldImagePath, $newImagePath); // Kopiere das Bild in das neue Verzeichnis
            }

            // Erstelle oder aktualisiere die Kategorie
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

            // Mapping der alten ID (id in der Excel-Datei) auf die neue ID
            $this->categoryMap[$row['id']] = $category->id;
        }
    }
}
