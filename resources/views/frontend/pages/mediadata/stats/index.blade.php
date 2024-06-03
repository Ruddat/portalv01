@extends('frontend.layouts.default')
@section('content')
    <!-- seitenabhengig css -->
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
                            <h1>@autotranslate('Media Data Statistics', app()->getLocale())</h1>
                            <p>@autotranslate('Die Mediendatenstatistik bietet einen Überblick über die Nutzung von Medieninhalten, um Trends zu identifizieren und Entscheidungen im Marketing oder der Inhaltsproduktion zu informieren.', app()->getLocale())</p>
                        </div>
                    </div>
                    <!-- /row -->
                </div>
            </div>
            <div class="wave gray hero"></div>
        </div>
        <!-- /hero_single -->




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
                            <!-- Hier die Karten hinzufügen -->

                            <div class="card">
                                <div class="card-header" role="tab">
                                    <h5>@autotranslate('Total Requests', app()->getLocale()) {{ $totalRequests }}
                                    </h5>
                                </div>

                            </div>

                            <div class="card">
                                <div class="card-header" role="tab">
                                    <h5>@autotranslate('Popular Pages', app()->getLocale())
                                    </h5>
                                </div>

                                <div class="card-body">
                                    <div class="divTable blueTable">
                                        <div class="divTableHeading">
                                            <div class="divTableRow">
                                                <div class="divTableHead">URL</div>
                                                <div class="divTableHead">@autotranslate('Total', app()->getLocale())</div>
                                            </div>
                                        </div>
                                        <div class="divTableBody">

                                            @foreach ($popularPages as $page)
                                                <div class="divTableRow">
                                                    <div class="divTableCell">{{ $page->url }}</div>
                                                    <div class="divTableCell">{{ $page->total }}</div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="blueTable outerTableFooter">
                                        <div class="tableFootStyle">
                                            <div class="links">
                                                {{ $popularPages->links() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="card">
                                <div class="card-header" role="tab">
                                    <h5>@autotranslate('Requests by Date', app()->getLocale())</h5>
                                </div>

                                <div class="card-body">


                                    <div class="divTable blueTable">
                                        <div class="divTableHeading">
                                            <div class="divTableRow">
                                                <div class="divTableHead">@autotranslate('Date', app()->getLocale())</div>
                                                <div class="divTableHead">@autotranslate('Total', app()->getLocale())</div>
                                            </div>
                                        </div>
                                        <div class="divTableBody">

                                            @foreach ($requestsByDate as $request)
                                                <div class="divTableRow">
                                                    <div class="divTableCell">{{ $request->date }}</div>
                                                    <div class="divTableCell">{{ $request->total }}</div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>




                            <div class="card">
                                <div class="card-header" role="tab">
                                    <h5>@autotranslate('Device Statistics', app()->getLocale())</h5>
                                </div>

                                <div class="card-body">
                                    <div class="divTable blueTable">
                                        <div class="divTableHeading">
                                            <div class="divTableRow">
                                                <div class="divTableHead">User Agent</div>
                                                <div class="divTableHead">@autotranslate('Total', app()->getLocale())</div>
                                            </div>
                                        </div>
                                        <div class="divTableBody">

                                            @foreach ($deviceStats as $device)
                                                <div class="divTableRow">
                                                    <div class="divTableCell">{{ $device->user_agent }}</div>
                                                    <div class="divTableCell">{{ $device->total }}</div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="card">
                                <div class="card-header" role="tab">
                                    <h5>@autotranslate('Referrer Statistics', app()->getLocale())</h5>
                                </div>

                                <div class="card-body">


                                    <div class="divTable blueTable">
                                        <div class="divTableHeading">
                                            <div class="divTableRow">
                                                <div class="divTableHead">Referrer</div>
                                                <div class="divTableHead">@autotranslate('Total', app()->getLocale())</div>
                                            </div>
                                        </div>
                                        <div class="divTableBody">

                                            @foreach ($referrerStats as $referrer)
                                                <div class="divTableRow">
                                                    <div class="divTableCell">{{ $referrer->referrer }}</div>
                                                    <div class="divTableCell">{{ $referrer->total }}</div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                    <div class="blueTable outerTableFooter">
                                        <div class="tableFootStyle">
                                            <div class="links">
                                                <a href="#">&laquo;</a>
                                                <a class="active" href="#">1</a>
                                                <a href="#">2</a>
                                                <a href="#">3</a>
                                                <a href="#">&raquo;</a>
                                            </div>
                                        </div>
                                    </div>








                                </div>
                            </div>








                        </div>
                        <!-- /accordion group -->
                    </div>
                    <!-- /col -->
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10">
                        <!-- Hier die Karten hinzufügen -->
                    </div>
                </div>
            </div>
        </div>


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


            div.blueTable {
                border: 1px solid #1C6EA4;
                background-color: #EEEEEE;
                width: 100%;
                text-align: left;
                border-collapse: collapse;
            }

            .divTable.blueTable .divTableCell,
            .divTable.blueTable .divTableHead {
                border: 1px solid #AAAAAA;
                padding: 3px 2px;
            }

            .divTable.blueTable .divTableBody .divTableCell {
                font-size: 13px;
            }

            .divTable.blueTable .divTableRow:nth-child(even) {
                background: #D0E4F5;
            }

            .divTable.blueTable .divTableHeading {
                background: #1C6EA4;
                background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
                background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
                background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
                border-bottom: 2px solid #444444;
            }

            .divTable.blueTable .divTableHeading .divTableHead {
                font-size: 15px;
                font-weight: bold;
                color: #FFFFFF;
                border-left: 2px solid #D0E4F5;
            }

            .divTable.blueTable .divTableHeading .divTableHead:first-child {
                border-left: none;
            }

            .blueTable .tableFootStyle {
                font-size: 14px;
                font-weight: bold;
                color: #FFFFFF;
                background: #D0E4F5;
                background: -moz-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
                background: -webkit-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
                background: linear-gradient(to bottom, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
                border-top: 2px solid #444444;
            }

            .blueTable .tableFootStyle {
                font-size: 14px;
            }

            .blueTable .tableFootStyle .links {
                text-align: right;
            }

            .blueTable .tableFootStyle .links a {
                display: inline-block;
                background: #1C6EA4;
                color: #FFFFFF;
                padding: 2px 8px;
                border-radius: 5px;
            }

            .blueTable.outerTableFooter {
                border-top: none;
            }

            .blueTable.outerTableFooter .tableFootStyle {
                padding: 3px 5px;
            }

            /* HTMLtable.com */
            .divTable {
                display: table;
            }

            .divTableRow {
                display: table-row;
            }

            .divTableHeading {
                display: table-header-group;
            }

            .divTableCell,
            .divTableHead {
                display: table-cell;
            }

            .divTableHeading {
                display: table-header-group;
            }

            .divTableFoot {
                display: table-footer-group;
            }

            .divTableBody {
                display: table-row-group;
            }
        </style>


    <div class="container margin_60_20">
            <h5 class="mb_5">@autotranslate('Drop Us a Line', app()->getLocale())</h5>
            <div class="row">
                <div class="col-lg-4 col-md-6 add_bottom_25">
                    <div id="message-contact"></div>
                    <form method="post" action="assets/contact.php" id="contactform" autocomplete="off">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Name" id="name_contact"
                                name="name_contact">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="email" placeholder="Email" id="email_contact"
                                name="email_contact">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" style="height: 150px;" placeholder="Message" id="message_contact"
                                name="message_contact"></textarea>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" id="verify_contact" name="verify_contact"
                                placeholder="Are you human? 3 + 1 =">
                        </div>
                        <div class="form-group">
                            <input class="btn_1 gradient full-width" type="submit" value="Submit" id="submit-contact">
                        </div>
                    </form>
                </div>
                <div class="col-lg-8 col-md-6 add_bottom_25">
                    <iframe class="map_contact"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6071.097548345398!2d10.5260556!3d52.265063499999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47b0dc1ff908751b%3A0x42019cc0c322ca0!2sBraunschweig%20City!5e0!3m2!1sen!2sde!4v1622711203369!5m2!1sen!2sde"
                        allowfullscreen></iframe>
                </div>
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
            labels: {!! json_encode($popularPages->pluck('url')->map(function($url) {
                // Hier die URL kürzen, zum Beispiel die ersten 30 Zeichen verwenden
                return strlen($url) > 30 ? substr($url, 0, 30) . '...' : $url;
            })) !!},
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
