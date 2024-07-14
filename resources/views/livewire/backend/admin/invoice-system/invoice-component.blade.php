<div>
    <h1>Rechnungen</h1>
    <table>
        <thead>
            <tr>
                <th>Shop</th>
                <th>Betrag</th>
                <th>Startdatum</th>
                <th>Enddatum</th>
                <th>Erstellt am</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->shop->name }}</td>
                    <td>{{ $invoice->amount }}</td>
                    <td>{{ $invoice->start_date }}</td>
                    <td>{{ $invoice->end_date }}</td>
                    <td>{{ $invoice->generated_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
