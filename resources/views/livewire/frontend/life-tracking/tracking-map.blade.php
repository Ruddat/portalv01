<div>
    <div id="map" style="height: 500px;"></div>

    <script>
        document.addEventListener('livewire:load', function () {
            var map = L.map('map').setView([{{ $latitude ?? 51.505 }}, {{ $longitude ?? -0.09 }}], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var marker = L.marker([{{ $latitude ?? 51.505 }}, {{ $longitude ?? -0.09 }}]).addTo(map);

            window.livewire.on('updateMap', (latitude, longitude) => {
                map.setView([latitude, longitude], 13);
                marker.setLatLng([latitude, longitude]);
            });
        });
    </script>
</div>
