<div>
    <h1>Abschnitte bearbeiten</h1>

    @foreach ($sections as $index => $section)
        <div class="section-form">
            <input type="text" wire:model="sections.{{ $index }}.name" placeholder="Abschnittsname">
            <select wire:model="sections.{{ $index }}.type">
                <option value="header">Header</option>
                <option value="nav">Navigation</option>
                <option value="section">Section</option>
                <option value="footer">Footer</option>
            </select>
            <textarea wire:model="sections.{{ $index }}.content" placeholder="Inhalt"></textarea>
            <label>
                <input type="checkbox" wire:model="sections.{{ $index }}.editable"> Bearbeitbar
            </label>
            <button wire:click="removeSection({{ $index }})">Entfernen</button>
        </div>
    @endforeach

    <button wire:click="addSection">Abschnitt hinzufügen</button>
    <button wire:click="saveSections">Speichern</button>

    @if (session()->has('message'))
        <div>{{ session('message') }}</div>
    @endif
</div>
