@extends('frontend.layouts.default')
@section('content')
    <!-- seitenabhengig css -->
    @push('specific-css')
        <link href="{{ asset('frontend/css/submit.css') }}" rel="stylesheet">
        <style>
/* Stil für die Ladeanimation */
#loadingAnimation {
  display: none; /* Startet unsichtbar */
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
  background-color: #fff; /* Hintergrundfarbe ohne Transparenz */
  padding: 20px; /* Platz um den Text */
  border-radius: 10px; /* Abrundung der Ecken */
  z-index: 9999; /* Stellen Sie sicher, dass es über anderen Elementen liegt */
}

/* Stil für den Text in der Ladeanimation */
.loadingText {
  font-size: 16px;
  color: #333; /* Schwarzer Text */
}

/* Stil für das animierte Element */
#loadingAnimation::after {
  content: "";
  display: block;
  width: 40px;
  height: 40px;
  margin: 20px auto;
  border-radius: 50%;
  border: 5px solid #3498db; /* Blauer Rand */
  border-top: 5px solid #fff; /* Weißer Rand oben */
  animation: spin 1s linear infinite; /* Rotation */
}

/* Animation für die Rotation */
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}



        </style>
    @endpush

    <body>

        @include('frontend.includes.header-in-clearfix')


        <div class="hero_single inner_pages background-image"
            data-background="url({{ asset('frontend/img/home_section_2.jpg)') }}">
            <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <h1>@autotranslate('Acquire Customers Made Easy!', app()->getLocale())
                            </h1>
                            <p>@autotranslate('Attractive strategies for acquiring new customers.', app()->getLocale())
                            </p>
                            <a href="#submit"
                                class="btn_1 gradient btn_scroll">@autotranslate('Simple! Instantly online.', app()->getLocale())</a>
                        </div>
                    </div>
                    <!-- /row -->
                </div>
            </div>
            <div class="wave hero"></div>
        </div>
        <!-- /hero_single -->

        <div class="container margin_30_20">
            <div class="main_title center">
                <span><em></em></span>
                <h2>@autotranslate('Why you should showcase your restaurant on MamasExpress', app()->getLocale())

                </h2>
                <p>@autotranslate('Transparent, instantly online, effortless handling for more enjoyment.', app()->getLocale())
                </p>
            </div>
            @include('backend.includes.errorflash')
            <div class="row justify-content-center align-items-center add_bottom_15">
                <div class="col-lg-6">
                    <div class="box_about">
                        <h3>{{ app(\App\Services\TranslationService::class)->trans('Boost your Orders', app()->getLocale()) }}
                        </h3>
                        <p class="lead">Est falli invenire interpretaris id, magna libris sensibus mel id.</p>
                        <p>Per eu nostrud feugiat. Et quo molestiae persecuti neglegentur. At zril definitionem mei, vel ei
                            choro volumus. An tota nulla soluta has, ei nec essent audiam, te nisl dignissim vel. Ex velit
                            audire perfecto pro, ei mei doming vivendo legendos. Cu sit magna zril, an odio delectus
                            constituto vis. Vis ludus omnesque ne, est veri quaeque ad.</p>
                        <img src="{{ asset('frontend/img/arrow_about.png') }}" alt="" class="arrow_1">
                    </div>
                </div>
                <div class="col-lg-6 text-center d-none d-lg-block">
                    <img src="{{ asset('frontend/img/about_1.svg') }}" alt="" class="img-fluid" width="250"
                        height="250">
                </div>

            </div>
            <!-- /row -->
            <div class="row justify-content-center align-items-center add_bottom_15">
                <div class="col-lg-6 text-center d-none d-lg-block">
                    <img src="{{ asset('frontend/img/about_2.svg') }}" alt="" class="img-fluid" width="250"
                        height="250">
                </div>
                <div class="col-lg-6">
                    <div class="box_about">
                        <h3>@autotranslate('Manage Easly', app()->getLocale())
                        </h3>
                        <p class="lead">Est falli invenire interpretaris id, magna libris sensibus mel id.</p>
                        <p>Per eu nostrud feugiat. Et quo molestiae persecuti neglegentur. At zril definitionem mei, vel ei
                            choro volumus. An tota nulla soluta has, ei nec essent audiam, te nisl dignissim vel. Ex velit
                            audire perfecto pro, ei mei doming vivendo legendos. Cu sit magna zril, an odio delectus
                            constituto vis. Vis ludus omnesque ne, est veri quaeque ad.</p>
                        <img src="{{ asset('frontend/img/arrow_about.png') }}" alt="" class="arrow_2">
                    </div>
                </div>
            </div>
            <!-- /row -->
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-6">
                    <div class="box_about">
                        <h3>@autotranslate('Reach New Customers', app()->getLocale())</h3>
                        <p class="lead">Est falli invenire interpretaris id, magna libris sensibus mel id.</p>
                        <p>Per eu nostrud feugiat. Et quo molestiae persecuti neglegentur. At zril definitionem mei, vel ei
                            choro volumus. An tota nulla soluta has, ei nec essent audiam, te nisl dignissim vel. Ex velit
                            audire perfecto pro, ei mei doming vivendo legendos. Cu sit magna zril, an odio delectus
                            constituto vis. Vis ludus omnesque ne, est veri quaeque ad.</p>
                    </div>

                </div>
                <div class="col-lg-6 text-center d-none d-lg-block">
                    <img src="{{ asset('frontend/img/about_3.svg') }}" alt="" class="img-fluid" width="250"
                        height="250">
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->



        <div class="container margin_60_20" id="submit">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="text-center add_bottom_15">
                        <h4>@autotranslate('Simply fill out the form below!', app()->getLocale())
                        </h4>
                        <p>Id persius indoctum sed, audiam verear his in, te eum quot comprehensam. Sed impetus vocibus
                            repudiare et.</p>
                    </div>
                    <div id="message-register"></div>

                    <form id="registration_form" action="{{ route('seller.register_handler') }}" method="POST">
                        @csrf
                        <input type="hidden" name="robot_check" value="">
                        <input type="hidden" name="bot_trap" value="">

                        <h6>Personal data</h6>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{ old('name_register') }}"
                                        placeholder="@autotranslate('Name and Last Name', app()->getLocale())" name="name_register" id="name_register">
                                </div>
                                @error('name_register')
                                    <div class="d-block text-danger" style="margin-top: -15px; margin-bottom: 15px;">
                                        {{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- /row -->
                        <div class="row add_bottom_15">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <input type="email" class="form-control" value="{{ old('email_register') }}"
                                        placeholder="@autotranslate('Email Address', app()->getLocale())" name="email_register" id="email_register">
                                </div>
                                @error('email_register')
                                    <div class="d-block text-danger" style="margin-top: -15px; margin-bottom: 15px;">
                                        {{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- /row -->
                        <h6>@autotranslate('Restaurant data', app()->getLocale())
                        </h6>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{ old('restaurantname_register') }}"
                                        placeholder="@autotranslate('Restaurant Name', app()->getLocale())"
                                        name="restaurantname_register" id="restaurantname_register">
                                </div>
                                @error('restaurantname_register')
                                    <div class="d-block text-danger" style="margin-top: -15px; margin-bottom: 15px;">
                                        {{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- /row -->
                        <div class="row">

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{ old('address_register') }}"
                                        placeholder="@autotranslate('Street and Number', app()->getLocale())" name="address_register" id="address_register">
                                </div>
                                @error('address_register')
                                    <div class="d-block text-danger" style="margin-top: -15px; margin-bottom: 15px;">
                                        {{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="row add_bottom_15">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{ old('city_register') }}"
                                        placeholder="@autotranslate('City', app()->getLocale())" name="city_register" id="city_register">
                                </div>
                                @error('name_register')
                                    <div class="d-block text-danger" style="margin-top: -15px; margin-bottom: 15px;">
                                        {{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{ old('zip_register') }}"
                                        placeholder="Zip" name="zip_register" id="zip_register">
                                </div>
                                @error('zip_register')
                                    <div class="d-block text-danger" style="margin-top: -15px; margin-bottom: 15px;">
                                        {{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}</div>
                                @enderror
                            </div>
                        </div>



                        <!-- /row -->
                        <div class="row add_bottom_15">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="custom_select submit">
                                        <select name="country_register" id="country_register" class="form-control wide">
                                            <option value="">
                                                {{ app(\App\Services\TranslationService::class)->trans('Country', app()->getLocale()) }}
                                            </option>
                                            <option value="Europe" @if (old('country_register') == 'Europe') selected @endif>Europe
                                            </option>

                                            </select>




                                    </div>
                                    @error('country_register')
                                        <div class="d-block text-danger" style="margin-top: -15px; margin-bottom: 15px;">
                                            {{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- /row -->
                        <div class="form-group text-center">
                            <input type="submit" id="registerButton" class="btn_1 gradient"
                                value="{{ app(\App\Services\TranslationService::class)->trans('Restaurant Anmelden', app()->getLocale()) }}">
                        </div>
                    </form>
                    <!-- /registration_form -->
                    <div id="loadingAnimation">
                        <div class="loadingText">@autotranslate('Data gets sorted, and a shop is set up...', app()->getLocale())</div>
                    </div>

                </div>
            </div>
        </div>
        <!-- /container -->

        @push('specific-scripts')
            <script>
                // Falls Validierungsfehler vorliegen, scrolle zum Formular
                @if ($errors->any())
                    document.getElementById('registration_form').scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                @endif

                // Event-Listener für den Registrierungs-Button hinzufügen
                document.getElementById('registerButton').addEventListener('click', function() {
                    // Ladeanimation anzeigen
                    document.getElementById('loadingAnimation').style.display = 'block';
                });
            </script>
        @endpush
    @endsection
