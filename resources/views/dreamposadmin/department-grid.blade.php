<?php $page = 'department-grid'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            @component('components.breadcrumb')
                @slot('title')
                    Department
                @endslot
                @slot('li_1')
                    Manage your departments
                @endslot
                @slot('li_2')
                    Add New Department
                @endslot
            @endcomponent

            <!-- /product list -->
            <div class="card">
                <div class="card-body pb-0">
                    <div class="table-top table-top-new">

                        <div class="search-set mb-0">
                            <div class="total-employees">
                                <h6><i data-feather="users" class="feather-user"></i>Total Employees <span>21</span></h6>
                            </div>
                            <div class="search-input">
                                <a href="" class="btn btn-searchset"><i data-feather="search"
                                        class="feather-search"></i></a>
                                <input type="search" class="form-control">
                            </div>

                        </div>
                        <div class="search-path d-flex align-items-center search-path-new">
                            <div class="d-flex">
                                <a class="btn btn-filter" id="filter_search">
                                    <i data-feather="filter" class="filter-icon"></i>
                                    <span><img src="{{ URL::asset('/build/img/icons/closes.svg') }}" alt="img"></span>
                                </a>
                                <a href="{{ url('department-list') }}" class="btn-list"><i data-feather="list"
                                        class="feather-user"></i></a>
                                <a href="{{ url('department-grid') }}" class="btn-grid active"><i data-feather="grid"
                                        class="feather-user"></i></a>
                            </div>
                            <div class="form-sort">
                                <i data-feather="sliders" class="info-img"></i>
                                <select class="select">
                                    <option>Sort by Date</option>
                                    <option>Newest</option>
                                    <option>Oldest</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /Filter -->
                    <div class="card" id="filter_inputs">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="input-blocks">
                                        <i data-feather="file-text" class="info-img"></i>
                                        <select class="select">
                                            <option>Choose Department</option>
                                            <option>UI/UX</option>
                                            <option>HR</option>
                                            <option>Admin</option>
                                            <option>Engineering</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="input-blocks">
                                        <i data-feather="users" class="info-img"></i>
                                        <select class="select">
                                            <option>Choose HOD</option>
                                            <option>Mitchum Daniel</option>
                                            <option>Susan Lopez</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12 ms-auto">
                                    <div class="input-blocks">
                                        <a class="btn btn-filters ms-auto"> <i data-feather="search"
                                                class="feather-search"></i> Search </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Filter -->

                </div>
            </div>
            <!-- /product list -->

            <div class="employee-grid-widget">
                <div class="row">
                    <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6">
                        <div class="employee-grid-profile">
                            <div class="profile-head">
                                <div class="dep-name">
                                    <h5 class="active">UI/UX</h5>
                                </div>
                                <div class="profile-head-action">
                                    <div class="dropdown profile-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-expanded="false"><i data-feather="more-vertical"
                                                class="feather-user"></i></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#edit-department"><i data-feather="edit"
                                                        class="info-img"></i>Edit</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item confirm-text mb-0"><i
                                                        data-feather="trash-2" class="info-img"></i>Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-info department-profile-info">
                                <div class="profile-pic">
                                    <img src="{{ URL::asset('/build/img/users/user-01.jpg') }}" alt="">
                                </div>
                                <h4>Mitchum Daniel</h4>
                            </div>
                            <ul class="team-members">
                                <li>
                                    Total Members: 07
                                </li>
                                <li>
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-01.jpg') }}"
                                                    alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-02.jpg') }}"
                                                    alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-03.jpg') }}"
                                                    alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-04.jpg') }}"
                                                    alt=""><span>+4</span></a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6">
                        <div class="employee-grid-profile">
                            <div class="profile-head">
                                <div class="dep-name">
                                    <h5 class="active">HR</h5>
                                </div>
                                <div class="profile-head-action">
                                    <div class="dropdown profile-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-expanded="false"><i data-feather="more-vertical"
                                                class="feather-user"></i></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"
                                                    data-bs-toggle="modal" data-bs-target="#edit-department"><i
                                                        data-feather="edit" class="info-img"></i>Edit</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item confirm-text mb-0"><i
                                                        data-feather="trash-2" class="info-img"></i>Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-info department-profile-info">
                                <div class="profile-pic">
                                    <img src="{{ URL::asset('/build/img/users/user-02.jpg') }}" alt="">
                                </div>
                                <h4>Susan Lopez</h4>
                            </div>
                            <ul class="team-members">
                                <li>
                                    Total Members: 05
                                </li>
                                <li>
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-03.jpg') }}"
                                                    alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-04.jpg') }}"
                                                    alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-05.jpg') }}"
                                                    alt=""><span>+3</span></a>
                                        </li>

                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6">
                        <div class="employee-grid-profile">
                            <div class="profile-head">
                                <div class="dep-name">
                                    <h5 class="inactive">Admin</h5>
                                </div>
                                <div class="profile-head-action">
                                    <div class="dropdown profile-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-expanded="false"><i data-feather="more-vertical"
                                                class="feather-user"></i></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"
                                                    data-bs-toggle="modal" data-bs-target="#edit-department"><i
                                                        data-feather="edit" class="info-img"></i>Edit</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item confirm-text mb-0"><i
                                                        data-feather="trash-2" class="info-img"></i>Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-info department-profile-info">
                                <div class="profile-pic">
                                    <img src="{{ URL::asset('/build/img/users/user-03.jpg') }}" alt="">
                                </div>
                                <h4>Robert Grossman</h4>
                            </div>
                            <ul class="team-members">
                                <li>
                                    Total Members: 06
                                </li>
                                <li>
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-03.jpg') }}"
                                                    alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-04.jpg') }}"
                                                    alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-06.jpg') }}"
                                                    alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-05.jpg') }}"
                                                    alt=""><span>+3</span></a>
                                        </li>

                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6">
                        <div class="employee-grid-profile">
                            <div class="profile-head">
                                <div class="dep-name">
                                    <h5 class="active">Admin</h5>
                                </div>
                                <div class="profile-head-action">
                                    <div class="dropdown profile-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-expanded="false"><i data-feather="more-vertical"
                                                class="feather-user"></i></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"
                                                    data-bs-toggle="modal" data-bs-target="#edit-department"><i
                                                        data-feather="edit" class="info-img"></i>Edit</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item confirm-text mb-0"><i
                                                        data-feather="trash-2" class="info-img"></i>Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-info department-profile-info">
                                <div class="profile-pic">
                                    <img src="{{ URL::asset('/build/img/users/user-06.jpg') }}" alt="">
                                </div>
                                <h4>Janet Hembre</h4>
                            </div>
                            <ul class="team-members">
                                <li>
                                    Total Members: 04
                                </li>
                                <li>
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-03.jpg') }}"
                                                    alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-04.jpg') }}"
                                                    alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-06.jpg') }}"
                                                    alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-05.jpg') }}"
                                                    alt=""><span>+3</span></a>
                                        </li>

                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6">
                        <div class="employee-grid-profile">
                            <div class="profile-head">
                                <div class="dep-name">
                                    <h5 class="inactive">Technician</h5>
                                </div>
                                <div class="profile-head-action">
                                    <div class="dropdown profile-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-expanded="false"><i data-feather="more-vertical"
                                                class="feather-user"></i></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"
                                                    data-bs-toggle="modal" data-bs-target="#edit-department"><i
                                                        data-feather="edit" class="info-img"></i>Edit</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item confirm-text mb-0"><i
                                                        data-feather="trash-2" class="info-img"></i>Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-info department-profile-info">
                                <div class="profile-pic">
                                    <img src="{{ URL::asset('/build/img/users/user-04.jpg') }}" alt="">
                                </div>
                                <h4>Russell Belle</h4>
                            </div>
                            <ul class="team-members">
                                <li>
                                    Total Members: 08
                                </li>
                                <li>
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-03.jpg') }}"
                                                    alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-04.jpg') }}"
                                                    alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-06.jpg') }}"
                                                    alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-05.jpg') }}"
                                                    alt=""><span>+3</span></a>
                                        </li>

                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6">
                        <div class="employee-grid-profile">
                            <div class="profile-head">
                                <div class="dep-name">
                                    <h5 class="active">Support</h5>
                                </div>
                                <div class="profile-head-action">
                                    <div class="dropdown profile-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-expanded="false"><i data-feather="more-vertical"
                                                class="feather-user"></i></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"
                                                    data-bs-toggle="modal" data-bs-target="#edit-department"><i
                                                        data-feather="edit" class="info-img"></i>Edit</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item confirm-text mb-0"><i
                                                        data-feather="trash-2" class="info-img"></i>Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-info department-profile-info">
                                <div class="profile-pic">
                                    <img src="{{ URL::asset('/build/img/users/user-05.jpg') }}" alt="">
                                </div>
                                <h4>Edward K. Muniz</h4>
                            </div>
                            <ul class="team-members">
                                <li>
                                    Total Members: 04
                                </li>
                                <li>
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-03.jpg') }}"
                                                    alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-04.jpg') }}"
                                                    alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-06.jpg') }}"
                                                    alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-05.jpg') }}"
                                                    alt=""><span>+3</span></a>
                                        </li>

                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6">
                        <div class="employee-grid-profile">
                            <div class="profile-head">
                                <div class="dep-name">
                                    <h5 class="inactive">Engineering</h5>
                                </div>
                                <div class="profile-head-action">
                                    <div class="dropdown profile-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-expanded="false"><i data-feather="more-vertical"
                                                class="feather-user"></i></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"
                                                    data-bs-toggle="modal" data-bs-target="#edit-department"><i
                                                        data-feather="edit" class="info-img"></i>Edit</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item confirm-text mb-0"><i
                                                        data-feather="trash-2" class="info-img"></i>Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-info department-profile-info">
                                <div class="profile-pic">
                                    <img src="{{ URL::asset('/build/img/users/user-07.jpg') }}" alt="">
                                </div>
                                <h4>Susan Moore</h4>
                            </div>
                            <ul class="team-members">
                                <li>
                                    Total Members: 10
                                </li>
                                <li>
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-03.jpg') }}"
                                                    alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-04.jpg') }}"
                                                    alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-06.jpg') }}"
                                                    alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-09.jpg') }}"
                                                    alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-05.jpg') }}"
                                                    alt=""><span>+6</span></a>
                                        </li>

                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6">
                        <div class="employee-grid-profile">
                            <div class="profile-head">
                                <div class="dep-name">
                                    <h5 class="inactive">Admin</h5>
                                </div>
                                <div class="profile-head-action">
                                    <div class="dropdown profile-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-expanded="false"><i data-feather="more-vertical"
                                                class="feather-user"></i></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"
                                                    data-bs-toggle="modal" data-bs-target="#edit-department"><i
                                                        data-feather="edit" class="info-img"></i>Edit</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item confirm-text mb-0"><i
                                                        data-feather="trash-2" class="info-img"></i>Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-info department-profile-info">
                                <div class="profile-pic">
                                    <img src="{{ URL::asset('/build/img/users/user-08.jpg') }}" alt="">
                                </div>
                                <h4>Lance Jackson</h4>
                            </div>
                            <ul class="team-members">
                                <li>
                                    Total Members: 03
                                </li>
                                <li>
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-03.jpg') }}"
                                                    alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-04.jpg') }}"
                                                    alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-06.jpg') }}"
                                                    alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-05.jpg') }}"
                                                    alt=""><span>+3</span></a>
                                        </li>

                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6">
                        <div class="employee-grid-profile">
                            <div class="profile-head">
                                <div class="dep-name">
                                    <h5 class="inactive">PHP Development</h5>
                                </div>
                                <div class="profile-head-action">
                                    <div class="dropdown profile-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-expanded="false"><i data-feather="more-vertical"
                                                class="feather-user"></i></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"
                                                    data-bs-toggle="modal" data-bs-target="#edit-department"><i
                                                        data-feather="edit" class="info-img"></i>Edit</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item confirm-text mb-0"><i
                                                        data-feather="trash-2" class="info-img"></i>Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-info department-profile-info">
                                <div class="profile-pic">
                                    <img src="{{ URL::asset('/build/img/users/user-11.jpg') }}" alt="">
                                </div>
                                <h4>Mitchum Daniel</h4>
                            </div>
                            <ul class="team-members">
                                <li>
                                    Total Members: 09
                                </li>
                                <li>
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-03.jpg') }}"
                                                    alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-04.jpg') }}"
                                                    alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-06.jpg') }}"
                                                    alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-05.jpg') }}"
                                                    alt=""><span>+3</span></a>
                                        </li>

                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6">
                        <div class="employee-grid-profile">
                            <div class="profile-head">
                                <div class="dep-name">
                                    <h5 class="active">React</h5>
                                </div>
                                <div class="profile-head-action">
                                    <div class="dropdown profile-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-expanded="false"><i data-feather="more-vertical"
                                                class="feather-user"></i></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"
                                                    data-bs-toggle="modal" data-bs-target="#edit-department"><i
                                                        data-feather="edit" class="info-img"></i>Edit</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item confirm-text mb-0"><i
                                                        data-feather="trash-2" class="info-img"></i>Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-info department-profile-info">
                                <div class="profile-pic">
                                    <img src="{{ URL::asset('/build/img/users/user-12.jpg') }}" alt="">
                                </div>
                                <h4>Susan Moore</h4>
                            </div>
                            <ul class="team-members">
                                <li>
                                    Total Members: 07
                                </li>
                                <li>
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-03.jpg') }}"
                                                    alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-04.jpg') }}"
                                                    alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-06.jpg') }}"
                                                    alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-05.jpg') }}"
                                                    alt=""><span>+3</span></a>
                                        </li>

                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6">
                        <div class="employee-grid-profile">
                            <div class="profile-head">
                                <div class="dep-name">
                                    <h5 class="active">Angular</h5>
                                </div>
                                <div class="profile-head-action">
                                    <div class="dropdown profile-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-expanded="false"><i data-feather="more-vertical"
                                                class="feather-user"></i></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"
                                                    data-bs-toggle="modal" data-bs-target="#edit-department"><i
                                                        data-feather="edit" class="info-img"></i>Edit</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item confirm-text mb-0"><i
                                                        data-feather="trash-2" class="info-img"></i>Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-info department-profile-info">
                                <div class="profile-pic">
                                    <img src="{{ URL::asset('/build/img/users/user-09.jpg') }}" alt="">
                                </div>
                                <h4>Lance Jackson</h4>
                            </div>
                            <ul class="team-members">
                                <li>
                                    Total Members: 07
                                </li>
                                <li>
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-03.jpg') }}"
                                                    alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-04.jpg') }}"
                                                    alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-06.jpg') }}"
                                                    alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-05.jpg') }}"
                                                    alt=""><span>+3</span></a>
                                        </li>

                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6">
                        <div class="employee-grid-profile">
                            <div class="profile-head">
                                <div class="dep-name">
                                    <h5 class="active">NodeJS</h5>
                                </div>
                                <div class="profile-head-action">
                                    <div class="dropdown profile-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-expanded="false"><i data-feather="more-vertical"
                                                class="feather-user"></i></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"
                                                    data-bs-toggle="modal" data-bs-target="#edit-department"><i
                                                        data-feather="edit" class="info-img"></i>Edit</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item confirm-text mb-0"><i
                                                        data-feather="trash-2" class="info-img"></i>Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-info department-profile-info">
                                <div class="profile-pic">
                                    <img src="{{ URL::asset('/build/img/users/user-13.jpg') }}" alt="">
                                </div>
                                <h4>Robert Grossman</h4>
                            </div>
                            <ul class="team-members">
                                <li>
                                    Total Members: 07
                                </li>
                                <li>
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-03.jpg') }}"
                                                    alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-04.jpg') }}"
                                                    alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-06.jpg') }}"
                                                    alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><img
                                                    src="{{ URL::asset('/build/img/users/user-05.jpg') }}"
                                                    alt=""><span>+3</span></a>
                                        </li>

                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row custom-pagination">
                    <div class="col-md-12">
                        <div class="paginations d-flex justify-content-end mb-3">
                            <span><i class="fas fa-chevron-left"></i></span>
                            <ul class="d-flex align-items-center page-wrap">
                                <li>
                                    <a href="javascript:void(0);" class="active">
                                        1
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        2
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        3
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        4
                                    </a>
                                </li>
                            </ul>
                            <span><i class="fas fa-chevron-right"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
