<?php

namespace App\Livewire\Backend\Admin;

use Livewire\Component;
use App\Models\ModAllergens;

class AdminAllergensList extends Component
{
    public function render()
    {
        return view('livewire.backend.admin.admin-allergens-list' , [
            'allergens' => ModAllergens::orderBy('ordering', 'asc')->get()
        ]);
    }
}
