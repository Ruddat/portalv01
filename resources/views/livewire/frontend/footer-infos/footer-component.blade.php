        <div class="row">


    <!-- Cuisines Section -->
    <div class="col-lg-3 col-md-6">
        <h3 data-bs-target="#collapse_3">{{ app(\App\Services\AutoTranslationService::class)->trans('Cuisines', app()->getLocale()) }}</h3>
        <div class="collapse dont-collapse-sm links" id="collapse_3">
            <ul>
                @foreach($cuisines as $cuisine)
                    <li>{{ app(\App\Services\AutoTranslationService::class)->trans($cuisine->name, app()->getLocale()) }}</li>
                @endforeach
            </ul>
        </div>
    </div>

            <div class="col-lg-3 col-md-6">
                <h3 data-bs-target="#collapse_2">{{ app(\App\Services\AutoTranslationService::class)->trans('Brands', app()->getLocale()) }}</h3>
                <div class="collapse dont-collapse-sm links" id="collapse_2">
                    <ul>
                        @foreach($restaurants as $restaurant)
                            <li>
                                <a href="{{ url('restaurant/' . ($restaurant->shop_slug ?? $restaurant->id)) }}">
                                    {{ app(\App\Services\AutoTranslationService::class)->trans($restaurant->title, app()->getLocale()) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>


   <!-- Unique Cities Section -->
    <div class="col-lg-3 col-md-6">
        <h3 data-bs-target="#collapse_4">{{ app(\App\Services\AutoTranslationService::class)->trans('Cities', app()->getLocale()) }}</h3>
        <div class="collapse dont-collapse-sm links" id="collapse_4">
            <ul>
                @foreach($uniqueCities as $city)
                    <li>
                        <a href="{{ url('restaurant/' . $city->shop_slug) }}">
                            {{ app(\App\Services\AutoTranslationService::class)->trans('Essenslieferung in', app()->getLocale()) }} {{ app(\App\Services\AutoTranslationService::class)->trans($city->city, app()->getLocale()) }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

            <div class="col-lg-3 col-md-6">
                <h3 data-bs-target="#collapse_1">{{ app(\App\Services\AutoTranslationService::class)->trans('Über uns', app()->getLocale()) }}</h3>
                <div class="collapse dont-collapse-sm links" id="collapse_1">
                    <ul>
                        <li><a href="about.html">{{ app(\App\Services\AutoTranslationService::class)->trans('About us', app()->getLocale()) }}</a></li>
                        <li><a href="{{ route('broker.register') }}">{{ app(\App\Services\AutoTranslationService::class)->trans('Geld verdienen', app()->getLocale()) }}</a></li>
                        <li><a href="{{ route('seller.register') }}">{{ app(\App\Services\AutoTranslationService::class)->trans('Restaurant anmelden', app()->getLocale()) }}</a></li>
                        <li><a href="help.html">{{ app(\App\Services\AutoTranslationService::class)->trans('Help', app()->getLocale()) }}</a></li>
                        <li><a href="{{ url('/bugzilla') }}">{{ app(\App\Services\AutoTranslationService::class)->trans('Bug-Zilla', app()->getLocale()) }}</a></li>
                        <li><a href="contacts.html">@autotranslate('Contact', app()->getLocale())</a></li>
                    </ul>
                </div>
            </div>



        </div>
        <!-- /row-->
