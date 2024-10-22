<?php $page = 'email-verification'; ?>
@extends('dreamposadmin.layout.mainlayout')
@section('content')
    <div class="account-content">
        <div class="login-wrapper email-veri-wrap bg-img">
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
                        <h3>@autotranslate('Verify Your Email', app()->getLocale())</h3>
                        <h4 class="verfy-mail-content">
                            @autotranslate("We've sent a link to your email", app()->getLocale()) {{ session('email') }}. @autotranslate("Please follow the link inside to continue", app()->getLocale())
                        </h4>
                    </div>
                    <div class="signinform text-center">
                        <h4>
                            @autotranslate("Didn't receive an email?", app()->getLocale()) <a href="javascript:void(0);" class="hover-a resend">@autotranslate("Resend Link", app()->getLocale())</a>
                        </h4>
                    </div>
                    <div class="form-login">
                        <a class="btn btn-login" href="{{ url('index') }}">@autotranslate('Skip Now', app()->getLocale())</a>
                    </div>
                    <div class="my-4 d-flex justify-content-center align-items-center copyright-text">
                        <p>@autotranslate('Copyright &copy; 2023 DreamsPOS. All rights reserved', app()->getLocale())</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
