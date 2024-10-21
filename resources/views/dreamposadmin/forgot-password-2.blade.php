<?php $page = 'forgot-password-2'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="account-content">
        <div class="login-wrapper">
            <div class="login-content">
                <form action="signin">
                    <div class="login-userset">
                        <div class="login-logo logo-normal">
                            <img src="{{ URL::asset('/build/img/logo.png') }}" alt="img">
                        </div>
                        <a href="{{ url('index') }}" class="login-logo logo-white">
                            <img src="{{ URL::asset('/build/img/logo-white.png') }}" alt="">
                        </a>
                        <div class="login-userheading">
                            <h3>Forgot password?</h3>
                            <h4>If you forgot your password, well, then we’ll email you instructions to reset your password.
                            </h4>
                        </div>
                        <div class="form-login">
                            <label>Email</label>
                            <div class="form-addons">
                                <input type="email" class="form-control">
                                <img src="{{ URL::asset('/build/img/icons/mail.svg') }}" alt="img">
                            </div>
                        </div>
                        <div class="form-login">
                            <button type="submit" class="btn btn-login">Sign Up</button>
                        </div>
                        <div class="signinform text-center">
                            <h4>Return to<a href="{{ url('signin-2') }}" class="hover-a"> login </a></h4>
                        </div>
                        <div class="form-setlogin or-text">
                            <h4>OR</h4>
                        </div>
                        <div class="form-sociallink">
                            <ul class="d-flex justify-content-center">
                                <li>
                                    <a href="javascript:void(0);" class="facebook-logo">
                                        <img src="{{ URL::asset('/build/img/icons/facebook-logo.svg') }}" alt="Facebook">
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <img src="{{ URL::asset('/build/img/icons/google.png') }}" alt="Google">
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="apple-logo">
                                        <img src="{{ URL::asset('/build/img/icons/apple-logo.svg') }}" alt="Apple">
                                    </a>
                                </li>

                            </ul>
                        </div>
                        <div class="my-4 d-flex justify-content-center align-items-center copyright-text">
                            <p>Copyright &copy; 2023 DreamsPOS. All rights reserved</p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="login-img">
                <img src="{{ URL::asset('/build/img/authentication/forgot-02.png') }}" alt="img">
            </div>
        </div>
    </div>
@endsection
