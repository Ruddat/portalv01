<?php

namespace App\Livewire\Backend\Admin\PromoBanner;

use Livewire\Component;

class PromoBannerEdit extends Component
{


    public $promoBanner;
    public $title, $description, $icon, $coupon_code, $start_time, $end_time;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'icon' => 'required|string',
        'coupon_code' => 'nullable|string',
        'start_time' => 'required|date',
        'end_time' => 'required|date|after:start_time',
    ];

    public function mount(PromoBanner $promoBanner)
    {
        $this->promoBanner = $promoBanner;
        $this->title = $promoBanner->title;
        $this->description = $promoBanner->description;
        $this->icon = $promoBanner->icon;
        $this->coupon_code = $promoBanner->coupon_code;
        $this->start_time = Carbon::parse($promoBanner->start_time)->format('Y-m-d\TH:i');
        $this->end_time = Carbon::parse($promoBanner->end_time)->format('Y-m-d\TH:i');
    }

    public function submit()
    {
        $this->validate();

        $this->promoBanner->update([
            'title' => $this->title,
            'description' => $this->description,
            'icon' => $this->icon,
            'coupon_code' => $this->coupon_code,
            'start_time' => Carbon::parse($this->start_time),
            'end_time' => Carbon::parse($this->end_time),
        ]);

        return redirect()->route('admin.promo-banners.index');
    }


    public function render()
    {
        return view('livewire.backend.admin.promo-banner.promo-banner-edit')
        ->layout('components.layouts.app');

    }
}
