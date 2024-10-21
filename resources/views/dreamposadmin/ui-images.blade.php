<?php $page = 'ui-images'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Images</h4>
                </div>
            </div>

            <div class="row">

                <!-- Images Shapes -->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">Images Shapes</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-12">
                                    <p>
                                        Add classes to an <code>&lt;img&gt;</code> element to easily style
                                        images in any project.
                                    </p>

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <img src="{{ URL::asset('/build/img/img-4.jpg') }}" alt="image"
                                                class="img-fluid rounded" width="200">
                                            <p class="mb-0">
                                                <code>.rounded</code>
                                            </p>
                                        </div>

                                        <div class="col-sm-3">
                                            <img src="{{ URL::asset('/build/img/profiles/avatar-03.jpg') }}" alt="image"
                                                class="img-fluid rounded-circle" width="133">
                                            <p class="mb-0">
                                                <code>.rounded-circle</code>
                                            </p>
                                        </div>

                                        <div class="col-sm-3">
                                            <img src="{{ URL::asset('/build/img/img-1.jpg') }}" alt="image"
                                                class="img-fluid img-thumbnail" width="200">
                                            <p class="mb-0">
                                                <code>.img-thumbnail</code>
                                            </p>
                                        </div>

                                        <div class="col-sm-3">
                                            <img src="{{ URL::asset('/build/img/profiles/avatar-02.jpg') }}" alt="image"
                                                class="img-thumbnail rounded-pill" width="133">
                                            <p class="mb-0">
                                                <code>.rounded-pill</code>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Images Shapes -->

            </div>

            <div class="row">

                <!-- Image Left Align -->
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">Image Left Align</div>

                        </div>
                        <div class="card-body">
                            <img class="rounded float-start" src="{{ URL::asset('/build/img/img-1.jpg') }}" alt="..."
                                width="200">
                        </div>

                    </div>
                </div>
                <!-- /Image Left Align -->

                <!-- Image Center Align -->
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">Image Center Align</div>
                        </div>
                        <div class="card-body">
                            <img class="rounded mx-auto d-block" src="{{ URL::asset('/build/img/img-1.jpg') }}"
                                alt="..." width="200">
                        </div>
                    </div>
                </div>
                <!-- /Image Center Align -->

                <!-- Image Right Align -->
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">Image Right Align</div>
                        </div>
                        <div class="card-body">
                            <img class="rounded float-end" src="{{ URL::asset('/build/img/img-1.jpg') }}" alt="..."
                                width="200">
                        </div>
                    </div>
                </div>
                <!-- /Image Right Align -->

                <!-- Figures -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Figures
                            </div>
                        </div>
                        <div class="card-body d-flex justify-content-between gap-2">
                            <figure class="figure">
                                <img class="bd-placeholder-img figure-img img-fluid rounded card-img"
                                    src="{{ URL::asset('/build/img/img-1.jpg') }}" alt="...">
                                <figcaption class="figure-caption">A caption for the above image.</figcaption>
                            </figure>
                            <figure class="figure float-end">
                                <img class="bd-placeholder-img figure-img img-fluid rounded card-img"
                                    src="{{ URL::asset('/build/img/img-1.jpg') }}" alt="...">
                                <figcaption class="figure-caption text-end">A caption for the above image.</figcaption>
                            </figure>
                        </div>
                    </div>
                </div>
                <!-- /Figures -->

            </div>
        </div>
    </div>
@endsection
