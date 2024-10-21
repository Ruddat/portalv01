<?php $page = 'ui-counter'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper cardhead">
        <div class="content container-fluid">

            @component('components.breadcrumb')
                @slot('title')
                    Counter
                @endslot
                @slot('li_1')
                    Dashboard
                @endslot
                @slot('li_2')
                    Counter
                @endslot
            @endcomponent

            <div class="row">

                <!-- Counter -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5>Clients</h5>
                            <h6 class="counter">3,000</h6>
                        </div>
                    </div>
                </div>
                <!-- /Counter -->

                <!-- Counter -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5>Total Sales</h5>
                            <h6 class="counter">10,000</h6>
                        </div>
                    </div>
                </div>
                <!-- /Counter -->

                <!-- Counter -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5>Total Projects</h5>
                            <h6 class="counter">15,000</h6>
                        </div>
                    </div>
                </div>
                <!-- /Counter -->

                <!-- Counter -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Count Down</h5>
                        </div>
                        <div class="card-body">
                            <h6>Time Count from 3</h6>
                            <span id="timer-countdown"></span>
                        </div>
                    </div>
                </div>
                <!-- /Counter -->

                <!-- Counter -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Count Up</h5>
                        </div>
                        <div class="card-body">
                            <h6>Time Counting From 0</h6>
                            <span id="timer-countup"></span>
                        </div>
                    </div>
                </div>
                <!-- /Counter -->

                <!-- Counter -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Count Inbetween</h5>
                        </div>
                        <div class="card-body">
                            <h6>Time counting from 30 to 20</h6>
                            <span id="timer-countinbetween"></span>
                        </div>
                    </div>
                </div>
                <!-- /Counter -->

                <!-- Counter -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Count Callback</h5>
                        </div>
                        <div class="card-body">
                            <h6>Count from 10 to 0 and calls timer end callback</h6>
                            <span id="timer-countercallback"></span>
                        </div>
                    </div>
                </div>
                <!-- /Counter -->

                <!-- Counter -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Custom Output</h5>
                        </div>
                        <div class="card-body">
                            <h6>Changed output pattern</h6>
                            <span id="timer-outputpattern"></span>
                        </div>
                    </div>
                </div>
                <!-- /Counter -->

            </div>

        </div>
    </div>
@endsection
