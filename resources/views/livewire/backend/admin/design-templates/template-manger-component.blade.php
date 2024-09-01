<div class="container mx-auto">
    <!-- Button zum Erstellen eines neuen Templates -->
    <div class="flex justify-end mb-4">
        <button wire:click="showCreateTemplateForm" class="btn btn-primary rounded-md">
            Neues Template erstellen
        </button>
    </div>

    <!-- Template-Erstellungsformular -->
    @if($showCreateForm)
        @include('livewire.backend.admin.design-templates.create-template')
    @endif

    <!-- Template-Liste -->
    <div class="row">
        @if($templates->isEmpty())
            <div class="col-12">
                <div class="alert alert-warning" role="alert">
                    Kein Template verfügbar.
                </div>
            </div>
        @else
            @foreach($templates as $template)
                <div class="col-md-4">
                    <div class="card">
                        <img class="card-img-top" src="{{ Storage::url($template->preview_image) }}" alt="{{ $template->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $template->name }}</h5>
                            <p class="card-text">{{ $template->description }}</p>
                            <!-- Bearbeiten Button -->
                            <button wire:click="editTemplate({{ $template->id }})" class="btn btn-primary">Bearbeiten</button>
                            <!-- Löschen Button -->
                            <button wire:click="deleteTemplate({{ $template->id }})" class="btn btn-danger">Löschen</button>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <!-- Sections bearbeiten -->
    @if($templateId)
        <div>
            <h1>Abschnitte bearbeiten</h1>

            @foreach ($sections as $index => $section)
                <div class="section-form mb-4">
                    <input type="text" wire:model="sections.{{ $index }}.name" placeholder="Abschnittsname" class="form-input">
                    <select wire:model="sections.{{ $index }}.type" class="form-select">
                        <option value="header">Header</option>
                        <option value="nav">Navigation</option>
                        <option value="hero">Hero</option>
                        <option value="section">Section</option>
                        <option value="footer">Footer</option>
                    </select>
                    <textarea wire:model="sections.{{ $index }}.content" placeholder="Inhalt" class="form-control h-auto" rows="4"></textarea>
                    <label>
                        <input type="checkbox" wire:model="sections.{{ $index }}.editable"> Bearbeitbar
                    </label>
                    <button wire:click="removeSection({{ $index }})" class="bg-red-500 text-white px-2 py-1 rounded">Entfernen</button>
                </div>
            @endforeach

            <!-- Button um eine neue Section hinzuzufügen -->
            <button wire:click="addSection" class="bg-green-500 text-white px-4 py-2 rounded">Abschnitt hinzufügen</button>

            <!-- Button um die Sections zu speichern -->
            <button wire:click="saveSections" class="bg-indigo-500 text-white px-4 py-2 rounded">Speichern</button>

            @if (session()->has('message'))
                <div class="mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('message') }}
                </div>
            @endif
        </div>
    @endif
</div>
