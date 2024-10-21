<?php $page = 'ui-video'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Video</h4>
                </div>
            </div>
            <div class="row">

                <!-- Responsive embed video 21:9 -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <h5 class="card-title">Responsive embed video 21:9</h5>
                            <p class="sub-header">Use class <code>.ratio-21x9</code></p>
                        </div>
                        <div class="card-body">
                            <div class="ratio ratio-21x9">
                                <iframe
                                    src="https://www.youtube.com/embed/6bzTrChjEdc?autohide=0&showinfo=0&controls=0"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Responsive embed video 21:9 -->

                <!-- Responsive embed video 16:9 -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <h5 class="card-title">Responsive embed video 16:9</h5>
                            <p class="sub-header">Use class <code>.ratio-16x9</code></p>
                        </div>
                        <div class="card-body">
                            <div class="ratio ratio-16x9">
                                <iframe src="https://www.youtube.com/embed/6bzTrChjEdc?ecver=1"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Responsive embed video 16:9 -->

            </div>

            <div class="row">

                <!-- Responsive embed video 4:3 -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <h5 class="card-title">Responsive embed video 4:3</h5>
                            <p class="sub-header">Use class <code>.ratio-4x3</code></p>
                        </div>
                        <div class="card-body">
                            <div class="ratio ratio-4x3">
                                <iframe src="https://www.youtube.com/embed/6bzTrChjEdc?ecver=1"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Responsive embed video 4:3 -->

                <!-- Responsive embed video 1:1 -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <h5 class="card-title">Responsive embed video 1:1</h5>
                            <p class="sub-header">Use class <code>.ratio-1x1</code></p>
                        </div>
                        <div class="card-body">
                            <div class="ratio ratio-1x1">
                                <iframe src="https://www.youtube.com/embed/6bzTrChjEdc?ecver=1"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Responsive embed video 1:1 -->

            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection
