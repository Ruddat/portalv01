<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Restaurant Partner</h4>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                @if (!$showCreateForm)
                <div class="mb-3">
                    <div class="input-group">
                        <input wire:model.debounce.100ms="search" wire:input="refreshTable" type="text" class="form-control" placeholder="Search...">
                        <button type="button" class="btn btn-primary" wire:click="toggleCreateForm">
                            <span class="btn-icon-start text-info"><i class="fa fa-plus color-info"></i></span>
                            Create New Shop
                        </button>

                    </div>
                </div>
                <div>



















                <table class="table table-responsive-md">
                    @if ($modshop->count())
                    <thead>
                        <tr>
                            <th wire:click="sortBy('shop_nr')" style="cursor: pointer;">
                                <strong>
                                    KUNDENNUMMER
                                    @if($orderBy === 'shop_nr')
                                        @if($orderAsc)
                                            <i class="fa fa-arrow-up"></i>
                                        @else
                                            <i class="fa fa-arrow-down"></i>
                                        @endif
                                    @endif
                                </strong>
                            </th>

                            <th wire:click="sortBy('title')" style="cursor: pointer;">
                                <strong>
                                    SHOPNAME
                                    @if($orderBy === 'title')
                                        @if($orderAsc)
                                            <i class="fa fa-arrow-up"></i>
                                        @else
                                            <i class="fa fa-arrow-down"></i>
                                        @endif
                                    @endif
                                </strong>
                            </th>

                            <th><strong>PROGRESS</strong></th>

                            <th wire:click="sortBy('created_at')" style="cursor: pointer;">
                                <strong>
                                    DATE
                                    @if($orderBy === 'created_at')
                                        @if($orderAsc)
                                            <i class="fa fa-arrow-up"></i>
                                        @else
                                            <i class="fa fa-arrow-down"></i>
                                        @endif
                                    @endif
                                </strong>
                            </th>

                            <th wire:click="sortBy('status')" style="cursor: pointer;">
                                <strong>
                                    STATUS
                                    @if($orderBy === 'status')
                                        @if($orderAsc)
                                            <i class="fa fa-arrow-up"></i>
                                        @else
                                            <i class="fa fa-arrow-down"></i>
                                        @endif
                                    @endif
                                </strong>
                            </th>

                            <th wire:click="sortBy('published')" style="cursor: pointer;">
                                <strong>
                                    ONLINE
                                    @if($orderBy === 'published')
                                        @if($orderAsc)
                                            <i class="fa fa-arrow-up"></i>
                                        @else
                                            <i class="fa fa-arrow-down"></i>
                                        @endif
                                    @endif
                                </strong>
                            </th>


                            <th><strong>ACTION</strong></th>
                            <th><strong></strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($modshop as $shop)
                        <tr>

                            <td><strong>#{{ $shop->shop_nr }}</strong></td>
                            <td><div class="d-flex align-items-center"><img src="{{ asset('backend/images/avatar/1.jpg') }}" class="rounded-lg me-2" width="24" alt=""> <span class="w-space-no">{{ $shop->title }}</span></div></td>
                            <td>
                                <div class="progress" style="background: rgba(127, 99, 244, .1)">
                                    <div class="progress-bar bg-primary" style="width: 70%;" role="progressbar"><span class="sr-only">70% Complete</span>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $shop->created_at->format('j F Y') }}</td>
                            <td>
                                @if($shop->status == 'on')
                                    <span class="d-flex align-items-center">
                                        <i class="fa fa-circle text-success me-1"></i>
                                        {{ $shop->status }}
                                    </span>
                                @elseif($shop->status == 'off')
                                    <span class="d-flex align-items-center">
                                        <i class="fa fa-circle text-danger me-1"></i>
                                        {{ $shop->status }}
                                    </span>
                                @elseif($shop->status == 'limited')
                                    <span class="d-flex align-items-center">
                                        <i class="fa fa-circle text-warning me-1"></i>
                                        {{ $shop->status }}
                                    </span>
                                @elseif($shop->status == 'closed')
                                    <span class="d-flex align-items-center">
                                        <i class="fa fa-circle text-danger me-1"></i>
                                        {{ $shop->status }}
                                    </span>
                                @else
                                    <span class="d-flex align-items-center">
                                        <i class="fa fa-circle text-secondary me-1"></i>
                                        {{ $shop->status }}
                                    </span>
                                @endif
                            </td>

                            <td>
                                <span wire:click="toggleStatus({{ $shop->id }})" style="cursor: pointer;" class="badge light {{ $shop->published ? 'badge-success' : 'badge-secondary' }}">
                                    {{ $shop->published ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex">
                                    <a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a>
<!-- Button zum Löschen eines Geschäfts -->
<a wire:click="ShopDeletion({{ $shop->id }})" class="btn btn-danger shadow btn-xs sharp">
    <i class="fa fa-trash"></i>
</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>


                </table>
                {!! $modshop->links() !!}


                <div class="input-group">

                <p class="mt-3">
                    Showing {{ $modshop->firstItem() }} to {{ $modshop->lastItem() }} of {{ $modshop->total() }} shops
                </p>
                <div class="mb-3">
                    <label for="perPageSelect" class="form-label">Anzahl pro Seite:</label>
                    <select wire:model="perPage" wire:change="refreshTable" class="form-select" id="perPageSelect">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                </div>


                @else
                <p>Keine Ergebnisse gefunden.</p>
            @endif

            @else

            <form wire:submit.prevent="createShop">

                <div class="mb-3">
                    <label for="shop_nr" class="form-label">Kundennummer</label>
                    <input wire:model="newShop.shop_nr" type="text" class="form-control" id="shop_nr" placeholder="Kundennummer" wire:readonly="showCreateForm" onfocus="this.blur()">
                    @error('newShop.shop_nr') <span class="text-danger">{{ $message }}</span> @enderror
                </div>


                <div class="mb-3">
                    <label for="title" class="form-label">Shopname</label>
                    <input wire:model="newShop.title" type="text" class="form-control" id="title" placeholder="Shopname">
                    @error('newShop.title') <span class="text-danger">{{ $message }}</span> @enderror

                </div>

                <div class="mb-3">
                    <label for="street" class="form-label">Straße</label>
                    <input wire:model="newShop.street" type="text" class="form-control" id="street" placeholder="Straße">
                    @error('newShop.street') <span class="text-danger">{{ $message }}</span> @enderror

                </div>

                <div class="mb-3">
                    <label for="zip" class="form-label">PLZ</label>
                    <input wire:model="newShop.zip" type="text" class="form-control" id="zip" placeholder="PLZ">
                    @error('newShop.zip') <span class="text-danger">{{ $message }}</span> @enderror

                </div>

                <div class="mb-3">
                    <label for="city" class="form-label">Ort</label>
                    <input wire:model="newShop.city" type="text" class="form-control" id="city" placeholder="Ort">
                    @error('newShop.city') <span class="text-danger">{{ $message }}</span> @enderror

                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Telefon</label>
                    <input wire:model="newShop.phone" type="text" class="form-control" id="phone" placeholder="Telefon">
                    @error('newShop.phone') <span class="text-danger">{{ $message }}</span> @enderror

                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">E-Mail</label>
                    <input wire:model="newShop.email" type="text" class="form-control" id="email" placeholder="E-Mail">
                    @error('newShop.email') <span class="text-danger">{{ $message }}</span> @enderror

                </div>


                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select wire:model="newShop.status" class="form-select" id="status">
                        <option value="on" @if($this->status === 'on') selected @endif>on</option>
                        <option value="off" @if($this->status === 'off') selected @endif>off</option>
                        <option value="limited" @if($this->status === 'limited') selected @endif>limited</option>
                        <option value="closed" @if($this->status === 'closed') selected @endif>closed</option>
                    </select>
                    @error('newShop.status') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="published" class="form-label">Online</label>
                    <select wire:model="newShop.published" class="form-select" id="published">
                        <option value="1">Ja</option>
                        <option value="0">Nein</option>
                    </select>
                    @error('newShop.published') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="btn btn-primary">Speichern</button>



                <button type="button" class="btn btn-secondary" wire:click="cancelCreateForm">Kundenliste</button>

            </form>





            @endif


            </div>
        </div>
    </div>




@push('specific-scripts')

@endpush
