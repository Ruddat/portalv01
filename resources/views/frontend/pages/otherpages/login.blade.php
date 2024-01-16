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
                        <a href="#0" class="social_bt facebook">Login with Facebook</a>
                        <a href="#0" class="social_bt google">Login with Google</a>
                    </div>
                <div class="divider"><span>Or</span></div>
                <form autocomplete="off">
                    <div class="form-group">
                        <input class="form-control" type="email" placeholder="Email">
                        <i class="icon_mail_alt"></i>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" id="password" placeholder="Password">
                        <i class="icon_lock_alt"></i>
                    </div>
                    <div class="clearfix add_bottom_15">
                        <div class="checkboxes float-start">
                            <label class="container_check">Remember me
                              <input type="checkbox">
                              <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="float-end"><a id="forgot" href="#0">Forgot Password?</a></div>
                    </div>
                    <a href="#0" class="btn_1 gradient full-width">Login Now!</a>
                    <div class="text-center mt-2"><small>Don't have an acccount? <strong><a href="{{ url('/register') }}">Sign Up</a></strong></small></div>
                </form>
                <div class="copy">© 2020 FooYes</div>
            </aside>
        </div>
        <!-- /login -->











        @push('specific-scripts')


        @endpush
    @endsection
