<?php

namespace App\Livewire\Frontend\Storeinfos;

use Carbon\Carbon;
use Livewire\Component;
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
    public $postcode;
    public $city;

    public $shop;
    public $shopStatus;
    public $todayOpeningHours;
    public $nextOpenTime;
    public $isOpen;
    public $openPopUp = true;
    public $shopId;
    public $addressData;
    public $address;
    //public $errors = [];
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
    //    dd($sessionData);

    // Hole die Session-Daten und setzen die Livewire-Eigenschaften
    $addressData = Session::get('address_data');
    if ($addressData) {
        $this->street = $addressData['street'] ?? '';
        $this->housenumber = $addressData['housenumber'] ?? '';
        $this->postcode = $addressData['postcode'] ?? '';
        $this->city = $addressData['city'] ?? '';
    }



        // Hole Shopdaten
        $this->shop = ShopRepository::findById($shopId);

        // Checke ob der Shop geöffnet ist
        $this->isOpen = OpeningHoursService::isOpen($this->shop);

        // Sonderöffnungszeiten für heute abrufen
        $this->holidayHours = OpeningHoursService::getHolidayHours($this->shop, now()->toDateString());

//dd($this->holidayHours);
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
        //    dd($this->todayOpeningHours);
            $this->nextOpenTime = OpeningHoursService::getNextOpenTime($this->shop);
        }

    // Shopstatus überprüfen
    $this->shopStatus = OpeningHoursService::getShopStatus($this->shop);

    // Status-basiertes Bestellmanagement
    switch ($this->shopStatus) {
        case 'on':
    // Falls der Laden geschlossen ist, erlauben wir nur Vorbestellungen
    if ($this->isOpen === false) {
        // dd($this->shopStatus);
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
        // dd('preOrderPopup erfolgreich');
        $this->isOpen = true;
        $this->shopStatus = 'open';


    }

    public function orderDelivery()
    {
        $validatedData = $this->validate([
            'street' => 'required|string',
            'housenumber' => 'required|string',
            'postcode' => 'required|string',
            'city' => 'required|string',
        ]);

        // Adresse in der Session speichern
        Session::put('address_data', $validatedData);

        // Speichern der shopId und den Status in der Session
        session(['shopId' => $this->shopId, 'status' => 'Delivery']);

        // Geokoordinaten für die neue Adresse berechnen und speichern
        if (!$this->calculateAndSaveCoordinates($validatedData)) {

            $this->errorMessage = 'Die eingegebene Adresse konnte nicht gefunden werden. Bitte überprüfen Sie Ihre Eingabe.';
            return redirect()->back()->withErrors(['address' => 'Die eingegebene Adresse konnte nicht gefunden werden. Bitte überprüfen Sie Ihre Eingabe.']);
        }

        $this->openPopUp = false;
    }

    private function calculateAndSaveCoordinates($addressData)
    {
        // Adressdaten in ein durchsuchbares Format konvertieren
        $query = $addressData['street'] . ' ' . $addressData['housenumber'] . ', ' . $addressData['postcode'] . ' ' . $addressData['city'];

        // Nominatim-Anfrage durchführen, um Geokoordinaten zu erhalten
        $url = "http://nominatim.openstreetmap.org/";
        $nominatim = new Nominatim($url);
        $search = $nominatim->newSearch()->query($query);
        $results = $nominatim->find($search);

        // Geokoordinaten aus den Ergebnissen extrahieren und in der Session speichern
        if (!empty($results) && isset($results[0]['lat']) && isset($results[0]['lon'])) {
            $userLatitude = $results[0]['lat'];
            $userLongitude = $results[0]['lon'];

            session(['userLatitude' => $userLatitude]);
            session(['userLongitude' => $userLongitude]);
            session(['selectedLocation' => $query]);

            return true; // Erfolgreich Geokoordinaten erhalten
        }

        return false; // Geokoordinaten konnten nicht erhalten werden
    }


    public function orderPickUp()
    {

       // dd($this->shopId, $this->shopStatus);

        // Speichern Sie die shopId und den status in der Session
        session(['shopId' => $this->shopId, 'status' => 'PickUp']);

        $sessionData = $this->getSessionData();

        $this->openPopUp = false;


        // Debugging-Ausgabe
   //     dd('pickupPopup erfolgreich', session()->all());
    }

    public function wantToBrowse()
    {
      //  dd('browsePopup erfolgreich');
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
     //       $this->openPopUp = false;

     //       dd('Session Daten', ['shopId' => $shopId, 'status' => $status]);
        } else {
         //   dd('Keine Daten für diese shopId in der Session gefunden.');
        }
    }


    public function render()
    {

    //    dd($this->nextOpenTime);

        return view('livewire.frontend.storeinfos.store-popup', [
            'todayOpeningHours' => $this->todayOpeningHours,
            'nextOpenTime' => $this->nextOpenTime,
            'isOpen' => $this->isOpen,
        ]);
    }
}
