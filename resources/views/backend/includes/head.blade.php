	<!-- All Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="DexignLab" />
	<meta name="robots" content="" />
	<meta name="description" content="FoodDesk - Online Food Delivery Admin Dashboard"/>
	<meta property="og:title" content="FoodDesk - Online Food Delivery Admin Dashboard" />
	<meta property="og:description" content="FoodDesk - Online Food Delivery Admin Dashboard" />
	<meta property="og:image" content="https://fooddesk.dexignlab.com/xhtml/social-image.png" />
	<meta name="format-detection" content="telephone=no">

	<!-- Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- PAGE TITLE HERE -->
	<title>FoodDesk - Online Food Delivery Admin Dashboard</title>

	<!-- FAVICONS ICON -->
	<link rel="shortcut icon" type="image/png" href="{{ asset('backend/images/favicon.png') }}" />

    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('backend/vendor/toastr/css/toastr.min.css') }}">

	<!-- Stylesheet -->
	<link href="{{ asset('backend/vendor/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet">
	<link href="{{ asset('backend/vendor/swiper/css/swiper-bundle.min.css') }}" rel="stylesheet">
	<link href="{{ asset('backend/vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
	<link href="{{ asset('backend/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">

    <!-- extra Stylesheet -->
    <link href="{{ asset('extra-assets/ijabo/ijabo.min.css') }}" rel="stylesheet">

    <link href="{{ asset('extra-assets/ijabo/ijaboCropTool.min.css') }}" rel="stylesheet">
    <!-- Style css -->
	<link href="{{ asset('backend/vendor/swiper/css/swiper-bundle.min.css') }}" rel="stylesheet">

	<!-- Global Stylesheet -->
	<link href="{{ asset('backend/css/style.css') }}" rel="stylesheet">


    @stack('specific-css')

        <!-- Styles -->
        @livewireStyles

