<?php

namespace App\Livewire;

use DateTime;
use Livewire\Component;
use App\Models\ModOrders;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Asantibanez\LivewireCharts\Models\RadarChartModel;
use Asantibanez\LivewireCharts\Models\TreeMapChartModel;

class AreaChart extends Component
{



    public $types = ['food', 'shopping', 'entertainment', 'travel', 'other'];

    public $colors = [
        'food' => '#f6ad55',
        'shopping' => '#fc8181',
        'entertainment' => '#90cdf4',
        'travel' => '#66DA26',
        'other' => '#cbd5e0',
    ];

    public $firstRun = true;

    public $showDataLabels = false;

    protected $listeners = [
        'onPointClick' => 'handleOnPointClick',
        'onSliceClick' => 'handleOnSliceClick',
        'onColumnClick' => 'handleOnColumnClick',
        'onBlockClick' => 'handleOnBlockClick',
    ];

    public function handleOnPointClick($point)
    {
        dd($point);
    }

    public function handleOnSliceClick($slice)
    {
        dd($slice);
    }

    public function handleOnColumnClick($column)
    {
        dd($column);
    }

    public function handleOnBlockClick($block)
    {
        dd($block);
    }




    public function render()
    {



        $expenses = ModOrders::whereIn('price_total', $this->types)->get();

// Dummy-Daten für Bestellungen
// Dummy-Daten für Bestellungen
$dummyOrders = [];
$startDate = new DateTime('2024-03-01');
$endDate = new DateTime('2024-03-07');

// Generieren Sie zufällige Dummy-Daten für jeden Tag
$currentDate = clone $startDate;
while ($currentDate <= $endDate) {
    $count = rand(0, 20); // Zufällige Anzahl von Bestellungen zwischen 0 und 20
    $weekday = $currentDate->format('D'); // Wochentag abkürzen (z. B. Mon, Tue, Wed)
    $dummyOrders[] = ['date' => $currentDate->format('Y-m-d'), 'count' => $count];
    $currentDate->modify('+1 day');
}

// Erstellen Sie das Line-Chart-Modell
$lineChartModel = LivewireCharts::lineChartModel()
->setTitle(trans('Orders'))
->setAnimated($this->firstRun)
->withLegend()
->withGrid()
->withDataLabels()
->setXAxisVisible(true)
->setYAxisVisible(true)
//->setYAxisCategories([1, 2, 3, 4])
->withOnPointClickEvent('onPointClick');

// Fügen Sie die Dummy-Datenpunkte für das Diagramm hinzu
foreach ($dummyOrders as $order) {
    // Konvertieren Sie das Datum in ein DateTime-Objekt
    $date = new DateTime($order['date']);
    // Holen Sie den Wochentag
    $weekday = $date->format('D'); // Abkürzung des Wochentags (z.B. Mon, Tue, Wed)
    // Fügen Sie das Datum als X-Achsenbeschriftung hinzu und den Wert als Datenpunkt
    $lineChartModel->addPoint($weekday, $order['count']);
}


            $this->firstRun = true;



            return view('livewire.area-chart')
            ->with([
           //     'columnChartModel' => $columnChartModel,
           //     'pieChartModel' => $pieChartModel,
                'lineChartModel' => $lineChartModel,
          //      'areaChartModel' => $areaChartModel,
          //      'multiLineChartModel' => $multiLineChartModel,
          //      'multiColumnChartModel' => $multiColumnChartModel,
        //        'radarChartModel' => $radarChartModel,
        //        'treeChartModel' => $treeChartModel,
            ]);
    }


}
