<div>

    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body">
        <div class="container">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Table</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Bootstrap</a></li>
                </ol>
            </div>
            <!-- row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Categories</h4>

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
                                    <tbody>


                                        @forelse ($categories as $item)
                                            <tr>
                                                <td><strong>01</strong></td>
                                                <td>
                                                    <div class="avatar mr-2">
                                                        <img src="/images/categories/{{ $item->category_image }}"
                                                            width="120" height="50" alt="">
                                                    </div>
                                                </td>


                                                <td>{{ $item->category_name }}</td>
                                                <td>-</td>
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
                            <h4 class="card-title">Sub Categories</h4>

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
