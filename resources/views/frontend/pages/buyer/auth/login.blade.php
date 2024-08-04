@extends('frontend.layouts.default-no-footer')
@section('content')
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

                <div class="divider"><span>@autotranslate('Oder', app()->getLocale())</span></div>
                <form method="POST" action="{{ route('client.login_handler') }}" autocomplete="on" id="loginForm">
                    @csrf
                    <div class="form-group">
                        <input class="form-control @error('login_id') is-invalid @enderror" type="text" name="login_id" placeholder="Email or Username" value="{{ old('login_id') }}" required>
                        <i class="icon_mail_alt"></i>
                        @error('login_id')
                            <div class="invalid-feedback">{{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="password" placeholder="Passwort" required>
                        <i class="icon_lock_alt"></i>
                        @error('password')
                            <div class="invalid-feedback">{{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}</div>
                        @enderror
                    </div>
                    <div class="clearfix add_bottom_15">
                        <div class="checkboxes float-start">
                            <label class="container_check">@autotranslate('Erinnere dich an mich', app()->getLocale())
                                <input type="checkbox" name="remember">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="float-end"><a id="forgot" href="{{ route('client.forgot-password') }}">@autotranslate('Passwort vergessen?', app()->getLocale())</a></div>
                    </div>
                    <button type="submit" class="btn_1 gradient full-width" id="submitBtn">@autotranslate('Jetzt einloggen!', app()->getLocale())</button>
                    <button class="btn_1 gradient full-width" type="button" id="loadingBtn" style="display: none;">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        @autotranslate('Loading...', app()->getLocale())
                    </button>

                    <div class="text-center mt-2">
                        <small>@autotranslate('Noch kein Konto?', app()->getLocale()) <strong><a href="{{ route('client.register') }}">@autotranslate('Registrieren', app()->getLocale())</a></strong></small>
                    </div>
                </form>
                @include('backend.includes.errorflash')
                @if ($errors->any())
                    <div class="alert alert-warning solid alert-dismissible fade show">
                        @foreach ($errors->all() as $error)
                            <div>{{ app(\App\Services\AutoTranslationService::class)->trans($error, app()->getLocale()) }}</div>
                        @endforeach
                    </div>
                @endif
                <div class="copy">&copy; {{ date('Y') }} {{ config('app.name') }}. @autotranslate('All rights reserved.', app()->getLocale())</div>
            </aside>
        </div>

        @push('specific-scripts')
        <script>
            document.getElementById('loginForm').addEventListener('submit', function() {
                document.getElementById('submitBtn').style.display = 'none';
                document.getElementById('loadingBtn').style.display = 'block';
            });
        </script>
        @endpush
    @endsection
