<?php $page = 'signin'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="account-content">
        <div class="login-wrapper bg-img">
            <div class="login-content">
                <form action="{{ route('signin.custom') }}" method="POST">
                    @csrf
                    <div class="login-userset">
                        <div class="login-logo logo-normal">
                            <img src="{{ URL::asset('/build/img/logo.png') }}" alt="img">
                        </div>
                        <a href="{{ url('index') }}" class="login-logo logo-white">
                            <img src="{{ URL::asset('/build/img/logo-white.png') }}" alt="">
                        </a>
                        <div class="login-userheading">
                            <h3>Sign In</h3>
                            <h4>Access the Dreamspos panel using your email and passcode.</h4>
                        </div>
                        <div class="form-login mb-3">
                            <label class="form-label">Email Address</label>
                            <div class="form-addons">
                                <input type="text" class="form- control" id="email" name="email"
                                    value="admin@example.com">
                                <img src="{{ URL::asset('/build/img/icons/mail.svg') }}" alt="img">
                            </div>
                            <div class="text-danger pt-2">
                                @error('0')
                                    {{ $message }}
                                @enderror
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-login mb-3">
                            <label class="form-label">Password</label>
                            <div class="pass-group">
                                <input type="password" class="pass-input form-control" id="password" name="password"
                                    value="123456">
                                <span class="fas toggle-password fa-eye-slash"></span>
                            </div>
                            <div class="text-danger pt-2">
                                @error('0')
                                    {{ $message }}
                                @enderror
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-login authentication-check">
                            <div class="row">
                                <div class="col-12 d-flex align-items-center justify-content-between">
                                    <div class="custom-control custom-checkbox">
                                        <label class="checkboxs ps-4 mb-0 pb-0 line-height-1">
                                            <input type="checkbox" class="form-control">
                                            <span class="checkmarks"></span>Remember me
                                        </label>
                                    </div>
                                    <div class="text-end">
                                        <a class="forgot-link" href="{{ url('forgot-password') }}">Forgot Password?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-login">
                            <button type="submit" class="btn btn-login">Sign In</button>
                        </div>
                        <div class="signinform">
                            <h4>New on our platform?<a href="{{ url('register') }}" class="hover-a"> Create an account</a>
                            </h4>
                        </div>
                        <div class="form-setlogin or-text">
                            <h4>OR</h4>
                        </div>
                        <div class="form-sociallink">
                            <ul class="d-flex">
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
                            <div class="my-4 d-flex justify-content-center align-items-center copyright-text">
                                <p>Copyright &copy; 2023 DreamsPOS. All rights reserved</p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
