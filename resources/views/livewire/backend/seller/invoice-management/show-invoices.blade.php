<div>
    <h1>Rechnungen für Shop ID: {{ $shopId }}</h1>
    <table>
        <thead>
            <tr>
                <th>#ID</th>
                <th>Rechnungsnummer</th>
                <th>Betrag</th>
                <th>Status</th>
                <th>Erstellt am</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->id }}</td>
                    <td>{{ $invoice->invoice_number }}</td>
                    <td>{{ $invoice->payment_status }}</td>
                    <td>{{ $invoice->pdf_path }}</td>
                    <td>{{ $invoice->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Rechnungen für Shop ID: {{ $shopId }}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-responsive-md">
                        <thead>
                            <tr>
                                <th style="width:80px;"><strong>#ID</strong></th>
                                <th><strong>Rechnungsnummer</strong></th>
                                <th><strong>DR NAME</strong></th>
                                <th><strong>DATE</strong></th>
                                <th><strong>STATUS</strong></th>
                                <th><strong>PRICE</strong></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>


<tr>
    @foreach($invoices as $invoice)
    <tr>
        <td>{{ $invoice->id }}</td>
        <td>{{ $invoice->invoice_number }}</td>

        <td><a href="{{ route('invoices.show', ['shopId' => $invoice->shop_id, 'fileName' => basename($invoice->pdf_path)]) }}" target="_blank"><div class="d-flex align-items-center"><img src="{{ asset('uploads/pdf_icon.gif') }}" width="18" alt=""/></div></a></td>

        <td>
            @if ($invoice->payment_status === 'paid')
                <span class="badge light badge-success">Successful</span>
            @elseif ($invoice->payment_status === 'open')
                <span class="badge light badge-warning">Pending</span>
            @else
                <span class="badge light badge-danger">Canceled</span>
            @endif
        </td>

        <td>{{ $invoice->created_at }}</td>
        <td>{{ Carbon\Carbon::parse($invoice['created_at'])->format('F j, Y') }}</td>

    </tr>
@endforeach


</tr>



                            <tr>
                                <td><strong>01</strong></td>
                                <td>Mr. Bobby</td>
                                <td>Dr. Jackson</td>
                                <td>01 August 2020</td>
                                <td><span class="badge light badge-success">Successful</span></td>
                                <td>$21.56</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-success light sharp" data-bs-toggle="dropdown">
                                            <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Edit</a>
                                            <a class="dropdown-item" href="#">Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>02</strong></td>
                                <td>Mr. Bobby</td>
                                <td>Dr. Jackson</td>
                                <td>01 August 2020</td>
                                <td><span class="badge light badge-danger">Canceled</span></td>
                                <td>$21.56</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-danger light sharp" data-bs-toggle="dropdown">
                                            <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Edit</a>
                                            <a class="dropdown-item" href="#">Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>03</strong></td>
                                <td>Mr. Bobby</td>
                                <td>Dr. Jackson</td>
                                <td>01 August 2020</td>
                                <td><span class="badge light badge-warning">Pending</span></td>
                                <td>$21.56</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-warning light sharp" data-bs-toggle="dropdown">
                                            <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Edit</a>
                                            <a class="dropdown-item" href="#">Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
