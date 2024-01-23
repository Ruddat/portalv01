<div class="hero_single version_1">
    <div class="opacity-mask">
        <div class="container">
            <div class="row justify-content-lg-start justify-content-md-center">
                <div class="col-xl-7 col-lg-8">
                    <h1>Delivery or Takeaway Food</h1>
                    <p>All restaurants <span class="element" style="font-weight: 500"></span></p>
                    <form wire:submit.prevent="search">>
                        <div class="row g-0 custom-search-input">
                            <div class="col-lg-10">
                                <div class="form-group position-relative">
                                    <input wire:model="userInput" class="form-control no_border_r" type="text" wire:keyup="autocomplete"
                                        wire:keydown.arrow-up="moveSelection('up')" wire:keydown.arrow-down="moveSelection('down')"
                                        placeholder="Address, neighborhood..." >
                                        @if($autocompleteResults)
                                        <ul class="autocomplete-dropdown">
                                            @foreach($autocompleteResults as $key => $autocompleteResult)
                                                <li wire:click="selectAutocomplete('{{ $autocompleteResult->name }}')"
                                                    wire:key="{{ $key }}"
                                                    class="autocomplete-item {{ $key === $selectedAutocompleteItem ? 'selected' : '' }}">
                                                    {{ $autocompleteResult->name }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <button class="btn_1 gradient" type="submit">Search</button>
                            </div>
                        </div>
                        <!-- /row -->

                        <div class="search_trends">
                            <h5>Trending:</h5>
                            <ul>
                                <li><a href="#0">Sushi</a></li>
                                <li><a href="#0">Burgher</a></li>
                                <li><a href="#0">Chinese</a></li>
                                <li><a href="#0">Pizza</a></li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /row -->
        </div>
    </div>
    <div class="wave hero"></div>

    @if($results)
        <h2>Ergebnisse ({{ count($results) }} Restaurants gefunden):</h2>
        <ul>
            @foreach($results as $result)
                <li>
                    {{ $result->title }} - Koordinaten ({{ $result->latitude }}, {{ $result->longitude }})
                    - Entfernung: {{ number_format($result->distance, 2, '.', '') }} km
                </li>
            @endforeach
        </ul>
    @else
        <p>Keine Ergebnisse gefunden.</p>
    @endif
</div>
<!-- /hero_single -->

@push('specific-css')
<style>
    .autocomplete-dropdown {
        list-style: none;
        padding: 0;
        margin: 0;
        position: absolute;
        background-color: #fff;
        border: 1px solid #ccc;
        z-index: 1000;
        max-height: 200px;
        overflow-y: auto;
        width: 100%;
    }

    .autocomplete-item {
        padding: 10px;
        cursor: pointer;
        color: gray;
    }

    .autocomplete-item:hover, .autocomplete-item.selected {
        background-color: #f0f0f0;
    }
</style>
@endpush
@push('specific-scripts')
<script>
    document.addEventListener('livewire:load', function () {
    Livewire.hook('message.processed', (message, component) => {
        // Nach jeder Livewire-Aktion überprüfen, ob der userInput leer ist und den Standardwert setzen
        if (component.fingerprint.name === 'frontend.shop-search') {
            const inputElement = document.querySelector('[wire\\:model="userInput"]');
            if (inputElement && inputElement.value.trim() === '') {
                inputElement.value = 'Address, neighborhood...';
            }
        }
    });
});
</script>

<!-- TYPE EFFECT -->
<script src="{{ asset('frontend/js/typed.min.js') }}"></script>
<script>
    var typed = new Typed('.element', {
      strings: ["at the best price", "with unique food", "with nice location"],
      startDelay: 10,
      loop: true,
      backDelay: 2000,
      typeSpeed: 50
    });
</script>
@endpush
