<?php $page = 'purchase-order-report'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            @component('components.breadcrumb')
                @slot('title')
                    Purchase order report
                @endslot
                @slot('li_1')
                    Manage your Purchase order report
                @endslot
            @endcomponent

            <!-- /product list -->
            <div class="card">
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
                                        <i data-feather="calendar" class="info-img"></i>
                                        <div class="input-groupicon">
                                            <input type="text" class="datetimepicker" placeholder="Due Date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="input-blocks">
                                        <i data-feather="stop-circle" class="info-img"></i>
                                        <select class="select">
                                            <option>Choose Supplier</option>
                                            <option>Suppliers</option>
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
                                    <th class="no-sort">
                                        <label class="checkboxs">
                                            <input type="checkbox" id="select-all">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </th>
                                    <th>Product Name</th>
                                    <th>Purchased amount</th>
                                    <th>Purchased QTY</th>
                                    <th>Instock QTY</th>
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
                                    <td class="productimgname">
                                        <a class="product-img">
                                            <img src="{{ URL::asset('/build/img/products/product1.jpg') }}" alt="product">
                                        </a>
                                        <a href="javascript:void(0);">Macbook pro</a>
                                    </td>
                                    <td>38698.00</td>
                                    <td>1248</td>
                                    <td>1356</td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td class="productimgname">
                                        <a class="product-img">
                                            <img src="{{ URL::asset('/build/img/products/product2.jpg') }}" alt="product">
                                        </a>
                                        <a href="javascript:void(0);">Orange</a>
                                    </td>
                                    <td>36080.00</td>
                                    <td>110</td>
                                    <td>131</td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td class="productimgname">
                                        <a class="product-img">
                                            <img src="{{ URL::asset('/build/img/products/product3.jpg') }}" alt="product">
                                        </a>
                                        <a href="javascript:void(0);">Pineapple</a>
                                    </td>
                                    <td>21000.00</td>
                                    <td>106</td>
                                    <td>131</td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td class="productimgname">
                                        <a class="product-img">
                                            <img src="{{ URL::asset('/build/img/products/product4.jpg') }}" alt="product">
                                        </a>
                                        <a href="javascript:void(0);">Strawberry</a>
                                    </td>
                                    <td>11000.00</td>
                                    <td>105</td>
                                    <td>100</td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td class="productimgname">
                                        <a class="product-img">
                                            <img src="{{ URL::asset('/build/img/products/product5.jpg') }}" alt="product">
                                        </a>
                                        <a href="javascript:void(0);">Sunglasses</a>
                                    </td>
                                    <td>10600.00</td>
                                    <td>105</td>
                                    <td>100</td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td class="productimgname">
                                        <a class="product-img">
                                            <img src="{{ URL::asset('/build/img/products/product6.jpg') }}"
                                                alt="product">
                                        </a>
                                        <a href="javascript:void(0);">Unpaired gray</a>
                                    </td>
                                    <td>9984.00</td>
                                    <td>50</td>
                                    <td>50</td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td class="productimgname">
                                        <a class="product-img">
                                            <img src="{{ URL::asset('/build/img/products/product7.jpg') }}"
                                                alt="product">
                                        </a>
                                        <a href="javascript:void(0);">Avocat</a>
                                    </td>
                                    <td>4500.00 </td>
                                    <td>41</td>
                                    <td>29</td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td class="productimgname">
                                        <a class="product-img">
                                            <img src="{{ URL::asset('/build/img/products/product8.jpg') }}"
                                                alt="product">
                                        </a>
                                        <a href="javascript:void(0);">Banana</a>
                                    </td>
                                    <td>900.00 </td>
                                    <td>28</td>
                                    <td>24</td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td class="productimgname">
                                        <a class="product-img">
                                            <img src="{{ URL::asset('/build/img/products/product9.jpg') }}"
                                                alt="product">
                                        </a>
                                        <a href="javascript:void(0);">Earphones</a>
                                    </td>
                                    <td>500.00</td>
                                    <td>20</td>
                                    <td>11</td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td class="productimgname">
                                        <a class="product-img">
                                            <img src="{{ URL::asset('/build/img/products/product8.jpg') }}"
                                                alt="product">
                                        </a>
                                        <a href="javascript:void(0);">Banana</a>
                                    </td>
                                    <td>900.00 </td>
                                    <td>28</td>
                                    <td>24</td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td class="productimgname">
                                        <a class="product-img">
                                            <img src="{{ URL::asset('/build/img/products/product9.jpg') }}"
                                                alt="product">
                                        </a>
                                        <a href="javascript:void(0);">Earphones</a>
                                    </td>
                                    <td>500.00</td>
                                    <td>20</td>
                                    <td>11</td>
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
