<?php $page = 'success-3'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="account-content">
        <div class="login-wrapper login-new">
            <div class="login-content user-login">
                <div class="login-logo">
                    <img src="{{ URL::asset('/build/img/logo.png') }}" alt="img">
                    <a href="{{ url('index') }}" class="login-logo logo-white">
                        <img src="{{ URL::asset('/build/img/logo-white.png') }}" alt="">
                    </a>
                </div>
                <div class="login-userset">
                    <div class="login-userheading text-center">
                        <img src="{{ URL::asset('/build/img/icons/check-icon.svg') }}" alt="Icon">
                        <h3 class="text-center">Success</h3>
                        <h4 class="verfy-mail-content text-center">Your Passwrod Reset Successfully!</h4>
                    </div>


                    <div class="form-login">
                        <a class="btn btn-login mt-0" href="{{ url('signin-3') }}">Back to Login</a>
                    </div>
                    <div class="my-4 d-flex justify-content-center align-items-center copyright-text">
                        <p>Copyright © 2023-Dreamspos</p>
                    </div>
                </div>
            </div>
            <div class="my-4 d-flex justify-content-center align-items-center copyright-text">
                <p>Copyright &copy; 2023 DreamsPOS. All rights reserved</p>
            </div>
        </div>
    </div>
@endsection
