<?php

namespace App\Livewire\Frontend\Storeinfos;

use Carbon\Carbon;
use App\Models\ModShop;
use Livewire\Component;
use App\Models\AddressData;
use App\Models\DeliveryArea;
use App\Models\ModVendorAddressData;
use App\Repositories\ShopRepository;
use App\Services\OpeningHoursService;
use Illuminate\Support\Facades\Session;
use NominatimLaravel\Content\Nominatim;

class StorePopup extends Component
{
    public $storeName;
    public $storeStreet;
    public $storeCity;
    public $storeLogo;
    public $street;
    public $housenumber;
    public $postal_code;
    public $city;

    public $shop;
    public $shopStatus;
    public $todayOpeningHours;
    public $nextOpenTime;
    public $isOpen;
    public $openPopUp = true;
    public $shopId;
    public $addressData;

    public $errorMessage;

    protected $listeners = ['openPopup' => 'handleOpenPopup', 'closePopup' => 'closePopup'];

    public function mount($restaurant)
    {
        $shopId = $restaurant->id;
        $this->storeName = $restaurant->title;
        $this->storeCity = $restaurant->city;
        $this->storeStreet = $restaurant->street;
        $this->storeLogo = $restaurant->logo_url;

        // Hole SessionData
        $sessionData = $this->getSessionData();
        $addressData = Session::get('address_data');
        if ($addressData) {
            $this->street = $addressData['street'] ?? '';
            $this->housenumber = $addressData['housenumber'] ?? '';
            $this->postal_code = $addressData['postal_code'] ?? '';
            $this->city = $addressData['city'] ?? '';
        }

        // Hole Shopdaten
        $this->shop = ShopRepository::findById($shopId);

        // Checke ob der Shop geöffnet ist
        $this->isOpen = OpeningHoursService::isOpen($this->shop);
//dd($this->isOpen);

        // Sonderöffnungszeiten für heute abrufen
        $this->holidayHours = OpeningHoursService::getHolidayHours($this->shop, now()->toDateString());


        // Überprüfen, ob Sonderöffnungszeiten für heute vorhanden sind
        if ($this->holidayHours) {
            // Überprüfen, ob der Laden geöffnet ist
       //     dd($this->holidayHours);

            $this->isOpen = $this->holidayHours['is_open'] &&
            now()->between(
                Carbon::createFromFormat('H:i:s', $this->holidayHours['open_time']),
                Carbon::createFromFormat('H:i:s', $this->holidayHours['close_time'])
            );

            // Verwende Sonderöffnungszeiten für heute und setze nextOpenTime auf null, da keine nächste Öffnungszeit erforderlich ist
            $this->todayOpeningHours = [
                [
                    'open' => $this->holidayHours['open_time'],
                    'close' => $this->holidayHours['close_time'],
                    'is_open' => $this->holidayHours['is_open'],
                ]
            ];
            $this->nextOpenTime = null;

        } else {
            // Normale Öffnungszeiten für heute und nächste Öffnungszeit abrufen
            $this->todayOpeningHours = OpeningHoursService::getOpeningHoursForToday($this->shop);
            $this->nextOpenTime = OpeningHoursService::getNextOpenTime($this->shop);
        }

        // Shopstatus überprüfen
        $this->shopStatus = OpeningHoursService::getShopStatus($this->shop);

        // Status-basiertes Bestellmanagement
        switch ($this->shopStatus) {
            case 'on':
                // Falls der Laden geschlossen ist, erlauben wir nur Vorbestellungen
                if ($this->isOpen === false) {
                    $this->shopStatus = 'preorder';
                    $this->isOpen = true;
                }
                break;
            case 'off':
                $this->shopStatus = 'off';
                break;
            case 'closed':
                $this->shopStatus = 'closed';
                break;
            case 'limited':
                $this->shopStatus = 'limited';
                break;
        }
    }

    public function handleOpenPopup($status, $storeName = null)
    {
        $this->isOpen = true;
    }

    public function closePopup()
    {
        $this->isOpen = false;
    }

    public function preOrder()
    {
        $this->isOpen = true;
        $this->shopStatus = 'open';
    }

