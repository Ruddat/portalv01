<div>
    <h1>Neues Werbebanner erstellen</h1>
    <form wire:submit.prevent="submit">
        <div class="form-group">
            <label for="title">Titel</label>
            <input type="text" id="title" wire:model="title" class="form-control">
            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="description">Beschreibung</label>
            <textarea id="description" wire:model="description" class="form-control"></textarea>
            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="icon">Icon</label>
            <input type="text" id="icon" wire:model="icon" class="form-control">
            @error('icon') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="coupon_code">Coupon Code</label>
            <input type="text" id="coupon_code" wire:model="coupon_code" class="form-control">
            @error('coupon_code') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="start_time">Startzeit</label>
            <input type="datetime-local" id="start_time" wire:model="start_time" class="form-control">
            @error('start_time') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="end_time">Endzeit</label>
            <input type="datetime-local" id="end_time" wire:model="end_time" class="form-control">
            @error('end_time') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Erstellen</button>
    </form>
</div>
