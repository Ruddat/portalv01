@extends('backend.layouts.default-dark')
@section('content')

@push('specific-css')
@endpush


        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container">

                <div class="col-xl-12">
                    <div class="card income-bx">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-6">
                                    <div class="line position-relative">
                                        <p class="font-w500 mb-0">Total Income</p>
                                        <h2 class="mb-0 text-primary">$12,890,00</h2>
                                        <h4>{{ session('currentShopTitle') }}</h4>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-6">
                                    <p class="font-w500 text-success mb-0">Income</p>
                                    <h4 class="cate-title data">$4345,00</h4>
                                    <ul class="d-flex align-items-center">
                                        <li><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_1055_214)">
                                        <path d="M17.4375 9C17.4375 4.33125 13.6688 0.5625 9 0.5625C4.33125 0.562499 0.5625 4.33125 0.5625 9C0.562499 13.6687 4.33125 17.4375 9 17.4375C13.6687 17.4375 17.4375 13.6687 17.4375 9ZM8.4375 12.4313L8.4375 7.25625L6.975 8.55C6.6375 8.83125 6.1875 8.775 5.90625 8.49375C5.79375 8.325 5.7375 8.15625 5.7375 7.9875C5.7375 7.7625 5.85 7.5375 6.01875 7.425L8.71875 5.0625C8.775 5.00625 8.83125 5.00625 8.8875 4.95C8.94375 4.95 8.94375 4.95 9 4.89375C9.05625 4.89375 9.05625 4.89375 9.1125 4.89375L9.16875 4.89375C9.225 4.89375 9.225 4.89375 9.28125 4.89375L9.3375 4.89375C9.39375 4.89375 9.39375 4.89375 9.45 4.95C9.45 4.95 9.50625 4.95 9.50625 5.00625L9.5625 5.0625C9.5625 5.0625 9.5625 5.0625 9.61875 5.11875L11.9812 7.5375C12.2625 7.81875 12.2625 8.325 11.9812 8.60625C11.7 8.8875 11.1937 8.8875 10.9125 8.60625L9.84375 7.48125L9.84375 12.4875C9.84375 12.8813 9.50625 13.275 9.05625 13.275C8.775 13.1625 8.4375 12.825 8.4375 12.4313Z" fill="#1FBF75"/>
                                        </g>
                                        <defs>
                                        <clipPath id="clip0_1055_214">
                                        <rect width="18" height="18" fill="white" transform="translate(18) rotate(90)"/>
                                        </clipPath>
                                        </defs>
                                        </svg>
                                        </li>
                                        <li class="font-w600 text-success ms-2">+15%</li>
                                    </ul>
                                </div>
                                <div class="col-xl-2 col-lg-2 col-6">
                                    <p class="font-w500 text-danger mb-0">Expense</p>
                                    <h4 class="cate-title data">$2890,00</h4>
                                    <ul class="d-flex align-items-center">
                                        <li><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_1055_221)">
                                            <path d="M0.5625 9C0.5625 13.6688 4.33125 17.4375 9 17.4375C13.6687 17.4375 17.4375 13.6688 17.4375 9C17.4375 4.33125 13.6688 0.5625 9 0.5625C4.33125 0.5625 0.5625 4.33125 0.5625 9ZM9.5625 5.56875L9.5625 10.7438L11.025 9.45C11.3625 9.16875 11.8125 9.225 12.0938 9.50625C12.2063 9.675 12.2625 9.84375 12.2625 10.0125C12.2625 10.2375 12.15 10.4625 11.9812 10.575L9.28125 12.9375C9.225 12.9938 9.16875 12.9938 9.1125 13.05C9.05625 13.05 9.05625 13.05 9 13.1063C8.94375 13.1063 8.94375 13.1063 8.8875 13.1063L8.83125 13.1063C8.775 13.1063 8.775 13.1063 8.71875 13.1063L8.6625 13.1063C8.60625 13.1063 8.60625 13.1062 8.55 13.05C8.55 13.05 8.49375 13.05 8.49375 12.9938L8.4375 12.9375C8.4375 12.9375 8.4375 12.9375 8.38125 12.8812L6.01875 10.4625C5.7375 10.1813 5.7375 9.675 6.01875 9.39375C6.3 9.1125 6.80625 9.1125 7.0875 9.39375L8.15625 10.5187L8.15625 5.5125C8.15625 5.11875 8.49375 4.725 8.94375 4.725C9.225 4.8375 9.5625 5.175 9.5625 5.56875Z" fill="#EB5757"/>
                                            </g>
                                            <defs>
                                            <clipPath id="clip0_1055_221">
                                            <rect width="18" height="18" fill="white" transform="translate(0 18) rotate(-90)"/>
                                            </clipPath>
                                            </defs>
                                            </svg>
                                        </li>
                                        <li class="font-w600 text-danger ms-2">-10%</li>
                                    </ul>
                                </div>
                                <div class="col-xl-3 align-self-center col-lg-3 col-3">
                                    <div class="text-end text-sm-start text-xl-end text-nowrap">
                                        <a  href="withdrow.html" class="btn btn-primary">Withdraw <svg class="ms-2" width="10" height="18" viewBox="0 0 11 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.8 7.9C3.53 7.31 2.8 6.7 2.8 5.75C2.8 4.66 3.81 3.9 5.5 3.9C6.92 3.9 7.63 4.44 7.89 5.3C8.01 5.7 8.34 6 8.76 6H9.06C9.72 6 10.19 5.35 9.96 4.73C9.54 3.55 8.56 2.57 7 2.19V1.5C7 0.67 6.33 0 5.5 0C4.67 0 4 0.67 4 1.5V2.16C2.06 2.58 0.5 3.84 0.5 5.77C0.5 8.08 2.41 9.23 5.2 9.9C7.7 10.5 8.2 11.38 8.2 12.31C8.2 13 7.71 14.1 5.5 14.1C3.85 14.1 3 13.51 2.67 12.67C2.52 12.28 2.18 12 1.77 12H1.49C0.82 12 0.35 12.68 0.6 13.3C1.17 14.69 2.5 15.51 4 15.83V16.5C4 17.33 4.67 18 5.5 18C6.33 18 7 17.33 7 16.5V15.85C8.95 15.48 10.5 14.35 10.5 12.3C10.5 9.46 8.07 8.49 5.8 7.9Z" fill="white"/>
                                        </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>























                <div class="row">



                    <div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
                        <div class="widget-stat card bg-secondary overflow-hidden">
                            <div class="card-body p-4">
                                <a href="{{ route('seller.restoData', ['shop' => $shop]) }}">
                                <div class="media">
                                    <span class="me-3">
                                        <i class="la la-store-alt"></i>
                                    </span>
                                    <div class="media-body text-white">
                                        <p class="mb-1">Shopdaten</p>
                                        <h3 class="text-white">28</h3>
                                        <div class="progress mb-2 bg-primary">
                                            <div class="progress-bar progress-animated bg-white" style="width: 76%"></div>
                                        </div>
                                        <small>76% Fertig</small>
                                    </div>
                                </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
						<div class="widget-stat card">
							<div class="card-body p-4">
                                <a href="{{ route('seller.restoData', ['shop' => $shop]) }}">
								<div class="media ai-icon">
									<span class="me-3 bgl-primary text-primary">
										<!-- <i class="ti-user"></i> -->
										<svg id="icon-customers" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
											<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
											<circle cx="12" cy="7" r="4"></circle>
										</svg>
									</span>
									<div class="media-body">
										<p class="mb-1">Patient</p>
										<h4 class="mb-0">3280</h4>
										<span class="badge badge-primary">+3.5%</span>
									</div>
								</div>
                                </a>
							</div>
						</div>
                    </div>



                    <div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
                        <div class="widget-stat card overflow-hidden">
                            <div class="card-body p-4">
                                <a href="{{ route('seller.deliveryarea', ['shop' => $shop]) }}">
                                <div class="media">
                                    <span class="me-3 bgl-info text-success">
                                        <i class="la la-map-marker-alt"></i>
                                    </span>
                                    <div class="media-body text-white">
                                        <p class="mb-1">Liefergebiet</p>
                                        <h3 class="text-white">28</h3>
                                        <div class="progress mb-2 bg-primary">
                                            <div class="progress-bar progress-animated bg-white" style="width: 76%"></div>
                                        </div>
                                        <small>76% Fertig</small>
                                    </div>
                                </div>
                                </a>
                            </div>
                        </div>
                    </div>



					<div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
						<div class="widget-stat card">
							<div class="card-body  p-4">
								<div class="media">
									<span class="me-3 bgl-success text-success">
										<i class="la la-users"></i>
									</span>
									<div class="media-body">
										<p class="mb-1">Total Students</p>
										<h3>3280x</h3>
										<div class="progress mb-2 bg-white">
                                            <div class="progress-bar progress-animated bg-primary" style="width: 80%"></div>
                                        </div>
										<small>80% Increase in 20 Days</small>
									</div>
								</div>
							</div>
						</div>
                    </div>

					<div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
						<div class="widget-stat card bg-warning">
							<div class="card-body p-4">
								<div class="media">
									<span class="me-3">
										<i class="la la-user"></i>
									</span>
									<div class="media-body text-white">
										<p class="mb-1">New Students</p>
										<h3 class="text-white">245</h3>
										<div class="progress mb-2 bg-primary">
                                            <div class="progress-bar progress-animated bg-white" style="width: 50%"></div>
                                        </div>
										<small>50% Increase in 25 Days</small>
									</div>
								</div>
							</div>
						</div>
                    </div>

					<div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
						<div class="widget-stat card bg-warning">
							<div class="card-body p-4">
								<div class="media">
									<span class="me-3">
										<i class="la la-business-time"></i>
									</span>
									<div class="media-body text-white">
										<p class="mb-1">New Students</p>
										<h3 class="text-white">245</h3>
										<div class="progress mb-2 bg-primary">
                                            <div class="progress-bar progress-animated bg-white" style="width: 50%"></div>
                                        </div>
										<small>50% Increase in 25 Days</small>
									</div>
								</div>
							</div>
						</div>
                    </div>

					<div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
						<div class="widget-stat card bg-secondary overflow-hidden">
							<div class="card-body p-4">
								<div class="media">
									<span class="me-3">
										<i class="la la-store-alt"></i>
									</span>
									<div class="media-body text-white">
										<p class="mb-1">Total Course</p>
										<h3 class="text-white">28</h3>
										<div class="progress mb-2 bg-primary">
                                            <div class="progress-bar progress-animated bg-white" style="width: 76%"></div>
                                        </div>
										<small>76% Increase in 20 Days</small>
									</div>
								</div>
							</div>
						</div>
                    </div>


    <!-- Den Link um die Karte herum hinzufügen -->
        <div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
            <div class="widget-stat card bg-secondary overflow-hidden">
                <div class="card-body p-4">
                    <a href="{{ route('seller.restoData', ['shop' => $shop]) }}">
                    <div class="media">
                        <span class="me-3">
                            <i class="la la-store-alt"></i>
                        </span>
                        <div class="media-body text-white">
                            <p class="mb-1">Total Course</p>
                            <h3 class="text-white">28</h3>
                            <div class="progress mb-2 bg-primary">
                                <div class="progress-bar progress-animated bg-white" style="width: 76%"></div>
                            </div>
                            <small>76% Increase in 20 Days</small>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </div>






                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->














        <style>
            /* CSS für den Hover-Effekt und Animation */
            .widget-stat.card {
                position: relative;
                overflow: hidden;
                transition: all 0.3s ease;
                text-decoration: none; /* Entfernen der Standardlink-Unterstreichung */
            }

            .widget-stat.card:hover {
                transform: scale(1.05);
                cursor: pointer;
            }

            .widget-stat.card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(83, 82, 82, 0.5);
                opacity: 0;
                transition: opacity 0.3s ease;
                pointer-events: none;
            }

            .widget-stat.card:hover::before {
                opacity: 1;
            }

            .widget-stat.card:hover .media-body {
                transform: translateY(-50%);
            }

            .widget-stat.card .media-body {
                position: relative;
                z-index: 1;
                transition: transform 0.3s ease;
            }

            .widget-stat.card .media-body p,
            .widget-stat.card .media-body h3,
            .widget-stat.card .media-body small {
                color: #0e0d0d;
            }

            /* CSS für den Mauszeiger */
            .widget-stat.card:hover {
                cursor: pointer;
            }

            .widget-stat.card:hover .la-store-alt {
                color: red; /* Farbe des Icons ändern */
            }
        </style>






      @push('specific-script')



	<script src="{{ asset('backend/vendor/bootstrap-datetimepicker/js/moment.js') }}"></script>
	<script src="{{ asset('backend/vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
	<script src="{{ asset('backend/vendor/peity/jquery.peity.min.js') }}"></script>
	<script src="{{ asset('backend/vendor/swiper/js/swiper-bundle.min.js') }}"></script>

	<!-- Dashboard 1 -->
	<script src="{{ asset('backend/js/dashboard/dashboard-2.js') }}"></script>

	<script src="{{ asset('backend/js/dlabnav-init.js') }}"></script>
    <script src="{{ asset('backend/js/custom.js') }}"></script>

      @endpush

@endsection


