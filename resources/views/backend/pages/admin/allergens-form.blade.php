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

                                        <a href="{{ route('admin.allergens-list') }}" class="btn btn-primary " type="button">
                                            <span class="btn-icon-start text-info"><i class="bi bi-arrow-left"></i></span>
                                            {{ app(\App\Services\TranslationService::class)->trans(' Back', app()->getLocale()) }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Nav tabs -->


                                    <div class="basic-form">
                                            <form action="{{ isset($allergen) ? route('admin.update-allergen', $allergen->id) : route('admin.save-allergen') }}" method="POST" enctype="multipart/form-data" class="mt-3">
                                                @csrf
                                                @if(isset($allergen))
                                                    @method('PUT')
                                                @endif

                                                @include('backend.includes.errorflash')

                                                <div class="row">


                                                    <div class="mb-3 col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Kurzbeschreibung:</label>
                                                            <input type="text" class="form-control input-default" id="allergen_short_title" name="allergen_short_title" placeholder="Allergen Kurzbeschreibung" value="{{ isset($allergen) ? $allergen->allergenic_short_title : '' }}">
                                                            @error('allergen_short_title')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                <div class="mb-3 col-md-12">
                                                    <label class="form-label">Beispiele:</label>
                                                    <textarea class="form-control h-auto" id="allergen_title" name="allergen_title" rows="4" id="comment">{{ isset($allergen) ? $allergen->allergenic_title : '' }}</textarea>
                                                    @error('allergenic_titel')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>


                                                <br/>
                                                <button type="submit" class="btn btn-primary">{{ isset($allergene) ? 'Update' : 'Create' }}</button>
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





























