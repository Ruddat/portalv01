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
                                            <div class="alert alert-success solid alert-dismissible fade show">
                                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                                                <strong>Success!</strong> {!! Session::get('success') !!}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                                                    <span>
                                                        <i class="fa-solid fa-xmark"></i>
                                                    </span>
                                                </button>
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

                                            <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <div class="form-group">
                                                    <h5>Additives Image:</h5>
                                                    <input type="file" name="additive_image" id="additive_image" class="form-control"> <!-- ID hinzugefügt -->
                                                    @error('additive_image')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="avatar mb-3 col-md-6">
                                                <h5>Preview:</h5>
                                                <img src="{{ asset('backend/images/avatar/1.jpg') }}" class="rounded-circle" alt="Default Image" width="50" height="50" id="additive_image_preview">
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

    @endpush

    @push('specific-scripts')

        <script>
    $('input[type="file"][name="additive_image"][id="additive_image"]').ijaboViewer({
          preview : '#additive_image_preview',
          setRatio:1,
          allowedExtensions: ['jpg', 'jpeg','png'],
                onErrorShape:function(e){
                    toastr.error('The image must be square', 'Error');
                },
                onInvalidType:function(e){
                    toastr.error('The file type is not allowed', 'Error');
                },
                onFileSizeError:function(e){
                    toastr.error('The file size is too big', 'Error');
                },
                onSuccess:function(e){

                    // Überprüfen Sie, ob e.imageURL korrekt ist, und setzen Sie den Pfad entsprechend
                    $('#additive_image_preview').attr('src', e.imageURL);
                    $('#additive_image_preview').show(); // Zeigen Sie das Bild an, nachdem es hochgeladen wurde
                }
            });
        </script>

    @endpush


        @endsection


