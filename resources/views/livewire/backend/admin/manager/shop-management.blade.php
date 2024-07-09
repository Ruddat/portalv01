<!-- resources/views/livewire/backend/admin/manager/shop-management.blade.php -->
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Shop Management</h4>
            <div class="d-flex justify-content-between">
                <input type="text" wire:model.live="search" class="form-control w-50" placeholder="Search...">
                <select wire:model.lazy="perPage" class="form-control w-25">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="999999">All</option>
                </select>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table header-border table-hover verticle-middle">
                    <thead>
                        <tr>
                            <th scope="col">Nr</th>
                            <th scope="col">Shopname</th>
                            <th scope="col">Progress</th>
                            <th scope="col" wire:click="sortBy('created_at')" style="cursor:pointer;">
                                Datum
                                @if($sortField === 'created_at')
                                    <i class="fa fa-{{ $sortDirection === 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                @endif
                            </th>
                            <th scope="col">Status</th>
                            <th scope="col">Online</th>
                            <th scope="col">Aktion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($shops as $shop)
                            @php
                                $rowClass = '';
                                if ($status[$shop->id] === 'closed') {
                                    $rowClass = 'table-row-closed';
                                } elseif ($status[$shop->id] === 'limited') {
                                    $rowClass = 'table-row-limited';
                                }
                            @endphp
                            <tr class="{{ $rowClass }}">
                                <td>{{ $shop->shop_nr }}</td>
                                <td>{{ $shop->title }}</td>
                                <td>
                                    <div class="progress" style="background: rgba(127, 99, 244, .1)">
                                        <div class="progress-bar" style="width: {{ $shop->progress }}%;" role="progressbar">
                                            <span class="sr-only">{{ $shop->progress }}% Complete</span>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $shop->created_at->format('d.m.Y') }}</td>
                                <td>
                                    <select wire:model="status.{{ $shop->id }}" wire:change="changeStatus({{ $shop->id }})" class="form-control">
                                        <option value="on">on</option>
                                        <option value="off">off</option>
                                        <option value="closed">closed</option>
                                        <option value="limited">limited</option>
                                    </select>
                                </td>
                                <td>
                                    <span wire:click="toggleOnline({{ $shop->id }})" class="badge {{ $onlineStatus[$shop->id] ? 'badge-success' : 'badge-danger' }}">
                                        {{ $onlineStatus[$shop->id] ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <button wire:click="openEditModal({{ $shop->id }})" class="btn btn-primary shadow btn-xs sharp me-1">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                    <button wire:click="openCopyModal({{ $shop->id }})" class="btn btn-secondary shadow btn-xs sharp me-1"><i class="fa fa-copy"></i></button>
                                    <button wire:click="confirmDeletion({{ $shop->id }})" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $shops->links() }}
            </div>
        </div>
    </div>


<!-- Copy Modal -->
<div wire:ignore.self class="modal fade" id="copyModal" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <h5 class="modal-title" id="copyModalLabel">Shop kopieren</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="shopData" wire:model="copyOptions.shopData" checked>
                        <label class="form-check-label" for="shopData">Shopdaten</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="openingHours" wire:model="copyOptions.openingHours" checked>
                        <label class="form-check-label" for="openingHours">Öffnungszeiten</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="deliveryArea" wire:model="copyOptions.deliveryArea" checked>
                        <label class="form-check-label" for="deliveryArea">Liefergebiet</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="articles" wire:model="copyOptions.articles" checked>
                        <label class="form-check-label" for="articles">Products, Categories, Sizes, Ingredients</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="orders" wire:model="copyOptions.orders" checked>
                        <label class="form-check-label" for="orders">Bestellungen</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="votes" wire:model="copyOptions.votes" checked>
                        <label class="form-check-label" for="votes">Bewertungen</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light btn-sm" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary btn-sm" wire:click="copyShopConfirmed">Copy Shop</button>
            </div>
        </div>
    </div>
</div>


