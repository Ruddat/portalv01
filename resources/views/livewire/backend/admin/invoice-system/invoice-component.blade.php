<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Rechnungen</h4>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Suche..." wire:model="search">
                </div>
                <div class="col-md-4">
                    <select class="form-control" wire:model.change="filterStatus">
                        <option value="">Alle Status</option>
                        <option value="paid">Bezahlt</option>
                        <option value="open">Offen</option>
                    </select>
                </div>
                <div class="col-md-4 text-right">
                    <select class="form-control" wire:model.change="perPage">
                        <option value="10">10 pro Seite</option>
                        <option value="25">25 pro Seite</option>
                        <option value="50">50 pro Seite</option>
                    </select>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table header-border table-responsive-sm">
                    <thead>
                        <tr>
                            <th>Restaurantname</th>
                            <th>Kundennummer</th>
                            <th>Email</th>
                            <th>Rechnungsnummer</th>
                            <th>Abrechnungszeitraum</th>
                            <th>Betrag</th>
                            <th>PDF</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoices as $invoice)
                            <tr>
                                <td>{{ $invoice->shop->title }}</td>
                                <td>{{ $invoice->shop->shop_nr }}</td>
                                <td>{{ $invoice->shop->email }}</td>
                                <td>{{ $invoice->invoice_number }}</td>
                                <td>{{ $invoice->start_date }} - {{ $invoice->end_date }}</td>
                                <td>{{ number_format($invoice->total_amount, 2) }} €</td>
                                <td>
                                    @if ($invoice->pdf_path)
                                        <a href="{{ route('invoices.show', ['shopId' => $invoice->shop_id, 'fileName' => basename($invoice->pdf_path)]) }}" target="_blank">PDF</a>
                                    @else
                                        Kein PDF
                                    @endif
                                </td>
                                <td>
                                    <button wire:click="togglePaymentStatus({{ $invoice->id }})" class="btn btn-sm {{ $invoice->payment_status === 'paid' ? 'btn-success' : 'btn-danger' }}">
                                        {{ $invoice->payment_status === 'paid' ? 'Bezahlt' : 'Offen' }}
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $invoices->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
