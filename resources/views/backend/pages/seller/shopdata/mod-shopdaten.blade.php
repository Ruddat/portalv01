@extends('backend.layouts.default-dark')
@section('pageTitle', isset($pageTitle) ? app(\App\Services\TranslationService::class)->trans($pageTitle, app()->getLocale()) : app(\App\Services\TranslationService::class)->trans('Page title here....', app()->getLocale()))
@section('content')




		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
			<div class="container">
				<div class="row">
					<div class="col-xl-4">
						<div class="card h-auto">
							<div class="card-body">
								<div class="profile text-center">
									<h6>Logo {{ $shop->title }}</h6>
									<div class= "setting-img mb-4">
										 <div class="avatar-upload ">
											<div class="avatar-preview">

                                                <div id="imagePreview" class="mb-2 mt-1" style="max-width: 200px;">
                                                    <img wire:ignore src="" class="img-thumbnail"
                                                        data-ijabo-default-img="/uploads/shops/{{ $shop->id }}/images/{{ $shop->logo }}"
                                                        id="site_logo_image_preview">
                                                </div>
											</div>





                                                <form action="{{ route('seller.change-logo-pictures') }}" method="POST"
                                                    enctype="multipart/form-data" id="change_site_logo_form">
                                                    @csrf
                                                    <div class="mb-2">
                                                        <input type="file" name="site_logo" id="site_logo" class="form-control">
                                                        <span class="text-danger error-text site_logo_error"></span>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Change logo</button>
                                                </form>


										</div>
									</div>

								</div>
							</div>
						</div>
					</div>


                    @livewire('backend.seller.shop.shop-data-form')


				</div>
            </div>
        </div>

		<!-- Button trigger modal -->

        <!--**********************************
            Content body end
        ***********************************-->





    @push('specific-css')
    @endpush

    @push('specific-scripts')
<!-- JavaScript, um das Scrollen zu steuern -->
<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('scroll-to-message', function () {
            const messageElement = document.querySelector('.alert');
            if (messageElement) {
                messageElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
</script>

    <script>
        document.addEventListener("livewire:init", () => {
            Livewire.on("toast", (event) => {
                toastr[event.notify](event.message);
            });
        });
    </script>




<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.addEventListener('updateAdminInfo', function(event) {
            $('#adminProfileName').html(event.detail.adminName);
            $('#adminProfileEmail').html(event.detail.adminEmail);
        });

        $('input[type="file"][name="site_logo"][id="site_logo"]').ijaboViewer({
            preview: '#site_logo_image_preview',
            imageShape: 'square', // set square image shape
            allowedExtensions: ['jpg', 'jpeg', 'png', 'svg'],
            onErrorShape: function(message, element) {
                alert(message);
            },
            onInvalidType: function(message, element) {
                alert(message);
            },
            onSuccess: function(message, element) {
                // Code nach erfolgreichem Hochladen
            }
        });
    });

    // Admin-Info-Update-Handler
    window.addEventListener('updateAdminInfo', function(event) {
        $('#adminProfileName').html(event.detail.adminName);
        $('#adminProfileEmail').html(event.detail.adminEmail);
    });

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


