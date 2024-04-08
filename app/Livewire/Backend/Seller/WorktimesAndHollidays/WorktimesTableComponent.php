<?php

namespace App\Livewire\Backend\Seller\WorktimesAndHollidays;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\ModSellerWorktimes;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


class WorktimesTableComponent extends Component
{


    public $openingHours = [
        'monday' => [
            'isOpen' => false,
            'times' => [],
            'timeAdded' => true,

        ],
        'tuesday' => [
            'isOpen' => false,
            'times' => [],
            'timeAdded' => true,

        ],
        'wednesday' => [
            'isOpen' => false,
            'times' => [],
            'timeAdded' => true,
        ],
        'thursday' => [
            'isOpen' => false,
            'times' => [],
            'timeAdded' => true,
        ],
        'friday' => [
            'isOpen' => false,
            'times' => [],
            'timeAdded' => true,
        ],
        'saturday' => [
            'isOpen' => false,
            'times' => [],
            'timeAdded' => true,
        ],
        'sunday' => [
            'isOpen' => false,
            'times' => [],
            'timeAdded' => true,
        ],
    ];



    public $shopId;
    public $worktimesLoaded = false;


    public function mount(Request $request)
    {
        // Zugriff auf die Route-Parameter, um die Shop-ID zu erhalten
        $this->shopId = Route::current()->parameter('shopId');

        $this->shopId = Session::get('currentShopId');
        if (!$this->shopId) {
            $this->shopId = Route::current()->parameter('shopId');
            Session::put('currentShopId', $this->shopId);
        }

        if (!$this->worktimesLoaded) {
            $this->loadWorktimes();
            $this->worktimesLoaded = true;
        }
    }


    // Hier können Sie die Methode hinzufügen, die die Seite aktualisiert
    public function refreshPage()
    {
        $this->refreshComponent = !$this->refreshComponent;
    }


    public function toggleDay($day)
    {
        // Überprüfen, ob der Schlüssel 'timeAdded' im Array vorhanden ist
        if (isset($this->openingHours[$day]['timeAdded'])) {
            // Überprüfen, ob der Switch eingeschaltet ist oder nicht
                    // Wenn nicht, fügen Sie den Schlüssel 'timeAdded' hinzu und setzen Sie ihn auf false
        $this->openingHours[$day]['timeAdded'] = false;
            if ($this->openingHours[$day]['isChecked']) {
                // Wenn der Switch eingeschaltet ist, setzen Sie die Variable für die Zeit hinzugefügt auf true
                $this->openingHours[$day]['timeAdded'] = true;

                // Überprüfen, ob die maximale Anzahl von Zeiten erreicht wurde
                if (count($this->openingHours[$day]['times']) >= 1) {
                    // Wenn ja, setze $showAddButton auf false, um den "Add" Button auszublenden
                    $this->openingHours[$day]['showAddButton'] = false;
                } else {
                    // Wenn nein, zeige den "Add" Button an
                    $this->openingHours[$day]['showAddButton'] = true;
                }
            } else {
                // Wenn der Switch ausgeschaltet ist, setzen Sie die Variable für die Zeit hinzugefügt auf false
                // und zeigen Sie den Add-Button an
                $this->openingHours[$day]['timeAdded'] = false;

                // Wenn keine Zeiten hinzugefügt wurden, zeigen Sie den "Add" Button an
                if (count($this->openingHours[$day]['times']) == 0) {
                    $this->openingHours[$day]['showAddButton'] = true;
                }
            }
        }
    }


    public function render()
    {
        return view('livewire.backend.seller.worktimes-and-hollidays.worktimes-table-component', [
            'openingHours' => $this->openingHours,
        ]);
    }

    public function addTime($day)
    {
     //   dd('addTime method called');
        // Füge eine neue Zeit hinzu
        $this->openingHours[$day]['times'][] = ['start' => null, 'end' => null];

        // Aktualisiere den Wert für showAddButton basierend auf der Anzahl der Zeiten
        if (count($this->openingHours[$day]['times']) >= 2) {
            $this->openingHours[$day]['showAddButton'] = false;
        }

     //   dd($this->openingHours[$day]['times']);
    }

