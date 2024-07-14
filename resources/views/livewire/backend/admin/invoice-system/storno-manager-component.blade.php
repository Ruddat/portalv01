<div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Bestellungen</h4>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <input wire:model.live="search" type="text" placeholder="Suche nach Bestellungen..." class="form-control"/>
                </div>

                <div class="table-responsive">
                    <table class="table header-border table-responsive-sm">
                        <thead>
                            <tr>
                                <th wire:click="sortBy('order_nr')">#</th>
                                <th wire:click="sortBy('name')">Name</th>
                                <th wire:click="sortBy('surname')">Nachname</th>
                                <th wire:click="sortBy('payment_type')">Zahlungsmethode</th>
                                <th wire:click="sortBy('order_date')">Bestelldatum</th>
                                <th>Storno Betrag</th>
                                <th>Storno Grund</th>
                                <th>Storno in Abrechnung</th>
                                <th>Aktion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->order_nr }}</td>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->surname }}</td>
                                    <td>{{ $order->payment_type }}</td>
                                    <td>{{ $order->order_date }}</td>
                                    <td>{{ $order->storno_refund_amount }}</td>
                                    <td>{{ $order->storno_refund_reason }}</td>
                                    <td>{{ $order->storno_included_in_invoice ? 'Ja' : 'Nein' }}</td>
                                    <td>
                                        <button wire:click="setOrder({{ $order->id }})" class="btn btn-primary">Storno</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $orders->links() }}

                @if ($orderId)
                    <div class="mt-4" id="storno-form">
                        <h2>Storno bearbeiten</h2>
                        <form wire:submit.prevent="processRefund">
                            <div>
                                <label for="refundAmount">Rückerstattungsbetrag</label>
                                <input wire:model="refundAmount" type="text" id="refundAmount" class="form-control">
                            </div>
                            <div>
                                <label for="refundReason">Rückerstattungsgrund</label>
                                <input wire:model="refundReason" type="text" id="refundReason" class="form-control">
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Storno speichern</button>
                                <button type="button" wire:click="cancelRefund" class="btn btn-secondary">Abbrechen</button>
                            </div>
                        </form>
                    </div>
                @endif

                @if (session()->has('message'))
                    <div class="mt-4 alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('scroll-to-form', () => {
        document.getElementById('storno-form').scrollIntoView({ behavior: 'smooth' });
    });
</script>
