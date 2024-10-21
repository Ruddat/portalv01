<?php $page = 'ui-buttons'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Buttons</h4>
                </div>
            </div>
            <div class="row">

                <!-- Default Buttons -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Default Buttons</h5>
                            <p class="text-muted mb-0">Use the button classes on an <code>&lt;a&gt;</code>,
                                <code>&lt;button&gt;</code>, or <code>&lt;input&gt;</code> element.</p>
                        </div>
                        <div class="card-body">
                            <div class="btn-list">
                                <button type="button" class="btn btn-primary">Primary</button>
                                <button type="button" class="btn btn-secondary">Secondary</button>
                                <button type="button" class="btn btn-success">Success</button>
                                <button type="button" class="btn btn-danger">Danger</button>
                                <button type="button" class="btn btn-warning">Warning</button>
                                <button type="button" class="btn btn-info">Info</button>
                                <button type="button" class="btn btn-light">Light</button>
                                <button type="button" class="btn btn-dark">Dark</button>
                                <button type="button" class="btn btn-link">Link</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Default Buttons -->

                <!-- Rounded Buttons -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Rounded Buttons</h5>
                            <p class="text-muted mb-0">Add <code>.rounded-pill</code> to default button to get rounded
                                corners.</p>
                        </div>
                        <div class="card-body">
                            <div class="btn-list">
                                <button type="button" class="btn btn-primary rounded-pill">Primary</button>
                                <button type="button" class="btn btn-secondary rounded-pill">Secondary</button>
                                <button type="button" class="btn btn-success rounded-pill">Success</button>
                                <button type="button" class="btn btn-danger rounded-pill">Danger</button>
                                <button type="button" class="btn btn-warning rounded-pill">Warning</button>
                                <button type="button" class="btn btn-info rounded-pill">Info</button>
                                <button type="button" class="btn btn-light rounded-pill">Light</button>
                                <button type="button" class="btn btn-dark rounded-pill">Dark</button>
                                <button type="button" class="btn btn-link rounded-pill">Link</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Rounded Buttons -->

                <!-- Outline Buttons -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Outline Buttons</h5>
                            <p class="text-muted mb-0">Use a classes <code>.btn-outline-**</code> to quickly create a
                                bordered buttons.</p>
                        </div>
                        <div class="card-body">
                            <div class="btn-list">
                                <button type="button" class="btn btn-outline-primary">Primary</button>
                                <button type="button" class="btn btn-outline-secondary">Secondary</button>
                                <button type="button" class="btn btn-outline-success">Success</button>
                                <button type="button" class="btn btn-outline-danger">Danger</button>
                                <button type="button" class="btn btn-outline-warning">Warning</button>
                                <button type="button" class="btn btn-outline-info">Info</button>
                                <button type="button" class="btn btn-outline-light">Light</button>
                                <button type="button" class="btn btn-outline-dark">Dark</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Outline Buttons -->

                <!-- Rounded Outline Buttons -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Rounded Outline Buttons</h5>
                            <p class="text-muted mb-0">Use a classes <code>.btn-outline-**</code> to quickly create a
                                bordered buttons.</p>
                        </div>
                        <div class="card-body">
                            <div class="btn-list">
                                <button type="button" class="btn btn-outline-primary rounded-pill">Primary</button>
                                <button type="button" class="btn btn-outline-secondary rounded-pill">Secondary</button>
                                <button type="button" class="btn btn-outline-success rounded-pill">Success</button>
                                <button type="button" class="btn btn-outline-danger rounded-pill">Danger</button>
                                <button type="button" class="btn btn-outline-warning rounded-pill">Warning</button>
                                <button type="button" class="btn btn-outline-info rounded-pill">Info</button>
                                <button type="button" class="btn btn-outline-light rounded-pill">Light</button>
                                <button type="button" class="btn btn-outline-dark rounded-pill">Dark</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Rounded Outline Buttons -->

                <!-- Soft Buttons -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Soft Buttons</h5>
                            <p class="text-muted mb-0">Use a classes <code>.btn-soft-**</code> to quickly create a bordered
                                buttons.</p>
                        </div>
                        <div class="card-body">
                            <div class="btn-list">
                                <button type="button" class="btn btn-soft-primary">Primary</button>
                                <button type="button" class="btn btn-soft-secondary">Secondary</button>
                                <button type="button" class="btn btn-soft-success">Success</button>
                                <button type="button" class="btn btn-soft-danger">Danger</button>
                                <button type="button" class="btn btn-soft-warning">Warning</button>
                                <button type="button" class="btn btn-soft-info">Info</button>
                                <button type="button" class="btn btn-soft-light">Light</button>
                                <button type="button" class="btn btn-soft-dark">Dark</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Soft Buttons -->

                <!-- Soft Rounded Buttons -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Soft Rounded Button</h5>
                            <p class="text-muted mb-0">Use a classes <code>.btn-soft-**</code> to quickly create a bordered
                                buttons.</p>
                        </div>
                        <div class="card-body">
                            <div class="btn-list">
                                <button type="button" class="btn btn-soft-primary rounded-pill">Primary</button>
                                <button type="button" class="btn btn-soft-secondary rounded-pill">Secondary</button>
                                <button type="button" class="btn btn-soft-success rounded-pill">Success</button>
                                <button type="button" class="btn btn-soft-danger rounded-pill">Danger</button>
                                <button type="button" class="btn btn-soft-warning rounded-pill">Warning</button>
                                <button type="button" class="btn btn-soft-info rounded-pill">Info</button>
                                <button type="button" class="btn btn-soft-light rounded-pill">Light</button>
                                <button type="button" class="btn btn-soft-dark rounded-pill">Dark</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Soft Rounded Buttons -->

                <!-- Square Buttons -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Square Button</h5>
                            <p class="text-muted mb-0">add <code>.btn-square</code> to change the style.</p>
                        </div>
                        <div class="card-body">
                            <div class="btn-list">
                                <button type="button" class="btn  btn-square btn-primary">Primary</button>
                                <button type="button" class="btn  btn-square btn-secondary">Secondary</button>
                                <button type="button" class="btn  btn-square btn-success">Success</button>
                                <button type="button" class="btn  btn-square btn-danger">Danger</button>
                                <button type="button" class="btn  btn-square btn-warning">Warning</button>
                                <button type="button" class="btn  btn-square btn-info">Info</button>
                                <button type="button" class="btn  btn-square btn-light">Light</button>
                                <button type="button" class="btn  btn-square btn-dark">Dark</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Square Buttons -->

                <!-- Square Outline Buttons -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Square Outline Button</h5>
                            <p class="text-muted mb-0">add <code>.btn-square</code> to change the style.</p>
                        </div>
                        <div class="card-body">
                            <div class="btn-list">
                                <button type="button" class="btn btn-square btn-outline-primary">Primary</button>
                                <button type="button" class="btn btn-square btn-outline-secondary">Secondary</button>
                                <button type="button" class="btn btn-square btn-outline-success">Success</button>
                                <button type="button" class="btn btn-square btn-outline-danger">Danger</button>
                                <button type="button" class="btn btn-square btn-outline-warning">Warning</button>
                                <button type="button" class="btn btn-square btn-outline-info">Info</button>
                                <button type="button" class="btn btn-square btn-outline-light">Light</button>
                                <button type="button" class="btn btn-square btn-outline-dark">Dark</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Square Outline Buttons -->

                <!-- Sizes -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Sizes</h5>
                            <p class="text-muted mb-0">Add <code>.btn-lg</code>, <code>.btn-sm</code>, or
                                <code>.btn-xs</code> for additional sizes.</p>
                        </div>
                        <div class="card-body">
                            <div class="btn-list">
                                <button type="button" class="btn btn-primary btn-sm">Small Button</button>
                                <button type="button" class="btn btn-secondary">Default Button</button>
                                <button type="button" class="btn btn-success btn-lg">Large Button</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Sizes -->

                <!-- Button Tags -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Button Tags</h5>
                            <p class="text-muted mb-0">Use a classes <code>.btn-outline-**</code> to quickly create a
                                bordered buttons.</p>
                        </div>
                        <div class="card-body">
                            <div class="btn-list">
                                <a class="btn btn-primary m-0" href="#" role="button">Link</a>
                                <button class="btn btn-primary m-0" type="submit">Button</button>
                                <input class="btn btn-primary" type="button" value="Input">
                                <input class="btn btn-primary" type="submit" value="Submit">
                                <input class="btn btn-primary" type="reset" value="Reset">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Button Tags -->

                <!-- Button Widths -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Button Widths</h5>
                            <p class="text-muted mb-0">Use a classes <code>.btn-outline-**</code> to quickly create a
                                bordered buttons.</p>
                        </div>
                        <div class="card-body">
                            <div class="btn-list d-flex flex-wrap">
                                <button type="button" class="btn btn-primary btn-w-xs">XS</button>
                                <button type="button" class="btn btn-secondary btn-w-sm">SM</button>
                                <button type="button" class="btn btn-warning btn-w-md">MD</button>
                                <button type="button" class="btn btn-info btn-w-lg me-0">LG</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Button Widths -->

                <!-- Button Disabled -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Button Disabled</h5>
                            <p class="text-muted mb-0"> Add the <code>disabled</code> attribute to
                                <code>&lt;button&gt;</code> buttons.</p>
                        </div>
                        <div class="card-body">
                            <div class="btn-list">
                                <button type="button" class="btn btn-primary disabled">Primary</button>
                                <button type="button" class="btn btn-success disabled">Success</button>
                                <button type="button" class="btn btn-info disabled">Info</button>
                                <button type="button" class="btn btn-warning disabled">Warning</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Button Disabled -->

                <!-- Button Loader -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Button Loader</h5>
                            <p class="text-muted mb-0">Use a classes <code>.btn-outline-**</code> to quickly create a
                                bordered buttons.</p>
                        </div>
                        <div class="card-body">
                            <div class="btn-list">
                                <button type="button" class="btn btn-primary"><i
                                        class="fas fa-spinner fa-spin me-2"></i>Loading...</button>
                                <button type="button" class="btn btn-secondary"><i
                                        class="fas fa-spinner fa-spin me-2"></i>Loading...</button>
                                <button type="button" class="btn btn-warning"><i
                                        class="fas fa-spinner fa-spin me-2"></i>Loading...</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Button Loader -->

                <!-- Icon Loader -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Icon Buttons</h5>
                            <p class="text-muted mb-0">Use a classes <code>.btn-icon</code> to quickly create a bordered
                                buttons.</p>
                        </div>
                        <div class="card-body">
                            <div class="btn-list d-md-flex d-block">
                                <button class="btn btn-icon btn-primary">
                                    <i class="fas fa-bell"></i>
                                </button>
                                <button class="btn btn-icon btn-success">
                                    <i class="fas fa-bell"></i>
                                </button>
                                <button class="btn btn-icon btn-soft-primary rounded-pill">
                                    <i class="fas fa-bell"></i>
                                </button>
                                <button class="btn btn-icon btn-soft-success rounded-pill">
                                    <i class="fas fa-bell"></i>
                                </button>
                                <button class="btn btn-icon btn-outline-primary rounded-pill">
                                    <i class="fas fa-bell"></i>
                                </button>
                                <button class="btn btn-icon btn-outline-success rounded-pill">
                                    <i class="fas fa-bell"></i>
                                </button>
                                <button type="button" class="btn btn-primary">
                                    <i class="fas fa-bell me-2"></i>Like
                                </button>
                                <button type="button" class="btn btn-success">
                                    <i class="fas fa-bell me-2"></i>Like
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Icon Loader -->

                <!-- Block Loader -->
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Block buttons</h5>
                            <p class="text-muted mb-0">Create block level buttons by adding class <code>.d-grid</code> to
                                parent div.</p>
                        </div>
                        <div class="card-body">
                            <div class="btn-list d-block">
                                <div class="d-grid gap-2 mb-4">
                                    <button class="btn btn-primary" type="button">Button</button>
                                    <button class="btn btn-secondary" type="button">Button</button>
                                </div>
                                <div class="d-grid gap-2 d-md-block">
                                    <button class="btn btn-info" type="button">Button</button>
                                    <button class="btn btn-success" type="button">Button</button>
                                </div>
                                <div class="d-grid gap-2 col-6 mx-auto">
                                    <button class="btn btn-danger" type="button">Button</button>
                                    <button class="btn btn-warning" type="button">Button</button>
                                </div>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button class="btn btn-teal me-md-2" type="button">Button</button>
                                    <button class="btn btn-purple" type="button">Button</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Block Loader -->

            </div>
        </div>
    </div>
@endsection
