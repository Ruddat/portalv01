<?php $page = 'bank-settings-grid'; ?>
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
                                <h4>Bank Account</h4>
                            </div>
                            <div class="page-header bank-settings justify-content-end">
                                <a href="{{ url('bank-settings-list') }}" class="btn-list me-2"><i data-feather="list"
                                        class="feather-user"></i></a>
                                <a href="{{ url('bank-settings-grid') }}" class="btn-grid active"><i data-feather="grid"
                                        class="feather-user"></i></a>
                                <div class="page-btn">
                                    <a href="#" class="btn btn-added" data-bs-toggle="modal"
                                        data-bs-target="#add-account"><i data-feather="plus-circle" class="me-2"></i>Add
                                        New Account</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xxl-4 col-xl-6 col-lg-12 col-sm-6">
                                    <div class="bank-box active">
                                        <div class="bank-header">
                                            <div class="bank-name">
                                                <h6>Karur vysya bank</h6>
                                                <p>**** **** 1982</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="bank-info">
                                                <span>Holder Name</span>
                                                <h6>John Smith</h6>
                                            </div>
                                            <div class="edit-delete-action bank-action-btn">
                                                <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#edit-account">
                                                    <i data-feather="edit" class="feather-edit"></i>
                                                </a>
                                                <a class="confirm-text p-2" href="javascript:void(0);">
                                                    <i data-feather="trash-2" class="feather-trash-2"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-xl-6 col-lg-12 col-sm-6">
                                    <div class="bank-box">
                                        <div class="bank-header">
                                            <div class="bank-name">
                                                <h6>Swiss Bank</h6>
                                                <p>**** **** 1796</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="bank-info">
                                                <span>Holder Name</span>
                                                <h6>Andrew</h6>
                                            </div>
                                            <div class="edit-delete-action bank-action-btn">
                                                <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#edit-account">
                                                    <i data-feather="edit" class="feather-edit"></i>
                                                </a>
                                                <a class="confirm-text p-2" href="javascript:void(0);">
                                                    <i data-feather="trash-2" class="feather-trash-2"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-xl-6 col-lg-12 col-sm-6">
                                    <div class="bank-box">
                                        <div class="bank-header">
                                            <div class="bank-name">
                                                <h6>HDFC</h6>
                                                <p>**** **** 1832</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="bank-info">
                                                <span>Holder Name</span>
                                                <h6>Mathew</h6>
                                            </div>
                                            <div class="edit-delete-action bank-action-btn">
                                                <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#edit-account">
                                                    <i data-feather="edit" class="feather-edit"></i>
                                                </a>
                                                <a class="confirm-text p-2" href="javascript:void(0);">
                                                    <i data-feather="trash-2" class="feather-trash-2"></i>
                                                </a>
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
