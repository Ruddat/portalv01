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
                        <div class="row">
						<div class="card h-auto">
							<div class="card-body">
								<div class="profile text-center">
									<h6>Logo {{ $shop->title }}</h6>
									<div class= "setting-img mb-4">
										 <div class="avatar-upload ">
											<div class="avatar-preview">

                                                <div id="imagePreview" class="mb-2 mt-1" style="max-width: 200px;">
                                                    <img wire:ignore src="" class="img-thumbnail"
                                                        data-ijabo-default-img="{{ $shop->logo_url }}"
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

						<div class="card h-auto">

							<div class="card-body">
                                <h6>Übertragung von aktuellen Bestelldaten</h6>
                                @include('backend.includes.errorflash')
                                <div class="basic-form">

                                        <div>
                                            <p>Tragen Sie die folgende URL zusammen mit Ihrem Benutzernamen und Passwort in Ihr Kassensystem ein:</p>
                                            <p><strong>Beschreibung:</strong> Abrufen neuer Bestellungen</p>
                                            <p><strong>URL:</strong> <span id="url">{{ $url }}</span> <button class="btn btn-outline-primary btn-xs" onclick="copyToClipboard()">Kopieren</button></p>
                                            <input type="checkbox" id="copied" style="vertical-align: middle; margin-left: 5px;" hidden>
                                            <label for="copied" id="copyLabel" style="vertical-align: middle; display: none;">URL wurde in die Zwischenablage kopiert.</label>
                                        </div>

                                        <div class="col-xl-12 col-lg-12 col-xxl-12 col-sm-8">
                                            <div class="card text-black text-black">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item d-flex justify-content-between"><span class="mb-0">Einstellungen Kassensystem</span></li>
                                                    <li class="list-group-item d-flex justify-content-between"><span class="mb-0">Übertragungsart :</span><strong>{{ $shop->transfer }}</strong></li>
                                                    <li class="list-group-item d-flex justify-content-between"><span class="mb-0">User Name :</span><strong>{{ $shop->api_username }}</strong></li>
                                                    <li class="list-group-item d-flex justify-content-between"><span class="mb-0">Password :</span><strong>{{ $shop->api_password }}</strong></li>
                                                </ul>
                                            </div>
                                        </div>

                                        <form action="{{ route('seller.change-shop-restapi') }}" method="POST" id="change-shop-restapi">
                                            @csrf
                                            <div class="row">
                                                <div class="mb-3 col-md-12">
                                                    <label class="form-label">Übertragungsart</label>
                                                    <select id="inputState" name="transfer_type" class="default-select form-control ms-0 wide">
                                                        <option value="Choose..." selected>Choose...</option>
                                                        <option value="1">RestApi</option>
                                                        <option value="2">Winorder</option>
                                                    </select>
                                                    @error('transfer_type')
                                                        <p style="color: red;">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">User Name</label>
                                                    <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                                                    @error('username')
                                                        <p style="color: red;">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Password</label>
                                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                                    @error('password')
                                                        <p style="color: red;">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>


                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </form>


                                </div>

							</div>
						</div>


						<div class="card h-auto">

							<div class="card-body">
                                <h6>OrderStream App Aktivieren</h6>
                                @include('backend.includes.errorflash')
                                <div class="basic-form">
                                    <div>
                                        <p><strong>Beschreibung:</strong> Abrufen neuer Bestellungen und verarbeiten via OrdersStream App</p>
                                        <p><strong>Code:</strong> <span id="activation_code">{{ $shop->activation_code ?? 'code anzeigen' }}</span></p>
                                        <button class="btn btn-outline-primary btn-xs" id="generateCodeBtn">Aktivation Code Generieren</button>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    @endpush

    @push('specific-scripts')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- JavaScript, um das Scrollen zu steuern -->
<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('scroll-to-error', () => {
            // Zum Anfang der Seite scrollen
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
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
            imageShape: 'universal', // set square image shape
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

<script>
    function copyToClipboard() {
        var url = document.getElementById("url");
        var input = document.createElement("input");
        input.value = url.textContent;
        document.body.appendChild(input);
        input.select();
        document.execCommand("copy");
        document.body.removeChild(input);
        document.getElementById("copied").checked = true;
        document.getElementById("copyLabel").style.display = "inline-block";
        setTimeout(function(){
            document.getElementById("copied").checked = false;
            document.getElementById("copyLabel").style.display = "none";
        }, 4000); // Die Anzeige wird nach 2 Sekunden ausgeblendet
    }
</script>

<script>
    // Überprüfen, ob das Dokument vollständig geladen wurde
    document.addEventListener("DOMContentLoaded", function() {
        // Selektor für den Sweet-Success-Button
        const sweetSuccessBtn = document.querySelector('.sweet-success');

        // Hinzufügen eines Klickereignisses auf den Sweet-Success-Button
        sweetSuccessBtn.addEventListener('click', function() {
            // Anzeigen der SweetAlert-Benachrichtigung
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Sweet Success triggered!',
            });
        });
    });
</script>

<script>
    document.getElementById('generateCodeBtn').addEventListener('click', function () {
        fetch('{{ route('seller.generate-activation-code') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({})
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 1) {
                document.getElementById('activation_code').textContent = data.activation_code;
            } else {
                alert('Error generating activation code.');
            }
        })
        .catch(error => console.error('Error:', error));
    });
</script>

<style>
    span#activation_code {
    font-size: x-large;
}
</style>

    @endpush

@endsection


