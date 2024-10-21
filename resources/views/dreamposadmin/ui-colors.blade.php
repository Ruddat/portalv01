<?php $page = 'ui-colors'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Colors</h4>
                </div>
            </div>
            <div class="row">

                <!-- Background Colors -->
                <div class="col-lg-12 col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Background Colors</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-wrap colors_parent">
                                <div>
                                    <div class="color-box bg-primary p-4"></div>
                                    <p class="flex-1 text-sm my-1 pt-1">Primary</p>
                                    <p class="flex-0 text-sm">#FF9F43</p>
                                </div>
                                <div>
                                    <div class="color-box bg-secondary p-4"></div>
                                    <p class="flex-1 text-sm my-1 pt-1">Secondary</p>
                                    <p class="flex-0 text-sm">#092C4C</p>
                                </div>
                                <div>
                                    <div class="color-box bg-warning p-4"></div>
                                    <p class="flex-1 text-sm my-1 pt-1">warning</p>
                                    <p class="flex-0 text-sm">#FF9900</p>
                                </div>
                                <div>
                                    <div class="color-box bg-info p-4"></div>
                                    <p class="flex-1 text-sm my-1 pt-1">info</p>
                                    <p class="flex-0 text-sm">#17a2b8</p>
                                </div>
                                <div>
                                    <div class="color-box bg-success p-4"></div>
                                    <p class="flex-1 text-sm my-1 pt-1">success</p>
                                    <p class="flex-0 text-sm">#28C76F</p>
                                </div>
                                <div>
                                    <div class="color-box bg-danger p-4"></div>
                                    <p class="flex-1 text-sm my-1 pt-1">danger</p>
                                    <p class="flex-0 text-sm">#FF0000</p>
                                </div>
                                <div>
                                    <div class="color-box bg-light border p-4"></div>
                                    <p class="flex-1 text-sm my-1 pt-1">light</p>
                                    <p class="flex-0 text-sm">#f8f9fa</p>
                                </div>
                                <div>
                                    <div class="color-box bg-dark p-4"></div>
                                    <p class="flex-1 text-sm my-1 pt-1">dark</p>
                                    <p class="flex-0 text-sm">#29344a</p>
                                </div>
                            </div>
                            <div class="row row-cols-12 d-flex align-items-center">
                                <div class="p-3 col">
                                    <div class="m-2 bg-primary mx-auto color-container"></div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.bg-primary</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 bg-secondary mx-auto color-container"></div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.bg-secondary</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 bg-warning mx-auto color-container"></div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.bg-warning</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 bg-info mx-auto color-container"></div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.bg-info</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 bg-success mx-auto color-container"></div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.bg-success</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 bg-danger mx-auto color-container"></div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.bg-danger</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 bg-light mx-auto color-container"></div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.bg-light</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 bg-dark mx-auto color-container"></div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.bg-dark</code></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Background Colors -->

                <!-- Transparent Colors -->
                <div class="col-lg-12 col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Background transparent colors</h5>
                        </div>
                        <div class="card-body">
                            <div class="row row-cols-12 d-flex align-items-center">
                                <div class="p-3 col">
                                    <div class="m-2 bg-soft-primary mx-auto color-container shadow-none"></div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.bg-primary-transparent</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 bg-soft-secondary mx-auto color-container shadow-none"></div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.bg-secondary-transparent</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 bg-soft-warning mx-auto color-container shadow-none"></div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.bg-warning-transparent</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 bg-soft-info mx-auto color-container shadow-none"></div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.bg-info-transparent</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 bg-soft-success mx-auto color-container shadow-none"></div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.bg-success-transparent</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 bg-soft-danger mx-auto color-container shadow-none"></div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.bg-danger-transparent</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 bg-soft-light mx-auto color-container"></div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.bg-light-transparent</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 bg-soft-dark mx-auto color-container shadow-none"></div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.bg-dark-transparent</code></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Transparent Colors -->

                <!-- Background gradients -->
                <div class="col-lg-12 col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                Background gradients
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row row-cols-12 d-flex align-items-center">
                                <div class="p-3 col">
                                    <div class="m-2 bg-primary-gradient mx-auto color-container"></div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.bg-primary-gradient</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 bg-secondary-gradient mx-auto color-container"></div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.bg-secondary-gradient</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 bg-warning-gradient mx-auto color-container"></div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.bg-warning-gradient</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 bg-info-gradient mx-auto color-container"></div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.bg-info-gradient</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 bg-success-gradient mx-auto color-container"></div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.bg-success-gradient</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 bg-danger-gradient mx-auto color-container"></div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.bg-danger-gradient</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 bg-light-gradient mx-auto color-container"></div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.bg-light-gradient</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 bg-dark-gradient mx-auto color-container"></div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.bg-dark-gradient</code></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Background gradients -->

                <!-- Outline Colors -->
                <div class="col-lg-12 col-sm-6">
                    <div class="card custom-card">
                        <div class="card-header">
                            <div class="card-title">
                                Background outline colors
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row row-cols-12 d-flex align-items-center">
                                <div class="p-3 col">
                                    <div class="m-2 bg-outline-primary mx-auto color-container"><i data-feather="smile"
                                            class="fs-18"></i></div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.bg-outline-primary</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 bg-outline-secondary mx-auto color-container"><i data-feather="smile"
                                            class="fs-18"></i></div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.bg-outline-secondary</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 bg-outline-warning mx-auto color-container"><i data-feather="smile"
                                            class="fs-18"></i></div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.bg-outline-warning</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 bg-outline-info mx-auto color-container"><i data-feather="smile"
                                            class="fs-18"></i></div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.bg-outline-info</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 bg-outline-success mx-auto color-container"><i data-feather="smile"
                                            class="fs-18"></i></div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.bg-outline-success</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 bg-outline-danger mx-auto color-container"><i data-feather="smile"
                                            class="fs-18"></i></div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.bg-outline-danger</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 bg-outline-light mx-auto color-container"><i data-feather="smile"
                                            class="fs-18"></i></div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.bg-outline-light</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 bg-outline-dark mx-auto color-container"><i data-feather="smile"
                                            class="fs-18"></i></div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.bg-outline-dark</code></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Outline Colors -->

                <!-- Border Colors -->
                <div class="col-lg-12 col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Border Colors</h5>
                        </div>
                        <div class="card-body">
                            <div class="row row-cols-12 d-flex align-items-center">
                                <div class="p-3 col">
                                    <div class="m-2 border border-primary mx-auto color-container"></div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.border-primary</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 border border-secondary mx-auto color-container"></div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.border-secondary</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 border border-warning mx-auto color-container"></div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.border-warning</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 border border-info mx-auto color-container"></div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.border-info</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 border border-success mx-auto color-container"></div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.border-success</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 border border-danger mx-auto color-container"></div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.border-danger</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 border border-light mx-auto color-container"></div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.border-light</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 border border-dark mx-auto color-container"></div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.border-dark</code></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Border Colors -->

                <!-- Text Colors -->
                <div class="col-lg-12 col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Text Colors</h5>
                        </div>
                        <div class="card-body">
                            <div class="row row-cols-12 d-flex align-items-center">
                                <div class="p-3 col">
                                    <div class="m-2 text-primary fw-semibold fs-14 text-center">primary</div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.text-primary</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 text-secondary fw-semibold fs-14 text-center">secondary</div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.text-secondary</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 text-warning fw-semibold fs-14 text-center">warning</div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.text-warning</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 text-info fw-semibold fs-14 text-center">info</div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.text-info</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 text-success fw-semibold fs-14 text-center">success</div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.text-success</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 text-danger fw-semibold fs-14 text-center">danger</div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.text-danger</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 text-light bg-dark fw-semibold fs-14 text-center">light</div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.text-light</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 text-dark fw-semibold fs-14 text-center">dark</div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.text-dark</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 text-muted fw-semibold fs-14 text-center">muted</div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.text-muted</code></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Text Colors -->

                <!-- Text Opacity -->
                <div class="col-lg-12 col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                Text Opacity
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row row-cols-12 d-flex align-items-center">
                                <div class="p-3 col">
                                    <div class="m-2 text-primary fw-semibold fs-14 text-center">Opacity-100</div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>100% opacity</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 text-primary text-opacity-75 fw-semibold fs-14 text-center">Opacity-100
                                    </div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.text-opacity-75</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 text-primary text-opacity-50 fw-semibold fs-14 text-center">Opacity-100
                                    </div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.text-opacity-50</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 text-primary text-opacity-25 fw-semibold fs-14 text-center">Opacity-100
                                    </div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.text-opacity-25</code></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Text Opacity -->

                <!-- Text Colors -->
                <div class="col-lg-12 col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Other Colors</h5>
                        </div>
                        <div class="card-body d-xl-flex">
                            <div class="flex-fill p-3 bg-gray-100">$gray-100</div>
                            <div class="flex-fill p-3 bg-gray-200">$gray-200</div>
                            <div class="flex-fill p-3 bg-gray-300">$gray-300</div>
                            <div class="flex-fill p-3 bg-gray-400">$gray-400</div>
                            <div class="flex-fill p-3 bg-gray-500">$gray-500</div>
                            <div class="flex-fill p-3 bg-gray-600">$gray-600</div>
                            <div class="flex-fill p-3 bg-gray-700">$gray-700</div>
                            <div class="flex-fill p-3 bg-gray-800">$gray-800</div>
                            <div class="flex-fill p-3 bg-gray-900">$gray-900</div>
                            <div class="flex-fill p-3 bg-gray">$gray</div>
                        </div>
                    </div>
                </div>
                <!-- /Text Colors -->

                <!-- Background Opacity -->
                <div class="col-lg-12 col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Background Opacity</h5>
                        </div>
                        <div class="card-body">
                            <div class="row row-cols-12 d-flex align-items-center">
                                <div class="p-3 col">
                                    <div class="m-2 bg-primary bg-opacity-100 text-fixed-white mx-auto color-container">
                                        100%</div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.bg-opacity-100</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 bg-primary text-fixed-white bg-opacity-75 mx-auto color-container">75%
                                    </div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.bg-opacity-75</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 bg-primary text-fixed-black bg-opacity-50 mx-auto color-container">50%
                                    </div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.bg-opacity-50</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 bg-primary text-fixed-black bg-opacity-25 mx-auto color-container">25%
                                    </div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.bg-opacity-25</code></p>
                                </div>
                                <div class="p-3 col">
                                    <div class="m-2 bg-primary text-fixed-black bg-opacity-10 mx-auto color-container">10%
                                    </div>
                                    <p class="pb-0 mb-0 fw-semibold text-center"><code>.bg-opacity-10</code></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Background Opacity -->

                <!-- Callout -->
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h5 class="card-title">Callout</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="callout">Lorem ipsum dolor sit amet consectetur adipisicing elit. </div>
                            <div class="callout callout-info">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            </div>
                            <div class="callout callout-warning">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            </div>
                            <div class="callout callout-danger">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Callout -->

            </div>
        </div>
    </div>
@endsection
