@extends('frontend.layouts.default')
@section('content')
    <!-- seitenabhengig css -->
    @push('specific-css')
        <link href="{{ asset('frontend/css/wizard.css') }}" rel="stylesheet">
    @endpush

    @include('frontend.includes.header-in-clearfix')



    <div class="hero_single inner_pages background-image" data-background="url({{ asset('frontend/img/submit_broker.jpg') }} )">
        <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-9 col-lg-10 col-md-8">
                        <h1>@autotranslate('Werde Teil unseres Erfolgs: Starte jetzt als freiberuflicher Verkäufer für MamasExpress!', app()->getLocale())</h1>
                        <p>@autotranslate('Flexible Arbeit, faire Verdienstmöglichkeiten', app()->getLocale())</p>
                        <a href="#apply" class="btn_1 gradient btn_scroll">@autotranslate('Jetzt Bewerben', app()->getLocale())</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="wave hero gray"></div>
    </div>

    <div class="bg_gray">
        <div class="container margin_30_40">
            <div class="main_title center">
                <span><em></em></span>
                <h2>@autotranslate('Warum mit uns arbeiten?', app()->getLocale())</h2>
                <p>@autotranslate('Profitiere von einer flexiblen und fairen Verdienstmöglichkeit', app()->getLocale())</p>
            </div>

            <div class="row justify-content-center add_bottom_45">
                <div class="col-lg-4 col-md-6">
                    <div class="box_topic submit">
                        <figure><img src="{{ asset('frontend/img/icon_submit_1.svg') }}" alt="" width="110" height="100"></figure>
                        <h3>@autotranslate('Dein Verdienst', app()->getLocale())</h3>
                        <p>Verdiene eine attraktive Provision für jede Bestellvermittlung eines geworbenen Restaurants.
                            Beispiel: Bei einer monatlichen Provision von 1.000 Euro pro Restaurant, erhältst du 300 Euro.
                            Werbe 5 Restaurants und du kannst monatlich 1.500 Euro verdienen!</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="box_topic submit">
                        <figure><img src="{{ asset('frontend/img/icon_submit_2.svg') }}" alt="" width="110" height="100"></figure>
                        <h3>@autotranslate('Arbeite flexibel', app()->getLocale())</h3>
                        <p>Bestimme selbst, wann und wo du arbeitest. Ideal für nebenberufliche Tätigkeit oder als
                            Hauptverdienstquelle.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="box_topic submit">
                        <figure><img src="{{ asset('frontend/img/icon_submit_3.svg') }}" alt="" width="110" height="100"></figure>
                        <h3>@autotranslate('Was du benötigst', app()->getLocale())</h3>
                        <p>Nutze deine lokalen Kontakte in Städten wie Frankfurt, München und anderen, um Restaurants für
                            Just Deliver zu gewinnen.</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="main_title center">
                        <h3 style="margin-bottom: 0;">@autotranslate('Häufige Fragen', app()->getLocale())</h3>
                        <p>Hier findest du Antworten auf häufig gestellte Fragen</p>
                    </div>

                    <div role="tablist" class="add_bottom_15 accordion_2" id="accordion_group">
                        <div class="card">
                            <div class="card-header" role="tab">
                                <h5>
                                    <a data-bs-toggle="collapse" href="#collapseOne" aria-expanded="true"><i
                                            class="indicator icon_minus-06"></i>@autotranslate('Einführung', app()->getLocale())</a>
                                </h5>
                            </div>

                            <div id="collapseOne" class="collapse show" role="tabpanel" data-bs-parent="#accordion_group">
                                <div class="card-body">
                                    <p>Profitiere von einer attraktiven Provisionsstruktur und flexiblen Arbeitszeiten.
                                        Erfahre, wie du mit Just Deliver erfolgreich werden kannst.</p>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header" role="tab">
                                <h5>
                                    <a class="collapsed" data-bs-toggle="collapse" href="#collapseTwo"
                                        aria-expanded="false">
                                        <i class="indicator icon_plus"></i>@autotranslate('Verdienstmöglichkeiten', app()->getLocale())
                                    </a>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" role="tabpanel" data-bs-parent="#accordion_group">
                                <div class="card-body">
                                    <p>Dein Verdienst richtet sich nach der Anzahl der geworbenen Restaurants und den von
                                        ihnen generierten Bestellungen. Beispiel: Bei einer monatlichen Provision von 1.000
                                        Euro pro Restaurant, erhältst du 300 Euro. Werbe 5 Restaurants und du kannst
                                        monatlich 1.500 Euro verdienen!</p>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header" role="tab">
                                <h5>
                                    <a class="collapsed" data-bs-toggle="collapse" href="#collapseThree"
                                        aria-expanded="false">
                                        <i class="indicator icon_plus"></i>@autotranslate('Flexibilität', app()->getLocale())
                                    </a>
                                </h5>
                            </div>
                            <div id="collapseThree" class="collapse" role="tabpanel" data-bs-parent="#accordion_group">
                                <div class="card-body">
                                    <p>Arbeite wann und wo du willst. Als freiberuflicher Verkäufer für Just Deliver
                                        bestimmst du deine Arbeitszeiten selbst und kannst flexibel auf deine Bedürfnisse
                                        eingehen.</p>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header" role="tab">
                                <h5>
                                    <a class="collapsed" data-bs-toggle="collapse" href="#collapseFour"
                                        aria-expanded="false">
                                        <i class="indicator icon_plus"></i>@autotranslate('Anforderungen', app()->getLocale())
                                    </a>
                                </h5>
                            </div>
                            <div id="collapseFour" class="collapse" role="tabpanel" data-bs-parent="#accordion_group">
                                <div class="card-body">
                                    <p>Um erfolgreich zu sein, benötigst du ein Fahrzeug (Fahrrad, Roller oder Auto) und ein
                                        Smartphone (iPhone oder Android). Nutze deine lokalen Kontakte, um Restaurants zu
                                        werben.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container margin_60_40" id="apply">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="main_title center">
                    <span><em></em></span>
                    <h2>@autotranslate('Jetzt Bewerben', app()->getLocale())</h2>
                    <p>@autotranslate('Hinweis: Du musst über 18 Jahre alt sein', app()->getLocale())</p>
                </div>

                <div id="wizard_container">
                    <div id="top-wizard">
                        <div id="progressbar"></div>
                    </div>
                    <form id="registration_form" action="{{ route('broker.register_handler') }}" method="POST">
                        <input id="website" name="website" type="text" value="">
                        <div id="middle-wizard">
                            <div class="step">
                                <h3 class="main_question"><strong>1/5</strong>@autotranslate('In welcher Stadt möchtest du arbeiten?', app()->getLocale())</h3>
                                <div class="form-group">
                                    <div class="custom_select clearfix">
                                        <select class="wide required" name="location">
                                            <option value="">@autotranslate('Deine Stadt', app()->getLocale())</option>
                                            <option value="Frankfurt">Frankfurt</option>
                                            <option value="München">München</option>
                                            <option value="Berlin">Berlin</option>
                                            <option value="Hamburg">Hamburg</option>
                                            <option value="Köln">Köln</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="step">
                                <h3 class="main_question"><strong>3/5</strong>Welche Fahrzeugart nutzt du?</h3>
                                <div class="form-group">
                                    <label class="container_radio version_2">Fahrrad
                                        <input type="radio" name="vehicle" value="Fahrrad" class="required">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="container_radio version_2">Roller
                                        <input type="radio" name="vehicle" value="Roller" class="required">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="container_radio version_2">Auto
                                        <input type="radio" name="vehicle" value="Auto" class="required">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <p>
                                    <strong><i class="icon_info"></i> Hinweis</strong><br>
                                    Du benötigst ein Fahrzeug (Fahrrad, Roller oder Auto) und ein Smartphone (iPhone oder
                                    Android), um als freiberuflicher Verkäufer erfolgreich zu sein.
                                </p>
                            </div>

                            <div class="step">
                                <h3 class="main_question"><strong>4/5</strong>Wie hast du von uns erfahren?</h3>
                                <div class="form-group">
                                    <label class="container_check version_2">Google-Suchmaschine
                                        <input type="checkbox" name="how_hear[]" value="Google-Suchmaschine"
                                            class="required">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="container_check version_2">Ein Freund von mir
                                        <input type="checkbox" name="how_hear[]" value="Ein Freund von mir"
                                            class="required">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="container_check version_2">Printwerbung
                                        <input type="checkbox" name="how_hear[]" value="Printwerbung" class="required">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="container_check version_2">Zeitung
                                        <input type="checkbox" name="how_hear[]" value="Zeitung" class="required">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="container_check version_2">Sonstiges
                                        <input type="checkbox" name="how_hear[]" value="Sonstiges" class="required">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>

                            <div class="submit step">
                                <h3 class="main_question"><strong>5/5</strong>Erzähle uns etwas über dich</h3>
                                <div class="form-group">
                                    <input type="text" name="firstname" class="form-control required"
                                        placeholder="Vor- und Nachname">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control required"
                                        placeholder="Deine E-Mail">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="telephone" class="form-control required"
                                        placeholder="Deine Telefonnummer">
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <input type="text" name="age" class="form-control required"
                                                placeholder="Alter">
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="form-group radio_input">
                                            <label class="container_radio">Männlich
                                                <input type="radio" name="gender" value="Männlich" class="required">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="container_radio">Weiblich
                                                <input type="radio" name="gender" value="Weiblich" class="required">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group terms">
                                    <label class="container_check">Bitte akzeptiere unsere <a href="#"
                                            data-bs-toggle="modal" data-bs-target="#terms-txt">Allgemeinen
                                            Geschäftsbedingungen</a>
                                        <input type="checkbox" name="terms" value="Ja" class="required">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div id="bottom-wizard">
                            <button type="button" name="backward" class="backward">Zurück</button>
                            <button type="button" name="forward" class="forward">Weiter</button>
                            <button type="submit" name="process" class="submit">Absenden</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


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

        <!-- SPECIFIC SCRIPTS -->
        <script src="{{ asset('frontend/js/wizard/wizard_scripts.js') }}"></script>
        <script src="{{ asset('frontend/js/wizard/wizard_func.js') }}"></script>
    @endpush
@endsection
