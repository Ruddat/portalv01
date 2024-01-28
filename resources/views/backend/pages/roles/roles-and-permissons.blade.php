@extends('backend.layouts.default-dark')
@section('content')

@push('specific-css')
    <!-- Datatable -->
    <link href="{{ asset('backend/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
@endpush





		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
			<div class="container">

                <div class="row page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Table</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0)">Datatable</a></li>
					</ol>
                </div>
                <!-- row -->


                <div class="row">





                    <!-- Livewire-Komponente einfügen -->
                    @livewire('backend.roles.role-permission-manager')



                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->




@endsection


