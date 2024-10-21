<?php $page = 'chart-flot'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper cardhead">
        <div class="content">

            @component('components.breadcrumb')
                @slot('title')
                    Flot Chart
                @endslot
                @slot('li_1')
                    Dashboard
                @endslot
                @slot('li_2')
                    Flot Charts
                @endslot
            @endcomponent

            <div class="row">

                <!-- Chart -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Bar Chart</div>
                        </div>
                        <div class="card-body  chart-set">
                            <div class="h-250" id="flotBar1"></div>
                        </div>
                    </div>
                </div>
                <!-- /Chart -->

                <!-- Chart -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Bar Chart</div>
                        </div>
                        <div class="card-body chart-set">
                            <div class="h-250" id="flotBar2"></div>
                        </div>
                    </div>
                </div>
                <!-- /Chart -->

                <!-- Chart -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Line Chart</div>
                        </div>
                        <div class="card-body chart-set">
                            <div class="h-250" id="flotLine1"></div>
                        </div>
                    </div>
                </div>
                <!-- /Chart -->

                <!-- Chart -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Line ChartPOints</div>
                        </div>
                        <div class="card-body chart-set">
                            <div class="h-250" id="flotLine2"></div>
                        </div>
                    </div>
                </div>
                <!-- /Chart -->

                <!-- Chart -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Area Chart</div>
                        </div>
                        <div class="card-body chart-set">
                            <div class="h-250" id="flotArea1"></div>
                        </div>
                    </div>
                </div>
                <!-- /Chart -->

                <!-- Chart -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Area Chart Points</div>
                        </div>
                        <div class="card-body chart-set">
                            <div class="h-250" id="flotArea2"></div>
                        </div>
                    </div>
                </div>
                <!-- /Chart -->

                <!-- Chart -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Pie Chart</div>
                        </div>
                        <div class="card-body chart-set">
                            <div class="h-250" id="flotPie1"></div>
                        </div>
                    </div>
                </div>
                <!-- /Chart -->

                <!-- Chart -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Donut Chart</div>
                        </div>
                        <div class="card-body chart-set">
                            <div class="h-250" id="flotPie2"></div>
                        </div>
                    </div>
                </div>
                <!-- /Chart -->

            </div>

        </div>
    </div>
@endsection
