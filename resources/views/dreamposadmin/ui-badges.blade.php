<?php $page = 'ui-badges'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Badges</h4>
                </div>
            </div>
            <div class="row">

                <!-- Badges -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Badges</h5>
                        </div>
                        <div class="card-body d-flex flex-wrap gap-2">
                            <span class="badge bg-primary">Primary</span>
                            <span class="badge bg-secondary">Secondary</span>
                            <span class="badge bg-success">Success</span>
                            <span class="badge bg-danger">Danger</span>
                            <span class="badge bg-warning">Warning</span>
                            <span class="badge bg-info">Info</span>
                            <span class="badge bg-light text-dark">Light</span>
                            <span class="badge bg-dark text-white">Dark</span>
                        </div>
                    </div>
                </div>
                <!-- /Badges -->

                <!-- Rounded Badges -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Rounded Badges</h5>
                        </div>
                        <div class="card-body d-flex flex-wrap gap-2">
                            <span class="badge rounded-pill bg-primary">Primary</span>
                            <span class="badge rounded-pill bg-secondary">Secondary</span>
                            <span class="badge rounded-pill bg-success">Success</span>
                            <span class="badge rounded-pill bg-danger">Danger</span>
                            <span class="badge rounded-pill bg-warning">Warning</span>
                            <span class="badge rounded-pill bg-info">Info</span>
                            <span class="badge rounded-pill bg-light text-dark">Light</span>
                            <span class="badge rounded-pill bg-dark text-white">Dark</span>
                        </div>
                    </div>
                </div>
                <!-- /Rounded Badges -->

                <!-- Outline Badges -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Outline Badges</h5>
                        </div>
                        <div class="card-body d-flex flex-wrap gap-2">
                            <span class="badge bg-outline-primary">Primary</span>
                            <span class="badge bg-outline-secondary">Secondary</span>
                            <span class="badge bg-outline-success">Success</span>
                            <span class="badge bg-outline-danger">Danger</span>
                            <span class="badge bg-outline-warning">Warning</span>
                            <span class="badge bg-outline-info">Info</span>
                            <span class="badge bg-outline-light text-dark">Light</span>
                            <span class="badge bg-outline-dark text-dark">Dark</span>
                        </div>
                    </div>
                </div>
                <!-- /Outline Badges -->

                <!-- Outline Rounded Badges -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Outline Rounded Badges</h5>
                        </div>
                        <div class="card-body d-flex flex-wrap gap-2">
                            <span class="badge rounded-pill bg-outline-primary">Primary</span>
                            <span class="badge rounded-pill bg-outline-secondary">Secondary</span>
                            <span class="badge rounded-pill bg-outline-success">Success</span>
                            <span class="badge rounded-pill bg-outline-danger">Danger</span>
                            <span class="badge rounded-pill bg-outline-warning">Warning</span>
                            <span class="badge rounded-pill bg-outline-info">Info</span>
                            <span class="badge rounded-pill bg-outline-light text-dark">Light</span>
                            <span class="badge rounded-pill bg-outline-dark text-dark">Dark</span>
                        </div>
                    </div>
                </div>
                <!-- /Outline Rounded Badges -->

                <!-- Soft Badges -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Soft Badges</h5>
                        </div>
                        <div class="card-body d-flex flex-wrap gap-2">
                            <span class="badge bg-soft-primary">Primary</span>
                            <span class="badge bg-soft-secondary">Secondary</span>
                            <span class="badge bg-soft-success">Success</span>
                            <span class="badge bg-soft-danger">Danger</span>
                            <span class="badge bg-soft-warning">Warning</span>
                            <span class="badge bg-soft-info">Info</span>
                            <span class="badge bg-soft-light text-dark">Light</span>
                            <span class="badge bg-soft-dark">Dark</span>
                        </div>
                    </div>
                </div>
                <!-- /Soft Badges -->

                <!-- Soft Rounded Badges -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Soft Rounded Badges</h5>
                        </div>
                        <div class="card-body d-flex flex-wrap gap-2">
                            <span class="badge rounded-pill bg-soft-primary">Primary</span>
                            <span class="badge rounded-pill bg-soft-secondary">Secondary</span>
                            <span class="badge rounded-pill bg-soft-success">Success</span>
                            <span class="badge rounded-pill bg-soft-danger">Danger</span>
                            <span class="badge rounded-pill bg-soft-warning">Warning</span>
                            <span class="badge rounded-pill bg-soft-info">Info</span>
                            <span class="badge rounded-pill bg-soft-light text-dark">Light</span>
                            <span class="badge rounded-pill bg-soft-dark">Dark</span>
                        </div>
                    </div>
                </div>
                <!-- /Soft Rounded Badges -->

                <!-- Badge Sizes -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Badge Sizes</h5>
                        </div>
                        <div class="card-body">
                            <span class="badge bg-primary">Default</span>
                            <span class="badge badge-xs bg-primary">XS</span>
                            <span class="badge badge-sm bg-secondary">SM</span>
                            <span class="badge badge-md bg-success">MD</span>
                            <span class="badge badge-lg bg-danger">LG</span>
                            <span class="badge badge-xl bg-warning">XL</span>
                        </div>
                    </div>
                </div>
                <!-- /Badge Sizes -->

                <!-- Badge Usage -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Badge Usage</h5>
                        </div>
                        <div class="card-body d-flex flex-wrap gap-4">
                            <button type="button" class="btn btn-primary position-relative">
                                Inbox
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    99+
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            </button>
                            <button type="button" class="btn btn-secondary position-relative">
                                Profile
                                <span
                                    class="position-absolute top-0 start-100 translate-middle p-2 bg-success border border-light rounded-circle">
                                    <span class="visually-hidden">New alerts</span>
                                </span>
                            </button>
                            <span class="avatar">
                                <img src="{{ URL::asset('/build/img/profiles/avator1.jpg') }}" alt="img">
                                <span
                                    class="position-absolute top-0 start-100 translate-middle p-1 bg-success border border-light rounded-circle">
                                    <span class="visually-hidden">New alerts</span>
                                </span>
                            </span>
                            <span class="avatar avatar-rounded">
                                <img src="{{ URL::asset('/build/img/profiles/avator1.jpg') }}" alt="img">
                                <span
                                    class="position-absolute top-0 start-100 translate-middle p-1 bg-success border border-light              rounded-circle">
                                    <span class="visually-hidden">New alerts</span>
                                </span>
                            </span>
                            <span class="avatar avatar-rounded">
                                <img src="{{ URL::asset('/build/img/profiles/avator1.jpg') }}" alt="img">
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge bg-secondary rounded-pill shadow-lg">1000+
                                    <span class="visually-hidden">New alerts</span>
                                </span>
                            </span>

                        </div>
                    </div>
                </div>
                <!-- /Badge Usage -->

                <!-- Buttons With Badges -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Buttons With Badges </h5>
                        </div>
                        <div class="card-body d-flex flex-wrap gap-2">
                            <button type="button" class="btn btn-primary my-1 me-2">
                                Notifications <span class="badge ms-2 bg-secondary">3</span>
                            </button>
                            <button type="button" class="btn btn-success my-1 me-2">
                                Notifications <span class="badge ms-2 bg-danger">15</span>
                            </button>
                            <button type="button" class="btn btn-danger my-1 me-2">
                                Notifications <span class="badge ms-2 bg-white text-dark">24</span>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- /Buttons With Badges -->

                <!-- Outline Buttons With Badges -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Outline Buttons With Badges </h5>
                        </div>
                        <div class="card-body d-flex flex-wrap gap-2">
                            <button type="button" class="btn btn-outline-primary my-1 me-2">
                                Notifications <span class="badge bg-primary ms-2">3</span>
                            </button>
                            <button type="button" class="btn btn-outline-success my-1 me-2">
                                Notifications <span class="badge bg-success ms-2">15</span>
                            </button>
                            <button type="button" class="btn btn-outline-danger my-1 me-2">
                                Notifications <span class="badge bg-danger ms-2">24</span>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- /Outline Buttons With Badges -->

                <!-- Headings -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Headings</h5>
                        </div>
                        <div class="card-body">
                            <h1>Example heading <span class="badge bg-primary">New</span></h1>
                            <h2>Example heading <span class="badge bg-primary">New</span></h2>
                            <h3>Example heading <span class="badge bg-primary">New</span></h3>
                            <h4>Example heading <span class="badge bg-primary">New</span></h4>
                            <h5>Example heading <span class="badge bg-primary">New</span></h5>
                            <h6>Example heading <span class="badge bg-primary">New</span></h6>
                        </div>
                    </div>
                </div>
                <!-- /Headings -->

                <!-- Badge with icons -->
                <div class="col-xl-6">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Badge with icons</h5>
                                </div>
                                <div class="card-body">
                                    <span class="badge bg-secondary"><span class="badge-label">Secondary</span><span
                                            class="ms-1" data-feather="plus"
                                            style="height:12px;width:12px;"></span></span>
                                    <span class="badge bg-success"><span class="badge-label">Success</span><span
                                            class="ms-1" data-feather="check"
                                            style="height:12px;width:12px;"></span></span>
                                    <span class="badge bg-info"><span class="badge-label">Info</span><span class="ms-1"
                                            data-feather="info" style="height:12px;width:12px;"></span></span>
                                    <span class="badge bg-warning"><span class="badge-label">Warning</span><span
                                            class="ms-1" data-feather="alert-octagon"
                                            style="height:12px;width:12px;"></span></span>
                                    <span class="badge bg-danger"><span class="badge-label">Danger</span><span
                                            class="ms-1" data-feather="x"
                                            style="height:12px;width:12px;"></span></span>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Outline Badge with icons</h5>
                                </div>
                                <div class="card-body">
                                    <span class="badge bg-outline-secondary"><span
                                            class="badge-label">Secondary</span><span class="ms-1" data-feather="plus"
                                            style="height:12px;width:12px;"></span></span>
                                    <span class="badge bg-outline-success"><span class="badge-label">Success</span><span
                                            class="ms-1" data-feather="check"
                                            style="height:12px;width:12px;"></span></span>
                                    <span class="badge bg-outline-info"><span class="badge-label">Info</span><span
                                            class="ms-1" data-feather="info"
                                            style="height:12px;width:12px;"></span></span>
                                    <span class="badge bg-outline-warning"><span class="badge-label">Warning</span><span
                                            class="ms-1" data-feather="alert-octagon"
                                            style="height:12px;width:12px;"></span></span>
                                    <span class="badge bg-outline-danger"><span class="badge-label">Danger</span><span
                                            class="ms-1" data-feather="x"
                                            style="height:12px;width:12px;"></span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Badge with icons -->

            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection
