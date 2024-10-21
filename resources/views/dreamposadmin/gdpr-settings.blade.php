<?php $page = 'gdpr-settings'; ?>
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
                        <div class="settings-page-wrap">
                            <form action="{{ url('gdpr-settings') }}">
                                <div class="setting-title">
                                    <h4>GDPR Cookies</h4>
                                </div>
                                <div class="company-info border-0">
                                    <div class="localization-info">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="setting-info">
                                                    <h6>Cookies Consent Text</h6>
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="mb-3">
                                                    <textarea rows="4" class="form-control" placeholder="Type your message"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-sm-4">
                                                <div class="setting-info">
                                                    <h6>Cookies Position</h6>
                                                    <p>Your can configure the type</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="localization-select">
                                                    <select class="select">
                                                        <option>Left</option>
                                                        <option>Center</option>
                                                        <option>Right</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-sm-4">
                                                <div class="setting-info">
                                                    <h6>Agree Button Text</h6>
                                                    <p>Your can configure the text here</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="localization-select d-flex align-items-center">
                                                    <div class="mb-3">
                                                        <input type="text" class="form-control" value="Agree">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-sm-4">
                                                <div class="setting-info">
                                                    <h6>Decline Button Text</h6>
                                                    <p>Your can configure the text here</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="localization-select d-flex align-items-center">
                                                    <div class="mb-3">
                                                        <input type="text" class="form-control" value="Decline">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-sm-4">
                                                <div class="setting-info">
                                                    <h6>Show Decline Button</h6>
                                                    <p>Your can configure the text here</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="localization-select d-flex align-items-center">
                                                    <div
                                                        class="status-toggle modal-status d-flex justify-content-between align-items-center me-3">
                                                        <input type="checkbox" id="user4" class="check" checked>
                                                        <label for="user4" class="checktoggle"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-sm-4">
                                                <div class="setting-info">
                                                    <h6>Link for Cookies Page</h6>
                                                    <p>Your can configure the link here</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="localization-select d-flex align-items-center w-100">
                                                    <div class="mb-3 w-100">
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer-btn">
                                    <button type="button" class="btn btn-cancel me-2"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-submit">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
