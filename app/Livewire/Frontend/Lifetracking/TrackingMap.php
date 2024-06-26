<?php

namespace App\Livewire\Frontend\LifeTracking;

use Livewire\Component;
use Illuminate\Support\Facades\Log;

class TrackingMap extends Component
{


    public $latitude = 51.505; // Standardwert
    public $longitude = -0.09; // Standardwert

    protected $listeners = ['positionUpdated' => 'updatePosition'];

    public function updatePosition($latitude, $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->emit('updateMap', $latitude, $longitude);
    }

    public function render()
    {
        return view('livewire.frontend.life-tracking.tracking-map')->layout('layouts.track'); // Stellen Sie sicher, dass das Layout existiert
    }
}
