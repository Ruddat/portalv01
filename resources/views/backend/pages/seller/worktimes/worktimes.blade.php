@extends('backend.layouts.default-dark')
@section('pageTitle', isset($pageTitle) ? app(\App\Services\TranslationService::class)->trans($pageTitle, app()->getLocale()) : app(\App\Services\TranslationService::class)->trans('Page title here....', app()->getLocale()))
@section('content')







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
                                <h4 class="card-title">Custom Openinghours</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table header-border table-hover verticle-middle">
                                        <thead>
                                            <tr>
                                                <th scope="col">Day of Week</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Restaurant open Times</th>
                                            </tr>
                                        </thead>
                                        <tbody>



                                            <tr>
                                                <th>Holiday</th>
                                                <td>

                                                </td>
                                                <td>
                                                    <label class="col-sm-2 col-form-label">Date</label>
                                                    <label class="col-sm-2 col-form-label">Closed/Open</label>
                                                    <label class="col-sm-2 col-form-label">From</label>
                                                    <label class="col-sm-2 col-form-label">To</label>
                                                    <label class="col-sm-2 col-form-label"></label>
                                                    <div class="row">
                                                        <div class="mb-3 col-md-2">
                                                            <input type="date" class="form-control" placeholder="1234 Main St" spellcheck="false" data-ms-editor="true">
                                                        </div>
                                                        <div class="form-check form-switch mb-3 col-md-2">
                                                            <input class="form-check-input center" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                                        </div>

                                                        <div class="mb-3 col-md-2">
                                                            <input type="time" class="form-control" placeholder="Email">
                                                        </div>
                                                        <div class="mb-3 col-md-2">
                                                            <input type="time" class="form-control" placeholder="Email">
                                                        </div>
                                                        <div class="mb-3 col-md-4">
                                                            <button type="submit" class="btn btn-success">Add</button>
                                                        </div>

                                                        <div class="mb-3 col-md-2">
                                                            <input type="date" class="form-control" placeholder="1234 Main St" spellcheck="false" data-ms-editor="true">
                                                        </div>
                                                        <div class="form-check form-switch mb-3 col-md-2">
                                                            <input class="form-check-input center" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                                        </div>

                                                        <div class="mb-3 col-md-2">
                                                            <input type="time" class="form-control" placeholder="Email">
                                                        </div>
                                                        <div class="mb-3 col-md-2">
                                                            <input type="time" class="form-control" placeholder="Email">
                                                        </div>
                                                        <div class="mb-3 col-md-2">
                                                            <button type="submit" class="btn btn-secondary">Remove</button>
                                                        </div>




                                                    </div>
                                                </td>
                                            </tr>








                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>





                    <livewire:backend.seller.worktimes-and-hollidays.worktimes-table-component />






                </div>
            </div>
        </div>








    @push('specific-css')
    @endpush

    @push('specific-scripts')
    @endpush

@endsection


