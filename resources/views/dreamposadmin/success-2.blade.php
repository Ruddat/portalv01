<?php $page = 'success-2'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="account-content">
        <div class="login-wrapper">
            <div class="login-content">
                <div class="login-userset">
                    <div class="login-userset">
                        <div class="login-logo logo-normal">
                            <img src="{{ URL::asset('/build/img/logo.png') }}" alt="img">
                        </div>
                    </div>
                    <a href="{{ url('index') }}" class="login-logo logo-white">
                        <img src="{{ URL::asset('/build/img/logo-white.png') }}" alt="">
                    </a>
                    <div class="login-userheading text-center">
                        <img src="{{ URL::asset('/build/img/icons/check-icon.svg') }}" alt="Icon">
                        <h3 class="text-center">Success</h3>
                        <h4 class="verfy-mail-content text-center">Your Passwrod Reset Successfully!</h4>
                    </div>


                    <div class="form-login">
                        <a class="btn btn-login mt-0" href="{{ url('signin-2') }}">Back to Login</a>
                    </div>
                    <div class="my-4 d-flex justify-content-center align-items-center copyright-text">
                        <p>Copyright © 2023-Dreamspos</p>
                    </div>
                </div>
            </div>
            <div class="login-img">
                <img src="{{ URL::asset('/build/img/authentication/step-two.png') }}" alt="img">
            </div>
        </div>
    </div>
@endsection
