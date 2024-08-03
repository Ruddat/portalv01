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
                <div class="divider"><span>Oder</span></div>
                <form method="POST" action="{{ route('client.login_handler') }}" autocomplete="on">
                    @csrf
                    <div class="form-group">
                        <input class="form-control @error('login_id') is-invalid @enderror" type="text" name="login_id" placeholder="Email or Username" value="{{ old('login_id') }}" required>
                        <i class="icon_mail_alt"></i>
                        @error('login_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="password" placeholder="Passwort" required>
                        <i class="icon_lock_alt"></i>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="clearfix add_bottom_15">
                        <div class="checkboxes float-start">
                            <label class="container_check">Erinnere dich an mich
                                <input type="checkbox" name="remember">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="float-end"><a id="forgot" href="{{ route('client.forgot-password') }}">Passwort vergessen?</a></div>
                    </div>
                    <button type="submit" class="btn_1 gradient full-width">Jetzt einloggen!</button>
                    <div class="text-center mt-2">
                        <small>Noch kein Konto? <strong><a href="{{ route('client.register') }}">Registrieren</a></strong></small>
                    </div>
                </form>
                @include('backend.includes.errorflash')
                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        @foreach ($errors->all() as $error)
                            <div>{{ app(\App\Services\AutoTranslationService::class)->trans($error, app()->getLocale()) }}</div>
                        @endforeach
                    </div>
                @endif
                <div class="copy">&copy; {{ date('Y') }} {{ config('app.name') }}. @autotranslate('All rights reserved.', app()->getLocale())</div>
            </aside>
        </div>

        @push('specific-scripts')
        <!-- Ihre spezifischen Skripte hier -->
        @endpush
    @endsection
