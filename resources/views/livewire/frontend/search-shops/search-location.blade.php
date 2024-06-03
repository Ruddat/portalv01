<div>
    <button class="custom-button" id="btn1" type="loc_button" wire:click="getLocation" aria-label="Custom Button" ontouchstart="">
        <svg class="feather-map-pin h4 icofont-3x text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
        </svg>
    </button>


    @if($loading)
        <p>Standort wird abgerufen...</p>
    @elseif($latitude && $longitude)
        <p>Latitude: {{ $latitude }}</p>
        <p>Longitude: {{ $longitude }}</p>
        <button wire:click="saveLocation($latitude, $longitude)">Standort speichern</button>
    @endif
</div>

@push('scripts')
<script>
    window.addEventListener('requestLocationPermission', function () {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                // Rufe die saveLocation-Methode im Livewire-Controller auf
                @this.call('saveLocation', position.coords.latitude, position.coords.longitude);
            });
        } else {
            console.error('Ihr Browser unterstützt keine Geolocation.');
            // Verberge den Ladezustand
            @this.set('loading', false);
        }
    });
</script>
@endpush
