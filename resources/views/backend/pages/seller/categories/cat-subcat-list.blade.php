@extends('backend.layouts.default-dark')
@section('pageTitle', isset($pageTitle) ? app(\App\Services\TranslationService::class)->trans($pageTitle,
    app()->getLocale()) : app(\App\Services\TranslationService::class)->trans('Page title here....', app()->getLocale()))
@section('content')


@livewire('backend.seller.categories.categories-subcategories-list')


    @push('specific-css')
    @endpush

    @push('specific-scripts')

    <script>
function toggleShowInList(categoryId) {
    // AJAX-Anruf zum Aktualisieren der "Show in list" -Eigenschaft
    $.ajax({
        type: "POST",
        url: "{{ route('seller.manage-categories.toggle-show-in-list') }}",
        data: {
            "_token": "{{ csrf_token() }}",
            "id": categoryId
        },
        success: function(response) {
            // Aktualisieren Sie das Badge basierend auf der Serverantwort
            var badgeColor = response.showInList ? 'success' : 'secondary';
            var badgeText = response.showInList ? 'Yes' : 'No';
            $("#showInListBadge-" + categoryId).removeClass('badge-secondary badge-success').addClass('badge-' + badgeColor).text(badgeText);
        },
        error: function(xhr, status, error) {
            // Behandeln Sie Fehler, falls erforderlich
            console.error('Fehler beim Umschalten der "Show in list" -Eigenschaft:', error);
            // Hier können Sie eine Fehlermeldung anzeigen, wenn Sie möchten
            // toastr.error('Fehler beim Umschalten der "Show in list" -Eigenschaft: ' + error);
        }
    });
}
    </script>

    <script>
        // JavaScript-Funktion, um den Kategoriestatus umzuschalten
        function toggleActiveStatus(categoryId) {
            // AJAX-Anruf zum Aktualisieren des Kategoriestatus
            $.ajax({
                url: '{{ route("seller.manage-categories.toggle-category-status") }}',
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": categoryId
                },
                success: function(response) {
                    // Aktualisieren Sie das Symbol basierend auf der Serverantwort
                    if (response.published) {
                        $("#lamp-" + categoryId).removeClass("bi-lightbulb").addClass("bi-lightbulb-fill").css("color", "rgb(231, 144, 14)");
                    } else {
                        $("#lamp-" + categoryId).removeClass("bi-lightbulb-fill").addClass("bi-lightbulb").css("color", "gray");
                    }
                },
                error: function(xhr, status, error) {
                    // Behandeln Sie Fehler, falls erforderlich
                    console.error('Fehler beim Umschalten des Kategoriestatus:', error);
                    // Hier können Sie eine Fehlermeldung anzeigen, wenn Sie möchten
                    // toastr.error('Fehler beim Umschalten des Kategoriestatus: ' + error);
                }
            });
        }
    </script>

    <script>
        $('table tbody#sortable_categories').sortable({
            cursor: "move",
            update: function(event, ui) {
                $(this).children().each(function(index) {
                    if ($(this).attr('data-ordering') != (index + 1)) {
                        $(this).attr('data-ordering', (index + 1)).addClass('updated');
                    }
                });
                var positions = [];
                $('.updated').each(function() {
                    positions.push([$(this).attr('data-index'), $(this).attr('data-ordering')]);
                    $(this).removeClass('updated');
                });
                // Vor dem Ajax-Aufruf die Daten ausgeben
                 //console.log('Positions:', positions);
                // AJAX-Anforderung senden, um die Positionen zu speichern
                $.ajax({
    url: '{{ route("seller.manage-categories.update-ordering") }}',
    method: 'POST',
    data: {
        positions: positions,
        _token: '{{ csrf_token() }}' // CSRF-Token als Teil der Daten senden
    },
    success: function(response) {
        if (response.success) {
           // console.log('Sortierreihenfolge erfolgreich gespeichert.');
            // Flash- oder Session-Nachricht für Erfolg anzeigen
            // Beispiel:
             toastr.success('Sortierreihenfolge erfolgreich gespeichert.');
        } else {
            //console.error('Sortierreihenfolge konnte nicht gespeichert werden:', response.message);
            // Flash- oder Session-Nachricht für Fehler anzeigen
            // Beispiel:
            toastr.error('Sortierreihenfolge konnte nicht gespeichert werden: ' + response.message);
        }
    },
    error: function(xhr, status, error) {
       // console.error('Fehler beim Speichern der Sortierreihenfolge:', error);
        // Flash- oder Session-Nachricht für Fehler anzeigen
        // Beispiel:
         toastr.error('Fehler beim Speichern der Sortierreihenfolge: ' + error);
    }
});

            }
        });
    </script>




    @endpush

@endsection
