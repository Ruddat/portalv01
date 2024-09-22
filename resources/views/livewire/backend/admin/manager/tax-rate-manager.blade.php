<div>
    <h2 class="mb-4">Mehrwertsteuersätze verwalten</h2>

    @if($editing)
        <h3 class="mb-3">Steuersatz bearbeiten</h3>
        <form wire:submit.prevent="update" class="mb-4">
            <div class="form-group">
                <label for="country_code">Ländercode</label>
                <input type="text" wire:model="country_code" id="country_code" maxlength="2" class="form-control">
            </div>
            <div class="form-group">
                <label for="standard_rate">Standard-Satz</label>
                <input type="number" wire:model="standard_rate" id="standard_rate" step="0.01" class="form-control">
            </div>
            <div class="form-group">
                <label for="reduced_rate">Reduzierter Satz</label>
                <input type="number" wire:model="reduced_rate" id="reduced_rate" step="0.01" class="form-control">
            </div>
            <div class="form-group">
                <label for="category">Kategorie</label>
                <select wire:model="category" id="category" class="form-control">
                    <option value="Food">Food</option>
                    <option value="Drinks">Drinks</option>
                    <option value="Non-Food">Non-Food</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Speichern</button>
            <button wire:click="cancelEdit" class="btn btn-secondary">Abbrechen</button>
        </form>
    @else
        <h3 class="mb-3">Neuen Steuersatz hinzufügen</h3>
        <form wire:submit.prevent="create" class="mb-4">
            <div class="form-group">
                <label for="country_code">Ländercode</label>
                <input type="text" wire:model="country_code" id="country_code" maxlength="2" class="form-control">
            </div>
            <div class="form-group">
                <label for="standard_rate">Standard-Satz</label>
                <input type="number" wire:model="standard_rate" id="standard_rate" step="0.01" class="form-control">
            </div>
            <div class="form-group">
                <label for="reduced_rate">Reduzierter Satz</label>
                <input type="number" wire:model="reduced_rate" id="reduced_rate" step="0.01" class="form-control">
            </div>
            <div class="form-group">
                <label for="category">Kategorie</label>
                <select wire:model="category" id="category" class="form-control">
                    <option value="Food">Food</option>
                    <option value="Drinks">Drinks</option>
                    <option value="Non-Food">Non-Food</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Hinzufügen</button>
        </form>
    @endif

    @if($showTable)
        <h3 class="mb-3">Aktuelle Steuersätze</h3>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Ländercode</th>
                    <th>Standard-Satz</th>
                    <th>Reduzierter Satz</th>
                    <th>Kategorie</th>
                    <th>Aktionen</th>
                </tr>
            </thead>
            <tbody>
                @foreach($taxRates as $taxRate)
                    <tr>
                        <td>{{ $taxRate->country_code }}</td>
                        <td>{{ $taxRate->standard_rate }}</td>
                        <td>{{ $taxRate->reduced_rate }}</td>
                        <td>{{ $taxRate->category }}</td>
                        <td>
                            <button wire:click="edit({{ $taxRate->id }})" class="btn btn-sm btn-primary">Bearbeiten</button>
                            <button wire:click="delete({{ $taxRate->id }})" class="btn btn-sm btn-danger">Löschen</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
