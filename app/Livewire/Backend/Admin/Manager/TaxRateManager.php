<?php

namespace App\Livewire\Backend\Admin\Manager;

use Livewire\Component;
use App\Models\ModSysTaxRates;

class TaxRateManager extends Component
{
    public $taxRates;
    public $country_code;
    public $standard_rate;
    public $reduced_rate;
    public $category;
    public $editing = false;
    public $taxRateId;
    public $showTable = true; // Neue Eigenschaft für den Zustand der Tabelle


    public function mount()
    {
        $this->taxRates = ModSysTaxRates::all();
    }

    public function render()
    {
        return view('livewire.backend.admin.manager.tax-rate-manager');

    }

    public function create()
    {
        $this->validate([
            'country_code' => 'required|string|max:2',
            'standard_rate' => 'required|numeric',
            'reduced_rate' => 'nullable|numeric',
            'category' => 'required|in:Food,Drinks,Non-Food',
        ]);

        ModSysTaxRates::create([
            'country_code' => $this->country_code,
            'standard_rate' => $this->standard_rate,
            'reduced_rate' => $this->reduced_rate,
            'category' => $this->category,
        ]);

        $this->resetInput();
        $this->taxRates = ModSysTaxRates::all();
    }

    public function edit($id)
    {
        $taxRate = ModSysTaxRates::findOrFail($id);
        $this->taxRateId = $id;
        $this->country_code = $taxRate->country_code;
        $this->standard_rate = $taxRate->standard_rate;
        $this->reduced_rate = $taxRate->reduced_rate;
        $this->category = $taxRate->category;
        $this->editing = true;
        $this->showTable = false; // Tabelle ausblenden
    }

    public function update()
    {
        $this->validate([
            'country_code' => 'required|string|max:2',
            'standard_rate' => 'nullable|numeric',
            'reduced_rate' => 'nullable|numeric',
            'category' => 'required|in:Food,Drinks,Non-Food',
        ]);

        $taxRate = ModSysTaxRates::findOrFail($this->taxRateId);
        $taxRate->update([
            'country_code' => $this->country_code,
            'standard_rate' => $this->standard_rate ?: null,
            'reduced_rate' => $this->reduced_rate ?: null,
            'category' => $this->category,
        ]);

        $this->resetInput();
        $this->editing = false;
        $this->showTable = true; // Tabelle wieder einblenden
        $this->taxRates = ModSysTaxRates::all();
    }

    public function delete($id)
    {
        TaxRate::findOrFail($id)->delete();
        $this->taxRates = ModSysTaxRates::all();
    }


    public function cancelEdit()
    {
        $this->resetInput();
        $this->editing = false;
        $this->showTable = true; // Tabelle wieder einblenden
    }

    private function resetInput()
    {
        $this->country_code = '';
        $this->standard_rate = '';
        $this->reduced_rate = '';
        $this->category = '';
    }

}
