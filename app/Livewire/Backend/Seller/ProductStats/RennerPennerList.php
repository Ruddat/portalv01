<?php

namespace App\Livewire\Backend\Seller\ProductStats;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\ModProductSales;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class RennerPennerList extends Component
{
    public $timePeriod = 'day'; // Default Zeitperiode
    public $shopId; // Shop ID

    public function render()
    {
        // Unveränderte Abfrage für die Top-Produkte (Renner)
        $topProducts = ModProductSales::query()
                            ->where('shop_id', $this->shopId)
                            ->select('product_id', 'size', 'price', DB::raw('SUM(quantity) as total_quantity'))
                            ->groupBy('product_id', 'size', 'price')
                            ->orderBy('total_quantity', 'desc')
                            ->limit(10) // Anzahl der Top-Produkte verringern, um sicherzustellen, dass es Flop-Produkte gibt
                            ->get();

        // IDs der Top-Produkte sammeln
        $topProductIds = $topProducts->pluck('product_id')->unique(); // Doppelte IDs vermeiden

        // Flop-Produkte unabhängig abfragen
        $flopProductsQuery = ModProductSales::query()
                            ->where('shop_id', $this->shopId)
                            ->selectRaw('product_id, SUM(quantity) as total_quantity')
                            ->groupBy('product_id')
                            ->orderBy('total_quantity', 'asc')
                            ->limit(10);

        // Zeitperiode anwenden auf die Flop-Produkte (Penner)
        switch ($this->timePeriod) {
            case 'week':
                $flopProductsQuery->whereBetween('sale_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                break;
            case 'month':
                $flopProductsQuery->whereMonth('sale_date', Carbon::now()->month);
                break;
            case 'year':
                $flopProductsQuery->whereYear('sale_date', Carbon::now()->year);
                break;
            default:
                $flopProductsQuery->whereDate('sale_date', Carbon::now()->toDateString());
        }

        // Flop-Produkte ermitteln
        $flopProducts = $flopProductsQuery->get();

        // Debugging: Überprüfen, ob $flopProducts eine leere Sammlung ist
        if ($flopProducts->isEmpty()) {
            dd($flopProductsQuery->toSql(), $flopProductsQuery->getBindings());
        }

        return View::make('livewire.backend.seller.product-stats.renner-penner-list', [
            'topProducts' => $topProducts,
            'flopProducts' => $flopProducts,
        ]);
    }

    public function setTimePeriod($period)
    {
        $this->timePeriod = $period;
    }
}
