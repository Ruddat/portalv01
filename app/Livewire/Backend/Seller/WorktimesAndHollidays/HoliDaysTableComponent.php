<?php

namespace App\Livewire\Backend\Seller\WorktimesAndHollidays;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\ModSellerHoliDay;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class HoliDaysTableComponent extends Component
{




    public $showAddForm = false;
    public $showTimeFields = false;
    public $showEditForm = false;
    public $isOpen = false;


    public $holidays;
    public $startTime;
    public $endTime;
    public $selectedMessage;
    public $selectedDate;

    protected $rules = [
        'selectedDate' => 'required|date|after_or_equal:today',
        'selectedMessage' => 'nullable',
        'startTime' => 'nullable|required_if:isOpen,true',
        'endTime' => 'nullable|required_if:isOpen,true|after:startTime',
    ];


    public function mount(Request $request)
    {
        // Zugriff auf die Route-Parameter, um die Shop-ID zu erhalten
        $this->shopId = Route::current()->parameter('shopId');

        $this->shopId = Session::get('currentShopId');
        if (!$this->shopId) {
            $this->shopId = Route::current()->parameter('shopId');
            Session::put('currentShopId', $this->shopId);
        }

    }



    public function saveHollyDay()
    {
    // Validierung der Eingabedaten
    $this->validate([
        'selectedDate' => 'required|date|after_or_equal:today',
        'selectedMessage' => 'nullable',
        'startTime' => 'nullable|required_if:isOpen,true',
        'endTime' => 'nullable|required_if:isOpen,true|after:startTime',
    ],[
        'selectedDate.required' => 'The date field is required.',
        'selectedDate.date' => 'The date field must be a valid date.',
        'selectedDate.after_or_equal' => 'The date field must be a date after or equal to today.',
        'startTime.required_if' => 'The start time field is required.',
        'endTime.required_if' => 'The end time field is required.',
        'endTime.after' => 'The end time field must be a date after the start time field.',

    ]);

        // Konvertieren des Datums in das richtige Format (YYYY-MM-DD)
        $formattedDate = date('Y-m-d', strtotime($this->selectedDate));

        // Shop-ID aus der Session abrufen
        $this->shopId = Session::get('currentShopId');

        // Validierung erfolgreich, speichere die Daten
        $hollyDay = new ModSellerHoliDay();
        $hollyDay->shop_id = $this->shopId;
        $hollyDay->holiday_date = $formattedDate;
        $hollyDay->is_open = $this->isOpen;
        $hollyDay->open_time = $this->isOpen ? $this->startTime : null;
        $hollyDay->close_time = $this->isOpen ? $this->endTime : null;
        $hollyDay->holiday_message = $this->selectedMessage;
        $hollyDay->save();

        // Zurücksetzen der Eingabefelder nach dem Speichern
        $this->selectedDate = null;
        $this->isOpen = false;
        $this->startTime = null;
        $this->endTime = null;
        $this->selectedMessage = null;
        // Die Eingabefelder für die Uhrzeit werden ausgeblendet
        $this->showTimeFields = false;
        $this->showAddForm = false;
        // Flash-Nachricht anzeigen
        return $this->dispatch('toast', message: 'Holiday/Custom hours added successfully!', notify:'success' );
        // Flash-Nachricht anzeigen
        session()->flash('success', 'Holiday/Custom hours added successfully!');
    }


    public function render()
    {
        $currentDate = Carbon::now()->toDateString();
        // Shop-ID aus der Session abrufen
        $this->shopId = Session::get('currentShopId');

        // Holen Sie sich nur die Feiertage für den aktuellen Shop und filtern Sie vergangene Daten
        $this->holidays = ModSellerHoliDay::where('shop_id', $this->shopId)
            ->where('holiday_date', '>=', $currentDate)
            ->orderBy('holiday_date')
            ->get();

        return view('livewire.backend.seller.worktimes-and-hollidays.holi-days-table-component');
    }


    public function toggleAddForm()
    {
        $this->showAddForm = !$this->showAddForm;
        $this->showTimeFields = false; // Reset time fields when toggling the form
    }

    public function toggleTimeFields()
    {
        $this->showTimeFields = !$this->showTimeFields;
    }

    public function toggleIsOpen()
    {
     //   $this->isOpen = !$this->isOpen;
        $this->showTimeFields = true;
    }

    public function removeHollyDay($id)
    {
        // Finden Sie den Feiertag basierend auf der übergebenen ID
        $holiday = ModSellerHoliDay::findOrFail($id);

        // Löschen Sie den gefundenen Feiertag aus der Datenbank
        $holiday->delete();

        // Aktualisieren Sie die Anzeige, um die Änderungen zu reflektieren
        $this->render();
    }




}