<!-- Delete Confirmation Modal -->
<div wire:ignore.self class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationModalLabel">Shop löschen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Sind Sie sicher, dass Sie diesen Shop löschen möchten? Diese Aktion kann nicht rückgängig gemacht werden.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
                <button type="button" class="btn btn-danger" wire:click="deleteShopConfirmed">Löschen</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div wire:ignore.self class="modal fade" id="editShopModal" tabindex="-1" aria-labelledby="editShopModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editShopModalLabel">Shop bearbeiten</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- row -->
                <div class="row">
                    <div class="col-xl-6 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Shopdata</h4>
                            </div>

                            @php
                            //    dd($this->shop);
                            @endphp
                            <div class="card-body">
                                <div class="basic-form">
                                        <div class="mb-3">
                                            <label for="shopTitle" class="form-label">Shoptitel</label>
                                            <input type="text" class="form-control" id="shopTitle" wire:model="shop.title">
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-8">
                                                <label class="form-label">Street</label>
                                                <input type="text" wire:model="shopedit.street" value="{{ $shopedit->street }}" class="form-control" placeholder="Street">
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label class="form-label">Housenumber</label>
                                                <input type="text" wire:model="shop.street_nr" class="form-control" placeholder="Housenumber">
                                            </div>
                                            <div class="mb-3 col-md-8">
                                                <label class="form-label">City</label>
                                                <input type="text" wire:model="shop.city" class="form-control" placeholder="City">
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label>Zip</label>
                                                <input type="text" wire:model="shop.zip" class="form-control" placeholder="Zip">
                                            </div>
                                            <div class="mb-3 col-md-12">
                                                <label>Email</label>
                                                <input type="email" wire:model="shop.email" class="form-control" placeholder="email">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Longitude</label>
                                                <input type="text" wire:model="shop.longitude" class="form-control" disabled>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Latitude</label>
                                                <input type="text" wire:model="shop.latitude" class="form-control" disabled>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Settings</h4>
                            </div>
                            <div class="card-body">
                                    <div class="input-group mb-3">
                                        <div class="input-group-text">
                                            <div class="form-check custom-checkbox">
                                                <input type="checkbox" wire:model="shop.show_logo" class="form-check-input">
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Portallogo über dem Warenkorb anzeigen" disabled>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-text">
                                            <div class="form-check custom-checkbox">
                                                <input type="checkbox" wire:model="shop.allow_ratings" class="form-check-input">
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Kann die Bestellung bewertet werden" disabled>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-text">
                                            <div class="form-check custom-checkbox">
                                                <input type="checkbox" wire:model="shop.no_pickup" class="form-check-input">
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Keine Selbstabholung" disabled>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-text">
                                            <div class="form-check custom-checkbox">
                                                <input type="checkbox" wire:model="shop.is_active" class="form-check-input">
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Shop ist aktiv und online" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Shop Status (select one):</label>
                                        <select wire:model="status.{{ $shopedit->id }}" wire:change="changeStatus({{ $shopedit->id }})" class="form-control">
                                            <option value="on">on</option>
                                            <option value="off">off</option>
                                            <option value="closed">closed</option>
                                            <option value="limited">limited</option>
                                        </select>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Vertragsdaten</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Kundennummer</label>
                                            <input type="text" wire:model="shop.customer_number" class="form-control" value="{{ $shop->shop_nr }}" placeholder="Kundennummer" disabled>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Grundgebühr/Monat (Euro)</label>
                                                <input type="text" wire:model="shop.monthly_fee" class="form-control" placeholder="Grundgebühr/Monat optional">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Pro Umsatz %</label>
                                                <input type="text" wire:model="shop.sales_percentage" class="form-control" placeholder="Pro Umsatz %">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Pro Bestellung (Euro)</label>
                                                <input type="text" wire:model="shop.per_order_fee" class="form-control" placeholder="optional / falls Kunde pro Bestellung abgerechnet wird">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label>Kosten SMS (Euro)</label>
                                                <input type="text" wire:model="shop.sms_fee" class="form-control" placeholder="optional / Preis der bei Notfall SMS berechnet wird">
                                            </div>
                                            <div class="mb-3 col-md-12">
                                                <label>Einrichtungsgebühr (Euro):</label>
                                                <input type="text" wire:model="shop.setup_fee" class="form-control" placeholder="optional / falls Kunde eine einmalig ein Einrichtungsgebühr bezahlen muss">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">eMail - Bestellungen:</label>
                                                <input type="email" wire:model="shop.order_email" class="form-control" placeholder="falls die Bestellungen per eMail übermittelt werden sollen, hier eMail-Adresse dafür eintragen.">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Handynr. für SMS</label>
                                                <input type="text" wire:model="shop.sms_number" class="form-control" placeholder="optional / falls die Bestellübermittlung fehlschlägt, Alarm-SMS">
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Shop des Verkäufers</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                        <div class="row align-items-center">
                                            <div class="col-auto my-1">
                                                <label class="me-sm-2">Shop zuweisen</label>
                                                <select wire:model="shop.seller_shop" class="me-sm-2 default-select form-control wide ms-0">
                                                    <option selected>Choose...</option>
                                                    @foreach($sellerShops as $sellerShop)
                                                        <option value="{{ $sellerShop->id }}">{{ $sellerShop->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- row -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
                <button type="button" class="btn btn-primary" wire:click="updateShop">Speichern</button>
            </div>
        </div>
    </div>
</div>


@push('specific-scripts')

<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('openCopyModal', () => {
            $('#copyModal').modal('show');
        });

        Livewire.on('openEditModal', () => {
            $('#editShopModal').modal('show');
        });

        Livewire.on('openDeleteConfirmationModal', () => {
            $('#deleteConfirmationModal').modal('show');
        });

        // Events for closing the modals
        $('#copyModal').on('hidden.bs.modal', function () {
            Livewire.dispatch('closeCopyModal');
        });

        $('#editShopModal').on('hidden.bs.modal', function () {
            Livewire.dispatch('closeEditModal');
        });

        $('#deleteConfirmationModal').on('hidden.bs.modal', function () {
            Livewire.dispatch('closeDeleteConfirmationModal');
        });
    });
</script>

@endpush


<style>
    .table-row-closed {
    background-color: #f8d7da;
    text-decoration: line-through;
}
.table-row-limited {
    background-color: #fff3cd;
}

</style>
</div>
