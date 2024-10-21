<?php $page = 'quotation-list'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            @component('components.breadcrumb')
                @slot('title')
                    Quotation List
                @endslot
                @slot('li_1')
                    Manage Your Quotation
                @endslot
                @slot('li_2')
                    Add New Quotation
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
                                <div class="col-lg-2 col-sm-6 col-12">
                                    <div class="input-blocks">
                                        <i data-feather="box" class="info-img"></i>
                                        <select class="select">
                                            <option>Choose product</option>
                                            <option>Bold V3.2</option>
                                            <option>Apple Series 5 Watch</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-6 col-12">
                                    <div class="input-blocks">
                                        <i data-feather="stop-circle" class="info-img"></i>
                                        <select class="select">
                                            <option>Choose Status</option>
                                            <option>Sent</option>
                                            <option>Ordered</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-6 col-12">
                                    <div class="input-blocks">
                                        <i data-feather="user" class="info-img"></i>
                                        <select class="select">
                                            <option>Choose Custmer</option>
                                            <option>walk-in-customer</option>
                                            <option>John Smith</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-6 col-12">
                                    <div class="input-blocks">
                                        <i data-feather="file-text" class="info-img"></i>
                                        <div class="input-groupicon">
                                            <input type="text" class="form-control" placeholder="Enter Reference">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6 col-12">
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
                                    <th class="no-sort">
                                        <label class="checkboxs">
                                            <input type="checkbox" id="select-all">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </th>
                                    <th>Product Name</th>
                                    <th>Reference</th>
                                    <th>Customer Name</th>
                                    <th>Status</th>
                                    <th>Grand Total ($)</th>
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
                                        <div class="productimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="{{ URL::asset('/build/img/products/product1.jpg') }}"
                                                    alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Lenovo 3rd Generation</a>
                                        </div>
                                    </td>
                                    <td>PT001</td>
                                    <td>walk-in-customer</td>
                                    <td><span class="badges status-badge">Sent</span></td>
                                    <td>$550</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2 mb-0" href="javascript:void(0);">
                                                <i data-feather="eye" class="action-eye"></i>
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
                                        <div class="productimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="{{ URL::asset('/build/img/products/product2.jpg') }}"
                                                    alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Bold V3.2</a>
                                        </div>

                                    </td>
                                    <td>PT002</td>
                                    <td>walk-in-customer</td>
                                    <td><span class="badges status-badge">Sent</span></td>
									<td>$430</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2 mb-0" href="javascript:void(0);">
                                                <i data-feather="eye" class="action-eye"></i>
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
                                        <div class="productimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="{{ URL::asset('/build/img/products/product3.jpg') }}"
                                                    alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Nike Jordan</a>
                                        </div>

                                    </td>
                                    <td>PT003</td>
                                    <td>walk-in-customer</td>
                                    <td><span class="badges order-badge">Ordered</span></td>
                                    <td>$260</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2 mb-0" href="javascript:void(0);">
                                                <i data-feather="eye" class="action-eye"></i>
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
                                        <div class="productimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="{{ URL::asset('/build/img/products/product4.jpg') }}"
                                                    alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Apple Series 5 Watch</a>
                                        </div>

                                    </td>
                                    <td>PT004</td>
                                    <td>John Smith</td>
                                    <td><span class="badges unstatus-badge">Pending</span></td>
                                    <td>$470</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2 mb-0" href="javascript:void(0);">
                                                <i data-feather="eye" class="action-eye"></i>
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
                                        <div class="productimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="{{ URL::asset('/build/img/products/product6.jpg') }}"
                                                    alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Amazon Echo Dot</a>
                                        </div>
                                    </td>
                                    <td>PT005</td>
                                    <td>Harley Stanley</td>
                                    <td><span class="badges unstatus-badge">Pending</span></td>
                                    <td>$380</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2 mb-0" href="javascript:void(0);">
                                                <i data-feather="eye" class="action-eye"></i>
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
                                        <div class="productimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="{{ URL::asset('/build/img/products/product5.jpg') }}"
                                                    alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Lobar Handy</a>
                                        </div>
                                    </td>
                                    <td>PT006</td>
                                    <td>Egbert Caldwell</td>
                                    <td><span class="badges status-badge">Sent</span></td>
                                    <td>$190</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2 mb-0" href="javascript:void(0);">
                                                <i data-feather="eye" class="action-eye"></i>
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
                                        <div class="productimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="{{ URL::asset('/build/img/products/product7.jpg') }}"
                                                    alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Red Premium Handy</a>
                                        </div>
                                    </td>
                                    <td>PT007</td>
                                    <td>walk-in-customer</td>
                                    <td><span class="badges unstatus-badge">Pending</span></td>
                                    <td>$540</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2 mb-0" href="javascript:void(0);">
                                                <i data-feather="eye" class="action-eye"></i>
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
                                        <div class="productimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="{{ URL::asset('/build/img/products/product8.jpg') }}"
                                                    alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Iphone 14 Pro</a>
                                        </div>
                                    </td>
                                    <td>PT008</td>
                                    <td>Benjamin</td>
                                    <td><span class="badges order-badge">Ordered</span></td>
                                    <td>$610</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2 mb-0" href="javascript:void(0);">
                                                <i data-feather="eye" class="action-eye"></i>
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
                                        <div class="productimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="{{ URL::asset('/build/img/products/product9.jpg') }}"
                                                    alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Black Slim 200</a>
                                        </div>
                                    </td>
                                    <td>PT009</td>
                                    <td>walk-in-customer</td>
                                    <td><span class="badges unstatus-badge">Pending</span></td>
                                    <td>$220</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2 mb-0" href="javascript:void(0);">
                                                <i data-feather="eye" class="action-eye"></i>
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
                                        <div class="productimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="{{ URL::asset('/build/img/products/product10.jpg') }}"
                                                    alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Woodcraft Sandal</a>
                                        </div>
                                    </td>
                                    <td>PT010</td>
											<td>Nydia Fitzgerald</td>
											<td><span class="badges status-badge">Sent</span></td>
											<td>$460</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2 mb-0" href="javascript:void(0);">
                                                <i data-feather="eye" class="action-eye"></i>
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
                                        <div class="productimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="{{ URL::asset('/build/img/products/product11.jpg') }}"
                                                    alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Lobar Handy</a>
                                        </div>
                                    </td>
                                    <td>PT011</td>
											<td>Thomas</td>
											<td><span class="badges unstatus-badge">Pending</span></td>
											<td>$250</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2 mb-0" href="javascript:void(0);">
                                                <i data-feather="eye" class="action-eye"></i>
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
                                        <div class="productimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="{{ URL::asset('/build/img/products/product8.jpg') }}"
                                                    alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Iphone 15 Pro</a>
                                        </div>
                                    </td>
                                    <td>PT012</td>
											<td>Benjamin</td>
											<td><span class="badges status-badge">Sent</span></td>
											<td>$550</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2 mb-0" href="javascript:void(0);">
                                                <i data-feather="eye" class="action-eye"></i>
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
