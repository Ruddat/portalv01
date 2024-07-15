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
            try {
                $orderData = json_decode($order->order_json_data, true);

                // Überprüfen, ob die notwendigen Schlüssel vorhanden sind
                if (!isset($orderData['OrderList']['Order']['Customer']['DeliveryAddress']['LastName']) ||
                    !isset($orderData['OrderList']['Order']['ArticleList']['Article'][0]['ArticleName']) ||
                    !isset($orderData['OrderList']['CreateDateTime'])) {
                    throw new \Exception('Missing keys in order JSON');
                }

                $name = substr($orderData['OrderList']['Order']['Customer']['DeliveryAddress']['LastName'], 0, 2) . str_repeat('*', strlen($orderData['OrderList']['Order']['Customer']['DeliveryAddress']['LastName']) - 2) ?? 'Kunde';
                $product = $orderData['OrderList']['Order']['ArticleList']['Article'][0]['ArticleName'] ?? 'Produkt';
                $createdAt = Carbon::parse($orderData['OrderList']['CreateDateTime'] ?? now())->diffForHumans();

                return [
                    'name' => $name,
                    'product' => $product,
                    'created_at' => $createdAt,
                ];
            } catch (\Exception $e) {
                // Fehlerhafte JSON-Daten überspringen
                return null;
            }
        })->filter()->toArray(); // Filtert null-Werte heraus

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
