<?php

namespace App\Livewire\Frontend\Cart;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class TipComponent extends Component
{
    public $tipType = 'percentage'; // 'amount', 'percentage', 'none'
    public $tipPercentage = null; // '5', '10', '15', '20', null (for no tip)
    public $tipAmount = 0;


    public function mount()
    {
        $tipType = $this->setTipType($this->tipType);

        if (Session::has('tipType')) {
            $this->tipType = Session::get('tipType');
        }

        if (Session::has('tipPercentage')) {
            $this->tipPercentage = Session::get('tipPercentage');
        }

        if (Session::has('tipAmount')) {
            $this->tipAmount = Session::get('tipAmount');
        }
    }


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
      $this->dispatch('tipPercentage');
    }

    public function setTipAmount($amount)
    {
        $this->tipAmount = $amount;
        Session::put('tipAmount', $amount);
       // dd(Session::get('tipAmount'));
       $this->dispatch('tipAmount');
    }

    public function resetTip()
    {


        // Setze die Felder auf ihre Standardwerte zurück
        $this->reset(['tipPercentage', 'tipAmount', 'tipType']); // Setzt auch tipType auf 'none'

        $this->tipPercentage = null;
        $this->tipAmount = 0;
        Session::forget('tipPercentage');
        Session::forget('tipAmount');
        Session::put('tipType', 'none');
        if ($this->tipType !== 'amount') {

           $this->dispatch('tipPercentage');

        } elseif ($this->tipType === 'percentage') {

            $this->dispatch('tipPercentage');
        }

        // Reset all fields
        $this->reset(['tipPercentage', 'tipAmount', 'tipType']);

        // Set session values to null or defaults
        Session::forget('tipPercentage');
        Session::forget('tipAmount');
        Session::put('tipType', 'none');

        // This makes sure no selection is rendered
        $this->tipPercentage = null;
        $this->tipAmount = null;



    }

    public function render()
    {

        return view('livewire.frontend.cart.tip-component');
    }
}
