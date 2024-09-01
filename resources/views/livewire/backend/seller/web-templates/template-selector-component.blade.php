<div>
    <h2>Vorhandene Templates</h2>
    <ul>
        @foreach($templates as $template)
        <div class="template-item">
            <h3>{{ $template->name }}</h3>
            <button wire:click="selectTemplate({{ $template->id }})">Auswählen</button>
        </div>
    @endforeach
    </ul>

    <h2>Ausgewählte Templates</h2>
    <ul>
        @foreach($selectedTemplates as $templateId)
            @php
                $template = $templates->find($templateId);
            @endphp
            <li>
                {{ $template->name }}
                <button wire:click="removeTemplate({{ $template->id }})">Löschen</button>
                <!-- Füge hier den Button "Anpassen" hinzu, um ein Template zu bearbeiten -->
                        <!-- Vorschau-Button -->
        <a href="{{ route('seller.web-templates.preview', ['shopId' => $shopId, 'templateId' => $template->id]) }}" target="_blank">
            <button type="button">Vorschau</button>
        </a>
            </li>
        @endforeach
    </ul>

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
</div>
