@extends('frontend.layouts.default-no-footer')
@section('content')
    <!-- seitenabhengig css -->
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
                        <a href="#0" class="social_bt facebook">Register with Facebook</a>
                        <a href="#0" class="social_bt google">Register with Google</a>
                    </div>
                <div class="divider"><span>Or</span></div>
                <form autocomplete="off">
                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Name">
                        <i class="icon_pencil-edit"></i>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Last Name">
                        <i class="icon_pencil-edit"></i>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="email" placeholder="Email">
                        <i class="icon_mail_alt"></i>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" id="password1" placeholder="Password">
                        <i class="icon_lock_alt"></i>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" id="password2" placeholder="Confirm Password">
                        <i class="icon_lock_alt"></i>
                    </div>
                    <div id="pass-info" class="clearfix"></div>
                    <a href="#0" class="btn_1 gradient full-width">Register Now!</a>
                    <div class="text-center mt-2"><small>Already have an acccount? <strong><a href="{{ url('/login') }}">Sign In</a></strong></small></div>
                </form>
                <div class="copy">© 2020 FooYes</div>
            </aside>
        </div>
        <!-- /login -->












        @push('specific-scripts')


        <!-- SPECIFIC SCRIPTS -->
            <!-- SPECIFIC SCRIPTS -->
    <script src="{{ asset('frontend/js/pw_strenght.js') }}"></script>

        @endpush
    @endsection
