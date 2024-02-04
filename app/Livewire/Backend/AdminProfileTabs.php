<?php

namespace App\Livewire\Backend;

use App\Models\Admin;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminProfileTabs extends Component
{

    public $tab = null;
    public $tabname = 'personal_details';
    protected $querystring = ['tab'];
    public $name, $email, $username, $admin_id;
   // public $toastrMessage;
    public $toastrMessage = ['status' => null, 'msg' => ''];
    public $current_password, $new_password, $new_password_confirmation;


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
            'name' => 'required|min:5|max:45',
            'email' => 'required|email|unique:admins,email,'.$this->admin_id,
            'username' => 'required|min:5|unique:admins,username,'.$this->admin_id,
        ]);


        Admin::find($this->admin_id)
        ->update([
            'name' => $this->name,
            'email' => $this->email,
            'username' => $this->username,
        ]);

        $this->dispatch('updateAdminSellerHeaderInfo');
        $this->dispatch('updateAdminInfo', [
            'adminName' => $this->name,
            'adminEmail' => $this->email,
        ]);

        //$this->showToastr('success', 'Your Personal details have been updated successfully');
        $this->toastrMessage = ['status' => 'success', 'msg' => 'Your Personal details have been updated successfully'];
    }



    public function updatePassword(){

        $this->validate([
            'current_password' =>[
                'required', function($attribute, $value, $fail){
                    if (!Hash::check($value, Admin::find(auth('admin')->id())->password)){
                        return $fail(trans('The current password is incorrect'));
                    }
                }
            ],
            'new_password' => 'required|min:5|max:8|confirmed',
        ]);

       // dd('ok. validatet');


       $query = Admin::findOrfail(auth('admin')->id())->update([
        'password' =>Hash::make($this->new_password)
       ]);

       if ($query) {
        $this->current_password = $this->new_password = $this->new_password_confirmation = 'null';
        $this->dispatch('show-toast', 'New Post has been successfully created!', 'success');
        $this->showToastr('success', 'Your Password has been updated successfully');
        $this->toastrMessage = ['status' => 'success', 'msg' => 'Your Password has been updated successfully'];
       } else {
        $this->dispatch('show-toast', 'New Post has been successfully created!', 'success');
        $this->showToastr('error', 'Your old password is incorrect');
        $this->toastrMessage = ['status' => 'error', 'msg' => 'Your old password is incorrect'];
       }

    }

    public function showToastr($type, $message)
    {
        return $this->dispatchBrowserevent('showToastr',[
            'type' => $type,
            'message' => $message
        ]);

    }

    public function render()
    {
        return view('livewire.backend.admin-profile-tabs');
    }
}
