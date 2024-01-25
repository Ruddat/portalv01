<footer>
    <div class="wave footer"></div>
    <div class="container margin_60_40 fix_mobile">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <h3 data-bs-target="#collapse_1">Quick Links</h3>
                <div class="collapse dont-collapse-sm links" id="collapse_1">
                    <ul>
                        <li><a href="about.html">About us</a></li>
                        <li><a href="{{ url('/submit-restaurant') }}">Add your restaurant</a></li>
                        <li><a href="help.html">Help</a></li>
                        <li><a href="register.html">My account</a></li>
                        <li><a href="{{ url('/blog') }}">Blog</a></li>
                        <li><a href="contacts.html">Contacts</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h3 data-bs-target="#collapse_2">Categories</h3>
                <div class="collapse dont-collapse-sm links" id="collapse_2">
                    <ul>
                        <li><a href="grid-listing-filterscol.html">Top Categories</a></li>
                        <li><a href="grid-listing-filterscol-full-masonry.html">Best Rated</a></li>
                        <li><a href="grid-listing-filterscol-full-width.html">Best Price</a></li>
                        <li><a href="grid-listing-filterscol-full-masonry.html">Latest Submissions</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                    <h3 data-bs-target="#collapse_3">Contacts</h3>
                <div class="collapse dont-collapse-sm contacts" id="collapse_3">
                    <ul>
                        <li><i class="icon_house_alt"></i>97845 Baker st. 567<br>Los Angeles - US</li>
                        <li><i class="icon_mobile"></i>+94 423-23-221</li>
                        <li><i class="icon_mail_alt"></i><a href="#0">info@domain.com</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                    <h3 data-bs-target="#collapse_4">Keep in touch</h3>
                <div class="collapse dont-collapse-sm" id="collapse_4">
                    <div id="newsletter">
                        <div id="message-newsletter"></div>
                        <form method="post" action="assets/newsletter.php" name="newsletter_form" id="newsletter_form">
                            <div class="form-group">
                                <input type="email" name="email_newsletter" id="email_newsletter" class="form-control" placeholder="Your email">
                                <button type="submit" id="submit-newsletter"><i class="arrow_carrot-right"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="follow_us">
                        <h5>Follow Us</h5>
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
                                <option value="nl" {{ session('locale') == 'nl' ? 'selected' : '' }}>Niederlande</option>
                                <option value="en" {{ session('locale') == 'en' ? 'selected' : '' }}>English</option>
                                <option value="fr" {{ session('locale') == 'fr' ? 'selected' : '' }}>French</option>
                                <option value="es" {{ session('locale') == 'es' ? 'selected' : '' }}>Spanish</option>
                                <option value="ru" {{ session('locale') == 'ru' ? 'selected' : '' }}>Russian</option>
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
                    <li><a href="#0">Terms and conditions</a></li>
                    <li><a href="#0">Privacy</a></li>
                    <li><span>© FooYes</span></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!--/footer-->
