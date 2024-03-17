@extends('backend.layouts.default-dark')
@section('pageTitle', isset($pageTitle) ? app(\App\Services\TranslationService::class)->trans($pageTitle, app()->getLocale()) : app(\App\Services\TranslationService::class)->trans('Page title here....', app()->getLocale()))
@section('content')








		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
			<div class="container">
				<div class="row">
					<div class="col-xl-12">
						<div class="row">
							<div class="col-xl-12">
								<div class="card income-bx">
									<div class="card-body">
										<div class="row">
											<div class="col-xl-4 col-lg-4 col-6">
												<div class="line position-relative">
													<p class="font-w500 mb-0">Total Income</p>
													<h2 class="mb-0 text-primary">$12,890,00</h2>
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




							<div class="col-xl-12">
								<div class="card">
									<div class="card-body pb-0">
										<div class="d-flex align-items-center justify-content-between mb-2">
											<h4 class="cate-title mb-0">Order Rate</h4>
											<div class="row">
                                            <select id="ortOption" class="form-control default-select style-1 w-auto border" >
												<option>Jeahr</option>
												<option>This Month</option>
												<option>Last Month</option>
											</select>
                                            <select id="ortOption22" class="form-control default-select style-1 w-auto border">
												<option>Month</option>
												<option>This Month</option>
												<option>Last Month</option>
											</select>
                                            </div>
										</div>
										<div class="d-flex align-items-center justify-content-between flex-wrap">
											<div class="d-flex align-items-center flex md-nowrap flex-wrap mb-3 mb-md-0">
												<div class="icon-bx bg-primary d-inline-block text-center me-3">
													<svg width="24" height="30" viewBox="0 0 24 30" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M20 8.5C20 4.09 16.41 0.5 12 0.5C7.58998 0.5 3.99998 4.09 3.99998 8.5C3.99998 12.91 7.58998 16.5 12 16.5C16.41 16.5 20 12.91 20 8.5ZM6.99998 8.5C6.99998 5.74 9.23997 3.5 12 3.5C14.76 3.5 17 5.74 17 8.5C17 11.26 14.76 13.5 12 13.5C9.23997 13.5 6.99998 11.26 6.99998 8.5ZM14.4 18.5H9.59998C4.35998 18.5 0.0999756 22.76 0.0999756 28C0.0999756 28.83 0.769976 29.5 1.59998 29.5H22.4C23.23 29.5 23.9 28.83 23.9 28C23.9 22.76 19.64 18.5 14.4 18.5ZM3.26998 26.5C3.94998 23.64 6.52998 21.5 9.59998 21.5H14.4C17.47 21.5 20.05 23.64 20.73 26.5H3.26998Z" fill="white"/>
													</svg>
												</div>
												<div class="me-3">
													<p class="mb-0">Order Total</p>
													<h4 class="font-w600 mb-0">25.307</h4>
												</div>
												<div class="card style-3 m-0  mt-sm-0  mt-3 mt-sm-0 ms-md-0 ms-lg-3">
													<div class="card-body p-3">
														<div class="d-flex align-items-center justify-content-between mb-2">
															<span>Target</span>
															<h6 class="font-w500 mb-0 data">3.982</h6>
														</div>
														<div class="progress default-progress">
															<div class="progress-bar bg-gradient1 progress-animated" style="width: 40%; height:10px;" role="progressbar">
																<span class="sr-only">45% Complete</span>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="d-flex align-items-center">
												<div class="me-4">
													<ul class="d-flex">
														<li class="text-nowrap"><svg class="me-2" width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
														<circle cx="6" cy="6.5" r="4.5" fill="white" stroke="#FC8019" stroke-width="3"/>
														</svg>This Month
														</li>
													</ul>
													<h4 class="font-w600 mb-0">1324</h4>
												</div>
												<div>
													<ul class="d-flex">
														<li class="text-nowrap"><svg class="me-2" width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
														<circle cx="6" cy="6.5" r="4.5" fill="white" stroke="#EB5757" stroke-width="3"/>
														</svg>Last Month
														</li>
													</ul>
													<h4 class="mb-0 font-w600">1324</h4>
												</div>
											</div>
										</div>
                                        <div id="chart"></div>
									</div>
								</div>
							</div>




                            <div class="col-lg-12">

                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="row">
                                    <div class="input-group search-area2">
                                        <span class="input-group-text p-0"><a href="javascript:void(0)"><svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M27.414 24.586L22.337 19.509C23.386 17.928 24 16.035 24 14C24 8.486 19.514 4 14 4C8.486 4 4 8.486 4 14C4 19.514 8.486 24 14 24C16.035 24 17.928 23.386 19.509 22.337L24.586 27.414C25.366 28.195 26.634 28.195 27.414 27.414C28.195 26.633 28.195 25.367 27.414 24.586ZM7 14C7 10.14 10.14 7 14 7C17.86 7 21 10.14 21 14C21 17.86 17.86 21 14 21C10.14 21 7 17.86 7 14Z" fill="#FC8019"/>
                                        </svg>
                                        </a></span>
                                        <input type="text" class="form-control p-0" placeholder="Search Bills">
                                    </div>

                                    <select id="ortOption" class="form-control default-select border w-auto">
                                        <option>All</option>
                                        <option>Ec-Cart</option>
                                        <option>Cash</option>
                                        <option>Online</option>
                                    </select>
                                </div>

                                    <select class="form-control default-select border w-auto" >
                                        <option>Recently</option>
                                        <option>Oldest</option>
                                        <option>Newest</option>
                                    </select>
                                </div>

                            </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Exam Toppers</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-responsive-md">
                                                <thead>
                                                    <tr>
                                                        <th><strong>ORDER</strong></th>
                                                        <th><strong>TIME</strong></th>
                                                        <th><strong>STATUS</strong></th>
                                                        <th><strong>NAME</strong></th>
                                                        <th><strong>STRASSE</strong></th>
                                                        <th><strong>PLZ/ORT</strong></th>
                                                        <th><strong>BESTELLTYP</strong></th>
                                                        <th><strong>TOTAL</strong></th>
                                                        <th><strong>BESTELLUNG</strong></th>
                                                        <th><strong>DATUM</strong></th>
                                                        <th><strong>STORNO</strong></th>
                                                        <th><strong>ACTION</strong></th>
                                                        <th style="width:50px;">
                                                            <div class="form-check custom-checkbox checkbox-success check-lg me-3">
                                                                <input type="checkbox" class="form-check-input" id="checkAll" required="">
                                                                <label class="form-check-label" for="checkAll"></label>
                                                            </div>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><strong>#542</strong></td>
                                                        <td>21:13</td>
                                                        <td><div class="d-flex align-items-center"><i class="fa fa-circle text-success me-1"></i> Successful</div></td>
                                                        <td><span class="w-space-no">Dr. Jackson</span></div></td>
                                                        <td>Ersestr. 63</td>
                                                        <td>31234 Edemissen</td>
                                                        <td>Online</td>
                                                        <td>$ 1,245</td>
                                                        <td><a href="#"><div class="d-flex align-items-center"><img src="{{ asset('uploads/pdf_icon.gif') }}" width="18" alt=""/></div></a></td>
                                                        <td>01 August 2020</td>
                                                        <td>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check custom-checkbox checkbox-success check-lg me-3">
                                                                <input type="checkbox" class="form-check-input" id="customCheckBox3" required="">
                                                                <label class="form-check-label" for="customCheckBox3"></label>
                                                            </div>
                                                        </td>
                                                    </tr>




                                                </tbody>
                                            </table>
                                        </div>
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
    <!-- Apex Chart -->
	<script src="{{ asset('backend/vendor/apexchart/apexchart.js') }}"></script>

    <script>
	var chart = function(){
		var optionsArea = {
          series: [{
            name: "",
            data: [80, 55, 50, 40, 75, 80, 40, 55, 50, 40, 75, 80]
          },
		  {
            name: "",
            data: [75, 25, 60, 25, 15, 70,75, 25, 60, 25, 15, 70]
          }
        ],
          chart: {
          height: 300,
          type: 'area',
		  group: 'social',
		  toolbar: {
            show: false
          },
          zoom: {
            enabled: false
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          width: [3, 3, 3],
		  colors:['#4CBC9A','#FF6A59'],
		  curve: 'smooth'
        },
        legend: {
			show:false,
          tooltipHoverFormatter: function(val, opts) {
            return val + ' - ' + opts.w.globals.series[opts.seriesIndex][opts.dataPointIndex] + ''
          },
		  markers: {
			fillColors:['#C046D3','#FF6A59','#FF9432'],
			width: 16,
			height: 16,
			strokeWidth: 0,
			radius: 16
		  }
        },

        xaxis: {
        categories: ['1', '2', '3', '4', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
		  labels: {
		   style: {
			  colors: '#3E4954',
			  fontSize: '14px',
			   fontFamily: 'Poppins',
			  fontWeight: 100,

			},
		  },
		  axisBorder:{
			  show: false
		  },
		  axisTicks: {

			show:false,
		  },
        },
		yaxis: {
			labels: {
			offsetX:-16,
			minWidth:40,
			style: {
			  colors: '#3E4954',
			  fontSize: '14px',
			   fontFamily: 'Poppins',
			  fontWeight: 100,

			},
		  },
		   axisTicks: {
			  show: false,
			  borderType: 'solid',
			  color: '#78909C',
			  width: 6,
			  offsetX: 0,
			  offsetY: 0
			},
		},
		fill: {
			colors:['#fff','#FF9432'],
			type:'gradient',
			opacity: 1,
			gradient: {
				shade:'light',
				shadeIntensity: 1,
				colorStops: [
				  [
					{
					  offset: 0,
					  color: '#4CBC9A',
					  opacity: .4
					},
					{
					  offset: 0.6,
					  color: '#4CBC9A',
					  opacity: .4
					},
					{
					   offset: 100,
					  color: '#fff',
					  opacity: 0.4
					}
				  ],
				  [
					{
					  offset: 0,
					  color: '#FEC64F',
					  opacity: .28
					},
					{
					  offset: 50,
					  color: '#FEC64F',
					  opacity: 0.25
					},
					{
					  offset: 100,
					  color: '#fff',
					  opacity: 0.4
					}
				  ]
				]

		  },
		},
		colors:['#1EA7C5','#FF9432'],
        grid: {
          borderColor: '#f1f1f1',
		  xaxis: {
            lines: {
              show: true
            }
          },
		  yaxis: {
            lines: {
              show: false
            }
          },
        },
		 responsive: [{
			breakpoint: 575,
			options: {
				markers: {
					 size: [6,6,4],
					 hover: {
						size: 7,
					  }
				}
			}
		 }]
        };
        var chartArea = new ApexCharts(document.querySelector("#chart"), optionsArea);
        chartArea.render();
    }


    chart();

    </script>

    @endpush

@endsection


