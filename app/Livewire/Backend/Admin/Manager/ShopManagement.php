<?php

namespace App\Livewire\Backend\Admin\Manager;

use App\Models\ModShop;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ModSellerShops;
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

    public $sellerShops;


public $title;

    public $selectedShopId;
    public $shop;  // This will hold the shop details being edited
    public $copyOptions = [
        'shopData' => true,
        'logo' => true,
        'articles' => true,
        'openingHours' => true,
        'deliveryArea' => true,
        'orders' => false,
        'votes' => false,
    ];

    public $shopToDelete;

    protected $paginationTheme = 'bootstrap';
    protected $CopyShopService;

    protected $listeners = ['copyShopConfirmed'];


    protected $rules = [
        'shop.title' => 'required|string|max:255',
        'shop.street' => 'required|string|max:255',
        'shop.street_nr' => 'required|string|max:255',
        'shop.city' => 'required|string|max:255',
        'shop.zip' => 'required|string|max:10',
        'shop.email' => 'required|email|max:255',
        'shop.show_logo' => 'boolean',
        'shop.allow_ratings' => 'boolean',
        'shop.no_pickup' => 'boolean',
        'shop.is_active' => 'boolean',
        'shop.status' => 'required|string|max:10',
        'shop.customer_number' => 'string|max:255',
        'shop.monthly_fee' => 'numeric',
        'shop.sales_percentage' => 'numeric',
        'shop.per_order_fee' => 'numeric',
        'shop.sms_fee' => 'numeric',
        'shop.setup_fee' => 'numeric',
        'shop.order_email' => 'email|max:255',
        'shop.sms_number' => 'string|max:20',
        'shop.seller_shop' => 'required|integer|exists:seller_shops,id',
    ];


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

        $this->sellerShops = ModSellerShops::all(); // Assuming you have a SellerShop model to fetch seller shops

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

    public function openEditModal($shopId)
    {
        $this->shop = ModShop::find($shopId);
        $this->shopId = $shopId; // Optional, falls Sie die shopId in der Komponente benötigen

        // Hier können Sie zusätzliche Logik ausführen, um das Modal zu öffnen oder weitere Aktionen durchzuführen
        $this->dispatch('openEditModal'); // Event auslösen, um das Modal zu öffnen (optional)
    }

    public function copyShopConfirmed()
    {
        try {
            $this->CopyShopService->copyShop($this->selectedShopId, $this->copyOptions);
            $this->loadData();
            $this->dispatch('toast', ['message' => 'Shop successfully copied.', 'notify' => 'success']);
        } catch (\Exception $e) {
            $this->dispatch('toast', ['message' => 'Failed to copy shop: ' . $e->getMessage(), 'notify' => 'error']);
        }
    }

    public function updateShop()
    {
        $shop = ModShop::find($this->selectedShopId);
        if ($shop) {
            $shop->update($this->shop->toArray());
            $this->loadData();
            $this->dispatch('toast', ['message' => 'Shop successfully updated.', 'notify' => 'success']);
            $this->dispatch('closeEditModal');
        }
    }

    public function loadData()
    {
        $this->status = ModShop::pluck('status', 'id')->toArray();
        $this->onlineStatus = ModShop::pluck('published', 'id')->toArray();
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
        $this->loadData();
        $this->dispatch('toast', ['message' => 'Shop erfolgreich gelöscht.', 'notify' => 'success']);
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
