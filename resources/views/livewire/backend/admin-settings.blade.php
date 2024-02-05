<div>
    <div class="default-tab">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a wire:click.prevent='selectTab("general_settings")' class="nav-link {{ $tab == 'general_settings' ? 'active' : '' }}" data-bs-toggle="tab" href="#general_settings"><i class="la la-home me-2"></i> General Settings</a>
            </li>
            <li class="nav-item">
                <a wire:click.prevent='selectTab("logo_favicon")' class="nav-link {{ $tab == 'logo_favicon' ? 'active' : '' }}" data-bs-toggle="tab" href="#logo_favicon"><i class="la la-user me-2"></i> Logo & Favicon</a>
            </li>
            <li class="nav-item">
                <a wire:click.prevent='selectTab("social_networks")' class="nav-link {{ $tab == 'social_networks' ? 'active' : '' }}" data-bs-toggle="tab" href="#social_networks"><i class="la la-phone me-2"></i> Social networks</a>
            </li>
            <li class="nav-item">
                <a wire:click.prevent='selectTab("payment_methods")' class="nav-link {{ $tab == 'payment_methods' ? 'active' : '' }}" data-bs-toggle="tab" href="#payment_methods"><i class="la la-envelope me-2"></i> Payment methods</a>
            </li>
        </ul>


        <div class="tab-content">
            <div id="general_settings" class="tab-pane fade {{ $tab == 'general_settings' ? 'show active' : '' }}" role="tabpanel">
                <div class="pt-4">
                    <form wire:submit.prevent='updateGeneralSettings' action="{{ route('admin.update-general-settings') }}" method="post">

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Site name</label>
                                <input type="text" placeholder="Enter site name" class="form-control" wire:model.defer='site_name'>
                                @error('site_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Weitere col-md-4 Divs hier... -->

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Site email</label>
                                <input type="text" placeholder="Enter site email" class="form-control" wire:model.defer='site_email'>
                                @error('site_email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Hier sollte das </div> für die row-Klasse stehen -->


                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Site phone</label>
                                <input type="text" placeholder="Enter site phone" class="form-control" wire:model.defer='site_phone'>
                                @error('site_phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Weitere col-md-4 Divs hier... -->

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Site meta keywords<small> Seperatet by comma (a,b,c)</small></label>
                                <input type="text" placeholder="Enter site meta keywords" class="form-control" wire:model.defer='site_meta_keywords'>
                                @error('site_meta_keywords')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                        <div class="mb-3">
                            <label class="form-label">Site meta description</label>
                            <textarea class="form-control h-auto" rows="8" id="comment" placeholder="Site meta desc...." wire:model.defer='site_meta_description'></textarea>
                            @error('site_meta_description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>

            <div class="tab-pane fade {{ $tab == 'logo_favicon' ? 'show active' : '' }}" id="logo_favicon" role="tabpanel"  >
                <div class="pt-4">
                    <h4>This is profile title</h4>
                    <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.
                    </p>
                    <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.
                    </p>
                </div>
            </div>
            <div class="tab-pane fade {{ $tab == 'social_networks' ? 'show active' : '' }}" id="social_networks" role="tabpanel" >
                <div class="pt-4">
                    <h4>This is contact title</h4>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove.
                    </p>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove.
                    </p>
                </div>
            </div>
            <div class="tab-pane fade {{ $tab == 'payment_methods' ? 'show active' : '' }}" id="payment_methods" role="tabpanel" >
                <div class="pt-4">
                    <h4>This is message title</h4>
                    <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.
                    </p>
                    <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>


<script>
    Livewire.on('refreshComponent', function () {
        window.location.reload(); // Lade die Seite neu
    });
</script>
