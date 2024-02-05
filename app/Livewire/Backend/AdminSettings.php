<?php

namespace App\Livewire\Backend;

use Livewire\Component;

class AdminSettings extends Component
{

    public $tab = null;
    public $default_tab = 'general_settings';
    protected $querystring = ['tab'];

    public function selectTab($tab){
    $this->tab = $tab;
    }

    public function mount() {
        $this->tab = request()->tab ? request()->tab : $this->default_tab;
    }

    
    public function render()
    {
        return view('livewire.backend.admin-settings');
    }
}
