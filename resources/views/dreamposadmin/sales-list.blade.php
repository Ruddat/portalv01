<?php $page = 'sales-list'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            @component('components.breadcrumb')
                @slot('title')
                    Sales List
                @endslot
                @slot('li_1')
                    Manage Your Sales
                @endslot
                @slot('li_2')
                    Add New Sales
                @endslot
            @endcomponent

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
                            <div class="d-flex align-items-center">
                                <a class="btn btn-filter" id="filter_search">
                                    <i data-feather="filter" class="filter-icon"></i>
                                    <span><img src="{{ URL::asset('/build/img/icons/closes.svg') }}" alt="img"></span>
                                </a>

                            </div>

                        </div>
                        <div class="form-sort">
                            <i data-feather="sliders" class="info-img"></i>
                            <select class="select">
                                <option>Sort by Date</option>
                                <option>07 09 23</option>
                                <option>21 09 23</option>
                            </select>
                        </div>
                    </div>
                    <!-- /Filter -->
                    <div class="card" id="filter_inputs">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="input-blocks">
                                        <i data-feather="user" class="info-img"></i>
                                        <select class="select">
                                            <option>Choose Customer Name</option>
                                            <option>Macbook pro</option>
                                            <option>Orange</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-6 col-12">
                                    <div class="input-blocks">
                                        <i data-feather="stop-circle" class="info-img"></i>
                                        <select class="select">
                                            <option>Choose Status</option>
                                            <option>Computers</option>
                                            <option>Fruits</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-6 col-12">
                                    <div class="input-blocks">
                                        <i data-feather="file-text" class="info-img"></i>
                                        <input type="text" placeholder="Enter Reference" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="input-blocks">
                                        <i data-feather="stop-circle" class="info-img"></i>
                                        <select class="select">
                                            <option>Choose Payment Status</option>
                                            <option>Computers</option>
                                            <option>Fruits</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-6 col-12">
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
                                    <th>Customer Name</th>
                                    <th>Reference</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Grand Total</th>
                                    <th>Paid</th>
                                    <th>Due</th>
                                    <th>Payment Status</th>
                                    <th>Biller</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="sales-list">
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td>Thomas</td>
                                    <td>SL0101</td>
                                    <td>19 Jan 2023</td>
                                    <td><span class="badge badge-bgsuccess">Completed</span></td>
                                    <td>$550</td>
                                    <td>$550</td>
                                    <td>$0.00</td>
                                    <td><span class="badge badge-linesuccess">Paid</span></td>
                                    <td>Admin</td>
                                    <td class="text-center">
                                        <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                            aria-expanded="true">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#sales-details-new"><i data-feather="eye"
                                                        class="info-img"></i>Sale Detail</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#edit-sales-new"><i data-feather="edit"
                                                        class="info-img"></i>Edit Sale</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#showpayment"><i data-feather="dollar-sign"
                                                        class="info-img"></i>Show Payments</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#createpayment"><i data-feather="plus-circle"
                                                        class="info-img"></i>Create Payment</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"><i
                                                        data-feather="download" class="info-img"></i>Download pdf</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item confirm-text mb-0"><i
                                                        data-feather="trash-2" class="info-img"></i>Delete Sale</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td>Rose</td>
                                    <td>SL0102</td>
                                    <td>26 Jan 2023</td>
                                    <td><span class="badge badge-bgsuccess">Completed</span></td>
                                    <td>$250</td>
                                    <td>$250</td>
                                    <td>$0.00</td>
                                    <td><span class="badge badge-linesuccess">Paid</span></td>
                                    <td>Admin</td>
                                    <td class="text-center">
                                        <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                            aria-expanded="true">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#sales-details-new"><i data-feather="eye"
                                                        class="info-img"></i>Sale Detail</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('edit-sales') }}" class="dropdown-item"
                                                    data-bs-toggle="modal" data-bs-target="#edit-sales-new"><i
                                                        data-feather="edit" class="info-img"></i>Edit Sale</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"
                                                    data-bs-toggle="modal" data-bs-target="#showpayment"><i
                                                        data-feather="dollar-sign" class="info-img"></i>Show Payments</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"
                                                    data-bs-toggle="modal" data-bs-target="#createpayment"><i
                                                        data-feather="plus-circle" class="info-img"></i>Create Payment</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"><i
                                                        data-feather="download" class="info-img"></i>Download pdf</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item confirm-text mb-0"><i
                                                        data-feather="trash-2" class="info-img"></i>Delete Sale</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td>Benjamin</td>
                                    <td>SL0103</td>
                                    <td>08 Feb 2023</td>
                                    <td><span class="badge badge-bgsuccess">Completed</span></td>
                                    <td>$570</td>
                                    <td>$570</td>
                                    <td>$0.00</td>
                                    <td><span class="badge badge-linesuccess">Paid</span></td>
                                    <td>Admin</td>
                                    <td class="text-center">
                                        <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                            aria-expanded="true">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#sales-details-new"><i data-feather="eye"
                                                        class="info-img"></i>Sale Detail</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('edit-sales') }}" class="dropdown-item"
                                                    data-bs-toggle="modal" data-bs-target="#edit-sales-new"><i
                                                        data-feather="edit" class="info-img"></i>Edit Sale</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"
                                                    data-bs-toggle="modal" data-bs-target="#showpayment"><i
                                                        data-feather="dollar-sign" class="info-img"></i>Show Payments</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"
                                                    data-bs-toggle="modal" data-bs-target="#createpayment"><i
                                                        data-feather="plus-circle" class="info-img"></i>Create Payment</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"><i
                                                        data-feather="download" class="info-img"></i>Download pdf</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item confirm-text mb-0"><i
                                                        data-feather="trash-2" class="info-img"></i>Delete Sale</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td>Lilly</td>
                                    <td>SL0104</td>
                                    <td>12 Feb 2023</td>
                                    <td><span class="badge badge-bgdanger">Pending</span></td>
                                    <td>$300</td>
                                    <td>$0.00</td>
                                    <td>$300</td>
                                    <td><span class="badge badge-linedanger">Due</span></td>
                                    <td>Admin</td>
                                    <td class="text-center">
                                        <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                            aria-expanded="true">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#sales-details-new"><i data-feather="eye"
                                                        class="info-img"></i>Sale Detail</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('edit-sales') }}" class="dropdown-item"
                                                    data-bs-toggle="modal" data-bs-target="#edit-sales-new"><i
                                                        data-feather="edit" class="info-img"></i>Edit Sale</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"
                                                    data-bs-toggle="modal" data-bs-target="#showpayment"><i
                                                        data-feather="dollar-sign" class="info-img"></i>Show Payments</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"
                                                    data-bs-toggle="modal" data-bs-target="#createpayment"><i
                                                        data-feather="plus-circle" class="info-img"></i>Create Payment</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"><i
                                                        data-feather="download" class="info-img"></i>Download pdf</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item confirm-text mb-0"><i
                                                        data-feather="trash-2" class="info-img"></i>Delete Sale</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td>Freda</td>
                                    <td>SL0105</td>
                                    <td>17 Mar 2023</td>
                                    <td><span class="badge badge-bgdanger">Pending</span></td>
                                    <td>$700</td>
                                    <td>$0.00</td>
                                    <td>$700</td>
                                    <td><span class="badge badge-linedanger">Due</span></td>
                                    <td>Admin</td>
                                    <td class="text-center">
                                        <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                            aria-expanded="true">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#sales-details-new"><i data-feather="eye"
                                                        class="info-img"></i>Sale Detail</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('edit-sales') }}" class="dropdown-item"
                                                    data-bs-toggle="modal" data-bs-target="#edit-sales-new"><i
                                                        data-feather="edit" class="info-img"></i>Edit Sale</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"
                                                    data-bs-toggle="modal" data-bs-target="#showpayment"><i
                                                        data-feather="dollar-sign" class="info-img"></i>Show Payments</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"
                                                    data-bs-toggle="modal" data-bs-target="#createpayment"><i
                                                        data-feather="plus-circle" class="info-img"></i>Create Payment</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"><i
                                                        data-feather="download" class="info-img"></i>Download pdf</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item confirm-text mb-0"><i
                                                        data-feather="trash-2" class="info-img"></i>Delete Sale</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td>Alwin</td>
                                    <td>SL0106</td>
                                    <td>24 Mar 2023</td>
                                    <td><span class="badge badge-bgsuccess">Completed</span></td>
                                    <td>$400</td>
                                    <td>$400</td>
                                    <td>$0.00</td>
                                    <td><span class="badge badge-linesuccess">Paid</span></td>
                                    <td>Admin</td>
                                    <td class="text-center">
                                        <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                            aria-expanded="true">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#sales-details-new"><i data-feather="eye"
                                                        class="info-img"></i>Sale Detail</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('edit-sales') }}" class="dropdown-item"
                                                    data-bs-toggle="modal" data-bs-target="#edit-sales-new"><i
                                                        data-feather="edit" class="info-img"></i>Edit Sale</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"
                                                    data-bs-toggle="modal" data-bs-target="#showpayment"><i
                                                        data-feather="dollar-sign" class="info-img"></i>Show Payments</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"
                                                    data-bs-toggle="modal" data-bs-target="#createpayment"><i
                                                        data-feather="plus-circle" class="info-img"></i>Create Payment</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"><i
                                                        data-feather="download" class="info-img"></i>Download pdf</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item confirm-text mb-0"><i
                                                        data-feather="trash-2" class="info-img"></i>Delete Sale</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td>Maybelle</td>
                                    <td>SL0107</td>
                                    <td>06 Apr 2023</td>
                                    <td><span class="badge badge-bgdanger">Pending</span></td>
                                    <td>$120</td>
                                    <td>$0.00</td>
                                    <td>$120</td>
                                    <td><span class="badge badge-linedanger">Due</span></td>
                                    <td>Admin</td>
                                    <td class="text-center">
                                        <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                            aria-expanded="true">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#sales-details-new"><i data-feather="eye"
                                                        class="info-img"></i>Sale Detail</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('edit-sales') }}" class="dropdown-item"
                                                    data-bs-toggle="modal" data-bs-target="#edit-sales-new"><i
                                                        data-feather="edit" class="info-img"></i>Edit Sale</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"
                                                    data-bs-toggle="modal" data-bs-target="#showpayment"><i
                                                        data-feather="dollar-sign" class="info-img"></i>Show Payments</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"
                                                    data-bs-toggle="modal" data-bs-target="#createpayment"><i
                                                        data-feather="plus-circle" class="info-img"></i>Create Payment</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"><i
                                                        data-feather="download" class="info-img"></i>Download pdf</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item confirm-text mb-0"><i
                                                        data-feather="trash-2" class="info-img"></i>Delete Sale</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td>Ellen</td>
                                    <td>SL0108</td>
                                    <td>16 Apr 2023</td>
                                    <td><span class="badge badge-bgsuccess">Completed</span></td>
                                    <td>$830</td>
                                    <td>$830</td>
                                    <td>$0.00</td>
                                    <td><span class="badge badge-linesuccess">Paid</span></td>
                                    <td>Admin</td>
                                    <td class="text-center">
                                        <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                            aria-expanded="true">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#sales-details-new"><i data-feather="eye"
                                                        class="info-img"></i>Sale Detail</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('edit-sales') }}" class="dropdown-item"
                                                    data-bs-toggle="modal" data-bs-target="#edit-sales-new"><i
                                                        data-feather="edit" class="info-img"></i>Edit Sale</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"
                                                    data-bs-toggle="modal" data-bs-target="#showpayment"><i
                                                        data-feather="dollar-sign" class="info-img"></i>Show Payments</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"
                                                    data-bs-toggle="modal" data-bs-target="#createpayment"><i
                                                        data-feather="plus-circle" class="info-img"></i>Create Payment</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"><i
                                                        data-feather="download" class="info-img"></i>Download pdf</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item confirm-text mb-0"><i
                                                        data-feather="trash-2" class="info-img"></i>Delete Sale</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td>Kaitlin</td>
                                    <td>SL0109</td>
                                    <td>04 May 2023</td>
                                    <td><span class="badge badge-bgdanger">Pending</span></td>
                                    <td>$800</td>
                                    <td>$0.00</td>
                                    <td>$800</td>
                                    <td><span class="badge badge-linedanger">Due</span></td>
                                    <td>Admin</td>
                                    <td class="text-center">
                                        <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                            aria-expanded="true">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#sales-details-new"><i data-feather="eye"
                                                        class="info-img"></i>Sale Detail</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('edit-sales') }}" class="dropdown-item"
                                                    data-bs-toggle="modal" data-bs-target="#edit-sales-new"><i
                                                        data-feather="edit" class="info-img"></i>Edit Sale</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"
                                                    data-bs-toggle="modal" data-bs-target="#showpayment"><i
                                                        data-feather="dollar-sign" class="info-img"></i>Show Payments</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"
                                                    data-bs-toggle="modal" data-bs-target="#createpayment"><i
                                                        data-feather="plus-circle" class="info-img"></i>Create Payment</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"><i
                                                        data-feather="download" class="info-img"></i>Download pdf</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item confirm-text mb-0"><i
                                                        data-feather="trash-2" class="info-img"></i>Delete Sale</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td>Grace</td>
                                    <td>SL0110</td>
                                    <td>29 May 2023</td>
                                    <td><span class="badge badge-bgsuccess">Completed</span></td>
                                    <td>$460</td>
                                    <td>$460</td>
                                    <td>$0.00</td>
                                    <td><span class="badge badge-linesuccess">Paid</span></td>
                                    <td>Admin</td>
                                    <td class="text-center">
                                        <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                            aria-expanded="true">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#sales-details-new"><i data-feather="eye"
                                                        class="info-img"></i>Sale Detail</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('edit-sales') }}" class="dropdown-item"
                                                    data-bs-toggle="modal" data-bs-target="#edit-sales-new"><i
                                                        data-feather="edit" class="info-img"></i>Edit Sale</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"
                                                    data-bs-toggle="modal" data-bs-target="#showpayment"><i
                                                        data-feather="dollar-sign" class="info-img"></i>Show Payments</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"
                                                    data-bs-toggle="modal" data-bs-target="#createpayment"><i
                                                        data-feather="plus-circle" class="info-img"></i>Create Payment</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"><i
                                                        data-feather="download" class="info-img"></i>Download pdf</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item confirm-text mb-0"><i
                                                        data-feather="trash-2" class="info-img"></i>Delete Sale</a>
                                            </li>
                                        </ul>
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
