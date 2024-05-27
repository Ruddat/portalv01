<?php

namespace App\Livewire\Frontend\Storeinfos;

use Livewire\Component;
use App\Repositories\ShopRepository;
use App\Services\OpeningHoursService;
use Carbon\Carbon;

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
//dd($sessionData);


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
        $this->isOpen = true;
        $this->shopStatus = 'open';

    }

    public function orderDelivery()
    {
        $this->validate([
            'street' => 'required|string',
            'housenumber' => 'required|string',
            'postcode' => 'required|string',
            'city' => 'required|string',
        ]);

        dd('deliveryPopup validierung erfolgreich');
    }

    public function orderPickUp()
    {

       // dd($this->shopId, $this->shopStatus);

        // Speichern Sie die shopId und den status in der Session
        session(['shopId' => $this->shopId, 'status' => 'PickUp']);

        $sessionData = $this->getSessionData();


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

            dd('Session Daten', ['shopId' => $shopId, 'status' => $status]);
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
