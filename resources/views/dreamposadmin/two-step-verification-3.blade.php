<?php $page = 'two-step-verification-3'; ?>
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
                    <div class="login-userheading">
                        <h3>Login With Your Email Address</h3>
                        <h4 class="verfy-mail-content">We sent a verification code to your email. Enter the code from the
                            email in the field below</h4>
                    </div>
                    <form action="index" class="digit-group">
                        <div class="wallet-add">
                            <div class="otp-box">
                                <div class="forms-block text-center">
                                    <input type="text" id="digit-1" maxlength="1" value="">
                                    <input type="text" id="digit-2" maxlength="1" value="">
                                    <input type="text" id="digit-3" maxlength="1" value="">
                                    <input type="text" id="digit-4" maxlength="1" value="">
                                </div>
                            </div>
                        </div>
                        <div class="Otp-expire text-center">
                            <p>Otp will expire in 09 :10</p>
                        </div>
                        <div class="form-login mt-4">
                            <button type="submit" class="btn btn-login">Verify My Account</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="my-4 d-flex justify-content-center align-items-center copyright-text">
                <p>Copyright &copy; 2023 DreamsPOS. All rights reserved</p>
            </div>
        </div>
    </div>
@endsection
