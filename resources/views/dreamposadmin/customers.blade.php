<?php $page = 'customers'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            @component('components.breadcrumb')
                @slot('title')
                    Customer List
                @endslot
                @slot('li_1')
                    Manage your warehouse
                @endslot
                @slot('li_2')
                    Add New Customer
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
                                <option>Newest</option>
                                <option>Oldest</option>
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
                                            <option>Benjamin</option>
                                            <option>Ellen</option>
                                            <option>Freda</option>
                                            <option>Kaitlin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="input-blocks">
                                        <i data-feather="globe" class="info-img"></i>
                                        <select class="select">
                                            <option>Choose Country</option>
                                            <option>India</option>
                                            <option>USA</option>
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
                                    <th>Customer Name</th>
                                    <th>Code</th>
                                    <th>Customer</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Country</th>
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
                                        <div class="userimgname cust-imgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="{{ URL::asset('/build/img/users/user-23.jpg') }}" alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Thomas</a>
                                        </div>
                                    </td>
                                    <td>
                                        201
                                    </td>
                                    <td>Thomas</td>
                                    <td>
                                        thomas@exmple.com
                                    </td>
                                    <td>+12163547758 </td>
                                    <td>Germany</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#">
                                                <i data-feather="eye" class="feather-eye"></i>
                                            </a>
                                            <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-units">
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
                                    <td>
                                        <div class="userimgname cust-imgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="{{ URL::asset('/build/img/users/user-15.jpg') }}" alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Rose</a>
                                        </div>
                                    </td>
                                    <td>
                                        201
                                    </td>
                                    <td>Rose</td>
                                    <td>
                                        rose@exmple.com
                                    </td>
                                    <td>+11367529510 </td>
                                    <td>USA</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#">
                                                <i data-feather="eye" class="feather-eye"></i>
                                            </a>
                                            <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-units">
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
                                    <td>
                                        <div class="userimgname cust-imgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="{{ URL::asset('/build/img/users/user-16.jpg') }}"
                                                    alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Benjamin</a>
                                        </div>
                                    </td>
                                    <td>
                                        203
                                    </td>
                                    <td>Benjamin</td>
                                    <td>
                                        benjamin@exmple.com
                                    </td>
                                    <td>+15362789414 </td>
                                    <td>Japan</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#">
                                                <i data-feather="eye" class="feather-eye"></i>
                                            </a>
                                            <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-units">
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
                                    <td>
                                        <div class="userimgname cust-imgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="{{ URL::asset('/build/img/users/user-17.jpg') }}"
                                                    alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Kaitlin</a>
                                        </div>
                                    </td>
                                    <td>
                                        204
                                    </td>
                                    <td>Kaitlin</td>
                                    <td>
                                        kaitlin@exmple.com
                                    </td>
                                    <td>+18513094627 </td>
                                    <td>Austria</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#">
                                                <i data-feather="eye" class="feather-eye"></i>
                                            </a>
                                            <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-units">
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
                                    <td>
                                        <div class="userimgname cust-imgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="{{ URL::asset('/build/img/users/user-18.jpg') }}"
                                                    alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Lilly</a>
                                        </div>
                                    </td>
                                    <td>
                                        205
                                    </td>
                                    <td>Lilly</td>
                                    <td>
                                        lilly@exmple.com
                                    </td>
                                    <td>+14678219025 </td>
                                    <td>India</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#">
                                                <i data-feather="eye" class="feather-eye"></i>
                                            </a>
                                            <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-units">
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
                                    <td>
                                        <div class="userimgname cust-imgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="{{ URL::asset('/build/img/users/user-19.jpg') }}"
                                                    alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Freda</a>
                                        </div>
                                    </td>
                                    <td>
                                        206
                                    </td>
                                    <td>Freda</td>
                                    <td>
                                        freda@exmple.com
                                    </td>
                                    <td>+10913278319 </td>
                                    <td>France</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#">
                                                <i data-feather="eye" class="feather-eye"></i>
                                            </a>
                                            <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-units">
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
                                    <td>
                                        <div class="userimgname cust-imgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="{{ URL::asset('/build/img/customer/people-customer-07.jpg') }}"
                                                    class="people-customer-walk" alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Walk-in-Customer</a>
                                        </div>
                                    </td>
                                    <td>
                                        01
                                    </td>
                                    <td>Walk-in-Customer</td>
                                    <td>
                                        customer01@exmple.com
                                    </td>
                                    <td>+19125852947 </td>
                                    <td>Belgium</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#">
                                                <i data-feather="eye" class="feather-eye"></i>
                                            </a>
                                            <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-units">
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
                                    <td>
                                        <div class="userimgname cust-imgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="{{ URL::asset('/build/img/users/user-06.jpg') }}"
                                                    alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Maybelle</a>
                                        </div>
                                    </td>
                                    <td>
                                        207
                                    </td>
                                    <td>Maybelle</td>
                                    <td>
                                        maybelle@exmple.com
                                    </td>
                                    <td>+19125852947 </td>
                                    <td>Italy</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#">
                                                <i data-feather="eye" class="feather-eye"></i>
                                            </a>
                                            <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-units">
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
                                    <td>
                                        <div class="userimgname cust-imgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="{{ URL::asset('/build/img/users/user-10.jpg') }}"
                                                    alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Ellen</a>
                                        </div>
                                    </td>
                                    <td>
                                        208
                                    </td>
                                    <td>Ellen</td>
                                    <td>
                                        ellen@exmple.com
                                    </td>
                                    <td>+19756194733 </td>
                                    <td>Canada</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#">
                                                <i data-feather="eye" class="feather-eye"></i>
                                            </a>
                                            <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-units">
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
                                    <td>
                                        <div class="userimgname cust-imgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="{{ URL::asset('/build/img/customer/people-customer-07.jpg') }}"
                                                    class="people-customer-walk" alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Walk-in-Customer</a>
                                        </div>
                                    </td>
                                    <td>
                                        02
                                    </td>
                                    <td>Walk-in-Customer</td>
                                    <td>
                                        customer02@exmple.com
                                    </td>
                                    <td>+19167850925 </td>
                                    <td>Greece</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#">
                                                <i data-feather="eye" class="feather-eye"></i>
                                            </a>
                                            <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-units">
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
