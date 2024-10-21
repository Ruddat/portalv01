<?php $page = 'blank-page'; ?>
@extends('layout.mainlayout')
@section('content')
<div class="page-wrapper pagehead">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Blank Page</h4>
                <h6>Sub Title</h6>
            </div>
            <ul class="table-top-head">
                <li>
                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i data-feather="rotate-ccw" class="feather-rotate-ccw"></i></a>
                </li>
                <li>
                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i data-feather="chevron-up" class="feather-chevron-up"></i></a>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection