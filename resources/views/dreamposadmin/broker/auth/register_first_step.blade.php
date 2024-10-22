<?php $page = 'register'; ?>
@extends('dreamposadmin.layout.mainlayout')
@section('content')
    <div class="account-content">
        <div class="login-wrapper register-wrap bg-img">
            <div class="login-content">

                @livewire('backend.broker.broker-registration')

            </div>
        </div>
    </div>


@endsection
