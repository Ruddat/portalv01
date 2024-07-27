<!-- resources/views/livewire/backend/seller/marketing/stamp-card-component.blade.php -->
<div>
    @if($stampCard && $stampCard->is_active)
        <p>Das Programm ist aktiv. Verbleibende Tage: {{ $remainingDays }}</p>
        @if($showCancelButton)
            <button wire:click="cancelProgram">Programm stornieren</button>
        @endif
        @if($showExtendButton)
            <button wire:click="extendProgram">Programm verlängern</button>
        @endif
    @else
        <button wire:click="activateProgram">Programm aktivieren</button>
    @endif
</div>
