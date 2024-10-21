<?php $page = 'ui-toasts'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Toastr</h4>
                </div>
            </div>

            <div class="row">

                <!-- Toastr -->
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Live example
                            </div>
                        </div>
                        <div class="card-body">
                            <button type="button" class="btn btn-primary btn-wave" id="liveToastBtn">Show live
                                toast</button>
                            <div class="toast-container position-fixed top-0 end-0 p-3">
                                <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="toast-header text-default">

                                        <strong class="me-auto">Toast</strong>
                                        <small>11 mins ago</small>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                        Hello, world! This is a toast message.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Color schemes
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="toast align-items-center text-bg-primary border-0 fade show mb-4" role="alert"
                                aria-live="assertive" aria-atomic="true">
                                <div class="d-flex">
                                    <div class="toast-body">
                                        Hello, world! This is the Primary toast message.
                                    </div>
                                    <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                        data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                            </div>
                            <div class="toast align-items-center text-bg-secondary border-0 fade show mb-4" role="alert"
                                aria-live="assertive" aria-atomic="true">
                                <div class="d-flex">
                                    <div class="toast-body">
                                        Hello, world! This is the Secondary toast.
                                    </div>
                                    <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                        data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                            </div>
                            <div class="toast align-items-center text-bg-success border-0 fade show mb-4" role="alert"
                                aria-live="assertive" aria-atomic="true">
                                <div class="d-flex">
                                    <div class="toast-body">
                                        Hello, world! This is the Success toast message.
                                    </div>
                                    <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                        data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                            </div>
                            <div class="toast align-items-center text-bg-info border-0 fade show" role="alert"
                                aria-live="assertive" aria-atomic="true">
                                <div class="d-flex">
                                    <div class="toast-body">
                                        Hello, world! This is the info toast message.
                                    </div>
                                    <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                        data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Toastr -->

                <!-- Toastr -->
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Basic example
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="toast-header text-default">
                                    <strong class="me-auto">Toast</strong>
                                    <small>11 mins ago</small>
                                    <button type="button" class="btn-close" data-bs-dismiss="toast"
                                        aria-label="Close"></button>
                                </div>
                                <div class="toast-body">
                                    Hello, world! This is a toast message.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Stacking
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="toast-container position-static">
                                <div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="toast-header text-default">
                                        <strong class="me-auto">Toast</strong>
                                        <small class="text-muted">just now</small>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                        See? Just like this.
                                    </div>
                                </div>
                                <div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="toast-header text-default">
                                        <strong class="me-auto">Toast</strong>
                                        <small class="text-muted">2 seconds ago</small>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                        Heads up, toasts will stack automatically
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Toastr -->

                <!-- Translucent -->
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Translucent
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="toast-header text-default">
                                    <strong class="me-auto">Toast</strong>
                                    <small class="text-muted">11 mins ago</small>
                                    <button type="button" class="btn-close" data-bs-dismiss="toast"
                                        aria-label="Close"></button>
                                </div>
                                <div class="toast-body">
                                    Hello, world! This is a toast message.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Custom content
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="toast align-items-center fade show mb-3" role="alert" aria-live="assertive"
                                aria-atomic="true">
                                <div class="d-flex">
                                    <div class="toast-body">
                                        Hello, world! This is a toast message.
                                    </div>
                                    <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"
                                        aria-label="Close">
                                    </button>
                                </div>
                            </div>
                            <div>
                                <span class="my-4 text-muted">
                                    Alternatively, you can also add additional controls and components to
                                    toasts.
                                </span>
                            </div>
                            <div class="toast fade show mt-2" role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="toast-body">
                                    Hello, world! This is a toast message.
                                    <div class="mt-2 pt-2 border-top">
                                        <button type="button" class="btn btn-primary btn-sm btn-wave">Take
                                            action</button>
                                        <button type="button" class="btn btn-secondary btn-sm btn-wave"
                                            data-bs-dismiss="toast">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Translucent -->

            </div>

            <div class="row">

                <!-- Color Variants Live -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Color Variants Live
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="btn-list">
                                <button type="button" class="btn btn-primary-light me-2 btn-wave"
                                    id="primaryToastBtn">Primary</button>
                                <button type="button" class="btn btn-secondary-light me-2 btn-wave"
                                    id="secondaryToastBtn">secondary</button>
                                <button type="button" class="btn btn-warning-light me-2 btn-wave"
                                    id="warningToastBtn">warning</button>
                                <button type="button" class="btn btn-info-light me-2 btn-wave"
                                    id="infoToastBtn">info</button>
                                <button type="button" class="btn btn-success-light me-2 btn-wave"
                                    id="successToastBtn">success</button>
                                <button type="button" class="btn btn-danger-light me-2 btn-wave"
                                    id="dangerToastBtn">danger</button>
                            </div>
                            <div class="toast-container position-fixed top-0 end-0 p-3">
                                <div id="primaryToast" class="toast colored-toast bg-primary-transparent" role="alert"
                                    aria-live="assertive" aria-atomic="true">
                                    <div class="toast-header bg-primary text-fixed-white">
                                        <strong class="me-auto">Toast</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                        Your,toast message here.
                                    </div>
                                </div>
                                <div id="secondaryToast" class="toast colored-toast bg-secondary-transparent"
                                    role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="toast-header bg-secondary text-fixed-white">
                                        <strong class="me-auto">Toast</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                        Your,toast message here.
                                    </div>
                                </div>
                                <div id="warningToast" class="toast colored-toast bg-warning-transparent" role="alert"
                                    aria-live="assertive" aria-atomic="true">
                                    <div class="toast-header bg-warning text-fixed-white">
                                        <strong class="me-auto">Toast</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                        Your,toast message here.
                                    </div>
                                </div>
                                <div id="infoToast" class="toast colored-toast bg-info-transparent" role="alert"
                                    aria-live="assertive" aria-atomic="true">
                                    <div class="toast-header bg-info text-fixed-white">
                                        <strong class="me-auto">Toast</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                        Your,toast message here.
                                    </div>
                                </div>
                                <div id="successToast" class="toast colored-toast bg-success-transparent" role="alert"
                                    aria-live="assertive" aria-atomic="true">
                                    <div class="toast-header bg-success text-fixed-white">
                                        <strong class="me-auto">Toast</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                        Your,toast message here.
                                    </div>
                                </div>
                                <div id="dangerToast" class="toast colored-toast bg-danger-transparent" role="alert"
                                    aria-live="assertive" aria-atomic="true">
                                    <div class="toast-header bg-danger text-fixed-white">
                                        <strong class="me-auto">Toast</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                        Your,toast message here.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Color Variants Live -->

                <!-- Solid Background Toasts -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Solid Background Toasts
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="btn-list">
                                <button type="button" class="btn btn-primary me-2 btn-wave"
                                    id="solidprimaryToastBtn">Primary</button>
                                <button type="button" class="btn btn-secondary me-2 btn-wave"
                                    id="solidsecondaryToastBtn">secondary</button>
                                <button type="button" class="btn btn-warning me-2 btn-wave"
                                    id="solidwarningToastBtn">warning</button>
                                <button type="button" class="btn btn-info me-2 btn-wave"
                                    id="solidinfoToastBtn">info</button>
                                <button type="button" class="btn btn-success me-2 btn-wave"
                                    id="solidsuccessToastBtn">success</button>
                                <button type="button" class="btn btn-danger me-2 btn-wave"
                                    id="soliddangerToastBtn">danger</button>
                            </div>
                            <div class="toast-container position-fixed top-0 end-0 p-3">
                                <div id="solid-primaryToast" class="toast colored-toast bg-primary text-fixed-white"
                                    role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="toast-header bg-primary text-fixed-white">
                                        <strong class="me-auto">Toast</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                        Your,toast message here.
                                    </div>
                                </div>
                                <div id="solid-secondaryToast" class="toast colored-toast bg-secondary text-fixed-white"
                                    role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="toast-header bg-secondary text-fixed-white">
                                        <strong class="me-auto">Toast</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                        Your,toast message here.
                                    </div>
                                </div>
                                <div id="solid-warningToast" class="toast colored-toast bg-warning text-fixed-white"
                                    role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="toast-header bg-warning text-fixed-white">
                                        <strong class="me-auto">Toast</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                        Your,toast message here.
                                    </div>
                                </div>
                                <div id="solid-infoToast" class="toast colored-toast bg-info text-fixed-white"
                                    role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="toast-header bg-info text-fixed-white">
                                        <strong class="me-auto">Toast</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                        Your,toast message here.
                                    </div>
                                </div>
                                <div id="solid-successToast" class="toast colored-toast bg-success text-fixed-white"
                                    role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="toast-header bg-success text-fixed-white">
                                        <strong class="me-auto">Toast</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                        Your,toast message here.
                                    </div>
                                </div>
                                <div id="solid-dangerToast" class="toast colored-toast bg-danger text-fixed-white"
                                    role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="toast-header bg-danger text-fixed-white">
                                        <strong class="me-auto">Toast</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                        Your,toast message here.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Solid Background Toasts -->

            </div>

            <!-- Toast Placements -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Toast Placements
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="btn-list">
                                <button type="button" class="btn btn-outline-primary me-2 btn-wave"
                                    id="topleftToastBtn">Top Left</button>
                                <button type="button" class="btn btn-outline-primary me-2 btn-wave"
                                    id="topcenterToastBtn">Top Center</button>
                                <button type="button" class="btn btn-outline-primary me-2 btn-wave"
                                    id="toprightToastBtn">Top Right</button>
                                <button type="button" class="btn btn-outline-primary me-2 btn-wave"
                                    id="middleleftToastBtn">Middle Left</button>
                                <button type="button" class="btn btn-outline-primary me-2 btn-wave"
                                    id="middlecenterToastBtn">Middle Center</button>
                                <button type="button" class="btn btn-outline-primary me-2 btn-wave"
                                    id="middlerightToastBtn">Middle Right</button>
                                <button type="button" class="btn btn-outline-primary me-2 btn-wave"
                                    id="bottomleftToastBtn">Bottom Left</button>
                                <button type="button" class="btn btn-outline-primary me-2 btn-wave"
                                    id="bottomcenterToastBtn">Bottom Center</button>
                                <button type="button" class="btn btn-outline-primary me-2 btn-wave"
                                    id="bottomrightToastBtn">Bottom Right</button>
                            </div>
                            <div class="toast-container position-fixed top-0 start-0 p-3">
                                <div id="topleft-Toast" class="toast colored-toast bg-primary-transparent text-primary"
                                    role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="toast-header bg-primary text-fixed-white">
                                        <strong class="me-auto">Toast</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                        Your,toast message here.
                                    </div>
                                </div>
                            </div>
                            <div class="toast-container position-fixed top-0 start-50 translate-middle-x p-3">
                                <div id="topcenter-Toast" class="toast colored-toast bg-primary-transparent text-primary"
                                    role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="toast-header bg-primary text-fixed-white">
                                        <strong class="me-auto">Toast</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                        Your,toast message here.
                                    </div>
                                </div>
                            </div>
                            <div class="toast-container position-fixed top-0 end-0 p-3">
                                <div id="topright-Toast" class="toast colored-toast bg-primary-transparent text-primary"
                                    role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="toast-header bg-primary text-fixed-white">
                                        <strong class="me-auto">Toast</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                        Your,toast message here.
                                    </div>
                                </div>
                            </div>
                            <div class="toast-container position-fixed top-50 start-0 translate-middle-y p-3">
                                <div id="middleleft-Toast" class="toast colored-toast bg-primary-transparent text-primary"
                                    role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="toast-header bg-primary text-fixed-white">
                                        <strong class="me-auto">Toast</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                        Your,toast message here.
                                    </div>
                                </div>
                            </div>
                            <div class="toast-container position-fixed top-50 start-50 translate-middle">
                                <div id="middlecenter-Toast"
                                    class="toast colored-toast bg-primary-transparent text-primary" role="alert"
                                    aria-live="assertive" aria-atomic="true">
                                    <div class="toast-header bg-primary text-fixed-white">
                                        <strong class="me-auto">Toast</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                        Your,toast message here.
                                    </div>
                                </div>
                            </div>
                            <div class="toast-container position-fixed top-50 end-0 translate-middle-y p-3">
                                <div id="middleright-Toast"
                                    class="toast colored-toast bg-primary-transparent text-primary" role="alert"
                                    aria-live="assertive" aria-atomic="true">
                                    <div class="toast-header bg-primary text-fixed-white">
                                        <strong class="me-auto">Toast</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                        Your,toast message here.
                                    </div>
                                </div>
                            </div>
                            <div class="toast-container position-fixed bottom-0 start-0 p-3">
                                <div id="bottomleft-Toast" class="toast colored-toast bg-primary-transparent text-primary"
                                    role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="toast-header bg-primary text-fixed-white">
                                        <strong class="me-auto">Toast</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                        Your,toast message here.
                                    </div>
                                </div>
                            </div>
                            <div class="toast-container position-fixed bottom-0 start-50 translate-middle-x p-3">
                                <div id="bottomcenter-Toast"
                                    class="toast colored-toast bg-primary-transparent text-primary" role="alert"
                                    aria-live="assertive" aria-atomic="true">
                                    <div class="toast-header bg-primary text-fixed-white">
                                        <strong class="me-auto">Toast</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                        Your,toast message here.
                                    </div>
                                </div>
                            </div>
                            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                                <div id="bottomright-Toast"
                                    class="toast colored-toast bg-primary-transparent text-primary" role="alert"
                                    aria-live="assertive" aria-atomic="true">
                                    <div class="toast-header bg-primary text-fixed-white">
                                        <strong class="me-auto">Toast</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                        Your,toast message here.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Toast Placements -->

            <!-- Aligning Toast Using Flexbox -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Aligning Toast Using Flexbox
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="bd-example bd-example-toasts d-flex p-2">
                                <div aria-live="polite" aria-atomic="true"
                                    class="d-flex justify-content-center align-items-center w-100">
                                    <div class="toast fade show shadow-lg" role="alert" aria-live="assertive"
                                        aria-atomic="true">
                                        <div class="toast-header text-default">
                                            <strong class="me-auto">Toast</strong>
                                            <small>11 mins ago</small>
                                            <button type="button" class="btn-close" data-bs-dismiss="toast"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="toast-body">
                                            Hello, world! This is a toast message.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Aligning Toast Using Flexbox -->

        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection
