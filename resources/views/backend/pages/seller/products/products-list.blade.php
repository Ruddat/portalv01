@extends('backend.layouts.default-dark')

@section('pageTitle', isset($pageTitle) ? app(\App\Services\TranslationService::class)->trans($pageTitle, app()->getLocale()) : app(\App\Services\TranslationService::class)->trans('Page title here....', app()->getLocale()))

@section('content')

<div class="content-body">
    <div class="container">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Table</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Datatable</a></li>
            </ol>
        </div>
        <div class="row">
            @include('backend.includes.errorflash')

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Profile Datatable</h4>
                        <div class="pull-right">
                            <a href="{{ route('seller.manage-products.add-product', ['shopId' => $shopId, 'menuId' =>  $menuId, 'categoryId' => $categoryId]) }}" class="btn btn-primary btn-sm" type="button">
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


                                        <td>
                                            <a href="{{ route('seller.manage-products.edit-product', ['shopId' => $shopId, 'menuId' =>  $menuId, 'categoryId' => $categoryId, 'productId' => $product->id]) }}">{{ $product->product_title }}</a>

                                        </td>
                                        <td><sub>{!! $product->product_description !!}</sub></td>
                                        <td>{{ $product->produckt_anonce }}</td>
                                        <td>
                                            <sub>
                                                @if($product->productSizesPrices->isEmpty())
                                                    <a href="{{ route('seller.product-sizes', ['shop' => $shopId]) }}">Keine Preise vorhanden</a>
                                                    @else
                                                    @foreach($product->productSizesPrices as $price)
                                                        {{ $price->size->title }} = {{ $price->price }} Euro<br>
                                                    @endforeach
                                                @endif
                                            </sub>
                                        </td>
                                        <td>{{ $product->updated_at->format('Y-m-d') }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('seller.manage-products.edit-product', ['shopId' => $shopId, 'menuId' =>  $menuId, 'categoryId' => $categoryId, 'productId' => $product->id]) }}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                                <a href="{{ route('seller.manage-products.delete-product', ['shopId' => $shopId, 'menuId' =>  $menuId, 'categoryId' => $categoryId, 'productId' => $product->id]) }}" class="btn btn-danger shadow btn-xs sharp" onclick="showDeleteConfirmation()"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="12">
                                            <div class="alert alert-dark solid alert-rounded">
                                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><circle cx="12" cy="12" r="10"></circle><path d="M8 14s1.5 2 4 2 4-2 4-2"></path><line x1="9" y1="9" x2="9.01" y2="9"></line><line x1="15" y1="9" x2="15.01" y2="9"></line></svg>
                                                <strong>Products!</strong> {{ app(\App\Services\TranslationService::class)->trans('No product found - Erstelle hier neue Artikel/Produkte', app()->getLocale()) }}
                                            </div>
                                        </td>
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
            $.ajax({
                url: '{{ route("seller.manage-products.update-ordering") }}',
                method: 'POST',
                data: {
                    positions: positions,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success('Sortierreihenfolge erfolgreich gespeichert.');
                    } else {
                        toastr.error('Sortierreihenfolge konnte nicht gespeichert werden: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error('Fehler beim Speichern der Sortierreihenfolge: ' + error);
                }
            });
        }
    });

    function showDeleteConfirmation() {
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
                document.getElementById('deleteProductForm').submit();
            }
        });
    }
</script>
@endpush

@endsection
