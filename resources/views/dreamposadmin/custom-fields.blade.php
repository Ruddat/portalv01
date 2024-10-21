<?php $page = 'custom-fields'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content settings-content">
            <div class="page-header settings-pg-header">
                <div class="add-item d-flex">
                    <div class="page-title">
                        <h4>Settings</h4>
                        <h6>Manage your settings on portal</h6>
                    </div>
                </div>
                <ul class="table-top-head">
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
            <div class="row">
                <div class="col-xl-12">
                    <div class="settings-wrapper d-flex">
                        @component('components.settings-sidebar')
                        @endcomponent
                        <div class="settings-page-wrap w-50">
                            <div class="setting-title">
                                <h4>Custom Fields</h4>
                            </div>
                            <div class="page-header justify-content-end">
                                <ul class="table-top-head">
                                    <li>
                                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"><img
                                                src="{{ URL::asset('/build/img/icons/pdf.svg') }}" alt="img"></a>
                                    </li>
                                    <li>
                                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Excel"><img
                                                src="{{ URL::asset('/build/img/icons/excel.svg') }}" alt="img"></a>
                                    </li>
                                    <li>
                                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Print"><i
                                                data-feather="printer" class="feather-rotate-ccw"></i></a>
                                    </li>
                                </ul>
                                <div class="page-btn">
                                    <a href="#" class="btn btn-added" data-bs-toggle="modal"
                                        data-bs-target="#add-custom-field"><i data-feather="plus-circle"
                                            class="me-2"></i>Add New Field</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
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
                                                            <span><img
                                                                    src="{{ URL::asset('/build/img/icons/closes.svg') }}"
                                                                    alt="img"></span>
                                                        </a>
                                                        <div class="layout-hide-box">
                                                            <a href="javascript:void(0);" class="me-3 layout-box"><i
                                                                    data-feather="layout" class="feather-search"></i></a>
                                                            <div class="layout-drop-item card">
                                                                <div class="drop-item-head">
                                                                    <h5>Want to manage datatable?</h5>
                                                                    <p>Please drag and drop your column to reorder your
                                                                        table and enable see option as you want.</p>
                                                                </div>
                                                                <ul>
                                                                    <li>
                                                                        <div
                                                                            class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                                                            <span class="status-label"><i
                                                                                    data-feather="menu"
                                                                                    class="feather-menu"></i>Shop</span>
                                                                            <input type="checkbox" id="option1"
                                                                                class="check" checked>
                                                                            <label for="option1" class="checktoggle">
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div
                                                                            class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                                                            <span class="status-label"><i
                                                                                    data-feather="menu"
                                                                                    class="feather-menu"></i>Product</span>
                                                                            <input type="checkbox" id="option2"
                                                                                class="check" checked>
                                                                            <label for="option2" class="checktoggle">
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div
                                                                            class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                                                            <span class="status-label"><i
                                                                                    data-feather="menu"
                                                                                    class="feather-menu"></i>Reference
                                                                                No</span>
                                                                            <input type="checkbox" id="option3"
                                                                                class="check" checked>
                                                                            <label for="option3" class="checktoggle">
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div
                                                                            class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                                                            <span class="status-label"><i
                                                                                    data-feather="menu"
                                                                                    class="feather-menu"></i>Date</span>
                                                                            <input type="checkbox" id="option4"
                                                                                class="check" checked>
                                                                            <label for="option4" class="checktoggle">
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div
                                                                            class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                                                            <span class="status-label"><i
                                                                                    data-feather="menu"
                                                                                    class="feather-menu"></i>Responsible
                                                                                Person</span>
                                                                            <input type="checkbox" id="option5"
                                                                                class="check" checked>
                                                                            <label for="option5" class="checktoggle">
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div
                                                                            class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                                                            <span class="status-label"><i
                                                                                    data-feather="menu"
                                                                                    class="feather-menu"></i>Notes</span>
                                                                            <input type="checkbox" id="option6"
                                                                                class="check" checked>
                                                                            <label for="option6" class="checktoggle">
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div
                                                                            class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                                                            <span class="status-label"><i
                                                                                    data-feather="menu"
                                                                                    class="feather-menu"></i>Quantity</span>
                                                                            <input type="checkbox" id="option7"
                                                                                class="check" checked>
                                                                            <label for="option7" class="checktoggle">
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div
                                                                            class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                                                            <span class="status-label"><i
                                                                                    data-feather="menu"
                                                                                    class="feather-menu"></i>Actions</span>
                                                                            <input type="checkbox" id="option8"
                                                                                class="check" checked>
                                                                            <label for="option8" class="checktoggle">
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
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
                                                                <i data-feather="zap" class="info-img"></i>
                                                                <select class="select">
                                                                    <option>Choose Module</option>
                                                                    <option>Expense</option>
                                                                    <option>Transaction</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-sm-6 col-12">
                                                            <div class="input-blocks">
                                                                <i data-feather="edit-2" class="info-img"></i>
                                                                <select class="select">
                                                                    <option>Choose Fields</option>
                                                                    <option>Expense</option>
                                                                    <option>Transaction</option>
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
                                                        <div class="col-lg-3 col-sm-6 col-12 ms-auto">
                                                            <div class="input-blocks">
                                                                <a class="btn btn-filters ms-auto"> <i
                                                                        data-feather="search" class="feather-search"></i>
                                                                    Search </a>
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
                                                            <th>Module</th>
                                                            <th>Label</th>
                                                            <th>Type</th>
                                                            <th>Default Value</th>
                                                            <th>Required</th>
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
                                                            <td>
                                                                Expense
                                                            </td>
                                                            <td>
                                                                Name
                                                            </td>
                                                            <td>
                                                                Text
                                                            </td>
                                                            <td>Name</td>
                                                            <td>Required</td>
                                                            <td><span class="badge badge-linesuccess">Active</span></td>
                                                            <td class="action-table-data">
                                                                <div class="edit-delete-action">
                                                                    <a class="me-2 p-2" href="#"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#edit-custom-field">
                                                                        <i data-feather="edit" class="feather-edit"></i>
                                                                    </a>
                                                                    <a class="confirm-text p-2"
                                                                        href="javascript:void(0);">
                                                                        <i data-feather="trash-2"
                                                                            class="feather-trash-2"></i>
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
                                                                Transaction
                                                            </td>
                                                            <td>
                                                                Comment
                                                            </td>
                                                            <td>
                                                                Textarea
                                                            </td>
                                                            <td>Enter Comments</td>
                                                            <td>Required</td>
                                                            <td><span class="badge badge-linesuccess">Active</span></td>
                                                            <td class="action-table-data">
                                                                <div class="edit-delete-action">
                                                                    <a class="me-2 p-2" href="#"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#edit-custom-field">
                                                                        <i data-feather="edit" class="feather-edit"></i>
                                                                    </a>
                                                                    <a class="confirm-text p-2"
                                                                        href="javascript:void(0);">
                                                                        <i data-feather="trash-2"
                                                                            class="feather-trash-2"></i>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
