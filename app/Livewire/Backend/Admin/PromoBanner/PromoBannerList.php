<?php

namespace App\Livewire\Backend\Admin\PromoBanner;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\AdminPromoBanner as AdminPromoBanner;

class PromoBannerList extends Component
{
    public $currentBanner;

    public function mount()
    {
        $this->rotateBanner();
    }

    public function rotateBanner()
    {
        $now = Carbon::now();
        $banners = AdminPromoBanner::where('start_time', '<=', $now)
            ->where('end_time', '>=', $now)
            ->get();

        if ($banners->isNotEmpty()) {
            $this->currentBanner = $banners->random();
        }
    }

    public function render()
    {
        return view('livewire.backend.admin.promo-banner.promo-banner-list');
    }
}
