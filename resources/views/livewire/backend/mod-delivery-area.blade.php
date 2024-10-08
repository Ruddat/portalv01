<div>
    <p>Shop Name: {{ $shop->title }}</p>
    <p>Shop Latitude: {{ $shop->lat }}</p>
    <p>Shop Longitude: {{ $shop->lng }}</p>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <style>
        #map {
            width: 100%;
            height: 100%;
            z-index: 0;
        }
    </style>

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Liefergebiet eingeben</h4>

            <div class="d-flex flex-wrap justify-content-end">
                <button type="button" class="btn btn-info me-2 mb-2 btn-sm" wire:click="reloadPage">
                    <span class="btn-icon-start text-info fs-6"><i class="fa fa-refresh color-info"></i></span>
                    Karte
                </button>

                <button type="button" class="btn btn-primary me-2 mb-2 btn-sm" wire:click="toggleCreateForm">
                    <span class="btn-icon-start text-info fs-6"><i class="fa fa-plus color-info"></i></span>
                    Erstellen
                </button>

                <!-- Button zum Löschen der ausgewählten Einträge -->
                <button type="button" class="btn btn-danger me-2 mb-2 btn-sm" wire:click="deleteSelected">
                    <span class="btn-icon-start text-danger fs-6"><i class="fa fa-trash color-danger"></i></span>
                    Ausgewählte löschen
                </button>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped verticle-middle table-responsive-sm">
                    <thead>
                        <tr>
                            <!-- Select-All Checkbox -->
                            <th scope="col">
                                <input type="checkbox" wire:model="selectAll" wire:change="toggleSelectAll">
                            </th>
                            <th scope="col">Nr</th>
                            <th scope="col">Entfernung in Km</th>
                            <th scope="col">Anfahrtskosten</th>
                            <th scope="col">Anfahrt frei ab</th>
                            <th scope="col">Mindestbestellwert</th>
                            <th scope="col">Farbe</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($deliveryAreas as $key => $deliveryArea)
                            <tr>
                                <!-- Checkbox für jede Zeile -->
                                <td>
                                    <input type="checkbox" wire:model="selectedAreas" value="{{ $deliveryArea->id }}">
                                </td>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $deliveryArea->distance_km }} km</td>
                                <td>{{ $deliveryArea->delivery_cost }} €</td>
                                <td>{{ $deliveryArea->free_delivery_threshold }} €</td>
                                <td>{{ $deliveryArea->delivery_charge }} €</td>
                                <td>
                                    <div style="width: 20px; height: 20px; background-color: {{ $deliveryArea->color }};"></div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <button type="button" class="btn btn-warning shadow btn-xs sharp me-2" wire:click="editDeliveryArea({{ $deliveryArea->id }})">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <a href="#" class="btn btn-danger shadow btn-xs sharp" wire:click="deleteDeliveryArea({{ $deliveryArea->id }})"><i class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Formular zum Hinzufügen von Liefergebieten -->
            @if($createFormVisible)
                <form wire:submit.prevent="createDeliveryAreas">
                    <div class="mb-3">
                        <label for="max_distance_km" class="form-label">Maximale Entfernung in Km</label>
                        <input type="number" class="form-control" wire:model="maxDistanceKm" min="1" step="1">
                        @error('maxDistanceKm') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Liefergebiet automatisch hinzufügen</button>
                </form>
            @endif

            <!-- Formular zum Bearbeiten von Liefergebieten -->
            @if($editFormVisible)
                <form wire:submit.prevent="updateDeliveryArea">
                    <div class="mb-3">
                        <label for="edit_delivery_cost" class="form-label">Anfahrtskosten</label>
                        <input type="text" class="form-control" wire:model="edit_delivery_cost">
                        @error('edit_delivery_cost') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="edit_free_delivery_threshold" class="form-label">Anfahrt frei ab</label>
                        <input type="text" class="form-control" wire:model="edit_free_delivery_threshold">
                        @error('edit_free_delivery_threshold') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="edit_delivery_charge" class="form-label">Mindestbestellwert</label>
                        <input type="text" class="form-control" wire:model="edit_delivery_charge">
                        @error('edit_delivery_charge') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="btn btn-success">Liefergebiet aktualisieren</button>
                </form>
            @endif
        </div>
    </div>
</div>

    <div id="map" style="height: 800px;"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const map = L.map('map').setView([{{ $shop->lat }}, {{ $shop->lng }}], 13);

            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            @foreach($deliveryAreas as $deliveryArea)
                L.circle([{{ $shop->lat }}, {{ $shop->lng  }}], {
                    color: '{{ $deliveryArea->color }}',
                    fillColor: '#f03',
                    fillOpacity: 0.1,
                    radius: {{ $deliveryArea->radius }}
                }).addTo(map);
            @endforeach

            const marker = L.marker([{{ $shop->lat }}, {{ $shop->lng }}]).addTo(map);
            marker.bindPopup("{{ $shop->title }}").openPopup();
        });
    </script>


@push('specific-scripts')
    @endpush
</div>
