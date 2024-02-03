<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AdminProfileTabs extends Component
{

    public $tab = null;
    public $tabname = 'personal_details';
    protected $querystring = ['tab'];
    public $name, $email, $username, $admin_id;


    public function selectTab($tab){
        $this->tab = $tab;
     }

    public function mount() {
        $this->tab = request()->tab ? request()->tab : $this->tabname;

        if (Auth::guard('admin')->check()) {
            $admin = Auth::guard('admin')->user();
            $this->name = $admin->name;
            $this->email = $admin->email;
            $this->username = $admin->username;
            $this->admin_id = $admin->id;
        }
    }

    public function updateAdminPersonalDetails(){
        $this->validate([
            'name' => 'required|min:3|max:45',
            'email' => 'required|email',
            'username' => 'required|min:3|max:45',
        ]);

        $admin = Auth::guard('admin')->user();
        $admin->name = $this->name;
        $admin->email = $this->email;
        $admin->username = $this->username;
        $admin->save();

        $toastrMessage = 'Profile updated successfully';


     //   session()->flash('success', 'Profile updated successfully');
    }

    public function render()
    {
        return view('livewire.backend.admin-profile-tabs');
    }
}
