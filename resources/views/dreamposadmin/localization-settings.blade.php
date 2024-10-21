<?php $page = 'localization-settings'; ?>
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
                            <form action="{{ url('localization-settings') }}">
                                <div class="setting-title">
                                    <h4>Localization</h4>
                                </div>
                                <div class="company-info company-images">
                                    <div class="card-title-head">
                                        <h6><span><i data-feather="list"></i></span>Basic Information</h6>
                                    </div>
                                    <div class="localization-info">
                                        <div class="row align-items-center">
                                            <div class="col-sm-4">
                                                <div class="setting-info">
                                                    <h6>Language</h6>
                                                    <p>Select Language of the Website</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="localization-select">
                                                    <select class="select">
                                                        <option>English</option>
                                                        <option>Spanish</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-sm-4">
                                                <div class="setting-info">
                                                    <h6>Language Switcher</h6>
                                                    <p>To display in all the pages</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="localization-select">
                                                    <div
                                                        class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                                        <input type="checkbox" id="user3" class="check" checked>
                                                        <label for="user3" class="checktoggle"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-sm-4">
                                                <div class="setting-info">
                                                    <h6>Timezone</h6>
                                                    <p>Select Time zone in website</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="localization-select">
                                                    <select class="select">
                                                        <option>UTC 5:30</option>
                                                        <option>(UTC+11:00) INR</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-sm-4">
                                                <div class="setting-info">
                                                    <h6>Date format</h6>
                                                    <p>Select date format to display in website</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="localization-select">
                                                    <select class="select">
                                                        <option>22 Jul 2023</option>
                                                        <option>Jul 22 2023</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-sm-4">
                                                <div class="setting-info">
                                                    <h6>Time Format</h6>
                                                    <p>Select time format to display in website</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="localization-select">
                                                    <select class="select">
                                                        <option>12 Hours</option>
                                                        <option>24 Hours</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-sm-4">
                                                <div class="setting-info">
                                                    <h6>Financial Year</h6>
                                                    <p>Select year for finance </p>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="localization-select">
                                                    <select class="select">
                                                        <option>2023</option>
                                                        <option>2022</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-sm-4">
                                                <div class="setting-info">
                                                    <h6>Starting Month</h6>
                                                    <p>Select starting month to display </p>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="localization-select">
                                                    <select class="select">
                                                        <option>January</option>
                                                        <option>February</option>
                                                        <option>March</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="company-info company-images">
                                    <div class="card-title-head">
                                        <h6><span><i data-feather="credit-card"></i></span>Currency Settings</h6>
                                    </div>
                                    <div class="localization-info">
                                        <div class="row align-items-center">
                                            <div class="col-sm-4">
                                                <div class="setting-info">
                                                    <h6>Currency</h6>
                                                    <p>Select currency </p>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="localization-select">
                                                    <select class="select">
                                                        <option>United Stated of America</option>
                                                        <option>India</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-sm-4">
                                                <div class="setting-info">
                                                    <h6>Currency Symbol</h6>
                                                    <p>Select currency symbol</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="localization-select">
                                                    <select class="select">
                                                        <option>$</option>
                                                        <option>€</option>
                                                        <option>¥</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-sm-4">
                                                <div class="setting-info">
                                                    <h6>Currency Position</h6>
                                                    <p>Select currency position</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="localization-select">
                                                    <select class="select">
                                                        <option>$100</option>
                                                        <option>$400</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-sm-4">
                                                <div class="setting-info">
                                                    <h6>Decimal Separator</h6>
                                                    <p>Select decimal</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="localization-select">
                                                    <select class="select">
                                                        <option>.</option>
                                                        <option>.</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-sm-4">
                                                <div class="setting-info">
                                                    <h6>Thousand Separator</h6>
                                                    <p>Select thousand</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="localization-select">
                                                    <select class="select">
                                                        <option>,</option>
                                                        <option>,</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="company-info company-images">
                                    <div class="card-title-head">
                                        <h6><span><i data-feather="map"></i></span>Country Settings</h6>
                                    </div>
                                    <div class="localization-info">
                                        <div class="row align-items-center">
                                            <div class="col-sm-4">
                                                <div class="setting-info">
                                                    <h6>Countries Restriction</h6>
                                                    <p>Select country </p>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="localization-select">
                                                    <select class="select">
                                                        <option>Allow All Countries</option>
                                                        <option>Deny All Countries</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="company-images">
                                    <div class="card-title-head">
                                        <h6><span><i data-feather="map"></i></span>File Settings</h6>
                                    </div>
                                    <div class="localization-info">
                                        <div class="row align-items-center">
                                            <div class="col-sm-4">
                                                <div class="setting-info">
                                                    <h6>Allowed Files</h6>
                                                    <p>Select files </p>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-8 col-sm-4">
                                                <div class="localization-select w-100">
                                                    <div class="input-blocks">
                                                        <input class="input-tags form-control" type="text"
                                                            data-role="tagsinput" name="specialist" value="JPG,GIF,PNG">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-sm-4">
                                                <div class="setting-info mb-sm-0">
                                                    <h6>Max File Size</h6>
                                                    <p>File size </p>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="localization-select d-flex align-items-center mb-0">
                                                    <input type="text" class="form-control" value="5000">
                                                    <span class="ms-2"> MB</span>
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
