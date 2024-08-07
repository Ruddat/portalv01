<div>
    <main>
        @include('frontend.includes.header-in-clearfix')
        @include('layouts.partials.dashboard-header', ['client' => $client])

        <div class="container margin_60_20">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        <div class="container-xl px-4 mt-4">

                            @include('layouts.partials.profile-navigation')

                            <hr class="mt-0 mb-4">
                            <div class="row">
                                <div class="col-lg-8">
                                    <!-- Change password card-->
                                    <div class="card mb-4">
                                        <div class="card-header">@autotranslate('Change Password', app()->getLocale())</div>
                                        <div class="card-body">
                                            @if (session()->has('error'))
                                                <div class="alert alert-danger">
                                                    {{ session('error') }}
                                                </div>
                                            @endif

                                            @if (session()->has('message'))
                                                <div class="alert alert-success">
                                                    {{ session('message') }}
                                                </div>
                                            @endif
                                            <form wire:submit.prevent="changePassword">
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="currentPassword">@autotranslate('Current Password', app()->getLocale())</label>
                                                    <input wire:model.defer="currentPassword" class="form-control @error('currentPassword') is-invalid @enderror" id="currentPassword" type="password" placeholder="Enter current password">
                                                    @error('currentPassword') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="newPassword">@autotranslate('New Password', app()->getLocale())</label>
                                                    <input wire:model.defer="newPassword" class="form-control @error('newPassword') is-invalid @enderror" id="password1" type="password" placeholder="Enter new password">
                                                    @error('newPassword') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="newPassword_confirmation">@autotranslate('Confirm Password', app()->getLocale())</label>
                                                    <input wire:model.defer="newPassword_confirmation" class="form-control @error('newPassword_confirmation') is-invalid @enderror" id="password2" type="password" placeholder="Confirm new password" required>
                                                    @error('newPassword_confirmation') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                                </div>
                                                <div id="pass-info" class="clearfix"></div>

                                                <button class="btn_1 gradient small pulse_bt" type="submit">@autotranslate('Save', app()->getLocale())</button>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- Security preferences card-->
                                    <div class="card mb-4">
                                        <div class="card-header">@autotranslate('Security Preferences', app()->getLocale())</div>
                                        <div class="card-body">
                                            <!-- Account privacy optinos-->
                                            <h5 class="mb-1">@autotranslate('Account Privacy', app()->getLocale())</h5>
                                            <p class="small text-muted">@autotranslate('By setting your account to private, your profile information and posts will not be visible to users outside of your user groups.', app()->getLocale())</p>
                                            <form>
                                                <div class="form-check">
                                                    <input class="form-check-input" id="radioPrivacy1" type="radio" name="radioPrivacy">
                                                    <label class="form-check-label" for="radioPrivacy1">@autotranslate('Public (posts are available to all users)', app()->getLocale())</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" id="radioPrivacy2" type="radio" name="radioPrivacy" checked="">
                                                    <label class="form-check-label" for="radioPrivacy2">@autotranslate('Private (posts are available to only users in your groups)', app()->getLocale())</label>
                                                </div>
                                            </form>
                                            <hr class="my-4">
                                            <!-- Data sharing options-->
                                            <h5 class="mb-1">@autotranslate('Data Sharing', app()->getLocale())</h5>
                                            <p class="small text-muted">@autotranslate('Sharing usage data can help us to improve our products and better serve our users as they navigation through our application. When you agree to share usage data with us, crash reports and usage analytics will be automatically sent to our development team for investigation.', app()->getLocale())</p>
                                            <form>
                                                <div class="form-check">
                                                    <input class="form-check-input" id="radioUsage1" type="radio" name="radioUsage" checked="">
                                                    <label class="form-check-label" for="radioUsage1">@autotranslate('Yes, share data and crash reports with app developers', app()->getLocale())</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" id="radioUsage2" type="radio" name="radioUsage">
                                                    <label class="form-check-label" for="radioUsage2">@autotranslate('No, limit my data sharing with app developers', app()->getLocale())</label>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <!-- Two factor authentication card-->
                                    <div class="card mb-4">
                                        <div class="card-header">@autotranslate('Two-Factor Authentication', app()->getLocale())</div>
                                        <div class="card-body">
                                            <p>@autotranslate('Add another level of security to your account by enabling two-factor authentication. We will send you a text message to verify your login attempts on unrecognized devices and browsers.', app()->getLocale())</p>
                                            <form>
                                                <div class="form-check">
                                                    <input class="form-check-input" id="twoFactorOn" type="radio" name="twoFactor">
                                                    <label class="form-check-label" for="twoFactorOn">On</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" id="twoFactorOff" type="radio" name="twoFactor" checked="">
                                                    <label class="form-check-label" for="twoFactorOff">Off</label>
                                                </div>
                                                <div class="mt-3">
                                                    <label class="small mb-1" for="twoFactorSMS">SMS Number</label>
                                                    <input class="form-control" id="twoFactorSMS" type="tel" placeholder="Enter a phone number" value="555-123-4567">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- Delete account card-->
