<?php $page = 'invoice-report'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            @component('components.breadcrumb')
                @slot('title')
                    Invoice Report
                @endslot
                @slot('li_1')
                    Manage Your Invoice Report
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
                                <option>25 9 23</option>
                                <option>12 9 23</option>
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
                                            <option>Choose Name</option>
                                            <option>Rose</option>
                                            <option>Kaitlin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="input-blocks">
                                        <i data-feather="stop-circle" class="info-img"></i>
                                        <select class="select">
                                            <option>Choose Status</option>
                                            <option>Paid</option>
                                            <option>Unpaid</option>
                                            <option>Overdue</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="input-blocks">
                                        <div class="position-relative daterange-wraper">
                                            <input type="text" class="form-control" name="datetimes"
                                                placeholder="From Date - To Date">
                                            <i data-feather="calendar" class="feather-14 info-img"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
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
                                    <th>Invoice No</th>
                                    <th>Customer</th>
                                    <th>Due Date</th>
                                    <th>Amount</th>
                                    <th>Paid</th>
                                    <th>Amount Due</th>
                                    <th>Status</th>
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
                                    <td>INV001</td>
                                    <td>Thomas</td>
                                    <td>19 Jan 2023</td>
                                    <td>$1000</td>
                                    <td>$1000</td>
                                    <td>$0.00</td>
                                    <td><span class="badge badge-linesuccess">Paid</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td>INV002</td>
                                    <td>Rose</td>
                                    <td>25 Jan 2023</td>
                                    <td>$1500</td>
                                    <td>$0.00</td>
                                    <td>$1500</td>
                                    <td><span class="badge badge-linedanger">Unpaid</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td>INV003</td>
                                    <td>Benjamin</td>
                                    <td>05 Feb 2023</td>
                                    <td>$1800</td>
                                    <td>$1800</td>
                                    <td>$0.00</td>
                                    <td><span class="badge badge-linesuccess">Paid</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td>INV004</td>
                                    <td>Kaitlin</td>
                                    <td>15 Feb 2023</td>
                                    <td>$2000</td>
                                    <td>$1000</td>
                                    <td>$1000</td>
                                    <td><span class="badge badges-warning">Overdue</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td>INV005</td>
                                    <td>Lilly</td>
                                    <td>18 Mar 2023</td>
                                    <td>$800</td>
                                    <td>$800</td>
                                    <td>$0.00</td>
                                    <td><span class="badge badge-linesuccess">Paid</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td>INV006</td>
                                    <td>Freda</td>
                                    <td>24 Mar 2023</td>
                                    <td>$750</td>
                                    <td>$0.00</td>
                                    <td>$750</td>
                                    <td><span class="badge badge-linedanger">Unpaid</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td>INV007</td>
                                    <td>Alwin</td>
                                    <td>12 Apr 2023</td>
                                    <td>$1300</td>
                                    <td>$1300</td>
                                    <td>$0.00</td>
                                    <td><span class="badge badge-linesuccess">Paid</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td>INV008</td>
                                    <td>Maybelle</td>
                                    <td>24 Apr 2023</td>
                                    <td>$1100</td>
                                    <td>$1100</td>
                                    <td>$0.00</td>
                                    <td><span class="badge badge-linesuccess">Paid</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td>INV009</td>
                                    <td>Ellen</td>
                                    <td>03 May 2023</td>
                                    <td>$2300</td>
                                    <td>$2300</td>
                                    <td>$0.00</td>
                                    <td><span class="badge badge-linesuccess">Paid</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td>INV010</td>
                                    <td>Grace</td>
                                    <td>29 May 2023</td>
                                    <td>$1700</td>
                                    <td>$1700</td>
                                    <td>$0.00</td>
                                    <td><span class="badge badge-linesuccess">Paid</span></td>
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
