<form wire:submit.prevent="createShop">
    <!-- Eingabefelder hier mit wire:model binden -->
    <input type="text" wire:model="newShop.title">
    <input type="email" wire:model="newShop.email">
    <!-- Weitere Eingabefelder hier, falls vorhanden -->

    <button type="submit">Speichern</button>
    <button wire:click="cancelCreateForm">Abbrechen</button>
</form>
