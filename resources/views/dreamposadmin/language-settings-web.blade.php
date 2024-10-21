<?php $page = 'language-settings-web'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content settings-content">
            <div class="page-header settings-pg-header">
                <div class="add-item d-flex">
                    <div class="page-title">
                        <h4>Settings</h4>
                        <h6>Manage your settings on portal</h6>
                    </div>
                </div>
                <ul class="table-top-head">
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i data-feather="rotate-ccw"
                                class="feather-rotate-ccw"></i></a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i
                                data-feather="chevron-up" class="feather-chevron-up"></i></a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="settings-wrapper d-flex">
                        @component('components.settings-sidebar')
                    @endcomponent
                        <div class="settings-page-wrap w-50">
                            <div class="setting-title">
                                <h4>Language</h4>
                            </div>
                            <div class="page-header">
                                <div class="back-btn">
                                    <a href="{{ url('language-settings') }}" class="btn btn-translation"><i
                                            data-feather="arrow-left" class="filter-icon me-2"></i>Back to Translations </a>
                                </div>
                                <div class="page-btn">
                                    <a href="javascript:void(0);" class="d-flex align-items-center selected-language"><img
                                            src="{{ URL::asset('/build/img/icons/flag-02.svg') }}" class="me-2"
                                            alt="">Arabic</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card table-list-card">
                                        <div class="card-body">
                                            <div class="table-top">
                                                <div class="search-set">
                                                    <div class="search-input">
                                                        <a href="javascript:void(0);" class="btn btn-searchset"><i
                                                                data-feather="search" class="feather-search"></i></a>
                                                    </div>
                                                </div>
                                            </div>
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
                                                            <th>Medium</th>
                                                            <th>File</th>
                                                            <th>Total</th>
                                                            <th>Complete</th>
                                                            <th>Progress</th>
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
                                                            <td>
                                                                Web
                                                            </td>
                                                            <td>
                                                                <span class="file-data">Inventory</span>
                                                            </td>
                                                            <td>2145</td>
                                                            <td>1815</td>
                                                            <td>
                                                                <div class="position-relative">
                                                                    <div class="progress attendance language-progress">
                                                                        <div class="progress-bar progress-bar-warning"
                                                                            role="progressbar">
                                                                            <span>80%</span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </td>
                                                            <td class="action-table-data">
                                                                <div class="edit-delete-action">
                                                                    <a class="me-2 p-2" href="#"
                                                                        data-bs-toggle="offcanvas"
                                                                        data-bs-target="#offcanvasRight">
                                                                        <i data-feather="edit" class="feather-edit"></i>
                                                                    </a>
                                                                    <a class="confirm-text p-2"
                                                                        href="javascript:void(0);">
                                                                        <i data-feather="trash-2"
                                                                            class="feather-trash-2"></i>
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
                                                            <td>
                                                                Web
                                                            </td>
                                                            <td>
                                                                <span class="file-data">Expense</span>
                                                            </td>
                                                            <td>2045</td>
                                                            <td>2045</td>
                                                            <td>
                                                                <div class="position-relative">
                                                                    <div class="progress attendance language-progress">
                                                                        <div class="progress-bar progress-bar-success"
                                                                            role="progressbar">
                                                                            <span>100%</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="action-table-data">
                                                                <div class="edit-delete-action">
                                                                    <a class="me-2 p-2" href="#"
                                                                        data-bs-toggle="offcanvas"
                                                                        data-bs-target="#offcanvasRight">
                                                                        <i data-feather="edit" class="feather-edit"></i>
                                                                    </a>
                                                                    <a class="confirm-text p-2"
                                                                        href="javascript:void(0);">
                                                                        <i data-feather="trash-2"
                                                                            class="feather-trash-2"></i>
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
                                                            <td>
                                                                Web
                                                            </td>
                                                            <td>
                                                                <span class="file-data">Product</span>
                                                            </td>
                                                            <td>2245</td>
                                                            <td>295</td>
                                                            <td>
                                                                <div class="position-relative">
                                                                    <div class="progress attendance language-progress">
                                                                        <div class="progress-bar progress-bar-violet"
                                                                            role="progressbar">
                                                                            <span>5%</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="action-table-data">
                                                                <div class="edit-delete-action">
                                                                    <a class="me-2 p-2" href="#"
                                                                        data-bs-toggle="offcanvas"
                                                                        data-bs-target="#offcanvasRight">
                                                                        <i data-feather="edit" class="feather-edit"></i>
                                                                    </a>
                                                                    <a class="confirm-text p-2"
                                                                        href="javascript:void(0);">
                                                                        <i data-feather="trash-2"
                                                                            class="feather-trash-2"></i>
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
                                                            <td>
                                                                Web
                                                            </td>
                                                            <td>
                                                                <span class="file-data">Settings</span>
                                                            </td>
                                                            <td>2535</td>
                                                            <td>1145</td>
                                                            <td>
                                                                <div class="position-relative">
                                                                    <div class="progress attendance language-progress">
                                                                        <div class="progress-bar progress-bar-violet-two"
                                                                            role="progressbar">
                                                                            <span>40%</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="action-table-data">
                                                                <div class="edit-delete-action">
                                                                    <a class="me-2 p-2" href="#"
                                                                        data-bs-toggle="offcanvas"
                                                                        data-bs-target="#offcanvasRight">
                                                                        <i data-feather="edit" class="feather-edit"></i>
                                                                    </a>
                                                                    <a class="confirm-text p-2"
                                                                        href="javascript:void(0);">
                                                                        <i data-feather="trash-2"
                                                                            class="feather-trash-2"></i>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
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
    </div>

    <!-- Edit Language -->
    <div class="offcanvas offcanvas-end em-payrol-add" tabindex="-1" id="offcanvasRight">
        <div class="offcanvas-body p-0">
            <div class="page-wrapper-new">
                <div class="content">
                    <div class="page-header justify-content-between">
                        <div class="page-title d-flex align-items-center">
                            <div class="page-btn mt-0">
                                <a href="javascript:void(0);"
                                    class="d-flex align-items-center selected-language me-3"><img
                                        src="{{ URL::asset('/build/img/icons/flag-02.svg') }}" class="me-2"
                                        alt="">Arabic</a>
                            </div>
                            <div class="position-relative">
                                <p class="mb-0">Progress</p>
                                <div class="d-flex align-items-center">
                                    <div class="progress attendance language-progress">
                                        <div class="progress-bar progress-bar-violet-two" role="progressbar">
                                        </div>
                                    </div>
                                    <span class="position-static ms-2">40%</span>
                                </div>
                            </div>
                        </div>
                        <div class="page-btn">
                            <a href="#" class="btn btn-secondary" data-bs-dismiss="offcanvas"><i
                                    data-feather="arrow-left" class="me-2"></i>Back to Translations </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table datanew">
                            <thead>
                                <tr>
                                    <th class="no-sort fixed-width">English</th>
                                    <th class="no-sort fixed-width">Arabic</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> Bugs</td>
                                    <td>
                                        <div><input type="text" class="form-control" value="البق"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td> Bugs Email</td>
                                    <td>
                                        <div><input type="text" class="form-control" value="البق البريد الإلكتروني">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Bug Assigned</td>
                                    <td>
                                        <div><input type="text" class="form-control" value="علة المخصصة"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td> Bug Comments</td>
                                    <td>
                                        <div><input type="text" class="form-control" value="علة المخصصة"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Bug Attachment</td>
                                    <td>
                                        <div><input type="text" class="form-control" value="علة المخصصة"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td> Bug Updated</td>
                                    <td>
                                        <div><input type="text" class="form-control" value="علة المخصصة"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td> Bug Reported</td>
                                    <td>
                                        <div><input type="text" class="form-control" value="علة المخصصة"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td> Bugs infromation successfully updated</td>
                                    <td>
                                        <div><input type="text" class="form-control" value="علة المخصصة"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td> Bugs infromation successfully Saved</td>
                                    <td>
                                        <div><input type="text" class="form-control" value="علة المخصصة"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td> Timer infromation successfully Deleted</td>
                                    <td>
                                        <div><input type="text" class="form-control" value="علة المخصصة"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td> Bugs infromation successfully Deleted</td>
                                    <td>
                                        <div><input type="text" class="form-control" value="علة المخصصة"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td> Bug Updated</td>
                                    <td>
                                        <div><input type="text" class="form-control" value="علة المخصصة"></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Language -->
@endsection
