<?php $page = 'purchase-returns'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            @component('components.breadcrumb')
                @slot('title')
                    Purchase Return List
                @endslot
                @slot('li_1')
                    Manage your Returns
                @endslot
                @slot('li_2')
                    Add New Purchase Return
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
                    <div class="card" id="filter_inputs">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="input-blocks">
                                        <i data-feather="calendar" class="info-img"></i>
                                        <div class="input-groupicon">
                                            <input type="text" class="datetimepicker" placeholder="From Date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="input-blocks">
                                        <i data-feather="stop-circle" class="info-img"></i>
                                        <select class="select">
                                            <option>Choose Supplier</option>
                                            <option>Apex Computers </option>
                                            <option>Modern Automobile </option>
                                            <option>AIM Infotech </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="input-blocks">
                                        <i data-feather="stop-circle" class="info-img"></i>
                                        <select class="select">
                                            <option>Choose Status</option>
                                            <option>Received</option>
                                            <option>Ordered</option>
                                            <option>Pending</option>
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
                        <table class="table datanew">
                            <thead>
                                <tr>
                                    <th>
                                        <label class="checkboxs">
                                            <input type="checkbox" id="select-all">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </th>
                                    <th>Image</th>
                                    <th>Date</th>
                                    <th>Supplier</th>
                                    <th>Reference</th>
                                    <th>Status</th>
                                    <th>Grand Total ($)</th>
                                    <th>Paid ($)</th>
                                    <th>Due ($)</th>
                                    <th>Payment Status</th>
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
                                        <a class="product-img">
                                            <img src="{{ URL::asset('/build/img/products/product1.jpg') }}" alt="product">
                                        </a>
                                    </td>
                                    <td>2/27/2022</td>
                                    <td>Apex Computers </td>
                                    <td>PT001</td>
                                    <td><span class="badges bg-lightgreen">Received</span></td>
                                    <td>550</td>
                                    <td>120</td>
                                    <td>550</td>
                                    <td><span class="badges bg-lightgreen">Paid</span></td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-sales-new">
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
                                        <a class="product-img">
                                            <img src="{{ URL::asset('/build/img/products/product2.jpg') }}" alt="product">
                                        </a>
                                    </td>
                                    <td>1/15/2022</td>
                                    <td>Modern Automobile</td>
                                    <td>PT002</td>
                                    <td><span class="badges bg-lightyellow">Ordered</span></td>
                                    <td>550</td>
                                    <td>120</td>
                                    <td>550</td>
                                    <td><span class="badges bg-lightyellow">Partial</span></td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-sales-new">
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
                                        <a class="product-img">
                                            <img src="{{ URL::asset('/build/img/products/product3.jpg') }}"
                                                alt="product">
                                        </a>
                                    </td>
                                    <td>3/24/2022</td>
                                    <td>AIM Infotech</td>
                                    <td>PT003</td>
                                    <td><span class="badges bg-lightred">Pending</span></td>
                                    <td>210</td>
                                    <td>120</td>
                                    <td>210</td>
                                    <td><span class="badges bg-lightred">Unpaid</span></td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-sales-new">
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
                                        <a class="product-img">
                                            <img src="{{ URL::asset('/build/img/products/product4.jpg') }}"
                                                alt="product">
                                        </a>
                                    </td>
                                    <td>1/15/2022</td>
                                    <td>Best Power Tools</td>
                                    <td>PT004</td>
                                    <td><span class="badges bg-lightgreen">Received</span></td>
                                    <td>210</td>
                                    <td>120</td>
                                    <td>210</td>
                                    <td><span class="badges bg-lightgreen">Paid</span></td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-sales-new">
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
                                        <a class="product-img">
                                            <img src="{{ URL::asset('/build/img/products/product5.jpg') }}"
                                                alt="product">
                                        </a>
                                    </td>
                                    <td>1/15/2022</td>
                                    <td>AIM Infotech</td>
                                    <td>PT005</td>
                                    <td><span class="badges bg-lightred">Pending</span></td>
                                    <td>210</td>
                                    <td>120</td>
                                    <td>210</td>
                                    <td><span class="badges bg-lightred">UnPaid</span></td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-sales-new">
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
                                        <a class="product-img">
                                            <img src="{{ URL::asset('/build/img/products/product6.jpg') }}"
                                                alt="product">
                                        </a>
                                    </td>
                                    <td>3/24/2022</td>
                                    <td>Best Power Tools</td>
                                    <td>PT006</td>
                                    <td><span class="badges bg-lightgreen">Received</span></td>
                                    <td>210</td>
                                    <td>120</td>
                                    <td>210</td>
                                    <td><span class="badges bg-lightgreen">paid</span></td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-sales-new">
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
                                        <a class="product-img">
                                            <img src="{{ URL::asset('/build/img/products/product7.jpg') }}"
                                                alt="product">
                                        </a>
                                    </td>
                                    <td>1/15/2022</td>
                                    <td>Apex Computers</td>
                                    <td>PT007</td>
                                    <td><span class="badges bg-lightyellow">Ordered</span></td>
                                    <td>1000</td>
                                    <td>500</td>
                                    <td>1000</td>
                                    <td><span class="badges bg-lightyellow">Partial</span></td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-sales-new">
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
                                        <a class="product-img">
                                            <img src="{{ URL::asset('/build/img/products/product8.jpg') }}"
                                                alt="product">
                                        </a>
                                    </td>
                                    <td>3/24/2022</td>
                                    <td>Best Power Tools</td>
                                    <td>PT008</td>
                                    <td><span class="badges bg-lightgreen">Received</span></td>
                                    <td>210</td>
                                    <td>120</td>
                                    <td>210</td>
                                    <td><span class="badges bg-lightgreen">paid</span></td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-sales-new">
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
                                        <a class="product-img">
                                            <img src="{{ URL::asset('/build/img/products/product9.jpg') }}"
                                                alt="product">
                                        </a>
                                    </td>
                                    <td>3/24/2022</td>
                                    <td>Hatimi Hardware & Tools</td>
                                    <td>PT009</td>
                                    <td><span class="badges bg-lightred">Pending</span></td>
                                    <td>5500</td>
                                    <td>550</td>
                                    <td>5500</td>
                                    <td><span class="badges bg-lightred">Unpaid</span></td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-sales-new">
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
                                        <a class="product-img">
                                            <img src="{{ URL::asset('/build/img/products/product10.jpg') }}"
                                                alt="product">
                                        </a>
                                    </td>
                                    <td>3/24/2022</td>
                                    <td>Best Power Tools</td>
                                    <td>PT0010</td>
                                    <td><span class="badges bg-lightred">Pending</span></td>
                                    <td>2580</td>
                                    <td>1250</td>
                                    <td>2580</td>
                                    <td><span class="badges bg-lightred">Unpaid</span></td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-sales-new">
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
                                        <a class="product-img">
                                            <img src="{{ URL::asset('/build/img/products/product5.jpg') }}"
                                                alt="product">
                                        </a>
                                    </td>
                                    <td>3/24/2022</td>
                                    <td>Best Power Tools</td>
                                    <td>PT0011</td>
                                    <td><span class="badges bg-lightred">Pending</span></td>
                                    <td>2580</td>
                                    <td>1250</td>
                                    <td>2580</td>
                                    <td><span class="badges bg-lightred">Unpaid</span></td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-sales-new">
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
