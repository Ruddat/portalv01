<div>



        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container">

				<div class="row page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active"><a href="{{ route('admin.home') }}"> @autotranslate('Home', app()->getLocale())</a></li>
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
                                            @autotranslate('Add Additives', app()->getLocale())

                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">

                                    @include('backend.includes.errorflash')


                                    <table id="example3" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>@autotranslate('Icon', app()->getLocale())</th>
                                                <th>@autotranslate('Number', app()->getLocale())</th>
                                                <th>@autotranslate('Art', app()->getLocale())</th>
                                                <th>@autotranslate('auf der Speisekarte', app()->getLocale())</th>
                                                <th>{{ app(\App\Services\TranslationService::class)->trans('Beispiele', app()->getLocale()) }}</th>
                                                <th>{{ app(\App\Services\TranslationService::class)->trans('Updated', app()->getLocale()) }}</th>
                                                <th>{{ app(\App\Services\TranslationService::class)->trans('Active', app()->getLocale()) }}</th>
                                                <th>@autotranslate('Action', app()->getLocale())</th>
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
                                                <td>
                                                    @php
                                                        $description = app(\App\Services\AutoTranslationService::class)->trans($additive->additive_description, app()->getLocale());
                                                        $wrappedDescription = wordwrap($description, 38, "<br>\n", true);
                                                        $limitedDescription = Str::limit($wrappedDescription, 10000, ''); // Keine Begrenzung durch Str::limit(), weil wordwrap bereits angewendet wurde
                                                    @endphp

                                                    {!! $limitedDescription !!}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($additive->additive_updated_at)->format('d.m.Y') }}</td>
                                                <td>
                                                    <!-- Klickbares Symbol für den Zusatzstoffstatus -->
                                                    <a href="#" onclick="toggleActiveStatus({{ $additive->id }})">
                                                        @if ($additive->published)
                                                            <i id="lamp-{{ $additive->id }}" class="bi bi-lightbulb-fill" width="26" height="26" fill="currentColor" style="color: rgb(231, 144, 14);"></i>
                                                        @else
                                                            <i id="lamp-{{ $additive->id }}" class="bi bi-lightbulb" width="26" height="26" fill="currentColor" style="color: gray;"></i>
                                                        @endif
                                                    </a>
                                                </td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('admin.edit-additive', ['id' => $additive->id]) }}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                                    <form action="{{ route('admin.delete-additive') }}" method="POST" onsubmit="return confirmDelete();">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="id" value="{{ $additive->id }}">
                                                        <button type="submit" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></button>
                                                    </form>
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



</div>
<script>
    // Nach 5 Sekunden die Erfolgsmeldung ausblenden
    setTimeout(function() {
        var successAlert = document.getElementById('success-alert');
        if (successAlert) {
            successAlert.classList.remove('show');
        }
    }, 5000);
</script>


<script>
    // JavaScript-Funktion, um den Benutzer zu fragen, ob er sicher ist
    function confirmDelete() {
        return confirm('Sind Sie sicher, dass Sie dieses Element löschen möchten?');
    }
</script>

<script>
    // JavaScript-Funktion, um den Zusatzstoffstatus umzuschalten
    function toggleActiveStatus(additiveId) {
        // AJAX-Anruf zum Aktualisieren des Zusatzstoffstatus
        $.ajax({
            type: "POST",
            url: "{{ route('admin.toggle-additive-status') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "id": additiveId
            },
            success: function(response) {
                // Aktualisieren Sie das Symbol basierend auf der Serverantwort
                if (response.published) {
                    $("#lamp-" + additiveId).removeClass("bi-lightbulb").addClass("bi-lightbulb-fill").css("color", "rgb(231, 144, 14)");
                } else {
                    $("#lamp-" + additiveId).removeClass("bi-lightbulb-fill").addClass("bi-lightbulb").css("color", "gray");
                }
            }
        });
    }
</script>
