@extends('frontend.layouts.default')
@section('content')
    <!-- seitenabhengig css -->
    @push('specific-css')
        <link href="{{ asset('frontend/css/contacts.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    @endpush

    <body id="register_bg">

        @include('frontend.includes.header-clearfix-element-to-stick')

		<div class="hero_single inner_pages background-image" data-background="url({{ asset('frontend/img/home_section_2.jpg') }})">
			<div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-xl-9 col-lg-10 col-md-8">
							<h1>@autotranslate('Media Data Statistics', app()->getLocale())</h1>
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
		    <div class="container margin_60_40">

                <div class="container mt-5">
                    <h1>@autotranslate('Media Data Statistics', app()->getLocale())</h1>
                    <h2>Total Requests</h2>
                    <p>{{ $totalRequests }}</p>

                    <h2>@autotranslate('Popular Pages', app()->getLocale())</h2>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>URL</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($popularPages as $page)
                                <tr>
                                    <td>{{ $page->url }}</td>
                                    <td>{{ $page->total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <h2>@autotranslate('Requests by Date', app()->getLocale())</h2>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requestsByDate as $request)
                                <tr>
                                    <td>{{ $request->date }}</td>
                                    <td>{{ $request->total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <h2>@autotranslate('Device Statistics', app()->getLocale())</h2>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>User Agent</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($deviceStats as $device)
                                <tr>
                                    <td>{{ $device->user_agent }}</td>
                                    <td>{{ $device->total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <h2>@autotranslate('Referrer Statistics', app()->getLocale())</h2>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Referrer</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($referrerStats as $referrer)
                                <tr>
                                    <td>{{ $referrer->referrer }}</td>
                                    <td>{{ $referrer->total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


                <div class="container mt-5">
                    <h1>@autotranslate('Media Data Charts', app()->getLocale())</h1>

                    <div class="row">
                        <div class="col-md-6">
                            <h2>@autotranslate('Popular Pages', app()->getLocale())</h2>
                            <canvas id="popularPagesChart"></canvas>
                        </div>

                        <div class="col-md-6">
                            <h2>@autotranslate('Requests by Date', app()->getLocale())</h2>
                            <canvas id="requestsByDateChart"></canvas>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h2>@autotranslate('Referrer Statistics', app()->getLocale())</h2>
                            <canvas id="referrerStatsChart"></canvas>
                        </div>

                        <div class="col-md-6">
                            <h2>@autotranslate('Device Statistics', app()->getLocale())</h2>
                            <canvas id="deviceStatsChart"></canvas>
                        </div>
                    </div>
                </div>
		        <!-- /row -->
		    </div>
		    <!-- /container -->
		</div>
		<!-- /bg_gray -->

		<div class="container margin_60_20">
		    <h5 class="mb_5">@autotranslate('Drop Us a Line', app()->getLocale())</h5>
		    <div class="row">
		        <div class="col-lg-4 col-md-6 add_bottom_25">
		            <div id="message-contact"></div>
			            <form method="post" action="assets/contact.php" id="contactform" autocomplete="off">
			                <div class="form-group">
			                    <input class="form-control" type="text" placeholder="Name" id="name_contact" name="name_contact">
			                </div>
			                <div class="form-group">
			                    <input class="form-control" type="email" placeholder="Email" id="email_contact" name="email_contact">
			                </div>
			                <div class="form-group">
			                    <textarea class="form-control" style="height: 150px;" placeholder="Message" id="message_contact" name="message_contact"></textarea>
			                </div>
			                <div class="form-group">
			                    <input class="form-control" type="text" id="verify_contact" name="verify_contact" placeholder="Are you human? 3 + 1 =">
			                </div>
			                <div class="form-group">
			                    <input class="btn_1 gradient full-width" type="submit" value="Submit" id="submit-contact">
			                </div>
			            </form>
		        	</div>
		            <div class="col-lg-8 col-md-6 add_bottom_25">
<iframe class="map_contact" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6071.097548345398!2d10.5260556!3d52.265063499999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47b0dc1ff908751b%3A0x42019cc0c322ca0!2sBraunschweig%20City!5e0!3m2!1sen!2sde!4v1622711203369!5m2!1sen!2sde" allowfullscreen></iframe>		            </div>
		        </div>
		    </div>
		    <!-- /row -->
		</div>
		<!-- /container -->










        @push('specific-scripts')

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

      <script>
            document.addEventListener('DOMContentLoaded', function() {
                var ctx1 = document.getElementById('popularPagesChart').getContext('2d');
                var popularPagesChart = new Chart(ctx1, {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($popularPages->pluck('url')) !!},
                        datasets: [{
                            label: 'Total Visits',
                            data: {!! json_encode($popularPages->pluck('total')) !!},
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                var ctx2 = document.getElementById('requestsByDateChart').getContext('2d');
                var requestsByDateChart = new Chart(ctx2, {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($requestsByDate->pluck('date')) !!},
                        datasets: [{
                            label: 'Total Requests',
                            data: {!! json_encode($requestsByDate->pluck('total')) !!},
                            backgroundColor: 'rgba(153, 102, 255, 0.2)',
                            borderColor: 'rgba(153, 102, 255, 1)',
                            borderWidth: 1,
                            fill: true
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                var ctx3 = document.getElementById('deviceStatsChart').getContext('2d');
                var deviceStatsChart = new Chart(ctx3, {
                    type: 'pie',
                    data: {
                        labels: {!! json_encode($deviceStats->pluck('user_agent')) !!},
                        datasets: [{
                            label: 'Device Usage',
                            data: {!! json_encode($deviceStats->pluck('total')) !!},
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true
                    }
                });

                var ctx4 = document.getElementById('referrerStatsChart').getContext('2d');
                var referrerStatsChart = new Chart(ctx4, {
                    type: 'doughnut',
                    data: {
                        labels: {!! json_encode($referrerStats->pluck('referrer')) !!},
                        datasets: [{
                            label: 'Referrers',
                            data: {!! json_encode($referrerStats->pluck('total')) !!},
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true
                    }
                });
            });
        </script>







        @endpush
    @endsection
