<?php

namespace App\Livewire\Backend;

use App\Models\ModShop;
use Livewire\Component;
use App\Models\DeliveryArea;

class ModDeliveryArea extends Component
{
    public $shopId = 1;
    public $shop;
    public $deliveryAreas;
    public $createFormVisible = false;
    public $maxDistanceKm; // Maximaldistanz für Lieferzonen
    public $distanceSteps = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 12, 13, 15, 16, 17, 18, 19, 20]; // Vordefinierte Entfernungsstufen
    public $edit_delivery_cost, $edit_free_delivery_threshold, $edit_delivery_charge;
    public $editFormVisible = false;
    public $currentDeliveryAreaId;
    public $selectedAreas = [];
    public $selectAll = false;


    protected $rules = [
        'maxDistanceKm' => 'required|numeric',
    ];

    public function mount(ModShop $shop, DeliveryArea $deliveryAreas)
    {
        $this->shopId = session('currentShopId');
        $this->deliveryAreas = $deliveryAreas;
        $this->shop = ModShop::find($this->shopId);
    }

    public function render()
    {
        $this->deliveryAreas = DeliveryArea::where('shop_id', $this->shopId)->get();
        return view('livewire.backend.mod-delivery-area');
    }

    public function toggleCreateForm()
    {
        $this->createFormVisible = !$this->createFormVisible;
    }

    public function createDeliveryAreas()
    {
        $this->validate();

        $shop = ModShop::findOrFail($this->shopId);
        $shopLatitude = $shop->lat;
        $shopLongitude = $shop->lng;

        foreach ($this->distanceSteps as $distanceKm) {
            if ($distanceKm > $this->maxDistanceKm) break;

            $coordinates = $this->calculateNewCoordinates($shopLatitude, $shopLongitude, $distanceKm);
           // dd($coordinates);

            $radius = $distanceKm * 1000;
            $color = $this->calculateColor($distanceKm);

            //dd($coordinates, $radius, $color);

            DeliveryArea::create([
                'shop_id' => $this->shop->id,
                'distance_km' => $distanceKm,
                'delivery_cost' => $this->calculateDeliveryCost($distanceKm),
                'free_delivery_threshold' => $this->calculateFreeDeliveryThreshold($distanceKm),
                'delivery_charge' => $this->calculateDeliveryCharge($distanceKm),
                'latitude' => $coordinates['latitude'],
                'longitude' => $coordinates['longitude'],
                'radius' => $radius,
                'color' => $color,
            ]);
        }

        $this->resetInputFields();
        $this->toggleCreateForm();
        $this->render();
        $this->js('window.location.reload()');

    }

    private function resetInputFields()
    {
        $this->maxDistanceKm = '';
    }

    private function calculateNewCoordinates($latitude, $longitude, $distanceKm)
    {
        if ($latitude === null || $longitude === null || $distanceKm === null) {
            // Fehlermeldung oder Standardwerte zurückgeben
            return null;
        }

        // Radius der Erde in Kilometern
        $earthRadius = 6371;

        // Umrechnung der Entfernung in Bogenmaß
        $distanceInRadians = $distanceKm / $earthRadius;

        // Berechnung neuer Koordinaten
        $newLatitude = rad2deg(asin(sin(deg2rad($latitude)) * cos($distanceInRadians) + cos(deg2rad($latitude)) * sin($distanceInRadians) * cos(0)));
        $newLongitude = rad2deg(deg2rad($longitude) + atan2(sin(0) * sin($distanceInRadians) * cos(deg2rad($latitude)), cos($distanceInRadians) - sin(deg2rad($latitude)) * sin(deg2rad($newLatitude))));

        return [
            'latitude' => $newLatitude,
            'longitude' => $newLongitude,
        ];
    }

    private function calculateColor($distance)
    {
        if ($distance === null) {
            return 'grey'; // Standardfarbe falls `null`
        }

        if ($distance <= 1) {
            return 'green';
        } elseif ($distance <= 5) {
            // Linearer Übergang von Grün (0,255,0) zu Gelb (255,255,0)
            $progress = ($distance - 1) / (5 - 1);
            $red = round(255 * $progress);
            $green = 255;
            $blue = 0;
            return "rgb($red, $green, $blue)";
        } elseif ($distance <= 10) {
            // Linearer Übergang von Gelb (255,255,0) zu Orange (255,165,0)
            $progress = ($distance - 5) / (10 - 5);
            $red = 255;
            $green = round(255 - $progress * (255 - 165));
            $blue = 0;
            return "rgb($red, $green, $blue)";
        } elseif ($distance <= 15) {
            // Linearer Übergang von Orange (255,165,0) zu Rot (255,0,0)
            $progress = ($distance - 10) / (15 - 10);
            $red = 255;
            $green = round(165 - $progress * 165);
            $blue = 0;
            return "rgb($red, $green, $blue)";
        } else {
            // Rot für Entfernungen über 15 km
            return "rgb(255, 0, 0)";
        }
    }


    private function calculateDeliveryCost($distanceKm)
    {
        // Beispiel: €0,31 pro Kilometer
        $cost = $distanceKm * 0.31;

        // Runden auf den nächsten 0,10-Schritt
        return ceil($cost * 10) / 10;
    }

    private function calculateFreeDeliveryThreshold($distanceKm)
    {
        // Beispiel: Mindestbestellwert €10 + €2 pro Kilometer
        return 10 + ($distanceKm * 2);
    }

    private function calculateDeliveryCharge($distanceKm)
    {
        // Beispiel: Liefergebühr €2 pro Kilometer
        return $distanceKm * 2.0;
    }


    public function toggleSelectAll()
    {
        $this->selectedAreas = $this->selectAll ? $this->deliveryAreas->pluck('id')->toArray() : [];
    }

    public function deleteSelected()
    {
        DeliveryArea::whereIn('id', $this->selectedAreas)->delete();
        $this->selectedAreas = [];
        $this->selectAll = false;
        $this->deliveryAreas = DeliveryArea::all();
        $this->js('window.location.reload()');

    }



    public function deleteDeliveryArea($id)
    {
        DeliveryArea::find($id)->delete();
        $this->render();
        $this->js('window.location.reload()');

    }

    public function refresh()
    {
        $this->shop = ModShop::find($this->shopId);
        $this->deliveryAreas = DeliveryArea::where('shop_id', $this->shopId)->get();
        $this->render();
    }


    public function editDeliveryArea($id)
    {
        $deliveryArea = DeliveryArea::find($id);

        // Felder für das Editieren befüllen
        $this->edit_delivery_cost = $deliveryArea->delivery_cost;
        $this->edit_free_delivery_threshold = $deliveryArea->free_delivery_threshold;
        $this->edit_delivery_charge = $deliveryArea->delivery_charge;
        $this->currentDeliveryAreaId = $id;

        $this->editFormVisible = true;

    }


    public function updateDeliveryArea()

    {
        $this->validate([
            'edit_delivery_cost' => 'required|numeric',
            'edit_free_delivery_threshold' => 'required|numeric',
            'edit_delivery_charge' => 'required|numeric',
        ]);

        $deliveryArea = DeliveryArea::find($this->currentDeliveryAreaId);


        $deliveryArea->update([
            'delivery_cost' => $this->edit_delivery_cost,
            'free_delivery_threshold' => $this->edit_free_delivery_threshold,
            'delivery_charge' => $this->edit_delivery_charge,
        ]);

        $this->editFormVisible = false;

        // Trigger page reload using Livewire's built-in method
        $this->js('window.location.reload()');

    }

    public function reloadPage()
    {
        $this->js('window.location.reload()');
    }

}
