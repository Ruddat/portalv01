<?php $page = 'reset-password'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="account-content">
        <div class="login-wrapper reset-pass-wrap bg-img">
            <div class="login-content">
                <form action="success-3">
                    <div class="login-userset">
                        <div class="login-logo logo-normal">
                            <img src="{{ URL::asset('/build/img/logo.png') }}" alt="img">
                        </div>
                        <a href="{{ url('index') }}" class="login-logo logo-white">
                            <img src="{{ URL::asset('/build/img/logo-white.png') }}" alt="">
                        </a>
                        <div class="login-userheading">
                            <h3>Reset password?</h3>
                            <h4>Enter New Password & Confirm Password to get inside</h4>
                        </div>
                        <div class="form-login">
                            <label> Old Password</label>
                            <div class="pass-group">
                                <input type="password" class="pass-input">
                                <span class="fas toggle-password fa-eye-slash"></span>
                            </div>
                        </div>
                        <div class="form-login">
                            <label>New Password</label>
                            <div class="pass-group">
                                <input type="password" class="pass-inputs">
                                <span class="fas toggle-passwords fa-eye-slash"></span>
                            </div>
                        </div>
                        <div class="form-login">
                            <label> New Confirm Passworrd</label>
                            <div class="pass-group">
                                <input type="password" class="pass-inputa">
                                <span class="fas toggle-passworda fa-eye-slash"></span>
                            </div>
                        </div>
                        <div class="form-login">
                            <button type="submit" class="btn btn-login">Change Password</button>
                        </div>
                        <div class="signinform text-center">
                            <h4>Return to <a href="{{ url('signup') }}" class="hover-a"> login </a></h4>
                        </div>
                        <div class="my-4 d-flex justify-content-center align-items-center copyright-text">
                            <p>Copyright &copy; 2023 DreamsPOS. All rights reserved</p>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
