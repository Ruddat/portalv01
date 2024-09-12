<div>
    <form wire:submit.prevent="saveDomain">
        <div class="form-group">
            <label for="domain">Domain</label>
            <input type="text" id="domain" wire:model="domain" class="form-control" placeholder="z.B. www.expresspeine.de oder expresspeine.de">
            @error('domain') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        @if($editingDomainId)
            <button type="button" wire:click="cancelEdit" class="btn btn-secondary">Abbrechen</button>
        @endif

        <button type="submit" class="btn btn-primary">{{ $editingDomainId ? 'Ändern' : 'Speichern' }}</button>
    </form>

    @if($savedDomains)
        <h3>Gespeicherte Domains</h3>
        <ul>
            @foreach($savedDomains as $savedDomain)
                <li>
                    <a href="https://{{ $savedDomain->domain }}" target="_blank">{{ $savedDomain->domain }}</a>
                    <button type="button" wire:click="editDomain({{ $savedDomain->id }})" class="btn btn-warning btn-sm">Bearbeiten</button>
                    <button type="button" wire:click="deleteDomain({{ $savedDomain->id }})" class="btn btn-danger btn-sm">Löschen</button>
                </li>
            @endforeach
        </ul>
    @endif
</div>
