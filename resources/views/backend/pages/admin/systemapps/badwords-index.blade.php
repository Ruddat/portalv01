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


                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Badwords Table</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table header-border table-hover verticle-middle">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Badwort</th>
                                                <th scope="col">Count</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>1</th>
                                                <td>Hitler</td>
                                                <td>
                                                    <span class="badge badge-primary light">10 x erfasst</span>
                                                </td>
                                                <td>
													<div class="d-flex">
														<a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a>
														<a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
													</div>
												</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
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


