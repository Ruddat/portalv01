<?php

namespace App\Http\Controllers\Backend\Seller\OrderOverview;

use Carbon\Carbon;
use App\Models\ModOrders;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderOverviewController extends Controller
{
    //

    public function indexOrderOverview($shopId, Request $request)
    {
    // Überprüfen, ob die 'shopId' vorhanden ist
    if (!$shopId) {
        // Wenn nicht, den Benutzer zur Startseite zurückleiten
        return redirect()->route('home');
    }

    // Überprüfen, ob die 'shopId' bereits in der Session gespeichert ist
    if (!$request->session()->has('shopId')) {
        // Wenn nicht, die 'shopId' in die Session schreiben
        $request->session()->put('shopId', $shopId);
    } else {
        // Wenn ja, die 'shopId' aus der Session abrufen
        $shopId = $request->session()->get('shopId');
    }

        $orders = ModOrders::where('parent', $shopId)->get();

        // Holen Sie sich die ersten und letzten Bestelldaten für den bestimmten Shop
        $firstOrder = ModOrders::where('parent', $shopId)->orderBy('created_at', 'asc')->first();
        $lastOrder = ModOrders::where('parent', $shopId)->orderBy('created_at', 'desc')->first();

        // Bestimmen Sie die verfügbaren Jahre und Monate basierend auf den Bestellungen für diesen Shop
    // Überprüfen Sie, ob $firstOrder und $lastOrder null sind
    if ($firstOrder && $lastOrder) {
        $startYear = $firstOrder->created_at->format('Y');
        $endYear = $lastOrder->created_at->format('Y');
    } else {
        // Wenn $firstOrder oder $lastOrder null sind, setzen Sie das Start- und Endjahr auf das aktuelle Jahr
        $startYear = date('Y');
        $endYear = date('Y');
    }



        $years = range($startYear, $endYear);

        $months = [];
        foreach (range(1, 12) as $month) {
            $months[$month] = Carbon::createFromFormat('m', $month)->format('F');
        }

        // Standardwerte für das aktuelle Jahr und den aktuellen Monat
        $currentYear = date('Y');
        $currentMonth = date('n');

        $data = [
            'shopId' => $shopId,
            'pageTitle' => 'Order Overview Management',
            'years' => $years,
            'months' => $months,
            'currentYear' => $currentYear,
            'currentMonth' => $currentMonth,
        //    'ordersByDay' => $ordersByDay, // Hier fügen wir $ordersByDay hinzu
            'orders' => $orders, // Hier werden die Bestellungen an die Vorlage übergeben
        ];

        return view('backend.pages.seller.OrderOverview.order-overview', $data);
    }


    public function getOrdersByMonth(Request $request)
    {

        $shopId = $request->session()->get('shopId');
            // Überprüfen, ob die 'shopId' vorhanden ist
    if (!$shopId) {
        // Wenn nicht, den Benutzer zur Startseite zurückleiten
        return redirect()->route('seller.dashboard');
    }

    // Überprüfen, ob die 'shopId' bereits in der Session gespeichert ist
    if (!$request->session()->has('shopId')) {
        // Wenn nicht, die 'shopId' in die Session schreiben
        $request->session()->put('shopId', $shopId);
    } else {
        // Wenn ja, die 'shopId' aus der Session abrufen
        $shopId = $request->session()->get('shopId');
    }


        $year = $request->input('yearSelect', date('Y'));
        $month = $request->input('month', date('n'));

   //     dd($year, $month);

   // Bestellungen für den ausgewählten Monat abrufen
   $ordersByMonth = $this->fetchOrdersByMonth($year, $month);
//dd($ordersByMonth);
       // Daten als JSON zurückgeben
    //   return response()->json($ordersByMonth);

   // Zurück zur Index-Seite mit den aktualisierten Daten
   return redirect()->route('seller.orderOverview', ['shopId' => $request->session()->get('shopId')]);


        // Erstellen eines Carbon-Objekts für den ersten Tag des ausgewählten Monats
        $startDate = Carbon::create($year, $month, 1)->startOfMonth();
        // Erstellen eines Carbon-Objekts für den letzten Tag des ausgewählten Monats
        $endDate = Carbon::create($year, $month, 1)->endOfMonth();

        // Bestellungen für den ausgewählten Monat abrufen
        $orders = ModOrders::whereBetween('created_at', [$startDate, $endDate])->get();

        // Array initialisieren, um die Bestellungen für jeden Tag zu speichern
        $ordersByDay = [];
        // Array initialisieren, um die Tage des Monats zu speichern
        $daysOfMonth = [];

        // Für jeden Tag des ausgewählten Monats
        for ($day = 1; $day <= $endDate->day; $day++) {
            // Das Datum für den aktuellen Tag im Format 'Y-m-d' erstellen
            $date = Carbon::create($year, $month, $day)->format('Y-m-d');
            // Die Anzahl der Bestellungen für den aktuellen Tag zählen
            $orderCount = $orders->where('created_at', '>=', $date)->where('created_at', '<=', $date . ' 23:59:59')->count();
            // Die Anzahl der Bestellungen für den aktuellen Tag dem Array hinzufügen
            $ordersByDay[] = $orderCount;
            // Den Tag des Monats dem Array hinzufügen
            $daysOfMonth[] = $day;
        }
//dd($daysOfMonth, $ordersByDay);
    // Daten als JSON zurückgeben
    return response()->json([
        'orders' => $ordersByDay,
        'daysOfMonth' => $daysOfMonth,
    ]);

    }


    private function fetchOrdersByMonth($year, $month)
{
    // Hier den Code einfügen, um die Bestellungen für den ausgewählten Monat abzurufen
        // Erstellen eines Carbon-Objekts für den ersten Tag des ausgewählten Monats
        $startDate = Carbon::create($year, $month, 1)->startOfMonth();
        // Erstellen eines Carbon-Objekts für den letzten Tag des ausgewählten Monats
        $endDate = Carbon::create($year, $month, 1)->endOfMonth();

        // Bestellungen für den ausgewählten Monat abrufen
        $orders = ModOrders::whereBetween('created_at', [$startDate, $endDate])->get();

        // Array initialisieren, um die Bestellungen für jeden Tag zu speichern
        $ordersByDay = [];
        // Array initialisieren, um die Tage des Monats zu speichern
        $daysOfMonth = [];

        // Für jeden Tag des ausgewählten Monats
        for ($day = 1; $day <= $endDate->day; $day++) {
            // Das Datum für den aktuellen Tag im Format 'Y-m-d' erstellen
            $date = Carbon::create($year, $month, $day)->format('Y-m-d');
            // Die Anzahl der Bestellungen für den aktuellen Tag zählen
            $orderCount = $orders->where('created_at', '>=', $date)->where('created_at', '<=', $date . ' 23:59:59')->count();
            // Die Anzahl der Bestellungen für den aktuellen Tag dem Array hinzufügen
            $ordersByDay[] = $orderCount;
            // Den Tag des Monats dem Array hinzufügen
            $daysOfMonth[] = $day;
        }
//dd($daysOfMonth, $ordersByDay);
    // Daten als JSON zurückgeben
    return response()->json([
        'orders' => $ordersByDay,
        'daysOfMonth' => $daysOfMonth,
    ]);
    // Hier die Bestellungen abrufen und zurückgeben
}



public function ajaxGetOrdersByMonth(Request $request)
{

    $year = $request->input('yearSelect', date('Y'));
    $month = $request->input('monthSelect', date('n'));
//     dd($year, $month);

    $shopId = $request->session()->get('shopId');
    // Erstellen eines Carbon-Objekts für den ersten Tag des ausgewählten Monats
    $startDate = Carbon::create($year, $month, 1)->startOfMonth();
    // Erstellen eines Carbon-Objekts für den letzten Tag des ausgewählten Monats
    $endDate = Carbon::create($year, $month, 1)->endOfMonth();

    // Bestellungen für den ausgewählten Monat abrufen
    $orders = ModOrders::whereBetween('created_at', [$startDate, $endDate])->where('parent', $shopId)->get();

    // Wandeln Sie die Bestelldaten in das erforderliche Format um
    $orderData = $orders->map(function ($order) use ($shopId) {
        return [
            'orderNumber' => $order->order_nr,
            'time' => Carbon::parse($order->order_date)->format('H:i'),
          //  'status' => $order->order_tracking_status,
            'status' => $this->getStatusLabel($order->order_tracking_status),
            'name' => $order->name,
            'surname' => $order->surname,
            'street' => $order->shipping_street,
            'zipCode' => $order->shipping_zip,
            'city' => $order->shipping_city,
            'orderType' => $order->shipping_type,
            'total' => $order->price_total,
            'pdfDownloadLink' => route('seller.download.pdf', ['shopId' => $shopId, 'orderId' => $order->order_nr]),
            'date' => Carbon::parse($order->order_date)->format('F j, Y'),
            'storno' => $order->user_status,
            'action' => $order->action,
        ];
    });
    // Array initialisieren, um die Bestellungen für jeden Tag zu speichern
    $ordersByDay = [];
    // Array initialisieren, um die Tage des Monats zu speichern
    $daysOfMonth = [];

    // Für jeden Tag des ausgewählten Monats
    for ($day = 1; $day <= $endDate->day; $day++) {
        // Das Datum für den aktuellen Tag im Format 'Y-m-d' erstellen
        $date = Carbon::create($year, $month, $day)->format('Y-m-d');
        // Die Anzahl der Bestellungen für den aktuellen Tag zählen
        $orderCount = $orders->where('created_at', '>=', $date)->where('created_at', '<=', $date . ' 23:59:59')->count();
        // Die Anzahl der Bestellungen für den aktuellen Tag dem Array hinzufügen
        $ordersByDay[] = $orderCount;
        // Den Tag des Monats dem Array hinzufügen
        $daysOfMonth[] = $day;
    }
//dd($daysOfMonth, $ordersByDay);
// Daten als JSON zurückgeben
return response()->json([
    'orders' => $ordersByDay,
    'daysOfMonth' => $daysOfMonth,
    'orderData' => $orderData,


]);

}

    public function getStatusLabel($status)
    {

     //   dd($status);
        switch ($status) {
            case 999999:
                return ['status' => 'New (Created)', 'color' => 'primary'];
            case 0:
                return ['status' => 'Ready to Send', 'color' => 'dark'];
            case 1:
                return ['status' => 'Ready to Send', 'color' => 'dark'];
            case 2:
                return ['status' => 'Restaurant Received', 'color' => 'success'];
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




}
