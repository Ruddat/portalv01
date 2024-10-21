<?php $page = 'low-stocks'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content">

            <div class="page-header">
                <div class="page-title me-auto">
                    <h4>Low Stocks</h4>
                    <h6>Manage your low stocks</h6>
                </div>
                <ul class="table-top-head low-stock-top-head">
                    <li>
                        <div class="status-toggle d-flex justify-content-between align-items-center">
                            <input type="checkbox" id="user2" class="check" checked="">
                            <label for="user2" class="checktoggle">checkbox</label>
                            Notify
                        </div>
                    </li>
                    <li>
                        <a href="" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#send-email"><i
                                data-feather="mail" class="feather-mail"></i>Send Email</a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"><img
                                src="{{ URL::asset('/build/img/icons/pdf.svg') }}" alt="img"></a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Excel"><img
                                src="{{ URL::asset('/build/img/icons/excel.svg') }}" alt="img"></a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Print"><i data-feather="printer"
                                class="feather-rotate-ccw"></i></a>
                    </li>
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
            <div class="table-tab">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                            aria-selected="true">Low Stocks</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                            aria-selected="false">Out of Stocks</button>
                    </li>

                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
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
                                            <span><img src="{{ URL::asset('/build/img/icons/closes.svg') }}"
                                                    alt="img"></span>
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
                                                    <i data-feather="box" class="info-img"></i>
                                                    <select class="select">
                                                        <option>Choose Product</option>
                                                        <option>Lenovo 3rd Generation </option>
                                                        <option>Nike Jordan </option>
                                                        <option>Amazon Echo Dot </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-sm-6 col-12">
                                                <div class="input-blocks">
                                                    <i data-feather="zap" class="info-img"></i>
                                                    <select class="select">
                                                        <option>Choose Category</option>
                                                        <option>Laptop</option>
                                                        <option>Shoe</option>
                                                        <option>Speaker</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-sm-6 col-12">
                                                <div class="input-blocks">
                                                    <i data-feather="archive" class="info-img"></i>
                                                    <select class="select">
                                                        <option>Choose Warehouse</option>
                                                        <option>Lavish Warehouse </option>
                                                        <option>Lobar Handy </option>
                                                        <option>Traditional Warehouse </option>
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
                                                <th>Warehouse</th>
                                                <th>Store</th>
                                                <th>Product</th>
                                                <th>Category</th>
                                                <th>SKU</th>
                                                <th>Qty</th>
                                                <th>Qty Alert</th>
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
                                                <td>Lavish Warehouse </td>
                                                <td>Crinol</td>

                                                <td>
                                                    <div class="productimgname">
                                                        <a href="javascript:void(0);" class="product-img stock-img">
                                                            <img src="{{ URL::asset('/build/img/products/stock-img-01.png') }}"
                                                                alt="product">
                                                        </a>
                                                        <a href="javascript:void(0);">Lenovo 3rd Generation </a>
                                                    </div>
                                                </td>
                                                <td>Laptop</td>
                                                <td>PT001</td>
                                                <td>15</td>
                                                <td>10</td>
                                                <td class="action-table-data">
                                                    <div class="edit-delete-action">
                                                        <a class="me-2 p-2" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#edit-stock">
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
                                                <td>Lobar Handy</td>
                                                <td>Selosy</td>

                                                <td>
                                                    <div class="productimgname">
                                                        <a href="javascript:void(0);" class="product-img stock-img">
                                                            <img src="{{ URL::asset('/build/img/products/stock-img-02.png') }}"
                                                                alt="product">
                                                        </a>
                                                        <a href="javascript:void(0);">Nike Jordan </a>
                                                    </div>
                                                </td>
                                                <td>Shoe</td>
                                                <td>PT002</td>
                                                <td>17</td>
                                                <td>08</td>
                                                <td class="action-table-data">
                                                    <div class="edit-delete-action">
                                                        <a class="me-2 p-2" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#edit-stock">
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
                                                <td>Quaint Warehouse</td>
                                                <td>Logerro</td>

                                                <td>
                                                    <div class="productimgname">
                                                        <a href="javascript:void(0);" class="product-img stock-img">
                                                            <img src="{{ URL::asset('/build/img/products/stock-img-03.png') }}"
                                                                alt="product">
                                                        </a>
                                                        <a href="javascript:void(0);">Apple Series 5 Watch </a>
                                                    </div>
                                                </td>
                                                <td>Electronics</td>
                                                <td>PT003</td>
                                                <td>14</td>
                                                <td>12</td>
                                                <td class="action-table-data">
                                                    <div class="edit-delete-action">
                                                        <a class="me-2 p-2" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#edit-stock">
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
                                                <td>Traditional Warehouse</td>
                                                <td>Vesloo</td>

                                                <td>
                                                    <div class="productimgname">
                                                        <a href="javascript:void(0);" class="product-img stock-img">
                                                            <img src="{{ URL::asset('/build/img/products/stock-img-04.png') }}"
                                                                alt="product">
                                                        </a>
                                                        <a href="javascript:void(0);">Amazon Echo Dot</a>
                                                    </div>
                                                </td>
                                                <td>Speaker</td>
                                                <td>PT004</td>
                                                <td>20</td>
                                                <td>15</td>
                                                <td class="action-table-data">
                                                    <div class="edit-delete-action">
                                                        <a class="me-2 p-2" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#edit-stock">
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
                                                <td>Cool Warehouse</td>
                                                <td>Crompy</td>

                                                <td>
                                                    <div class="productimgname">
                                                        <a href="javascript:void(0);" class="product-img stock-img">
                                                            <img src="{{ URL::asset('/build/img/products/stock-img-05.png') }}"
                                                                alt="product">
                                                        </a>
                                                        <a href="javascript:void(0);">Lobar Handy</a>
                                                    </div>
                                                </td>
                                                <td>Furnitures</td>
                                                <td>PT005</td>
                                                <td>18</td>
                                                <td>13</td>
                                                <td class="action-table-data">
                                                    <div class="edit-delete-action">
                                                        <a class="me-2 p-2" href="javascript:void(0);"
                                                            data-bs-toggle="modal" data-bs-target="#edit-stock">
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
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
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
                                        <a class="btn btn-filter" id="filter_search1">
                                            <i data-feather="filter" class="filter-icon"></i>
                                            <span><img src="{{ URL::asset('/build/img/icons/closes.svg') }}"
                                                    alt="img"></span>
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
                                <div class="card" id="filter_inputs1">
                                    <div class="card-body pb-0">
                                        <div class="row">
                                            <div class="col-lg-3 col-sm-6 col-12">
                                                <div class="input-blocks">
                                                    <i data-feather="box" class="info-img"></i>
                                                    <select class="select">
                                                        <option>Choose Product</option>
                                                        <option>Lenovo 3rd Generation </option>
                                                        <option>Nike Jordan </option>
                                                        <option>Amazon Echo Dot </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-sm-6 col-12">
                                                <div class="input-blocks">
                                                    <i data-feather="zap" class="info-img"></i>
                                                    <select class="select">
                                                        <option>Choose Category</option>
                                                        <option>Laptop</option>
                                                        <option>Shoe</option>
                                                        <option>Speaker</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-sm-6 col-12">
                                                <div class="input-blocks">
                                                    <i data-feather="archive" class="info-img"></i>
                                                    <select class="select">
                                                        <option>Choose Warehouse</option>
                                                        <option>Lavish Warehouse </option>
                                                        <option>Lobar Handy </option>
                                                        <option>Traditional Warehouse </option>
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
                                                        <input type="checkbox" id="select-all2">
                                                        <span class="checkmarks"></span>
                                                    </label>
                                                </th>
                                                <th>Warehouse</th>
                                                <th>Store</th>
                                                <th>Product</th>
                                                <th>Category</th>
                                                <th>SKU</th>
                                                <th>Qty</th>
                                                <th>Qty Alert</th>
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
                                                <td>Lavish Warehouse </td>
                                                <td>Crinol</td>

                                                <td>
                                                    <div class="productimgname">
                                                        <a href="javascript:void(0);" class="product-img stock-img">
                                                            <img src="{{ URL::asset('/build/img/products/stock-img-01.png') }}"
                                                                alt="product">
                                                        </a>
                                                        <a href="javascript:void(0);">Lenovo 3rd Generation </a>
                                                    </div>
                                                </td>
                                                <td>Laptop</td>
                                                <td>PT001</td>
                                                <td>15</td>
                                                <td>10</td>
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
                                                <td>Lobar Handy</td>
                                                <td>Selosy</td>

                                                <td>
                                                    <div class="productimgname">
                                                        <a href="javascript:void(0);" class="product-img stock-img">
                                                            <img src="{{ URL::asset('/build/img/products/stock-img-02.png') }}"
                                                                alt="product">
                                                        </a>
                                                        <a href="javascript:void(0);">Nike Jordan </a>
                                                    </div>
                                                </td>
                                                <td>Shoe</td>
                                                <td>PT002</td>
                                                <td>17</td>
                                                <td>08</td>
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
                                                <td>Quaint Warehouse</td>
                                                <td>Logerro</td>

                                                <td>
                                                    <div class="productimgname">
                                                        <a href="javascript:void(0);" class="product-img stock-img">
                                                            <img src="{{ URL::asset('/build/img/products/stock-img-03.png') }}"
                                                                alt="product">
                                                        </a>
                                                        <a href="javascript:void(0);">Apple Series 5 Watch </a>
                                                    </div>
                                                </td>
                                                <td>Electronics</td>
                                                <td>PT003</td>
                                                <td>14</td>
                                                <td>12</td>
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
                                                <td>Traditional Warehouse</td>
                                                <td>Vesloo</td>

                                                <td>
                                                    <div class="productimgname">
                                                        <a href="javascript:void(0);" class="product-img stock-img">
                                                            <img src="{{ URL::asset('/build/img/products/stock-img-04.png') }}"
                                                                alt="product">
                                                        </a>
                                                        <a href="javascript:void(0);">Amazon Echo Dot</a>
                                                    </div>
                                                </td>
                                                <td>Speaker</td>
                                                <td>PT004</td>
                                                <td>20</td>
                                                <td>15</td>
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
                                                <td>Cool Warehouse</td>
                                                <td>Crompy</td>

                                                <td>
                                                    <div class="productimgname">
                                                        <a href="javascript:void(0);" class="product-img stock-img">
                                                            <img src="{{ URL::asset('/build/img/products/stock-img-05.png') }}"
                                                                alt="product">
                                                        </a>
                                                        <a href="javascript:void(0);">Lobar Handy</a>
                                                    </div>
                                                </td>
                                                <td>Furnitures</td>
                                                <td>PT005</td>
                                                <td>18</td>
                                                <td>13</td>
                                                <td class="action-table-data">
                                                    <div class="edit-delete-action">
                                                        <a class="me-3 p-2" href="javascript:void(0);">
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
            </div>
        </div>
    </div>
@endsection