<!-- Delete account card-->
<div class="card mb-4">
    <div class="card-header">@autotranslate('Delete Account', app()->getLocale())</div>
    <div class="card-body">
        <p>@autotranslate('Deleting your account is a permanent action and cannot be undone. If you are sure you want to delete your account, select the button below.', app()->getLocale())</p>
        <button class="btn_1 gradient" type="button" wire:click="confirmDeleteAccount">@autotranslate('I understand, delete my account', app()->getLocale())</button>
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

    <style>
        .img-account-profile {
            height: 10rem;
        }
        .rounded-circle {
            border-radius: 50% !important.
        }
        .card {
            box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%).
        }
        .card .card-header {
            font-weight: 500.
        }
        .card-header:first-child {
            border-radius: 0.35rem 0.35rem 0 0.
        }
        .card-header {
            padding: 1rem 1.35rem.
            margin-bottom: 0.
            background-color: rgba(33, 40, 50, 0.03).
            border-bottom: 1px solid rgba(33, 40, 50, 0.125).
        }
        .form-control, .dataTable-input {
            display: block.
            width: 100%.
            padding: 0.875rem 1.125rem.
            font-size: 0.875rem.
            font-weight: 400.
            line-height: 1.
            color: #69707a.
            background-color: #fff.
            background-clip: padding-box.
            border: 1px solid #c5ccd6.
            -webkit-appearance: none.
            -moz-appearance: none.
            appearance: none.
            border-radius: 0.35rem.
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out.
        }
        .nav-borders .nav-link.active {
            color: #0061f2.
            border-bottom-color: #0061f2.
        }
        .nav-borders .nav-link {
            color: #69707a.
            border-bottom-width: 0.125rem.
            border-bottom-style: solid.
            border-bottom-color: transparent.
            padding-top: 0.5rem.
            padding-bottom: 0.5rem.
            padding-left: 0.
            padding-right: 0.
            margin-left: 1rem.
            margin-right: 1rem.
        }

        #pass-info.weakpass {
    border: 1px solid #FF9191;
    background: #FFC7C7;
    color: #94546E;
}

#pass-info.goodpass {
    border: 1px solid #C4EEC8;
    background: #E4FFE4;
    color: #51926E;
}

        #pass-info.stillweakpass {
            border: 1px solid #FBB;
            background: #FDD;
            color: #945870;
        }

        #pass-info {
            width: 100%;
            margin-bottom: 15px;
            color: #555;
            text-align: center;
            font-size: 12px;
            font-size: 0.75rem;
            padding: 5px 3px 3px 3px;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            -ms-border-radius: 3px;
            border-radius: 3px;
        }
    </style>


@push('specific-scripts')
<!-- SPECIFIC SCRIPTS -->
<script src="{{ asset('frontend/js/pw_strenght.js') }}"></script>

@endpush

</div>
