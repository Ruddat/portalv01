<div class="col-xl-8">
    <div class="card">
        <div class="card-body">
            <form wire:submit.prevent='updateShopDataDetails()'>
            <div class="bacic-info mb-3">
                <h4 class="mb-3">{{ app(\App\Services\TranslationService::class)->trans('Basic Shopinfo - Impressum', app()->getLocale()) }} {{ $shop->title }}</h4>

                @if(session()->has('success_message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                        <path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path>
                    </svg>
                    <strong>Done!</strong> {{ session('success_message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

                <form wire:submit.prevent='updateShopDataDetails()'>

                    <div class="row">
                        <div class="col-xl-12">
                            <label class="form-label">Shop Name</label>
                            <input wire:model.live="shop_name" type="text" wire:model="shop_name" class="form-control mb-3" placeholder="Shop Name">
                            @error('shop_name') <!-- Hier wird überprüft, ob ein Validierungsfehler für das Feld "shop_owner" vorliegt -->
                            <span class="text-danger">{{ $message }}</span> <!-- Anzeige des Validierungsfehlers -->
                            @enderror
                        </div>


                    <div class="col-xl-12">
                        <label  class="form-label">{{ app(\App\Services\TranslationService::class)->trans('Street and Housenumber', app()->getLocale()) }}</label>
                        <input wire:model.live="shop_street" type="text" wire:model="shop_street" class="form-control mb-3" placeholder="Street & Number">
                        @error('shop_street') <!-- Hier wird überprüft, ob ein Validierungsfehler für das Feld "shop_owner" vorliegt -->
                        <span class="text-danger">{{ $message }}</span> <!-- Anzeige des Validierungsfehlers -->
                        @enderror
                    </div>

                    <div class="col-xl-4">
                        <label  class="form-label">Zip Code</label>
                        <input wire:model.live="shop_zip" type="text" wire:model="shop_zip" class="form-control mb-3" placeholder="Shop Zip">
                        @error('shop_zip') <!-- Hier wird überprüft, ob ein Validierungsfehler für das Feld "shop_owner" vorliegt -->
                        <span class="text-danger">{{ $message }}</span> <!-- Anzeige des Validierungsfehlers -->
                        @enderror
                    </div>

                    <div class="col-xl-8">
                        <label  class="form-label">City / Location</label>
                        <input wire:model.live="shop_city" type="text" wire:model="shop_city" class="form-control mb-3" placeholder="Shop City">
                        @error('shop_city') <!-- Hier wird überprüft, ob ein Validierungsfehler für das Feld "shop_owner" vorliegt -->
                        <span class="text-danger">{{ $message }}</span> <!-- Anzeige des Validierungsfehlers -->
                        @enderror
                    </div>



                    <div class="col-xl-6">
                        <label  class="form-label">Phonenumber</label>
                        <input wire:model.live="shop_phone" type="text" wire:model="shop_phone" class="form-control mb-3" placeholder="Phonenumber">
                        @error('shop_phone') <!-- Hier wird überprüft, ob ein Validierungsfehler für das Feld "shop_owner" vorliegt -->
                        <span class="text-danger">{{ $message }}</span> <!-- Anzeige des Validierungsfehlers -->
                        @enderror
                    </div>
                    <div class="col-xl-6">
                        <label  class="form-label">Order Email Address</label>
                        <input wire:model.live="shop_email" type="text" wire:model="shop_email" class="form-control mb-3" placeholder="ordanico@mail.com">
                        @error('shop_email') <!-- Hier wird überprüft, ob ein Validierungsfehler für das Feld "shop_owner" vorliegt -->
                        <span class="text-danger">{{ $message }}</span> <!-- Anzeige des Validierungsfehlers -->
                        @enderror
                    </div>

                    <div class="col-xl-6">
                        <label  class="form-label">Owner</label>
                        <input wire:model.live="shop_owner" type="text" wire:model="shop_owner" class="form-control mb-3" placeholder="Owner">
                        @error('shop_owner') <!-- Hier wird überprüft, ob ein Validierungsfehler für das Feld "shop_owner" vorliegt -->
                        <span class="text-danger">{{ $message }}</span> <!-- Anzeige des Validierungsfehlers -->
                        @enderror
                    </div>
                    <div class="col-xl-6">
                        <label  class="form-label">tax ID</label>
                        <input wire:model.live="shop_extra_contacts" type="text" wire:model="shop_extra_contacts" class="form-control mb-3" placeholder="tax ID">
                        @error('shop_extra_contacts') <!-- Hier wird überprüft, ob ein Validierungsfehler für das Feld "shop_owner" vorliegt -->
                        <span class="text-danger">{{ $message }}</span> <!-- Anzeige des Validierungsfehlers -->
                        @enderror
                    </div>

                </div>
            </div>
            <div class="exernal-links mb-3">
                <h4 class="mb-3">External links</h4>
                <p>optional</p>
                <div class="row">
                    <div class="col-xl-12">
                        <label  class="form-label">Facebook URL</label>
                        <input type="text" class="form-control mb-3"  placeholder="Past your link here">
                    </div>
                    <div class="col-xl-12">
                        <label  class="form-label">Twitter URL</label>
                        <input type="text" class="form-control mb-3"  placeholder="Past your link here">
                    </div>
                    <div class="col-xl-12">
                        <label  class="form-label">Instagram URL</label>
                        <input type="text" class="form-control mb-3"  placeholder="Past your link here">
                    </div>
                    <div class="col-xl-12">
                        <label  class="form-label">Youtube Channel URL</label>
                        <input type="text" class="form-control mb-3"  placeholder="Past your link here">
                    </div>
                    <div class="col-xl-12">
                        <label  class="form-label">TikTok URL</label>
                        <input type="text" class="form-control mb-3"  placeholder="Past your link here">
                    </div>
                    <div class="col-xl-12">
                        <label  class="form-label">WathsUp Number</label>
                        <input type="text" class="form-control mb-3"  placeholder="Past your link here">
                    </div>
                </div>
            </div>
            <div class="Security">
                <div class="row">
                    <div class="col-xl-12">
                        <button class="btn btn-primary float-end">Save</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>



<!-- JavaScript-Code, um zum Erfolgsmeldungsbereich zu scrollen -->
<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('scroll-to-success', () => {
            // Den Bereich mit der Erfolgsmeldung auswählen und zum oberen Teil des Bildschirms scrollen
            const successMessage = document.querySelector('.alert-success');
            if (successMessage) {
                successMessage.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
</script>
