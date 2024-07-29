@extends('frontend.layouts.default')
@section('content')
    <!-- seitenabhengig css -->
    @push('specific-css')
        <link href="{{ asset('frontend/css/blog.css') }}" rel="stylesheet">
    @endpush

    <body>
        @include('frontend.includes.header-in-clearfix')


        <div class="page_header blog element_to_stick">
		    <div class="container">
		    	<div class="row">
		    		<div class="col-xl-8 col-lg-7 col-md-7 d-none d-md-block">
		    			<h1>@autotranslate('Blog and Articles', app()->getLocale())</h1>
		    		</div>
		    		<div class="col-xl-4 col-lg-5 col-md-5">
		    			<div class="search_bar_list">
						    <input type="text" class="form-control" placeholder="Dishes, restaurants or cuisines">
						    <button type="submit"><i class="icon_search"></i></button>
						</div>
		    		</div>
		    	</div>
		    	<!-- /row -->

            </div>
		</div>
		<!-- /page_header -->


        <livewire:frontend.blog.blog-index/>


        <div class="shape_element_2">
            <div class="container margin_60_0">
                <div class="row justify-content-center">
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box_info_1 pr-lg-3">
                                    <div class="wrapper_img">
                                        <figure><img src="https://portal-v01.test/frontend/img/submit_restaurant_home.jpg" data-src="https://portal-v01.test/frontend/img/submit_restaurant_home.jpg" alt="" class="img-fluid lazy loaded" data-was-processed="true"></figure><span></span>
                                    </div>
                                    <h3>@autotranslate('Fügen Sie Ihr Restaurant hinzu', app()->getLocale())</h3>
                                    <p>Willkommen in unserem Netzwerk! Hier haben Sie die Möglichkeit, Ihr Restaurant schnell und einfach hinzuzufügen. Schließen Sie sich uns an und profitieren Sie von zahlreichen Vorteilen.</p>
                                    <p><a href="https://portal-v01.test/seller/register" class="btn_1 medium gradient pulse_bt mt-2">Tragen Sie Ihr Restaurant ein</a>
                                        <a href="https://portal-v01.test/broker/register" class="btn_1 medium gradient pulse_bt mt-2">Werden Sie Makler</a></p>
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="box_info_1 pl-lg-3">
                                    <div class="wrapper_img">
                                        <figure><img src="https://portal-v01.test/frontend/img/submit_rider_home.jpg" data-src="https://portal-v01.test/frontend/img/submit_rider_home.jpg" alt="" class="img-fluid lazy loaded" data-was-processed="true"></figure><span></span>
                                    </div>
                                    <h3>@autotranslate('Bereits Partner', app()->getLocale())</h3>
                                    <p>Wenn Sie bereits ein Partner sind, können Sie sich hier einloggen und auf das Partnercenter oder das Broker-Portal zugreifen.</p>
                                    <p><a href="https://portal-v01.test/seller/login" class="btn_1 medium gradient pulse_bt mt-2">Partnercenter</a>
                                    <a href="https://portal-v01.test/broker/login" class="btn_1 medium gradient pulse_bt mt-2">Broker-Portal</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>

		<!-- /container -->


    @endsection
