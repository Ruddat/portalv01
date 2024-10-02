<?php

namespace App\Http\Controllers\Frontend\Geoip;

use Carbon\Carbon;
use App\Models\ModShop;
use App\Models\ModTopRankPrice;
use Illuminate\Http\Request;
use Torann\GeoIP\Facades\GeoIP;
use App\Models\ModSellerWorktimes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\LengthAwarePaginator;

class LocationController extends Controller
{
    protected $perPage = 24; // Anzahl der Ergebnisse pro Seite für die Pagination

    public function getLocation()
    {
        // Beispiel: IP-Adresse des Benutzers erhalten
        $userIpAddress = request()->getClientIp(true); // Hier wird ipv6 auf true gesetzt

        // Wenn die IPv6-Adresse nicht verfügbar ist, verwende die IPv4-Adresse
        if (filter_var($userIpAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) === false) {
            $userIpAddress = request()->ip();
        }

        // Standort anhand der IP-Adresse bestimmen
        $location = GeoIP::getLocation($userIpAddress);

        // Überprüfen, ob die Standortdaten verfügbar sind
        if (!empty($location)) {
            // Session-Werte setzen
            Session::put('userLatitude', $location->lat);
            Session::put('userLongitude', $location->lon);
            Session::put('selectedName', $location->city);
        }

        // Session-Werte abrufen und auf leere Werte überprüfen
        $userLatitude = Session::get('userLatitude');
        $userLongitude = Session::get('userLongitude');
        $userCity = Session::get('selectedName');

        if (empty($userLatitude) || empty($userLongitude)) {
            // Fehlerbehandlung für fehlende Standortdaten
            return view('frontend.pages.error');
        }

        // Wenn der Filterwert nicht im Request vorhanden ist, verwenden wir den Wert aus der Session
        $selectedDistance = Session::get('selectedDistance', 20);

        if (!empty($userLatitude) && !empty($userLongitude)) {
            // Cache-Schlüssel generieren basierend auf den Suchparametern
            $cacheKey = "search_restaurants_{$userCity}_{$userLatitude}_{$userLongitude}_{$selectedDistance}";

            // Überprüfen, ob die Daten im Cache vorhanden sind
            $restaurants = Cache::remember($cacheKey, 10, function () use ($userLatitude, $userLongitude, $selectedDistance) {
                return ModShop::select('title', 'street', 'zip', 'city', 'id', 'lat as latitude', 'lng as longitude', 'no_abholung', 'no_lieferung', 'logo', 'votes_count', 'voting_average', 'shop_slug')
                    ->selectRaw(
                        '( 6371 * acos( cos( radians(?) ) *
                        cos( radians( lat ) ) *
                        cos( radians( lng ) - radians(?) ) +
                        sin( radians(?) ) *
                        sin( radians( lat ) ) ) ) AS distance',
                        [$userLatitude, $userLongitude, $userLatitude]
                    )
                    ->where('published', true)
                    ->having('distance', '<', $selectedDistance)
                    ->orderBy('distance')
                    ->paginate($this->perPage);
            });

            // Gesponserte Restaurants abrufen
            $currentDateTime = Carbon::now('Europe/Berlin');
            $sponsoredRestaurants = $this->getSponsoredRestaurants($userLatitude, $userLongitude, $selectedDistance, $currentDateTime);

            // Ein leeres Array erstellen, um die Meldungen für jedes Restaurant zu speichern
            $restaurantStatus = [];

            // Durch die Restaurants iterieren
            foreach ($restaurants as $restaurant) {
                // Öffnungszeiten für das aktuelle Restaurant abrufen
                $openingHours = ModSellerWorktimes::where('shop_id', $restaurant->id)->get();

                // Überprüfen, ob Öffnungszeiten vorhanden sind
                if ($openingHours->isNotEmpty()) {
                    // Öffnungsstatus für den aktuellen Tag berechnen und dem Restaurantobjekt anhängen
                    $currentDayOfWeek = strtolower($currentDateTime->format('l'));

                    $currentOpenStatus = [];

                    // Iteriere über die Öffnungszeiten für den aktuellen Tag
                    foreach ($openingHours as $hour) {
                        if ($hour->day_of_week === $currentDayOfWeek) {
                            $currentOpenStatus[] = [
                                'isOpen' => $hour->is_open == 1,
                                'times' => [
                                    'start' => $hour->open_time ? Carbon::parse($hour->open_time) : null,
                                    'end' => $hour->close_time ? Carbon::parse($hour->close_time) : null,
                                ],
                            ];
                        }
                    }

                    // Überprüfen, ob das Restaurant geöffnet ist und die entsprechende Meldung generieren
                    if (!empty($currentOpenStatus)) {
                        $isOpen = false;

                        // Durch die aktuellen Öffnungszeiten iterieren
                        foreach ($currentOpenStatus as $status) {
                            $openingTimes = $status['times'];

                            // Überprüfen, ob das Restaurant geöffnet ist
                            if ($openingTimes['start'] && $openingTimes['end']) {
                                if ($currentDateTime->between($openingTimes['start'], $openingTimes['end'])) {
                                    $isOpen = true;
                                    break;
                                }
                            }
                        }

                        // Meldung generieren
                        if ($isOpen) {
                            $restaurantStatus[$restaurant->id] = "open";
                        } else {
                            $restaurantStatus[$restaurant->id] = "closed";
                        }
                    } else {
                        // Wenn keine Öffnungszeiten für das Restaurant vorhanden sind
                        $restaurantStatus[$restaurant->id] = "no opening hours available";
                    }
                } else {
                    // Wenn keine Öffnungszeiten für das Restaurant vorhanden sind
                    $restaurantStatus[$restaurant->id] = "no opening hours available";
                }
            }

            // Die aktuellen Abfrageparameter für die Pagination beibehalten
            $restaurants->appends(request()->only(['query', 'distance']));

            // Stadtnamen aus der Session abrufen
            $findCityName = $location->city;

            // View zurückgeben
            return view('frontend.pages.listingrestaurant.grid-listing-filterscol', [
                'restaurants' => $restaurants,
                'sponsoredRestaurants' => $sponsoredRestaurants,
                'userLatitude' => $userLatitude,
                'userLongitude' => $userLongitude,
                'selectedDistance' => $selectedDistance,
                'findCityName' => $findCityName,
                'restaurantStatus' => $restaurantStatus
            ]);
        }

        // Fehlerbehandlung für fehlende Standortdaten
        return view('frontend.pages.error');
    }

    /**
     * Gesponserte Restaurants abrufen.
     */
    protected function getSponsoredRestaurants($latitude, $longitude, $selectedDistance, $currentDateTime)
    {
        return ModTopRankPrice::join('mod_shops', 'mod_top_rank_prices.shop_id', '=', 'mod_shops.id')
            ->where('mod_top_rank_prices.start_time', '<=', $currentDateTime)
            ->where('mod_top_rank_prices.end_time', '>=', $currentDateTime)
            ->where('mod_shops.published', true)
            ->select('mod_shops.*')
            ->selectRaw(
                '( 6371 * acos( cos( radians(?) ) * cos( radians( mod_shops.lat ) ) *
                cos( radians( mod_shops.lng ) - radians(?) ) + sin( radians(?) ) *
                sin( radians( mod_shops.lat ) ) ) ) AS distance',
                [$latitude, $longitude, $latitude]
            )
            ->having('distance', '<', $selectedDistance)
            ->get();
    }
}
