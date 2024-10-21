<?php $page = 'tax-rates'; ?>
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
                                <h4>Tax Rates</h4>
                            </div>
                            <div class="page-header bank-settings justify-content-end">
                                <div class="page-btn">
                                    <a href="#" class="btn btn-added" data-bs-toggle="modal"
                                        data-bs-target="#add-tax"><i data-feather="plus-circle" class="me-2"></i>Add New
                                        Tax Rate</a>
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
                                            </div>
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
                                                            <th>Name</th>
                                                            <th>Tax rates% </th>
                                                            <th>Created On</th>
                                                            <th class="no-sort text-end">Action</th>
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
                                                                VAT
                                                            </td>
                                                            <td>
                                                                16
                                                            </td>
                                                            <td>
                                                                12 Jul 2023
                                                            </td>
                                                            <td class="action-table-data justify-content-end">
                                                                <div class="edit-delete-action">
                                                                    <a class="me-2 p-2" href="#"
                                                                        data-bs-toggle="modal" data-bs-target="#edit-tax">
                                                                        <i data-feather="edit" class="feather-edit"></i>
                                                                    </a>
                                                                    <a class="confirm-text p-2" href="javascript:void(0);">
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
                                                                TGST
                                                            </td>
                                                            <td>
                                                                14
                                                            </td>
                                                            <td>
                                                                17 Jul 2023
                                                            </td>
                                                            <td class="action-table-data justify-content-end">
                                                                <div class="edit-delete-action">
                                                                    <a class="me-2 p-2" href="#"
                                                                        data-bs-toggle="modal" data-bs-target="#edit-tax">
                                                                        <i data-feather="edit" class="feather-edit"></i>
                                                                    </a>
                                                                    <a class="confirm-text p-2" href="javascript:void(0);">
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
                                                                HST
                                                            </td>
                                                            <td>
                                                                12
                                                            </td>
                                                            <td>
                                                                23 Jul 2023
                                                            </td>
                                                            <td class="action-table-data justify-content-end">
                                                                <div class="edit-delete-action">
                                                                    <a class="me-2 p-2" href="#"
                                                                        data-bs-toggle="modal" data-bs-target="#edit-tax">
                                                                        <i data-feather="edit" class="feather-edit"></i>
                                                                    </a>
                                                                    <a class="confirm-text p-2" href="javascript:void(0);">
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
