<?php

namespace App\Services;

use GuzzleHttp\Client;

class GeocodeService
{
    protected $client;
    protected $userAgent;

    public function __construct()
    {
        $this->client = new Client();
        $this->userAgent = 'YourAppName/1.0 (your.email@example.com)'; // Setze hier deinen eigenen User-Agent
    }

    public function searchByAddress($query)
    {
        $url = "http://nominatim.openstreetmap.org/search";
        $params = [
            'query' => [
                'q' => $query,
                'format' => 'json',
                'addressdetails' => 1,
            ],
            'headers' => [
                'User-Agent' => $this->userAgent,
            ],
        ];

        return $this->sendRequest($url, $params);
    }

    public function searchByCoordinates($lat, $lon)
    {
        $url = "http://nominatim.openstreetmap.org/reverse";
        $params = [
            'query' => [
                'lat' => $lat,
                'lon' => $lon,
                'format' => 'json',
                'addressdetails' => 1,
            ],
            'headers' => [
                'User-Agent' => $this->userAgent,
            ],
        ];

        return $this->sendRequest($url, $params);
    }

    protected function sendRequest($url, $params)
    {
        try {
            $response = $this->client->get($url, $params);

            if ($response->getStatusCode() == 200) {
                return json_decode($response->getBody(), true);
            } else {
                throw new \Exception('Failed to fetch data from Nominatim', $response->getStatusCode());
            }
        } catch (\Exception $e) {
            throw new \Exception('An error occurred: ' . $e->getMessage(), 500);
        }
    }
}
