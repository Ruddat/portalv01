@extends('frontend.layouts.default')
@section('content')

    <!-- seitenabhengig css -->
    @push('specific-css')
        <link href="{{ asset('frontend/css/help.css') }}" rel="stylesheet">
    @endpush


    <body id="register_bg">

        @include('frontend.includes.header-clearfix-element-to-stick')


	<main>

<!-- Hero Section -->
<div class="hero_single inner_pages background-image" data-background="url({{ asset('frontend/img/hero_general_2.jpg') }})">


    <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">

        <div class="container">
    <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Category</a></li>
                <li class="breadcrumb-item active" aria-current="page">Current Page</li>
            </ol>
        </nav>

            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-10 col-md-8">
                    <h1>Order Burgers takeaway online</h1>
                    <p>Explore local Burgers takeaway restaurants</p>

                    <!-- Search Form -->
                    <form method="get" action="{{ url('/search') }}">
                        <div class="row g-0 custom-search-input">
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <input class="form-control no_border_r" type="text" name="query" placeholder="What are you looking for?">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <button class="btn_1 gradient" type="submit" aria-label="Search">
                                    <i class="icon_search"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /row -->
                    </form>
                </div>
            </div>
            <!-- /row -->
        </div>
    </div>
    <div class="wave hero gray"></div>
</div>
<!-- /hero_single -->


		<div class="bg_gray">
			<div class="container margin_30_40">
				<div class="main_title center">
				    <span><em></em></span>
				    <h2>Select a topic</h2>
				    <p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>
				</div>

				<div class="row">
					<div class="col-lg-4 col-md-6">
						<a class="box_topic" href="#0">
							<span><i class="icon_wallet"></i></span>
							<h3>Payments</h3>
							<p>Id mea congue dictas, nec et summo mazim impedit. Vim te audiam impetus interpretaris.</p>
						</a>
					</div>
					<div class="col-lg-4 col-md-6">
						<a class="box_topic" href="#0">
							<i class="icon_cloud-upload_alt"></i>
							<h3>Submission</h3>
							<p>Id mea congue dictas, nec et summo mazim impedit. Vim te audiam impetus interpretaris.</p>
						</a>
					</div>
					<div class="col-lg-4 col-md-6">
						<a class="box_topic" href="#0">
							<i class="icon_lifesaver"></i>
							<h3>General help</h3>
							<p>Id mea congue dictas, nec et summo mazim impedit. Vim te audiam impetus interpretaris.</p>
						</a>
					</div>
					<div class="col-lg-4 col-md-6">
						<a class="box_topic" href="#0">
							<i class="icon_globe-2"></i>
							<h3>International</h3>
							<p>Id mea congue dictas, nec et summo mazim impedit. Vim te audiam impetus interpretaris.</p>
						</a>
					</div>
					<div class="col-lg-4 col-md-6">
						<a class="box_topic" href="#0">
							<i class="icon_document_alt"></i>
							<h3>Cancellation</h3>
							<p>Id mea congue dictas, nec et summo mazim impedit. Vim te audiam impetus interpretaris.</p>
						</a>
					</div>
					<div class="col-lg-4 col-md-6">
						<a class="box_topic" href="#0">
							<i class="icon_comment_alt"></i>
							<h3>Reviews</h3>
							<p>Id mea congue dictas, nec et summo mazim impedit. Vim te audiam impetus interpretaris.</p>
						</a>
					</div>
				</div>
			</div>
			<!-- /container -->
		</div>
		<!-- /bg_gray -->
		<div class="container margin_60_40">
				<div class="main_title version_2">
					<span><em></em></span>
					<h2>Popular articles</h2>
					<p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>
				</div>
				<div class="list_articles clearfix">
					<ul>
						<li><a href="#0"><i class="icon_documents_alt"></i>Et dicit vidisse epicurei pri</a></li>
						<li><a href="#0"><i class="icon_documents_alt"></i>Ad sit virtute rationibus efficiantur</a></li>
						<li><a href="#0"><i class="icon_documents_alt"></i>Partem vocibus omittam pri ne</a></li>
						<li><a href="#0"><i class="icon_documents_alt"></i>Case debet appareat duo cu</a></li>
						<li><a href="#0"><i class="icon_documents_alt"></i>Impedit torquatos quo in</a></li>
						<li><a href="#0"><i class="icon_documents_alt"></i>Nec omnis alienum no</a></li>
						<li><a href="#0"><i class="icon_documents_alt"></i>Quo eu soleat facilisi menandri</a></li>
						<li><a href="#0"><i class="icon_documents_alt"></i>Et dicit vidisse epicurei pri</a></li>
					</ul>
				</div>
				<!-- /list_articles -->
			</div>
			<!-- /container -->
	</main>
	<!-- /main -->

<style>



</style>

@endsection
