<?php

namespace App\Http\Controllers\Frontend\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;


class GeocodeController extends Controller

{
    public function getCoordinates(Request $request)
    {
        // Überprüfe, ob eine Abfrage im Request enthalten ist
        $query = $request->input('query');
        if (!$query) {
            return response()->json(['error' => 'Query parameter is missing'], 400);
        }

        // Erstelle einen neuen Guzzle HTTP-Client
        $client = new Client();

        // Definiere die Nominatim-URL und die Anfrageparameter
        $url = "http://nominatim.openstreetmap.org/search";
        $params = [
            'query' => [
                'q' => $query,
                'format' => 'json',
                'addressdetails' => 1,
            ],
            'headers' => [
                'User-Agent' => 'YourAppName/1.0 (your.email@example.com)', // Setze hier deinen eigenen User-Agent
            ],
        ];

        try {
            // Sende die GET-Anfrage an Nominatim
            $response = $client->get($url, $params);

            // Überprüfe den Statuscode der Antwort
            if ($response->getStatusCode() == 200) {
                // Dekodiere die JSON-Antwort
                $data = json_decode($response->getBody(), true);
                return response()->json($data);
            } else {
                return response()->json(['error' => 'Failed to fetch data from Nominatim'], $response->getStatusCode());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
}
