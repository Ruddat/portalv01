<?php

namespace App\Livewire\Backend\Seller\InvoiceManagement;

use Livewire\Component;
use App\Models\ModSysInvoices;

class ShowInvoices extends Component
{
    public $shopId;

    public function mount($shopId)
    {
        $this->shopId = $shopId;
    }

    public function render()
    {
        // Abrufen der aktuellen Rechnungen für die gegebene shop_id
        $invoices = ModSysInvoices::where('shop_id', $this->shopId)->orderBy('created_at', 'desc')->get();

        return view('livewire.backend.seller.invoice-management.show-invoices', [
            'invoices' => $invoices
        ]);
    }
}
