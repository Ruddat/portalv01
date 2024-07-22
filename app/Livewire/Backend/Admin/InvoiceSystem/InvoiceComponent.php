<?php

namespace App\Livewire\Backend\Admin\InvoiceSystem;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ModSysInvoices;
use App\Models\GeneralSettings;
use App\Models\ModSysCsvExports;
use Livewire\WithoutUrlPagination;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Artisan;

class InvoiceComponent extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search = '';
    public $filterStatus = '';
    public $perPage = 10;
    public $weekOffset = 0;
    public $startOfWeek;
    public $processing = false;
    public $statusMessage = '';
    public $selectedWeek = '';
    public $weeks = [];

    protected $queryString = [
        'search' => ['except' => ''],
        'filterStatus' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $signature = 'invoices:generate {startOfWeek=} {endOfWeek=}';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterStatus()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->generateWeeks();
    }

    public function generateInvoicesForWeek()
    {
        $this->processing = true;
        $this->statusMessage = 'Verarbeitung gestartet...';

        $startOfWeek = Carbon::now()->subWeeks($this->weekOffset)->startOfWeek(Carbon::SUNDAY)->toDateString();
        $endOfWeek = Carbon::now()->subWeeks($this->weekOffset)->endOfWeek(Carbon::SATURDAY)->toDateString();

        // Start processing in the background
        Artisan::call('invoices:generate', [
            'startOfWeek' => $startOfWeek,
            'endOfWeek' => $endOfWeek,
        ]);

        $this->processing = false;
        $this->statusMessage = 'Rechnungen für die Woche vom ' . $startOfWeek . ' bis ' . $endOfWeek . ' wurden erstellt.';

        $this->dispatch('invoicesProcessed'); // Emit an event to potentially update other parts of the component or UI
    }




    public function generateWeeks()
    {
        $invoices = ModSysInvoices::select('start_date', 'end_date')
            ->distinct()
            ->orderBy('start_date', 'desc')
            ->get();

        foreach ($invoices as $invoice) {
            $startOfWeek = Carbon::parse($invoice->start_date)->startOfWeek(Carbon::SUNDAY);
            $endOfWeek = Carbon::parse($invoice->end_date)->endOfWeek(Carbon::SATURDAY);
            $this->weeks[] = [
                'startOfWeek' => $startOfWeek->toDateString(),
                'endOfWeek' => $endOfWeek->toDateString(),
                'label' => $startOfWeek->format('d.m.Y') . ' - ' . $endOfWeek->format('d.m.Y'),
            ];
        }
    }

    public function exportCsv()
    {
        if (!$this->selectedWeek) {
            session()->flash('status', 'Bitte wählen Sie eine Woche aus.');
            return;
        }

        // Extract the start and end dates based on the selected week
        $weekRange = $this->selectedWeek;
        $startEndDates = explode(' - ', $weekRange);

        if (count($startEndDates) !== 2) {
            session()->flash('status', 'Fehler beim Verarbeiten des Wochenbereichs.');
            return;
        }

        $startOfWeek = Carbon::createFromFormat('d.m.Y', $startEndDates[0])->toDateString();
        $endOfWeek = Carbon::createFromFormat('d.m.Y', $startEndDates[1])->toDateString();

        // Get the invoices for the selected week based on start_date and end_date
        $invoices = ModSysInvoices::with('shop')
            ->when($this->search, function ($query) {
                $query->whereHas('shop', function ($query) {
                    $query->where('title', 'like', '%' . $this->search . '%')
                          ->orWhere('shop_nr', 'like', '%' . $this->search . '%');
                })
                ->orWhere('invoice_number', 'like', '%' . $this->search . '%');
            })
            ->when($this->filterStatus, function ($query) {
                $query->where('payment_status', $this->filterStatus);
            })
            ->where(function($query) use ($startOfWeek, $endOfWeek) {
                $query->whereBetween('start_date', [$startOfWeek, $endOfWeek])
                      ->orWhereBetween('end_date', [$startOfWeek, $endOfWeek])
                      ->orWhere(function($query) use ($startOfWeek, $endOfWeek) {
                          $query->where('start_date', '<=', $startOfWeek)
                                ->where('end_date', '>=', $endOfWeek);
                      });
            })
            ->get();

        // Get the GeneralSettings
        $settings = GeneralSettings::first();

        // Prepare CSV data
        $csvHeader = [
            'Belegdatum', 'Buchungsdatum', 'Belegnummernkreis', 'Belegnummer',
            'Buchungstext', 'Buchungsbetrag', 'Sollkonto', 'Habenkonto',
            'Steuerschlüssel', 'Kostenstelle 1', 'Kostenstelle 2', 'Währung'
        ];

        $csvData = [];

        foreach ($invoices as $invoice) {
            $csvData[] = [
                $invoice->start_date, // Belegdatum
                $invoice->created_at->format('Y-m-d'), // Buchungsdatum
                $settings->document_number_range, // Belegnummernkreis
                $invoice->invoice_number, // Belegnummer
                'Rechnung für ' . $invoice->shop->title, // Buchungstext
                number_format($invoice->total_amount, 2, ',', '.') . ' ' . $settings->currency, // Buchungsbetrag
                $settings->debit_account, // Sollkonto
                $settings->credit_account, // Habenkonto
                $settings->tax_key, // Steuerschlüssel
                '', // Kostenstelle 1
                '', // Kostenstelle 2
                $settings->currency, // Währung
            ];
        }

        $filename = 'invoices_' . now()->format('YmdHis') . '.csv';

        // Write CSV data to memory
        $csvFile = fopen('php://temp', 'r+');
        fwrite($csvFile, "\xEF\xBB\xBF"); // Add BOM for UTF-8
        fputcsv($csvFile, $csvHeader, ';'); // Set delimiter to semicolon

        foreach ($csvData as $row) {
            fputcsv($csvFile, $row, ';'); // Set delimiter to semicolon
        }

        rewind($csvFile);
        $csvContent = stream_get_contents($csvFile);
        fclose($csvFile);

        // Save CSV file in the database
        ModSysCsvExports::create([
            'filename' => $filename,
            'file_content' => $csvContent
        ]);

        // Offer CSV file for download
        return response()->stream(function() use ($csvContent) {
            echo $csvContent;
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }



    public function render()
    {
        $query = ModSysInvoices::with('shop')
            ->when($this->search, function($query) {
                $query->whereHas('shop', function($query) {
                    $query->where('title', 'like', '%'.$this->search.'%')
                          ->orWhere('shop_nr', 'like', '%'.$this->search.'%');
                })
                ->orWhere('invoice_number', 'like', '%'.$this->search.'%');
            })
            ->when($this->filterStatus, function($query) {
                $query->where('payment_status', $this->filterStatus);
            })
            ->orderBy('invoice_number', 'desc');

        return view('livewire.backend.admin.invoice-system.invoice-component', [
            'invoices' => $query->paginate($this->perPage)
        ]);
    }

    public function togglePaymentStatus($invoiceId)
    {
        $invoice = ModSysInvoices::find($invoiceId);
        if ($invoice) {
            $invoice->payment_status = $invoice->payment_status === 'paid' ? 'open' : 'paid';
            $invoice->save();
        }
    }
}
