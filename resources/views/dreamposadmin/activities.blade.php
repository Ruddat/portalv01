<?php $page = 'activities'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>All Notifications</h4>
                    <h6>View your all activities</h6>
                </div>
            </div>
            <!-- /product list -->
            <div class="activity">
                <div class="activity-box">
                    <ul class="activity-list">
                        <li>
                            <div class="activity-user">
                                <a href="{{ url('profile') }}" title="" data-toggle="tooltip"
                                    data-original-title="Lesley Grauer">
                                    <img alt="Lesley Grauer" src="{{ URL::asset('/build/img/customer/profile3.jpg') }}"
                                        class=" img-fluid">
                                </a>
                            </div>
                            <div class="activity-content">
                                <div class="timeline-content">
                                    <a href="{{ url('profile') }}" class="name">Elwis Mathew </a> added a new product <a
                                        href="javascript:void(0);">Redmi Pro 7 Mobile</a>
                                    <span class="time">4 mins ago</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="activity-user">
                                <a href="{{ url('profile') }}" title="" data-toggle="tooltip"
                                    data-original-title="Lesley Grauer">
                                    <img alt="Lesley Grauer" src="{{ URL::asset('/build/img/customer/profile4.jpg') }}"
                                        class=" img-fluid">
                                </a>
                            </div>
                            <div class="activity-content">
                                <div class="timeline-content">
                                    <a href="{{ url('profile') }}" class="name">Elizabeth Olsen</a> added a new product
                                    category <a href="javascript:void(0);">Desktop Computers</a>
                                    <span class="time">6 mins ago</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="activity-user">
                                <a href="{{ url('profile') }}" title="" data-toggle="tooltip"
                                    data-original-title="Lesley Grauer">
                                    <img alt="Lesley Grauer" src="{{ URL::asset('/build/img/customer/profile5.jpg') }}"
                                        class=" img-fluid">
                                </a>
                            </div>
                            <div class="activity-content">
                                <div class="timeline-content">
                                    <div class="timeline-content">
                                        <a href="{{ url('profile') }}" class="name">William Smith</a> added a new sales
                                        list for<a href="javascript:void(0);">January Month</a>
                                        <span class="time">12 mins ago</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="activity-user">
                                <a href="{{ url('profile') }}" title="" data-toggle="tooltip"
                                    data-original-title="Lesley Grauer">
                                    <img alt="Lesley Grauer" src="{{ URL::asset('/build/img/customer/customer4.jpg') }}"
                                        class=" img-fluid">
                                </a>
                            </div>
                            <div class="activity-content">
                                <div class="timeline-content">
                                    <a href="{{ url('profile') }}" class="name">Lesley Grauer</a> has updated invoice <a
                                        href="javascript:void(0);">#987654</a>
                                    <span class="time">4 mins ago</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="activity-user">
                                <a href="{{ url('profile') }}" title="" data-toggle="tooltip"
                                    data-original-title="Lesley Grauer">
                                    <img alt="Lesley Grauer" src="{{ URL::asset('/build/img/customer/profile3.jpg') }}"
                                        class=" img-fluid">
                                </a>
                            </div>
                            <div class="activity-content">
                                <div class="timeline-content">
                                    <a href="{{ url('profile') }}" class="name">Elwis Mathew </a> added a new product <a
                                        href="javascript:void(0);">Redmi Pro 7 Mobile</a>
                                    <span class="time">4 mins ago</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="activity-user">
                                <a href="{{ url('profile') }}" title="" data-toggle="tooltip"
                                    data-original-title="Lesley Grauer">
                                    <img alt="Lesley Grauer" src="{{ URL::asset('/build/img/customer/profile4.jpg') }}"
                                        class=" img-fluid">
                                </a>
                            </div>
                            <div class="activity-content">
                                <div class="timeline-content">
                                    <a href="{{ url('profile') }}" class="name">Elizabeth Olsen</a> added a new product
                                    category <a href="javascript:void(0);">Desktop Computers</a>
                                    <span class="time">6 mins ago</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="activity-user">
                                <a href="{{ url('profile') }}" title="" data-toggle="tooltip"
                                    data-original-title="Lesley Grauer">
                                    <img alt="Lesley Grauer" src="{{ URL::asset('/build/img/customer/profile5.jpg') }}"
                                        class=" img-fluid">
                                </a>
                            </div>
                            <div class="activity-content">
                                <div class="timeline-content">
                                    <div class="timeline-content">
                                        <a href="{{ url('profile') }}" class="name">William Smith</a> added a new sales
                                        list for<a href="javascript:void(0);">January Month</a>
                                        <span class="time">12 mins ago</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /product list -->
        </div>
    </div>
@endsection
