@extends('backend.layouts.default-dark')
@section('pageTitle', 'Design Templates')
@section('content')

    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <div class="container">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Design Templates</a></li>
                </ol>
            </div>
            <!-- row -->
            <livewire:backend.admin.design-templates.template-manger-component />



        </div>
    </div>
    <!--**********************************
        Content body end
    ***********************************-->

    @push('specific-css')
    @endpush

    @push('specific-scripts')
    @endpush

@endsection
