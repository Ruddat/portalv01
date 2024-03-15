<?php

namespace App\Http\Controllers\API;

use App\Models\ModOrders;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use \Illuminate\Http\Response as Res;


class OrderController extends Controller
{
    //
    protected $statusCode = Res::HTTP_OK;

    public function index()
    {
        // Überprüfen, ob Bestellungen mit dem Status '999999' vorhanden sind
        if (ModOrders::where('order_tracking_status', '999999')->exists()) {
            // Bestellungen abrufen, wenn sie vorhanden sind
            $orders = ModOrders::where('order_tracking_status', '999999')->first()->order_json_data;
            return response($orders, 200);
        } else {
            // Rückgabe, wenn keine Bestellungen gefunden wurden
            return response()->json([
                "message" => "No Orders found"
            ], 200);
        }
    }

    public function store(Request $request)
    {
    $message = $request->only(['message', 'ordersid' , 'trackingstatus' ]);
    $ordersid = $request->input(['ordersid']);
    $trackingstatus = $request->input(['trackingstatus']);
    $deliver_eta = $request->input(['deliver_eta']);
    $deliver_minutes = $request->input(['deliver_minutes']);

    $orders = ModOrders::where('hash', $ordersid)->first();
    $orders->order_tracking_status = $trackingstatus;
    $orders->deliver_eta = $deliver_eta;
    $orders->deliver_minutes = $deliver_minutes;

    $orders->save();

   // $data = ($request->all());
  //  $test['token'] = time();
  //  $test['data'] = json_encode($data);
  //  Test::insert($test);

            return response()->json([
            'error' => false,
            'message'  => "The Order with the id $orders->id has successfully been deleted.",
        ], 200);


    }


    public function tracking_status(Request $request)

    {

        // daten hier

        $data = ($request->all());
        dd($data);

    }



    public function show($id)
    {
        $order = ModOrders::find($id);

        return response()->json([
            'error' => false,
            'order'  => $orders,
        ], 200);
    }

    public function update(Request $request, $id)
    {
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
        $orders = ModOrders::find($id);
        $orders->delete();

        return response()->json([
            'error' => false,
            'message'  => "The Order with the id $orders->id has successfully been deleted.",
        ], 200);
    }
}
