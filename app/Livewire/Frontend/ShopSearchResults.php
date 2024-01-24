<?php

namespace App\Livewire\Frontend;

use App\Models\ModShop;
use Livewire\Component;

class ShopSearchResults extends Component
{

    public ModShop $results;

    protected $layout = 'frontend.layouts.default';
    public $userInput = 'Address, neighborhood...';
    public $restaurants;

    public function mount(ModShop $results)
    {
        $this->results = $results;
    //     $this->restaurants = $restaurants;
     //   $this->video = new Video();
    }


    public function render()
    {


//dd($restaurants);

        return view('livewire.frontend.shop-search-results')
            ->layout($this->layout);
    }
}
