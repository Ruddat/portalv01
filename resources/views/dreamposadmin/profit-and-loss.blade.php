<?php $page = 'profit-and-loss'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            @component('components.breadcrumb')
                @slot('title')
                    Profit & Loss
                @endslot
                @slot('li_1')
                    Manage your Profit & Loss
                @endslot
            @endcomponent

            <div class="card table-list-card border-0 mb-0">
                <div class="card-body mb-3">
                    <div class="table-top mb-0 profit-table-top">
                        <div class="search-path profit-head ">
                            <div class="input-blocks mb-0">
                                <i data-feather="calendar" class="info-img"></i>
                                <div class="input-groupicon">
                                    <input type="text" class="datetimepicker" placeholder="This Financial Year">
                                </div>
                            </div>
                        </div>
                        <div class="position-relative daterange-wraper input-blocks mb-0">
                            <input type="text" name="datetimes" placeholder="From Month -  To Month "
                                class="form-control">
                            <i data-feather="calendar" class="feather-14 info-img"></i>
                        </div>
                        <div class="date-btn">
                            <a href="javascript:void(0);" class="btn btn-secondary d-flex align-items-center"><i
                                    data-feather="database" class="feather-14 info-img me-2"></i>Display Date</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table profit-table">
                    <thead class="profit-table-bg">
                        <tr>
                            <th class="no-sort">
                            </th>
                            <th>Jan 2023</th>
                            <th>Feb 2023</th>
                            <th>Mar 2023</th>
                            <th>Apr 2023</th>
                            <th>May 2023</th>
                            <th>Jun 2023</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="table-heading">
                            <td>Income</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Sales</td>
                            <td>$4,02,124.00</td>
                            <td>$3,05,178.00</td>
                            <td>$5,61,639.00</td>
                            <td>$2,46,123.00</td>
                            <td>$2,16,836.00</td>
                            <td>$3,40,472.00</td>
                        </tr>
                        <tr>
                            <td>Service</td>
                            <td>$2,12,464.00</td>
                            <td>$1,04,627.00</td>
                            <td>$3,47,273.00</td>
                            <td>$3,51,749.00</td>
                            <td>$2,62,743.00</td>
                            <td>$2,71,837.00</td>
                        </tr>
                        <tr>
                            <td>Purchase Return</td>
                            <td>$3,06,386.00</td>
                            <td>$2,61,738.00</td>
                            <td>$2,82,463.00</td>
                            <td>$2,45,280.00</td>
                            <td>$2,16,383.00</td>
                            <td>$2,73,843.00</td>
                        </tr>
                        <tr class="profit-table-bg">
                            <td>Gross Profit</td>
                            <td>$1,45,547.00</td>
                            <td>$2,62,813.00</td>
                            <td>$2,74,832.00</td>
                            <td>$2,52,725.00</td>
                            <td>$2,57,248.00</td>
                            <td>$2,94,270.00</td>
                        </tr>
                        <tr class="table-heading">
                            <td>Expenses</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Sales</td>
                            <td>$4,02,124.00</td>
                            <td>$3,05,178.00</td>
                            <td>$5,61,639.00</td>
                            <td>$2,46,123.00</td>
                            <td>$2,16,836.00</td>
                            <td>$3,40,472.00</td>
                        </tr>
                        <tr>
                            <td>Purrchase</td>
                            <td>$1,45,547.00</td>
                            <td>$2,62,813.00</td>
                            <td>$2,74,832.00</td>
                            <td>$2,52,725.00</td>
                            <td>$2,57,248.00</td>
                            <td>$2,94,270.00</td>
                        </tr>
                        <tr class="profit-table-bg">
                            <td>Sales Return</td>
                            <td>$4,02,124.00</td>
                            <td>$3,05,178.00</td>
                            <td>$5,61,639.00</td>
                            <td>$2,46,123.00</td>
                            <td>$2,16,836.00</td>
                            <td>$3,40,472.00</td>
                        </tr>
                        <tr class="profit-table-bg">
                            <td>Total Expense</td>
                            <td>$2,58,136.00</td>
                            <td>$1,38,471.00</td>
                            <td>$2,61,682.00</td>
                            <td>$2,16,747.00</td>
                            <td>$2,79,328.00</td>
                            <td>$2,94,840.00</td>
                        </tr>
                        <tr class="profit-table-bg">
                            <td>Net Profit</td>
                            <td>$2,69,276.00</td>
                            <td>$2,75,638.00</td>
                            <td>$2,51,629.00</td>
                            <td>$1,36,836.00</td>
                            <td>$2,05,634.00</td>
                            <td>$1,32,951.00</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
