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
                        <h1>Bug-Zilla Sicherheitsüberprüfung</h1>
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
                        <h4>Melden von Sicherheitslücken</h4>
                        <p style="text-align:left; font-size:18px;">
                            Bei MamasExpress sind wir bestrebt, unseren Kunden Technologien und Dienste zu bieten, die ihre Essensmomente optimieren. Gleichzeitig legen wir großen Wert darauf, unsere Kunden und Partner vor den vielfältigen Cybersicherheitsbedrohungen zu schützen.
                        </p>

                        <p style="text-align:left; font-size:18px;">Deshalb laden wir Sicherheitsexperten aus allen Bereichen ein, unsere Sicherheitsvorkehrungen objektiv und professionell zu prüfen. Ihr Ziel ist es, mögliche Schwachstellen zu identifizieren und uns zu helfen, die Sicherheit unserer Plattform kontinuierlich zu verbessern.</p>
                <p style="text-align:left; font-size:18px;">Das Bug-Zilla-Programm und die damit verbundenen Belohnungen gelten ausschließlich für die Entdeckung und Meldung von Sicherheitslücken. Sollten Sie auf andere Probleme oder Fragen bezüglich unserer Website stoßen, besuchen Sie bitte unsere Hilfeseiten.</p>
                </div>
                </div>
            </div>


        </div>
    </div>


    <div class="shape_element_2">
        <div class="container margin_60_0">
            <div class="row justify-content-center">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box_info_1 pr-lg-3">
                                <div class="wrapper_img">
                                    <figure><img src="{{ asset('frontend/img/lazy-placeholder-600-400.png') }}" data-src="{{ asset('frontend/img/submit_restaurant_home.jpg') }}" alt="" class="img-fluid lazy"></figure><span></span>
                                </div>
                                <h3>@autotranslate('Add Your Restaurant', app()->getLocale())</h3>
                                <p>@autotranslate('Willkommen in unserem Netzwerk! Hier haben Sie die Möglichkeit, Ihr Restaurant schnell und einfach hinzuzufügen. Schließen Sie sich uns an und profitieren Sie von zahlreichen Vorteilen.', app()->getLocale())</p>
                                <p><a href="{{ route('seller.register') }}" class="btn_1 medium gradient pulse_bt mt-2">@autotranslate('Tragen Sie Ihr Restaurant ein', app()->getLocale())</a>
                                    <a href="{{ route('broker.register') }}" class="btn_1 medium gradient pulse_bt mt-2">@autotranslate('Become a broker', app()->getLocale())</a></p>
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="box_info_1 pl-lg-3">
                                <div class="wrapper_img">
                                    <figure><img src="{{ asset('frontend/img/lazy-placeholder-600-400.png') }}" data-src="{{ asset('frontend/img/submit_rider_home.jpg') }}" alt="" class="img-fluid lazy"></figure><span></span>
                                </div>
                                <h3>@autotranslate('Already a partner', app()->getLocale())</h3>
                                <p>@autotranslate('Wenn Sie bereits ein Partner sind, können Sie sich hier einloggen und auf das Partnercenter oder das Broker-Portal zugreifen.', app()->getLocale())</p>
                                <p><a href="{{ route('seller.login') }}" class="btn_1 medium gradient pulse_bt mt-2">@autotranslate('Partnercenter', app()->getLocale())</a>
                                <a href="{{ route('broker.login') }}" class="btn_1 medium gradient pulse_bt mt-2">@autotranslate(' Broker Portal ', app()->getLocale())</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>



</main>









@push('specific-scripts')


@endpush
@endsection
