@extends('frontend.layouts.default-no-footer')
@section('content')
    <!-- seitenabhängig css -->
    @push('specific-css')
        <link href="{{ asset('frontend/css/order-sign_up.css') }}" rel="stylesheet">
    @endpush

    <body id="register_bg">

        @include('frontend.includes.header-in-clearfix')

        <div id="register">
            <aside>
                <figure>
                    <a href="index.html"><img src="img/logo_sticky.svg" width="140" height="35" alt=""></a>
                </figure>
                <div class="access_social">
                    <a href="#0" class="social_bt facebook">@autotranslate('Login with Facebook', app()->getLocale())</a>
                    <a href="#0" class="social_bt google">@autotranslate('Login with Google', app()->getLocale())</a>
                </div>
                <div class="divider"><span>Or</span></div>

                <!-- Start of Form -->
                <form method="POST" action="{{ route('client.register_handler') }}" autocomplete="on" id="registerForm">
                    @csrf

                    @if ($errors->any())
                        <div class="alert alert-warning solid alert-dismissible fade show">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ app(\App\Services\AutoTranslationService::class)->trans($error, app()->getLocale()) }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-group">
                        <input class="form-control" type="text" name="name_register" placeholder="@autotranslate('Name', app()->getLocale())" value="{{ old('name_register') }}" required>
                        <i class="icon_pencil-edit"></i>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="last_name_register" placeholder="@autotranslate('Last Name', app()->getLocale())" value="{{ old('last_name_register') }}" required>
                        <i class="icon_pencil-edit"></i>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email_register" placeholder="@autotranslate('Email', app()->getLocale())" value="{{ old('email_register') }}" required>
                        <i class="icon_mail_alt"></i>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password_register" id="password1" placeholder="@autotranslate('Password', app()->getLocale())" required>
                        <i class="icon_lock_alt"></i>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password_confirmation_register" id="password2" placeholder="@autotranslate('Confirm Password', app()->getLocale())" required>
                        <i class="icon_lock_alt"></i>
                    </div>
                    <div class="form-group" style="display:none;">
                        <input class="form-control" type="text" name="bot_trap" placeholder="Bot Trap">
                    </div>
                    <div id="pass-info" class="clearfix"></div>

                    <button type="submit" class="btn_1 gradient full-width" id="submitBtn">@autotranslate('Register Now!', app()->getLocale())</button>
                    <button class="btn_1 gradient full-width" type="button" id="loadingBtn" style="display: none;">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        @autotranslate('Loading...', app()->getLocale())
                    </button>

                    <div class="text-center mt-2"><small>@autotranslate('Already have an account?', app()->getLocale()) <strong><a href="{{ url('/login') }}">@autotranslate('Sign In', app()->getLocale())</a></strong></small></div>
                </form>
                <!-- End of Form -->

                <div class="copy">&copy; {{ date('Y') }} {{ config('app.name') }}. @autotranslate('All rights reserved.', app()->getLocale())</div>
            </aside>
        </div>
        <!-- /register -->

        @push('specific-scripts')
            <!-- SPECIFIC SCRIPTS -->
            <script src="{{ asset('frontend/js/pw_strenght.js') }}"></script>
            <script>
                document.getElementById('registerForm').addEventListener('submit', function() {
                    document.getElementById('submitBtn').style.display = 'none';
                    document.getElementById('loadingBtn').style.display = 'block';
                });
            </script>
@endpush
@endsection
