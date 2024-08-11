<div class="col-xl-12" wire:poll>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Top Product & Flop Product</h4>
        </div>
        <div class="card-body pb-0">
            <div class="table-responsive">


                <div class="row">
                <div class="btn-group col-12 col-md-6 mb-4" role="group" aria-label="Time Period">
        <button wire:click="setTimePeriod('day')" class="btn btn-outline-primary">Tag</button>
        <button wire:click="setTimePeriod('week')" class="btn btn-outline-primary">Woche</button>
        <button wire:click="setTimePeriod('month')" class="btn btn-outline-primary">Monat</button>
        <button wire:click="setTimePeriod('year')" class="btn btn-outline-primary">Jahr</button>
    </div>

    <div class="col-12 col-md-6 mb-4">
        <select wire:model.change="selectedShopId" id="shopFilter" class="form-select" aria-label="Filter nach Shop">
            <option value="">Alle Shops</option>
            @foreach($shops as $shopId => $shopName)
                <option value="{{ $shopId }}">{{ $shopName }}</option>
            @endforeach
        </select>
    </div>
                </div>

    <div class="row">
        <div class="col-12 col-md-6 mb-4">
            <h2>Renner (Top 10)</h2>
            @if ($topProducts->isEmpty())
                <p>Keine Renner-Produkte gefunden.</p>
            @else
                <ul class="list-group">
                    @foreach($topProducts as $product)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <p>{{ $product->shop_name }}</p>
                            {{ $product->product_name }} (ID: {{ $product->product_id }})
                            <span class="badge bg-success rounded-pill">{{ $product->total_quantity }} verkauft</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
        <div class="col-12 col-md-6 mb-4">
            <h2>Penner (Flop 10)</h2>
            @if ($flopProducts->isEmpty())
                <p>Keine Penner-Produkte gefunden.</p>
            @else
                <ul class="list-group">
                    @foreach($flopProducts as $product)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <p>{{ $product->shop_name }}</p>
                            {{ $product->product_name }} (ID: {{ $product->product_id }})
                            <span class="badge bg-danger rounded-pill">{{ $product->total_quantity }} verkauft</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
        </div>
    </div>
</div>
</div>
