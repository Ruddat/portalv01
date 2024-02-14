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






                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">@yield('pageTitle')</h4>
                                <div class="mb-3">
                                    <div class="input-group">

                                        <a href="{{ route('admin.additives-list') }}" class="btn btn-primary " type="button">
                                            <span class="btn-icon-start text-info"><i class="bi bi-arrow-left"></i></span>
                                            {{ app(\App\Services\TranslationService::class)->trans('Back to', app()->getLocale()) }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Nav tabs -->


                                    <div class="basic-form">
                                        <form action="{{ route('admin.save-additive') }}" method="POST" enctype="multipart/form-data" class="mt-3">
                                            @csrf
                                            @if (Session::get('success'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    <strong>Success!</strong> {!! Session::get('success') !!}
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            @endif
                                            @if (Session::get('fail'))
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <strong>Fail!</strong> {!! Session::get('fail') !!}
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            @endif

                                            <div class="row">
                                                <div class="mb-3 col-md-2">
                                                    <div class="form-group">
                                                        <label class="form-label">Number:</label>
                                                        <input type="text" class="form-control input-default" id="additive_nr" name="additive_nr" placeholder="Number" value="{{ old('additive_nr') }}">
                                                        @error('additive_nr')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="mb-3 col-md-5">
                                                    <div class="form-group">
                                                        <label class="form-label">Art der Zusatzstoffe:</label>
                                                        <input type="text" class="form-control input-default" id="additive_art" name="additive_art" placeholder="Art der Zusatzstoffe" value="{{ old('additive_art') }}">
                                                        @error('additive_art')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            
                                            <div class="mb-3 col-md-5">
                                                <div class="form-group">
                                                    <label class="form-label">Auf der Speisekarte:</label>
                                                    <input type="text" class="form-control input-default" id="additive_title" name="additive_title" placeholder="Auf der Speisekarte" value="{{ old('additive_title') }}">
                                                    @error('additive_title')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                            <div class="row">
                                                <div class="mb-3 col-md-12">
                                                    <label class="form-label">Beispiele:</label>
                                                    <textarea class="form-control h-auto" id="additive_description" name="additive_description" rows="4" id="comment">{{ old('additive_description') }}</textarea>
                                                    @error('additive_description')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Additives Image:</label>
                                                    <h5>Site logo</h5>
                                                    <input type="file" name="additive_image" class="form-control">
                                                    @error('additive_image')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <br/>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Create</button>
                                            </div>
                                        </form>

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



        <script>
                        $('#change_site_logo_form').on('submit', function(e) {
                e.preventDefault();
                var form = this;
                var formdata = new FormData(form)
                var inputFileVal = $(form).find('input[type="file"][name="site_logo"]').val();

                if (inputFileVal.length > 0) {
                    $.ajax({
                        url: $(form).attr('action'),
                        method: $(form).attr('method') ||
                        'POST', // Verwende POST als Standardmethode, wenn die Methode nicht definiert ist
                        data: formdata,
                        processData: false,
                        dataType: 'json',
                        contentType: false,
                        beforeSend: function() {
                            toastr.remove(); // Hier wird die vorhandene Toast-Nachricht entfernt
                            $(form).find('span.error-text').text('');
                        },

                        success: function(response) {
                            if (response.status == 1) {
                                toastr.success(response.msg);
                                $(form)[0].reset();
                            } else {
                                toastr.error(response.msg);
                            }
                        }
                    });
                } else {

                    $(form).find('span.error-text').text(
                        'Please, select logo image file. PNG file type is recommended.')
                }

            });

        </script>
    @endpush


        @endsection


