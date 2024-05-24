<?php

namespace App\Livewire\Frontend\Storeinfos;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class StorePopup extends Component
{
    public $restaurantId;
    public $storeName;
    public $storeStreet;
    public $storeCity;
    public $storeLogo;
    public $shopStatus;
    public $status;
    public $openingHours = [];
    public $isOpen = false;
    public $todayOpeningHours = [];
    public $openingHoursForWeek = [];
    public $nextOpenDay;
    public $nextOpenTime;
    public $street;
    public $housenumber;
    public $postcode;
    public $city;


    protected $listeners = ['openPopup' => 'handleOpenPopup', 'closePopup' => 'closePopup'];

    public function mount($restaurant)
    {
        $this->restaurantId = $restaurant->id;
        $this->storeName = $restaurant->title;
        $this->storeCity = $restaurant->city;
        $this->storeStreet = $restaurant->street;
        $this->storeLogo = $restaurant->logo_url;

        $this->fetchShopStatus();

     //   dd($this->shopStatus);

        if ($this->shopStatus === 'on') {
            $this->fetchOpeningHours();
            $this->checkIfOpen();
        } else {
            $this->isOpen = false;
            if ($this->shopStatus === 'off' || $this->shopStatus === 'closed') {
                $this->shopStatus = 'closed';
                $this->isOpen = true;

            } elseif ($this->shopStatus === 'limited') {
                $this->shopStatus = 'limited';
                $this->handleLimitedStatus();
                $this->isOpen = true;

            }
        }
    }

    public function fetchShopStatus()
    {
        $this->shopStatus = DB::table('mod_shops')
            ->where('id', $this->restaurantId)
            ->value('status');
    }

    public function checkIfOpen()
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $currentTime = Carbon::now()->format('H:i:s');

        // Überprüfen, ob es Sonderöffnungszeiten für den aktuellen Tag gibt
        $specialOpeningHours = DB::table('mod_seller_holi_days')
            ->where('shop_id', $this->restaurantId)
            ->where('holiday_date', $currentDate)
            ->first();



        if ($specialOpeningHours) {


            // Sonderöffnungszeiten für den aktuellen Tag vorhanden
            if ($specialOpeningHours->is_open && $specialOpeningHours->open_time <= $currentTime && $specialOpeningHours->close_time >= $currentTime) {
                // Sonderöffnungszeiten überschneiden sich mit der aktuellen Zeit -> offen
                dd($specialOpeningHours);

                $this->shopStatus = 'open';
            } else {
                // Sonderöffnungszeiten geschlossen oder außerhalb der Öffnungszeiten -> Vorbestellung möglich
                $this->shopStatus = 'preorder';
                $this->isOpen = true;
               dd($specialOpeningHours);

            }
        } else {
            // Keine Sonderöffnungszeiten für den aktuellen Tag -> normale Öffnungszeiten überprüfen
            $dayOfWeek = strtolower(Carbon::now()->format('l'));

            // Öffnungszeiten für den aktuellen Tag abrufen
            $normalOpeningHours = isset($this->openingHours[$dayOfWeek]) ? $this->openingHours[$dayOfWeek] : [];

            // Standardmäßig den Status auf 'geschlossen' setzen
            $this->shopStatus = 'closed';

            // Wenn Öffnungszeiten für den aktuellen Tag vorhanden sind
            if (!empty($normalOpeningHours)) {
                foreach ($normalOpeningHours as $worktime) {
                    // Überprüfen, ob die aktuelle Zeit innerhalb der Öffnungszeiten liegt
                    if ($worktime['is_open'] && $worktime['open'] <= $currentTime && $worktime['close'] >= $currentTime) {
                        // Innerhalb der Öffnungszeiten -> offen
                        $this->shopStatus = 'open';
                        $this->isOpen = true;

                      dd($worktime);
                        break; // Die erste offene Zeit gefunden, abbrechen
                    } elseif ($worktime['is_open']) {
                        // Außerhalb der Öffnungszeiten, aber der Tag hat offizielle Öffnungszeiten -> Vorbestellung möglich
                        $this->shopStatus = 'preorder';
                        $this->isOpen = true;


                       dd($worktime);
                    }
                }
            } else {
                // Keine normalen Öffnungszeiten für den aktuellen Tag gefunden -> nach der nächsten Zeit suchen
                dd($worktime);

                $this->fetchNextOpenTime();

            }
        }
//dd($worktime);

