<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SoapClient
{
    protected $client;
    protected $shopId;

    public function __construct()
    {
       // $wsdl = Storage::disk('local')->get('soap/winOrderWsdl.php');

        $this->client = new \SoapClient(storage_path('app/soap/winOrderWsdl.php'), [
            'trace' => 1,
            'exceptions' => true,
            'soap_version' => SOAP_1_1,
        ]);


        $this->shopId = '501';  // Fest verankerte Shop-ID
    }

    // Methode zum Abrufen einer Bestellung
    public function getOrders($username, $password)
    {
        if ($username !== 'rudi123' || $password !== 'rudi123') {
            throw new \Exception('Invalid username or password');
        }

        try {
            $order = DB::table('mod_orders')
                ->where('order_tracking_status', 999999)
                ->where('parent', $this->shopId)
                ->first();

            return $order;
        } catch (\Exception $e) {
            Log::error('Database Error: ' . $e->getMessage());
            throw new \Exception('Failed to fetch orders: ' . $e->getMessage());
        }
    }

    // Neue Bestellungen über SOAP abrufen
    public function getNewOrdersFromSoap($username, $password)
    {
        try {
            $header = new \SoapHeader('http://tempuri.org/', 'SOAPAction', 'GetNewOrders');
            $this->client->__setSoapHeaders($header);

            $response = $this->client->__soapCall('GetNewOrders', [
                'Username' => $username,
                'Password' => $password,
            ]);

            Log::info('SOAP Request: ' . $this->client->__getLastRequest());
            Log::info('SOAP Response: ' . $this->client->__getLastResponse());

            return $response;
        } catch (\SoapFault $e) {
            Log::error('SOAP Error: ' . $e->getMessage());
            Log::error('SOAP Request: ' . $this->client->__getLastRequest());
            Log::error('SOAP Response: ' . $this->client->__getLastResponse());

            throw new \Exception('Failed to fetch new orders from SOAP: ' . $e->getMessage());
        }
    }

    // Tracking-Status über SOAP senden
    public function sendTrackingStatusToSoap($username, $password, $orderId, $trackingStatus)
    {
        try {
            $header = new \SoapHeader('http://tempuri.org/', 'SOAPAction', 'SendTrackingStatus');
            $this->client->__setSoapHeaders($header);

            $response = $this->client->__soapCall('SendTrackingStatus', [
                'Username' => $username,
                'Password' => $password,
                'OrdersID' => $orderId,
                'TrackingStatus' => $trackingStatus,
            ]);

            Log::info('SOAP Request: ' . $this->client->__getLastRequest());
            Log::info('SOAP Response: ' . $this->client->__getLastResponse());

            return $response;
        } catch (\SoapFault $e) {
            Log::error('SOAP Error: ' . $e->getMessage());
            Log::error('SOAP Request: ' . $this->client->__getLastRequest());
            Log::error('SOAP Response: ' . $this->client->__getLastResponse());

            throw new \Exception('Failed to send tracking status to SOAP: ' . $e->getMessage());
        }
    }
}
