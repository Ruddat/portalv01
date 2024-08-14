<?php

namespace App\Livewire\Backend\Seller\PosSystem;

use Livewire\Component;
use App\Models\ModOrders;

class LiveOrderConnect extends Component
{
    public $ordersIn;
    public $ordersPrepared;
    public $ordersDelivered;
    public $newOrder = null;
    public $activeTab = 'ordersIn'; // Default Tab

    protected $listeners = ['orderUpdated' => 'refreshOrders'];

    public function mount()
    {
        $this->refreshOrders();
        $this->checkForNewOrders();

    }

    public function refreshOrders()
    {
        $this->ordersIn = ModOrders::where('order_tracking_status', 1) // Assuming 0 is 'in'
            ->whereDate('created_at', today())
            ->orderBy('created_at', 'asc')
            ->get();

        $this->ordersPrepared = ModOrders::where('order_tracking_status', 2) // Assuming 1 is 'prepared'
            ->whereDate('created_at', today())
            ->orderBy('created_at', 'desc')
            ->get();

        $this->ordersDelivered = ModOrders::where('order_tracking_status', 3) // Assuming 2 is 'delivered'
            ->whereDate('created_at', today())
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function moveToPrepared($orderId)
    {
        $order = ModOrders::find($orderId);
        if ($order) {
            $order->order_tracking_status = 2; // Mark as 'prepared'
            $order->save();
            $this->refreshOrders();
            $this->activeTab = 'ordersPrepared'; // Change to Prepared tab
        }
    }

    public function moveToDelivered($orderId)
    {
        $order = ModOrders::find($orderId);
        if ($order) {
            $order->order_tracking_status = 3; // Mark as 'delivered'
            $order->save();
            $this->refreshOrders();
            $this->activeTab = 'ordersDelivered'; // Change to Delivered tab
        }
    }

    public function setActiveTab($tabName)
    {
        $this->activeTab = $tabName;
    }


    public function checkForNewOrders()
    {
        $this->newOrder = ModOrders::where('order_tracking_status', 999999) // Assuming 0 is 'in'
            ->whereDate('created_at', today())
            ->orderBy('created_at', 'desc')
            ->first(); // Holt die erste neue Bestellung
//dd($this->newOrder);

        if ($this->newOrder) {
            $this->dispatch('playAudio');
        }
    }

public function setDeliveryTime($minutes)
{
    if ($this->newOrder) {
        $this->newOrder->deliver_minutes = $minutes;
        $this->newOrder->save();
    }
}

public function confirmOrder()
{
    if ($this->newOrder) {
        $this->newOrder->order_tracking_status = 1; // Status auf 'prepared' setzen
        $this->newOrder->save();

        $this->refreshOrders();
        $this->checkForNewOrders(); // nächste Bestellung laden
    }
}

public function skipOrder()
{
    $this->newOrder = null;
    $this->checkForNewOrders();
}


public function render()
{
    return view('livewire.backend.seller.pos-system.live-order-connect', [
        'ordersIn' => $this->ordersIn,
        'ordersPrepared' => $this->ordersPrepared,
        'ordersDelivered' => $this->ordersDelivered,
        'activeTab' => $this->activeTab,
        'newOrder' => $this->newOrder, // Neue Bestellung an die Ansicht übergeben
    ]);
}

}
