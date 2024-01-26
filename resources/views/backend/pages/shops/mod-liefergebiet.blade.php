@extends('backend.layouts.default-dark')
@section('content')

@push('specific-css')


<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>


<style>
    html, body {
        height: 100%;
        margin: 0;
    }
    .leaflet-container {
        height: 400px;
        width: 600px;
        max-width: 100%;
        max-height: 100%;
    }
</style>



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

                    <div>

                        <livewire:backend.mod-delivery-area />

                    </div>



                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->



@endsection


