@extends('backend.layouts.default-dark')
@section('content')

@push('specific-css')

@endpush

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container">
				<div class="row page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item {{ Request::is('admin/settings*') ? 'active' : '' }}"><a href="{{ route('admin.settings') }}">Settings</a></li>
					</ol>
                </div>
                <div class="row">


                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Settings</h4>
                            </div>
                            <div class="card-body">
                                <!-- Nav tabs -->


                                @livewire('backend.admin-settings')



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->




@endsection


