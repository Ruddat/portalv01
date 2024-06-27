<?php

namespace App\Livewire\Frontend\Cart;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class TipComponent extends Component
{
    public $tipType = 'amount'; // 'amount', 'percentage', 'none'
    public $tipPercentage = null; // '5', '10', '15', '20', null (for no tip)
    public $tipAmount = 0;

    public function setTipType($type)
    {
        $this->tipType = $type;
        Session::put('tipType', $type);
    }

    public function setTipPercentage($percentage)
    {
        $this->tipPercentage = $percentage;
        Session::put('tipPercentage', $percentage);
      //  dd(Session::get('tipPercentage'));

    }

    public function setTipAmount($amount)
    {
        $this->tipAmount = $amount;
        Session::put('tipAmount', $amount);
      //  dd(Session::get('tipAmount'));
    }

    public function resetTip()
    {
        $this->tipPercentage = null;
        $this->tipAmount = 0;
        Session::forget('tipPercentage');
        Session::forget('tipAmount');
        Session::put('tipType', 'none');
    }

    public function render()
    {
        return view('livewire.frontend.cart.tip-component');
    }
}
