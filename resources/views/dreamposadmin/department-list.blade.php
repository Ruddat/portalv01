<?php $page = 'department-list'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="add-item d-flex">
                    <div class="page-title">
                        <h4>Department</h4>
                        <h6>Manage your departments</h6>
                    </div>
                </div>
                <ul class="table-top-head">
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"><img
                                src="{{ URL::asset('/build/img/icons/pdf.svg') }}" alt="img"></a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Excel"><img
                                src="{{ URL::asset('/build/img/icons/excel.svg') }}" alt="img"></a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Print"><i data-feather="printer"
                                class="feather-rotate-ccw"></i></a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i data-feather="rotate-ccw"
                                class="feather-rotate-ccw"></i></a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i
                                data-feather="chevron-up" class="feather-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="page-btn">
                    <a href="" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-department"><i
                            data-feather="plus-circle" class="me-2"></i>Add New Department</a>
                </div>
            </div>
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
                                <a href="{{ url('department-list') }}" class="btn-list active"><i data-feather="list"
                                        class="feather-user"></i></a>
                                <a href="{{ url('department-grid') }}" class="btn-grid"><i data-feather="grid"
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
                                    <th>Department</th>
                                    <th>HOD</th>
                                    <th>Members</th>
                                    <th>Total Members</th>
                                    <th>Created On</th>
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
                                    <td>UI/UX</td>
                                    <td>
                                        <div class="userimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="{{ URL::asset('/build/img/users/user-01.jpg') }}"
                                                    alt="product">
                                            </a>
                                            <div>
                                                <a href="javascript:void(0);">Steven</a>
                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        <ul class="team-members">
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
                                    </td>
                                    <td>07</td>
                                    <td>
                                        25 Jan 2023
                                    </td>
                                    <td><span class="badge badge-linesuccess">Active</span></td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="javascript:void(0);">
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
                                    <td>HR</td>
                                    <td>
                                        <div class="userimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="{{ URL::asset('/build/img/users/user-02.jpg') }}"
                                                    alt="product">
                                            </a>
                                            <div>
                                                <a href="javascript:void(0);">Susan Lopez</a>
                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        <ul class="team-members">
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
                                    </td>
                                    <td>05</td>
                                    <td>
                                        29 Jan 2023
                                    </td>
                                    <td><span class="badge badge-linesuccess">Active</span></td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="javascript:void(0);">
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
                                    <td>Admin</td>
                                    <td>
                                        <div class="userimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="{{ URL::asset('/build/img/users/user-03.jpg') }}"
                                                    alt="product">
                                            </a>
                                            <div>
                                                <a href="javascript:void(0);">Robert Grossman</a>
                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        <ul class="team-members">
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
                                    </td>
                                    <td>06</td>
                                    <td>
                                        13 Feb 2023
                                    </td>
                                    <td><span class="badges-inactive">Inactive</span></td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="javascript:void(0);">
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
                                        <div class="userimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="{{ URL::asset('/build/img/users/user-06.jpg') }}"
                                                    alt="product">
                                            </a>
                                            <div>
                                                <a href="javascript:void(0);">Janet Hembre</a>
                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        <ul class="team-members">
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
                                    </td>
                                    <td>08</td>
                                    <td>
                                        27 Feb 2023
                                    </td>
                                    <td><span class="badges-success">Active</span></td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="javascript:void(0);">
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
                                    <td>Support</td>
                                    <td>
                                        <div class="userimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="{{ URL::asset('/build/img/users/user-04.jpg') }}"
                                                    alt="product">
                                            </a>
                                            <div>
                                                <a href="javascript:void(0);">Russell Belle</a>
                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        <ul class="team-members">
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
                                    </td>
                                    <td>04</td>
                                    <td>
                                        02 Mar 2023
                                    </td>
                                    <td><span class="badges-success">Active</span></td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="javascript:void(0);">
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
                                    <td>Engineering</td>
                                    <td>
                                        <div class="userimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="{{ URL::asset('/build/img/users/user-05.jpg') }}"
                                                    alt="product">
                                            </a>
                                            <div>
                                                <a href="javascript:void(0);">Edward K. Muniz</a>
                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        <ul class="team-members">
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
                                    </td>
                                    <td>10</td>
                                    <td>
                                        17 Mar 2023
                                    </td>
                                    <td><span class="badges-inactive">Inactive</span></td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="javascript:void(0);">
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
                                    <td>Admin</td>
                                    <td>
                                        <div class="userimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="{{ URL::asset('/build/img/users/user-07.jpg') }}"
                                                    alt="product">
                                            </a>
                                            <div>
                                                <a href="javascript:void(0);">Susan Moore</a>
                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        <ul class="team-members">
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
                                    </td>
                                    <td>03</td>
                                    <td>
                                        20 Mar 2023
                                    </td>
                                    <td><span class="badges-success">Active</span></td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="javascript:void(0);">
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
