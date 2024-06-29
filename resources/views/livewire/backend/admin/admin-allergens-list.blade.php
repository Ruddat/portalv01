<div>



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

                                    <a href="{{ route('admin.add-allergen') }}" class="btn btn-primary " type="button">
                                        <span class="btn-icon-start text-info"><i class="fa fa-plus color-info"></i></span>
                                        @autotranslate('Add Allergenic', app()->getLocale())
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
                                            <th>{{ app(\App\Services\TranslationService::class)->trans('Number', app()->getLocale()) }}</th>
                                            <th>{{ app(\App\Services\TranslationService::class)->trans('auf der Speisekarte', app()->getLocale()) }}</th>
                                            <th>@autotranslate('Beispiele', app()->getLocale())</th>
                                            <th>{{ app(\App\Services\TranslationService::class)->trans('Updated', app()->getLocale()) }}</th>
                                            <th>{{ app(\App\Services\TranslationService::class)->trans('Active', app()->getLocale()) }}</th>
                                            <th>{{ app(\App\Services\TranslationService::class)->trans('Action', app()->getLocale()) }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        @foreach ($allergens as $allergen)
                                        <tr>
                                            <td>{{ $allergen->id }}</td>
                                            <td>@autotranslate($allergen->allergenic_short_title, app()->getLocale())</td>
                                            <td>@autotranslate($allergen->allergenic_title, app()->getLocale())</td>
                                            <td>{{ \Carbon\Carbon::parse($allergen->updated_at)->format('d.m.Y') }}</td>
                                            <td>
                                                <!-- Klickbares Symbol für den Zusatzstoffstatus -->
                                                <a href="#" onclick="toggleActiveStatus({{ $allergen->id }})">
                                                    @if ($allergen->published)
                                                        <i id="lamp-{{ $allergen->id }}" class="bi bi-lightbulb-fill" width="26" height="26" fill="currentColor" style="color: rgb(231, 144, 14);"></i>
                                                    @else
                                                        <i id="lamp-{{ $allergen->id }}" class="bi bi-lightbulb" width="26" height="26" fill="currentColor" style="color: gray;"></i>
                                                    @endif
                                                </a>
                                            </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('admin.edit-allergen', ['id' => $allergen->id]) }}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                                <form action="{{ route('admin.delete-allergen') }}" method="POST" onsubmit="return confirmDelete();">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id" value="{{ $allergen->id }}">
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
function toggleActiveStatus(allergenId) {
    // AJAX-Anruf zum Aktualisieren des Zusatzstoffstatus
    $.ajax({
        type: "POST",
        url: "{{ route('admin.toggle-allergen-status') }}",
        data: {
            "_token": "{{ csrf_token() }}",
            "id": allergenId
        },
        success: function(response) {
            // Aktualisieren Sie das Symbol basierend auf der Serverantwort
            if (response.published) {
                $("#lamp-" + allergenId).removeClass("bi-lightbulb").addClass("bi-lightbulb-fill").css("color", "rgb(231, 144, 14)");
            } else {
                $("#lamp-" + allergenId).removeClass("bi-lightbulb-fill").addClass("bi-lightbulb").css("color", "gray");
            }
        }
    });
}
</script>
