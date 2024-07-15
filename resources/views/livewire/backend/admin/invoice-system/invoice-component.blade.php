<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Rechnungen</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table header-border table-responsive-sm">
                    <thead>
                        <tr>
                            <th>Restaurantname</th>
                            <th>Kundennummer</th>
                            <th>Rechnungsnummer</th>
                            <th>Abrechnungszeitraum</th>
                            <th>Betrag</th>
                            <th>PDF</th>
                            <th>Status</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoices as $invoice)
                            <tr>
                                <td>{{ $invoice->shop->title }}</td>
                                <td>{{ $invoice->shop->shop_nr }}</td>
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
                                <td>{{ $invoice->shop->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
