<?php

namespace App\Livewire\Backend\Seller\OrderOverview;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\ModOrders;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class OrderOverviewList extends Component
{

    use WithPagination;


    public $ordersData;
    public $search = '';
    public $sortOption = 'recently'; // Standard-Sortierung
    public $shopId; // Shop-ID
    public $daysOfMonth;
    public $selectedYear; // Ausgewähltes Jahr
    public $selectedMonth; // Ausgewählter Monat
    public $years; // Array der verfügbaren Jahre
  //  public $months; // Array der verfügbaren Monate
  //  public $chartDataDays; // Tage des Monats für das Diagramm
  //  public $chartDataOrders; // Anzahl der Bestellungen für jeden Tag
   // public $updateChartData; // Livewire-Listener für das Aktualisieren der Chartdaten

    protected $listeners = ['selectedYearUpdated'];


    public function mount($shopId)
    {
        $this->shopId = $shopId;
        $this->loadOrders();
        $this->loadYears();
        $this->selectedYear = Carbon::now()->year;
        $this->selectedMonth = Carbon::now()->month;
    }


    public function loadOrders()
    {
        // Holen der Bestellungen unter Berücksichtigung des Suchbegriffs und der Sortieroption
        $query = ModOrders::where('parent', $this->shopId)->select(
            'id', 'order_nr', 'parent', 'shop_name', 'hash', 'gender', 'name', 'surname', 'company',
            'department', 'email', 'phone', 'shipping_zip_id', 'shipping_street',
            'shipping_house_no', 'shipping_zip', 'shipping_city', 'shipping_state',
            'shipping_country_code', 'shipping_comment', 'delivery_time', 'shipping_type',
            'order_comment', 'payment_type', 'price_products', 'price_bottles',
            'price_shipping', 'price_payment', 'price_tips', 'coupon_discount',
            'eshop_discount', 'price_total', 'use_system_payment', 'soap_status',
            'transfer_type', 'transfer_by_email', 'transfer_time',
            'subscribe_news', 'save_data', 'published', 'money_returned', 'user_id',
            'stickers_delivery_checked', 'cart_in_session', 'delivery_time_left',
            'global_coupon_id', 'coupon_code', 'rand_id', 'user_status', 'order_date',
            'order_tracking_status', 'deliver_eta', 'deliver_minutes', 'created_at',
            'updated_at'
        );

        // Überprüfen, ob ein Suchbegriff vorhanden ist
        if ($this->search !== '') {
            $query->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('shop_name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%')
                      ->orWhere('order_nr', 'like', '%' . $this->search . '%');
            });
        }

        // Überprüfen, ob ein Jahr und Monat ausgewählt wurde
        if ($this->selectedYear && $this->selectedMonth) {

                 $query->whereYear('created_at', $this->selectedYear)
              ->whereMonth('created_at', $this->selectedMonth);
        }

        // Überprüfen, welche Sortieroption ausgewählt wurde
        switch ($this->sortOption) {
            case 'recently':
                $query->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'newest':
                $query->orderBy('id', 'desc'); // Je nach Datenbankkonfiguration anpassen
                break;
            default:
                $query->orderBy('created_at', 'desc'); // Standard-Sortierung
                break;
        }

        // Bestellungen paginieren und laden
        $this->orders = $query->paginate(10);
    }

    public function getStatusLabel($status)
    {
        switch ($status) {
            case 999999:
                return ['status' => 'New (Created)', 'color' => 'primary'];
            case 1:
                return ['status' => 'Ready to Send', 'color' => 'success'];
            case 2:
                return ['status' => 'Restaurant Received', 'color' => 'warning'];
            case 3:
                return ['status' => 'Baking', 'color' => 'info'];
            case 4:
                return ['status' => 'Delivering', 'color' => 'info'];
            case 5:
                return ['status' => 'Boxing (Packing)', 'color' => 'info'];
            case 6:
                return ['status' => 'Delivered (Done)', 'color' => 'success'];
            case 7:
                return ['status' => 'Canceled by Restaurant', 'color' => 'danger'];
            case 500:
                return ['status' => 'Canceled', 'color' => 'danger'];
            default:
                return ['status' => 'Unknown', 'color' => 'secondary'];
        }
    }




    public function resetSearch()
    {
        if ($this->search !== '') {
            $this->search = '';
            $this->loadOrders();
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }





    public function loadYears()
    {
        $firstOrderYear = ModOrders::where('parent', $this->shopId)->orderBy('created_at')->value('created_at');

        if($firstOrderYear) {
            $firstOrderYear = Carbon::parse($firstOrderYear)->year;
        } else {
            $firstOrderYear = Carbon::now()->year;
        }

        // Erstellen Sie ein Array mit den Jahren ab dem ersten Jahr der Bestellung bis zum aktuellen Jahr
        $currentYear = Carbon::now()->year;
        $this->years = range($firstOrderYear, $currentYear);
    }


    public function loadMonths($selectedYear = null)
    {
        // Verwenden Sie das aktuelle Jahr, wenn kein Jahr ausgewählt wurde
        if (!$selectedYear) {
            $selectedYear = Carbon::now()->year;
        }

        // Bestellungen für das ausgewählte Jahr abrufen
        $ordersForYear = ModOrders::where('parent', $this->shopId)
            ->whereYear('created_at', $selectedYear)
            ->pluck(DB::raw('MONTH(created_at)'))
            ->unique()
            ->toArray();

        // Array für die Monate mit Bestellungen initialisieren
        $months = [];

        // Bestellmonate in Lesbarkeit konvertieren (z. B. 1 -> 'January')
        foreach ($ordersForYear as $month) {
            $months[$month] = Carbon::create(null, $month)->format('F');
        }

        return $months;
    }


    public function selectedYearUpdated($value)
{
    $this->loadMonths($value);
}

// Livewire-Listener für das ausgewählte Jahr
public function updatedSelectedYear($value)
{
        // Lade die Monate basierend auf dem ausgewählten Jahr
        $this->loadMonths($value);
}



public function prepareChartData($year, $month)
{
    // Tage des ausgewählten Monats im ausgewählten Jahr
    $daysInMonth = Carbon::create($year, $month)->daysInMonth;

    // Array vorbereiten, um die Anzahl der Bestellungen für jeden Tag zu speichern
    $chartDataDays = [];
    $chartsDataOrders = [];
    for ($day = 1; $day <= $daysInMonth; $day++) {
        $chartDataDays[] = $day; // Tage des Monats hinzufügen
        $chartsDataOrders[] = 0; // Standardmäßig auf 0 setzen
    }

    // Bestellungen für den ausgewählten Monat und das ausgewählte Jahr abrufen
    $orders = ModOrders::where('parent', $this->shopId)
        ->whereYear('created_at', $year)
        ->whereMonth('created_at', $month)
        ->get();

    // Bestellungen nach Tag zählen und im $chartsDataOrders-Array speichern
    foreach ($orders as $order) {
        $orderDay = Carbon::parse($order->created_at)->day;
        $chartsDataOrders[$orderDay - 1]++; // Index beginnt bei 0
    }

    // Beispiel für die Ausgabe der Daten
  //  dd($chartDataDays, $chartsDataOrders);

    // Returne die beiden Arrays
    return [$chartDataDays, $chartsDataOrders];
}

public function prepareChartScript($chartDataDays, $chartsDataOrders)
{

    $chartDataDaysString = implode(',', $chartDataDays[0]); // Array in einen String umwandeln
    $chartsDataOrdersString = implode(',', $chartsDataOrders[1]); // Array in einen String umwandeln

//dd($chartDataDaysString, $chartsDataOrdersString);

    $chartScript = "
        <script>
            function renderChart(chartDataDays, chartsDataOrders) {
                var optionsArea = {
                    series: [{
                        name: '',
                        data: chartsDataOrders
                    }],
                    chart: {
                        height: 300,
                        type: 'area',
                        group: 'social',
                        toolbar: {
                            show: false
                        },
                        zoom: {
                            enabled: false
                        },
                    },
                    // Weitere Optionen...
                };

                // Erstelle eine neue Instanz der ApexCharts-Grafik und rendere sie
                var chartArea = new ApexCharts(document.querySelector('#chart'), optionsArea);
                chartArea.render();
            }

            // Rufe die Funktion zum Rendern der Chart auf
            renderChart([" . $chartDataDaysString . "], [" . $chartsDataOrdersString . "]);
        </script>
    ";

//dd($chartScript);

    return $chartScript;
}




public function updateChartData()
{
    // Aktualisieren Sie die Chartdaten hier
    $this->loadOrders(); // Beispiel: Laden Sie neue Bestellungen

    // Rufen Sie die renderChart-Funktion mit den aktualisierten Daten auf
    $chartDataDays = $this->prepareChartData($this->selectedYear, $this->selectedMonth);
   // $chartsDataOrders = $this->prepareChartData($this->selectedYear, $this->selectedMonth);
    $chartsDataOrders = $chartDataDays;
//    $this->dispatch('renderChart', $chartDataDays, $chartsDataOrders);
$chartScript = $this->prepareChartScript($chartDataDays, $chartsDataOrders);

//    $this->dispatch('renderChart', $chartDataDays, $chartsDataOrders);
//    $this->dispatch('renderChart', $chartDataDays, $chartsDataOrders);
 // list($chartDataDays, $chartsDataOrders) = $this->prepareChartData($this->selectedYear, $this->selectedMonth);
   //  $this->dispatch('refresh');

   return $chartScript;

 // dd('da bin ich');
}





    public function render()
    {

// JavaScript für das Chart vorbereiten
   //     $chartScript = $this->prepareChartScript($chartDataDays, $chartsDataOrders);

        // JavaScript-Array für die Tage des Monats erstellen
        $daysOfMonthJS = json_encode($this->daysOfMonth);

        // Laden Sie die Jahre für die Auswahl
        $years = $this->loadYears();
        // Laden der Monats erstellen
        $months = $this->loadMonths();
 //   list($chartDataDays, $chartsDataOrders) = $this->prepareChartData($this->selectedYear, $this->selectedMonth);

//dd($chartDataDays, $chartsDataOrders);

        // Laden der Bestellungen (mit Paginierung
    $orders = $this->loadOrders();
                // Laden der Monate mit dem initial ausgewählten Jahr
                $months = $this->loadMonths($this->selectedYear);
//dd($selectedMonth, $selectedYear);
//$this->updateChartData();

    // JavaScript für das Chart vorbereiten
    $chartScript = $this->updateChartData();
//dd($chartScript);


//$this->dispatch('renderChart', $this->prepareChartData($this->selectedYear, $this->selectedMonth));

        return view('livewire.backend.seller.order-overview.order-overview-list',[
            'orders' => $this->orders,
            'pagination_theme' => 'bootstrap-5',
            'years' => $years,
            'months' => $months,
         //   'chartDataDays' => $chartDataDays, // Chart-Daten an Blade-Template übergeben
        //    'chartsDataOrders' => $chartsDataOrders, // Chart-Daten an Blade-Template übergeben
            'chartScript' => $chartScript, // Das vorbereitete JavaScript für das Chart

        ]);
    }
}
