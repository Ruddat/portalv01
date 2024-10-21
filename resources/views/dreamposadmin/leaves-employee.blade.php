<?php $page = 'leaves-employee'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            @component('components.breadcrumb')
                @slot('title')
                    Leaves
                @endslot
                @slot('li_1')
                    Manage your Leaves
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
                                <div class="layout-hide-box">
                                    <a href="javascript:void(0);" class="me-3 layout-box"><i data-feather="layout"
                                            class="feather-search"></i></a>
                                    <div class="layout-drop-item card">
                                        <div class="drop-item-head">
                                            <h5>Want to manage datatable?</h5>
                                            <p>Please drag and drop your column to reorder your table and enable see option
                                                as you want.</p>
                                        </div>
                                        <ul>
                                            <li>
                                                <div
                                                    class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                                    <span class="status-label"><i data-feather="menu"
                                                            class="feather-menu"></i>Shop</span>
                                                    <input type="checkbox" id="option1" class="check" checked>
                                                    <label for="option1" class="checktoggle"></label>
                                                </div>
                                            </li>
                                            <li>
                                                <div
                                                    class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                                    <span class="status-label"><i data-feather="menu"
                                                            class="feather-menu"></i>Product</span>
                                                    <input type="checkbox" id="option2" class="check" checked>
                                                    <label for="option2" class="checktoggle"> </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div
                                                    class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                                    <span class="status-label"><i data-feather="menu"
                                                            class="feather-menu"></i>Reference No</span>
                                                    <input type="checkbox" id="option3" class="check" checked>
                                                    <label for="option3" class="checktoggle"> </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div
                                                    class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                                    <span class="status-label"><i data-feather="menu"
                                                            class="feather-menu"></i>Date</span>
                                                    <input type="checkbox" id="option4" class="check" checked>
                                                    <label for="option4" class="checktoggle"> </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div
                                                    class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                                    <span class="status-label"><i data-feather="menu"
                                                            class="feather-menu"></i>Responsible Person</span>
                                                    <input type="checkbox" id="option5" class="check" checked>
                                                    <label for="option5" class="checktoggle"> </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div
                                                    class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                                    <span class="status-label"><i data-feather="menu"
                                                            class="feather-menu"></i>Notes</span>
                                                    <input type="checkbox" id="option6" class="check" checked>
                                                    <label for="option6" class="checktoggle"> </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div
                                                    class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                                    <span class="status-label"><i data-feather="menu"
                                                            class="feather-menu"></i>Quantity</span>
                                                    <input type="checkbox" id="option7" class="check" checked>
                                                    <label for="option7" class="checktoggle"> </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div
                                                    class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                                    <span class="status-label"><i data-feather="menu"
                                                            class="feather-menu"></i>Actions</span>
                                                    <input type="checkbox" id="option8" class="check" checked>
                                                    <label for="option8" class="checktoggle"> </label>
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
                                        <i data-feather="box" class="info-img"></i>
                                        <select class="select">
                                            <option>Choose Type</option>
                                            <option>Sick Leave</option>
                                            <option>Paternity</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="input-blocks">
                                        <i data-feather="user" class="info-img"></i>
                                        <select class="select">
                                            <option>Choose Employee</option>
                                            <option>Mitchum Daniel</option>
                                            <option>Susan Lopez</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="input-blocks">
                                        <i data-feather="stop-circle" class="info-img"></i>
                                        <select class="select">
                                            <option>Choose Status</option>
                                            <option>Approved</option>
                                            <option>Rejected</option>
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
                                    <th>Emp Id</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                    <th>Duration</th>
                                    <th>Applied On</th>
                                    <th>Reason</th>
                                    <th>Approval</th>
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
                                    <td>POS001 </td>
                                    <td>Sick Leave</td>
                                    <td>
                                        02 Aug 2023
                                    </td>
                                    <td>01 Day</td>
                                    <td>
                                        04 Aug 2023
                                    </td>
                                    <td></td>
                                    <td><span class="badge-applied">Applied</span></td>
                                    <td class="action-table-data justify-content-end">
                                        <div class="edit-delete-action">
                                            <a href="" class="me-2 cancel-circle"><i data-feather="x-circle"
                                                    class="feather-x-circle"></i></a>
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
                                    <td>POS002 </td>
                                    <td>Paternity</td>
                                    <td>
                                        07 Aug 2023
                                    </td>
                                    <td>2 hrs</td>
                                    <td>
                                        07 Aug 2023
                                    </td>
                                    <td></td>
                                    <td><span class="badge-approved">Approved</span></td>
                                    <td class="action-table-data justify-content-end">
                                        <div class="edit-delete-action">
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
                                    <td>POS003 </td>
                                    <td>Sick Leave</td>
                                    <td>
                                        03 Aug 2023
                                    </td>
                                    <td>01 Day</td>
                                    <td>
                                        03 Aug 2023
                                    </td>
                                    <td><a href="" class="reason-for-reject" data-bs-toggle="modal"
                                            data-bs-target="#rejected-reason">Reason</a></td>
                                    <td><span class="badge-reject">Rejected</span></td>
                                    <td class="action-table-data justify-content-end">
                                        <div class="edit-delete-action">
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
                                    <td>POS004 </td>
                                    <td>Sick Leave</td>
                                    <td>
                                        05 Aug 2023
                                    </td>
                                    <td>01 Day</td>
                                    <td>
                                        05 Aug 2023
                                    </td>
                                    <td><a href="" class="reason-for-reject" data-bs-toggle="modal"
                                            data-bs-target="#rejected-reason">Reason</a></td>
                                    <td><span class="badge-reject">Rejected</span></td>
                                    <td class="action-table-data justify-content-end">
                                        <div class="edit-delete-action">
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
                                    <td>POS005 </td>
                                    <td>Sick Leave</td>
                                    <td>
                                        08 Aug 2023
                                    </td>
                                    <td>02 Days</td>
                                    <td>
                                        08 Aug 2023
                                    </td>
                                    <td></td>
                                    <td><span class="badge-applied">Applied</span></td>
                                    <td class="action-table-data justify-content-end">
                                        <div class="edit-delete-action">
                                            <a href="" class="me-2 cancel-circle"><i data-feather="x-circle"
                                                    class="feather-x-circle"></i></a>
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
                                    <td>POS006</td>
                                    <td>Sick Leave</td>
                                    <td>
                                        03 Aug 2023
                                    </td>
                                    <td>2 hrs</td>
                                    <td>
                                        03 Aug 2023
                                    </td>
                                    <td></td>
                                    <td><span class="badge-approved">Approved</span></td>
                                    <td class="action-table-data justify-content-end">
                                        <div class="edit-delete-action">
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
