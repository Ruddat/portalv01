<?php

// In der Livewire-Komponente SocialProof.php

namespace App\Livewire\Frontend\SocialToast;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\ModOrders;

class SocialProof extends Component
{
    public $orders;

    public function mount()
    {
        $this->fetchOrders();
    }

    public function fetchOrders()
    {
        $orders = ModOrders::latest()->take(1)->get();

        $this->orders = $orders->map(function ($order) {
            $orderData = json_decode($order->order_json_data, true);
            return [
                'name' => substr($orderData['OrderList']['Order']['Customer']['DeliveryAddress']['LastName'], 0, 2) . str_repeat('*', strlen($orderData['OrderList']['Order']['Customer']['DeliveryAddress']['LastName']) - 2) ?? 'Kunde',
                'product' => $orderData['OrderList']['Order']['ArticleList']['Article'][0]['ArticleName'] ?? 'Produkt', // Fallback-Wert
                'created_at' => $orderData['OrderList']['CreateDateTime'] ?? Carbon::now()->toISOString() // Fallback-Wert im ISO-Format
            ];
        });

//dd($this->orders->toArray()); // Debug-Ausgabe (1)


        $this->dispatch('ordersFetched', $this->orders->toArray()); // Emitiere das Event mit den abgerufenen Bestellungen als Array
    }

    public function render()
    {
        return view('livewire.frontend.social-toast.social-proof');
    }
}

