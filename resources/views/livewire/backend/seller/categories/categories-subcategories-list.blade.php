<div>

    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body">
        <div class="container">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Table</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">@yield('pageTitle')</a></li>
                </ol>
            </div>
            <!-- row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">@yield('pageTitle')</h4>

                            <div class="pull-right">
                                <a href="{{ route('seller.manage-categories.add-category') }}"
                                    class="btn btn-primary btn-sm" type="button">
                                    <i class="fa fa-plus"></i>
                                    Add Category
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-responsive-md">
                                    <thead>
                                        <tr>
                                            <th style="width:80px;"><strong>#</strong></th>
                                            <th><strong>Category Image</strong></th>
                                            <th><strong>Category Name</strong></th>
                                            <th><strong>N. of sub categories</strong></th>
                                            <th><strong>Show in list</strong></th>
                                            <th><strong>Turned on</strong></th>
                                            <th><strong>Actions</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody id="sortable_categories">


                                        @forelse ($categories as $item)
                                        <tr data-index="{{ $item->id }}" data-ordering="{{ $item->ordering }}">
                                            <td><strong>{{ $item->id }}</strong></td>
                                            <td>
                                                <div class="avatar mr-2">
                                                    <img src="{{ $item->category_image_url }}" width="120" height="50" alt="">
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('seller.manage-products.products-list', ['shopId' => $item->shop_id, 'menuId' => 600, 'categoryId' => $item->id]) }}">
                                                    {{ $item->category_name }}
                                                    @if(isset($productCounts[$item->id]))
                                                        ({{ $productCounts[$item->id] }})
                                                    @endif
                                                </a>
                                            </td>
                                            <td>-</td>
                                            <td>
                                                <!-- Umschalten der "Show in list" -Eigenschaft durch Klicken auf das Badge -->
                                                <span id="showInListBadge-{{ $item->id }}" class="badge badge-pill badge-{{ $item->show_in_list ? 'success' : 'secondary' }}" style="cursor: pointer;" onclick="toggleShowInList({{ $item->id }})">
                                                    {{ $item->show_in_list ? 'Yes' : 'No' }}
                                                </span>
                                            </td>
                                            <td>
                                                <!-- Klickbares Symbol für den Kategoriestatus -->
                                                <a href="#" onclick="toggleActiveStatus({{ $item->id }})">
                                                    @if ($item->published)
                                                        <i id="lamp-{{ $item->id }}" class="bi bi-lightbulb-fill" width="26" height="26" fill="currentColor" style="color: rgb(231, 144, 14);"></i>
                                                    @else
                                                        <i id="lamp-{{ $item->id }}" class="bi bi-lightbulb" width="26" height="26" fill="currentColor" style="color: gray;"></i>
                                                    @endif
                                                </a>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('seller.manage-categories.edit-category', ['id'=>$item->id]) }}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a>
                                                    <a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="12">
                                                <div class="alert alert-danger" role="alert">
                                                    No categories found
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
                {{-- Produkte Subcategories --}}
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">@yield('pageTitle')</h4>

                            <div class="pull-right">
                                <a href="{{ route('seller.manage-categories.add-category') }}"
                                    class="btn btn-primary btn-sm" type="button">
                                    <i class="fa fa-plus"></i>
                                    Add Sub Category
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-responsive-md">
                                    <thead>
                                        <tr>
                                            <th style="width:80px;"><strong>#</strong></th>
                                            <th><strong>Sub Category Name</strong></th>
                                            <th><strong>Category Name</strong></th>
                                            <th><strong>N. of Childs Subs.</strong></th>
                                            <th><strong>Show in list</strong></th>
                                            <th><strong>Turned on</strong></th>
                                            <th><strong>Actions</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>





                                        <tr>
                                            <td><strong>01</strong></td>
                                            <td>Pizzabausatz</td>
                                            <td>Pizza</td>
                                            <td>None</td>
                                            <td>
                                                Show in list
                                            </td>
                                            <td>
                                                Turned on
                                            </td>

                                            <td>
                                                <div class="d-flex">
                                                    <a href="#"
                                                        class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                            class="fa fa-pencil"></i></a>
                                                    <a href="#" class="btn btn-danger shadow btn-xs sharp"><i
                                                            class="fa fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>

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


