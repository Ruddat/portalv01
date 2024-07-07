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
                                    <button class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></button>
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
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
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
                        <input class="form-check-input" type="checkbox" id="categories" wire:model="copyOptions.categories" checked>
                        <label class="form-check-label" for="categories">Categories</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="products" wire:model="copyOptions.products" checked>
                        <label class="form-check-label" for="products">Produkte</label>
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




@push('specific-scripts')

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('openCopyModal', (event) => {
           $('#copyModal').modal('show');
       });

       Livewire.on('openDeleteConfirmationModal', (event) => {
           $('#deleteConfirmationModal').modal('show');
       });

       // Event für das Schließen des Modals
       $('#copyModal').on('hidden.bs.modal', function () {
           Livewire.dispatch('closeCopyModal');
       });

       $('#deleteConfirmationModal').on('data-bs-dismiss="modal', function () {
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
