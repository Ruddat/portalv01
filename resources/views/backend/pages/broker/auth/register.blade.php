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
                        <p>@autotranslate('Verdiene eine attraktive Provision für jede Bestellvermittlung eines geworbenen Restaurants.
                            Beispiel: Bei einer monatlichen Provision von 1.000 Euro pro Restaurant, erhältst du 300 Euro.
                            Werbe 5 Restaurants und du kannst monatlich 1.500 Euro verdienen!', app()->getLocale())</p>
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
                    <h2>Jetzt Bewerben</h2>
                    <p>Hinweis: Du musst über 18 Jahre alt sein</p>
                </div>

                <div id="wizard_container">
                    <div id="top-wizard">
                        <div id="progressbar"></div>
                    </div>
                    @livewire('backend.broker.broker-registration')

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


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



    @endpush
@endsection
