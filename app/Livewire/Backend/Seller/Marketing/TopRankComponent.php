<?php

namespace App\Livewire\Backend\Seller\Marketing;

use Carbon\Carbon;
use App\Models\ModShop;
use Livewire\Component;
use App\Models\GeneralSettings;
use App\Models\ModTopRankPrice;
use App\Models\ModTopRankPriceArchived;

class TopRankComponent extends Component
{
    public $shopId;
    public $minRadius = 0;
    public $maxRadius = 20;
    public $startTime;
    public $endTime;
    public $currentPrice = 0.5;
    public $minimumBidFactorPrice = 0.08;
    public $targetRank = 1;
    public $topRankPosition;
    public $initialTopRankPosition;
    public $shopLat;
    public $shopLng;
    public $topRanks = [];
    public $notify_on_outbid = false;

    protected $rules = [
        'startTime' => 'required|date|after_or_equal:now',
        'endTime' => 'required|date|after:startTime',
    ];

    public function mount($shopId)
    {
        $this->shopId = $shopId;
        $this->startTime = Carbon::now()->addHour(1)->format('Y-m-d\TH:i');
        $this->endTime = Carbon::now()->addDays(7)->format('Y-m-d\TH:i');

        $minimumBidSetting = GeneralSettings::whereNotNull('minimum_bid')->first();
        $this->currentPrice = $minimumBidSetting ? $minimumBidSetting->minimum_bid : 0.50;

        $minimumBidFactorSetting = GeneralSettings::whereNotNull('minimum_bid_factor')->first();
        $this->minimumBidFactorPrice = $minimumBidFactorSetting ? $minimumBidFactorSetting->minimum_bid_factor : 0.08;

        $shop = ModShop::find($this->shopId);
        if ($shop) {
            $this->shopLat = $shop->lat;
            $this->shopLng = $shop->lng;
        }

        \Log::info('Initial current price set to: ' . $this->currentPrice);

        // Initialen Rang berechnen und targetRank setzen
        $this->calculateRank();
        $this->initialTopRankPosition = $this->topRankPosition; // Speichern des initialen Werts
        $this->targetRank = $this->initialTopRankPosition;
        $this->calculatePrice();

        // TopRank-Daten laden
        $this->loadTopRanks();
    }

    public function calculateRank()
    {
        $similarShops = $this->getSimilarShops($this->shopLat, $this->shopLng);

        $existingTopRanks = ModTopRankPrice::whereIn('shop_id', $similarShops->pluck('id'))
                                           ->where('start_time', '<=', $this->endTime)
                                           ->where('end_time', '>=', $this->startTime)
                                           ->orderBy('rank', 'asc')
                                           ->get();

        $this->topRankPosition = count($similarShops) + 1;

        if ($existingTopRanks->count() > 0) {
            $highestRank = $existingTopRanks->max('rank');
            $this->topRankPosition = $highestRank + 1;

            foreach ($existingTopRanks as $topRank) {
                if ($this->currentPrice > $topRank->current_price) {
                    $this->topRankPosition = $topRank->rank;
                    break;
                }
            }
        }

        // Initialen Top-Rank-Position setzen, wenn sie nicht bereits gesetzt ist
        if (!$this->initialTopRankPosition) {
            $this->initialTopRankPosition = $this->topRankPosition;
        }

        \Log::info('Calculated rank position: ' . $this->topRankPosition);
    }

    private function getSimilarShops($lat, $lng)
    {
        $radius = $this->maxRadius; // Radius in Kilometern
        $earthRadius = 6371; // Radius der Erde in Kilometern

        return ModShop::selectRaw("*, ( $earthRadius * acos( cos( radians(?) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(?) ) + sin( radians(?) ) * sin( radians( lat ) ) ) ) AS distance", [$lat, $lng, $lat])
            ->havingRaw("distance < ?", [$radius])
            ->orderBy('distance')
            ->limit(30)
            ->get();
    }

    public function updatedShopLat()
    {
        $this->calculateRank();
        $this->calculatePrice();
        $this->loadTopRanks();
    }

    public function updatedShopLng()
    {
        $this->calculateRank();
        $this->calculatePrice();
        $this->loadTopRanks();
    }

    public function updatedTargetRank()
    {
        // Sicherstellen, dass der Zielrang nicht höher als der initiale Top-Rank-Position ist
        $this->targetRank = min($this->targetRank, $this->initialTopRankPosition);
        $this->calculatePrice();
    }