    public function orderDelivery()
    {
        $validatedData = $this->validate([
            'street' => 'required|string',
            'housenumber' => 'required|string',
            'postal_code' => 'required|string',
            'city' => 'required|string',
        ]);

        // Adresse in der Session speichern
        Session::put('address_data', $validatedData);

        // Speichern der shopId und den Status in der Session
        session(['shopId' => $this->shopId, 'status' => 'delivery']);

        // Geokoordinaten für die neue Adresse berechnen und speichern
        if (!$this->calculateAndSaveCoordinates($validatedData)) {
            $this->errorMessage = 'Die eingegebene Adresse konnte nicht gefunden werden. Bitte überprüfen Sie Ihre Eingabe.';
            return redirect()->back()->withErrors(['address' => 'Die eingegebene Adresse konnte nicht gefunden werden. Bitte überprüfen Sie Ihre Eingabe.']);
        }

        // Lieferkosten berechnen und in der Session speichern
        if (!$this->calculateAndSaveDeliveryCosts()) {
            $this->errorMessage = 'Die eingegebene Adresse liegt außerhalb unseres Lieferbereichs.';
            return redirect()->back()->withErrors(['address' => 'Die eingegebene Adresse liegt außerhalb unseres Lieferbereichs.']);
        }

        $this->openPopUp = false;
    }

private function calculateAndSaveCoordinates($addressData)
{
    // Prüfen, ob die Adresse bereits in der Datenbank vorhanden ist
    $existingAddress = ModVendorAddressData::where('street', ucwords($addressData['street']))
        ->where('housenumber', $addressData['housenumber'])
        ->where('postal_code', $addressData['postal_code'])
        ->where('city', ucwords($addressData['city']))
        ->first();

    if ($existingAddress) {
        session(['userLatitude' => $existingAddress->latitude]);
        session(['userLongitude' => $existingAddress->longitude]);
        session(['selectedLocation' => $existingAddress->street . ' ' . $existingAddress->housenumber . ', ' . $existingAddress->postal_code . ' ' . $existingAddress->city]);

        return true; // Adresse wurde gefunden und Koordinaten wurden gesetzt
    }

    // Adressdaten in ein durchsuchbares Format konvertieren
    $query = ucwords($addressData['street']) . ' ' . $addressData['housenumber'] . ', ' . $addressData['postal_code'] . ' ' . ucwords($addressData['city']);

    // Nominatim-Anfrage durchführen, um Geokoordinaten zu erhalten
    $url = "http://nominatim.openstreetmap.org/";
    $nominatim = new Nominatim($url);
    $search = $nominatim->newSearch()->query($query);
    $results = $nominatim->find($search);

    // Geokoordinaten aus den Ergebnissen extrahieren und in der Session speichern
    if (!empty($results) && isset($results[0]['lat']) && isset($results[0]['lon'])) {
        $userLatitude = $results[0]['lat'];
        $userLongitude = $results[0]['lon'];

        // Adresse und Koordinaten in der Datenbank speichern
        ModVendorAddressData::create([
            'street' => ucwords($addressData['street']),
            'housenumber' => $addressData['housenumber'],
            'postal_code' => $addressData['postal_code'],
            'city' => ucwords($addressData['city']),
            'latitude' => $userLatitude,
            'longitude' => $userLongitude,
        ]);

        session(['userLatitude' => $userLatitude]);
        session(['userLongitude' => $userLongitude]);
        session(['selectedLocation' => $query]);

        return true; // Erfolgreich Geokoordinaten erhalten
    }

    return false; // Geokoordinaten konnten nicht erhalten werden
}


    private function calculateAndSaveDeliveryCosts()
    {
        $userLatitude = session('userLatitude');
        $userLongitude = session('userLongitude');

        if (!$userLatitude || !$userLongitude) {
            return false;
        }

        // Holen des Standort vom Restaurant
        $shopLocation = ModShop::where('id', $this->shopId)->first();
        $distance = $this->calculateDistance($userLatitude, $userLongitude, $shopLocation->lat, $shopLocation->lng);
        $distance = round($distance, 2);

        // Holen der Lieferbereiche für den bestimmten Shop
        $deliveryAreas = DeliveryArea::where('shop_id', $this->shopId)
            ->orderBy('distance_km', 'asc')
            ->get();

        // Überprüfen, ob der Benutzer innerhalb eines Lieferbereichs liegt
        $foundInDeliveryArea = false;
        foreach ($deliveryAreas as $area) {
            if ($distance <= $area->distance_km) {
                // Speichere die Lieferkosten in der Session für den neuen Shop
                session(['delivery_cost_' . $this->shopId => $area->delivery_cost]);
                session(['delivery_charge_' . $this->shopId => $area->delivery_charge]);
                session(['delivery_free_' . $this->shopId => $area->free_delivery_threshold]);
                session(['delivery_free_threshold_' . $this->shopId => $area->free_delivery_threshold]);
                $foundInDeliveryArea = true;
                break;
            }
        }

        if (!$foundInDeliveryArea) {
            $oldShopId = Session::get('shopId');
            if ($oldShopId !== null) {
                Session::forget('delivery_cost_' . $oldShopId);
                Session::forget('delivery_charge_' . $oldShopId);
                Session::forget('delivery_free_' . $oldShopId);
            }
        }

        if ($foundInDeliveryArea) {
            // Emit the event to update the delivery cost
            $this->dispatch('deliveryCostChanged');
        }

        return $foundInDeliveryArea;
    }

    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        return $miles * 1.609344; // Kilometer
    }

    public function orderPickUp()
    {
        $oldShopId = Session::get('shopId');
        if ($oldShopId !== null) {
            Session::forget('delivery_cost_' . $oldShopId);
            Session::forget('delivery_charge_' . $oldShopId);
            Session::forget('delivery_free_' . $oldShopId);
        }

        session(['shopId' => $this->shopId, 'status' => 'pickup']);

        // Setze die Liefergebühr auf 0
        Session::put('delivery_cost_' . $this->shopId, 0);
        $this->deliveryFee = 0; // Stelle sicher, dass die Eigenschaft auch aktualisiert wird

        $this->openPopUp = false;
    }

    public function wantToBrowse()
    {
        $this->openPopUp = false;
    }

    public function redirectToSearch()
    {
        return redirect()->route('search.index');
    }

    public function getSessionData()
    {
        // Abrufen der shopId aus der Session
        $shopId = session('shopId');
        $status = session('status');

        if ($shopId) {
            // Daten basierend auf der shopId abrufen
            // Beispielhafte Ausgabe
        } else {
            // Keine Daten für diese shopId in der Session gefunden.
        }
    }

    public function render()
    {
        return view('livewire.frontend.storeinfos.store-popup', [
            'todayOpeningHours' => $this->todayOpeningHours,
            'nextOpenTime' => $this->nextOpenTime,
            'isOpen' => $this->isOpen,
        ]);
    }
}
