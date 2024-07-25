<?php
namespace App\Services;

use App\Models\ModShop;
use App\Models\ModTopRankPrice;
use Illuminate\Support\Facades\Log;

class TopRankPriceCalculator
{
    protected $basePrice;

    public function __construct($basePrice = 0.5)
    {
        $this->basePrice = $basePrice;
        \Log::info('TopRankPriceCalculator initialized with base price: ' . $this->basePrice);
    }

    public function calculatePrice($shopId, $minRadius, $maxRadius, $xx)
    {
        \Log::info('Calculating price for shop ID: ' . $shopId . ' with minRadius: ' . $minRadius . ' and maxRadius: ' . $maxRadius);

        $shop = ModShop::find($shopId);
        \Log::info('Shop det1234ails: ' . print_r($shop->toArray(), true));

        $demandFactor = $this->calculateDemandFactor($shop, $minRadius, $maxRadius);
        dd($demandFactor);
        $distanceFactor = $this->calculateDistanceFactor($shop);

        $calculatedPrice = $this->basePrice + $distanceFactor + $demandFactor;
        \Log::info('Calculated price: ' . $calculatedPrice);

        return $calculatedPrice;
    }

    public function calculateDemandFactor($shop, $minRadius, $maxRadius)
    {
        $otherShopsCount = ModShop::where('id', '!=', $shop->id)
            ->whereRaw("ST_Distance_Sphere(point(lng, lat), point(?, ?)) BETWEEN ? AND ?", [
                $shop->lng, $shop->lat, $minRadius * 1000, $maxRadius * 1000
            ])->count();

        \Log::info('Other shops in the auction within the radius: ' . $otherShopsCount);

        // Begrenze den Nachfragefaktor
        $demandFactor = min($otherShopsCount * 0.1, 1.0); // Maximal 1.0
        \Log::info('Calculated demand factor: ' . $demandFactor);

        return $demandFactor;
    }

    protected function calculateDistanceFactor($shop)
    {
        $referenceLat = 48.137154;
        $referenceLng = 11.576124;

        $distance = $this->calculateDistance($shop->lat, $shop->lng, $referenceLat, $referenceLng);
        \Log::info('Calculated distance to reference point: ' . $distance);

        $distanceFactor = $distance * 0.01;
        \Log::info('Calculated distance factor: ' . $distanceFactor);

        return $distanceFactor;
    }

    public function calculateDistance($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadius = 6371;

        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLng / 2) * sin($dLng / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earthRadius * $c;

        return $distance;
    }
}
