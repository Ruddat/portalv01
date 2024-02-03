<div>
    <div class="card-body">
        <div class="profile-tab">
            <div class="custom-tab-1">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a wire:click.prevent='selectTab("personal_details")' href="#personal_details" data-bs-toggle="tab" data-toggle="tab" class="nav-link {{ $tab == 'personal_details' ? 'active' : '' }}">Personal details</a>
                    </li>
                    <li class="nav-item">
                        <a wire:click.prevent='selectTab("update_password")' href="#update_password" data-bs-toggle="tab" class="nav-link {{ $tab == 'update_password' ? 'active' : '' }}">Update Password</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="personal_details" role="tabpanel" class="tab-pane fade {{ $tab == 'personal_details' ? 'show active' : '' }}">

                        <div class="pt-3">
                            <div class="settings-form">
                                <h4 class="text-primary">Account Setting</h4>
                                <form wire:submit.prevent='updateAdminPersonalDetails()'>
                                    <div class="row">
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Name</label>
                                            <input type="text" placeholder="Enter full name" class="form-control" wire:model='name'>
                                            @error('name')
                                             <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Email</label>
                                            <input type="text" placeholder="Enter email" class="form-control" wire:model='email'>
                                            @error('email')
                                             <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Username</label>
                                            <input type="text" placeholder="Enter username" class="form-control" wire:model='username'>
                                            @error('username')
                                             <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <button class="btn btn-primary" type="submit">Save changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="update_password" class="tab-pane fade {{ $tab == 'update_password' ? 'show active' : '' }}">
                        ------ update password --------------------------------

                        <div class="pt-3">
                            <div class="settings-form">
                                <h4 class="text-primary">Account Setting</h4>
                                <form>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Email</label>
                                            <input type="email" placeholder="Email" class="form-control">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Password</label>
                                            <input type="password" placeholder="Password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Address</label>
                                        <input type="text" placeholder="1234 Main St" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Address 2</label>
                                        <input type="text" placeholder="Apartment, studio, or floor" class="form-control">
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">City</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">State</label>
                                            <select class="form-select" aria-label="Default select example">
                                              <option selected="">Chooose...</option>
                                              <option value="1">One</option>
                                              <option value="2">Two</option>
                                              <option value="3">Three</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-2">
                                            <label class="form-label">Zip</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check custom-checkbox">
                                            <input type="checkbox" class="form-check-input" id="gridCheck">
                                            <label class="form-check-label form-label" for="gridCheck"> Check me out</label>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary" type="submit">Sign
                                        in</button>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
