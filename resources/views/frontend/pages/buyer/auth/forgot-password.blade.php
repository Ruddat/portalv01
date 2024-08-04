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
                <h4 class="title text-center">@autotranslate('Passwort vergessen!', app()->getLocale())</h4>

                <div class="divider"></div>
                <form method="POST" action="{{ route('client.send-password-reset-link') }}" autocomplete="on">
                    @csrf
                    <div class="form-group">
                        <input class="form-control @error('email') is-invalid @enderror" type="text" name="email" placeholder="Email or Username" value="{{ old('email') }}" required>
                        <i class="icon_mail_alt"></i>
                        @error('email')
                            <div class="invalid-feedback">{{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn_1 gradient full-width">@autotranslate('Abschicken!', app()->getLocale())</button>
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
        <!-- Ihre spezifischen Skripte hier -->
        @endpush
    @endsection
