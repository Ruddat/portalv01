<?php

namespace App\Livewire\Backend\Admin\Marketing;

use Livewire\Component;
use App\Models\ModAdminMarketingSetting;

class MarketingSettings extends Component
{
    public $settings;
    public $duration;
    public $discount_percentage;
    public $validity_days;
    public $usage_limit;
    public $editSettingId = null;
    public $showForm = false;

    public function mount()
    {
        $this->settings = ModAdminMarketingSetting::all();
    }

    public function addOrUpdateSetting()
    {
        $this->validate([
            'duration' => 'required|integer',
            'discount_percentage' => 'required|numeric|between:0,100',
            'validity_days' => 'required|integer',
            'usage_limit' => 'required|integer',
        ]);

        if ($this->editSettingId) {
            $setting = ModAdminMarketingSetting::find($this->editSettingId);
            $setting->update([
                'duration' => $this->duration,
                'discount_percentage' => $this->discount_percentage,
                'validity_days' => $this->validity_days,
                'usage_limit' => $this->usage_limit,
            ]);
        } else {
            ModAdminMarketingSetting::create([
                'duration' => $this->duration,
                'discount_percentage' => $this->discount_percentage,
                'validity_days' => $this->validity_days,
                'usage_limit' => $this->usage_limit,
            ]);
        }

        $this->reset(['duration', 'discount_percentage', 'validity_days', 'usage_limit', 'editSettingId', 'showForm']);
        $this->settings = ModAdminMarketingSetting::all();
    }

    public function editSetting($id)
    {
        $setting = ModAdminMarketingSetting::find($id);
        $this->editSettingId = $setting->id;
        $this->duration = $setting->duration;
        $this->discount_percentage = $setting->discount_percentage;
        $this->validity_days = $setting->validity_days;
        $this->usage_limit = $setting->usage_limit;
        $this->showForm = true;
    }

    public function deleteSetting($id)
    {
        ModAdminMarketingSetting::find($id)->delete();
        $this->settings = ModAdminMarketingSetting::all();
    }

    public function cancelForm()
    {
        $this->reset(['duration', 'discount_percentage', 'validity_days', 'usage_limit', 'editSettingId', 'showForm']);
    }

    public function render()
    {
        return view('livewire.backend.admin.marketing.marketing-settings');
    }
}
