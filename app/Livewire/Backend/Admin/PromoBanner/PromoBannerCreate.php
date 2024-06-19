<?php

namespace App\Livewire\Backend\Admin\PromoBanner;

use Livewire\Component;
use App\Models\AdminPromoBanner;
use Carbon\Carbon;

class PromoBannerCreate extends Component
{

    public $title, $description, $icon, $coupon_code, $start_time, $end_time;



    public function create()
    {
        dd('PromoBannerCreate');
    }









    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'icon' => 'required|string',
        'coupon_code' => 'nullable|string',
        'start_time' => 'required|date',
        'end_time' => 'required|date|after:start_time',
    ];

    public function submit()
    {
        $this->validate();

        AdminPromoBanner::create([
            'title' => $this->title,
            'description' => $this->description,
            'icon' => $this->icon,
            'coupon_code' => $this->coupon_code,
            'start_time' => Carbon::parse($this->start_time),
            'end_time' => Carbon::parse($this->end_time),
        ]);

        return redirect()->route('promo-banner-index');
    }

    public function render()
    {
        return view('livewire.backend.admin.promo-banner.promo-banner-create')
        ->layout('layouts.app'); // Hier spezifizieren wir das Layout
    }
}
