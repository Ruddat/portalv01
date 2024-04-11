<?php

namespace App\Http\Controllers\Soap\WinorderSoap;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use SoapClient;
use Illuminate\Support\Facades\Storage;


class WinOrderSOAPController extends Controller
{


    public function callSoapService(Request $request)
    {
        // Pfad zur WSDL-Datei auf dem Server
        $wsdlPath = storage_path('app/soap/winOrderWsdl.php');

        // Initialisierung des SoapClients mit der lokalen WSDL-Datei
        $client = new SoapClient($wsdlPath);

        // Benutzername und Kennwort aus der Anfrage erhalten
        $username = $request->input('Username');
        $password = $request->input('Password');

        // Methodenaufruf zum Empfangen neuer Bestellungen
        $xmlOrdersData = $client->__soapCall('GetNewOrders', [
            'Username' => $username,
            'Password' => $password
        ]);

        // Beispielantwort mit XML-Bestelldaten zurückgeben
        return response($xmlOrdersData)->header('Content-Type', 'text/xml');
    }


    // Methode zum Empfangen neuer Bestellungen
    public function getNewOrders(Request $request)
    {

        // Pfad zur WSDL-Datei auf dem Server
        $wsdlPath = storage_path('app/soap/winorder.wsdl');

        // Initialisierung des SoapClients mit der lokalen WSDL-Datei
        $client = new SoapClient($wsdlPath);

        // Benutzername und Kennwort aus der Anfrage erhalten
        $username = $request->input('Username');
        $password = $request->input('Password');

        // Initialisierung des SoapClients mit der WSDL-URL
        //$client = new SoapClient('http://example.com/soap/wsdl');

        // Initialisierung des SoapClients mit der lokalen WSDL-Datei
//        $client = new SoapClient($wsdlPath);
$client = new SoapClient('http://localhost/Scripts/WinOrderEShop.dll/soap/IWinOrderEShop');

        // Methodenaufruf zum Empfangen neuer Bestellungen
        $xmlOrdersData = $client->__soapCall('GetNewOrders', [
            'Username' => $username,
            'Password' => $password
        ]);

        // Beispielantwort mit XML-Bestelldaten zurückgeben
        return response($xmlOrdersData)->header('Content-Type', 'text/xml');
    }

    // Methode zum Senden von Tracking-Status
    public function sendTrackingStatus(Request $request)
    {
        // Benutzername und Kennwort aus der Anfrage erhalten
        $username = $request->input('Username');
        $password = $request->input('Password');
        $orderId = $request->input('OrdersID');
        $trackingStatus = $request->input('TrackingStatus');

        // Initialisierung des SoapClients mit der WSDL-URL
        $client = new SoapClient('http://example.com/soap/wsdl');

        // Methodenaufruf zum Senden von Tracking-Status
        $success = $client->__soapCall('SendTrackingStatus', [
            'Username' => $username,
            'Password' => $password,
            'OrdersID' => $orderId,
            'TrackingStatus' => $trackingStatus
        ]);

        // Beispielantwort für den Erfolg zurückgeben
        return response()->json(['success' => true]);
    }
}
