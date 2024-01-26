<?php

namespace App\Livewire\Backend;

use App\Models\ModShop;
use Livewire\Component;
use App\Models\DeliveryArea;

class ModDeliveryArea extends Component
{
    public $shop;
    public $deliveryAreas;
    public $createFormVisible = false;
    public $distance_km;
    public $delivery_cost;
    public $delivery_charge;
    public $free_delivery_threshold;
    public $min_delivery_threshold;


    protected $rules = [
        'distance_km' => 'required|numeric',
        'delivery_cost' => 'required|numeric',
        'free_delivery_threshold' => 'required|numeric',
        'delivery_charge' => 'required|numeric',
    ];



    public function mount(ModShop $shop, DeliveryArea $deliveryAreas)
    {
        $this->deliveryAreas = $deliveryAreas;
        $this->shop = ModShop::find(350);
    }

    public function render()
    {
        $this->deliveryAreas = DeliveryArea::all();
        return view('livewire.backend.mod-delivery-area');
    }

    public function toggleCreateForm()
    {
        $this->createFormVisible = !$this->createFormVisible;
    }

    public function createDeliveryArea()
    {
        $this->validate();

        // Beispiel: Dummy-Koordinaten für den Shop
        $shopLatitude = 52.2752536;
        $shopLongitude = 10.5345822;

        $coordinates = $this->calculateNewCoordinates($shopLatitude, $shopLongitude);

        // Berechne den Radius in Metern
        $radius = $this->distance_km * 1000;

        // Berechne die Farbe basierend auf der Entfernung (ein einfaches Beispiel)
        $color = $this->calculateColor($this->distance_km);

        DeliveryArea::create([
            'shop_id' => $this->shop->id,
            'distance_km' => $this->distance_km,
            'delivery_cost' => $this->delivery_cost,
            'free_delivery_threshold' => $this->free_delivery_threshold,
            'delivery_charge' => $this->delivery_charge,
            'latitude' => $coordinates['latitude'],
            'longitude' => $coordinates['longitude'],
            'radius' => $radius,
            'color' => $color,
        ]);

        $this->resetInputFields();
        $this->toggleCreateForm();
        $this->render(); // Aktualisiere die Anzeige der Tabelle
    }

    private function resetInputFields()
    {
        $this->distance_km = '';
        $this->delivery_cost = '';
        $this->free_delivery_threshold = '';
        $this->delivery_charge = '';
    }


    public function deleteDeliveryArea($id)
{
    DeliveryArea::find($id)->delete();
    $this->render(); // Aktualisiere die Anzeige der Tabelle
}


// Hilfsmethode zur Berechnung neuer Koordinaten
private function calculateNewCoordinates($latitude, $longitude)
{
    // Radius der Erde in Kilometern
    $earthRadius = 6371;

    // Mindestradius (z.B. 100 Meter)
    $minRadius = 0.1; // In Kilometern

    // Umrechnung der Entfernung in Bogenmaß
    $distanceInRadians = max($this->distance_km / $earthRadius, $minRadius / $earthRadius);

    // Berechnung neuer Koordinaten
    $newLatitude = rad2deg(asin(sin(deg2rad($latitude)) * cos($distanceInRadians) + cos(deg2rad($latitude)) * sin($distanceInRadians) * cos(0)));
    $newLongitude = rad2deg(deg2rad($longitude) + atan2(sin(0) * sin($distanceInRadians) * cos(deg2rad($latitude)), cos($distanceInRadians) - sin(deg2rad($latitude)) * sin(deg2rad($newLatitude))));

    return [
        'latitude' => $newLatitude,
        'longitude' => $newLongitude,
    ];
}

// Hilfsmethode zur Berechnung der Farbe basierend auf der Entfernung
private function calculateColor($distance)
{
    // Hier könntest du deine eigene Logik für die Farbberechnung implementieren
    // Beispiel: je weiter die Entfernung, desto "kälter" die Farbe
    if ($distance < 5) {
        return '#FF0000'; // Rot
    } elseif ($distance < 10) {
        return '#00FF00'; // Grün
    } else {
        return '#0000FF'; // Blau
    }
}

public function refresh()
{
    // Hier kannst du Logik hinzufügen, die du vor dem Neuladen ausführen möchtest

    $this->render(); // Neuladen der Livewire-Komponente
}

}
