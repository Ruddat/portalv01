<?php

namespace App\Livewire\Frontend\Product;

use Livewire\Component;

class IngredientsOverlay extends Component
{


    public $showOverlay = [];

    public function openOverlay()
    {
        $this->showOverlay = true;
    }

    public function closeOverlay()
    {
        $this->showOverlay = false;
    }


    public function render()
    {
        return view('livewire.frontend.product.ingredients-overlay');
    }
}
