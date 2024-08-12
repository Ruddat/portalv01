<?php

namespace App\Livewire\Backend\Seller\ProductStats;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\ModProducts;
use App\Models\ModSellerShops;
use App\Models\ModProductSales;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class DashboardRennerPennerList extends Component
{
    public $sellerId;
    public $timePeriod = 'day';
    public $selectedShopId = null; // Filter nach Shop-ID

    public function mount()
    {
        if (Auth::guard('seller')->check()) {
            $this->sellerId = Auth::guard('seller')->user()->id;
        }
    }

    public function render()
    {
        if (!$this->sellerId) {
            return view('livewire.backend.seller.product-stats.no-seller');
        }

        // Abrufen der Shop-IDs des Sellers
        $shopIds = ModSellerShops::where('seller_id', $this->sellerId)
                                 ->pluck('mod_shop_id')
                                 ->toArray();

        if (empty($shopIds)) {
            return view('livewire.backend.seller.product-stats.no-shops');
        }

        // Filter nach ausgewählter Shop-ID anwenden
        $filteredShopIds = $this->selectedShopId ? [$this->selectedShopId] : $shopIds;

        $topProducts = collect();
        $flopProducts = collect();

        foreach ($filteredShopIds as $shopId) {
            $baseQuery = ModProductSales::query()
                        ->where('shop_id', $shopId);

            switch ($this->timePeriod) {
                case 'week':
                    $baseQuery->whereBetween('sale_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                    break;
                case 'month':
                    $baseQuery->whereMonth('sale_date', Carbon::now()->month);
                    break;
                case 'year':
                    $baseQuery->whereYear('sale_date', Carbon::now()->year);
                    break;
                default:
                    $baseQuery->whereDate('sale_date', Carbon::now()->toDateString());
            }

            $topProductsForShop = $baseQuery->clone()
                                            ->select('product_id', DB::raw('SUM(quantity) as total_quantity'))
                                            ->groupBy('product_id')
                                            ->orderBy('total_quantity', 'desc')
                                            ->limit(10)
                                            ->get()
                                            ->map(function ($product) use ($shopId) {
                                                $product->shop_id = $shopId;
                                                $product->shop_name = DB::table('mod_shops')->where('id', $shopId)->value('title');
                                                $product->product_name = ModProducts::find($product->product_id)->product_title ?? 'Unbekanntes Produkt';
                                                return $product;
                                            });

            $flopProductsForShop = $baseQuery->clone()
                                             ->select('product_id', DB::raw('SUM(quantity) as total_quantity'))
                                             ->groupBy('product_id')
                                             ->orderBy('total_quantity', 'asc')
                                             ->limit(10)
                                             ->get()
                                             ->map(function ($product) use ($shopId) {
                                                 $product->shop_id = $shopId;
                                                 $product->shop_name = DB::table('mod_shops')->where('id', $shopId)->value('title');
                                                 $product->product_name = ModProducts::find($product->product_id)->product_title ?? 'Unbekanntes Produkt';
                                                 return $product;
                                             });

            $topProducts = $topProducts->concat($topProductsForShop);
            $flopProducts = $flopProducts->concat($flopProductsForShop);
        }

        $topProducts = $topProducts->groupBy('product_id')
                                   ->map(function ($products) {
                                       return $products->sortByDesc('total_quantity')->first();
                                   })
                                   ->sortByDesc('total_quantity')
                                   ->take(10);

        $flopProducts = $flopProducts->groupBy('product_id')
                                     ->map(function ($products) {
                                         return $products->sortBy('total_quantity')->first();
                                     })
                                     ->sortBy('total_quantity')
                                     ->take(10);

        // Abrufen der Shop-Namen für den Dropdown
        $shops = ModSellerShops::where('seller_id', $this->sellerId)
                               ->join('mod_shops', 'mod_seller_shops.mod_shop_id', '=', 'mod_shops.id')
                               ->pluck('title', 'mod_shop_id');

        return View::make('livewire.backend.seller.product-stats.dashboard-renner-penner-list', [
            'topProducts' => $topProducts,
            'flopProducts' => $flopProducts,
            'shops' => $shops,
        ]);
    }

    public function setTimePeriod($period)
    {
        $this->timePeriod = $period;
    }

    public function setShop($shopId)
    {
        $this->selectedShopId = $shopId;
    }
}
