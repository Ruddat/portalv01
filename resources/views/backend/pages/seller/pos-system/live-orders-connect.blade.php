@extends('backend.layouts.default-dark')
@section('pageTitle', isset($pageTitle) ? app(\App\Services\TranslationService::class)->trans($pageTitle, app()->getLocale()) : app(\App\Services\TranslationService::class)->trans('Page title here....', app()->getLocale()))
@section('content')



<meta name="viewport" content="width=device-width, initial-scale=1.0">



		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            <div class="container">
				<div class="row page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Table</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0)">@yield('pageTitle')</a></li>
					</ol>
                </div>
                <!-- row -->

                <div class="row">


                    <livewire:backend.seller.pos-system.live-order-connect :shopId="$shopId" />

                    <livewire:backend.seller.pos-system.printer-configurator :shopId="$shopId" />

                    <div class="container">
                        <div class="row">


                            <div class="col-xl-12">
                                <div class="card border-0">
                                    <h4 class="cate-title mb-sm-3 mb-2 mt-xl-0 mt-3">Order Details</h4>
                                    <div class="card h-auto">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between border-bottom flex-wrap">
                                                <div class="mb-4">
                                                    <h4 class="font-w500">Order #1</h4>
                                                    <span>June 1, 2020, 08:22 AM</span>
                                                </div>
                                                <div class="orders-img d-flex mb-4">
                                                    <img src="images/chat-img/orders-img/pic-1.jpg" alt="">
                                                    <div>
                                                        <h6 class="font-w500">Ruby Roben</h6>
                                                        <p>Tel.: 123456</p>
                                                        <span>User since 2020</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row border-bottom pb-2">
                                                <div class="col-xl-6">
                                                    <div class="address-bx mt-3">
                                                        <span class="d-block mb-2">Delivery Address</span>
                                                        <div class="d-flex align-items-center mb-2">
                                                            <svg class="me-2" width="18" height="22" viewBox="0 0 18 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M17.4599 8.63006C17.3195 7.16898 16.8031 5.76915 15.9611 4.56688C15.119 3.36462 13.98 2.4009 12.6549 1.76956C11.3298 1.13822 9.86376 0.860785 8.3996 0.964268C6.93543 1.06775 5.52301 1.54863 4.29988 2.36006C3.24908 3.06271 2.36693 3.98936 1.71682 5.07346C1.06672 6.15755 0.664776 7.37217 0.539881 8.63006C0.417363 9.87972 0.574555 11.141 1.00005 12.3223C1.42555 13.5037 2.10868 14.5755 2.99988 15.4601L8.29988 20.7701C8.39284 20.8638 8.50344 20.9382 8.6253 20.989C8.74716 21.0397 8.87787 21.0659 9.00988 21.0659C9.14189 21.0659 9.2726 21.0397 9.39446 20.989C9.51632 20.9382 9.62692 20.8638 9.71988 20.7701L14.9999 15.4601C15.8911 14.5755 16.5742 13.5037 16.9997 12.3223C17.4252 11.141 17.5824 9.87972 17.4599 8.63006ZM13.5999 14.0501L8.99988 18.6501L4.39988 14.0501C3.72197 13.3721 3.20268 12.5524 2.87935 11.6498C2.55601 10.7473 2.43667 9.78426 2.52988 8.83006C2.6237 7.86117 2.93164 6.92522 3.43145 6.08991C3.93126 5.25459 4.61044 4.54077 5.41988 4.00006C6.48083 3.2953 7.72619 2.91936 8.99988 2.91936C10.2736 2.91936 11.5189 3.2953 12.5799 4.00006C13.3869 4.53868 14.0646 5.24935 14.5642 6.081C15.0639 6.91266 15.3732 7.84467 15.4699 8.81007C15.5661 9.76749 15.4483 10.7343 15.1249 11.6406C14.8014 12.5469 14.2805 13.3699 13.5999 14.0501ZM8.99988 5.00006C8.10986 5.00006 7.23984 5.26399 6.49982 5.75845C5.75979 6.25292 5.18302 6.95572 4.84242 7.77799C4.50183 8.60026 4.41271 9.50506 4.58635 10.378C4.75998 11.2509 5.18856 12.0527 5.8179 12.682C6.44724 13.3114 7.24906 13.74 8.12197 13.9136C8.99489 14.0872 9.89969 13.9981 10.722 13.6575C11.5442 13.3169 12.247 12.7402 12.7415 12.0001C13.236 11.2601 13.4999 10.3901 13.4999 9.50006C13.4972 8.3074 13.0223 7.16434 12.1789 6.321C11.3356 5.47766 10.1925 5.00271 8.99988 5.00006ZM8.99988 12.0001C8.50543 12.0001 8.02208 11.8534 7.61096 11.5787C7.19983 11.304 6.8794 10.9136 6.69018 10.4568C6.50096 9.99996 6.45145 9.49729 6.54792 9.01234C6.64438 8.52739 6.88248 8.08193 7.23211 7.7323C7.58175 7.38267 8.0272 7.14456 8.51215 7.0481C8.99711 6.95164 9.49977 7.00115 9.95659 7.19037C10.4134 7.37958 10.8039 7.70002 11.0786 8.11114C11.3533 8.52226 11.4999 9.00561 11.4999 9.50006C11.4999 10.1631 11.2365 10.799 10.7676 11.2678C10.2988 11.7367 9.66292 12.0001 8.99988 12.0001Z" fill="var(--primary)"></path>
                                                            </svg>
                                                            <h4 class="mb-0 font-w700">Heidkrugsweg, 31</h4>
                                                        </div>
                                                        <p><strong>31234 Wipshausen</strong></p>
                                                        <p>Wegbeschreibung: Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt. </p>
                                                        <p>Delivery Option: Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt. </p>

                                                    </div>
                                                </div>
                                                <div class="col-xl-4">
                                                    <div class="d-flex align-items-center justify-content-between mt-3">
                                                        <span>Voraussichtliche Zeit </span>
                                                        <span>Verbleibende Zeit</span>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                                        <h6 class="mb-0">90 Min </h6>
                                                        <h6 class="mb-0">46 Min </h6>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <span>Payment </span>
                                                        <span>Fuer spaeter</span>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <h6 class="mb-0">cash </h6>
                                                        <h6 class="mb-0">xx </h6>
                                                    </div>

                                                </div>
                                                <div class="col-xl-2"></div>
                                            </div>
                                            <div class="order-menu style-1 mt-3">
                                                <h4>Order Menu</h4>
                                                <div class="d-flex align-items-center mb-4">
                                                    <img class="me-3" src="images/popular-img/review-img/pic-1.jpg" alt="">
                                                    <div>
                                                        <h4 class="font-w600 text-nowrap mb-0"><a href="javascript:void(0);">Pepperoni Pizza</a></h4>
                                                        <p class="mb-0">x1</p>
                                                    </div>
                                                    <h4 class="text-primary mb-0 ms-auto">+$5.59</h4>
                                                </div>
                                                <div class="d-flex align-items-center mb-4">
                                                    <img class="me-3" src="images/popular-img/review-img/pic-2.jpg" alt="">
                                                    <div>
                                                        <h4 class="font-w600 text-nowrap mb-0"><a href="javascript:void(0);">Japanese Ramen</a></h4>
                                                        <p class="mb-0">x1</p>
                                                    </div>
                                                    <h4 class="text-primary mb-0 ms-auto">+$5.59</h4>
                                                </div>
                                                <div class="d-flex align-items-center pb-2">
                                                    <img class="me-3" src="images/popular-img/pic-1.jpg" alt="">
                                                    <div>
                                                        <h4 class="font-w600 text-nowrap mb-0"><a href="javascript:void(0);">Pepperoni Pizza</a></h4>
                                                        <p class="mb-0">x1</p>
                                                    </div>
                                                    <h4 class="text-primary mb-0 ms-auto">+$5.59</h4>
                                                </div>

                                            </div>
                                                <hr style="opacity:0.7">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h4 class="font-w500 mb-0">Total</h4>
                                                <h4 class="cate-title text-primary">$12.59</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <a href="javascript:void(0);" class="btn btn-outline-danger me-sm-4 me-2">30min</a>
                                        <a href="javascript:void(0);" class="btn btn-outline-danger me-sm-4 me-2">45min</a>
                                        <a href="javascript:void(0);" class="btn btn-outline-danger me-sm-4 me-2">60min</a>
                                        <a href="javascript:void(0);" class="btn btn-outline-danger me-sm-4 me-2">75min</a>
                                        <a href="javascript:void(0);" class="btn btn-outline-danger me-sm-4 me-2">90min</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>









                </div>
            </div>









        </div>
        <!--**********************************
            Content body end
        ***********************************-->








    @push('specific-css')
    @endpush

    @push('specific-scripts')
    @endpush

@endsection


