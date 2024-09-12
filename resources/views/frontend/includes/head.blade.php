<head>
    <meta charset="utf-8">
    <x-meta-tags :description="$metaDescription ?? null" :keywords="$metaKeywords ?? null" :ogTitle="$ogTitle ?? null" :ogDescription="$ogDescription ?? null" :ogImage="$ogImage ?? null"
        :title="$title ?? null" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
    $locales = ['de', 'en', 'fr', 'es', 'ru']; // Verfügbare Sprachen
    $defaultLocale = 'de'; // Standardsprache

    // Aktuelle URL ohne Query-Parameter
    $currentUrl = url()->current();

    // Der aktuelle Sprachcode (Segment 1 in der URL)
    $currentLocale = request()->segment(1);

    // Überprüfe, ob der aktuelle Sprachcode gültig ist
    if (!in_array($currentLocale, $locales)) {
        $currentLocale = $defaultLocale; // Setze auf die Standardsprache
    }

    // Entferne den aktuellen Sprachcode aus der URL
    $baseUrl = preg_replace('/^\/'.preg_quote($currentLocale, '/').'/', '', parse_url($currentUrl, PHP_URL_PATH));

    // Erzeuge die Basis-URL für den x-default-Eintrag mit der Standardsprachpräfix
    $defaultUrl = url('/' . $defaultLocale . '/' . ltrim($baseUrl, '/'));
@endphp

@foreach($locales as $locale)
    @php
        // Erstelle die URL für jede Sprache
        $newUrl = url('/' . $locale . '/' . ltrim($baseUrl, '/'));
    @endphp
    <link rel="alternate" href="{{ $newUrl }}" hreflang="{{ $locale }}" />
@endforeach

<!-- Optionaler Default-Eintrag -->
<link rel="alternate" href="{{ $defaultUrl }}" hreflang="x-default" />





    <!-- Favicons-->
    @if (!empty(get_settings()->site_favicon))
        <link rel="shortcut icon" href="/images/site/{{ get_settings()->site_favicon }}" type="image/x-icon">
    @else
        <link rel="shortcut icon" href="{{ asset('frontend/img/favicon.ico') }}" type="image/x-icon">
    @endif
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <link rel="apple-touch-icon" type="image/x-icon"
        href="{{ asset('frontend/img/apple-touch-icon-57x57-precomposed.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72"
        href="{{ asset('frontend/img/apple-touch-icon-72x72-precomposed.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114"
        href="{{ asset('frontend/img/apple-touch-icon-114x114-precomposed.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144"
        href="{{ asset('frontend/img/apple-touch-icon-144x144-precomposed.png') }}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <!-- GOOGLE WEB FONT -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- BASE CSS -->
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">

    <!-- SPECIFIC CSS -->
    @stack('specific-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    @stack('head-script')
    <!-- YOUR CUSTOM CSS -->
    <link href="{{ asset('frontend/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/feather.css') }}" rel="stylesheet">
    @cookieconsentscripts

    <!-- Styles -->
    @livewireStyles
    <style>
        #install-instructions {
            display: none;
            background: #f8f8f8;
            padding: 10px;
            border: 1px solid #ccc;
        }
    </style>

    <!-- JavaScript zur dynamischen Setzung des start_url -->
    <script>
        // Funktion zur Extraktion des Shop-Slugs aus der aktuellen URL
        function getStartUrl() {
            // Beispiel: Aktuelle URL extrahieren
            var currentUrl = window.location.href;

            // Hier kannst du die Logik anpassen, um den gewünschten Teil der URL zu extrahieren
            // Zum Beispiel: Extraktion des Shop-Slugs aus der URL (angepasst an deine URL-Struktur)
            var shopSlug = currentUrl.split('/').pop();

            // Aufbau der URL für den start_url im manifest.json
            var startUrl = '/shop/' + shopSlug; // Hier die Logik für deine URL-Konstruktion einfügen

            return startUrl;
        }

        // Dynamisches Setzen des manifest.json-Links
        var manifestLink = document.createElement('link');
        manifestLink.rel = 'manifest';
        manifestLink.href = '/manifest.json';
        document.head.appendChild(manifestLink);
    </script>


</head>
