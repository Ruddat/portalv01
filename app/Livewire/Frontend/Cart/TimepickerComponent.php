<?php

namespace App\Livewire\Frontend\Cart;

use Carbon\Carbon;
use Livewire\Component;
use App\Services\OpeningHoursService;
use App\Models\ModShop;

class TimepickerComponent extends Component
{
    public $showDropdown = false;
    public $selectedTime = 'sofort';
    public $selectedDate; // Init in mount
    public $selectedHour;
    public $selectedMinute;

    public $shopId;
    public $openingHours = [];
    public $isOpen;
    public $currentDate;
    public $availableDates = []; // Deklariere die Variable

    protected $listeners = ['clearTime'];

    public function mount($shopId)
    {
        $this->shopId = $shopId->id;
        $this->currentDate = Carbon::today();
        $this->selectedDate = Carbon::today()->toDateString();
        $this->loadOpeningHours();
        $today = Carbon::now();

        // Generiere die verfügbaren Daten für die nächsten 7 Tage
        for ($i = 0; $i < 7; $i++) {
            $this->availableDates[] = $today->copy()->addDays($i)->format('Y-m-d');
        }
    }

    public function loadOpeningHours()
    {
        $shop = ModShop::findOrFail($this->shopId);

        // Versuche die speziellen Öffnungszeiten für Feiertage zu laden
        $holidayHours = OpeningHoursService::getHolidayHours($shop, $this->selectedDate);

        // Debug-Ausgabe der speziellen Öffnungszeiten für Feiertage
      //  dd($holidayHours);

        // Prüfe, ob spezielle Öffnungszeiten vorhanden sind
        if (!empty($holidayHours)) {
            if ($holidayHours['is_open']) {
                $this->openingHours = collect([[
                    'open' => $holidayHours['open_time'],
                    'close' => $holidayHours['close_time'],
                    'is_open' => $holidayHours['is_open'],
                    'holiday_message' => $holidayHours['holiday_message']
                ]]);
            } else {
                // Wenn das Geschäft an diesem Feiertag geschlossen ist, setze eine entsprechende Nachricht
                $this->openingHours = collect([[
                    'open' => null,
                    'close' => null,
                    'is_open' => false,
                    'holiday_message' => 'Heute geschlossen!!'
                ]]);
            }
        } else {
            // Wenn keine speziellen Öffnungszeiten vorhanden sind, lade die regulären Öffnungszeiten
            $this->openingHours = OpeningHoursService::getOpeningHoursForDate($shop, $this->selectedDate);
        }

        // Debug-Ausgabe der Öffnungszeiten
    //    dd($this->openingHours);
    }


    public function nextDay()
    {
        $this->currentDate->addDay();
        $this->selectedDate = $this->currentDate->toDateString();
        $this->loadOpeningHours();
        $this->selectedHour = null;
        $this->selectedMinute = null;
    }

    public function toggleDropdown()
    {
        $this->showDropdown = !$this->showDropdown;
    }

    public function setSelectedDate($date)
    {
        $this->selectedDate = $date;
        $this->selectedHour = null;
        $this->selectedMinute = null;
    }

    public function selectHour($hour)
    {
        $this->selectedHour = $hour;
        $this->selectedMinute = null; // Reset minute when hour changes
        $this->updateSelectedTime();
    }

    public function selectMinute($minute)
    {
        $this->selectedMinute = $minute;
        $this->updateSelectedTime();
    }

    public function updateSelectedTime()
    {
        if ($this->selectedHour !== null && $this->selectedMinute !== null) {
            $date = Carbon::parse($this->selectedDate);
            $date->setTime($this->selectedHour, $this->selectedMinute);

            if ($date->isFuture()) {
                $this->selectedTime = $date->format('Y-m-d H:i');
                $this->showDropdown = false;
            } else {
                // Handle invalid time selection (e.g., show an error message or reset selection)
                $this->selectedTime = 'sofort';
                $this->selectedHour = null;
                $this->selectedMinute = null;
            }
        }
    }

    public function clearTime()
    {
        $this->selectedTime = 'sofort';
        $this->selectedHour = null;
        $this->selectedMinute = null;
        $this->currentDate = Carbon::today();
        $this->selectedDate = Carbon::today()->toDateString();
        $this->loadOpeningHours();

    }

    public function render()
    {
        return view('livewire.frontend.cart.timepicker-component', [
            'openingHours' => $this->openingHours,
        ]);
    }
}