    public function calculatePrice()
    {
        $basePrice = $this->currentPrice;
        $pricePerRank = $this->minimumBidFactorPrice;

        // Sicherstellen, dass der Zielrang nicht höher als der initiale Top-Rank-Position ist
        $targetRank = min($this->targetRank, $this->initialTopRankPosition);

        $similarShops = $this->getSimilarShops($this->shopLat, $this->shopLng);

        $existingTopRanks = ModTopRankPrice::whereIn('shop_id', $similarShops->pluck('id'))
                                           ->where('start_time', '<=', $this->endTime)
                                           ->where('end_time', '>=', $this->startTime)
                                           ->orderBy('rank', 'asc')
                                           ->get();

        // Initialisiere das Preis-Array mit Basispreis
        $rankPrices = array_fill(1, $this->initialTopRankPosition, $basePrice);

        // Fülle das Preis-Array mit bestehenden Preisen
        foreach ($existingTopRanks as $topRank) {
            $rankPrices[$topRank->rank] = $topRank->current_price;
        }

        // Berechne den neuen Preis basierend auf dem Zielrang
        if ($targetRank == 1) {
            $this->currentPrice = max($rankPrices) + $pricePerRank;
        } else {
            $this->currentPrice = max(array_slice($rankPrices, 0, $targetRank)) + $pricePerRank;
        }

        \Log::info('Calculated current price: ' . $this->currentPrice);
    }

    public function submit()
    {
        \Log::info('Submitting top rank with current price: ' . $this->currentPrice);

        $this->validate();

        $shop = ModShop::find($this->shopId);

        if (!$shop) {
            \Log::error('Shop not found.');
            return;
        }

        // dd($this->currentPrice, $this->targetRank, $this->startTime, $this->endTime, $this->notify_on_outbid);

        $existingEntry = ModTopRankPrice::where('shop_id', $this->shopId)
                                        ->where('start_time', '<=', $this->endTime)
                                        ->where('end_time', '>=', $this->startTime)
                                        ->first();

        if ($existingEntry) {
            \Log::error('Entry with the same shop and time range already exists.');
            session()->flash('error', 'Eintrag für diesen Zeitraum und Shop existiert bereits.');
            return;
        }

        // Berechnung des Rangs für den neuen Eintrag
        $this->calculateRank();
        $newRank = $this->targetRank;

        // Aktualisierung der Ränge der bestehenden Einträge
        $this->updateExistingRanks($newRank);

       // dd($this->currentPrice, $newRank, $this->startTime, $this->endTime, $this->notify_on_outbid);
        // Erstellen des neuen Eintrags
        ModTopRankPrice::create([
            'shop_id' => $this->shopId,
            'lat' => $this->shopLat,
            'lng' => $this->shopLng,
            'current_price' => $this->currentPrice,
            'rank' => $newRank,
            'original_rank' => $newRank,
            'start_time' => $this->startTime,
            'end_time' => $this->endTime,
            'notify_on_outbid' => $this->notify_on_outbid,

        ]);

        session()->flash('success', 'Eintrag erfolgreich gespeichert.');
        $this->loadTopRanks(); // TopRank-Daten neu laden
    }

    public function updateExistingRanks($newRank)
    {
        $similarShops = $this->getSimilarShops($this->shopLat, $this->shopLng);

        $existingTopRanks = ModTopRankPrice::whereIn('shop_id', $similarShops->pluck('id'))
                                           ->where('start_time', '<=', $this->endTime)
                                           ->where('end_time', '>=', $this->startTime)
                                           ->orderBy('rank', 'asc')
                                           ->get();

        foreach ($existingTopRanks as $topRank) {
            if ($topRank->rank >= $newRank) {
                $topRank->rank += 1;
                $topRank->save();
            }
        }
    }

    public function loadTopRanks()
    {
        $this->topRanks = ModTopRankPrice::where('shop_id', $this->shopId)
                                         ->whereNull('deleted_at')
                                         ->orderBy('rank', 'asc')
                                         ->get();
    }

    public function deleteTopRank($id)
    {
        $topRank = ModTopRankPrice::find($id);

        if ($topRank) {
        // Konvertiere das Modell in ein Array und füge 'deleted_at' hinzu
        $data = $topRank->toArray();
        $data['deleted_at'] = now();

        // Archivieren des Eintrags
        ModTopRankPriceArchived::create($data);
        // Eintrag aus der originalen Tabelle löschen
        $topRank->delete();
        // TopRank-Daten neu laden
        $this->loadTopRanks();
        }
    }

    public function render()
    {
        return view('livewire.backend.seller.marketing.top-rank-component', [
            'topRanks' => $this->topRanks,
        ]);
    }
}

