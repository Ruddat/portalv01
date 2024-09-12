<?php

namespace app\Http\Controllers;

use App\Services\SoapClient;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $soapClient;

    public function __construct(SoapClient $soapClient)
    {
        $this->soapClient = $soapClient;
    }

    public function getOrders()
    {
        $orders = $this->soapClient->getOrders();

        return response()->json($orders);
    }

    public function receiveOrder(Request $request)
    {
        $orderData = $request->all();

        $response = $this->soapClient->receiveOrder($orderData);

        return response()->json($response);
    }
}
