<?php

namespace App\Livewire\Backend\Seller\Marketing;

use Carbon\Carbon;
use App\Models\ModShop;
use Livewire\Component;
use App\Models\GeneralSettings;
use App\Models\ModTopRankPrice;

class TopRankComponent extends Component
{
    public $shopId;
    public $minRadius = 0;
    public $maxRadius = 20;
    public $startTime;
    public $endTime;
    public $currentPrice = 0.5;
    public $targetRank = 1;
    public $topRankPosition;


    public function mount($shopId)
    {
        $this->shopId = $shopId;
        $this->startTime = Carbon::now()->format('Y-m-d\TH:i');
        $this->endTime = Carbon::now()->addDays(7)->format('Y-m-d\TH:i');

        $minimumBidSetting = GeneralSettings::whereNotNull('minimum_bid')->first();
        $this->currentPrice = $minimumBidSetting ? $minimumBidSetting->minimum_bid : 0.50;

        \Log::info('Initial current price set to: ' . $this->currentPrice);

        $this->calculateCurrentRank();
    }

    public function submit()
    {
        \Log::info('Submitting top rank with current price: ' . $this->currentPrice);

        $shop = ModShop::find($this->shopId);

        if (!$shop) {
            \Log::error('Shop not found.');
            return;
        }

        $calculatedCoordinates = $this->calculateCoordinates($shop->lat, $shop->lng, $this->minRadius, $this->maxRadius);

        \Log::info('Calculated coordinates: ' . json_encode($calculatedCoordinates));

        // Preisberechnung basierend auf der Ziel-Rang-Position
        $targetRank = $this->targetRank;
        $currentTopRanks = ModTopRankPrice::orderBy('rank', 'asc')->get();

        if ($currentTopRanks->isEmpty()) {
            $this->currentPrice = 0.5;
            $rank = 1;
        } else {
            // Sicherstellen, dass der Ziel-Rang innerhalb der Grenzen liegt
            if ($targetRank < 1) {
                $targetRank = 1;
            } elseif ($targetRank > 10) {
                $targetRank = 10;
            }

            // Berechnung des Preises für den Ziel-Rang
            $rankedPrices = $currentTopRanks->pluck('current_price', 'rank')->toArray();
            $rankedPrices = array_merge([0 => 0.5], $rankedPrices); // Mindestpreis für Rang 1

            $this->currentPrice = $rankedPrices[$targetRank - 1] + 0.1; // Preis für den Ziel-Rang
            $rank = $targetRank;
dd($this->currentPrice);

            // Alle Ränge unterhalb des neuen Rangs aktualisieren
            foreach ($currentTopRanks as $topRank) {
                if ($topRank->rank >= $targetRank) {
                    $topRank->rank++;
                    $topRank->save();
                }
            }
        }

        \Log::info('Calculated new price: ' . $this->currentPrice);

        ModTopRankPrice::create([
            'shop_id' => $this->shopId,
            'current_price' => $this->currentPrice,
            'calculated_coordinates' => $calculatedCoordinates['min_lat'] . ',' . $calculatedCoordinates['min_lng'] . ' - ' . $calculatedCoordinates['max_lat'] . ',' . $calculatedCoordinates['max_lng'],
            'original_coordinates' => $shop->lat . ',' . $shop->lng,
            'start_time' => Carbon::now(),
            'end_time' => Carbon::now()->addDays(7),
            'lat' => $shop->lat,
            'lng' => $shop->lng,
            'rank' => $rank // Initialwert für rank
        ]);

        $this->calculateRankings();

        \Log::info('Top rank submission complete.');
    }

    public function calculateCoordinates($lat, $lng, $minRadius, $maxRadius)
    {
        $earthRadius = 6371;

        $coordinatesMin = $this->calculateCoordinatesForRadius($lat, $lng, $minRadius, $earthRadius);
        $coordinatesMax = $this->calculateCoordinatesForRadius($lat, $lng, $maxRadius, $earthRadius);

        return [
            'min_lat' => $coordinatesMin['lat'],
            'min_lng' => $coordinatesMin['lng'],
            'max_lat' => $coordinatesMax['lat'],
            'max_lng' => $coordinatesMax['lng']
        ];
    }

    private function calculateCoordinatesForRadius($lat, $lng, $radius, $earthRadius)
    {
        $latFrom = deg2rad($lat);
        $lngFrom = deg2rad($lng);

        $radiusInDegrees = $radius / $earthRadius;

        $newLat = $latFrom + $radiusInDegrees;
        $newLng = $lngFrom + ($radiusInDegrees / cos(deg2rad($latFrom)));

        return [
            'lat' => rad2deg($newLat),
            'lng' => rad2deg($newLng)
        ];
    }

    public function updatedStartTime()
    {
        $this->updatePriceAndRank();
    }

    public function updatedEndTime()
    {
        $this->updatePriceAndRank();
    }

    public function updatePriceAndRank()
    {
        $shop = ModShop::find($this->shopId);

        if (!$shop) {
            \Log::error('Shop not found.');
            return;
        }

        $calculatedCoordinates = $this->calculateCoordinates($shop->lat, $shop->lng, $this->minRadius, $this->maxRadius);

        \Log::info('Calculated coordinates for update: ' . json_encode($calculatedCoordinates));

        $demandFactor = $this->calculateDemandFactor($shop, $this->minRadius, $this->maxRadius);

        $this->currentPrice = $this->currentPrice + $demandFactor;

        $this->topRankPosition = $this->calculateTopRankPosition();
    }

    public function calculateDemandFactor($shop, $minRadius, $maxRadius)
    {
        $otherShopsCount = ModShop::where('id', '!=', $shop->id)
            ->whereRaw("ST_Distance_Sphere(point(lng, lat), point(?, ?)) BETWEEN ? AND ?", [
                $shop->lng, $shop->lat, $minRadius * 1000, $maxRadius * 1000
            ])->count();

        \Log::info('Other shops in the auction within the radius: ' . $otherShopsCount);

        $demandFactor = $otherShopsCount * 0.1;
        \Log::info('Calculated demand factor: ' . $demandFactor);

        return $demandFactor;
    }

    public function calculateRankings()
    {
        $shop = ModShop::find($this->shopId);
        if (!$shop) {
            \Log::error('Shop not found.');
            return;
        }

        $topRankPrices = ModTopRankPrice::orderBy('current_price', 'desc')->get();

        $rank = 1;
        foreach ($topRankPrices as $price) {
            $price->update(['rank' => $rank]);
            $rank++;
        }

        \Log::info('Rankings updated successfully.');
    }

    public function calculateTopRankPosition()
    {
        $topRankPrices = ModTopRankPrice::orderBy('current_price', 'desc')->get();

        $position = 1;
        foreach ($topRankPrices as $price) {
            if ($price->shop_id == $this->shopId) {
                return $position;
            }
            $position++;
        }

        return null;
    }

    public function calculateCurrentRank()
    {
        $shop = ModShop::find($this->shopId);
        if (!$shop) {
            \Log::error('Shop not found.');
            return;
        }

        $this->topRankPosition = $this->calculateTopRankPosition();
    }

    public function render()
    {
        return view('livewire.backend.seller.marketing.top-rank-component');
    }
}
