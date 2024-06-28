<!DOCTYPE html>
<html>
  <head>
    <title>{{ app(\App\Services\TranslationService::class)->trans('Site Launch Coming soon', app()->getLocale()) }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">

    <!-- CSS -->
    <link href="{{ asset('extra-assets/coming_soon/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('extra-assets/coming_soon/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('extra-assets/coming_soon/fontello/css/fontello.css') }}" rel="stylesheet" >
    <link href="{{ asset('extra-assets/coming_soon/fontello/css/animation.css') }}" rel="stylesheet" >

  </head>
  <body>

	<div id="wrapper">
		<div id="main">
			<div class="container">

				<div class="row countdown">
					<div class="col-lg-12">
						<div id="logo" class="mb-3"><img src="{{ asset('frontend/img/logo_sticky.svg') }}" width="140" height="35" alt="" data-retina="true"></div>
						<h1> {{ app(\App\Services\TranslationService::class)->trans('We will be Back soon!', app()->getLocale()) }}</h1>
                        <h2 style="white-space: pre-line;">
                            {{ app(\App\Services\TranslationService::class)
                                ->trans('Meanwhile, you can leave your email.We will advise you when we are back online!', app()->getLocale()) }}
                        </h2>
                    </div>
					<div id="countdown_wp">
						<div class="container_count">
							<div id="days">00</div>{{ app(\App\Services\TranslationService::class)->trans('days', app()->getLocale()) }}</div>
						<div class="container_count">
							<div id="hours">00</div>{{ app(\App\Services\TranslationService::class)->trans('hours', app()->getLocale()) }}</div>
						<div class="container_count">
							<div id="minutes">00</div>{{ app(\App\Services\TranslationService::class)->trans('Minuten', app()->getLocale()) }}</div>
						<div class="container_count last">
							<div id="seconds">00</div>{{ app(\App\Services\TranslationService::class)->trans('seconds', app()->getLocale()) }}</div>
					</div>
				</div>
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div id="newsletter_wp">
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('subscribe.commingsoon') }}" id="newsletter" name="newsletter" autocomplete="off">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-9 first-nogutter">
                                        <input name="email" id="email" type="email" placeholder="{{ app(\App\Services\TranslationService::class)->trans('Your Email', app()->getLocale()) }}" class="form-control" required>
                                    </div>
                                    <div class="col-lg-3 nogutter">
                                        <button type="submit" class="btn-check" id="submit-newsletter">{{ app(\App\Services\TranslationService::class)->trans('Subscribe', app()->getLocale()) }}</button>
                                    </div>
                                </div>
                            </form>
                            <div id="message-newsletter"></div>
                        </div>
                    </div>
                </div>
				<div id="social_footer">
					<ul>
						<li><a href="#"><i class="icon-facebook"></i></a></li>
						<li><a href="#"><i class="icon-twitter"></i></a></li>
						<li><a href="#"><i class="icon-google"></i></a></li>
						<li><a href="#"><i class="icon-vimeo"></i></a></li>
						<li><a href="#"><i class="icon-youtube-play"></i></a></li>
					</ul>
					<p>© FooYes 2020</p>
				</div>
			</div>
			<!-- End container -->
		</div>
		<!-- End main -->
	</div>

	<div id="slides">
		<ul class="slides-container">
			<li><img src="{{ asset('extra-assets/coming_soon/img/slide_2.jpg') }}" alt=""></li>
			<li><img src="{{ asset('extra-assets/coming_soon/img/slide_1.jpg') }}" alt=""></li>
		</ul>
	</div><!-- End background slider -->

<!-- JQUERY -->
<script src="{{ asset('extra-assets/coming_soon/js/jquery-2.2.4.min.js') }}"></script>
<script src="{{ asset('extra-assets/coming_soon/js/jquery.easing.1.3.min.js') }}"></script>
<script src="{{ asset('extra-assets/coming_soon/js/jquery.animate-enhanced.min.js') }}"></script>
<script src="{{ asset('extra-assets/coming_soon/js/jquery.superslides.min.js') }}"></script>
<script  type="text/javascript">
  $('#slides').superslides({
	  play: 6000,
	  pagination:false,
	  animation_speed: 800,
      animation: 'fade'
    });
</script>
<!-- OTHER JS -->
<script src="{{ asset('extra-assets/coming_soon/js/retina.min.js') }}"></script>
<script  src="{{ asset('extra-assets/coming_soon/js/functions.js') }}"></script>
  </body>
</html>
