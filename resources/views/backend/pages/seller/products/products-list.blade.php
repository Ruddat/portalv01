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
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Table</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0)">Datatable</a></li>
					</ol>
                </div>
                <!-- row -->


                <div class="row">

                    @include('backend.includes.errorflash')




					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Profile Datatable</h4>
                                <div class="pull-right">
                                    <a href="{{ route('seller.manage-products.add-product', ['shopId' => $shopId, 'menuId' =>  $menuId, 'categoryId' => $categoryId]) }}"
                                        class="btn btn-primary btn-sm" type="button">
                                        <i class="fa fa-plus"></i>
                                        Add Product
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example3" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nr.</th>
                                                <th>Bild</th>
                                                <th>Titel</th>
                                                <th>Beschreibung</th>
                                                <th>Preis</th>
                                                <th>Groessen</th>
                                                <th>Datum</th>

                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="sortable_products">

                                            @forelse ($products as $product)
                                            <tr data-index="{{ $product->id }}" data-ordering="{{ $product->product_ordering }}">
                                                <td>{{ $product->product_ordering }}</td>
                                                <td><strong>#{{ $product->product_code }}</strong></td>
                                                <td><img class="square" width="48" src="{{ $product->product_image_url }}" alt=""></td>
                                                <td>{{ $product->product_title }}</td>
                                                <td><sub>{!! $product->product_description !!}</sub></td>
                                                <td>{{ $product->produckt_anonce }}</td>
                                                <!-- Weitere Spalten entsprechend den Daten in der Tabelle -->
                                                <td>
                                                    <sub>classic 26cm = 12.90</sub></br>
                                                    <sub>italien 32cm = 12.90</sub></br>
                                                    <sub>grande  40cm = 12.90</sub>
                                                </td>
                                                <td>{{ $product->updated_at->format('Y-m-d') }}</td>
                                                                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('seller.manage-products.edit-product', ['shopId' => $shopId, 'menuId' =>  $menuId, 'categoryId' => $categoryId, 'productId' => $product->id]) }}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                                        <a href="{{ route('seller.manage-products.delete-product', ['shopId' => $shopId, 'menuId' =>  $menuId, 'categoryId' => $categoryId, 'productId' => $product->id]) }}" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>



                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="12">
                                                    <div class="alert alert-dark solid alert-rounded">
                                                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><circle cx="12" cy="12" r="10"></circle><path d="M8 14s1.5 2 4 2 4-2 4-2"></path><line x1="9" y1="9" x2="9.01" y2="9"></line><line x1="15" y1="9" x2="15.01" y2="9"></line></svg>
                                                        <strong>Products!</strong> {{ app(\App\Services\TranslationService::class)->trans('No product found - Erstelle hier neue Artikel/Produkte', app()->getLocale()) }}</div>
                                                </td>
                                            </tr>
                                        @endforelse




                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>



					<!-- Datatable -->






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
                $('table tbody#sortable_products').sortable({
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
            url: '{{ route("seller.manage-products.update-ordering") }}',
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



<script>
    function showDeleteConfirmation() {
        // Zeigen Sie die SweetAlert-Bestätigung an
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Wenn der Benutzer auf "Yes, delete it!" klickt, das Formular absenden
                document.getElementById('deleteProductForm').submit();
            }
        });
    }
</script>


    @endpush

@endsection


