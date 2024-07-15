<?php

namespace App\Livewire\Backend\Admin\InvoiceSystem;

use Livewire\Component;
use App\Models\ModOrders;
use Livewire\WithPagination;
use App\Models\ModSysStornos;

class StornoManagerComponent extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'order_date';
    public $sortDirection = 'asc';
    public $refundAmount;
    public $refundReason;
    public $orderId;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'order_date'],
        'sortDirection' => ['except' => 'asc'],
    ];

    public function render()
    {
        $perPage = $this->search ? 1000 : 10;  // Set a high number for pagination if search is active, otherwise default to 10

        $orders = ModOrders::query()
            ->leftJoin('mod_sys_stornos', 'mod_orders.id', '=', 'mod_sys_stornos.order_id')
            ->where(function($query) {
                $query->where('mod_orders.order_nr', 'like', '%'.$this->search.'%')
                      ->orWhere('mod_orders.name', 'like', '%'.$this->search.'%')
                      ->orWhere('mod_orders.surname', 'like', '%'.$this->search.'%')
                      ->orWhere('mod_orders.payment_type', 'like', '%'.$this->search.'%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($perPage, [
                'mod_orders.*',
                'mod_sys_stornos.refund_amount as storno_refund_amount',
                'mod_sys_stornos.refund_reason as storno_refund_reason',
                'mod_sys_stornos.included_in_invoice as storno_included_in_invoice'
            ]);

        return view('livewire.backend.admin.invoice-system.storno-manager-component', [
            'orders' => $orders,
        ]);
    }


    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function setOrder($orderId)
    {
        $order = ModOrders::where('id', $orderId)->first();

        if ($order) {
            $storno = ModSysStornos::where('order_id', $orderId)->first();

            if ($storno && $storno->included_in_invoice) {
                session()->flash('message', 'Dieser Storno wurde bereits in einer Abrechnung berücksichtigt und kann nicht geändert werden.');
                return;
            }

            if ($storno) {
                $this->refundAmount = $storno->refund_amount;
                $this->refundReason = $storno->refund_reason;
            } else {
                $this->refundAmount = null;
                $this->refundReason = null;
            }

            $this->orderId = $orderId;
            $this->scrollToForm();
        } else {
            session()->flash('message', 'Bestellung nicht gefunden.');
        }
    }

    public function scrollToForm()
    {
        $this->dispatch('scroll-to-form');
    }

    public function processRefund()
    {
        $this->validate([
            'refundAmount' => 'required|numeric',
            'refundReason' => 'required|string|max:255',
            'orderId' => 'required|exists:mod_orders,id',
        ]);

        $storno = ModSysStornos::updateOrCreate(
            ['order_id' => $this->orderId],
            [
                'refund_amount' => $this->refundAmount,
                'refund_reason' => $this->refundReason,
                'included_in_invoice' => false,
            ]
        );

        session()->flash('message', 'Storno erfolgreich verarbeitet.');
        $this->reset(['refundAmount', 'refundReason', 'orderId']);
    }

    public function cancelRefund()
    {
        $this->reset(['refundAmount', 'refundReason', 'orderId']);
    }
}
