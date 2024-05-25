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

    protected $listeners = ['openPopup' => 'handleOpenPopup', 'closePopup' => 'closePopup'];

    public function mount($restaurant)
    {
        $shopId = $restaurant->id;
        $this->storeName = $restaurant->title;
        $this->storeCity = $restaurant->city;
        $this->storeStreet = $restaurant->street;
        $this->storeLogo = $restaurant->logo_url;

        // Hole Shopdaten
        $this->shop = ShopRepository::findById($shopId);

        // Checke ob der Shop geöffnet ist
        $this->isOpen = OpeningHoursService::isOpen($this->shop);

        // Öffnungszeiten für heute und nächste Öffnungszeit abrufen
        $this->todayOpeningHours = OpeningHoursService::getOpeningHoursForToday($this->shop);
        $this->nextOpenTime = OpeningHoursService::getNextOpenTime($this->shop);

        // Shopstatus überprüfen
        $this->shopStatus = OpeningHoursService::getShopStatus($this->shop);

        if ($this->isOpen === false) {
            $this->shopStatus = 'preorder';
            $this->isOpen = true;
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
        dd('pickupPopup erfolgreich');
    }

    public function wantToBrowse()
    {
      //  dd('browsePopup erfolgreich');
      $this->isOpen = false;

    }

    public function redirectToSearch()
    {
        return redirect()->route('search.index');
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
