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

                                        <button type="button" class="btn btn-primary" wire:click="toggleCreateForm">
                                            <span class="btn-icon-start text-info"><i class="fa fa-plus color-info"></i></span>
                                            {{ app(\App\Services\TranslationService::class)->trans('Add Bottles deposit', app()->getLocale()) }}
                                        </button>

                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">

                                    <table id="example3" class="display" style="min-width: 845px">
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
                                            <td> €{{ number_format($bottle->bottles_value, 2, '.', ',') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($bottle->bottles_date)->format('d.m.Y') }}</td>
                                            <td>
                                                <i class="bi bi-lightbulb-fill" fill="currentColor" style="color: rgb(231, 144, 14);"></i>
                                            </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                                <a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
<tr>
    <td colspan="4">
        <span class="text-danger">Kein Flaschen und Kistenpfand gefunden!!!</span>

    </td>
</tr>
                                    @endforelse


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">@yield('pageTitle') bearbeiten</h4>
                            </div>
                            <div class="card-body">
                                <!-- Nav tabs -->

                                <div class="basic-form">
                                    <form>
                                        <div class="row">
                                        <div class="mb-3 col-md-2">
                                            <label class="form-label">Number:</label>
                                            <input type="text" class="form-control input-default " placeholder="Number">
                                        </div>
                                        <div class="mb-3 col-md-5">
                                            <label class="form-label">Art der Zusatzstoffe:</label>
                                            <input type="text" class="form-control input-default " placeholder="Number">
                                        </div>

                                        <div class="mb-3 col-md-5">
                                            <label class="form-label">Auf der Speisekarte:</label>
                                            <input type="text" class="form-control input-default " placeholder="Number">
                                        </div>

                                        </div>

                                        <div class="row">
                                            <div class="mb-3 col-md-12">
                                                <label class="form-label">Beispiele:</label>
                                                <textarea class="form-control h-auto" rows="4" id="comment"></textarea>
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                            <button type="submit" class="btn btn-secondary">Cancel changes</button>
                                        </div>
                                    </form>

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
