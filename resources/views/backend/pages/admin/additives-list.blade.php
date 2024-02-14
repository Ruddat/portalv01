@extends('backend.layouts.default-dark')
@section('pageTitle', isset($pageTitle) ? app(\App\Services\TranslationService::class)->trans($pageTitle, app()->getLocale()) : app(\App\Services\TranslationService::class)->trans('Page title here....', app()->getLocale()))

@section('content')

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container">

				<div class="row page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">@yield('pageTitle')</a></li>
					</ol>
                </div>
                <!-- row -->


                <div class="row">


					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">@yield('pageTitle')</h4>
                                <div class="mb-3">
                                    <div class="input-group">

                                        <a href="{{ route('admin.add-additive') }}" class="btn btn-primary " type="button">
                                            <span class="btn-icon-start text-info"><i class="fa fa-plus color-info"></i></span>
                                            {{ app(\App\Services\TranslationService::class)->trans('Add Additives', app()->getLocale()) }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example3" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>{{ app(\App\Services\TranslationService::class)->trans('Number', app()->getLocale()) }}</th>
                                                <th>{{ app(\App\Services\TranslationService::class)->trans('Art', app()->getLocale()) }}</th>
                                                <th>{{ app(\App\Services\TranslationService::class)->trans('auf der Speisekarte', app()->getLocale()) }}</th>
                                                <th>{{ app(\App\Services\TranslationService::class)->trans('Beispiele', app()->getLocale()) }}</th>
                                                <th>{{ app(\App\Services\TranslationService::class)->trans('Updated', app()->getLocale()) }}</th>
                                                <th>{{ app(\App\Services\TranslationService::class)->trans('Active', app()->getLocale()) }}</th>
                                                <th>{{ app(\App\Services\TranslationService::class)->trans('Action', app()->getLocale()) }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            @foreach ($additives as $additive)
                                            <tr>
                                                <td>
                                                    @empty($additive->additive_image)
                                                        <img class="rounded-circle" width="36" src="{{ asset('backend/images/table/1.jpg') }}" alt="Platzhalterbild">
                                                    @else
                                                        <img class="rounded-circle" width="36" src="{{ asset($additive->additive_image) }}" alt="{{ $additive->title }}">
                                                    @endempty
                                                </td>
                                                <td>{{ app(\App\Services\TranslationService::class)->trans($additive->additive_nr, app()->getLocale()) }}</td>
                                                <td>{{ app(\App\Services\TranslationService::class)->trans($additive->additive_art, app()->getLocale()) }}</td>
                                                <td>{{ app(\App\Services\TranslationService::class)->trans($additive->additive_title, app()->getLocale()) }}</td>
                                                <td>{{ app(\App\Services\TranslationService::class)->trans($additive->additive_description, app()->getLocale()) }}</td>
                                                <td>{{ \Carbon\Carbon::parse($additive->additive_date)->format('d.m.Y') }}</td>
                                                <td>
                                                    <i class="bi bi-lightbulb-fill" width="26" height="26" fill="currentColor" style="color: rgb(231, 144, 14);"></i>
                                                </td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                                    <a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach





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
        @push('specific-css')
        <!-- Datatable -->
        <link href="{{ asset('backend/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    @endpush

    @push('specific-scripts')
        <!-- Datatable -->
        <script src="{{ asset('backend/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('backend/js/plugins-init/datatables.init.js') }}"></script>



    @endpush


        @endsection


