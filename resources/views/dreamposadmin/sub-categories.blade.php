<?php $page = 'sub-categories'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            @component('components.breadcrumb')
                @slot('title')
                    Sub Category list
                @endslot
                @slot('li_1')
                    Manage your subcategories
                @endslot
                @slot('li_2')
                    Add Sub Category
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
                                        <i data-feather="zap" class="info-img"></i>
                                        <select class="select">
                                            <option>Choose Category</option>
                                            <option>Laptop</option>
                                            <option>Electronics</option>
                                            <option>Shoe</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="input-blocks">
                                        <i data-feather="zap" class="info-img"></i>
                                        <select class="select">
                                            <option>Choose SubCategory</option>
                                            <option>Fruits</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="input-blocks">
                                        <i data-feather="stop-circle" class="info-img"></i>
                                        <select class="select">
                                            <option>Category Code</option>
                                            <option>CT001</option>
                                            <option>CT002</option>
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
                                    <th>Image</th>
                                    <th>Category</th>
                                    <th>Parent category</th>
                                    <th>Category Code</th>
                                    <th>Description</th>
                                    <th>Created By</th>
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
                                    <td>Computers</td>
                                    <td>Computers</td>
                                    <td>CT001</td>
                                    <td>Computers Description</td>
                                    <td>Admin</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-category">
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
                                    <td>Fruits</td>
                                    <td>Fruits</td>
                                    <td>CT002</td>
                                    <td>Fruits Description</td>
                                    <td>Admin</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-category">
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
                                            <img src="{{ URL::asset('/build/img/products/product3.jpg') }}" alt="product">
                                        </a>
                                    </td>
                                    <td>Fruits</td>
                                    <td>Fruits</td>
                                    <td>CT003</td>
                                    <td>Fruits Description</td>
                                    <td>Admin</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-category">
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
                                    <td>Fruits</td>
                                    <td>Fruits</td>
                                    <td>CT004</td>
                                    <td>Fruits Description</td>
                                    <td>Admin</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-category">
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
                                    <td>Accessories</td>
                                    <td>Accessories</td>
                                    <td>CT005</td>
                                    <td>Accessories Description</td>
                                    <td>Admin</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-category">
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
                                    <td>Shoes</td>
                                    <td>Shoes</td>
                                    <td>CT006</td>
                                    <td>Shoes Description</td>
                                    <td>Admin</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-category">
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
                                    <td>Fruits</td>
                                    <td>Fruits</td>
                                    <td>CT007</td>
                                    <td>Fruits Description</td>
                                    <td>Admin</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-category">
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
                                    <td>Fruits</td>
                                    <td>Fruits</td>
                                    <td>CT008</td>
                                    <td>Fruits Description</td>
                                    <td>Admin</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-category">
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
                                    <td>Computers</td>
                                    <td>Computers</td>
                                    <td>CT009</td>
                                    <td>Computers Description</td>
                                    <td>Admin</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-category">
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
                                    <td>Health Care </td>
                                    <td>Health Care </td>
                                    <td>CT0010</td>
                                    <td>Health Care Description</td>
                                    <td>Admin</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-category">
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
                                    <td>Fruits</td>
                                    <td>Fruits</td>
                                    <td>CT004</td>
                                    <td>Fruits Description</td>
                                    <td>Admin</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-category">
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
                                    <td>Accessories</td>
                                    <td>Accessories</td>
                                    <td>CT005</td>
                                    <td>Accessories Description</td>
                                    <td>Admin</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-category">
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
                                    <td>Shoes</td>
                                    <td>Shoes</td>
                                    <td>CT006</td>
                                    <td>Shoes Description</td>
                                    <td>Admin</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-category">
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
                                    <td>Fruits</td>
                                    <td>Fruits</td>
                                    <td>CT007</td>
                                    <td>Fruits Description</td>
                                    <td>Admin</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-category">
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
                                    <td>Fruits</td>
                                    <td>Fruits</td>
                                    <td>CT008</td>
                                    <td>Fruits Description</td>
                                    <td>Admin</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-category">
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
                                    <td>Computers</td>
                                    <td>Computers</td>
                                    <td>CT009</td>
                                    <td>Computers Description</td>
                                    <td>Admin</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-category">
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
                                    <td>Health Care </td>
                                    <td>Health Care </td>
                                    <td>CT0010</td>
                                    <td>Health Care Description</td>
                                    <td>Admin</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-category">
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
