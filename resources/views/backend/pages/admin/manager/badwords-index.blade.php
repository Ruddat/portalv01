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
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Table</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0)">Bootstrap</a></li>
					</ol>
                </div>
                <!-- row -->

                <div class="row">



                    @livewire('backend.admin.manager.badword-manager')




                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->




@endsection


