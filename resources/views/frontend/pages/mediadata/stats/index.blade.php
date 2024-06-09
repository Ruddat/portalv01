@extends('frontend.layouts.default')
@section('content')
    @push('specific-css')
        <link href="{{ asset('frontend/css/contacts.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    @endpush

    <body id="register_bg">
        @include('frontend.includes.header-clearfix-element-to-stick')

        <div class="hero_media_single inner_pages background-image"
            data-background="url({{ asset('frontend/img/home_section_2.jpg') }})">
            <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-9 col-lg-10 col-md-8">
                            <h1>@autotranslate('Media Statistics', app()->getLocale())</h1>
                            <p>@autotranslate('Die Mediendatenstatistik bietet einen Überblick über die Nutzung von Medieninhalten, um Trends zu identifizieren und Entscheidungen im Marketing oder der Inhaltsproduktion zu informieren.', app()->getLocale())</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wave gray hero"></div>
        </div>

        <div class="bg_gray">
            <div class="container margin_30_40">
                <div class="main_title center">
                    <span><em></em></span>
                    <h2>@autotranslate('Media Data Charts', app()->getLocale())</h2>
                    <p>@autotranslate('Die Media Data Charts visualisieren die Daten der Mediendatenstatistik für eine leicht verständliche Darstellung.', app()->getLocale())</p>
                </div>

                <div class="row justify-content-center add_bottom_45">
                    <div class="col-lg-6 col-md-6">
                        <div class="box_topic submit">
                            <canvas id="popularPagesChart"></canvas>
                            <h3>@autotranslate('Media Data Charts', app()->getLocale())</h3>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="box_topic submit">
                            <canvas id="requestsByDateChart"></canvas>
                            <h3>@autotranslate('Popular Pages', app()->getLocale())</h3>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center add_bottom_45">
                    <div class="col-lg-6 col-md-6">
                        <div class="box_topic submit">
                            <canvas id="referrerStatsChart"></canvas>
                            <h3>@autotranslate('Referrer Statistics', app()->getLocale())</h3>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="box_topic submit">
                            <canvas id="deviceStatsChart"></canvas>
                            <h3>@autotranslate('Device Statistics', app()->getLocale())</h3>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center add_bottom_45">
                    <div class="col-lg-12">
                        <div class="main_title center">
                            <span><em></em></span>
                            <h3 style="margin-bottom: 0;">@autotranslate('Media Data Statistics', app()->getLocale())</h3>
                            <p>@autotranslate('Die Mediendatenstatistik bietet einen Überblick über die Nutzung und Performance verschiedener Mediendateien.', app()->getLocale())</p>
                        </div>

                        <div role="tablist" class="add_bottom_15 accordion_2" id="accordion_group">
                            <div class="card">
                                <div class="card-header" role="tab">
                                    <h5>@autotranslate('Total Requests', app()->getLocale()) {{ $totalRequests }}</h5>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" role="tab">
                                    <h5>@autotranslate('Popular Pages', app()->getLocale())</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>URL</th>
                                                    <th>@autotranslate('Total', app()->getLocale())</th>
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
                                    </div>

                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" role="tab">
                                    <h5>@autotranslate('Requests by Date', app()->getLocale())</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>@autotranslate('Date', app()->getLocale())</th>
                                                    <th>@autotranslate('Total', app()->getLocale())</th>
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
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" role="tab">
                                    <h5>@autotranslate('Device Statistics', app()->getLocale())</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>User Agent</th>
                                                    <th>@autotranslate('Total', app()->getLocale())</th>
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
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" role="tab">
                                    <h5>@autotranslate('Referrer Statistics', app()->getLocale())</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Referrer</th>
                                                    <th>@autotranslate('Total', app()->getLocale())</th>
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

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/row-->
            </div>
            <!-- /container -->
        </div>
        <!-- /bg_gray -->



    @push('specific-scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var ctx1 = document.getElementById('popularPagesChart').getContext('2d');
                var popularPagesChart = new Chart(ctx1, {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($popularPages->pluck('url')->map(function($url) {
                            return strlen($url) > 30 ? substr($url, 0, 30) . '...' : $url;
                        })) !!},
                        datasets: [{
                            label: 'Total',
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
                            label: 'Total',
                            data: {!! json_encode($requestsByDate->pluck('total')) !!},
                            backgroundColor: 'rgba(153, 102, 255, 0.2)',
                            borderColor: 'rgba(153, 102, 255, 1)',
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

                var ctx3 = document.getElementById('referrerStatsChart').getContext('2d');
                var referrerStatsChart = new Chart(ctx3, {
                    type: 'pie',
                    data: {
                        labels: {!! json_encode($referrerStats->pluck('referrer')) !!},
                        datasets: [{
                            label: 'Total',
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
                    }
                });

                var ctx4 = document.getElementById('deviceStatsChart').getContext('2d');
                var deviceStatsChart = new Chart(ctx4, {
                    type: 'doughnut',
                    data: {
                        labels: {!! json_encode($deviceStats->pluck('user_agent')) !!},
                        datasets: [{
                            label: 'Total',
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
                    }
                });
            });
        </script>
    @endpush
<style>
	.hero_media_single.inner_pages {
  height: 410px;
  background-position: center center;
  background-repeat: no-repeat;
  background-color: #ededed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  text-align: center;
}

.hero_media_single {
  width: 100%;
  position: relative;
  margin: 0;
  color: #fff;
}

.hero_media_single.inner_pages h1 {
  margin-top: 100px;
  color: whitesmoke;
}
</style>
@endsection
