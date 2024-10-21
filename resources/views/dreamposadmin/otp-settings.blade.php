<?php $page = 'otp-settings'; ?>
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
                            <form action="{{ url('otp-settings') }}">
                                <div class="setting-title">
                                    <h4>OTP Settings</h4>
                                </div>
                                <div class="company-info company-images">
                                    <div class="localization-info">
                                        <div class="row align-items-center">
                                            <div class="col-sm-4">
                                                <div class="setting-info">
                                                    <h6>OTP Type</h6>
                                                    <p>Your can configure the type</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="localization-select">
                                                    <select class="select">
                                                        <option>SMS</option>
                                                        <option>Email</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-sm-4">
                                                <div class="setting-info">
                                                    <h6>OTP Digit Limit</h6>
                                                    <p>Select size of the format </p>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="localization-select">
                                                    <select class="select">
                                                        <option>4</option>
                                                        <option>5</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-sm-4">
                                                <div class="setting-info">
                                                    <h6>OTP Expire Time</h6>
                                                    <p>Select expire time of OTP </p>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="localization-select">
                                                    <select class="select">
                                                        <option>5 Mins</option>
                                                        <option>10 Mins</option>
                                                    </select>
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
