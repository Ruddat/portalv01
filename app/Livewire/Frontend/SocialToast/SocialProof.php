<?php

namespace App\Livewire\Frontend\SocialToast;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\ModOrders;

class SocialProof extends Component
{
    public $orders = [];
    public $showContainer = false;

    protected $listeners = ['fetchOrders', 'addNewOrder']; // Add listener for adding new order

    public function mount()
    {
        $this->fetchOrders();
    }

    public function fetchOrders()
    {
        // Fetch the latest three orders without caching lastOrder
        $newOrders = ModOrders::latest()->take(3)->get()->map(function ($order) {
            $orderData = json_decode($order->order_json_data, true);
            return [
                'name' => substr($orderData['OrderList']['Order']['Customer']['DeliveryAddress']['LastName'], 0, 2) . str_repeat('*', strlen($orderData['OrderList']['Order']['Customer']['DeliveryAddress']['LastName']) - 2) ?? 'Kunde',
                'product' => $orderData['OrderList']['Order']['ArticleList']['Article'][0]['ArticleName'] ?? 'Produkt',
                'created_at' => Carbon::parse($orderData['OrderList']['CreateDateTime'] ?? now())->diffForHumans()
            ];
        })->toArray();

        // Always update orders array with the latest fetched orders
        $this->orders = $newOrders;

        // Show the container only if there are orders to display
        $this->showContainer = !empty($newOrders);
    }

    public function addNewOrder($order)
    {
        // Add new order to the front of the orders array
        array_unshift($this->orders, $order);

        // Trim orders array to maximum 3 entries
        $this->orders = array_slice($this->orders, 0, 3);

        // Ensure container is shown after adding new order
        $this->showContainer = true;

        // Dispatch event to show new order
        $this->dispatch('showNewOrder', $order);
    }

    public function render()
    {
        return view('livewire.frontend.social-toast.social-proof', ['orders' => $this->orders]);
    }
}
