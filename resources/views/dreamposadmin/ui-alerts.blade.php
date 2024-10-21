<?php $page = 'ui-alerts'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Alerts</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Default Alerts</h5>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-primary" role="alert">
                                A simple primary alert—check it out!
                            </div>
                            <div class="alert alert-secondary" role="alert">
                                A simple secondary alert—check it out!
                            </div>
                            <div class="alert alert-success" role="alert">
                                A simple success alert—check it out!
                            </div>
                            <div class="alert alert-danger" role="alert">
                                A simple danger alert—check it out!
                            </div>
                            <div class="alert alert-warning" role="alert">
                                A simple warning alert—check it out!
                            </div>
                            <div class="alert alert-info" role="alert">
                                A simple info alert—check it out!
                            </div>
                            <div class="alert alert-light" role="alert">
                                A simple light alert—check it out!
                            </div>
                            <div class="alert alert-dark" role="alert">
                                A simple dark alert—check it out!
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Links in alerts</h5>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-primary" role="alert">
                                A simple primary alert with <a href="#" class="alert-link">an example
                                    link</a>.
                                Give it a click if you like.
                            </div>
                            <div class="alert alert-secondary" role="alert">
                                A simple secondary alert with <a href="#" class="alert-link">an example
                                    link</a>. Give it a click if you like.
                            </div>
                            <div class="alert alert-success" role="alert">
                                A simple success alert with <a href="#" class="alert-link">an example
                                    link</a>.
                                Give it a click if you like.
                            </div>
                            <div class="alert alert-danger" role="alert">
                                A simple danger alert with <a href="#" class="alert-link">an example
                                    link</a>.
                                Give it a click if you like.
                            </div>
                            <div class="alert alert-warning" role="alert">
                                A simple warning alert with <a href="#" class="alert-link">an example
                                    link</a>.
                                Give it a click if you like.
                            </div>
                            <div class="alert alert-info" role="alert">
                                A simple info alert with <a href="#" class="alert-link">an example link</a>.
                                Give it a click if you like.
                            </div>
                            <div class="alert alert-light" role="alert">
                                A simple light alert with <a href="#" class="alert-link">an example
                                    link</a>.
                                Give it a click if you like.
                            </div>
                            <div class="alert alert-dark" role="alert">
                                A simple dark alert with <a href="#" class="alert-link">an example link</a>.
                                Give it a click if you like.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Solid Colored Alerts</h5>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-solid-primary alert-dismissible fade show">
                                A simple solid primary alert—check it out!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="fas fa-xmark"></i></button>
                            </div>
                            <div class="alert alert-solid-secondary alert-dismissible fade show">
                                A simple solid secondary alert—check it out!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="fas fa-xmark"></i></button>
                            </div>
                            <div class="alert alert-solid-info alert-dismissible fade show">
                                A simple solid info alert—check it out!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="fas fa-xmark"></i></button>
                            </div>
                            <div class="alert alert-solid-warning alert-dismissible fade show">
                                A simple solid warning alert—check it out!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="fas fa-xmark"></i></button>
                            </div>
                            <div class="alert alert-solid-success alert-dismissible fade show">
                                A simple solid success alert—check it out!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="fas fa-xmark"></i></button>
                            </div>
                            <div class="alert alert-solid-danger alert-dismissible fade show">
                                A simple solid danger alert—check it out!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="fas fa-xmark"></i></button>
                            </div>
                            <div class="alert alert-solid-light alert-dismissible fade show">
                                A simple solid light alert—check it out!
                                <button type="button" class="btn-close text-default" data-bs-dismiss="alert"
                                    aria-label="Close"><i class="fas fa-xmark"></i></button>
                            </div>
                            <div class="alert alert-solid-dark alert-dismissible fade show text-white">
                                A simple solid dark alert—check it out!
                                <button type="button" class="btn-close text-white" data-bs-dismiss="alert"
                                    aria-label="Close"><i class="fas fa-xmark"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Outline Alerts </h5>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-outline-primary alert-dismissible fade show">
                                A simple outline primary alert—check it out!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="fas fa-xmark"></i></button>
                            </div>
                            <div class="alert alert-outline-secondary alert-dismissible fade show">
                                A simple outline secondary alert—check it out!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="fas fa-xmark"></i></button>
                            </div>
                            <div class="alert alert-outline-info alert-dismissible fade show">
                                A simple outline info alert—check it out!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="fas fa-xmark"></i></button>
                            </div>
                            <div class="alert alert-outline-warning alert-dismissible fade show">
                                A simple outline warning alert—check it out!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="fas fa-xmark"></i></button>
                            </div>
                            <div class="alert alert-outline-success alert-dismissible fade show">
                                A simple outline success alert—check it out!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="fas fa-xmark"></i></button>
                            </div>
                            <div class="alert alert-outline-danger alert-dismissible fade show">
                                A simple outline danger alert—check it out!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="fas fa-xmark"></i></button>
                            </div>
                            <div class="alert alert-outline-light alert-dismissible fade show">
                                A simple outline light alert—check it out!
                                <button type="button" class="btn-close text-default" data-bs-dismiss="alert"
                                    aria-label="Close"><i class="fas fa-xmark"></i></button>
                            </div>
                            <div class="alert alert-outline-dark alert-dismissible fade show">
                                A simple outline dark alert—check it out!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="fas fa-xmark"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Rounded Solid Alerts</h5>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-solid-primary rounded-pill alert-dismissible fade show">
                                A simple solid rounded primary alert—check it out!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="fas fa-xmark"></i></button>
                            </div>
                            <div class="alert alert-solid-secondary rounded-pill alert-dismissible fade show">
                                A simple solid rounded secondary alert—check it out!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="fas fa-xmark"></i></button>
                            </div>
                            <div class="alert alert-solid-warning rounded-pill alert-dismissible fade show">
                                A simple solid rounded warning alert—check it out!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="fas fa-xmark"></i></button>
                            </div>
                            <div class="alert alert-solid-danger rounded-pill alert-dismissible fade show">
                                A simple solid rounded danger alert—check it out!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="fas fa-xmark"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Rounded Outline Alerts</h5>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-outline-primary rounded-pill alert-dismissible fade show">
                                A simple outline rounded primary alert—check it out!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="fas fa-xmark"></i></button>
                            </div>
                            <div class="alert alert-outline-secondary rounded-pill alert-dismissible fade show">
                                A simple outline rounded secondary alert—check it out!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="fas fa-xmark"></i></button>
                            </div>
                            <div class="alert alert-outline-warning rounded-pill alert-dismissible fade show">
                                A simple outline rounded warning alert—check it out!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="fas fa-xmark"></i></button>
                            </div>
                            <div class="alert alert-outline-danger rounded-pill alert-dismissible fade show">
                                A simple outline rounded danger alert—check it out!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="fas fa-xmark"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Rounded Default Alerts
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-primary rounded-pill alert-dismissible fade show">
                                A simple rounded primary alert—check it out!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="fas fa-xmark"></i></button>
                            </div>
                            <div class="alert alert-secondary rounded-pill alert-dismissible fade show">
                                A simple rounded secondary alert—check it out!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="fas fa-xmark"></i></button>
                            </div>
                            <div class="alert alert-warning rounded-pill alert-dismissible fade show">
                                A simple rounded warning alert—check it out!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="fas fa-xmark"></i></button>
                            </div>
                            <div class="alert alert-danger rounded-pill alert-dismissible fade show">
                                A simple rounded danger alert—check it out!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="fas fa-xmark"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Rounded Alerts With Custom Close Button
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-primary rounded-pill alert-dismissible fade show">
                                A simple rounded primary alert—check it out!
                                <button type="button" class="btn-close custom-close" data-bs-dismiss="alert"
                                    aria-label="Close"><i class="fas fa-xmark"></i></button>
                            </div>
                            <div class="alert alert-secondary rounded-pill alert-dismissible fade show">
                                A simple rounded secondary alert—check it out!
                                <button type="button" class="btn-close custom-close" data-bs-dismiss="alert"
                                    aria-label="Close"><i class="fas fa-xmark"></i></button>
                            </div>
                            <div class="alert alert-warning rounded-pill alert-dismissible fade show">
                                A simple rounded warning alert—check it out!
                                <button type="button" class="btn-close custom-close" data-bs-dismiss="alert"
                                    aria-label="Close"><i class="fas fa-xmark"></i></button>
                            </div>
                            <div class="alert alert-danger rounded-pill alert-dismissible fade show">
                                A simple rounded danger alert—check it out!
                                <button type="button" class="btn-close custom-close" data-bs-dismiss="alert"
                                    aria-label="Close"><i class="fas fa-xmark"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Alerts with icons</h5>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-primary d-flex align-items-center" role="alert">
                                <i class="feather-info flex-shrink-0 me-2"></i>
                                <div>
                                    An example alert with an icon
                                </div>
                            </div>
                            <div class="alert alert-success d-flex align-items-center" role="alert">
                                <i class="feather-check-circle flex-shrink-0 me-2"></i>
                                <div>
                                    An example success alert with an icon
                                </div>
                            </div>
                            <div class="alert alert-warning d-flex align-items-center" role="alert">
                                <i class="feather-alert-triangle flex-shrink-0 me-2"></i>
                                <div>
                                    An example warning alert with an icon
                                </div>
                            </div>
                            <div class="alert alert-danger d-flex align-items-center" role="alert">
                                <i class="feather-alert-octagon flex-shrink-0 me-2"></i>
                                <div>
                                    An example danger alert with an icon
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Customized Alerts With Icons</h5>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-primary alert-dismissible fade show custom-alert-icon shadow-sm d-flex align-items-center"
                                role="alert">
                                <i class="feather-info flex-shrink-0 me-2"></i>
                                A customized primary alert with an icon
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="fas fa-xmark"></i></button>
                            </div>
                            <div class="alert alert-secondary alert-dismissible fade show custom-alert-icon shadow-sm d-flex align-items-center"
                                role="alert">
                                <i class="feather-check-circle flex-shrink-0 me-2"></i>
                                A customized secondary alert with an icon
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="fas fa-xmark"></i></button>
                            </div>
                            <div class="alert alert-warning alert-dismissible fade show custom-alert-icon shadow-sm d-flex align-items-center"
                                role="alert">
                                <i class="feather-alert-triangle flex-shrink-0 me-2"></i>
                                A customized warning alert with an icon
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="fas fa-xmark"></i></button>
                            </div>
                            <div class="alert alert-danger alert-dismissible fade show custom-alert-icon shadow-sm d-flex align-items-centers"
                                role="alert">
                                <i class="feather-alert-octagon flex-shrink-0 me-2"></i>
                                A customized danger alert with an icon
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="fas fa-xmark"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-xl-3">
                                    <div class="card border-0">
                                        <div class="alert alert-primary border border-primary mb-0 p-3">
                                            <div class="d-flex align-items-start">
                                                <div class="me-2">
                                                    <i class="feather-info flex-shrink-0"></i>
                                                </div>
                                                <div class="text-primary w-100">
                                                    <div class="fw-semibold d-flex justify-content-between">Information
                                                        Alert<button type="button" class="btn-close p-0"
                                                            data-bs-dismiss="alert" aria-label="Close"><i
                                                                class="fas fa-xmark"></i></button></div>
                                                    <div class="fs-12 op-8 mb-1">Information alert to show to information
                                                        message</div>
                                                    <div class="fs-12">
                                                        <a href="javascript:void(0);"
                                                            class="text-secondary fw-semibold me-2 d-inline-block">cancel</a>
                                                        <a href="javascript:void(0);"
                                                            class="text-primary fw-semibold">open</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3">
                                    <div class="card border-0">
                                        <div class="alert alert-secondary border border-secondary mb-0 p-3">
                                            <div class="d-flex align-items-start">
                                                <div class="me-2">
                                                    <i class="feather-check-circle flex-shrink-0"></i>
                                                </div>
                                                <div class="text-secondary w-100">
                                                    <div class="fw-semibold d-flex justify-content-between">Success
                                                        Alert<button type="button" class="btn-close p-0"
                                                            data-bs-dismiss="alert" aria-label="Close"><i
                                                                class="fas fa-xmark"></i></button></div>
                                                    <div class="fs-12 op-8 mb-1">Success alert to show to success message
                                                    </div>
                                                    <div class="fs-12">
                                                        <a href="javascript:void(0);"
                                                            class="text-danger fw-semibold me-2 d-inline-block">cancel</a>
                                                        <a href="javascript:void(0);"
                                                            class="text-secondary fw-semibold">open</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3">
                                    <div class="card border-0">
                                        <div class="alert alert-warning border border-warning mb-0 p-3">
                                            <div class="d-flex align-items-start">
                                                <div class="me-2">
                                                    <i class="feather-alert-triangle flex-shrink-0"></i>
                                                </div>
                                                <div class="text-warning w-100">
                                                    <div class="fw-semibold d-flex justify-content-between">Warning
                                                        Alert<button type="button" class="btn-close p-0"
                                                            data-bs-dismiss="alert" aria-label="Close"><i
                                                                class="fas fa-xmark"></i></button></div>
                                                    <div class="fs-12 op-8 mb-1">Warning alert to show warning message
                                                    </div>
                                                    <div class="fs-12">
                                                        <a href="javascript:void(0);"
                                                            class="text-dark fw-semibold me-2 d-inline-block">cancel</a>
                                                        <a href="javascript:void(0);"
                                                            class="text-warning fw-semibold">open</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3">
                                    <div class="card border-0">
                                        <div class="alert alert-danger border border-danger mb-0 p-3">
                                            <div class="d-flex align-items-start">
                                                <div class="me-2">
                                                    <i class="feather-alert-octagon flex-shrink-0"></i>
                                                </div>
                                                <div class="text-danger w-100">
                                                    <div class="fw-semibold d-flex justify-content-between">Danger
                                                        Alert<button type="button" class="btn-close p-0"
                                                            data-bs-dismiss="alert" aria-label="Close"><i
                                                                class="fas fa-xmark"></i></button></div>
                                                    <div class="fs-12 op-8 mb-1">Danger alert to show the danger message
                                                    </div>
                                                    <div class="fs-12">
                                                        <a href="javascript:void(0);"
                                                            class="text-info fw-semibold me-2 d-inline-block">cancel</a>
                                                        <a href="javascript:void(0);"
                                                            class="text-danger fw-semibold">open</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-3">
                                    <div class="card border-0">
                                        <div class="alert alert-solid-primary border border-primary mb-0 p-3">
                                            <div class="d-flex align-items-start">
                                                <div class="me-2">
                                                    <i class="feather-info flex-shrink-0"></i>
                                                </div>
                                                <div class="text-fixed-white w-100">
                                                    <div class="fw-semibold d-flex justify-content-between">Information
                                                        Alert<button type="button" class="btn-close p-0"
                                                            data-bs-dismiss="alert" aria-label="Close"><i
                                                                class="fas fa-xmark"></i></button></div>
                                                    <div class="fs-12 op-8 mb-1">Information alert to show to information
                                                        message</div>
                                                    <div class="fs-12">
                                                        <a href="javascript:void(0);"
                                                            class="text-fixed-white fw-semibold me-2 op-7">cancel</a>
                                                        <a href="javascript:void(0);"
                                                            class="text-fixed-white fw-semibold">open</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3">
                                    <div class="card border-0">
                                        <div class="alert alert-solid-secondary border border-secondary mb-0 p-3">
                                            <div class="d-flex align-items-start">
                                                <div class="me-2">
                                                    <i class="feather-check-circle flex-shrink-0"></i>
                                                </div>
                                                <div class="text-fixed-white w-100">
                                                    <div class="fw-semibold d-flex justify-content-between">Success
                                                        Alert<button type="button" class="btn-close p-0"
                                                            data-bs-dismiss="alert" aria-label="Close"><i
                                                                class="fas fa-xmark"></i></button></div>
                                                    <div class="fs-12 op-8 mb-1">Success alert to show to success message
                                                    </div>
                                                    <div class="fs-12">
                                                        <a href="javascript:void(0);"
                                                            class="text-fixed-white fw-semibold me-2">close</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3">
                                    <div class="card border-0">
                                        <div class="alert alert-solid-warning border border-warning mb-0 p-3">
                                            <div class="d-flex align-items-start">
                                                <div class="me-2">
                                                    <i class="feather-alert-triangle flex-shrink-0"></i>
                                                </div>
                                                <div class="text-fixed-white w-100">
                                                    <div class="fw-semibold d-flex justify-content-between">Warning
                                                        Alert<button type="button" class="btn-close p-0"
                                                            data-bs-dismiss="alert" aria-label="Close"><i
                                                                class="fas fa-xmark"></i></button></div>
                                                    <div class="fs-12 op-8 mb-1">Warning alert to show to warning message
                                                    </div>
                                                    <div class="fs-12">
                                                        <a href="javascript:void(0);"
                                                            class="text-fixed-white fw-semibold me-2 op-7">skip</a>
                                                        <a href="javascript:void(0);"
                                                            class="text-fixed-white fw-semibold">open</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3">
                                    <div class="card border-0">
                                        <div class="alert alert-solid-danger border border-danger mb-0 p-3">
                                            <div class="d-flex align-items-start">
                                                <div class="me-2">
                                                    <i class="feather-alert-octagon flex-shrink-0"></i>
                                                </div>
                                                <div class="text-fixed-white w-100">
                                                    <div class="fw-semibold d-flex justify-content-between">Danger
                                                        Alert<button type="button" class="btn-close p-0"
                                                            data-bs-dismiss="alert" aria-label="Close"><i
                                                                class="fas fa-xmark"></i></button></div>
                                                    <div class="fs-12 op-8 mb-1">Danger alert to show to danger message
                                                    </div>
                                                    <div class="fs-12">
                                                        <a href="javascript:void(0);"
                                                            class="text-fixed-white fw-semibold me-2 op-7">close</a>
                                                        <a href="javascript:void(0);"
                                                            class="text-fixed-white fw-semibold">continue</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Alerts With Images
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-img alert-primary alert-dismissible fase show rounded-pill flex-wrap"
                                role="alert">
                                <div class="avatar avatar-sm me-3 avatar-rounded">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-01.jpg')}}" alt="img">
                                </div>
                                <div>A simple primary alert with image—check it out!</div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="fas fa-xmark"></i></button>
                            </div>
                            <div class="alert alert-img alert-secondary alert-dismissible fase show rounded-pill flex-wrap"
                                role="alert">
                                <div class="avatar avatar-sm me-3 avatar-rounded">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-02.jpg')}}" alt="img">
                                </div>
                                <div>A simple secondary alert with image—check it out!</div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="fas fa-xmark"></i></button>
                            </div>
                            <div class="alert alert-img alert-warning alert-dismissible fase show rounded-pill flex-wrap"
                                role="alert">
                                <div class="avatar avatar-sm me-3 avatar-rounded">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-03.jpg')}}" alt="img">
                                </div>
                                <div>A simple warning alert with image—check it out!</div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="fas fa-xmark"></i></button>
                            </div>
                            <div class="alert alert-img alert-danger alert-dismissible fase show rounded-pill flex-wrap"
                                role="alert">
                                <div class="avatar avatar-sm me-3 avatar-rounded">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-04.jpg')}}" alt="img">
                                </div>
                                <div>A simple danger alert with image—check it out!</div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="fas fa-xmark"></i></button>
                            </div>
                            <div class="alert alert-img alert-info alert-dismissible fase show rounded-pill flex-wrap"
                                role="alert">
                                <div class="avatar avatar-sm me-3 avatar-rounded">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-05.jpg')}}" alt="img">
                                </div>
                                <div>A simple info alert with image—check it out!</div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="fas fa-xmark"></i></button>
                            </div>
                            <div class="alert alert-img alert-light alert-dismissible fase show rounded-pill flex-wrap"
                                role="alert">
                                <div class="avatar avatar-sm me-3 avatar-rounded">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-06.jpg')}}" alt="img">
                                </div>
                                <div>A simple light alert with image—check it out!</div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="fas fa-xmark"></i></button>
                            </div>
                            <div class="alert alert-img alert-dark alert-dismissible fase show rounded-pill flex-wrap"
                                role="alert">
                                <div class="avatar avatar-sm me-3 avatar-rounded">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-07.jpg')}}" alt="img">
                                </div>
                                <div>A simple dark alert with image—check it out!</div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="fas fa-xmark text-muted"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Alerts With Different size Images
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-img alert-primary alert-dismissible fase show flex-wrap"
                                role="alert">
                                <div class="avatar avatar-xs me-3">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-02.jpg')}}" alt="img">
                                </div>
                                <div>A simple primary alert with image—check it out!</div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="fas fa-xmark"></i></button>
                            </div>
                            <div class="alert alert-img alert-secondary alert-dismissible fase show flex-wrap"
                                role="alert">
                                <div class="avatar avatar-sm me-3">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-02.jpg')}}" alt="img">
                                </div>
                                <div>A simple secondary alert with image—check it out!</div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="fas fa-xmark"></i></button>
                            </div>
                            <div class="alert alert-img alert-warning alert-dismissible fase show flex-wrap"
                                role="alert">
                                <div class="avatar me-3">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-02.jpg')}}" alt="img">
                                </div>
                                <div>A simple warning alert with image—check it out!</div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="fas fa-xmark"></i></button>
                            </div>
                            <div class="alert alert-img alert-danger alert-dismissible fase show flex-wrap"
                                role="alert">
                                <div class="avatar avatar-md me-3">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-02.jpg')}}" alt="img">
                                </div>
                                <div>A simple danger alert with image—check it out!</div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="fas fa-xmark"></i></button>
                            </div>
                            <div class="alert alert-img alert-info alert-dismissible fase show flex-wrap" role="alert">
                                <div class="avatar avatar-lg me-3">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-02.jpg')}}" alt="img">
                                </div>
                                <div>A simple info alert with image—check it out!</div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="fas fa-xmark"></i></button>
                            </div>
                            <div class="alert alert-img alert-dark alert-dismissible fase show flex-wrap" role="alert">
                                <div class="avatar avatar-xl me-3">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-02.jpg')}}" alt="img">
                                </div>
                                <div>A simple info alert with image—check it out!</div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                                        class="fas fa-xmark text-muted"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="card bg-white border-0">
                                <div class="alert custom-alert1 alert-primary">
                                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"
                                        aria-label="Close"><i class="fas fa-xmark"></i></button>
                                    <div class="text-center  px-5 pb-0">
                                        <div class="custom-alert-icon">
                                            <i class="feather-info flex-shrink-0"></i>
                                        </div>
                                        <h5>Information?</h5>
                                        <p class="">This alert is created to just show the related information.</p>
                                        <div class="">
                                            <button class="btn btn-sm btn-outline-danger m-1">Decline</button>
                                            <button class="btn btn-sm btn-primary m-1">Accept</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="card bg-white border-0">
                                <div class="alert custom-alert1 alert-secondary">
                                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"
                                        aria-label="Close"><i class="fas fa-xmark"></i></button>
                                    <div class="text-center px-5 pb-0">
                                        <div class="custom-alert-icon">
                                            <i class="feather-check-circle flex-shrink-0"></i>
                                        </div>
                                        <h5>Confirmed</h5>
                                        <p class="">This alert is created to just show the confirmation message.</p>
                                        <div class="">
                                            <button class="btn btn-sm btn-secondary m-1">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="card bg-white border-0">
                                <div class="alert custom-alert1 alert-warning">
                                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"
                                        aria-label="Close"><i class="fas fa-xmark"></i></button>
                                    <div class="text-center px-5 pb-0">
                                        <div class="custom-alert-icon">
                                            <i class="feather-alert-triangle flex-shrink-0"></i>
                                        </div>
                                        <h5>Warning</h5>
                                        <p class="">This alert is created to just show the warning message.</p>
                                        <div class="">
                                            <button class="btn btn-sm btn-outline-secondary m-1">Back</button>
                                            <button class="btn btn-sm btn-warning m-1">Continue</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="card bg-white border-0">
                                <div class="alert custom-alert1 alert-danger">
                                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"
                                        aria-label="Close"><i class="fas fa-xmark"></i></button>
                                    <div class="text-center px-5 pb-0">
                                        <div class="custom-alert-icon">
                                            <i class="feather-alert-octagon flex-shrink-0"></i>
                                        </div>
                                        <h5>danger</h5>
                                        <p class="">This alert is created to just show the danger message.</p>
                                        <div class="">
                                            <button class="btn btn-sm btn-danger m-1">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Additional content
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="row gy-3">
                                <div class="col-xl-6">
                                    <div class="alert alert-primary overflow-hidden p-0" role="alert">
                                        <div class="p-3 bg-primary text-fixed-white d-flex justify-content-between">
                                            <h6 class="aletr-heading mb-0 text-fixed-white">Thank you for reporting this.
                                            </h6>
                                            <button type="button" class="btn-close p-0 text-fixed-white"
                                                data-bs-dismiss="alert" aria-label="Close"><i
                                                    class="fas fa-xmark"></i></button>
                                        </div>
                                        <hr class="my-0">
                                        <div class="p-3">
                                            <p class="mb-0">We appreciate you to let us know the bug in the template and
                                                for warning us about future consequences <a href="javascript:void(0);"
                                                    class="fw-semibold text-decoration-underline text-primary">Visit for
                                                    support for queries ?</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="alert alert-secondary overflow-hidden p-0" role="alert">
                                        <div class="p-3 bg-secondary text-fixed-white d-flex justify-content-between">
                                            <h6 class="aletr-heading mb-0 text-fixed-white">Thank you for reporting this.
                                            </h6>
                                            <button type="button" class="btn-close p-0 text-fixed-white"
                                                data-bs-dismiss="alert" aria-label="Close"><i
                                                    class="fas fa-xmark"></i></button>
                                        </div>
                                        <hr class="my-0">
                                        <div class="p-3">
                                            <p class="mb-0">We appreciate you to let us know the bug in the template and
                                                for warning us about future consequences <a href="javascript:void(0);"
                                                    class="fw-semibold text-decoration-underline text-secondary">Visit for
                                                    support for queries ?</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="alert alert-success overflow-hidden p-0" role="alert">
                                        <div class="p-3 bg-success text-fixed-white d-flex justify-content-between">
                                            <h6 class="aletr-heading mb-0 text-fixed-white">Thank you for reporting this.
                                            </h6>
                                            <button type="button" class="btn-close p-0 text-fixed-white"
                                                data-bs-dismiss="alert" aria-label="Close"><i
                                                    class="fas fa-xmark"></i></button>
                                        </div>
                                        <hr class="my-0">
                                        <div class="p-3">
                                            <p class="mb-0">We appreciate you to let us know the bug in the template and
                                                for warning us about future consequences <a href="javascript:void(0);"
                                                    class="fw-semibold text-decoration-underline text-success">Visit for
                                                    support for queries ?</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="alert alert-warning overflow-hidden p-0" role="alert">
                                        <div class="p-3 bg-warning text-fixed-white d-flex justify-content-between">
                                            <h6 class="aletr-heading mb-0 text-fixed-white">Thank you for reporting this.
                                            </h6>
                                            <button type="button" class="btn-close p-0 text-fixed-white"
                                                data-bs-dismiss="alert" aria-label="Close"><i
                                                    class="fas fa-xmark"></i></button>
                                        </div>
                                        <hr class="my-0">
                                        <div class="p-3">
                                            <p class="mb-0">We appreciate you to let us know the bug in the template and
                                                for warning us about future consequences <a href="javascript:void(0);"
                                                    class="fw-semibold text-decoration-underline text-warning">Visit for
                                                    support for queries ?</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
