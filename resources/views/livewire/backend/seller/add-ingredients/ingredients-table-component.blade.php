<div>
    {{-- Stop trying to control. --}}
    <div class="col-lg-12">
        <div class="card">


            <div class="card-header">
                <h4 class="card-title">@yield('pageTitle')</h4>

                <div class="pull-right">
                    <a href="{{ route('seller.manage-categories.add-category') }}"
                        class="btn btn-primary btn-sm" type="button">
                        <i class="fa fa-plus"></i>
                        Add Ingredients
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-responsive-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Titel</th>
                                <th>Grundpreis</th>
                                <th>Preis</th>
                                <th>Datum</th>
                                <th>On/Off</th>
                                <th>Action</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($categoriesWithChildrenAndPrices as $mainCategoryId => $mainCategoryData)
                            <tr id="line_{{ $mainCategoryId }}" class="zebra2">
                                <td class="row_{{ $mainCategoryId }}">
                                    <div class="">
                                        <div class="fl tree-i tree-item"></div>
                                    </div>
                                    <div class="p5"><sub>#{{ $mainCategoryId }}</sub></div>
                                </td>
                                <td class="row_{{ $mainCategoryId }}">
                                    <div class="">
                                        <div class="fl tree-i tree-item"></div>
                                    </div>
                                    <div class="p5">
                                        <strong>
                                        {{ $mainCategoryData['main']->title }}
                                        </strong>
                                    </div>
                                </td>
                                <td class="row_{{ $mainCategoryId }}"></td>
                                <td class="row_{{ $mainCategoryId }}"></td>
                                <td class="row_{{ $mainCategoryId }}">
                                    <div class="p5">{{ $mainCategoryData['main']->created_at->timezone('Europe/Berlin')->format('Y-m-d H:i') }}</div>
                                </td>
                                <td class="row_{{ $mainCategoryId }}" align="center">
                                    <div class="p5">
                                        <a href="#" onclick="toggleActiveStatus({{ $mainCategoryId }})">
                                            <i id="lamp-{{ $mainCategoryId }}" class="bi bi-lightbulb-fill" width="26" height="26" fill="currentColor" style="color: rgb(231, 144, 14);"></i>
                                        </a>
                                    </div>
                                </td>
                                <td class="row_{{ $mainCategoryId }}" align="left">
                                    <div class="p5">
                                        <span><a href="javascript:void(0);" class="me-4" data-bs-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil color-muted"></i> </a>

                                            <a href="javascript:void(0);" data-bs-toggle="tooltip" data-placement="top" title="btn-close"><i class="fa-solid fa-xmark text-danger"></i></a></span>

                                            <button wire:click="deleteCategoryWithIngredients({{ $mainCategoryId }})" class="delete-button">
                                                <i class="fa-solid fa-xmark text-danger"></i>
                                                </button>
                                        </div>
                                </td>
                            </tr>
                            @foreach ($mainCategoryData['children'] as $childId => $childData)
                                <tr id="line_{{ $childId }}" class="zebra1">
                                    <td class="row_{{ $childId }}">
                                        <div class="">
                                            <div class="fl tree-i tree-vertline"></div>
                                            <div class="fl tree-i tree-item"></div>
                                        </div>
                                        <div class="p5">#{{ $childId }}</div>
                                    </td>
                                    <td class="row_{{ $childId }}">
                                        <div class="">
                                            <div class="fl tree-i tree-vertline"></div>
                                            <div class="fl tree-i tree-item"></div>
                                        </div>
                                        <div class="p5">-- {{ $childData['ingredient']->title }}</div>
                                    </td>
                                    <td class="row_{{ $childId }}"> {{ $childData['ingredient']->base_price }}</td>
                                    <td class="row_{{ $childId }}">
                                        <div class="p5">
                                            <table class="ingridients_prices">
                                                <tbody>
                                                    <tr>
                                                        @foreach ($childData['titles'] as $sizeId => $title)
                                                            <td>{{ $title }}</td>
                                                        @endforeach
                                                    </tr>
                                                    <tr>
                                                        @foreach ($childData['prices'] as $price)
                                                            <td>{{ $price->price }} €</td>
                                                        @endforeach
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                    <td class="row_{{ $childId }}">
                                        <div class="p5">{{ $childData['ingredient']->created_at->format('Y-m-d H:i') }}</div>
                                    </td>
                                    <td class="row_{{ $childId }}" align="center">
                                        <div class="p5">
                                            <a href="#" onclick="toggleActiveStatus({{ $childId }})">
                                                <i id="lamp-{{ $childId }}" class="bi bi-lightbulb-fill" width="26" height="26" fill="currentColor" style="color: rgb(231, 144, 14);"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <td class="row_{{ $childId }}" align="left">
                                        <div class="p5">
                                            <span><a href="javascript:void(0);" class="me-4" data-bs-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil color-muted"></i> </a>
                                            <!-- Button zum Löschen der Zutat mit dem Close-Symbol -->
                                            <button wire:click="deleteIngredient({{ $mainCategoryId }}, {{ $childId }})" class="delete-button">
                                            <i class="fa-solid fa-xmark text-danger"></i>
                                            </button>

                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach





                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /# card -->
    </div>
</div>



