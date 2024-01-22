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
                <!-- Eingabefelder hier mit wire:model binden -->
                <input type="text" wire:model="newShop.title">
                <input type="email" wire:model="newShop.email">
                <!-- Weitere Eingabefelder hier, falls vorhanden -->


<div style="text-align: center; padding: 10px;">
    <h4>Shopdata</h4>
    <hr>
</div>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="mb-3 row">
                            <label class="col-lg-4 col-form-label" for="validationCustom01">Username
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="validationCustom01" placeholder="Enter a username.." required="">
                                <div class="invalid-feedback">
                                    Please enter a username.
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-lg-4 col-form-label" for="validationCustom02">Email <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="validationCustom02" placeholder="Your valid email.." required="">
                                <div class="invalid-feedback">
                                    Please enter a Email.
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-lg-4 col-form-label" for="validationCustom03">Password
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="password" class="form-control" id="validationCustom03" placeholder="Choose a safe one.." required="">
                                <div class="invalid-feedback">
                                    Please enter a password.
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-lg-4 col-form-label" for="validationCustom04">Suggestions <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <textarea class="form-control h-auto" id="validationCustom04" rows="5" placeholder="What would you like to see?" required=""></textarea>
                                <div class="invalid-feedback">
                                    Please enter a Suggestions.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="mb-3 row">
                            <label class="col-lg-4 col-form-label" for="validationCustom05">Best Skill
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <select class="default-select wide form-control ms-0" id="validationCustom05" style="display: none;">
                                    <option data-display="Select">Please select</option>
                                    <option value="html">HTML</option>
                                    <option value="css">CSS</option>
                                    <option value="javascript">JavaScript</option>
                                    <option value="angular">Angular</option>
                                    <option value="angular">React</option>
                                    <option value="vuejs">Vue.js</option>
                                    <option value="ruby">Ruby</option>
                                    <option value="php">PHP</option>
                                    <option value="asp">ASP.NET</option>
                                    <option value="python">Python</option>
                                    <option value="mysql">MySQL</option>
                                </select><div class="nice-select default-select wide form-control ms-0" tabindex="0"><span class="current">Select</span><ul class="list"><li data-value="Please select" data-display="Select" class="option selected">Please select</li><li data-value="html" class="option">HTML</li><li data-value="css" class="option">CSS</li><li data-value="javascript" class="option">JavaScript</li><li data-value="angular" class="option">Angular</li><li data-value="angular" class="option">React</li><li data-value="vuejs" class="option">Vue.js</li><li data-value="ruby" class="option">Ruby</li><li data-value="php" class="option">PHP</li><li data-value="asp" class="option">ASP.NET</li><li data-value="python" class="option">Python</li><li data-value="mysql" class="option">MySQL</li></ul></div>
                                <div class="invalid-feedback">
                                    Please select a one.
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-lg-4 col-form-label" for="validationCustom06">Currency
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="validationCustom06" placeholder="$21.60" required="">
                                <div class="invalid-feedback">
                                    Please enter a Currency.
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-lg-4 col-form-label" for="validationCustom07">Website
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="validationCustom07" placeholder="http://example.com" required="">
                                <div class="invalid-feedback">
                                    Please enter a url.
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-lg-4 col-form-label" for="validationCustom08">Phone (US)
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="validationCustom08" placeholder="212-999-0000" required="">
                                <div class="invalid-feedback">
                                    Please enter a phone no.
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-lg-4 col-form-label" for="validationCustom09">Digits <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="validationCustom09" placeholder="5" required="">
                                <div class="invalid-feedback">
                                    Please enter a digits.
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-lg-4 col-form-label" for="validationCustom10">Number <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="validationCustom10" placeholder="5.0" required="">
                                <div class="invalid-feedback">
                                    Please enter a num.
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-lg-4 col-form-label" for="validationCustom11">Range [1, 5]
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="validationCustom11" placeholder="4" required="">
                                <div class="invalid-feedback">
                                    Please select a range.
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-lg-4 col-form-label"><a href="javascript:void()">Terms &amp; Conditions</a> <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-8">
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="" id="validationCustom12" required="">
                                  <label class="form-check-label" for="validationCustom12">
                                    Agree to terms and conditions
                                  </label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-lg-8 ms-auto">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>



                <div style="text-align: center; padding: 10px;">
                    <h4>Vertragsdaten</h4>
                    <hr>
                </div>


                <div style="text-align: center; padding: 10px;">
                    <h4>Kundendaten</h4>
                    <hr>
                </div>


                <div style="text-align: center; padding: 10px;">
                    <h4>Einstellungen</h4>
                    <hr>
                </div>




                <div class="col-xl-4 col-xxl-6 col-6">
                    <div class="form-check custom-checkbox mb-3">
                        <input type="checkbox" class="form-check-input" id="customCheckBox1" required>
                        <label class="form-check-label" for="customCheckBox1">Bewertungen</label>
                    </div>
                    <label>* optional / hier wird die Übertragungsart eingestellt</label>
                </div>
                <div class="col-xl-4 col-xxl-6 col-6">
                    <div class="form-check custom-checkbox mb-3 checkbox-info">
                        <input type="checkbox" class="form-check-input" checked id="customCheckBox2" required>
                        <label class="form-check-label" for="customCheckBox2">Portallogo</label>
                    </div>
                    <label>* optional / hier wird die Übertragungsart eingestellt</label>
                </div>
                <div class="col-xl-4 col-xxl-6 col-6">
                    <div class="form-check custom-checkbox mb-3 checkbox-success">
                        <input type="checkbox" class="form-check-input" checked id="customCheckBox3" required>
                        <label class="form-check-label" for="customCheckBox3">Shop logo</label>

                    </div>
                    <label>* optional / hier wird die Übertragungsart eingestellt</label>
                </div>

                <div class="mb-3">
                    <select class="default-select form-control wide mb-3 form-control-lg ms-0">
                        <option>Option 1</option>
                        <option>Option 2</option>
                        <option>Option 3</option>
                    </select>
                    <label>* optional / hier wird die Übertragungsart eingestellt</label>

                    </div>


                <div style="text-align: center; padding: 10px;">
                    <h4>Domains</h4>
                    <hr>
                </div>
                <div class="input-group mb-3  input-success">
                    <span class="input-group-text border-0">https://example.com</span>
                    <input type="text" class="form-control">
                </div>
                <label>* optional / Backlink falls Kunde von seiner eigenen Webseite verlinkt</label>

                <div style="text-align: center; padding: 10px;">
                    <h4>Andere</h4>
                    <hr>
                </div>


<hr>
                <button type="submit">Speichern</button>
                <button wire:click="cancelCreateForm">Abbrechen</button>

                <button type="button" class="btn btn-secondary" wire:click="cancelCreateForm">Cancel</button>

            </form>





            @endif


            </div>
        </div>
    </div>




@push('specific-scripts')

@endpush
