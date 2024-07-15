<?php

namespace App\Livewire\Backend\Admin\InvoiceSystem;

use Livewire\Component;
use App\Models\ModSysInvoices;

class InvoiceComponent extends Component
{
    public $invoices;

    public function mount()
    {
        $this->loadInvoices();
    }

    public function loadInvoices()
    {
        $this->invoices = ModSysInvoices::with('shop')->orderBy('generated_at', 'desc')->get();
    }

    public function togglePaymentStatus($invoiceId)
    {
        $invoice = ModSysInvoices::find($invoiceId);
        if ($invoice) {
            $invoice->payment_status = $invoice->payment_status === 'paid' ? 'open' : 'paid';
            $invoice->save();
            $this->loadInvoices(); // Reload invoices to reflect the change
        }
    }

    public function render()
    {
        return view('livewire.backend.admin.invoice-system.invoice-component');
    }
}
