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
    public $selectedDate = 'heute';
    public $selectedHour;
    public $selectedMinute;

    public $shopId;
    public $todayOpeningHours = [];
    public $tomorrowOpeningHours = [];
    public $holidayHours = [];
    public $isOpen;
    public $nextOpenTime;

    protected $listeners = ['clearTime'];

    public function mount($shopId)
    {
        $this->shopId = $shopId->id;
        $this->loadOpeningHours();
    }

    public function loadOpeningHours()
    {
        $shop = ModShop::findOrFail($this->shopId);

        // Check if the shop is open
        $this->isOpen = OpeningHoursService::isOpen($shop);

        // Get holiday hours for today
        $this->holidayHours = OpeningHoursService::getHolidayHours($shop, now()->toDateString());

        // If there are holiday hours for today, replace today's opening hours with holiday hours
        if (!empty($this->holidayHours)) {
            $this->todayOpeningHours = [
                [
                    'open' => $this->holidayHours['open_time'],
                    'close' => $this->holidayHours['close_time'],
                    'is_open' => $this->holidayHours['is_open'] == 1,
                    'holiday_message' => $this->holidayHours['holiday_message'],
                ]
            ];
        } else {
            // Otherwise, get regular opening hours for today
            $this->todayOpeningHours = OpeningHoursService::getOpeningHoursForToday($shop);
        }

        // Get opening hours for tomorrow
        $this->tomorrowOpeningHours = OpeningHoursService::getOpeningHoursForTomorrow($shop);

        // If the shop is closed now, set the selected date to the next available open time
        if (!$this->isOpen) {
            $nextOpen = OpeningHoursService::getNextOpenTime($shop);
            if ($nextOpen) {
                $nextOpen = Carbon::parse($nextOpen);
                $this->selectedDate = $nextOpen->isToday() ? 'heute' : 'morgen';
                $this->selectedHour = $nextOpen->format('H');
                $this->selectedMinute = $nextOpen->format('i');
                $this->updateSelectedTime();
            }
        }
    }

    public function toggleDropdown()
    {
        $this->showDropdown = !$this->showDropdown;
    }

    public function selectHour($hour)
    {
        $selectedDate = $this->selectedDate == 'morgen' ? Carbon::tomorrow() : Carbon::today();
        $selectedTime = $selectedDate->copy()->setTime($hour, 0);

        if ($selectedTime->isFuture()) {
            $this->selectedHour = sprintf('%02d', $hour);
            $this->selectedMinute = null; // Reset minute when hour changes
            $this->updateSelectedTime();
        } else {
            // Handle invalid time selection (e.g., show an error message or reset selection)
            $this->selectedHour = null;
            $this->selectedMinute = null;
        }
    }

    public function selectMinute($minute)
    {
        if ($this->selectedHour !== null) {
            $selectedDate = $this->selectedDate == 'morgen' ? Carbon::tomorrow() : Carbon::today();
            $selectedTime = $selectedDate->copy()->setTime($this->selectedHour, $minute);

            if ($selectedTime->isFuture()) {
                $this->selectedMinute = sprintf('%02d', $minute);
                $this->updateSelectedTime();
            } else {
                // Handle invalid time selection (e.g., show an error message or reset selection)
                $this->selectedMinute = null;
            }
        }
    }

    public function updateSelectedTime()
    {
        if ($this->selectedHour !== null && $this->selectedMinute !== null) {
            $date = $this->selectedDate == 'morgen' ? Carbon::tomorrow() : Carbon::today();
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
    }

    public function setSelectedDate($date)
    {
        $this->selectedDate = $date;
        $this->selectedHour = null;
        $this->selectedMinute = null;
    }

    private function isOpenNow()
    {
        $now = Carbon::now();
        foreach ($this->todayOpeningHours as $hour) {
            $openTime = Carbon::createFromFormat('H:i:s', $hour['open']);
            $closeTime = Carbon::createFromFormat('H:i:s', $hour['close']);
            if ($hour['is_open'] && $now->between($openTime, $closeTime)) {
                return true;
            }
        }
        return false;
    }

    public function render()
    {
        $availableHoursToday = $this->getAvailableHours('today');
        $availableHoursTomorrow = $this->getAvailableHours('tomorrow');

        return view('livewire.frontend.cart.timepicker-component', [
            'todayOpeningHours' => $this->todayOpeningHours,
            'tomorrowOpeningHours' => $this->tomorrowOpeningHours,
            'availableHoursToday' => $availableHoursToday,
            'availableHoursTomorrow' => $availableHoursTomorrow,
        ]);
    }

    private function getAvailableHours($day)
    {
        $now = Carbon::now();
        $hours = [];
        $openingHours = $day == 'today' ? $this->todayOpeningHours : $this->tomorrowOpeningHours;

        foreach ($openingHours as $hour) {
            $openTime = Carbon::createFromFormat('H:i:s', $hour['open']);
            $closeTime = Carbon::createFromFormat('H:i:s', $hour['close']);

            for ($time = $openTime->copy(); $time->lt($closeTime); $time->addHour()) {
                if ($time->isFuture()) {
                    $hours[] = $time->format('H:i');
                }
            }
        }

        return $hours;
    }
}
