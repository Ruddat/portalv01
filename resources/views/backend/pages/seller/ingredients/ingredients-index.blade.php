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
						<li class="breadcrumb-item"><a href="javascript:void(0)">Bootstrap</a></li>
					</ol>
                </div>
                <!-- row -->

                <div class="row">


					<div class="col-xl-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Textarea</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form>
                                        <div class="mb-3">
                                            <textarea class="form-control h-auto" rows="4" id="comment"></textarea>
                                        </div>

                                        <div class="row align-items-center">
                                            <div class="mb-3">
                                                <label class="me-sm-12">Preference</label>
                                                <select class="me-sm-12 default-select form-control wide ms-0" id="inlineFormCustomSelect">
                                                    <option selected>Choose...</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                    <option value="4">Four</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row align-items-center">
                                            <div class="mb-3">
                                                <label class="me-sm-12">Preference</label>
<!-- Standard-Select-Element -->
<select class="me-sm-12 multi-select form-control wide ms-0" id="mySelect" multiple>
    <option value="1">One</option>
    <option value="2">Two</option>
    <option value="3">Three</option>
    <option value="4">Four</option>
    <option value="1">One</option>
    <option value="2">Two</option>
    <option value="3">Three</option>
    <option value="4">Four</option>
    <option value="1">One</option>
    <option value="2">Two</option>
    <option value="3">Three</option>
    <option value="4">Four</option>
    <option value="1">One</option>
    <option value="2">Two</option>
    <option value="3">Three</option>
    <option value="4">Four</option>
</select>
                                            </div>
                                        </div>


                                    </form>
                                </div>
                            </div>
                        </div>
					</div>



                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Table Hover</h4>
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
                                            <span id="published_53113" class="published-item"><a title="deaktivieren"><img src="http://just-deliver.de/manager/assets/images/icons/on.png" alt="deaktivieren" border="0"></a></span>

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
								<span id="published_53152" class="published-item"><a title="deaktivieren"><img src="http://just-deliver.de/manager/assets/images/icons/on.png" alt="deaktivieren" border="0"></a></span>
                						</div>
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
								<span id="published_53152" class="published-item"><a title="deaktivieren"><img src="http://just-deliver.de/manager/assets/images/icons/on.png" alt="deaktivieren" border="0"></a></span>
                						</div>
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







        <script>
            // JavaScript-Code zur dynamischen Anpassung der Höhe des Dropdown-Menüs
            window.addEventListener('load', function() {
                var selectElement = document.getElementById('mySelect');
                var optionCount = selectElement.options.length;
                var defaultOptionHeight = 30; // Standardhöhe für eine Option in Pixeln
                var maxHeight = 400; // Maximal zulässige Höhe in Pixeln

                // Berechnen der Höhe basierend auf der Anzahl der Optionen
                var height = Math.min(optionCount * defaultOptionHeight, maxHeight);

                // Setzen der berechneten Höhe als Höhe des Dropdown-Menüs
                selectElement.style.height = height + 'px';
            });
        </script>







@push('specific-scripts')
@endpush


@push('specific-css')

<style>
    /* CSS-Stil für das Dropdown-Menü */
    #mySelect {
        height: 150px; /* Höhe nach Bedarf ändern */
    }
</style>

@endpush

@endsection
