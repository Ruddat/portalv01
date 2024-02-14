<?php

namespace App\Livewire\Backend\Admin;

use Livewire\Component;
use App\Models\ModBottles;

class AdminBottlesList extends Component
{
    public function render()
    {
        return view('livewire.backend.admin.admin-bottles-list' , [
            'bottles' => ModBottles::orderBy('bottles_ordering', 'asc')->get()
        ]);
    }
}
