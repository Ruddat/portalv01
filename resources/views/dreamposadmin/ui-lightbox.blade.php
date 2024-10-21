<?php $page = 'ui-lightbox'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Light Box</h4>
                </div>
            </div>
            <div class="row">

                <!-- Lightbox -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Single Image Lightbox</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-2 mb-md-0">
                                    <a href="{{ URL::asset('/build/img/img-01.jpg') }}" class="image-popup">
                                        <img src="{{ URL::asset('/build/img/img-01.jpg') }}" class="img-fluid"
                                            alt="image">
                                    </a>
                                </div>
                                <div class="col-md-4 mb-2 mb-md-0">
                                    <a href="{{ URL::asset('/build/img/img-02.jpg') }}" class="image-popup">
                                        <img src="{{ URL::asset('/build/img/img-02.jpg') }}" class="img-fluid"
                                            alt="image">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Lightbox -->

                <!-- Lightbox -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Image with Description</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-2 mb-md-0">
                                    <a href="{{ URL::asset('/build/img/img-03.jpg') }}" class="image-popup-desc"
                                        data-title="Title 01"
                                        data-description="Lorem ipsum dolor sit amet, consectetuer adipiscing elit">
                                        <img src="{{ URL::asset('/build/img/img-03.jpg') }}" class="img-fluid"
                                            alt="work-thumbnail">
                                    </a>
                                </div>
                                <div class="col-md-4 mb-2 mb-md-0">
                                    <a href="{{ URL::asset('/build/img/img-04.jpg') }}" class="image-popup-desc"
                                        data-title="Title 02"
                                        data-description="Lorem ipsum dolor sit amet, consectetuer adipiscing elit">
                                        <img src="{{ URL::asset('/build/img/img-04.jpg') }}" class="img-fluid"
                                            alt="work-thumbnail">
                                    </a>
                                </div>
                                <div class="col-md-4 mb-2 mb-md-0">
                                    <a href="{{ URL::asset('/build/img/img-05.jpg') }}" class="image-popup-desc"
                                        data-title="Title 03"
                                        data-description="Lorem ipsum dolor sit amet, consectetuer adipiscing elit">
                                        <img src="{{ URL::asset('/build/img/img-05.jpg') }}" class="img-fluid"
                                            alt="work-thumbnail">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Lightbox -->

            </div>
        </div>
    </div>
@endsection
