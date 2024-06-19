<?php

namespace App\Livewire\Backend\Admin\PromoBanner;

use Livewire\Component;
use App\Models\AdminPromoBanner;
use Carbon\Carbon;

class PromoBannerIndex extends Component
{
    public $banners;
    public $title, $description, $icon, $coupon_code, $start_time, $end_time, $banner_color;
    public $editMode = false;
    public $createMode = false;
    public $editBannerId;
    public $is_active = false;

    public $icons = [
        'icon-food_icon_cake_2', 'icon-food_icon_fish', 'icon-food_icon_chicken',
        'icon-food_icon_bread_2', 'icon-food_icon_coffee', 'icon-food_icon_dish',
        'icon-food_icon_cloche', 'icon-food_icon_glass', 'icon-food_icon_fish_2',
        'icon-food_icon_hair', 'icon-food_icon_cake_3', 'icon-food_icon_burgher',
        'icon-food_icon_beer', 'icon-food_icon_burrito', 'icon-clock_2',
        'icon-food_icon_pizza', 'icon-user_2', 'icon-food_icon_chinese',
        'icon-food_icon_vegetarian', 'icon-food_icon_chili', 'icon-food_icon_sushi',
        'icon-food_icon_delivery', 'icon-food_icon_shop', 'icon-food_icon_highlight'
    ];


    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'icon' => 'required|string',
        'coupon_code' => 'nullable|string',
        'banner_color' => 'nullable|string',
        'start_time' => 'required|date',
        'end_time' => 'required|date|after:start_time',
    ];

    public function mount()
    {
        $this->banners = AdminPromoBanner::all()->map(function($banner) {
            $banner->isExpired = $this->isBannerExpired($banner->end_time);
            return $banner;
        });
    }

    public function render()
    {
        return view('livewire.backend.admin.promo-banner.promo-banner-index');

        //    ->layout('components.layouts.app');
    }

    public function delete($id)
    {
        // Banner löschen
        AdminPromoBanner::find($id)->delete();
        // Daten neu laden
        $this->banners = AdminPromoBanner::all();
    }

    public function edit($id)
    {
        // Banner-Daten laden und den Edit-Modus aktivieren
        $banner = AdminPromoBanner::find($id);
        if ($banner) {
            $this->editMode = true;
            $this->editBannerId = $banner->id;
            $this->title = $banner->title;
            $this->description = $banner->description;
            $this->icon = $banner->icon;
            $this->coupon_code = $banner->coupon_code;
            $this->start_time = Carbon::parse($banner->start_time)->format('Y-m-d\TH:i');
            $this->end_time = Carbon::parse($banner->end_time)->format('Y-m-d\TH:i');
            $this->banner_color = $banner->banner_color;
        }
    }

    public function create()
    {
        $this->resetForm();
        $this->createMode = true;
        $this->editMode = false;
    }

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
            'banner_color' => $this->banner_color,
        ]);

        // Formularfelder leeren und den Edit-Modus beenden
        $this->reset(['title', 'description', 'icon', 'coupon_code', 'start_time', 'end_time', 'editMode', 'editBannerId', 'banner_color']);

        // Daten neu laden
        $this->loadData();
    }

    public function loadData()
    {
        $this->banners = AdminPromoBanner::all();
    }


    public function update()
    {


        $this->validate();

        $banner = AdminPromoBanner::find($this->editBannerId);
        if ($banner) {
            $banner->update([
                'title' => $this->title,
                'description' => $this->description,
                'icon' => $this->icon,
                'coupon_code' => $this->coupon_code,
                'start_time' => Carbon::parse($this->start_time),
                'end_time' => Carbon::parse($this->end_time),
                'banner_color' => $this->banner_color,
            ]);

            // Formularfelder leeren und den Edit-Modus beenden
            $this->reset(['title', 'description', 'icon', 'coupon_code', 'start_time', 'end_time', 'editMode', 'editBannerId', 'banner_color']);

            // Daten neu laden
            $this->banners = AdminPromoBanner::all();
        }
    }

    public function cancelEdit()
    {
        $this->resetForm();
        $this->createMode = false;
        $this->editMode = false;
    }

    public function generateCouponCode()
    {
        // Generiere einen zufälligen Coupon-Code
        $this->coupon_code = strtoupper(substr(md5(rand()), 0, 8));
    }

    private function resetForm()
    {
        $this->reset(['title', 'description', 'icon', 'coupon_code', 'start_time', 'end_time', 'banner_color', 'editBannerId']);
    }

    public function isBannerExpired($end_time)
    {

        return Carbon::now()->greaterThan($end_time);
    }



}
