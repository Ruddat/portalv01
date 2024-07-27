<footer>

    <div class="container margin_60_40 fix_mobile">

        <livewire:frontend.footer-infos.footer-component/>
        <hr>
        <div class="row add_bottom_25">
            <div class="col-lg-6">
                <ul class="footer-selector clearfix">
                    <li>
                        <div class="styled-select lang-selector">
                            <select class="change_lang">
                                <option value="de" {{ session('locale') == 'de' ? 'selected' : '' }}>Deutsch</option>
                                <option value="en" {{ session('locale') == 'en' ? 'selected' : '' }}>English</option>
                                <option value="nl" {{ session('locale') == 'nl' ? 'selected' : '' }}>Niederländisch</option>
                                <option value="fr" {{ session('locale') == 'fr' ? 'selected' : '' }}>French</option>
                                <option value="es" {{ session('locale') == 'es' ? 'selected' : '' }}>Spanish</option>
                                <option value="ru" {{ session('locale') == 'ru' ? 'selected' : '' }}>Russian</option>
                                <option value="ar" {{ session('locale') == 'ar' ? 'selected' : '' }}>Arabisch</option>
                                <option value="fa" {{ session('locale') == 'fa' ? 'selected' : '' }}>Persisch</option>
                                <option value="pl" {{ session('locale') == 'pl' ? 'selected' : '' }}>Polnisch</option>
                                <option value="tr" {{ session('locale') == 'tr' ? 'selected' : '' }}>Türkisch</option>
                                <option value="uk" {{ session('locale') == 'uk' ? 'selected' : '' }}>Ukrainisch</option>
                            </select>
                        </div>
                    </li>
                    <li>
                        <div class="styled-select currency-selector">
                            <select>
                                <option value="US Dollars">US Dollars</option>
                                <option value="Euro" selected>Euro</option>
                            </select>
                        </div>
                    </li>
                    <li><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="{{ asset('frontend/img/cards_all.svg') }}" alt="" width="230" height="35" class="lazy"></li>
                </ul>
            </div>
            <div class="col-lg-6">
                <ul class="additional_links">
                    <li><a href="/impressum">{{ app(\App\Services\AutoTranslationService::class)->trans('Impressum', app()->getLocale()) }}</a></li>
                    <li><a href="#0">{{ app(\App\Services\AutoTranslationService::class)->trans('Terms and conditions', app()->getLocale()) }}</a></li>
                    <li><a href="#0">{{ app(\App\Services\AutoTranslationService::class)->trans('Privacy', app()->getLocale()) }}</a></li>
                    <li><a href="/media-stats">@autotranslate('Media Data', app()->getLocale())</a></li>
                    <li><span>© {{ config('app.name') }}</span></li>
                </ul>
            </div>


            <div class="footer-copyright py-3">
                <div class="container d-flex align-items-center">
                <p class="mb-0"> © 2023 {{ config('app.name') }} @autotranslate('All rights reserved', app()->getLocale())</p>
                <p class="text-muted mb-0 ms-auto d-flex align-items-center">


                <a href="#" class="d-block"><img alt="#" src="{{ asset('frontend/img/appstore.png') }}" height="40"></a>

                <button id="install-button" style="display: none; border: none; background: none;">
                    <img src="{{ asset('frontend/img/playmarket.png') }}" alt="Install Icon" style="height: 40px;">
                </button>
                </p>
                </div>
                </div>


            </div>




            <div id="install-instructions" style="display: none;">
                <p>Um die App zu installieren, tippe auf <strong>Teilen</strong> und dann auf <strong>Zum Startbildschirm hinzufügen</strong>.</p>
            </div>

            <script>
                if ('serviceWorker' in navigator) {
                    navigator.serviceWorker.register('/serviceworker.js')
                        .then(function(registration) {
                            console.log('Service Worker registriert mit Scope:', registration.scope);
                        }).catch(function(error) {
                            console.log('Service Worker Registrierung fehlgeschlagen:', error);
                        });
                }

                let deferredPrompt;

                window.addEventListener('beforeinstallprompt', (e) => {
                    console.log('beforeinstallprompt Event ausgelöst');
                    e.preventDefault();
                    deferredPrompt = e;
                    document.getElementById('install-button').style.display = 'block';
                });

                window.addEventListener('appinstalled', (event) => {
                    console.log('PWA wurde installiert');
                });

                document.getElementById('install-button').addEventListener('click', (e) => {
                    document.getElementById('install-button').style.display = 'none';
                    if (deferredPrompt) {
                        deferredPrompt.prompt();
                        deferredPrompt.userChoice.then((choiceResult) => {
                            if (choiceResult.outcome === 'accepted') {
                                console.log('Benutzer hat die Installation akzeptiert');
                            } else {
                                console.log('Benutzer hat die Installation abgelehnt');
                            }
                            deferredPrompt = null;
                        });
                    }
                });

                // Überprüfung, ob das Gerät ein iOS-Gerät ist (iPhone oder iPad)
                const isIos = () => {
                    const userAgent = window.navigator.userAgent.toLowerCase();
                    return /iphone|ipad|ipod/.test(userAgent);
                };

                // Überprüfung, ob die App bereits als PWA installiert ist
                const isInStandaloneMode = () => ('standalone' in window.navigator) && (window.navigator.standalone);

                // Wenn das Gerät ein iOS-Gerät ist und die App nicht im Standalone-Modus ist, zeige die Installationsanweisungen
                if (isIos() && !isInStandaloneMode()) {
                    document.getElementById('install-instructions').style.display = 'block';
                }

                // Dynamisch das Manifest erstellen und einfügen
                const dynamicManifest = {
                    name: "Mamas Express",
                    short_name: "Express",
                    start_url: window.location.origin + window.location.pathname,
                    display: "standalone",
                    background_color: "#ffffff",
                    theme_color: "#000000",
                    icons: [
                        {
                            src: window.location.origin + "/frontend/img/apple-touch-icon-57x57-precomposed.png",
                            sizes: "57x57",
                            type: "image/png"
                        },
                        {
                            src: window.location.origin + "/frontend/img/apple-touch-icon-114x114-precomposed.png",
                            sizes: "114x114",
                            type: "image/png"
                        }
                    ]
                };

                const stringManifest = JSON.stringify(dynamicManifest);
                const blob = new Blob([stringManifest], {type: 'application/json'});
                const manifestURL = URL.createObjectURL(blob);
                document.querySelector('link[rel="manifest"]').setAttribute('href', manifestURL);
            </script>




        </div>
    </div>
</footer>

@cookieconsentview
<!--/footer-->

@stack('scripts')

