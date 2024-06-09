<?php

namespace App\Livewire\Frontend\SocialToast;


use Carbon\Carbon;
use Livewire\Component;
use App\Models\ModOrders;

class SocialProof extends Component
{
    public $orders = [];
    public $showContainer = false;
    public $lastOrder = null;

    protected $listeners = ['fetchOrders'];

    public function mount()
    {
        $this->fetchOrders();
    }

    public function fetchOrders()
    {
        // Fetch the latest three orders
        $newOrders = ModOrders::latest()->take(1)->get()->map(function ($order) {
            $orderData = json_decode($order->order_json_data, true);
            return [
                'name' => substr($orderData['OrderList']['Order']['Customer']['DeliveryAddress']['LastName'], 0, 2) . str_repeat('*', strlen($orderData['OrderList']['Order']['Customer']['DeliveryAddress']['LastName']) - 2) ?? 'Kunde',
                'product' => $orderData['OrderList']['Order']['ArticleList']['Article'][0]['ArticleName'] ?? 'Produkt',
                'created_at' => Carbon::parse($orderData['OrderList']['CreateDateTime'] ?? now())->diffForHumans()
            ];
        })->toArray();

        // Debugging output
        \Log::info('Fetched new orders:', ['orders' => $newOrders]);
        \Log::info('Last order:', ['order' => $this->lastOrder]);

        if (!empty($newOrders) && $this->isNewOrder($newOrders[0])) {
            $this->orders = $newOrders;
            $this->showContainer = true;
            $this->lastOrder = $newOrders[0]; // Set the lastOrder property
        } else {
            // Fetch random orders if no new orders are found
            $randomOrders = ModOrders::inRandomOrder()->take(1)->get()->map(function ($order) {
                $orderData = json_decode($order->order_json_data, true);
                return [
                    'name' => substr($orderData['OrderList']['Order']['Customer']['DeliveryAddress']['LastName'], 0, 2) . str_repeat('*', strlen($orderData['OrderList']['Order']['Customer']['DeliveryAddress']['LastName']) - 2) ?? 'Kunde',
                    'product' => $orderData['OrderList']['Order']['ArticleList']['Article'][0]['ArticleName'] ?? 'Produkt',
                    'created_at' => Carbon::parse($orderData['OrderList']['CreateDateTime'] ?? now())->diffForHumans()
                ];
            })->toArray();

            if (!empty($randomOrders)) {
                $this->orders = $randomOrders;
                $this->showContainer = true;
            } else {
                $this->orders = [];
                $this->showContainer = false;
            }
        }

        // Only dispatch events if there are orders to show
        if ($this->showContainer) {
            $this->dispatch('showContainer', ['orders' => $this->orders]);
        } else {
            $this->dispatch('hideContainer');
        }
    }


    private function isNewOrder($newOrder)
    {
        if ($this->lastOrder === null) {
            return true;
        }

        // Debugging output
        \Log::info('Comparing created_at of new order and last order:');
        \Log::info('New order created_at:', ['created_at' => $newOrder['created_at']]);
        \Log::info('Last order created_at:', ['created_at' => $this->lastOrder['created_at']]);

        // Compare the orders by their 'created_at' timestamps
        return $newOrder['created_at'] !== $this->lastOrder['created_at'];
    }

    public function render()
    {
        return view('livewire.frontend.social-toast.social-proof', ['orders' => $this->orders]);
    }
    }
