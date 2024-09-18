<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Models\ModProductSizesPrices;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ModProductSizesPricesSheetImport implements ToCollection, WithHeadingRow
{
    protected $shopId;

    public function __construct($shopId)
    {
        $this->shopId = $shopId;
        Log::info('Shop ID initialized:', ['shopId' => $this->shopId]);
    }

    public function collection(Collection $rows)
    {
        // Alte zu neue parent-IDs Mapping
      //  $parentIdMapping = [
      //      37 => 39, // Alte ID => Neue ID
      //      42 => 43,
      //  ];

        $parentIdMapping = Session::get('productNewIds');
        Log::info('Product New IDs:', $parentIdMapping);

        //dd($productNewIds);

        // Mapping für die alte und neue Größen-ID (size_id)
        $oldSizeMap = Session::get('sizeMap');
        $newSizeMap = array_flip($oldSizeMap); // Alte IDs als Keys, neue IDs als Values

        Log::info('Flip Size Map:', $newSizeMap);

        foreach ($rows as $row) {
            try {
                // Gültigkeit der Zeile prüfen
                $this->validateRow($row);

                // Alte size_id aus der Excel-Zeile holen
                $oldSizeId = $row['size_id'];

                // Prüfen, ob die alte size_id im Mapping vorhanden ist
                if (array_key_exists($oldSizeId, $oldSizeMap)) {
                    // Neue size_id finden
                    $newSizeId = $oldSizeMap[$oldSizeId];

                    // Parent ID aktualisieren, wenn ein Mapping vorhanden ist
                    $parent = $row['parent'] ?? null;
                    if ($parent && isset($parentIdMapping[$parent])) {
                        $parent = $parentIdMapping[$parent];
                    }

                    // Preis-Daten vorbereiten
                    $priceData = [
                        'shop_id' => $this->shopId,
                        'size_id' => $newSizeId,
                        'parent' => $parent,
                        'price' => $row['price'] ?? 0.00,
                        'visibility' => $row['visibility'] ?? 1,
                        'action_id' => $row['action_id'] ?? 0,
                        'action_price' => $row['action_price'] ?? 0.00,
                        'ordering' => $row['ordering'] ?? 10000,
                        'updated_at' => now(),
                        'created_at' => now(),
                    ];

                    // Daten speichern
                    $this->saveRawData($priceData);
                } else {
                    Log::warning('No new size_id found for old size_id in row:', ['old_size_id' => $oldSizeId]);
                }
            } catch (ValidationException $e) {
                Log::error('Validation failed for row:', ['row' => $row->toArray(), 'errors' => $e->errors()]);
            }
        }
    }

    protected function validateRow($row)
    {
        // Erstellen eines Validators für die Zeilenvalidierung
        $validator = Validator::make($row->toArray(), [
            'size_id' => 'required|integer',
            'parent' => 'nullable|integer',
            'price' => 'nullable|numeric',
            'visibility' => 'nullable|integer',
            'action_id' => 'nullable|integer',
            'action_price' => 'nullable|numeric',
            'ordering' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    protected function saveRawData($priceData)
    {
        Log::info('Saving raw data:', $priceData);

        // Verwende updateOrCreate, um entweder neue Datensätze zu erstellen oder vorhandene zu aktualisieren
        ModProductSizesPrices::updateOrCreate(
            [
                'shop_id' => $priceData['shop_id'],
                'size_id' => $priceData['size_id'],
                'parent' => $priceData['parent'],
                'ordering' => $priceData['ordering']
            ],
            $priceData
        );
    }
}
