<?php

namespace App\Livewire\Backend\Admin\InvoiceSystem;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ModSysInvoices;
use Livewire\WithoutUrlPagination;

class InvoiceComponent extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search = '';
    public $filterStatus = '';
    public $perPage = 10;

    protected $queryString = [
        'search' => ['except' => ''],
        'filterStatus' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterStatus()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = ModSysInvoices::with('shop')
            ->when($this->search, function($query) {
                $query->whereHas('shop', function($query) {
                    $query->where('title', 'like', '%'.$this->search.'%')
                          ->orWhere('shop_nr', 'like', '%'.$this->search.'%');
                })
                ->orWhere('invoice_number', 'like', '%'.$this->search.'%');
            })
            ->when($this->filterStatus, function($query) {
                $query->where('payment_status', $this->filterStatus);
            })
            ->orderBy('invoice_number', 'desc');

        return view('livewire.backend.admin.invoice-system.invoice-component', [
            'invoices' => $query->paginate($this->perPage)
        ]);
    }

    public function togglePaymentStatus($invoiceId)
    {
        $invoice = ModSysInvoices::find($invoiceId);
        if ($invoice) {
            $invoice->payment_status = $invoice->payment_status === 'paid' ? 'open' : 'paid';
            $invoice->save();
        }
    }
}
