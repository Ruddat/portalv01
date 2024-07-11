<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;



class AdminSellerHeaderProfileInfo extends Component
{

    public $admin;
    public $seller;
    public $broker;

    public $listeners = [
        'updateAdminSellerHeaderInfo' => '$refresh'
    ];

    public function mount()
    {
        if (Auth::guard('admin')->check()) {
            $this->admin = Auth::guard('admin')->user();
        } elseif (Auth::guard('seller')->check()) {
            $this->seller = Auth::guard('seller')->user();
        } elseif (Auth::guard('broker')->check()) {
        $this->broker = Auth::guard('broker')->user();
    }

    }



    public function render()
    {
        return view('livewire.backend.admin-seller-header-profile-info');
    }
}
