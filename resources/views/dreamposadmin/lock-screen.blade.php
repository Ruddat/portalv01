<?php $page = 'lock-screen'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="login-wrapper">
        <div class="container">
            <img class="img-fluid logo-dark mb-5" src="{{ URL::asset('/build/img/logo.png') }}" alt="Logo">
            <div class="loginbox">
                <div class="login-right">
                    <div class="login-right-wrap">
                        <div class="login-info">
                            <p class="account-subtitle">Welcome back!</p>
                            <img src="{{ URL::asset('/build/img/login-user.png') }}" class="img-fluid" alt="User-Img">
                            <h5>John Smilga</h5>
                        </div>

                        <form action="#">
                            <div class="input-blocks">
                                <div class="pass-group">
                                    <input type="password" class="form-control pass-input"
                                        placeholder="Enter your password">
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                </div>
                            </div>
                            <button class="btn btn-lg btn-block btn-primary" type="submit">Log In</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <ul class="terms d-flex">
                    <li>Terms & Condition</li>
                    <li>Privacy</li>
                    <li>Help</li>
                    <li class="has-submenu">
                        <a href="#">English <i class="fas fa-chevron-down"></i></a>
                        <ul class="submenu dropdown-menu">
                            <li><a href="javascript:">American</a></li>
                            <li><a href="javascript:">British</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="my-4 d-flex justify-content-center align-items-center copyright-text">
                    <p>Copyright &copy; 2024 DreamsPOS. All rights reserved</p>
                </div>
            </div>
        </div>
    </div>
@endsection
