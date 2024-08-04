<?php

namespace app\helpers;

use App\Services\GeocodeService;
use Illuminate\Support\Facades\Session;


class ShopVariablesHelper
{

    public static function processAddress($userInput, $street, $houseNo, $zip, $city, $request)
    {
        $geocodeService = new GeocodeService();
        $results = $geocodeService->searchByAddress($userInput);

        if (!empty($results) && isset($results[0]['lat']) && isset($results[0]['lon'])) {
            $latitude = $results[0]['lat'];
            $longitude = $results[0]['lon'];

            $correctedAddress = [
                'street' => $results[0]['address']['road'] ?? $street,
                'housenumber' => $results[0]['address']['house_number'] ?? $houseNo,
                'postal_code' => $results[0]['address']['postcode'] ?? $zip,
                'city' => $results[0]['address']['city'] ?? $results[0]['address']['village'] ?? $city,
                'city_district' => $results[0]['address']['city_district'] ?? null,
                'suburb' => $results[0]['address']['suburb'] ?? null,
                'country_code' => $results[0]['address']['country_code'] ?? null,
                'country' => $results[0]['address']['country'] ?? null,
                'state' => $results[0]['address']['state'] ?? null,
            ];

            session(['address_data' => $correctedAddress]);
            session(['userLatitude' => $latitude]);
            session(['userLongitude' => $longitude]);

            $addressString = "{$correctedAddress['street']} {$request->shipping_house_no}, {$correctedAddress['postal_code']} {$correctedAddress['city']}";
            session(['selectedLocation' => $addressString]);

            $newAddressData = [
                'shipping_street' => $results[0]['address']['road'] ?? $street,
                'shipping_house_no' => $results[0]['address']['house_number'] ?? $houseNo,
                'postal_code' => $results[0]['address']['postcode'] ?? $zip,
                'city' => $results[0]['address']['city'] ?? $results[0]['address']['village'] ?? $city,
                'city_district' => $results[0]['address']['city_district'] ?? null,
                'suburb' => $results[0]['address']['suburb'] ?? null,
                'country_code' => $results[0]['address']['country_code'] ?? null,
                'country' => $results[0]['address']['country'] ?? null,
                'state' => $results[0]['address']['state'] ?? null,
            ];

//dd($newAddressData);
            session(['address_data' => $newAddressData]);

            //Session::put('address_data', $newAddressData);
//dd($correctedAddress);


            return true; // Adresse gefunden und verarbeitet
        } else {
            return false; // Adresse nicht gefunden
        }
    }



}
