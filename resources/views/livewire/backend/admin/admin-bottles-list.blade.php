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
                        <div class="card-header d-flex flex-column flex-md-row align-items-center justify-content-between">
                            <h4 class="card-title mb-0">@yield('pageTitle')</h4>
                            <div class="mt-3 mt-md-0">
                                <a href="{{ route('admin.add-bottle') }}" class="btn btn-primary">
                                    <span class="btn-icon-start text-info"><i class="fa fa-plus color-info"></i></span>
                                    {{ app(\App\Services\TranslationService::class)->trans('Add Bottles deposit', app()->getLocale()) }}
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                @include('backend.includes.errorflash')

                                <table id="example3" class="table table-hover" style="min-width: 100%">
                                    <thead>
                                        <tr>
                                            <th>{{ app(\App\Services\TranslationService::class)->trans('Number', app()->getLocale()) }}</th>
                                            <th>{{ app(\App\Services\TranslationService::class)->trans('Flasche', app()->getLocale()) }}</th>
                                            <th>{{ app(\App\Services\TranslationService::class)->trans('Höhe des Pfands', app()->getLocale()) }}</th>
                                            <th>{{ app(\App\Services\TranslationService::class)->trans('Updated', app()->getLocale()) }}</th>
                                            <th>{{ app(\App\Services\TranslationService::class)->trans('On/Off', app()->getLocale()) }}</th>
                                            <th>{{ app(\App\Services\TranslationService::class)->trans('Action', app()->getLocale()) }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($bottles as $bottle)
                                            <tr>
                                                <td>{{ app(\App\Services\TranslationService::class)->trans($bottle->id, app()->getLocale()) }}</td>
                                                <td>{{ app(\App\Services\TranslationService::class)->trans($bottle->bottles_title, app()->getLocale()) }}</td>
                                                <td>€{{ number_format($bottle->bottles_value, 2, '.', ',') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($bottle->bottles_date)->format('d.m.Y') }}</td>
                                                <td>
                                                    <a href="#" onclick="toggleActiveStatus({{ $bottle->id }})">
                                                        @if ($bottle->published)
                                                            <i id="lamp-{{ $bottle->id }}" class="bi bi-lightbulb-fill" style="color: rgb(231, 144, 14);"></i>
                                                        @else
                                                            <i id="lamp-{{ $bottle->id }}" class="bi bi-lightbulb" style="color: gray;"></i>
                                                        @endif
                                                    </a>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('admin.edit-bottle', ['id' => $bottle->id]) }}" class="btn btn-primary btn-sm shadow me-1"><i class="fas fa-pencil-alt"></i></a>
                                                        <form action="{{ route('admin.delete-bottle') }}" method="POST" onsubmit="return confirmDelete();">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="id" value="{{ $bottle->id }}">
                                                            <button type="submit" class="btn btn-danger btn-sm shadow"><i class="fa fa-trash"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-danger">Kein Flaschen und Kistenpfand gefunden!!!</td>
                                            </tr>
                                        @endforelse
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
    // JavaScript-Funktion, um den Benutzer zu fragen, ob er sicher ist
    function confirmDelete() {
        return confirm('Sind Sie sicher, dass Sie dieses Element löschen möchten?');
    }

    // JavaScript-Funktion, um den Zusatzstoffstatus umzuschalten
    function toggleActiveStatus(bottlesId) {
        // AJAX-Anruf zum Aktualisieren des Zusatzstoffstatus
        $.ajax({
            type: "POST",
            url: "{{ route('admin.toggle-bottle-status') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "id": bottlesId
            },
            success: function(response) {
                // Aktualisieren Sie das Symbol basierend auf der Serverantwort
                if (response.published) {
                    $("#lamp-" + bottlesId).removeClass("bi-lightbulb").addClass("bi-lightbulb-fill").css("color", "rgb(231, 144, 14)");
                } else {
                    $("#lamp-" + bottlesId).removeClass("bi-lightbulb-fill").addClass("bi-lightbulb").css("color", "gray");
                }
            }
        });
    }
</script>
