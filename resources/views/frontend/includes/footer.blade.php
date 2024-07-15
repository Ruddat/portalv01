<footer>

    <div class="container margin_60_40 fix_mobile">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <h3 data-bs-target="#collapse_1">{{ app(\App\Services\AutoTranslationService::class)->trans('Quick Links', app()->getLocale()) }}</h3>
                <div class="collapse dont-collapse-sm links" id="collapse_1">
                    <ul>
                        <li><a href="about.html">{{ app(\App\Services\AutoTranslationService::class)->trans('About us', app()->getLocale()) }}</a></li>
                        <li><a href="{{ route('broker.register') }}">{{ app(\App\Services\AutoTranslationService::class)->trans('Geld verdienen', app()->getLocale()) }}</a></li>
                        <li><a href="{{ route('seller.register') }}">{{ app(\App\Services\AutoTranslationService::class)->trans('Restaurant anmelden', app()->getLocale()) }}</a></li>
                        <li><a href="help.html">{{ app(\App\Services\AutoTranslationService::class)->trans('Help', app()->getLocale()) }}</a></li>
                        <li><a href="{{ url('/blog') }}">{{ app(\App\Services\AutoTranslationService::class)->trans('Blog', app()->getLocale()) }}</a></li>
                        <li><a href="contacts.html">@autotranslate('Contact', app()->getLocale())</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h3 data-bs-target="#collapse_2">{{ app(\App\Services\AutoTranslationService::class)->trans('Categories', app()->getLocale()) }}</h3>
                <div class="collapse dont-collapse-sm links" id="collapse_2">
                    <ul>
                        <li><a href="grid-listing-filterscol.html">{{ app(\App\Services\AutoTranslationService::class)->trans('Top Categories', app()->getLocale()) }}</a></li>
                        <li><a href="grid-listing-filterscol-full-masonry.html">{{ app(\App\Services\AutoTranslationService::class)->trans('Best Rated', app()->getLocale()) }}</a></li>
                        <li><a href="grid-listing-filterscol-full-width.html">{{ app(\App\Services\AutoTranslationService::class)->trans('Best Price', app()->getLocale()) }}</a></li>
                        <li><a href="grid-listing-filterscol-full-masonry.html">@autotranslate('Latest Submissions', app()->getLocale())</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                    <h3 data-bs-target="#collapse_3">@autotranslate('Contacts', app()->getLocale())</h3>
                <div class="collapse dont-collapse-sm contacts" id="collapse_3">
                    <ul>
                        @if(get_settings()->site_address)
                        <li>
                            <i class="icon_house_alt"></i>
                            <a href="https://www.google.com/maps/search/?api=1&query={{ get_settings()->site_address }}" target="_blank">
                            {!! str_replace(',', '<br>', get_settings()->site_address) !!}
                            </a>
                        </li>
                      @endif
                    @if(get_settings()->site_phone || get_settings()->site_email)
                        <li><i class="icon_mobile"></i>{{ get_settings()->site_phone }}</li>

                        @if(get_settings()->site_email)
                        <li><i class="icon_mail_alt"></i><a href="mailto:{{ get_settings()->site_email }}">{{ get_settings()->site_email }}</a></li>
                        @endif
                    @endif
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                    <h3 data-bs-target="#collapse_4">@autotranslate('Keep in touch', app()->getLocale())</h3>
                <div class="collapse dont-collapse-sm" id="collapse_4">
                    <div id="newsletter">
                        <div id="message-newsletter"></div>
                        <form method="post" action="assets/newsletter.php" name="newsletter_form" id="newsletter_form">
                            <div class="form-group">
                                <input type="email" name="email_newsletter" id="email_newsletter" class="form-control" placeholder="{{ app(\App\Services\AutoTranslationService::class)->trans('Your email', app()->getLocale()) }}">
                                <button type="submit" id="submit-newsletter"><i class="arrow_carrot-right"></i></button>
                            </div>
                        </form>
                    </div>

                    <?php
                    // Soziale Netzwerke und ihre zugehörigen Spalten in der Datenbank
                    $socialNetworks = [
                        'Facebook' => 'facebook_url',
                        'Twitter' => 'twitter_url',
                        'Instagram' => 'instagram_url',
                        'LinkedIn' => 'linkedin_url',
                        'Printerest' => 'printerest_url',
                        'YouTube' => 'youtube_url',
                        'TikTok' => 'tiktok_url',
                        'WhatsApp' => 'whatsapp_number',
                        'Github' => 'github_url',
                        'Telegram' => 'telegram_url',
                        'Snapchat' => 'snapchat_url',
                        'Twitch' => 'twitch_url',
                    ];

                    // Abfragen der Links aus der Datenbank
                    $socialLinks = \App\Models\SocialNetwork::first();
                    if ($socialLinks !== null) {
                    ?>
                    <div class="follow_us">
                        <h5>{{ app(\App\Services\AutoTranslationService::class)->trans('Follow Us', app()->getLocale()) }}</h5>
                        <ul>
                            @foreach($socialNetworks as $networkName => $columnName)
                                @if(!empty($socialLinks->$columnName))
                                    <li><a href="{{ $socialLinks->$columnName }}"><img src="{{ asset('frontend/img/social_icons/' . strtolower($networkName) . '_icon.svg') }}" alt="{{ $networkName }}" class="lazy"></a></li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <?php
                    }
                    ?>

            </div>
            </div>
        </div>
        <!-- /row-->
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


            <div class="footer-copyright border-top py-3 bg-light">
                <div class="container d-flex align-items-center">
                <p class="mb-0"> © 2023 {{ config('app.name') }} All rights reserved </p>
                <p class="text-muted mb-0 ms-auto d-flex align-items-center">


                <a href="#" class="d-block"><img alt="#" src="frontend/img/appstore.png" height="40"></a>

                <button id="install-button" style="display: none; border: none; background: none;">
                    <img src="frontend/img/playmarket.png" alt="Install Icon" style="height: 40px;">
                </button>
                </p>
                </div>
                </div>


<style>
    .section-footer .border-top {
    border-top: 1px solid rgb(222 226 230 / 9%) !important;
}

.bg-light {
    --bs-bg-opacity: 1;
    background-color: #f6f1d3 !important;
}

.py-3 {
    padding-top: 1rem !important;
    padding-bottom: 1rem !important;
}
.align-items-center {
    align-items: center !important;
}
.mb-0 {
    margin-bottom: 0 !important;
}
footer .text-muted {
    color: #bdbdbd !important;
}
.ms-auto {
    margin-left: auto !important;
}
.d-block {
    display: block !important;
}
.ms-3 {
    margin-left: 1rem !important;
}
</style>







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
                    name: "Dein App-Name",
                    short_name: "App",
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
<!-- Hier wire:poll einsetzen -->
<livewire:frontend.social-toast.social-proof/>

@cookieconsentview
<!--/footer-->

@stack('scripts')

