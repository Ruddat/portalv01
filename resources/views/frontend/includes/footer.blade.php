<footer>
    <div class="wave footer"></div>
    <div class="container margin_60_40 fix_mobile">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <h3 data-bs-target="#collapse_1">{{ app(\App\Services\TranslationService::class)->trans('Quick Links', app()->getLocale()) }}</h3>
                <div class="collapse dont-collapse-sm links" id="collapse_1">
                    <ul>
                        <li><a href="about.html">{{ app(\App\Services\TranslationService::class)->trans('About us', app()->getLocale()) }}</a></li>
                        <li><a href="{{ url('/submit-restaurant') }}">{{ app(\App\Services\TranslationService::class)->trans('Add your restaurant', app()->getLocale()) }}</a></li>
                        <li><a href="help.html">{{ app(\App\Services\TranslationService::class)->trans('Help', app()->getLocale()) }}</a></li>
                        <li><a href="register.html">{{ app(\App\Services\TranslationService::class)->trans('My account', app()->getLocale()) }}</a></li>
                        <li><a href="{{ url('/blog') }}">{{ app(\App\Services\TranslationService::class)->trans('Blog', app()->getLocale()) }}</a></li>
                        <li><a href="contacts.html">{{ app(\App\Services\TranslationService::class)->trans('Contacts', app()->getLocale()) }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h3 data-bs-target="#collapse_2">{{ app(\App\Services\TranslationService::class)->trans('Categories', app()->getLocale()) }}</h3>
                <div class="collapse dont-collapse-sm links" id="collapse_2">
                    <ul>
                        <li><a href="grid-listing-filterscol.html">{{ app(\App\Services\TranslationService::class)->trans('Top Categories', app()->getLocale()) }}</a></li>
                        <li><a href="grid-listing-filterscol-full-masonry.html">{{ app(\App\Services\TranslationService::class)->trans('Best Rated', app()->getLocale()) }}</a></li>
                        <li><a href="grid-listing-filterscol-full-width.html">{{ app(\App\Services\TranslationService::class)->trans('Best Price', app()->getLocale()) }}</a></li>
                        <li><a href="grid-listing-filterscol-full-masonry.html">{{ app(\App\Services\TranslationService::class)->trans('Latest Submissions', app()->getLocale()) }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                    <h3 data-bs-target="#collapse_3">{{ app(\App\Services\TranslationService::class)->trans('Contacts', app()->getLocale()) }}</h3>
                <div class="collapse dont-collapse-sm contacts" id="collapse_3">
                    <ul>
                        <li><i class="icon_house_alt"></i>97845 Baker st. 567<br>Los Angeles - US</li>
                        <li><i class="icon_mobile"></i>+94 423-23-221</li>
                        <li><i class="icon_mail_alt"></i><a href="#0">info@domain.com</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                    <h3 data-bs-target="#collapse_4">{{ app(\App\Services\TranslationService::class)->trans('Keep in touch', app()->getLocale()) }}</h3>
                <div class="collapse dont-collapse-sm" id="collapse_4">
                    <div id="newsletter">
                        <div id="message-newsletter"></div>
                        <form method="post" action="assets/newsletter.php" name="newsletter_form" id="newsletter_form">
                            <div class="form-group">
                                <input type="email" name="email_newsletter" id="email_newsletter" class="form-control" placeholder="{{ app(\App\Services\TranslationService::class)->trans('Your email', app()->getLocale()) }}">
                                <button type="submit" id="submit-newsletter"><i class="arrow_carrot-right"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="follow_us">
                        <h5>{{ app(\App\Services\TranslationService::class)->trans('Follow Us', app()->getLocale()) }}</h5>
                        <ul>
                            <li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="{{ asset('frontend/img/twitter_icon.svg') }}" alt="" class="lazy"></a></li>
                            <li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="{{ asset('frontend/img/facebook_icon.svg') }}" alt="" class="lazy"></a></li>
                            <li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="{{ asset('frontend/img/instagram_icon.svg') }}" alt="" class="lazy"></a></li>
                            <li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="{{ asset('frontend/img/youtube_icon.svg') }}" alt="" class="lazy"></a></li>
                        </ul>
                    </div>
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
                                <option value="US Dollars" selected>US Dollars</option>
                                <option value="Euro">Euro</option>
                            </select>
                        </div>
                    </li>
                    <li><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="{{ asset('frontend/img/cards_all.svg') }}" alt="" width="230" height="35" class="lazy"></li>
                </ul>
            </div>
            <div class="col-lg-6">
                <ul class="additional_links">
                    <li><a href="#0">{{ app(\App\Services\TranslationService::class)->trans('Impressum', app()->getLocale()) }}</a></li>
                    <li><a href="#0">{{ app(\App\Services\TranslationService::class)->trans('Terms and conditions', app()->getLocale()) }}</a></li>
                    <li><a href="#0">{{ app(\App\Services\TranslationService::class)->trans('Privacy', app()->getLocale()) }}</a></li>
                    <li><span>© FooYes</span></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!--/footer-->
