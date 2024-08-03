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
                <h4 class="title text-center">Passwort vergessen!</h4>

                <div class="divider"></div>
                <form method="POST" action="{{ route('client.send-password-reset-link') }}" autocomplete="on">
                    @csrf
                    <div class="form-group">
                        <input class="form-control @error('email') is-invalid @enderror" type="text" name="email" placeholder="Email or Username" value="{{ old('email') }}" required>
                        <i class="icon_mail_alt"></i>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn_1 gradient full-width">Abschicken!</button>
                    <div class="text-center mt-2">
                        <small>Noch kein Konto? <strong><a href="{{ route('client.register') }}">Registrieren</a></strong></small>
                    </div>
                </form>
                @include('backend.includes.errorflash')
                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                <div class="copy">© 2020 FooYes</div>
            </aside>
        </div>

        @push('specific-scripts')
        <!-- Ihre spezifischen Skripte hier -->
        @endpush
    @endsection
