<?php

namespace App\Livewire\Backend\Seller\Settings;

use App\Models\Seller;
use Livewire\Component;
use Masmerise\Toaster\Toaster;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class SellerProfileTabs extends Component
{

    public $tab = null;
    public $tabname = 'personal_details';
    protected $querystring = ['tab'];
    public $name, $email, $username, $seller_id;
   // public $toastrMessage;
    public $toastrMessage = ['status' => null, 'msg' => ''];
    public $current_password, $new_password, $new_password_confirmation;


    public function selectTab($tab){
        $this->tab = $tab;
     }

    public function mount() {
        $this->tab = request()->tab ? request()->tab : $this->tabname;

        if (Auth::guard('seller')->check()) {
            $seller = Auth::guard('seller')->user();
            $this->name = $seller->name;
            $this->email = $seller->email;
            $this->username = $seller->username;
            $this->seller_id = $seller->id;
        }
    }

    public function updateSellerPersonalDetails(){

        $this->validate([
            'name' => 'required|min:5|max:45',
            'email' => 'required|email|unique:sellers,email,'.$this->seller_id,
            'username' => 'required|min:5|unique:sellers,username,'.$this->seller_id,
        ]);


        Seller::find($this->seller_id)
        ->update([
            'name' => $this->name,
            'email' => $this->email,
            'username' => $this->username,
        ]);

        $this->dispatch('updateAdminSellerHeaderInfo');
        $this->dispatch('updateSellerInfo', [
            'sellerName' => $this->name,
            'sellerEmail' => $this->email,
        ]);
        return $this->dispatch('toast', message: 'Your Personal details have been updated successfully', notify:'success' );

        //$this->showToastr('success', 'Your Personal details have been updated successfully');
       // $this->toastrMessage = ['status' => 'success', 'msg' => 'Your Personal details have been updated successfully'];
    }



    public function updatePassword(){

        $this->validate([
            'current_password' =>[
                'required', function($attribute, $value, $fail){
                    if (!Hash::check($value, Seller::find(auth('seller')->id())->password)){
                        return $fail(trans('The current password is incorrect'));
                    }
                }
            ],
            'new_password' => 'required|min:5|max:8|confirmed',
        ]);

       // dd('ok. validatet');


       $query = Seller::findOrfail(auth('seller')->id())->update([
        'password' =>Hash::make($this->new_password)
       ]);

       if ($query) {
        // Send notification to the seller
        $_seller = Seller::findOrfail($this->seller_id);
        $data = array(
            'seller'=>$_seller,
            'new_password' =>$this->new_password
        );

        $mail_body = view('email-templates.seller-reset-email-template', $data)->render();

        $mailConfig = array(
            'mail_from_email'=>env('MAIL_FROM_ADDRESS'),
            'mail_from_name'=>env('MAIL_FROM_NAME'),
            'mail_recipient_email'=>$_seller->email,
            'mail_recipient_name'=>$_seller->name,
            'mail_subject'=>'Your password has been changed',
            'mail_body'=>$mail_body

        );

        sendEmail($mailConfig);

        $this->current_password = $this->new_password = $this->new_password_confirmation = 'null';
        return $this->dispatch('toast', message: 'Your Password has been updated successfully', notify:'success' );





     //   $this->dispatch('show-toast', 'New Post has been successfully created!', 'success');
     //   $this->showToastr('success', 'Your Password has been updated successfully');
    //    $this->toastrMessage = ['status' => 'success', 'msg' => 'Your Password has been updated successfully'];
       } else {
        $this->dispatch('show-toast', 'New Post has been successfully created!', 'success');
        $this->showToastr('error', 'Your old password is incorrect');
        $this->toastrMessage = ['status' => 'error', 'msg' => 'Your old password is incorrect'];
        return $this->dispatch('toast', message: 'Your old password is incorrect', notify:'error' );
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
        return view('livewire.backend.seller.settings.seller-profile-tabs');
    }
}

































