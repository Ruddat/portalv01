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
						<li class="breadcrumb-item"><a href="javascript:void(0)">@yield('pageTitle')</a></li>
					</ol>
                </div>
                <!-- row -->

                <div class="row">





                    <livewire:backend.seller.add-ingredients.add-ingredients-component />



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

                                            <tr id="line_81" class="zebra2">


                                                <td class="row_81">
                                                    <div class="">
                                                        <div class="fl tree-i tree-item"></div>
                                                    </div>
                                                        <div class="p5">#1</div>
                                                </td>

                                                <td class="row_81">
                                                                <div class="">
                                                                                                                                <div class="fl tree-i tree-item"></div>
                                                                    </div>
                                                            <div class="p5">
                                        Wählen Sie weitere</br> Zutaten für Ihr Wunschgericht.
                                    </div>
                                </td>
                                                <td class="row_81">
                                                            <div class="p5">
                                        0.00 €
                                    </div>
                                </td>
                                                <td class="row_81">
                                                            <div class="p5">

                                    </div>
                                </td>
                                                <td class="row_81">
                                                            <div class="p5">
                                        2018-01-28 13:36:43
                                    </div>
                                </td>
                                                <td class="row_81" align="center">
                                                            <div class="p5">

                                                                    <!-- Klickbares Symbol für den Kategoriestatus -->
                                                                    <a href="#" onclick="toggleActiveStatus(1)">
                                                                                                                                <i id="lamp-1" class="bi bi-lightbulb-fill" width="26" height="26" fill="currentColor" style="color: rgb(231, 144, 14);"></i>
                                                                                                                        </a>

                                    </div>
                                </td>


                                                <td class="row_81" align="left">
                                                            <div class="p5">
                                                                <span><a href="javascript:void(0);" class="me-4" data-bs-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil color-muted"></i> </a><a href="javascript:void(0);" data-bs-toggle="tooltip" data-placement="top" title="btn-close"><i class="fa-solid fa-xmark text-danger"></i></a></span>
                                    </div>
                                </td>


                                <tr id="line_82" class="zebra1">
                                    <td class="row_82">
                                        <div class="">
                                            <div class="fl tree-i tree-vertline"></div>
											    <div class="fl tree-i tree-item"></div>
														</div>
												<div class="p5">
							                    #1
						                        </div>
					                </td>

									<td class="row_82">
                                        <div class="">
                                            <div class="fl tree-i tree-vertline"></div>
											    <div class="fl tree-i tree-item"></div>
														</div>
												<div class="p5">
							                    -- Ananas
						                        </div>
					                </td>
									<td class="row_82">
										<div class="p5">0.00 €</div>
					                </td>
									<td class="row_82">
										<div class="p5">
							<table class="ingridients_prices"><tbody>
                                <tr>
                                    <td>Junior</br> Ø20cm</td>
                                    <td>Klassik</br> Ø26cm</td>
                                    <td>Grande</br> Ø40cm</td>
                                    <td>Double</br> Ø34cm</td>
                                    <td>HALF</br></td>
                                    <td>LARGE</br></td>
                                    <td>Small</br></td>
                                    <td>Classic</br> </td>
                                    <td>Small</br></td>
                                    <td>Small</br></td>
                                </tr>
                                <tr>
                                    <td>0.90 €</td>
                                    <td>2.00 €</td>
                                    <td>3.00 €</td>
                                    <td>2.50 €</td>
                                    <td>0.90 €</td>
                                    <td>1.00 €</td>
                                    <td>0.90 €</td>
                                    <td>1.00 €</td>
                                    <td>0.90 €</td>
                                    <td>0.90 €</td>
                                </tr>
                            </tbody>
                            </table>
						</div>
					</td>
								<td class="row_82">
									<div class="p5">2024-03-05 20:54:42</div>
					            </td>
									<td class="row_82" align="center">
										<div class="p5">
                                                                    <!-- Klickbares Symbol für den Kategoriestatus -->
                                                                    <a href="#" onclick="toggleActiveStatus(1)">
                                                                        <i id="lamp-1" class="bi bi-lightbulb-fill" width="26" height="26" fill="currentColor" style="color: rgb(231, 144, 14);"></i>
                                                                </a>                						</div>
				            	</td>


									<td class="row_82" align="left">
												<div class="p5">
                                                    <span><a href="javascript:void(0);" class="me-4" data-bs-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil color-muted"></i> </a><a href="javascript:void(0);" data-bs-toggle="tooltip" data-placement="top" title="btn-close"><i class="fa-solid fa-xmark text-danger"></i></a></span>
						</div>
					</td>
								</tr>


                                <tr id="line_82" class="zebra1">
                                    <td class="row_82">
                                        <div class="">
                                            <div class="fl tree-i tree-vertline"></div>
											    <div class="fl tree-i tree-item"></div>
														</div>
												<div class="p5">
							                    #1
						                        </div>
					                </td>

									<td class="row_82">
                                        <div class="">
                                            <div class="fl tree-i tree-vertline"></div>
											    <div class="fl tree-i tree-item"></div>
														</div>
												<div class="p5">
							                    -- Ananas
						                        </div>
					                </td>
									<td class="row_82">
										<div class="p5">0.00 €</div>
					                </td>
									<td class="row_82">
										<div class="p5">
							<table class="ingridients_prices"><tbody>
                                <tr>
                                    <td>Junior</br> Ø20cm</td>
                                    <td>Klassik</br> Ø26cm</td>
                                    <td>Grande</br> Ø40cm</td>
                                    <td>Double</br> Ø34cm</td>
                                    <td>HALF</br></td>
                                    <td>LARGE</br></td>
                                    <td>Small</br></td>
                                    <td>Classic</br> </td>
                                    <td>Small</br></td>
                                    <td>Small</br></td>
                               </tr>
                                <tr>
                                    <td>0.90 €</td>
                                    <td>2.00 €</td>
                                    <td>3.00 €</td>
                                    <td>2.50 €</td>
                                    <td>0.90 €</td>
                                    <td>1.00 €</td>
                                    <td>0.90 €</td>
                                    <td>1.00 €</td>
                                    <td>0.90 €</td>
                                    <td>0.90 €</td>
                                </tr>
                            </tbody>
                            </table>
						</div>
					</td>
								<td class="row_82">
									<div class="p5">2024-03-05 20:54:42</div>
					            </td>
									<td class="row_82" align="center">
										<div class="p5">
                                                                    <!-- Klickbares Symbol für den Kategoriestatus -->
                                                                    <a href="#" onclick="toggleActiveStatus(1)">
                                                                        <i id="lamp-1" class="bi bi-lightbulb-fill" width="26" height="26" fill="currentColor" style="color: rgb(231, 144, 14);"></i>
                                                                </a>                						</div>
				            	</td>
									<td class="row_82" align="left">
									    <div class="p5">
                                        <span><a href="javascript:void(0);" class="me-4" data-bs-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil color-muted"></i> </a><a href="javascript:void(0);" data-bs-toggle="tooltip" data-placement="top" title="btn-close"><i class="fa-solid fa-xmark text-danger"></i></a></span>
						                </div>
					            </td>
                            </tr>






                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /# card -->
                    </div>




                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->







@push('specific-scripts')

@endpush


@push('specific-css')

<style>
    /* CSS-Stil für das Dropdown-Menü */
    #mySelect {
        height: 150px; /* Höhe nach Bedarf ändern */
    }

    .flex-container {
    display: flex;
    justify-content: flex-start;
    flex-wrap: nowrap;
    flex-direction: row;
    align-items: center;
    }

</style>

@endpush

@endsection
