<div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-block">
                <h4 class="card-title">Rechnungen für Shop ID: {{ $invoice->shop->title ?? 'No Title' }}</h4>
                <p class="mb-0 subtitle"><strong>Kundennummer:</strong> {{ $invoice->shop->shop_nr ?? 'No Number' }} {{ $shopId }}</p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-responsive-md">
                        <thead>
                            <tr>
                                <th style="width:80px;"><strong>#ID</strong></th>
                                <th><strong>TITLE</strong></th>
                                <th><strong>RECHNUNGSNUMMER</strong></th>
                                <th><strong>STATUS</strong></th>
                                <th><strong>INVOICE</strong></th>
                                <th><strong>DATE</strong></th>
                                <th>Invoice von bis</th>
                            </tr>
                        </thead>
                        <tbody>


<tr>
    @foreach($invoices as $invoice)
    <tr>
        <td>{{ $invoice->id }}</td>
        <td>{{ $invoice->shop->title ?? 'No Title' }}</td>
        <td>{{ $invoice->invoice_number }}</td>

        <td>
            @if ($invoice->payment_status === null)
            <span class="badge light badge-warning">Pending</span>
        @elseif ($invoice->payment_status === 'paid')
            <span class="badge light badge-success">Successful Paid</span>
        @elseif ($invoice->payment_status === 'open')
            <span class="badge light badge-warning">Pending</span>
        @else
            <span class="badge light badge-danger">Canceled</span>
        @endif
        </td>
        <td><a href="{{ route('invoices.show', ['shopId' => $invoice->shop_id, 'fileName' => basename($invoice->pdf_path)]) }}" target="_blank"><div class="d-flex align-items-center"><img src="{{ asset('uploads/pdf_icon.gif') }}" width="18" alt=""/></div></a></td>
        <td>{{ Carbon\Carbon::parse($invoice['created_at'])->format('F j, Y') }}</td>
        <td>{{ Carbon\Carbon::parse($invoice['start_date'])->format('F j, Y') }} - {{ Carbon\Carbon::parse($invoice['end_date'])->format('F j, Y') }} </td>


    </tr>
@endforeach


</tr>



                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
