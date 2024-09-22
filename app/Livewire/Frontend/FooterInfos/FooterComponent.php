<?php

namespace App\Livewire\Frontend\FooterInfos;

use App\Models\ModShop;
use Livewire\Component;
use App\Models\ModCuisines;

class FooterComponent extends Component
{
    public $restaurants = [];
    public $cuisines = [];
    public $uniqueCities = [];  // Füge eine Variable für die einzigartigen Städte hinzu

    public function mount()
    {
        // Holen der Restaurants, die veröffentlicht und aktiv sind, und dann mischen und maximal 10 auswählen
        $this->restaurants = ModShop::where('published', true)
                                       ->where('status', 'on')
                                       ->inRandomOrder()
                                       ->limit(10)
                                       ->get(['id', 'title', 'shop_slug', 'city']);

        // Holen von 10 zufälligen Küchenarten
        $this->cuisines = ModCuisines::inRandomOrder()
                                      ->limit(10)
                                      ->get(['name']);

        // Holen der einzigartigen Städte und den zugehörigen Slugs, in zufälliger Reihenfolge und auf 10 beschränkt
        $this->uniqueCities = ModShop::where('published', true)
                                      ->where('status', 'on')
                                      ->select('city', 'shop_slug')  // Stadt und Slug auswählen
                                      ->distinct('city')             // Sicherstellen, dass Städte einzigartig sind
                                      ->inRandomOrder()              // Zufällige Reihenfolge
                                      ->limit(10)                    // Auf 10 Städte beschränken
                                      ->get();
    }



    public function render()
    {
        return view('livewire.frontend.footer-infos.footer-component', [
            'restaurants' => $this->restaurants,
            'cuisines' => $this->cuisines,
            'uniqueCities' => $this->uniqueCities,  // Übergabe der einzigartigen Städte an die View
        ]);
    }
}
