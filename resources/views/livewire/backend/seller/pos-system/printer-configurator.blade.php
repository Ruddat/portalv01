<div>
    <h4>Drucker konfigurieren für Shop ID: {{ $shopId }}</h4>
    <select wire:model="selectedPrinterId">
        <option value="">Bitte wählen...</option>
        @foreach($printers as $printer)
            <option value="{{ $printer->id }}">{{ $printer->name }} ({{ $printer->port }})</option>
        @endforeach
    </select>

    <button wire:click="configurePrinter">Konfigurieren</button>
</div>
