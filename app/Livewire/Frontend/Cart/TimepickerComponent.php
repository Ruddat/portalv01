<?php

namespace App\Livewire\Frontend\Cart;

use Carbon\Carbon;
use App\Models\ModShop;
use Livewire\Component;
use App\Services\OpeningHoursService;
use Illuminate\Support\Facades\Session;

class TimepickerComponent extends Component
{
    public $showDropdown = false;
    public $selectedTime = 'sofort';
    public $selectedDate;
    public $selectedHour;
    public $selectedMinute;

    public $shopId;
    public $openingHours = [];
    public $isOpen;
    public $currentDate;
    public $availableDates = [];

    protected $listeners = ['clearTime', 'openTimepicker'];

    public function mount($shopId)
    {
        $this->shopId = $shopId->id;
        $this->currentDate = Carbon::today();
        $this->selectedDate = Carbon::today()->toDateString();
        $this->loadOpeningHours();
        $today = Carbon::now();

        for ($i = 0; $i < 7; $i++) {
            $this->availableDates[] = $today->copy()->addDays($i)->format('Y-m-d');
        }

        $storedTime = Session::get('selectedTime');
        if ($storedTime) {
            $this->selectedTime = $storedTime;
        }
    }

    public function loadOpeningHours()
    {
        $shop = ModShop::findOrFail($this->shopId);

        // Versuche die speziellen Öffnungszeiten für Feiertage zu laden
        $holidayHours = OpeningHoursService::getHolidayHours($shop, $this->selectedDate);

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
                $this->openingHours = collect([[
                    'open' => null,
                    'close' => null,
                    'is_open' => false,
                    'holiday_message' => 'Heute geschlossen!!'
                ]]);
            }
        } else {
            // Lade die regulären Öffnungszeiten
            $this->openingHours = OpeningHoursService::getOpeningHoursForDate($shop, $this->selectedDate);
        }
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

    public function openTimepicker()
    {
        $this->showDropdown = true; // Öffnet das Dropdown für die Zeitwahl
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
                // Ungültige Zeitbehandlung
                $this->selectedTime = 'sofort';
                $this->selectedHour = null;
                $this->selectedMinute = null;
            }
            // Speichere die ausgewählte Zeit in der Session
            Session::put('selectedTime', $this->selectedTime);
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
        // Lösche die gespeicherte Zeit aus der Session
        Session::forget('selectedTime');
    }

    public function render()
    {
        return view('livewire.frontend.cart.timepicker-component', [
            'openingHours' => $this->openingHours,
        ]);
    }
}
