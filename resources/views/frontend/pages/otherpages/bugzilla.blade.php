@extends('frontend.layouts.default')
@section('content')


    <!-- seitenabhengig css -->
    @push('specific-css')
        <link href="{{ asset('frontend/css/wizard.css') }}" rel="stylesheet">
    @endpush

    <body id="register_bg">

        @include('frontend.includes.header-clearfix-element-to-stick')


<main>
    <div class="hero_single inner_pages background-image" data-background="url({{ asset('frontend/img/hero_general_2.jpg') }})">
        <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-9 col-lg-10 col-md-8">
                        <h1>@autotranslate('Bug-Zilla Sicherheitsüberprüfung', app()->getLocale())</h1>
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
                <h2>MamasExpress</h2>
                <p>@autotranslate('Bug-Zilla-Programm zur Sicherheitsüberprüfung', app()->getLocale())</p>
            </div>

            <div class="row justify-content-center add_bottom_45">
                <div class="col-lg-12 col-md-6">
                    <div class="box_topic submit">
                        <figure><img src="{{ asset('frontend/img/bug-zilla.png') }}" alt="" width="110" height="100"></figure>
                        <h3>@autotranslate('Bug-Zilla-Programm zur Sicherheitsüberprüfung', app()->getLocale())</h3>
                        <h4>@autotranslate('Melden von Sicherheitslücken', app()->getLocale())</h4>
                        <p style="text-align:left; font-size:18px;">
                            Bei MamasExpress sind wir bestrebt, unseren Kunden Technologien und Dienste zu bieten, die ihre Essensmomente optimieren. Gleichzeitig legen wir großen Wert darauf, unsere Kunden und Partner vor den vielfältigen Cybersicherheitsbedrohungen zu schützen.
                        </p>

                        <p style="text-align:left; font-size:18px;">@autotranslate('Deshalb laden wir Sicherheitsexperten aus allen Bereichen ein, unsere Sicherheitsvorkehrungen objektiv und professionell zu prüfen. Ihr Ziel ist es, mögliche Schwachstellen zu identifizieren und uns zu helfen, die Sicherheit unserer Plattform kontinuierlich zu verbessern.', app()->getLocale())</p>
                <p style="text-align:left; font-size:18px;">@autotranslate('Das Bug-Zilla-Programm und die damit verbundenen Belohnungen gelten ausschließlich für die Entdeckung und Meldung von Sicherheitslücken. Sollten Sie auf andere Probleme oder Fragen bezüglich unserer Website stoßen, besuchen Sie bitte unsere Hilfeseiten.', app()->getLocale())</p>
                </div>
                </div>
            </div>


        </div>
    </div>





    @include('frontend.includes.page-snipped.broker-seller')


</main>









@push('specific-scripts')


@endpush
@endsection
