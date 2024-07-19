<div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Bestellungen</h4>
            </div>
            <div class="card-body">
                <div class="row">
                <div class="mb-3 col-md-4">
                    <label for="search">Suchen:</label>
                    <input wire:model.live="search" type="text" placeholder="Suche nach Bestellungen..." class="form-control"/>
                </div>

                <div class="mb-3 col-md-4">
                    <label for="paymentTypeFilter">Zahlungsart Filtern:</label>
                    <select wire:model.live="paymentTypeFilter" class="form-control">
                        <option value="">Alle Zahlungsmethoden</option>
                        @foreach ($paymentTypes as $paymentType)
                            <option value="{{ $paymentType }}">{{ $paymentType }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3 col-md-4">
                    <label for="recordsPerPage">Einträge pro Seite:</label>
                    <select wire:model.live="recordsPerPage" id="recordsPerPage" class="form-control">
                        @foreach($perPageOptions as $option)
                            <option value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                    </select>
                </div>
                </div>
                @if (session()->has('message'))
                    <div class="mt-4 alert alert-success">
                        {{ app(\App\Services\AutoTranslationService::class)->trans(session('message'), app()->getLocale()) }}
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table header-border table-responsive-sm">
                        <thead>
                            <tr>
                                <th wire:click="sortBy('order_nr')">#</th>
                                <th wire:click="sortBy('name')">Name</th>
                                <th wire:click="sortBy('surname')">Nachname</th>
                                <th wire:click="sortBy('payment_type')">Zahlungsmethode</th>
                                <th wire:click="sortBy('order_date')">Bestelldatum</th>
                                <th wire:click="sortBy('mod_sys_stornos.refund_amount')">Storno Betrag</th>
                                <th wire:click="sortBy('mod_sys_stornos.refund_reason')">Storno Grund</th>
                                <th wire:click="sortBy('mod_sys_stornos.included_in_invoice')">Storno in Abrechnung</th>
                                <th wire:click="sortBy('paypal_total')">Paypal Betrag</th> <!-- Hinzugefügt -->
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
                                    <td>{{ $order->paypal_total }}</td> <!-- Hinzugefügt -->
                                    <td>
                                     <div class="d-flex">
                                        <button wire:click="setOrder({{ $order->id }}, {{ $order->paypal_total }}, {{ $order->parent }})" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></button>
                                        @if(!$order->storno_included_in_invoice)
                                        <button wire:click="deleteStorno({{ $order->id }})" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></button>
                                        @endif
                                     </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex">
                    {{ $orders->links() }}
                    </div>
                </div>







                @if ($orderId)
                <div class="mt-4" id="storno-form">
                    <h2>Storno bearbeiten</h2>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form wire:submit.prevent="processRefund">
                                    <div class="row">
                                        <div class="mb-3 col-md-4">
                                            <label for="refundAmount">Storno Betrag</label>
                                            <input wire:model="refundAmount" type="text" id="refundAmount" class="form-control"/>
                                            @error('refundAmount')
                                            <span class="text-danger">
                                                {{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-4">
                                            <label for="refundReason">Storno Grund</label>
                                            <select wire:model="refundReason" id="refundReason" class="form-control" required>
                                                <option value="">@autotranslate('Bitte auswählen', app()->getLocale())</option>
                                                @foreach($refundReasons as $reason)
                                                    <option value="{{ $reason }}"> {{ app(\App\Services\AutoTranslationService::class)->trans($reason, app()->getLocale()) }}</option>
                                                @endforeach
                                            </select>
                                            @error('refundReason')
                                            <span class="text-danger">
                                                {{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-4">
                                            <label for="stornoId">Storno ID</label>
                                            <input wire:model="stornoId" type="text" id="stornoId" class="form-control" readonly/>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-start">
                                        <button type="submit" class="btn btn-primary">Speichern</button>
                                        <button type="button" wire:click="cancelRefund" class="btn btn-secondary">Abbrechen</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif


                @if (session()->has('message'))
                    <div class="mt-4 alert alert-success">
                        {{ app(\App\Services\AutoTranslationService::class)->trans(session('message'), app()->getLocale()) }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('scroll-to-form', () => {
        const formElement = document.getElementById('storno-form');
        if (formElement) {
            formElement.scrollIntoView({ behavior: 'smooth' });
        }
    });
</script>
