<?php

namespace App\Imports;

use App\Models\ModProductsIngredients;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class ModProductIngredientsSheetImport implements ToModel, WithHeadingRow
{
    protected $shopId;
    protected $parentIdMapping = [];

    public function __construct($shopId)
    {
        $this->shopId = $shopId;
        Log::info('Shop ID initialized for ingredients import:', ['shopId' => $this->shopId]);
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        Log::info('Importing Ingredient:', $row);

        // Wenn die Zutat eine Hauptkategorie ist (parent = 0)
        if ($row['parent'] == 0) {
            // Neue Hauptkategorie anlegen oder aktualisieren
            $ingredient = ModProductsIngredients::updateOrCreate(
                [
                    'code_nr' => $row['code_nr'],
                    'shop_id' => $this->shopId
                ],
                [
                    'parent' => 0,  // Hauptkategorie
                    'shop_id' => $this->shopId,
                    'code_nr' => $row['code_nr'] ?? '',
                    'sizes_category' => $row['sizes_category'] ?? 0,
                    'max_spices' => $row['max_spices'] ?? 0,
                    'base_price' => $row['base_price'] ?? 0.00,
                    'title' => $row['title'] ?? null,
                    'count_as_extra' => $row['count_as_extra'] ?? 0,
                    'ordering' => $row['ordering'] ?? 100000,
                    'published' => $row['published'] ?? 1,
                    'created_at' => $row['created_at'] ?? now(),
                    'updated_at' => $row['updated_at'] ?? now(),
                ]
            );

            // Die neue ID der Hauptkategorie speichern
            $this->parentIdMapping[$row['id']] = $ingredient->id;

        } else {
            // Zutat mit Bezug auf eine Hauptkategorie importieren
            $parentId = $this->parentIdMapping[$row['parent']] ?? null;

            if ($parentId) {
                // Zutat anlegen oder aktualisieren
                ModProductsIngredients::updateOrCreate(
                    [
                        'code_nr' => $row['code_nr'],
                        'shop_id' => $this->shopId
                    ],
                    [
                        'parent' => $parentId,  // Neue ID der Hauptkategorie
                        'shop_id' => $this->shopId,
                        'code_nr' => $row['code_nr'] ?? '',
                        'sizes_category' => $row['sizes_category'] ?? 0,
                        'max_spices' => $row['max_spices'] ?? 0,
                        'base_price' => $row['base_price'] ?? 0.00,
                        'title' => $row['title'] ?? null,
                        'count_as_extra' => $row['count_as_extra'] ?? 0,
                        'ordering' => $row['ordering'] ?? 100000,
                        'published' => $row['published'] ?? 1,
                        'created_at' => $row['created_at'] ?? now(),
                        'updated_at' => $row['updated_at'] ?? now(),
                    ]
                );
            } else {
                Log::warning('Parent ID not found for ingredient:', $row);
            }
        }

        return null;
    }
}