        $this->fetchOpeningHoursForWeek();
 //       dd($this->nextOpenTime, $this->nextOpenDay, $this->openingHoursForWeek, $this->todayOpeningHours);

    }

    public function fetchNextOpenTime()
    {
        $nextOpenTime = DB::table('mod_seller_worktimes')
            ->where('shop_id', $this->restaurantId)
            ->where('open_time', '>', Carbon::now()->format('H:i:s'))
            ->orderBy('open_time')
            ->first();

        if ($nextOpenTime) {
            // Nächste Öffnungszeit gefunden -> Vorbestellung möglich
            $this->shopStatus = 'preorder';
dd($nextOpenTime);

        } else {
            // Keine nächsten Öffnungszeiten gefunden -> geschlossen
            $this->shopStatus = 'closed';
            dd($nextOpenTime);
        }
    }



    public function fetchOpeningHoursForWeek()
    {
        $currentDayIndex = Carbon::now()->dayOfWeekIso;
        $this->openingHoursForWeek = [];
        $this->nextOpenDay = null;
        $this->nextOpenTime = null;
        $currentTime = Carbon::now()->format('H:i:s');
        $today = strtolower(Carbon::now()->format('l'));

        for ($i = 0; $i < 7; $i++) {
            $day = Carbon::now()->addDays($i);
            $dayOfWeek = strtolower($day->format('l'));

            if (isset($this->openingHours[$dayOfWeek])) {
                $dayOpeningHours = $this->openingHours[$dayOfWeek];

                if (!empty($dayOpeningHours)) {
                    foreach ($dayOpeningHours as $worktime) {
                        if ($worktime['is_open']) {
                            $this->openingHoursForWeek[$dayOfWeek][] = $worktime;

                            if (!$this->nextOpenDay && ($worktime['open'] > $currentTime || !$day->isToday())) {
                                $this->nextOpenDay = $day;
                                $this->nextOpenTime = [
                                    'open' => $worktime['open'],
                                    'close' => $worktime['close'],
                                ];
                            }
                        }
                    }
                } else {
                    $this->openingHoursForWeek[$dayOfWeek] = [
                        [
                            'open' => 'geschlossen',
                            'close' => '',
                            'is_open' => false,
                        ]
                    ];
                }
            }
        }

        // Setze $todayOpeningHours auf null, wenn die Öffnungszeiten für den heutigen Tag abgelaufen sind
        $todayOpeningHoursExpired = true;
        foreach ($this->todayOpeningHours as $worktime) {
            if ($worktime['close'] > $currentTime) {
                $todayOpeningHoursExpired = false;
                break;
            }
        }

        if ($todayOpeningHoursExpired) {
            $this->todayOpeningHours = null;
            $this->isOpen = true;
           $this->shopStatus = 'preorder';

        }
    }






    public function fetchOpeningHours()
    {
        $this->openingHours = DB::table('mod_seller_worktimes')
            ->where('shop_id', $this->restaurantId)
            ->select('day_of_week', 'open_time', 'close_time', 'is_open')
            ->get()
            ->groupBy('day_of_week')
            ->map(function ($items) {
                return $items->map(function ($item) {
                    return [
                        'open' => $item->is_open ? $item->open_time : "geschlossen",
                        'close' => $item->is_open ? $item->close_time : "",
                        'is_open' => $item->is_open,
                    ];
                });
            })
            ->toArray();
    }

    protected function handleLimitedStatus()
    {
        session()->flash('message', 'Der Shop ist nur eingeschränkt verfügbar.');
    }

    public function redirectToSearch()
    {
        return redirect()->route('search.index');
    }

    public function handleOpenPopup($status, $storeName = null)
    {
        $this->status = $status;
        $this->storeName = $storeName ?? $this->storeName;
        $this->isOpen = true;
    }

    public function closePopup()
    {
        $this->isOpen = false;
    }

    public function preOrder()
    {
        $this->shopStatus = 'open';
        $this->dispatch('$refresh'); // Aktualisiere das entsprechende Element oder die Komponente
    }

    public function deliveryPopup()
    {
        // Validierung der Eingabedaten
        $this->validate([
            'street' => 'required|string',
            'housenumber' => 'required|string',
            'postcode' => 'required|string',
            'city' => 'required|string',
        ]);





        // Logik zur Verarbeitung der Eingabedaten
        // Zum Beispiel: Daten speichern oder weiterleiten

        // Beispiel: Flash-Nachricht und Popup schließen
        session()->flash('message', 'Lieferadresse wurde erfolgreich übermittelt.');
        $this->closePopup();
    }





    public function render()
    {
        return view('livewire.frontend.storeinfos.store-popup');
    }
}
