<?php $page = 'ui-avatar'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Avatars</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Avatars</h5>
                        </div>
                        <div class="card-body d-flex flex-wrap gap-2">
                            <span class="avatar avatar-xl me-2 avatar-rounded">
                                <img src="{{ URL::asset('/build/img/profiles/avatar-02.jpg') }}" alt="img">
                            </span>
                            <span class="avatar avatar-xl me-2 avatar-radius-0">
                                <img src="{{ URL::asset('/build/img/profiles/avatar-02.jpg') }}" alt="img">
                            </span>
                            <span class="avatar avatar-xl me-2">
                                <img src="{{ URL::asset('/build/img/profiles/avatar-02.jpg') }}" alt="img">
                            </span>
                            <span class="avatar avatar-xl bg-primary avatar-rounded">
                                <span class="avatar-title">SR</span>
                            </span>
                            <span class="avatar avatar-xl bg-success avatar-radius-0">
                                <span class="avatar-title">SR</span>
                            </span>
                            <span class="avatar avatar-xl bg-danger">
                                <span class="avatar-title">SR</span>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Avatar Sizes</h5>
                        </div>
                        <div class="card-body">
                            <span class="avatar avatar-xs me-2">
                                <img src="{{ URL::asset('/build/img/profiles/avatar-02.jpg') }}" alt="img">
                            </span>
                            <span class="avatar avatar-sm me-2">
                                <img src="{{ URL::asset('/build/img/profiles/avatar-02.jpg') }}" alt="img">
                            </span>
                            <span class="avatar avatar-md me-2">
                                <img src="{{ URL::asset('/build/img/profiles/avatar-02.jpg') }}" alt="img">
                            </span>
                            <span class="avatar avatar-lg me-2">
                                <img src="{{ URL::asset('/build/img/profiles/avatar-02.jpg') }}" alt="img">
                            </span>
                            <span class="avatar avatar-xl me-2">
                                <img src="{{ URL::asset('/build/img/profiles/avatar-02.jpg') }}" alt="img">
                            </span>
                            <span class="avatar avatar-xxl me-2">
                                <img src="{{ URL::asset('/build/img/profiles/avatar-02.jpg') }}" alt="img">
                            </span>
                            <span class="avatar avatar-xxxl me-2">
                                <img src="{{ URL::asset('/build/img/profiles/avatar-02.jpg') }}" alt="img">
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Avatar With Badge</h5>
                        </div>
                        <div class="card-body">
                            <span class="avatar avatar-xs me-2 online avatar-rounded">
                                <img src="{{ URL::asset('/build/img/profiles/avatar-03.jpg') }}" alt="img">
                            </span>
                            <span class="avatar avatar-sm online me-2 avatar-rounded">
                                <img src="{{ URL::asset('/build/img/profiles/avatar-03.jpg') }}" alt="img">
                            </span>
                            <span class="avatar avatar-md me-2 online avatar-rounded">
                                <img src="{{ URL::asset('/build/img/profiles/avatar-03.jpg') }}" alt="img">
                            </span>
                            <span class="avatar avatar-lg me-2 online avatar-rounded">
                                <img src="{{ URL::asset('/build/img/profiles/avatar-03.jpg') }}" alt="img">
                            </span>
                            <span class="avatar avatar-xl me-2 online avatar-rounded">
                                <img src="{{ URL::asset('/build/img/profiles/avatar-03.jpg') }}" alt="img">
                            </span>
                            <span class="avatar avatar-xxl me-2 online avatar-rounded">
                                <img src="{{ URL::asset('/build/img/profiles/avatar-03.jpg') }}" alt="img">
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Avatar With Badge</h5>
                        </div>
                        <div class="card-body">
                            <span class="avatar avatar-xs me-2 avatar-rounded">
                                <img src="{{ URL::asset('/build/img/profiles/avatar-02.jpg') }}" alt="img">
                                <span class="badge rounded-pill bg-primary avatar-badge">2</span>
                            </span>
                            <span class="avatar avatar-sm me-2 avatar-rounded">
                                <img src="{{ URL::asset('/build/img/profiles/avatar-02.jpg') }}" alt="img">
                                <span class="badge rounded-pill bg-secondary avatar-badge">5</span>
                            </span>
                            <span class="avatar avatar-md me-2 avatar-rounded">
                                <img src="{{ URL::asset('/build/img/profiles/avatar-02.jpg') }}" alt="img">
                                <span class="badge rounded-pill bg-warning avatar-badge">1</span>
                            </span>
                            <span class="avatar avatar-lg me-2 avatar-rounded">
                                <img src="{{ URL::asset('/build/img/profiles/avatar-02.jpg') }}" alt="img">
                                <span class="badge rounded-pill bg-info avatar-badge">7</span>
                            </span>
                            <span class="avatar avatar-xl me-2 avatar-rounded">
                                <img src="{{ URL::asset('/build/img/profiles/avatar-02.jpg') }}" alt="img">
                                <span class="badge rounded-pill bg-success avatar-badge">3</span>
                            </span>
                            <span class="avatar avatar-xxl me-2 avatar-rounded">
                                <img src="{{ URL::asset('/build/img/profiles/avatar-02.jpg') }}" alt="img">
                                <span class="badge rounded-pill bg-danger avatar-badge">9</span>
                            </span>

                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Avatar With Badge</h5>
                        </div>
                        <div class="card-body">
                            <span class="avatar bg-primary avatar-rounded">
                                <span class="avatar-title">SR</span>
                            </span>
                            <span class="avatar bg-danger avatar-rounded">
                                <span class="avatar-title">SR</span>
                            </span>
                            <span class="avatar bg-success avatar-rounded">
                                <span class="avatar-title">SR</span>
                            </span>
                            <span class="avatar bg-warning avatar-rounded">
                                <span class="avatar-title">SR</span>
                            </span>
                            <span class="avatar bg-info avatar-rounded">
                                <span class="avatar-title">SR</span>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Avatar With Badge</h5>
                        </div>
                        <div class="card-body">
                            <span class="avatar bg-soft-secondary avatar-rounded">
                                <span class="avatar-title">SR</span>
                            </span>
                            <span class="avatar bg-soft-danger avatar-rounded">
                                <span class="avatar-title">SR</span>
                            </span>
                            <span class="avatar bg-soft-success avatar-rounded">
                                <span class="avatar-title">SR</span>
                            </span>
                            <span class="avatar bg-soft-danger avatar-rounded">
                                <span class="avatar-title">SR</span>
                            </span>
                            <span class="avatar bg-soft-info avatar-rounded">
                                <span class="avatar-title">SR</span>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Avatar With Badge</h5>
                        </div>
                        <div class="card-body">
                            <div class="avatar-list-stacked avatar-group-lg mb-4">
                                <span class="avatar">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-04.jpg') }}" alt="img">
                                </span>
                                <span class="avatar">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-04.jpg') }}" alt="img">
                                </span>
                                <span class="avatar">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-04.jpg') }}" alt="img">
                                </span>
                                <a class="avatar bg-primary text-fixed-white" href="javascript:void(0);">
                                    +8
                                </a>
                            </div>
                            <div class="avatar-list-stacked mb-4">
                                <span class="avatar">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-04.jpg') }}" alt="img">
                                </span>
                                <span class="avatar">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-04.jpg') }}" alt="img">
                                </span>
                                <span class="avatar">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-04.jpg') }}" alt="img">
                                </span>
                                <a class="avatar bg-primary text-fixed-white" href="javascript:void(0);">
                                    +8
                                </a>
                            </div>
                            <div class="avatar-list-stacked avatar-group-sm">
                                <span class="avatar">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-04.jpg') }}" alt="img">
                                </span>
                                <span class="avatar">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-04.jpg') }}" alt="img">
                                </span>
                                <span class="avatar">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-04.jpg') }}" alt="img">
                                </span>
                                <a class="avatar bg-primary text-fixed-white" href="javascript:void(0);">
                                    +8
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Avatar With Badge</h5>
                        </div>
                        <div class="card-body">
                            <div class="avatar-list-stacked avatar-group-lg mb-4">
                                <span class="avatar avatar-rounded">
                                    <img class="border border-white"
                                        src="{{ URL::asset('/build/img/profiles/avatar-05.jpg') }}" alt="img">
                                </span>
                                <span class="avatar avatar-rounded">
                                    <img class="border border-white"
                                        src="{{ URL::asset('/build/img/profiles/avatar-05.jpg') }}" alt="img">
                                </span>
                                <span class="avatar avatar-rounded">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-05.jpg') }}" alt="img">
                                </span>
                                <a class="avatar bg-primary avatar-rounded text-fixed-white" href="javascript:void(0);">
                                    +8
                                </a>
                            </div>
                            <div class="avatar-list-stacked mb-4">
                                <span class="avatar avatar-rounded">
                                    <img class="border border-white"
                                        src="{{ URL::asset('/build/img/profiles/avatar-05.jpg') }}" alt="img">
                                </span>
                                <span class="avatar avatar-rounded">
                                    <img class="border border-white"
                                        src="{{ URL::asset('/build/img/profiles/avatar-05.jpg') }}" alt="img">
                                </span>
                                <span class="avatar avatar-rounded">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-05.jpg') }}" alt="img">
                                </span>
                                <a class="avatar bg-primary avatar-rounded text-fixed-white" href="javascript:void(0);">
                                    +8
                                </a>
                            </div>
                            <div class="avatar-list-stacked avatar-group-sm">
                                <span class="avatar avatar-rounded">
                                    <img class="border border-white"
                                        src="{{ URL::asset('/build/img/profiles/avatar-05.jpg') }}" alt="img">
                                </span>
                                <span class="avatar avatar-rounded">
                                    <img class="border border-white"
                                        src="{{ URL::asset('/build/img/profiles/avatar-05.jpg') }}" alt="img">
                                </span>
                                <span class="avatar avatar-rounded">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-05.jpg') }}" alt="img">
                                </span>
                                <a class="avatar bg-primary avatar-rounded text-fixed-white" href="javascript:void(0);">
                                    +8
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
