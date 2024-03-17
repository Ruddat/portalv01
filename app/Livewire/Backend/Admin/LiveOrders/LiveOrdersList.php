<?php

namespace App\Livewire\Backend\Admin\LiveOrders;

use Livewire\Component;
use App\Models\ModOrders;
use Livewire\WithPagination;


class LiveOrdersList extends Component
{
    use WithPagination;

    public $search = '';
    public $sortOption = 'recently'; // Standard-Sortierung


    public function loadOrders()
    {
        // Holen der Bestellungen unter Berücksichtigung des Suchbegriffs und der Sortieroption
        $query = ModOrders::select(
            'id', 'order_nr', 'parent', 'shop_name', 'hash', 'gender', 'name', 'surname', 'company',
            'department', 'email', 'phone', 'shipping_zip_id', 'shipping_street',
            'shipping_house_no', 'shipping_zip', 'shipping_city', 'shipping_state',
            'shipping_country_code', 'shipping_comment', 'delivery_time', 'shipping_type',
            'order_comment', 'payment_type', 'price_products', 'price_bottles',
            'price_shipping', 'price_payment', 'price_tips', 'coupon_discount',
            'eshop_discount', 'price_total', 'use_system_payment', 'soap_status',
            'transfer_type', 'transfer_by_email', 'transfer_time',
            'subscribe_news', 'save_data', 'published', 'money_returned', 'user_id',
            'stickers_delivery_checked', 'cart_in_session', 'delivery_time_left',
            'global_coupon_id', 'coupon_code', 'rand_id', 'user_status', 'order_date',
            'order_tracking_status', 'deliver_eta', 'deliver_minutes', 'created_at',
            'updated_at'
        );

        // Überprüfen, ob ein Suchbegriff vorhanden ist
        if ($this->search !== '') {
            $query->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('shop_name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%')
                      ->orWhere('order_nr', 'like', '%' . $this->search . '%');
            });
        }

        // Überprüfen, welche Sortieroption ausgewählt wurde
        switch ($this->sortOption) {
            case 'recently':
                $query->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'newest':
                $query->orderBy('id', 'desc'); // Je nach Datenbankkonfiguration anpassen
                break;
            default:
                $query->orderBy('created_at', 'desc'); // Standard-Sortierung
                break;
        }

        // Bestellungen paginieren und laden
        $this->orders = $query->paginate(10);
    }


    public function refreshOrders()
    {
        $this->loadOrders();
    }

    public function changeSortOption($option)
    {
        $this->sortOption = $option;
        $this->loadOrders(); // Lade die Bestellungen basierend auf der neuen Sortieroption
    }

    public function resetSearch()
    {
        if ($this->search !== '') {
            $this->search = '';
            $this->loadOrders();
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getStatusLabel($status)
    {
        switch ($status) {
            case 999999:
                return ['status' => 'New (Created)', 'color' => 'primary'];
            case 1:
                return ['status' => 'Ready to Send', 'color' => 'success'];
            case 2:
                return ['status' => 'Restaurant Received', 'color' => 'warning'];
            case 3:
                return ['status' => 'Baking', 'color' => 'info'];
            case 4:
                return ['status' => 'Delivering', 'color' => 'info'];
            case 5:
                return ['status' => 'Boxing (Packing)', 'color' => 'info'];
            case 6:
                return ['status' => 'Delivered (Done)', 'color' => 'success'];
            case 7:
                return ['status' => 'Canceled by Restaurant', 'color' => 'danger'];
            case 500:
                return ['status' => 'Canceled', 'color' => 'danger'];
            default:
                return ['status' => 'Unknown', 'color' => 'secondary'];
        }
    }

    public function render()
    {
        $this->loadOrders();

        return view('livewire.backend.admin.live-orders.live-orders-list', [
            'orders' => $this->orders,
            'pagination_theme' => 'bootstrap-5',
        ]);
    }
}
