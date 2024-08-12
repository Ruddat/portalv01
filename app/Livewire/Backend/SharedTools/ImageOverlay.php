<?php

namespace App\Livewire\Backend\SharedTools;

use Livewire\Component;

class ImageOverlay extends Component
{
    public $imageUrl;

    protected $listeners = ['showOverlay'];

    public function showOverlay($url)
    {
        $this->imageUrl = $url;
        $this->dispatchBrowserEvent('show-overlay');
    }

    public function closeOverlay()
    {
        $this->dispatchBrowserEvent('close-overlay');
    }
    
    public function render()
    {
        return view('livewire.backend.shared-tools.image-overlay');
    }
}
