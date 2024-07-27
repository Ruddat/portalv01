<?php

namespace App\Livewire\Backend\Seller\Marketing;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\ModSellerStampCard;

class StampCardComponent extends Component
{
    public $stampCard;
    public $remainingDays = 0;
    public $shopId;
    public $showCancelButton = false;
    public $showExtendButton = false;

    public function mount($shopId)
    {
        $this->shopId = $shopId;
        $this->stampCard = ModSellerStampCard::where('shop_id', $this->shopId)->first();
        $this->loadProgramStatus();
    }

    public function loadProgramStatus()
    {
        if ($this->stampCard) {
            $activationDate = new Carbon($this->stampCard->activated_at);
            $expiryDate = $activationDate->copy()->addDays(3);

            if (Carbon::now()->greaterThan($expiryDate)) {
                if (!$this->stampCard->is_renewed) {
                    $this->showExtendButton = true;
                    $newExpiryDate = $expiryDate->copy()->addDays(2);
                    $expiryDate = $newExpiryDate;
                }
                $this->showCancelButton = true;
            }

            $this->remainingDays = $expiryDate->diffInDays(Carbon::now());
        }
    }

    public function activateProgram()
    {
        if (!$this->stampCard) {
            $this->stampCard = ModSellerStampCard::create([
                'shop_id' => $this->shopId,
                'is_active' => true,
                'activated_at' => Carbon::now(),
                'is_renewed' => false,
                'discount' => 10, // Beispielrabatt
            ]);

            $this->loadProgramStatus(); // Lade den Status nach der Aktivierung
        }
    }

    public function cancelProgram()
    {
        if ($this->stampCard) {
            $this->stampCard->update([
                'is_active' => false,
                'is_renewed' => false,
            ]);

            $this->loadProgramStatus(); // Lade den Status nach der Stornierung
        }
    }

    public function extendProgram()
    {

        if ($this->stampCard && !$this->stampCard->is_renewed) {
            $activationDate = new Carbon($this->stampCard->activated_at);
            $expiryDate = $activationDate->copy()->addDays(90);
            $newExpiryDate = $expiryDate->copy()->addDays(2);

            $this->stampCard->update([
                'is_renewed' => true,
                'activated_at' => $activationDate, // Behalte das ursprüngliche Aktivierungsdatum
            ]);

            $this->loadProgramStatus(); // Lade den Status nach der Verlängerung
        }
    }

    public function render()
    {
        return view('livewire.backend.seller.marketing.stamp-card-component');
    }
}
