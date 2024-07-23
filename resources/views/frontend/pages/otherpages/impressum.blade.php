@extends('frontend.layouts.default')
@section('content')
    <!-- seitenabhengig css -->
    @push('specific-css')
        <link href="{{ asset('frontend/css/contacts.css') }}" rel="stylesheet">
    @endpush

    <body id="register_bg">

        @include('frontend.includes.header-clearfix-element-to-stick')

		<div class="hero_single inner_pages background-image" data-background="url({{ asset('frontend/img/home_section_2.jpg') }})">
			<div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-xl-9 col-lg-10 col-md-8">
							<h1>{{ config('app.name') }}</h1>
							<p>@autotranslate('A successful restaurant experience', app()->getLocale())</p>
						</div>
					</div>
					<!-- /row -->
				</div>
			</div>
			<div class="wave gray hero"></div>
		</div>
		<!-- /hero_single -->

		<div class="bg_gray">

		    <div class="impressum_container margin_60_40">


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


                <p><span class="bold">Ingo Ruddat</span><br>
                Email: <a href="mailto:ingo.ruddat@gmail.com">ingo.ruddat@gmail.com</a></p>

                <p>@autotranslate('Diese Seite befindet sich derzeit noch in der Entwicklung. Bitte beachten Sie, dass nicht alle Funktionen verfügbar sind und die Seite noch nicht bereit ist, um im Produktionsbetrieb verwendet zu werden.', app()->getLocale())</p>

                <p>Link zur Streitschlichtung: <a href="https://ec.europa.eu/consumers/odr" target="_blank">https://ec.europa.eu/consumers/odr</a></p>

                <p>Bilderquellen: Geti Images, Stockphoto und OpenSource</p>

                <div class="license">
                    <p>License: Creative Commons 3 - CC BY-SA 3.0</p>
                    <p>Attribution: Alpha Stock Images - <a href="http://alphastockimages.com/" target="_blank">http://alphastockimages.com/</a></p>
                    <p>Original Author: Nick Youngson - <a href="http://www.nyphotographic.com/" target="_blank">http://www.nyphotographic.com/</a></p>
                    <p>Original Image: <a href="https://www.thebluediamondgallery.com/tablet-dictionary/b/broker.html" target="_blank">https://www.thebluediamondgallery.com/tablet-dictionary/b/broker.html</a></p>

                    Image by <a href=" https://www.vectorportal.com" >Vectorportal.com</a>,  <a class="external text" href="https://creativecommons.org/licenses/by/4.0/" >CC BY</a>
                </div>
            </div>



		    <!-- /container -->
		</div>
		<!-- /bg_gray -->




        <style>
            .impressum_container {
                max-width: 800px;
                margin: 0 auto;
                padding: 20px;
            }
            h1 {
                text-align: center;
            }
            p {
                margin: 10px 0;
            }
            .bold {
                font-weight: bold;
            }
            .license {
                font-size: 0.9em;
                color: #555;
            }
        </style>

        @push('specific-scripts')


        @endpush
    @endsection
