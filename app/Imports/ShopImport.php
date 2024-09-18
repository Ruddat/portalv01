<?php

namespace App\Imports;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterImport;

class ShopImport implements WithMultipleSheets, WithEvents
{
    protected $shopId;
    protected $categoryMap = [];
    protected $productMap = [];
    protected $sizeMap = [];

    public function __construct($shopId)
    {
        $this->shopId = $shopId;

        // Leere die Session zu Beginn des Imports
        Session::forget('categoryMap');
        Session::forget('productMap');
        Session::forget('sizeMap');

        Log::info('Starting import for shop ID: ' . $shopId);

        // Fester Wert zum Testen in die Session schreiben
Session::put('testKey', 'TestValue');

// Überprüfen, ob der Wert in der Session gespeichert wurde
$testValue = Session::get('testKey', 'default');
Log::info('Test session value: ' . $testValue);

    }

    public function sheets(): array
    {
        // Hole die Maps aus der Session, falls sie existieren
        $this->categoryMap = Session::get('categoryMap', []); // Beachte: Zugriff auf die Objekt-Variable
        $this->productMap = Session::get('productMap', []);
        $this->sizeMap = Session::get('sizeMap', []);

        return [
            'Categories' => new CategoriesSheetImport($this->shopId, $this->categoryMap), // Referenz auf categoryMap
            'Products' => new ProductsSheetImport($this->shopId, $this->categoryMap, $this->productMap), // Referenz auf productMap
            'ProductSizes' => new ProductSizesSheetImport($this->shopId, $this->productMap, $this->sizeMap),
            'ProductSizesPrices' => new ModProductSizesPricesSheetImport($this->shopId, $this->productMap, $this->sizeMap),
        ];
    }

    // Diese Methode wird nach Abschluss des Imports aufgerufen
    public function afterImport()
    {
        // Überprüfe, ob der Wert korrekt gespeichert wurde
        $testValue = Session::get('testKey', 'default');
        Log::info('Test session value: ' . $testValue);

        // Log das finale Mapping für alle relevanten Daten
        Log::info('Final CategoryMap:', $this->categoryMap);
        Log::info('Final ProductMap:', $this->productMap);
        Log::info('Final SizeMap:', $this->sizeMap);
    }

    // Hier registrieren wir die Events
    public function registerEvents(): array
    {
        return [
            AfterImport::class => function(AfterImport $event) {
                $this->afterImport(); // Aufruf der Methode afterImport nach dem Import
            },
        ];
    }
}
