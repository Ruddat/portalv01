<?php

namespace App\Http\Controllers\API;

use App\Models\ModShop;
use App\Models\ModOrders;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Http\Response as Res;
use Illuminate\Support\Facades\Validator;


class OrderController extends Controller
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

    // Überprüfen, ob Benutzername und Passwort im Header vorhanden sind
    if (!$request->header('username') || !$request->header('password')) {
        return response()->json(['error' => 'Unauthorized'], 406);
    }

    // Überprüfen der Anmeldeinformationen im Header
    $shop = ModShop::where('api_username', $request->header('username'))
                    ->where('api_password', $request->header('password'))
                    ->first();

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
   // $orders->ordersid = $ordersid;
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

        // daten hier

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
            'order'  => $orders,
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
}
