<?php

namespace App\Livewire\Backend\Admin\InvoiceSystem;

use Livewire\Component;
use App\Models\ModSysCsvExports;
use Illuminate\Support\Facades\Storage;

class CsvExportManager extends Component
{


    public $csvFiles;


    public function mount()
    {
        $this->loadCsvFiles();
    }

    public function loadCsvFiles()
    {
        $this->csvFiles = ModSysCsvExports::orderBy('created_at', 'desc')->get();
    }

    public function deleteCsv($id)
    {
        $csv = ModSysCsvExports::findOrFail($id);
    //    Storage::delete($csv->filepath);
        $csv->delete();

        $this->csvFiles = ModSysCsvExports::all();
        session()->flash('status', 'CSV-Datei gelöscht.');
    }


    public function render()
    {
        return view('livewire.backend.admin.invoice-system.csv-export-manager');
    }
}