    public function removeTime($day)
    {
        // Entferne das zweite Element (Index 1) aus dem Array
        unset($this->openingHours[$day]['times'][0]);

        // Aktualisiere den Wert für showAddButton basierend auf der Anzahl der Zeiten
        if (count($this->openingHours[$day]['times']) < 2) {
            $this->openingHours[$day]['showAddButton'] = true;
        }



        // Aktualisieren Sie die Datenbank, wenn der Schalter eingeschaltet ist
        if ($this->openingHours[$day]['isChecked'] && $this->openingHours[$day]['timeAdded']) {
         //   dd($this->openingHours[$day]['times'][1]);
            $this->updateDatabase($day);
            // Nach dem Entfernen die Daten neu laden
            $this->loadWorktimes();
        }

    }


    public function updateDatabase($day)
    {
        // Überprüfen, ob der Schalter eingeschaltet ist
        if ($this->openingHours[$day]['isChecked']) {
            // Suchen Sie den entsprechenden Datensatz in der Datenbank
            $worktime = ModSellerWorktimes::where('shop_id', $this->shopId)
                ->where('day_of_week', $day)
                ->where('open_time', $this->openingHours[$day]['times'])
                ->first();
//dd($worktime);

            // Überprüfen, ob der Datensatz gefunden wurde
            if ($worktime) {
                // Aktualisieren Sie die Datenbank mit den neuen Werten
                $worktime->open_time = $this->openingHours[$day]['times'][0]['start'] ?? null;
                $worktime->close_time = $this->openingHours[$day]['times'][0]['end'] ?? null;
                $worktime->is_open = 0; // Geöffnet is not allowed to be closed before the second time is added
                $worktime->save();
            }
        }
    }












