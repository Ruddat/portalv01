<?php

namespace App\Livewire\Frontend\Buyer;

use App\Models\Client;
use App\Models\ModShop;
use Livewire\Component;
use Livewire\WithPagination;

class DashboardIndex extends Component
{
    use WithPagination;

    public $client;

    public function mount()
    {
        // Hole den authentifizierten Benutzer
        $this->client = Client::find(auth()->id());
    }

    private function findNearbyRestaurants($lat, $lng, $radius)
    {
        $radiusInKm = $radius;

        return ModShop::selectRaw("
            *, (6371 * acos(cos(radians(?))
            * cos(radians(lat))
            * cos(radians(lng) - radians(?))
            + sin(radians(?))
            * sin(radians(lat)))) AS distance", [$lat, $lng, $lat])
            ->having('distance', '<', $radiusInKm)
            ->orderBy('distance')
            ->paginate(6);
    }

    public function render()
    {
        $restaurants = [];
        if ($this->client) {
            $restaurants = $this->findNearbyRestaurants($this->client->latitude, $this->client->longitude, 15);
        }

        return view('livewire.frontend.buyer.dashboard-index', [
            'restaurants' => $restaurants,
        ])->layout('layouts.buyerdashboard');
    }
}
