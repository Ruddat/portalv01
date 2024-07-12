<div>
    <div class="default-tab">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a wire:click.prevent='selectTab("general_settings")'
                    class="nav-link {{ $tab == 'general_settings' ? 'active' : '' }}" data-bs-toggle="tab"
                    href="#general_settings"><i class="la la-home me-2"></i> General Settings</a>
            </li>
            <li class="nav-item">
                <a wire:click.prevent='selectTab("logo_favicon")'
                    class="nav-link {{ $tab == 'logo_favicon' ? 'active' : '' }}" data-bs-toggle="tab"
                    href="#logo_favicon"><i class="lab la-jenkins me-2"></i> Logo & Favicon</a>
            </li>
            <li class="nav-item">
                <a wire:click.prevent='selectTab("social_networks")'
                    class="nav-link {{ $tab == 'social_networks' ? 'active' : '' }}" data-bs-toggle="tab"
                    href="#social_networks"><i class="las la-users me-2"></i> Social networks</a>
            </li>
            <li class="nav-item">
                <a wire:click.prevent='selectTab("payment_methods")'
                    class="nav-link {{ $tab == 'payment_methods' ? 'active' : '' }}" data-bs-toggle="tab"
                    href="#payment_methods"><i class="las la-cash-register me-2"></i> Payment methods</a>
            </li>
            <li class="nav-item">
                <a wire:click.prevent='selectTab("seller_commissions")'
                    class="nav-link {{ $tab == 'seller_commissions' ? 'active' : '' }}" data-bs-toggle="tab"
                    href="#seller_commissions"><i class="las la-cash-register me-2"></i>Seller Commission</a>
            </li>
        </ul>


        <div class="tab-content">
            <div id="general_settings" class="tab-pane fade {{ $tab == 'general_settings' ? 'show active' : '' }}"
                role="tabpanel">
                <div class="pt-4">
                    <form wire:submit.prevent='updateGeneralSettings'
                        action="{{ route('admin.update-general-settings') }}" method="post">

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Site name</label>
                                    <input type="text" placeholder="Enter site name" class="form-control"
                                        wire:model.defer='site_name'>
                                    @error('site_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Site email</label>
                                    <input type="text" placeholder="Enter site email" class="form-control"
                                        wire:model.defer='site_email'>
                                    @error('site_email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Site phone</label>
                                    <input type="text" placeholder="Enter site phone" class="form-control"
                                        wire:model.defer='site_phone'>
                                    @error('site_phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Site meta keywords<small> Seperatet by comma
                                            (a,b,c)</small></label>
                                    <input type="text" placeholder="Enter site meta keywords" class="form-control"
                                        wire:model.defer='site_meta_keywords'>
                                    @error('site_meta_keywords')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 col-md-12">
                            <div class="form-group">
                                <label for="">Site Address (Komma = Zeilenumbruch)</label>
                                <input type="text" class="form-control" wire:model.defer='site_address'
                                    placeholder="Enter site address">
                                @error('site_address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-group">
                                <label class="form-label">Site meta description</label>
                                <textarea class="form-control h-auto" rows="8" id="comment" placeholder="Site meta desc...."
                                    wire:model.defer='site_meta_description'></textarea>
                                @error('site_meta_description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>

            <div class="tab-pane fade {{ $tab == 'logo_favicon' ? 'show active' : '' }}" id="logo_favicon"
                role="tabpanel">
                <div class="pt-4">

                    <div class="row">


                        <div class="col-md-6">
                            <h5>Site logo</h5>

                            <div class="mb-2 mt-1" style="max-width: 200px;">
                                <img wire:ignore src="" class="img-thumbnail"
                                    data-ijabo-default-img="/images/site/{{ $site_logo }}"
                                    id="site_logo_image_preview">
                            </div>
                            <form action="{{ route('admin.change-logo') }}" method="POST"
                                enctype="multipart/form-data" id="change_site_logo_form">
                                @csrf
                                <div class="mb-2">
                                    <input type="file" name="site_logo" id="site_logo" class="form-control">
                                    <span class="text-danger error-text site_logo_error"></span>
                                </div>
                                <button type="submit" class="btn btn-primary">Change logo</button>
                            </form>
                        </div>


                        <div class="col-md-6">
                            <h5>Site favicon</h5>
                            <div class="mb-2 mt-1" style="max-width: 200px;">
                                <img wire:ignore src="" class="img-thumbnail" id="site_favicon_image_preview"
                                    data-ijabo-default-img="/images/site/{{ $site_favicon }}">
                            </div>

                            <form action="{{ route('admin.change-favicon') }}" method="POST"
                                enctype="multipart/form-data" id="change_site_favicon_form">
                                @csrf
                                <div class="mb-2">
                                    <input type="file" name="site_favicon" id="site_favicon"
                                        class="form-control">
                                    <span class="text-danger error-text site_favicon_error"></span>
                                </div>

                                <button type="submit" class="btn btn-primary">Change favicon</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>



            <div class="tab-pane fade {{ $tab == 'social_networks' ? 'show active' : '' }}" id="social_networks"
                role="tabpanel">
                <div class="pt-4">

                    <form wire:submit.prevent='updateSocialNetworks'
                        action="{{ route('admin.update-social-networks') }}" method="post">


                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Facebook URL</label>
                                    <input type="text" class="form-control" wire:model.defer='facebook_url'
                                        placeholder="Enter Facebook URL">
                                    @error('facebook_url')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Twitter URL</label>
                                    <input type="text" class="form-control" wire:model.defer='twitter_url'
                                        placeholder="Enter Twitter URL">
                                    @error('twitter_url')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Instagramm URL</label>
                                    <input type="text" class="form-control" wire:model.defer='instagramm_url'
                                        placeholder="Enter Instagramm URL">
                                    @error('instagramm_url')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Linkedin URL</label>
                                    <input type="text" class="form-control" wire:model.defer='linkedin_url'
                                        placeholder="Enter Linkedin URL">
                                    @error('linkedin_url')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Printerest URL</label>
                                    <input type="text" class="form-control" wire:model.defer='printerest_url'
                                        placeholder="Enter Printerest URL">
                                    @error('printerest_url')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Youtube URL</label>
                                    <input type="text" class="form-control" wire:model.defer='youtube_url'
                                        placeholder="Enter YouTube URL">
                                    @error('youtube_url')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <div class="form-group">
                                    <label class="form-label">TikTok URL</label>
                                    <input type="text" class="form-control" wire:model.defer='tiktok_url'
                                        placeholder="Enter Tik Tok Facebook URL">
                                    @error('tiktok_url')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 col-md-4">
                                <div class="form-group">
                                    <label class="form-label">WhatsApp Number</label>
                                    <input type="text" class="form-control" wire:model.defer='whatsapp_number'
                                        placeholder="Enter WhatsApp Number">
                                    @error('whatsapp_number')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Github URL</label>
                                    <input type="text" class="form-control" wire:model.defer='github_url'
                                        placeholder="Enter GitHub URL">
                                    @error('github_url')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Telegram URL</label>
                                    <input type="text" class="form-control" wire:model.defer='telegramm_url'
                                        placeholder="Enter Telegramm URL">
                                    @error('telegram_url')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 col-md-4">
                                <div class="form-group">
                                    <label class="form-label">SnapChat URL</label>
                                    <input type="text" class="form-control" wire:model.defer='snapchat_url'
                                        placeholder="Enter SnapChat URL">
                                    @error('snapchat_url')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Twitch URL</label>
                                    <input type="text" class="form-control" wire:model.defer='twitch_url'
                                        placeholder="Enter Twitch URL">
                                    @error('twitch_url')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                 </div>
               </div>

                <div class="tab-pane fade {{ $tab == 'payment_methods' ? 'show active' : '' }}" id="payment_methods"
                    role="tabpanel">
                    <div class="pt-4">
                        ------------------- Payment Methods --------------------------------
                    </div>

                </div>

                <div class="tab-pane fade {{ $tab == 'seller_commissions' ? 'show active' : '' }}" id="seller_commissions"
                role="tabpanel">
                <div class="pt-4">
                    ------------------- seller_commissions --------------------------------
                </div>

            </div>
            </div>

        </div>
    </div>



    @push('specific-scripts')
        <script>
            document.addEventListener("livewire:init", () => {
                Livewire.on("toast", (event) => {
                    toastr[event.notify](event.message);
                });
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                window.addEventListener('updateAdminInfo', function(event) {
                    $('#adminProfileName').html(event.detail.adminName);
                    $('#adminProfileEmail').html(event.detail.adminEmail);
                });

                $('input[type="file"][name="site_logo"][id="site_logo"]').ijaboViewer({
                    preview: '#site_logo_image_preview',
                    imageShape: 'rectangular', // set square image shape
                    allowedExtensions: ['jpg', 'jpeg', 'png', 'svg'],
                    onErrorShape: function(message, element) {
                        alert(message);
                    },
                    onInvalidType: function(message, element) {
                        alert(message);
                    },
                    onSuccess: function(message, element) {
                        // Code nach erfolgreichem Hochladen
                    }
                });
            });

            // Admin-Info-Update-Handler
            window.addEventListener('updateAdminInfo', function(event) {
                $('#adminProfileName').html(event.detail.adminName);
                $('#adminProfileEmail').html(event.detail.adminEmail);
            });

            $('#change_site_logo_form').on('submit', function(e) {
                e.preventDefault();
                var form = this;
                var formdata = new FormData(form)
                var inputFileVal = $(form).find('input[type="file"][name="site_logo"]').val();

                if (inputFileVal.length > 0) {
                    $.ajax({
                        url: $(form).attr('action'),
                        method: $(form).attr('method') ||
                        'POST', // Verwende POST als Standardmethode, wenn die Methode nicht definiert ist
                        data: formdata,
                        processData: false,
                        dataType: 'json',
                        contentType: false,
                        beforeSend: function() {
                            toastr.remove(); // Hier wird die vorhandene Toast-Nachricht entfernt
                            $(form).find('span.error-text').text('');
                        },

                        success: function(response) {
                            if (response.status == 1) {
                                toastr.success(response.msg);
                                $(form)[0].reset();
                            } else {
                                toastr.error(response.msg);
                            }
                        }
                    });
                } else {

                    $(form).find('span.error-text').text(
                        'Please, select logo image file. PNG file type is recommended.')
                }

            });





















            $('input[type="file"][name="site_favicon"][id="site_favicon"]').ijaboViewer({
                preview: '#site_favicon_image_preview',
                imageShape: 'square', // set square image shape
                allowedExtensions: ['jpg', 'jpeg', 'png', 'svg', 'ico'],
                onErrorShape: function(message, element) {
                    alert(message);
                },
                onInvalidType: function(message, element) {
                    alert(message);
                },
                onSuccess: function(message, element) {
                    // Code nach erfolgreichem Hochladen
                }
            });

            // Admin-Info-Update-Handler
            window.addEventListener('updateAdminInfo', function(event) {
                $('#adminProfileName').html(event.detail.adminName);
                $('#adminProfileEmail').html(event.detail.adminEmail);
            });

            $('#change_site_favicon_form').on('submit', function(e) {
                e.preventDefault();
                var form = this;
                var formdata = new FormData(form)
                var inputFileVal = $(form).find('input[type="file"][name="site_favicon"][id="site_favicon"]').val();

                if (inputFileVal.length > 0) {
                    $.ajax({
                        url: $(form).attr('action'),
                        method: $(form).attr('method') ||
                        'POST', // Verwende POST als Standardmethode, wenn die Methode nicht definiert ist
                        data: formdata,
                        processData: false,
                        dataType: 'json',
                        contentType: false,
                        beforeSend: function() {
                            toastr.remove(); // Hier wird die vorhandene Toast-Nachricht entfernt
                            $(form).find('span.error-text').text('');
                        },

                        success: function(response) {
                            if (response.status == 1) {
                                toastr.success(response.msg);
                                $(form)[0].reset();
                            } else {
                                toastr.error(response.msg);
                            }
                        }
                    });
                } else {

                    $(form).find('span.error-text').text(
                        'Please, select logo image file. PNG file type is recommended.')
                }

            });
        </script>
    @endpush
