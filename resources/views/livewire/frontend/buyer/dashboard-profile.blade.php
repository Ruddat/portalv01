<div>

    <main>
        @include('frontend.includes.header-in-clearfix')
        @include('layouts.partials.dashboard-header', ['client' => $client])

        <!-- /page_header -->

        <div class="container margin_60_20">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">



                        <div class="container-xl px-4 mt-4">

                            @include('layouts.partials.profile-navigation')

                            <hr class="mt-0 mb-4">
                            <div class="row">
                                <div class="col-xl-4">
                                    <!-- Profile picture card-->
                                    <div class="card mb-4 mb-xl-0">
                                        <div class="card-header">@autotranslate('Profile Picture', app()->getLocale())</div>
                                        <div class="card-body text-center">
                                            <!-- Profile picture image-->
                                            <img class="img-account-profile rounded-circle mb-2" src="{{ $client->avatar }}" alt="">
                                            <!-- Profile picture help block-->
                                            <!-- Additional avatar generation buttons -->
                                            <button class="btn_1 gray mb-2" type="button" wire:click="generateAvatar('avatar_api')">@autotranslate('Generate Funny Avatar', app()->getLocale())</button>
                                            <button class="btn_1 gray mb-2" type="button" wire:click="generateAvatar('avatar_helper')">@autotranslate('Generate Simple Avatar', app()->getLocale())</button>
                                            <button class="btn_1 gray mb-2" type="button" wire:click="generateAvatar('cool_avatar')">@autotranslate('Generate Robot Avatar', app()->getLocale())</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-8">
                                    <!-- Account details card-->
                                    <div class="card mb-4">
                                        <div class="card-header">@autotranslate('Account Details', app()->getLocale())</div>
                                        <div class="card-body">

                                            @if ($errors->any())
                                            <div class="alert alert-danger" role="alert">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ app(\App\Services\AutoTranslationService::class)->trans($error, app()->getLocale()) }}</li>

                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                            <form wire:submit.prevent="saveChanges">
                                                <!-- Form Group (username)-->
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="inputUsername">@autotranslate('Username (how your name will appear to other users on the site)', app()->getLocale()) </label>
                                                    <div class="input-group">
                                                        <input class="form-control @error('client.username') is-invalid @enderror" id="client.username" type="text" placeholder="Enter your username" wire:model.defer="username">
                                                        <button class="btn btn-secondary" type="button" wire:click="generateUsername">Generate</button>
                                                    </div>
                                                </div>
                                                <!-- Form Row-->
                                                <div class="row gx-3 mb-3">
                                                    <!-- Form Group (first name)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="inputFirstName">First name</label>
                                                        <input class="form-control @error('client.name') is-invalid @enderror" id="inputFirstName" type="text" wire:model="name" placeholder="Enter your first name">

                                                    </div>
                                                   <!-- Form Group (last name)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="inputLastName">Last name</label>
                                                        <input class="form-control @error('client.last_name') is-invalid @enderror" id="inputLastName" type="text" wire:model="last_name" placeholder="Enter your last name">

                                                    </div>
                                                </div>
                                                <!-- Form Row-->
                                                <div class="row gx-3 mb-3">
                                                    <!-- Form Group (organization name)-->
                                                    <div class="col-md-12">
                                                        <label class="small mb-1" for="inputOrgName">Organization name</label>
                                                        <input class="form-control @error('client.organization_name') is-invalid @enderror" id="inputOrgName" type="text" wire:model="organization_name" placeholder="Enter your organization name">

                                                    </div>
                                                    <!-- Form Group (shipping street)-->
                                                    <div class="col-md-8">
                                                        <label class="small mb-1" for="inputShippingStreet">Street</label>
                                                        <input class="form-control @error('client.shipping_street') is-invalid @enderror" id="inputShippingStreet" type="text" wire:model="shipping_street" placeholder="Enter your Street">

                                                    </div>
                                                    <!-- Form Group (shipping house number)-->
                                                    <div class="col-md-4">
                                                        <label class="small mb-1" for="inputShippingHouseNo">Number</label>
                                                        <input class="form-control @error('client.shipping_house_no') is-invalid @enderror" id="inputShippingHouseNo" type="text" wire:model="shipping_house_no" placeholder="House Number">

                                                    </div>
                                                    <!-- Form Group (postal code)-->
                                                    <div class="col-md-4">
                                                        <label class="small mb-1" for="inputPostalCode">Zip</label>
                                                        <input class="form-control @error('postal_code') is-invalid @enderror" id="inputPostalCode" type="text" wire:model="postal_code" placeholder="Enter your Zip">

                                                    </div>
                                                    <!-- Form Group (city)-->
                                                    <div class="col-md-8">
                                                        <label class="small mb-1" for="inputCity">City</label>
                                                        <input class="form-control @error('city') is-invalid @enderror" id="inputCity" type="text" wire:model="city" placeholder="City">

                                                    </div>
                                                </div>
                                                <!-- Form Group (email address)-->
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                                    <input class="form-control @error('email') is-invalid @enderror" id="inputEmailAddress" type="email" wire:model="email" placeholder="Enter your email address" disabled>

                                                </div>
                                                <!-- Form Row-->
                                                <div class="row gx-3 mb-3">
                                                    <!-- Form Group (phone number)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="inputPhone">Phone number</label>
                                                        <input class="form-control @error('phone') is-invalid @enderror" id="inputPhone" type="tel" wire:model="phone" placeholder="Enter your phone number">

                                                    </div>
                                                    <!-- Form Group (birthday)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="inputBirthday">Birthday (optional for Birthday Coupons)</label>
                                                        <input class="form-control @error('client.birthday') is-invalid @enderror" id="inputBirthday" type="text" wire:model="birthday" placeholder="Enter your birthday">

                                                    </div>
                                                </div>
                                                <!-- Save changes button-->
                                                <button class="btn_1 medium gradient pulse_bt mt-2" type="submit">Save changes</button>
                                            </form>
                                            <!-- Erfolgs- und Fehlermeldungen -->
                                            @if (session()->has('message'))
                                                <div class="alert alert-success d-flex align-items-center mt-3" role="alert">{{ session('message') }}
                                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                                                </div>
                                            @endif
                                            @if (session()->has('error'))
                                                <div class="alert alert-danger mt-3">{{ session('error') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>




                            </div>
                        </div>

                    </div>
                    <!-- /row -->
                </div>
                <!-- /col -->

                @include('layouts.partials.dashboard-links', ['client' => $client])

            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </main>




</div>
