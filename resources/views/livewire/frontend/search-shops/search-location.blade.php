<div>
    <button class="custom-button" id="btn1" type="loc_button" wire:click="getLocation" aria-label="Custom Button" ontouchstart="">
        <svg width="38px" height="38px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M5.5 11.9999C5.50034 9.13745 7.52262 6.67387 10.3301 6.11575C13.1376 5.55763 15.9484 7.06041 17.0435 9.70506C18.1386 12.3497 17.2131 15.3997 14.833 16.9897C12.4528 18.5798 9.28087 18.2671 7.257 16.2429C6.13183 15.1175 5.49981 13.5912 5.5 11.9999Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.5 14.9999L13.268 13.2429C13.7367 12.7781 14.0003 12.1454 14.0003 11.4854C14.0003 10.8253 13.7367 10.1926 13.268 9.72786C12.2894 8.75673 10.7106 8.75673 9.73199 9.72786C9.26328 10.1926 8.99963 10.8253 8.99963 11.4854C8.99963 12.1454 9.26328 12.7781 9.73199 13.2429L11.5 14.9999Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M15.972 15.9999L19.5 18.9999" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
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

<style>
    .custom-button {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    @media (min-width: 768px) {
        .custom-button {
            margin-left: 0;
            margin-right: auto;
        }
    }
</style>

@endpush
