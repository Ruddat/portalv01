<?php

namespace App\Livewire\Backend\Admin\Manager;

use App\Models\ModShop;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\CopyShopService;


class ShopManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $status = [];
    public $onlineStatus = [];
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    public $selectedShopId;
    public $copyOptions = [
        'shopData' => true,
        'openingHours' => true,
        'deliveryArea' => true,
        'categories' => true,
        'sizesandprices' => true,
        'ingredients' => true,
        'products' => true,
        'orders' => false,
        'votings' => false,
    ];

    public $shopToDelete;

    protected $paginationTheme = 'bootstrap';
    protected $CopyShopService;

    protected $listeners = ['copyShopConfirmed'];



    public function boot(CopyShopService $CopyShopService)
    {
        $this->CopyShopService = $CopyShopService;
    }


    public function updatingSearch()
    {
        $this->resetPage();
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

    public function mount(CopyShopService $copyShopService)
    {
        $this->copyShopService = $copyShopService;

        $this->status = ModShop::pluck('status', 'id')->toArray();
        $this->onlineStatus = ModShop::pluck('published', 'id')->toArray();

    }

    public function changeStatus($shopId)
    {
        $shop = ModShop::find($shopId);
        if ($shop) {
            $shop->status = $this->status[$shopId];
            $shop->save();
        }
    }

    public function toggleOnline($shopId)
    {
        $shop = ModShop::find($shopId);
        if ($shop) {
            $shop->published = !$shop->published;
            $shop->save();
            $this->onlineStatus[$shopId] = $shop->published;
        }
    }

    public function openCopyModal($shopId)
    {
        $this->selectedShopId = $shopId;
        $this->dispatch('openCopyModal');
    }


    public function copyShopConfirmed()
    {
   //  dd($this->selectedShopId, $this->copyOptions);

        try {
            $this->CopyShopService->copyShop($this->selectedShopId, $this->copyOptions);
            $this->loadData(); // Annahme: Methode loadData() lädt die Daten neu

            $this->dispatch('toast', message: 'Shop successfully copied.', notify:'success' );
           // $this->dispatch('closeCopyModal');

        } catch (\Exception $e) {
            $this->dispatch('toast', message: 'Failed to copy shop: ' . $e->getMessage(), notify:'error' );
        }
    }


    public function loadData()
    {
        $this->status = ModShop::pluck('status', 'id')->toArray();
        $this->onlineStatus = ModShop::pluck('published', 'id')->toArray();
        // Weitere Daten laden, falls nötig
    }


    public function confirmDeletion($shopId)
    {
        $this->shopToDelete = $shopId;
        $this->dispatch('openDeleteConfirmationModal');
    }

    public function deleteShopConfirmed()
    {
        ModShop::findOrFail($this->shopToDelete)->delete();
        $this->shopToDelete = null;
        $this->loadData(); // Annahme: Methode loadData() lädt die Daten neu
        $this->dispatch('toast', message: 'Shop erfolgreich gelöscht.', notify:'success' );
        $this->dispatch('closeDeleteConfirmationModal');
    }



    public function render()
    {
        $shops = ModShop::query()
            ->where('shop_nr', 'like', '%' . $this->search . '%')
            ->orWhere('title', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.backend.admin.manager.shop-management', [
            'shops' => $shops,
        ]);
    }
}
