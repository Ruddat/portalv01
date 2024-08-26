<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\ModShop;
use App\Models\ModOrders;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Http\Response as Res;


class OrderStreamController extends Controller
{
    //
    protected $statusCode = Res::HTTP_OK;

    /**
     * Zeigt die Bestellungen für den angegebenen Shop an.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Loggen des Authorization-Headers für Debugging-Zwecke
        $header = $request->header('Authorization');
        // Log::info("Authorization header: " . $header);

        // Überprüfen, ob der Aktivierungscode im Header vorhanden ist
        if (!$request->header('activation-code')) {
            return response()->json(['error' => 'Activation code missing'], 406);
        }

        // Überprüfen des Aktivierungscodes
        $shop = ModShop::where('activation_code', $request->header('activation-code'))->first();

        // Überprüfen, ob der Shop gefunden wurde
        if (!$shop) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Überprüfen, ob Bestellungen mit dem Status '999999' für den richtigen Shop vorhanden sind
        if (ModOrders::where('order_tracking_status', '999999')->where('parent', $shop->id)->exists()) {
            // Bestellungen abrufen, wenn sie vorhanden sind
            $orders = ModOrders::where('order_tracking_status', '999999')
                        ->where('parent', $shop->id)
                        ->first()
                        ->order_json_data;
            return response($orders, 200);
        } else {
            // Rückgabe, wenn keine Bestellungen gefunden wurden
            return response()->json([
                "message" => "No Orders found for this shop"
            ], 200);
        }
    }

    public function verifyActivationCode(Request $request)
    {
        $request->validate([
            'activation_code' => 'required|string',
        ]);

        $activationCode = $request->input('activation_code');

        // Suche nach dem Aktivierungscode
        $validCode = ModShop::where('activation_code', $activationCode)->first();

        if ($validCode) {
            // Überprüfen, ob der Code bereits verwendet wurde
            if ($validCode->activation_code_used) {
                return response()->json(['success' => false, 'message' => 'Activation code has already been used.'], 403);
            }

            // Setze den Code als verwendet
            $validCode->activation_code_used = true;
            $validCode->save();

            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Invalid activation code.'], 401);
        }
    }

    public function checkActivationStatus(Request $request)
    {
        $request->validate([
            'activation_code' => 'required|string',
        ]);

        $activationCode = $request->input('activation_code');

        // Suche nach dem Aktivierungscode
        $validCode = ModShop::where('activation_code', $activationCode)->first();

        if ($validCode && $validCode->activation_code_used) {
            // Der Code wurde bereits aktiviert
           // return response()->json(['success' => true, 'message' => 'Activation code is already used.'], 200);

                // Shop-Name und Kundennummer zurückgeben
                return response()->json([
                    'success' => true,
                    'shop_name' => $validCode->title, // Annahme, dass shop_name ein Feld in der Tabelle ist
                    'customer_number' => $validCode->shop_nr // Annahme, dass customer_number ein Feld in der Tabelle ist
                ], 200);

        } else {
            return response()->json(['success' => false, 'message' => 'Activation code not found or not used.'], 404);
        }
    }


    public function getOrdersFromYear(Request $request, $year)
    {


    // Überprüfen, ob der Aktivierungscode im Header oder als Query-Parameter vorhanden ist
    $activationCode = $request->header('Authorization');
    if (!$activationCode) {
        $activationCode = $request->query('activation-code');  // Hier wird der Query-Parameter überprüft
    }

    if (!$activationCode) {
        return response()->json(['error' => 'Activation code missing'], 406);
    }

    // Entferne das 'Bearer ' Prefix, falls der Code aus dem Authorization Header stammt
    $activationCode = str_replace('Bearer ', '', $activationCode);

      //  $activationCode = 'B1F1KVw6';

//dd($activationCode);


        // Shop anhand des Aktivierungscodes suchen
        $shop = ModShop::where('activation_code', $activationCode)->first();
//dd($shop);

        // Überprüfen, ob der Shop gefunden wurde
        if (!$shop) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Zeitrahmen für das Jahr festlegen
        $startOfYear = Carbon::create($year)->startOfYear();
        $endOfYear = Carbon::create($year)->endOfYear();


        // Bestellungen für den Shop und innerhalb des Jahres abrufen
        $orders = ModOrders::where('parent', $shop->id)
                    ->whereBetween('created_at', [$startOfYear, $endOfYear])
                    ->get();


        return response()->json($orders, 200);
    }


    public function fetchAllOrders(Request $request)
    {
        // Versuche zuerst, den Aktivierungscode aus dem Header zu bekommen
        $activationCode = $request->header('activation-code');

        // Wenn kein Aktivierungscode im Header vorhanden ist, versuche ihn aus dem Query-String zu bekommen
        if (!$activationCode) {
            $activationCode = $request->query('activation-code'); // Aus dem Query-Parameter
        }

        // Wenn kein Aktivierungscode vorhanden ist, gib eine Fehlermeldung zurück
        if (!$activationCode) {
            return response()->json(['error' => 'Activation code missing'], 406);
        }

        // Überprüfen des Aktivierungscodes und Abrufen des Shops
        $shop = ModShop::where('activation_code', $activationCode)->first();

        // Überprüfen, ob der Shop gefunden wurde
        if (!$shop) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Überprüfen, ob der Aktivierungscode noch nicht verwendet wurde
        if (!$shop->activation_code_used) {  // Annahme: `activation_code_used` ist ein boolesches Feld in der Tabelle `ModShop`
            return response()->json(['error' => 'Activation code not yet used'], 403);
        }

        // Bestellungen für den Shop abrufen
        $orders = ModOrders::where('parent', $shop->id)->get();

        // Überprüfen, ob Bestellungen vorhanden sind
        if ($orders->isEmpty()) {
            return response()->json(['message' => 'No orders found for this shop'], 200);
        }

        // Rückgabe der Bestellungen
        return response()->json($orders, 200);
    }



    public function getOrderDetails(Request $request, $orderhash)
    {
        // Versuche, den Aktivierungscode aus dem Header zu holen
        $activationCode = $request->header('activation-code');

        // Wenn kein Aktivierungscode im Header vorhanden ist, versuche ihn aus dem Query-String zu bekommen
        if (!$activationCode) {
            $activationCode = $request->query('activation-code'); // Aus dem Query-Parameter
        }

        // Wenn kein Aktivierungscode vorhanden ist, gib eine Fehlermeldung zurück
        if (!$activationCode) {
            return response()->json(['error' => 'Activation code missing'], 406);
        }

        // Überprüfen des Aktivierungscodes und Abrufen des Shops
        $shop = ModShop::where('activation_code', $activationCode)->first();

        // Überprüfen, ob der Shop gefunden wurde
        if (!$shop) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Überprüfen, ob der Aktivierungscode noch nicht verwendet wurde
        if (!$shop->activation_code_used) {
            return response()->json(['error' => 'Activation code not yet used'], 403);
        }

        // Bestellung anhand des orderhash und der shop-id abrufen
        $order = ModOrders::where('parent', $shop->id)
                          ->where('hash', $orderhash)
                          ->first();

        // Überprüfen, ob die Bestellung gefunden wurde
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        // Rückgabe der Bestelldetails
        return response()->json($order, 200);
    }





    public function fetchConfirmedOrder(Request $request)
    {
        // Aktivierungscode und OrderID aus dem Header oder Query-String abrufen
        $activationCode = $request->header('activation-code') ?? $request->query('activation-code');
        $orderId = $request->input('order_id'); // Annahme, dass die OrderID im Request-Body oder Query-String gesendet wird

        // Wenn kein Aktivierungscode oder OrderID vorhanden ist, Fehlermeldung zurückgeben
        if (!$activationCode) {
            return response()->json(['error' => 'Activation code missing'], 406);
        }
        if (!$orderId) {
            return response()->json(['error' => 'Order ID missing'], 406);
        }

        // Überprüfung des Aktivierungscodes und Abrufen des zugehörigen Shops
        $shop = ModShop::where('activation_code', $activationCode)->first();

        // Wenn kein Shop gefunden wurde, Fehlermeldung zurückgeben
        if (!$shop) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Überprüfen, ob der Aktivierungscode bereits verwendet wurde
        if (!$shop->activation_code_used) {
            return response()->json(['error' => 'Activation code not yet used'], 403);
        }

        // Spezifische Bestellung für den Shop abrufen
        $order = ModOrders::where('parent', $shop->id)
                    ->where('hash', $orderId)
                    ->first();

        // Wenn die Bestellung nicht gefunden wurde, entsprechende Nachricht zurückgeben
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }


        // Rückgabe der Bestellungen
        return response()->json($order, 200);



        // Dekodieren der order_json_data von JSON-String in ein Array
        $orderJsonData = json_decode($order->order_json_data, true);

        // Falls die Dekodierung fehlgeschlagen ist
        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json(['error' => 'Failed to decode order JSON data'], 500);
        }

        // Strukturieren der Bestellung zur besseren Lesbarkeit und Rückgabe
        $formattedOrder = [
            'OrderID' => $order->hash,
            'Status' => $order->order_tracking_status,  // Beispiel für den Bestellstatus
            'Customer' => [
                'CustomerNo' => $order->customer_no,
                'FirstName' => $order->name,
                'LastName' => $order->surname,
                'DeliveryAddress' => [
                    'Street' => $order->shipping_street,
                    'HouseNo' => $order->shipping_house_no,
                    'PostalCode' => $order->shipping_zip,
                    'City' => $order->shipping_city,
                ],
            ],
            'ArticleList' => $orderJsonData['ArticleList'] ?? [],  // Extrahiere die Artikel aus den JSON-Daten
            'AddInfo' => [
                'CurrencyStr' => $order->currency, // Beispiel für Währung
                'Tip' => $order->price_tips,
            ],
            'created_at' => $order->created_at,
        ];

        // Rückgabe der formatierten Bestellung im JSON-Format
        return response()->json(['Order' => $formattedOrder], 200);
    }




    /**
     * Speichert die aktualisierten Daten einer Bestellung.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Protokolliere den gesamten API-Request
        \Log::info('API Request:', [
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'request_data' => $request->all(),
        ]);

        // Extrahieren der relevanten Daten aus der Anfrage
        $data = $request->only(['message', 'ordersid', 'trackingstatus', 'deliver_minutes', 'deliver_eta', 'reject_reason']);

//dd($data);

        // Standardwerte festlegen, falls die Daten nicht gesendet wurden
        $ordersid = $data['ordersid'] ?? null;
        $trackingstatus = $data['trackingstatus'] ?? null;
        $deliver_eta = $data['deliver_eta'] ?? null;
        $deliver_minutes = $data['deliver_minutes'] ?? null;
        $deliver_message = $data['message'] ?? null;
        $reject_reason = $data['reject_reason'] ?? null;

        // Überprüfen, ob die erforderlichen Daten vorhanden sind
        if (!$ordersid || !$deliver_message) {
            // Fehlermeldung zurückgeben, wenn erforderliche Daten fehlen
            return response()->json([
                'error' => true,
                'message'  => "Missing required data. Please provide ordersid, trackingstatus, deliver_eta, and deliver_minutes.",
            ], 400);
        }

        // Abrufen der Bestellung anhand der Bestellungs-ID
        $orders = ModOrders::where('hash', $ordersid)->first();

        // Überprüfen, ob die Bestellung gefunden wurde
        if (!$orders) {
            // Fehlermeldung zurückgeben, wenn die Bestellung nicht gefunden wurde
            return response()->json([
                'error' => true,
                'message'  => "Order not found with id: $ordersid",
            ], 404);
        }

        // Aktualisieren der Bestellungsdaten
        $orders->order_tracking_status = $trackingstatus;
        $orders->deliver_eta = $deliver_eta;
        $orders->deliver_minutes = $deliver_minutes;
        $orders->message = $deliver_message;
        $orders->reject_reason = $reject_reason;

        // Speichern der aktualisierten Bestellung in der Datenbank
        $orders->save();

        // Erfolgreiche Rückmeldung als JSON
        return response()->json([
            'error' => false,
            'message'  => "The Order with the id $ordersid has successfully been updated.",
        ], 200);
    }

    public function tracking_status(Request $request)
    {
        // Protokolliere den gesamten API-Request
        \Log::info('API Request:', [
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'request_data' => $request->all(),
        ]);

        // Daten hier
        $data = ($request->all());
        dd($data);
    }

    public function show($id)
    {
        // Protokolliere den gesamten API-Request
        \Log::info('API Show Request:', [
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'request_data' => $request->all(),
        ]);

        $order = ModOrders::find($id);

        return response()->json([
            'error' => false,
            'order'  => $order,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        // Protokolliere den gesamten API-Request
        \Log::info('API Update Request:', [
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'request_data' => $request->all(),
        ]);

        $order = ModOrders::find($id);
//dd($order);
        $order->order_notes = $request->input('order_notes');

        $order->save();

        return response()->json([
            'error' => false,
            'order'  => $order,
        ], 200);
    }

    public function destroy($id)
    {
        // Protokolliere den gesamten API-Request
        \Log::info('API Destroy Request:', [
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'request_data' => $request->all(),
        ]);

        $orders = ModOrders::find($id);
        $orders->delete();

        return response()->json([
            'error' => false,
            'message'  => "The Order with the id $orders->id has successfully been deleted.",
        ], 200);
    }


    public function updateOrderStatus(Request $request)
{
    // Protokolliere den gesamten API-Request
    \Log::info('API UpdateOrderStatus Request:', [
        'url' => $request->fullUrl(),
        'method' => $request->method(),
        'request_data' => $request->all(),
    ]);

dd($request);

    // Validierung der eingehenden Daten
    $request->validate([
        'orderId' => 'required|string',
        'newStatus' => 'required|integer',
    ]);
//dd($request);
    // Extrahieren der relevanten Daten aus der Anfrage
    $orderId = $request->input('orderId');
    $newStatus = $request->input('newStatus');

    // Überprüfen des Aktivierungscodes im Header
    $activationCode = $request->header('activation-code');

    if (!$activationCode) {
        return response()->json(['error' => 'Activation code missing'], 406);
    }

    // Shop anhand des Aktivierungscodes suchen
    $shop = ModShop::where('activation_code', $activationCode)->first();

    if (!$shop) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    // Bestellung anhand der Bestellungs-ID abrufen
    $order = ModOrders::where('hash', $orderId)
                      ->where('parent', $shop->id)
                      ->first();

    if (!$order) {
        return response()->json(['error' => 'Order not found'], 404);
    }

    // Aktualisieren des Bestellstatus
    $order->order_tracking_status = $newStatus;
    $order->save();

    // Erfolgreiche Rückmeldung als JSON
    return response()->json([
        'error' => false,
        'message' => "The Order with the id $orderId has successfully been updated to status $newStatus.",
    ], 200);
}

}