    public function saveWorktimes()
    {

// Arrays für Regeln und Nachrichten initialisieren
$rules = [];
$messages = [];

// Für jede Wochentagszeit die Regeln und Nachrichten hinzufügen
foreach ($this->openingHours as $day => $data) {
    // Validierungsregeln für den Schalterstatus
    $rules["openingHours.$day.isChecked"] = 'nullable|boolean';
    $messages["openingHours.$day.isChecked.boolean"] = "The $day switch status must be true or false.";

    // Validierungsregeln und Nachrichten für die Zeiten hinzufügen, wenn der Schalter eingeschaltet ist
// Validierungsregeln und Nachrichten für die Zeiten hinzufügen, wenn der Schalter eingeschaltet ist
if (isset($data['isChecked']) && $data['isChecked']) {
    $rules["openingHours.$day.times.*.start"] = "nullable|date_format:H:i";
    $rules["openingHours.$day.times.*.end"] = [
        'nullable',
        'date_format:H:i',
        function ($attribute, $value, $fail) use ($day, $data) {
            $startTime = null;

            // Überprüfen, ob das erste Zeitfeld existiert, bevor es validiert wird
            if (isset($data['times'][0]['start'])) {
                $startTime = strtotime($data['times'][0]['start']);
            } else {
                $fail("The start time for $day must be in the format HH:MM.");
            }

            $endTime = strtotime($value);
            // Wenn Endzeit kleiner als Startzeit und nicht null ist, ist es ein Übergang zum nächsten Tag
            if ($endTime < $startTime && $value !== null) {
                $fail("The end time for $day must be after the start time or on the next day.");
            }
        }
    ];

    $messages["openingHours.$day.times.*.start.date_format"] = "The start time for $day must be in the format HH:MM.";
    $messages["openingHours.$day.times.*.end.date_format"] = "The end time for $day must be in the format HH:MM.";
}


    // Validierungsregeln und Nachrichten für die zweite Zeit hinzufügen
    if (count($data['times']) > 1) {
        $rules["openingHours.$day.times.*.1.start"] = "nullable|date_format:H:i:s";
        $rules["openingHours.$day.times.*.1.end"] = [
            'nullable',
            'date_format:H:i',
            function ($attribute, $value, $fail) use ($day, $data) {
                $startTime = strtotime($data['times'][1]['start']);
                $endTime = strtotime($value);
                // Wenn Endzeit kleiner als Startzeit und nicht null ist, ist es ein Übergang zum nächsten Tag
                if ($endTime < $startTime && $value !== null) {
                    $fail("The end time for $day must be after the start time or on the next day.");
                }
            }
        ];

        $messages["openingHours.$day.times.*.1.start.date_format"] = "The second start time for $day must be in the format HH:MM.";
        $messages["openingHours.$day.times.*.1.end.date_format"] = "The second end time for $day must be in the format HH:MM.";
    }
}

// Validierung durchführen
$this->validate($rules, $messages);



//dd($request->all());

        // Shop-ID aus der Session abrufen
        $this->shopId = Session::get('currentShopId');


   //     dd($this->shopId);

// Überprüfen, ob bereits Daten für den Shop in der Datenbank vorhanden sind
$existingEntries = ModSellerWorktimes::where('shop_id', $this->shopId)->exists();

// Wenn keine Daten vorhanden sind, fügen Sie alle Tage mit zwei Zeiten hinzu
if (!$existingEntries) {
    foreach ($this->openingHours as $day => $data) {
        // Zeitbereiche für den Tag hinzufügen
        ModSellerWorktimes::create([
            'shop_id' => $this->shopId,
            'day_of_week' => $day,
            'open_time' => null,
            'close_time' => null,
            'is_open' => 0, // Geschlossen
        ]);
        ModSellerWorktimes::create([
            'shop_id' => $this->shopId,
            'day_of_week' => $day,
            'open_time' => null,
            'close_time' => null,
            'is_open' => 0, // Geschlossen
        ]);
    }
}




// Jetzt aktualisieren Sie die Daten
foreach ($this->openingHours as $day => $data) {
    // Überprüfen, ob der Schalter eingeschaltet ist
    if (isset($data['isChecked']) && $data['isChecked']) {
        // Überprüfen, ob mindestens eine Zeit hinzugefügt wurde
        if (count($data['times']) > 0) {
            foreach ($data['times'] as $index => $time) {
                // Wandeln Sie die Zeitangaben in das richtige Format um
                $startTime = $time['start'] ? date('H:i:s', strtotime($time['start'])) : null;
                $endTime = $time['end'] ? date('H:i:s', strtotime($time['end'])) : null;

                // Suchen Sie den entsprechenden Eintrag in der Datenbank und aktualisieren Sie ihn
                $worktime = ModSellerWorktimes::where('shop_id', $this->shopId)
                    ->where('day_of_week', $day)
                    ->orderBy('id') // Nehmen Sie den ersten Eintrag, falls mehrere vorhanden sind
                    ->skip($index)
                    ->first();

                if ($worktime) {
                    $worktime->update([
                        'open_time' => $startTime,
                        'close_time' => $endTime,
                        'is_open' => 1, // Geöffnet
                    ]);
                }
            }
        }
    } else {
        // Wenn der Schalter für diesen Tag ausgeschaltet ist, aktualisieren Sie die Einträge auf geschlossen
        ModSellerWorktimes::where('shop_id', $this->shopId)
            ->where('day_of_week', $day)
            ->update([
                'open_time' => null,
                'close_time' => null,
                'is_open' => 0, // Geschlossen
            ]);
    }
}







// Validierungsregeln und Nachrichten zurückgeben
return [
    'rules' => $rules,
    'messages' => $messages,
];






        // Hier können Sie die Logik zum Speichern der Worktimes implementieren
        // Zum Beispiel könnten Sie die Daten in der $openingHours Variable speichern

        // Zeigen Sie eine Erfolgsmeldung oder eine Weiterleitung an, nachdem die Daten gespeichert wurden
        session()->flash('message', 'Worktimes successfully saved.');
    }





    public function loadWorktimes()  // TODO - Bug beim laden der Zeiten
    {
        $this->shopId = Session::get('currentShopId');


        $existingEntries = ModSellerWorktimes::where('shop_id', $this->shopId)->exists();

        if ($existingEntries) {
            $worktimes = ModSellerWorktimes::where('shop_id', $this->shopId)->get();
            foreach ($worktimes as $worktime) {
                $day = $worktime->day_of_week;
                $index = $worktime->is_open;
                $startTime = $worktime->open_time ? date('H:i', strtotime($worktime->open_time)) : null;
                $endTime = $worktime->close_time ? date('H:i', strtotime($worktime->close_time)) : null;

                if ($index == 1) {
                    $this->openingHours[$day]['isChecked'] = true;
                    $this->openingHours[$day]['times'][] = [
                        'start' => $startTime,
                        'end' => $endTime,
                    ];
                }
            }
        }
   //     dd($this->openingHours);
    }


}
