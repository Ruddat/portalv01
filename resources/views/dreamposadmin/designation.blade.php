<?php $page = 'designation'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            @component('components.breadcrumb')
                @slot('title')
                    Designation
                @endslot
                @slot('li_1')
                    Manage your designation
                @endslot
                @slot('li_2')
                    Add New Designation
                @endslot
            @endcomponent

            <!-- /product list -->
            <div class="card table-list-card">
                <div class="card-body pb-0">
                    <div class="table-top table-top-new">

                        <div class="search-set mb-0">
                            <div class="total-employees">
                                <h6><i data-feather="users" class="feather-user"></i>Total Employees <span>21</span></h6>
                            </div>
                            <div class="search-input">
                                <a href="" class="btn btn-searchset"><i data-feather="search"
                                        class="feather-search"></i></a>
                            </div>
                        </div>
                        <div class="search-path d-flex align-items-center search-path-new">
                            <div class="d-flex">
                                <a class="btn btn-filter" id="filter_search">
                                    <i data-feather="filter" class="filter-icon"></i>
                                    <span><img src="{{ URL::asset('/build/img/icons/closes.svg') }}" alt="img"></span>
                                </a>
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
                                            <option>Choose Designation </option>
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
                    <div class="table-responsive">
                        <table class="table  datanew">
                            <thead>
                                <tr>
                                    <th class="no-sort">
                                        <label class="checkboxs">
                                            <input type="checkbox" id="select-all">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </th>
                                    <th>Designation</th>
                                    <th>Members</th>
                                    <th>Created On</th>
                                    <th>Total Members</th>
                                    <th>Status</th>
                                    <th class="no-sort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td>Designer</td>

                                    <td>
                                        <ul class="team-members">
                                            <li>
                                                <ul>
                                                    <li>
                                                        <a href=""><img
                                                                src="{{ URL::asset('/build/img/users/user-08.jpg') }}"
                                                                alt=""></a>
                                                    </li>
                                                    <li>
                                                        <a href=""><img
                                                                src="{{ URL::asset('/build/img/users/user-13.jpg') }}"
                                                                alt=""></a>
                                                    </li>
                                                    <li>
                                                        <a href=""><img
                                                                src="{{ URL::asset('/build/img/users/user-09.jpg') }}"
                                                                alt=""></a>
                                                    </li>
                                                    <li>
                                                        <a href=""><img
                                                                src="{{ URL::asset('/build/img/users/user-11.jpg') }}"
                                                                alt=""></a>
                                                    </li>
                                                    <li>
                                                        <a href=""><img
                                                                src="{{ URL::asset('/build/img/users/user-04.jpg') }}"
                                                                alt=""><span>+3</span></a>
                                                    </li>

                                                </ul>
                                            </li>
                                        </ul>
                                    </td>
                                    <td>07</td>
                                    <td>
                                        25 May 2023
                                    </td>
                                    <td><span class="badge badge-linesuccess">Active</span></td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#">
                                                <i data-feather="eye" class="feather-eye"></i>
                                            </a>
                                            <a class="me-2 p-2" href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#edit-department">
                                                <i data-feather="edit" class="feather-edit"></i>
                                            </a>
                                            <a class="confirm-text p-2" href="javascript:void(0);">
                                                <i data-feather="trash-2" class="feather-trash-2"></i>
                                            </a>
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td>Curator</td>

                                    <td>
                                        <ul class="team-members">
                                            <li>
                                                <ul>
                                                    <li>
                                                        <a href=""><img
                                                                src="{{ URL::asset('/build/img/users/user-05.jpg') }}"
                                                                alt=""></a>
                                                    </li>
                                                    <li>
                                                        <a href=""><img
                                                                src="{{ URL::asset('/build/img/users/user-06.jpg') }}"
                                                                alt=""></a>
                                                    </li>
                                                    <li>
                                                        <a href=""><img
                                                                src="{{ URL::asset('/build/img/users/user-02.jpg') }}"
                                                                alt=""></a>
                                                    </li>
                                                    <li>
                                                        <a href=""><img
                                                                src="{{ URL::asset('/build/img/users/user-04.jpg') }}"
                                                                alt=""><span>+5</span></a>
                                                    </li>

                                                </ul>
                                            </li>
                                        </ul>
                                    </td>
                                    <td>08</td>
                                    <td>
                                        27 June 2023
                                    </td>
                                    <td><span class="badge badge-linesuccess">Active</span></td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#">
                                                <i data-feather="eye" class="feather-eye"></i>
                                            </a>
                                            <a class="me-2 p-2" href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#edit-department">
                                                <i data-feather="edit" class="feather-edit"></i>
                                            </a>
                                            <a class="confirm-text p-2" href="javascript:void(0);">
                                                <i data-feather="trash-2" class="feather-trash-2"></i>
                                            </a>
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td>System Administrator</td>

                                    <td>
                                        <ul class="team-members">
                                            <li>
                                                <ul>
                                                    <li>
                                                        <a href=""><img
                                                                src="{{ URL::asset('/build/img/users/user-09.jpg') }}"
                                                                alt=""></a>
                                                    </li>
                                                    <li>
                                                        <a href=""><img
                                                                src="{{ URL::asset('/build/img/users/user-04.jpg') }}"
                                                                alt=""></a>
                                                    </li>
                                                    <li>
                                                        <a href=""><img
                                                                src="{{ URL::asset('/build/img/users/user-08.jpg') }}"
                                                                alt=""></a>
                                                    </li>
                                                    <li>
                                                        <a href=""><img
                                                                src="{{ URL::asset('/build/img/users/user-11.jpg') }}"
                                                                alt=""></a>
                                                    </li>
                                                    <li>
                                                        <a href=""><img
                                                                src="{{ URL::asset('/build/img/users/user-04.jpg') }}"
                                                                alt=""><span>+2</span></a>
                                                    </li>

                                                </ul>
                                            </li>
                                        </ul>
                                    </td>
                                    <td>06</td>
                                    <td>
                                        29 June 2023
                                    </td>
                                    <td><span class="badges-success">Active</span></td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#">
                                                <i data-feather="eye" class="feather-eye"></i>
                                            </a>
                                            <a class="me-2 p-2" href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#edit-department">
                                                <i data-feather="edit" class="feather-edit"></i>
                                            </a>
                                            <a class="confirm-text p-2" href="javascript:void(0);">
                                                <i data-feather="trash-2" class="feather-trash-2"></i>
                                            </a>
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td>Administrative Officer</td>

                                    <td>
                                        <ul class="team-members">
                                            <li>
                                                <ul>
                                                    <li>
                                                        <a href=""><img
                                                                src="{{ URL::asset('/build/img/users/user-09.jpg') }}"
                                                                alt=""></a>
                                                    </li>
                                                    <li>
                                                        <a href=""><img
                                                                src="{{ URL::asset('/build/img/users/user-01.jpg') }}"
                                                                alt=""></a>
                                                    </li>
                                                    <li>
                                                        <a href=""><img
                                                                src="{{ URL::asset('/build/img/users/user-04.jpg') }}"
                                                                alt=""><span>+1</span></a>
                                                    </li>

                                                </ul>
                                            </li>
                                        </ul>
                                    </td>
                                    <td>03</td>
                                    <td>
                                        15 July 2023
                                    </td>
                                    <td><span class="badges-success">Active</span></td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#">
                                                <i data-feather="eye" class="feather-eye"></i>
                                            </a>
                                            <a class="me-2 p-2" href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#edit-department">
                                                <i data-feather="edit" class="feather-edit"></i>
                                            </a>
                                            <a class="confirm-text p-2" href="javascript:void(0);">
                                                <i data-feather="trash-2" class="feather-trash-2"></i>
                                            </a>
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td>Technician</td>

                                    <td>
                                        <ul class="team-members">
                                            <li>
                                                <ul>
                                                    <li>
                                                        <a href=""><img
                                                                src="{{ URL::asset('/build/img/users/user-05.jpg') }}"
                                                                alt=""></a>
                                                    </li>
                                                    <li>
                                                        <a href=""><img
                                                                src="{{ URL::asset('/build/img/users/user-02.jpg') }}"
                                                                alt=""></a>
                                                    </li>
                                                    <li>
                                                        <a href=""><img
                                                                src="{{ URL::asset('/build/img/users/user-01.jpg') }}"
                                                                alt=""></a>
                                                    </li>
                                                    <li>
                                                        <a href=""><img
                                                                src="{{ URL::asset('/build/img/users/user-04.jpg') }}"
                                                                alt=""><span>+2</span></a>
                                                    </li>

                                                </ul>
                                            </li>
                                        </ul>
                                    </td>
                                    <td>05</td>
                                    <td>
                                        19 July 2023
                                    </td>
                                    <td><span class="badges-success">Active</span></td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#">
                                                <i data-feather="eye" class="feather-eye"></i>
                                            </a>
                                            <a class="me-2 p-2" href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#edit-department">
                                                <i data-feather="edit" class="feather-edit"></i>
                                            </a>
                                            <a class="confirm-text p-2" href="javascript:void(0);">
                                                <i data-feather="trash-2" class="feather-trash-2"></i>
                                            </a>
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td>Office Support Secretary</td>

                                    <td>
                                        <ul class="team-members">
                                            <li>
                                                <ul>
                                                    <li>
                                                        <a href=""><img
                                                                src="{{ URL::asset('/build/img/users/user-07.jpg') }}"
                                                                alt=""></a>
                                                    </li>
                                                    <li>
                                                        <a href=""><img
                                                                src="{{ URL::asset('/build/img/users/user-11.jpg') }}"
                                                                alt=""></a>
                                                    </li>
                                                    <li>
                                                        <a href=""><img
                                                                src="{{ URL::asset('/build/img/users/user-09.jpg') }}"
                                                                alt=""></a>
                                                    </li>
                                                    <li>
                                                        <a href=""><img
                                                                src="{{ URL::asset('/build/img/users/user-04.jpg') }}"
                                                                alt=""><span>+5</span></a>
                                                    </li>

                                                </ul>
                                            </li>
                                        </ul>
                                    </td>
                                    <td>09</td>
                                    <td>
                                        04 August 2023
                                    </td>
                                    <td><span class="badges-success">Active</span></td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#">
                                                <i data-feather="eye" class="feather-eye"></i>
                                            </a>
                                            <a class="me-2 p-2" href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#edit-department">
                                                <i data-feather="edit" class="feather-edit"></i>
                                            </a>
                                            <a class="confirm-text p-2" href="javascript:void(0);">
                                                <i data-feather="trash-2" class="feather-trash-2"></i>
                                            </a>
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td>Tech Lead</td>

                                    <td>
                                        <ul class="team-members">
                                            <li>
                                                <ul>
                                                    <li>
                                                        <a href=""><img
                                                                src="{{ URL::asset('/build/img/users/user-12.jpg') }}"
                                                                alt=""></a>
                                                    </li>
                                                    <li>
                                                        <a href=""><img
                                                                src="{{ URL::asset('/build/img/users/user-13.jpg') }}"
                                                                alt=""></a>
                                                    </li>
                                                    <li>
                                                        <a href=""><img
                                                                src="{{ URL::asset('/build/img/users/user-01.jpg') }}"
                                                                alt=""></a>
                                                    </li>
                                                    <li>
                                                        <a href=""><img
                                                                src="{{ URL::asset('/build/img/users/user-04.jpg') }}"
                                                                alt=""><span>+6</span></a>
                                                    </li>

                                                </ul>
                                            </li>
                                        </ul>
                                    </td>
                                    <td>10</td>
                                    <td>
                                        13 August 2023
                                    </td>
                                    <td><span class="badges-success">Active</span></td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#">
                                                <i data-feather="eye" class="feather-eye"></i>
                                            </a>
                                            <a class="me-2 p-2" href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#edit-department">
                                                <i data-feather="edit" class="feather-edit"></i>
                                            </a>
                                            <a class="confirm-text p-2" href="javascript:void(0);">
                                                <i data-feather="trash-2" class="feather-trash-2"></i>
                                            </a>
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td>Database administrator</td>

                                    <td>
                                        <ul class="team-members">
                                            <li>
                                                <ul>
                                                    <li>
                                                        <a href=""><img
                                                                src="{{ URL::asset('/build/img/users/user-11.jpg') }}"
                                                                alt=""></a>
                                                    </li>
                                                    <li>
                                                        <a href=""><img
                                                                src="{{ URL::asset('/build/img/users/user-07.jpg') }}"
                                                                alt=""></a>
                                                    </li>
                                                    <li>
                                                        <a href=""><img
                                                                src="{{ URL::asset('/build/img/users/user-02.jpg') }}"
                                                                alt=""></a>
                                                    </li>
                                                    <li>
                                                        <a href=""><img
                                                                src="{{ URL::asset('/build/img/users/user-11.jpg') }}"
                                                                alt=""><span>+1</span></a>
                                                    </li>

                                                </ul>
                                            </li>
                                        </ul>
                                    </td>
                                    <td>04</td>
                                    <td>
                                        24 August 2023
                                    </td>
                                    <td><span class="badges-success">Active</span></td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#">
                                                <i data-feather="eye" class="feather-eye"></i>
                                            </a>
                                            <a class="me-2 p-2" href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#edit-department">
                                                <i data-feather="edit" class="feather-edit"></i>
                                            </a>
                                            <a class="confirm-text p-2" href="javascript:void(0);">
                                                <i data-feather="trash-2" class="feather-trash-2"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /product list -->

        </div>
    </div>
@endsection
