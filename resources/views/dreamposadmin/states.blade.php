<?php $page = 'states'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            @component('components.breadcrumb')
                @slot('title')
                    State List
                @endslot
                @slot('li_1')
                    Manage your States
                @endslot
                @slot('li_2')
                    Add New State
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
                                        <i data-feather="globe" class="info-img"></i>
                                        <select class="select">
                                            <option>Choose Country</option>
                                            <option>Mexico</option>
                                            <option>Italy</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="input-blocks">
                                        <i data-feather="stop-circle" class="info-img"></i>
                                        <select class="select">
                                            <option>Choose Status</option>
                                            <option>Active</option>
                                            <option>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="input-blocks">
                                        <i data-feather="map-pin" class="info-img"></i>
                                        <select class="select">
                                            <option>Choose State</option>
                                            <option>Newyork</option>
                                            <option>Bangkok</option>
                                        </select>
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
                        <table class="table datanew">
                            <thead>
                                <tr>
                                    <th class="no-sort">
                                        <label class="checkboxs">
                                            <input type="checkbox" id="select-all">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </th>
                                    <th>State Name</th>
                                    <th>Country</th>
                                    <th>Status</th>
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
                                    <td>Beijing</td>
                                    <td>China</td>
                                    <td><span class="badge badge-linedanger">Inactive</span></td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2 mb-0" href="javascript:void(0);">
                                                <i data-feather="eye" class="action-eye"></i>
                                            </a>
                                            <a class="me-2 p-2 mb-0" data-bs-toggle="modal" data-bs-target="#edit-units">
                                                <i data-feather="edit" class="feather-edit"></i>
                                            </a>
                                            <a class="me-2 confirm-text p-2 mb-0" href="javascript:void(0);">
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
                                    <td>Newyork</td>
                                    <td>USA</td>
                                    <td><span class="badge badge-linesuccess">Active</span></td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2 mb-0" href="javascript:void(0);">
                                                <i data-feather="eye" class="action-eye"></i>
                                            </a>
                                            <a class="me-2 p-2 mb-0" data-bs-toggle="modal" data-bs-target="#edit-units">
                                                <i data-feather="edit" class="feather-edit"></i>
                                            </a>
                                            <a class="me-2 confirm-text p-2 mb-0" href="javascript:void(0);">
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
                                    <td>Greece</td>
                                    <td>Athens</td>
                                    <td><span class="badge badge-linesuccess">Active</span></td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2 mb-0" href="javascript:void(0);">
                                                <i data-feather="eye" class="action-eye"></i>
                                            </a>
                                            <a class="me-2 p-2 mb-0" data-bs-toggle="modal" data-bs-target="#edit-units">
                                                <i data-feather="edit" class="feather-edit"></i>
                                            </a>
                                            <a class="me-2 confirm-text p-2 mb-0" href="javascript:void(0);">
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
                                    <td>Bangkok</td>
                                    <td>Thailand</td>
                                    <td><span class="badge badge-linesuccess">Active</span></td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2 mb-0" href="javascript:void(0);">
                                                <i data-feather="eye" class="action-eye"></i>
                                            </a>
                                            <a class="me-2 p-2 mb-0" data-bs-toggle="modal" data-bs-target="#edit-units">
                                                <i data-feather="edit" class="feather-edit"></i>
                                            </a>
                                            <a class="me-2 confirm-text p-2 mb-0" href="javascript:void(0);">
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
                                    <td>Mueang Phuket</td>
                                    <td>Phiket island</td>
                                    <td><span class="badge badge-linedanger">Inactive</span></td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2 mb-0" href="javascript:void(0);">
                                                <i data-feather="eye" class="action-eye"></i>
                                            </a>
                                            <a class="me-2 p-2 mb-0" data-bs-toggle="modal" data-bs-target="#edit-units">
                                                <i data-feather="edit" class="feather-edit"></i>
                                            </a>
                                            <a class="me-2 confirm-text p-2 mb-0" href="javascript:void(0);">
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
                                    <td>Berlin</td>
                                    <td>Germany</td>
                                    <td><span class="badge badge-linedanger">Inactive</span></td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2 mb-0" href="javascript:void(0);">
                                                <i data-feather="eye" class="action-eye"></i>
                                            </a>
                                            <a class="me-2 p-2 mb-0" data-bs-toggle="modal" data-bs-target="#edit-units">
                                                <i data-feather="edit" class="feather-edit"></i>
                                            </a>
                                            <a class="me-2 confirm-text p-2 mb-0" href="javascript:void(0);">
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
                                    <td>Luanda</td>
                                    <td>Angola</td>
                                    <td><span class="badge badge-linesuccess">Active</span></td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2 mb-0" href="javascript:void(0);">
                                                <i data-feather="eye" class="action-eye"></i>
                                            </a>
                                            <a class="me-2 p-2 mb-0" data-bs-toggle="modal" data-bs-target="#edit-units">
                                                <i data-feather="edit" class="feather-edit"></i>
                                            </a>
                                            <a class="me-2 confirm-text p-2 mb-0" href="javascript:void(0);">
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
                                    <td>Albania</td>
                                    <td>Albania</td>
                                    <td><span class="badge badge-linesuccess">Active</span></td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2 mb-0" href="javascript:void(0);">
                                                <i data-feather="eye" class="action-eye"></i>
                                            </a>
                                            <a class="me-2 p-2 mb-0" data-bs-toggle="modal" data-bs-target="#edit-units">
                                                <i data-feather="edit" class="feather-edit"></i>
                                            </a>
                                            <a class="me-2 confirm-text p-2 mb-0" href="javascript:void(0);">
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
                                    <td>Ankara</td>
                                    <td>Turkey</td>
                                    <td><span class="badge badge-linesuccess">Active</span></td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2 mb-0" href="javascript:void(0);">
                                                <i data-feather="eye" class="action-eye"></i>
                                            </a>
                                            <a class="me-2 p-2 mb-0" data-bs-toggle="modal" data-bs-target="#edit-units">
                                                <i data-feather="edit" class="feather-edit"></i>
                                            </a>
                                            <a class="me-2 confirm-text p-2 mb-0" href="javascript:void(0);">
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
                                    <td>Polanco</td>
                                    <td>Mexico</td>
                                    <td><span class="badge badge-linesuccess">Active</span></td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2 mb-0" href="javascript:void(0);">
                                                <i data-feather="eye" class="action-eye"></i>
                                            </a>
                                            <a class="me-2 p-2 mb-0" data-bs-toggle="modal" data-bs-target="#edit-units">
                                                <i data-feather="edit" class="feather-edit"></i>
                                            </a>
                                            <a class="me-2 confirm-text p-2 mb-0" href="javascript:void(0);">
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
                                    <td>Greece</td>
                                    <td>Athens</td>
                                    <td><span class="badge badge-linedanger">Inactive</span></td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2 mb-0" href="javascript:void(0);">
                                                <i data-feather="eye" class="action-eye"></i>
                                            </a>
                                            <a class="me-2 p-2 mb-0" data-bs-toggle="modal" data-bs-target="#edit-units">
                                                <i data-feather="edit" class="feather-edit"></i>
                                            </a>
                                            <a class="me-2 confirm-text p-2 mb-0" href="javascript:void(0);">
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
                                    <td>Newyork</td>
                                    <td>USA</td>
                                    <td><span class="badge badge-linedanger">Inactive</span></td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2 mb-0" href="javascript:void(0);">
                                                <i data-feather="eye" class="action-eye"></i>
                                            </a>
                                            <a class="me-2 p-2 mb-0" data-bs-toggle="modal" data-bs-target="#edit-units">
                                                <i data-feather="edit" class="feather-edit"></i>
                                            </a>
                                            <a class="me-2 confirm-text p-2 mb-0" href="javascript:void(0);">
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
