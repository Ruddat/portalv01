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
                            <!-- Account page navigation-->
                            @include('layouts.partials.profile-navigation')

                            <hr class="mt-0 mb-4">
                            <div class="row">
                                <div class="col-lg-8">
                                    <!-- Email notifications preferences card-->
                                    <div class="card card-header-actions mb-4">
                                        <div class="card-header">
                                            Email Notifications
                                            <div class="form-check form-switch">
                                                <input wire:model="email_notifications"
                                                       class="form-check-input"
                                                       id="emailNotifications"
                                                       type="checkbox"
                                                       {{ $email_notifications ? 'checked' : '' }}>
                                                <label class="form-check-label" for="emailNotifications"></label>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <form wire:submit.prevent="updateSettings">
                                                                    <!-- Form Group (default email)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputNotificationEmail">Default notification email</label>
                            <input class="form-control" id="inputNotificationEmail" type="email" value="{{ $client->email }}" disabled="">
                        </div>
                                                <!-- Form Group (email updates checkboxes)-->
                                                <div class="mb-0">
                                                    <label class="small mb-2">Choose which types of email updates you receive</label>
                                                    @foreach ([
                                                        'account_changes' => 'Changes made to your account',
                                                        'group_changes' => 'Changes are made to groups you\'re part of',
                                                        'product_updates' => 'Product updates for products you\'ve purchased or starred',
                                                        'new_products' => 'Information on new products and services',
                                                        'promotional_offers' => 'Marketing and promotional offers'
                                                    ] as $key => $label)
                                                        <div class="form-check mb-2">
                                                            <input wire:model="{{ $key }}"
                                                                   class="form-check-input"
                                                                   id="check{{ ucfirst($key) }}"
                                                                   type="checkbox"
                                                                   {{ ${$key} ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="check{{ ucfirst($key) }}">{{ $label }}</label>
                                                        </div>
                                                    @endforeach
                                                    <div class="form-check">
                                                        <input class="form-check-input" id="checkSecurity" type="checkbox" checked="" disabled="">
                                                        <label class="form-check-label" for="checkSecurity">Security alerts</label>
                                                    </div>
                                                    <button class="btn btn-primary mt-3" type="submit">Save Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- SMS push notifications card-->
                                    <div class="card card-header-actions mb-4">
                                        <div class="card-header">
                                            Push Notifications
                                            <div class="form-check form-switch">
                                                <input wire:model="push_notifications"
                                                       class="form-check-input"
                                                       id="pushNotifications"
                                                       type="checkbox"
                                                       {{ $push_notifications ? 'checked' : '' }}>
                                                <label class="form-check-label" for="pushNotifications"></label>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <form wire:submit.prevent="updateSettings">
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="inputNotificationSms">Default SMS number</label>
                                                    <input class="form-control" id="inputNotificationSms" type="tel" value="{{ $client->phone }}" disabled="">
                                                </div>
                                                <!-- Form Group (SMS updates checkboxes)-->
                                                <div class="mb-0">
                                                    <label class="small mb-2">Choose which types of push notifications you receive</label>
                                                    @foreach ([
                                                        'comment_notifications' => 'Someone comments on your post',
                                                        'share_notifications' => 'Someone shares your post',
                                                        'follow_notifications' => 'A user follows your account',
                                                        'group_post_notifications' => 'New posts are made in groups you\'re part of',
                                                        'private_message_notifications' => 'You receive a private message'
                                                    ] as $key => $label)
                                                        <div class="form-check mb-2">
                                                            <input wire:model="{{ $key }}"
                                                                   class="form-check-input"
                                                                   id="checkSms{{ ucfirst($key) }}"
                                                                   type="checkbox"
                                                                   {{ ${$key} ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="checkSms{{ ucfirst($key) }}">{{ $label }}</label>
                                                        </div>
                                                    @endforeach
                                                    <button class="btn btn-primary mt-3" type="submit">Save Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <!-- Notifications preferences card-->
                                    <div class="card">
                                        <div class="card-header">Notification Preferences</div>
                                        <div class="card-body">
                                            <form wire:submit.prevent="updateSettings">
                                                <!-- Form Group (notification preference checkboxes)-->
                                                <div class="form-check mb-2">
                                                    <input wire:model="auto_group_subscribe"
                                                           class="form-check-input"
                                                           id="checkAutoGroup"
                                                           type="checkbox"
                                                           {{ $auto_group_subscribe ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="checkAutoGroup">Automatically subscribe to group notifications</label>
                                                </div>
                                                <div class="form-check mb-3">
                                                    <input wire:model="auto_product_subscribe"
                                                           class="form-check-input"
                                                           id="checkAutoProduct"
                                                           type="checkbox"
                                                           {{ $auto_product_subscribe ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="checkAutoProduct">Automatically subscribe to new product notifications</label>
                                                </div>
                                                <!-- Submit button-->
                                                <button class="btn btn-danger" type="submit">Unsubscribe from all notifications</button>
                                            </form>
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
    border-radius: 50% !important;
}
.card {
    box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
}
.card .card-header {
    font-weight: 500;
}
.card-header:first-child {
    border-radius: 0.35rem 0.35rem 0 0;
}
.card-header {
    padding: 1rem 1.35rem;
    margin-bottom: 0;
    background-color: rgba(33, 40, 50, 0.03);
    border-bottom: 1px solid rgba(33, 40, 50, 0.125);
}
.form-control, .dataTable-input {
    display: block;
    width: 100%;
    padding: 0.875rem 1.125rem;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1;
    color: #69707a;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #c5ccd6;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.35rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.nav-borders .nav-link.active {
    color: #0061f2;
    border-bottom-color: #0061f2;
}
.nav-borders .nav-link {
    color: #69707a;
    border-bottom-width: 0.125rem;
    border-bottom-style: solid;
    border-bottom-color: transparent;
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
    padding-left: 0;
    padding-right: 0;
    margin-left: 1rem;
    margin-right: 1rem;
}
</style>



</div>
