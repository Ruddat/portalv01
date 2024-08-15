<?php

namespace App\Livewire\Backend\Seller\PosSystem;

use Livewire\Component;
use App\Models\ModSharedToolsPrinters;
use App\Models\ModSharedToolsPrinterConfiguration;

class PrinterConfigurator extends Component
{


    public $printers;
    public $selectedPrinterId;
    public $shopId;
    public $computerName;

    public function mount($shopId)
    {
        $this->shopId = $shopId;
        $this->printers = ModSharedToolsPrinters::all();
        $this->computerName = gethostname(); // Oder ein anderer Identifier für den Rechner
    }

    public function configurePrinter()
    {
        ModSharedToolsPrinterConfiguration::updateOrCreate(
            ['shop_id' => $this->shopId, 'computer_name' => $this->computerName],
            ['printer_id' => $this->selectedPrinterId]
        );
        session()->flash('message', 'Drucker konfiguriert!');
    }

    public function render()
    {
        return view('livewire.backend.seller.pos-system.printer-configurator');
    }
}
