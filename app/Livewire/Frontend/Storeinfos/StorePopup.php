<?php

namespace App\Livewire\Frontend\Storeinfos;

use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Models\ModShop;
use Livewire\Component;
use App\Models\AddressData;
use App\Models\DeliveryArea;
use App\Services\GeocodeService;
use App\Models\ModVendorAddressData;
use App\Repositories\ShopRepository;
use App\Services\OpeningHoursService;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Exception\RequestException;

class StorePopup extends Component
{
    public $storeName;
    public $storeStreet;
    public $storeCity;
    public $storeLogo;
    public $street;
    public $housenumber;
    public $shipping_street;
    public $shipping_house_no;
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

    protected $geocodeService;

    public function __construct()
    {
        $this->geocodeService = new GeocodeService();
    }

    public function mount($restaurant)
    {
        $this->shopId = $restaurant->id;
        $this->storeName = $restaurant->title;
        $this->storeCity = $restaurant->city;
        $this->storeStreet = $restaurant->street;
        $this->storeLogo = $restaurant->logo_url;

        // Hole SessionData
        $sessionData = $this->getSessionData();
        $addressData = Session::get('address_data');
      //  dd($addressData);
        if ($addressData) {
            $this->shipping_street = $addressData['shipping_street'] ?? '';
            $this->shipping_house_no = $addressData['shipping_house_no'] ?? '';
            $this->postal_code = $addressData['postal_code'] ?? '';
            $this->city = $addressData['city'] ?? '';
        }

        // Hole Shopdaten
        $this->shop = ShopRepository::findById($this->shopId);

        // Checke ob der Shop geöffnet ist
        $this->isOpen = OpeningHoursService::isOpen($this->shop);

        // Sonderöffnungszeiten für heute abrufen
        $this->holidayHours = OpeningHoursService::getHolidayHours($this->shop, now()->toDateString());

        // Überprüfen, ob Sonderöffnungszeiten für heute vorhanden sind
        if ($this->holidayHours) {
            // Überprüfen, ob der Laden geöffnet ist
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

    //    dd($this->shop);
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
            'shipping_street' => 'required|string',
            'shipping_house_no' => 'required|string',
            'postal_code' => 'required|string',
            'city' => 'required|string',
        ]);

        // Lade vorhandene Daten aus der Session
        $existingData = Session::get('address_data', []);

        // Zusammenführen der vorhandenen Daten mit den neuen Daten
        $mergedData = array_merge($existingData, $validatedData);
        // Aktualisierte Daten in der Session speichern
      //  dd($mergedData, $existingData, $validatedData);

        Session::put('address_data', $mergedData);


        // Speichern der shopId und den Status in der Session
        session(['shopId' => $this->shopId, 'status' => 'delivery']);

        Session::put('delivery_or_pickup_' . $this->shopId, 'delivery');

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
        $existingAddress = ModVendorAddressData::where('street', ucwords($addressData['shipping_street']))
            ->where('housenumber', $addressData['shipping_house_no'])
            ->where('postal_code', $addressData['postal_code'])
            ->where('city', ucwords($addressData['city']))
            ->first();

        if ($existingAddress) {
            session(['userLatitude' => $existingAddress->latitude]);
            session(['userLongitude' => $existingAddress->longitude]);
            session(['selectedLocation' => $existingAddress->street . ' ' . $existingAddress->housenumber . ', ' . $existingAddress->postal_code . ' ' . $existingAddress->city]);

            return true; // Adresse wurde gefunden und Koordinaten wurden gesetzt
        }
//dd($existingAddress);
        // Adressdaten in ein durchsuchbares Format konvertieren
        $query = ucwords($addressData['shipping_street']) . ' ' . $addressData['shipping_house_no'] . ', ' . $addressData['postal_code'] . ' ' . ucwords($addressData['city']);

        // Caching-Mechanismus überprüfen
        $cachedCoordinates = $this->checkCache($query);
        if ($cachedCoordinates) {
            session(['userLatitude' => $cachedCoordinates['lat']]);
            session(['userLongitude' => $cachedCoordinates['lon']]);
            session(['selectedLocation' => $query]);
            return true;
        }

        // Geocode-Service initialisieren
        $geocodeService = new GeocodeService();

        try {
            $results = $geocodeService->searchByAddress($query);
//dd($results);

            // Geokoordinaten aus den Ergebnissen extrahieren und in der Session speichern
            if (!empty($results) && isset($results[0]['lat']) && isset($results[0]['lon'])) {
                $userLatitude = $results[0]['lat'];
                $userLongitude = $results[0]['lon'];
                $this->postal_code = $results[0]['address']['postcode'] ?? null;
                $this->city = $results[0]['address']['city'] ?? $results[0]['address']['village'] ?? null;
                $this->city_district = $results[0]['address']['city_district'] ?? null;
                $this->suburb = $results[0]['address']['suburb'] ?? null;
                $this->street = $results[0]['address']['road'] ?? null;
                $this->housenumber = $addressData['shipping_house_no'];

                // Prüfe, ob die Adresse bereits in der Datenbank existiert
                $existingAddress = ModVendorAddressData::where('street', $this->street)
                    ->where('housenumber', $this->housenumber)
                    ->where('postal_code', $this->postal_code)
                    ->where('city', $this->city)
                    ->first();

                if (!$existingAddress) {
                    // Adresse und Koordinaten in der Datenbank speichern
                    ModVendorAddressData::create([
                        'street' => ucwords($this->street),
                        'housenumber' => $this->housenumber,
                        'postal_code' => $this->postal_code,
                        'city' => $this->city,
                        'city_district' => $this->city_district,
                        'suburb' => $this->suburb,
                        'latitude' => $userLatitude,
                        'longitude' => $userLongitude,
                    ]);
                } else {
                    // Adresse bereits vorhanden
                    session()->flash('info', 'Address already exists in the database.');
                }

                // Korrigierte Adresse in der Session speichern
                $correctedAddress = [
                    'shipping_street' => ucwords($this->street),
                    'shipping_house_no' => $this->housenumber,
                    'postal_code' => $this->postal_code,
                    'city' => $this->city,
                    'city_district' => $this->city_district,
                    'suburb' => $this->suburb,
                    'latitude' => $userLatitude,
                    'longitude' => $userLongitude,
                ];
//dd($correctedAddress);
                Session::put('address_data', $correctedAddress);

                session(['userLatitude' => $userLatitude]);
                session(['userLongitude' => $userLongitude]);
                session(['selectedLocation' => $query]);

                // Koordinaten im Cache speichern
                $this->saveToCache($query, ['lat' => $userLatitude, 'lon' => $userLongitude]);

                return true; // Erfolgreich Geokoordinaten erhalten
            }
        } catch (RequestException $e) {
            // Handle error
            $this->errorMessage = 'Fehler beim Abrufen der Geokoordinaten.';
            return false;
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

             //   dd($area->delivery_cost, $area->delivery_charge, $area->free_delivery_threshold, $foundInDeliveryArea);
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
        Session::put('delivery_or_pickup_' . $this->shopId, 'pickup');

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

    private function checkCache($query)
    {
        // Überprüfen Sie, ob die Koordinaten bereits im Cache gespeichert sind.
        // Implementieren Sie Ihren Cache-Mechanismus hier.
        return null;
    }

    private function saveToCache($query, $coordinates)
    {
        // Speichern Sie die Koordinaten im Cache.
        // Implementieren Sie Ihren Cache-Mechanismus hier.
    }
}
