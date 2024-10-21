<?php $page = 'expired-products'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            @component('components.breadcrumb')
                @slot('title')
                    Expired Products
                @endslot
                @slot('li_1')
                    Manage your expired products
                @endslot
                @slot('li_2')
                    Apply Leave
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
                                        <i data-feather="box" class="info-img"></i>
                                        <select class="select">
                                            <option>Choose Type</option>
                                            <option>Lenovo 3rd Generation</option>
                                            <option>Nike Jordan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="input-blocks">
                                        <i data-feather="calendar" class="info-img"></i>
                                        <div class="input-groupicon">
                                            <input type="text" class="datetimepicker" placeholder="Choose Date">
                                        </div>
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
                                    <th>Product</th>
                                    <th>SKU</th>
                                    <th>Manufactured Date</th>
                                    <th>Expired Date</th>
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
                                            <a href="javascript:void(0);" class="product-img stock-img">
                                                <img src="{{ URL::asset('/build/img/products/stock-img-01.png') }}"
                                                    alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Lenovo 3rd Generation </a>
                                        </div>
                                    </td>
                                    <td>PT001</td>
                                    <td>19 Nov 2022</td>
                                    <td>02 Jan 2023</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="javascript:void(0);">
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
                                            <a href="javascript:void(0);" class="product-img stock-img">
                                                <img src="{{ URL::asset('/build/img/products/stock-img-02.png') }}"
                                                    alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Nike Jordan</a>
                                        </div>
                                    </td>
                                    <td>PT002</td>
                                    <td>24 Nov 2022</td>
                                    <td>23 Jan 2023</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="javascript:void(0);">
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
                                            <a href="javascript:void(0);" class="product-img stock-img">
                                                <img src="{{ URL::asset('/build/img/products/stock-img-03.png') }}"
                                                    alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Apple Series 5 Watch</a>
                                        </div>
                                    </td>
                                    <td>PT003</td>
                                    <td>11 Dec 2022</td>
                                    <td>18 Feb 2023</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="javascript:void(0);">
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
                                            <a href="javascript:void(0);" class="product-img stock-img">
                                                <img src="{{ URL::asset('/build/img/products/stock-img-04.png') }}"
                                                    alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Amazon Echo Dot</a>
                                        </div>
                                    </td>
                                    <td>PT004</td>
                                    <td>27 Dec 2022</td>
                                    <td>24 Feb 2023</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="javascript:void(0);">
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
                                            <a href="javascript:void(0);" class="product-img stock-img">
                                                <img src="{{ URL::asset('/build/img/products/stock-img-05.png') }}"
                                                    alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Lobar Handy</a>
                                        </div>
                                    </td>
                                    <td>PT005</td>
                                    <td>08 Jan 2023</td>
                                    <td>16 Mar 2023</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="javascript:void(0);">
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
                                            <a href="javascript:void(0);" class="product-img stock-img">
                                                <img src="{{ URL::asset('/build/img/products/expire-product-01.png') }}"
                                                    alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Red Premium Handy</a>
                                        </div>
                                    </td>
                                    <td>PT006</td>
                                    <td>17 Jan 2023</td>
                                    <td>29 Mar 2023</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="javascript:void(0);">
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
                                            <a href="javascript:void(0);" class="product-img stock-img">
                                                <img src="{{ URL::asset('/build/img/products/expire-product-02.png') }}"
                                                    alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Red Premium Handy</a>
                                        </div>
                                    </td>
                                    <td>PT007</td>
                                    <td>22 Feb 2023</td>
                                    <td>04 Apr 2023</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="javascript:void(0);">
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
                                            <a href="javascript:void(0);" class="product-img stock-img">
                                                <img src="{{ URL::asset('/build/img/products/expire-product-03.png') }}"
                                                    alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Black Slim 200</a>
                                        </div>
                                    </td>
                                    <td>PT008</td>
                                    <td>18 Mar 2023</td>
                                    <td>13 May 2023</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="javascript:void(0);">
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
                                            <a href="javascript:void(0);" class="product-img stock-img">
                                                <img src="{{ URL::asset('/build/img/products/expire-product-04.png') }}"
                                                    alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Woodcraft Sandal</a>
                                        </div>
                                    </td>
                                    <td>PT009</td>
                                    <td>29 Mar 2023</td>
                                    <td>27 May 2023</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="javascript:void(0);">
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
