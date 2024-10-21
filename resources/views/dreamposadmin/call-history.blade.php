<?php $page = 'category-list'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-header menu">
                    <div class="page-title">
                        <h4>Call History</h4>
                        <h6>Manage your products</h6>
                    </div>
                </div>
                <div>
                    <ul class="table-top-head">
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img
                                    src="{{ URL::asset('/build/img/icons/pdf.svg') }}" alt="img"></a>
                        </li>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img
                                    src="{{ URL::asset('/build/img/icons/excel.svg') }}" alt="img"></a>
                        </li>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img
                                    src="{{ URL::asset('/build/img/icons/printer.svg') }}" alt="img"></a>
                        </li>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="rotate"><i data-feather="rotate-ccw"
                                    class="feather-rotate-ccw"></i></a>
                        </li>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="up"><i data-feather="chevron-up"
                                    class="feather-chevron-up"></i></a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- /product list -->
            <div class="card table-list-card">
                <div class="card-body">
                    <div class="table-top">
                        <div class="search-set">
                            <div class="search-input">
                                <a href="" class="btn btn-searchset"><i data-feather="search"
                                        class="feather-search"></i></a>
                            </div>
                        </div>
                        <div class="search-path">
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
                    <!-- /Filter -->
                    <div class="card mb-0" id="filter_inputs">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-lg-12 col-sm-12">
                                    <div class="row">
                                        <div class="col-lg-3 col-sm-6 col-12">
                                            <div class="input-blocks">
                                                <i data-feather="user" class="info-img"></i>
                                                <select class="select">
                                                    <option>Choose Name</option>
                                                    <option>Thomas</option>
                                                    <option>Rose</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-6 col-12">
                                            <div class="input-blocks">
                                                <i data-feather="phone" class="info-img"></i>
                                                <select class="select">
                                                    <option>Choose Calls</option>
                                                    <option>All Calls</option>
                                                    <option>Missed Calls</option>
                                                    <option>Outgoing Calls</option>
                                                    <option>Incoming Calls</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6 col-12">
                                            <div class="input-blocks">
                                                <a class="btn btn-filters ms-auto"> <i data-feather="search"
                                                        class="feather-search"></i> Search </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Filter -->
                    <div class="table-responsive product-list">
                        <table class="table  datanew list">
                            <thead>
                                <tr>
                                    <th class="no-sort">
                                        <label class="checkboxs">
                                            <input type="checkbox" id="select-all">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </th>
                                    <th>Username</th>
                                    <th>Phone Number</th>
                                    <th>Call Type</th>
                                    <th>Duration</th>
                                    <th>Date & Time</th>
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
                                        <div class="userimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="{{ URL::asset('/build/img/users/user-01.jpg') }}" alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Arroon</a>
                                        </div>
                                    </td>
                                    <td>+1 25182 94528</td>
                                    <td class="phone-call-icon"><i data-feather="phone" class="income-calls me-1"></i><i
                                            data-feather="arrow-down-left" class="income-success me-1"></i>Incoming Call
                                    </td>
                                    <td>00.25</td>
                                    <td>19 Jan 2023 - 01:16 PM</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-3 p-2" href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#user-profile-new">
                                                <i data-feather="eye" class="feather-eye"></i>
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
                                    <td>
                                        <div class="userimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="{{ URL::asset('/build/img/users/user-02.jpg') }}"
                                                    alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Rose</a>
                                        </div>
                                    </td>
                                    <td>+1 93016 81932</td>
                                    <td class="phone-call-icon"><i data-feather="phone" class="income-calls me-1"></i><i
                                            data-feather="arrow-up-right" class="income-success-missed me-1"></i>Missed
                                        Call</td>
                                    <td>00.00</td>
                                    <td>24 Jan 2023 - 02:50 PM</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-3 p-2" href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#user-profile-new">
                                                <i data-feather="eye" class="feather-eye"></i>
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
                                    <td>
                                        <div class="userimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="{{ URL::asset('/build/img/users/user-03.jpg') }}"
                                                    alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Benjamin</a>
                                        </div>
                                    </td>
                                    <td>+1 25182 94528</td>
                                    <td class="phone-call-icon"><i data-feather="video" class="income-calls me-1"></i><i
                                            data-feather="arrow-down-left" class="income-success me-1"></i>Incoming Call
                                    </td>
                                    <td>00.15</td>
                                    <td>03 Feb 2023 - 10:37 AM</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-3 p-2" href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#user-profile-new">
                                                <i data-feather="eye" class="feather-eye"></i>
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
                                    <td>
                                        <div class="userimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="{{ URL::asset('/build/img/users/user-04.jpg') }}"
                                                    alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Kaitlin</a>
                                        </div>
                                    </td>
                                    <td>+1 70328 96042</td>
                                    <td class="phone-call-icon"><i data-feather="phone" class="income-calls me-1"></i><i
                                            data-feather="arrow-down-left" class="income-success-missed me-1"></i>Missed
                                        Call</td>
                                    <td>00.00</td>
                                    <td>17 Feb 2023 - 11:25 AM</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-3 p-2" href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#user-profile-new">
                                                <i data-feather="eye" class="feather-eye"></i>
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
                                    <td>
                                        <div class="userimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="{{ URL::asset('/build/img/users/user-05.jpg') }}"
                                                    alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Lilly</a>
                                        </div>
                                    </td>
                                    <td>+1 83610 45175</td>
                                    <td class="phone-call-icon"><i data-feather="video" class="income-calls me-1"></i><i
                                            data-feather="arrow-up-right" class="income-success me-1"></i>Outgoing Call
                                    </td>
                                    <td>00.45</td>
                                    <td>14 Mar 2023 - 09:12 AM</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-3 p-2" href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#user-profile-new">
                                                <i data-feather="eye" class="feather-eye"></i>
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
                                    <td>
                                        <div class="userimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="{{ URL::asset('/build/img/users/user-08.jpg') }}"
                                                    alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Freda</a>
                                        </div>
                                    </td>
                                    <td>+1 46217 84294</td>
                                    <td class="phone-call-icon"><i data-feather="phone" class="income-calls me-1"></i><i
                                            data-feather="arrow-down-left" class="income-success me-1"></i>Incoming Call
                                    </td>
                                    <td>00.30</td>
                                    <td>27 Mar 2023 - 04:32 PM</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-3 p-2" href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#user-profile-new">
                                                <i data-feather="eye" class="feather-eye"></i>
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
                                    <td>
                                        <div class="userimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="{{ URL::asset('/build/img/users/user-06.jpg') }}"
                                                    alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Alwin</a>
                                        </div>
                                    </td>
                                    <td>+1 62573 84301</td>
                                    <td class="phone-call-icon"><i data-feather="phone" class="income-calls me-1"></i><i
                                            data-feather="arrow-up-right" class="income-success me-1"></i>Outgoing Call
                                    </td>
                                    <td>01.17</td>
                                    <td>13 Apr 2023 - 02:46 PM</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-3 p-2" href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#user-profile-new">
                                                <i data-feather="eye" class="feather-eye"></i>
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
                                    <td>
                                        <div class="userimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="{{ URL::asset('/build/img/users/user-07.jpg') }}"
                                                    alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Maybelle</a>
                                        </div>
                                    </td>
                                    <td>+1 14693 63826</td>
                                    <td class="phone-call-icon"><i data-feather="video" class="income-calls me-1"></i><i
                                            data-feather="arrow-down-left" class="income-success-missed me-1"></i>Missed
                                        Call</td>
                                    <td>00.00</td>
                                    <td>11 Apr 2023 - 10:29 AM</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-3 p-2" href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#user-profile-new">
                                                <i data-feather="eye" class="feather-eye"></i>
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
                                    <td>
                                        <div class="userimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="{{ URL::asset('/build/img/users/user-10.jpg') }}"
                                                    alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Ellen</a>
                                        </div>
                                    </td>
                                    <td>+1 83710 43827</td>
                                    <td class="phone-call-icon"><i data-feather="phone" class="income-calls me-1"></i><i
                                            data-feather="arrow-down-left" class="income-success me-1"></i>Incoming Call
                                    </td>
                                    <td>00.50</td>
                                    <td>14 May 2023 - 03:06 PM</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-3 p-2" href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#user-profile-new">
                                                <i data-feather="eye" class="feather-eye"></i>
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
                                    <td>
                                        <div class="userimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="{{ URL::asset('/build/img/users/user-12.jpg') }}"
                                                    alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Grace</a>
                                        </div>
                                    </td>
                                    <td>+1 42695 07322</td>
                                    <td class="phone-call-icon"><i data-feather="video" class="income-calls me-1"></i><i
                                            data-feather="arrow-down-left" class="income-success-missed me-1"></i>Missed
                                        Call</td>
                                    <td>00.00</td>
                                    <td>29 May 2023 - 11:23 AM</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-3 p-2" href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#user-profile-new">
                                                <i data-feather="eye" class="feather-eye"></i>
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
