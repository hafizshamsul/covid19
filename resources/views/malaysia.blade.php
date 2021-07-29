@extends('layout.mainlayout')

@section('content')
    <?php
        $jsonFix_cases_malaysia = urldecode($csvToJson_cases_malaysia);
        $cases_malaysia = json_decode($jsonFix_cases_malaysia, true);

        $jsonFix_deaths_malaysia = urldecode($csvToJson_deaths_malaysia);
        $deaths_malaysia = json_decode($jsonFix_deaths_malaysia, true);
        
        $jsonFix_vax_malaysia = urldecode($csvToJson_vax_malaysia);
        $vax_malaysia = json_decode($jsonFix_vax_malaysia, true);

        $jsonFix_population = urldecode($csvToJson_population);
        $population = json_decode($jsonFix_population, true);

        $malaysiapopulation = $population[0]['pop'];
        $malaysiavaccinated = (int)$vax_malaysia[sizeof($vax_malaysia)-1]['dose2_cumul'];
        $vaccinatedpercentage = (double)$malaysiavaccinated / (double)$malaysiapopulation * 100;

        $malaysiavaccinated2_lastweek = 0;
        for($i=(sizeof($vax_malaysia)-7); $i<(sizeof($vax_malaysia)); $i++){
            $malaysiavaccinated2_lastweek += (int)$vax_malaysia[$i]['dose2_daily'];
        }
        $vaccinationrate2_lastweek = (double)$malaysiavaccinated2_lastweek / 7;

        $hi = $malaysiapopulation * 0.8;
        $daystohi = ($hi - $malaysiavaccinated) / $vaccinationrate2_lastweek;
        $daystohi_int = (int)$daystohi;

        $datetoday = date('Y-m-d');
        $datetohi = date('Y-m-d', strtotime($datetoday. " + $daystohi_int days"));

        $vaccinatedratio = (double)$vax_malaysia[sizeof($vax_malaysia)-1]['dose2_cumul'] / $malaysiapopulation * 100;
        $nonvaccinatedratio = 100 - $vaccinatedratio;
        $targetimmunity = 80;

        $lol = array(
            array("Date", "Cases")
        );

        $lel = array(
            array("Date", "Deaths")
        );

        $lal = array(
            array("Date", "At least 1 dose", "Fully vaccinated")
        );

        for($i=0; $i<(sizeof($cases_malaysia)); $i++){
            array_push($lol, array($cases_malaysia[$i]['date'], (int)$cases_malaysia[$i]['cases_new']));   
        }

        for($i=0; $i<(sizeof($deaths_malaysia)); $i++){
            array_push($lel, array($deaths_malaysia[$i]['date'], (int)$deaths_malaysia[$i]['deaths_new']));
        }

        for($i=0; $i<(sizeof($vax_malaysia)); $i++){
            array_push($lal, array($vax_malaysia[$i]['date'], (int)$vax_malaysia[$i]['dose1_cumul'], (int)$vax_malaysia[$i]['dose2_cumul']));
        }
    ?>

    <script type="text/javascript">
        $(function() {
            var keys = ['my-sa', 'my-sk', 'my-la', 'my-pg', 'my-kh', 'my-sl', 'my-ph', 'my-kl', 'my-pj', 'my-pl', 'my-jh', 'my-pk', 'my-kn', 'my-me', 'my-ns', 'my-te', ''],
                data = {};

            for (var i = 2021; i <= 2021; i++) {
                data[i] = [];
                keys.forEach(function(key) {
                    data[i].push({
                        'hc-key': key,
                        value: Math.random() * 50
                    });
                });
            }

            var chart = Highcharts.mapChart('container', {
                title: {
                    text: ''
                },
                mapNavigation: {
                    enabled: false,
                    buttonOptions: {
                        verticalAlign: 'top'
                    }
                },
                colorAxis: {
                    min: 0
                },
                series: [{
                    data: data[2021],
                    mapData: Highcharts.maps['countries/my/my-all'],
                    joinBy: 'hc-key',
                    name: '{point.name}',
                    dataLabels: {
                        enabled: true,
                        format: ''
                    }
                }],
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        }
                    }]
                },
                exporting: {
                    enabled: false
                },
                credits: {
                    enabled: false
                },
            });

            $('#slider').on('input', function(e) {
                $('#year').text(this.value);

                chart.series[0].setData(data[this.value]);
            });
        });

        </script>

        <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart_cases_malaysia);
            google.charts.setOnLoadCallback(drawChart_deaths_malaysia);
            google.charts.setOnLoadCallback(drawChart_vax_malaysia);

            var lol = <?php echo json_encode($lol); ?>;
            var lel = <?php echo json_encode($lel); ?>;
            var lal = <?php echo json_encode($lal); ?>;


            function drawChart_cases_malaysia() {
                var data = google.visualization.arrayToDataTable(lol);

                var options = {
                    chartArea: {
                        width: '100%',
                        height: '100%'
                    },
                    legend: {position: 'bottom'},
                    series: {
                        0: {
                            color: '#1a67d2'
                        }
                    },
                    hAxis: {
                        //ticks: [5000,10000,15000,20000]
                        textPosition: 'none'
                    },
                    vAxis: {
                        ticks: [5000,10000,15000,20000],
                        gridlines: {
                            color: "rgb(234,234,234)"
                        },
                        baselineColor: '#bad1f1'
                    }
                };

                var chart = new google.visualization.AreaChart(document.getElementById('chart_div_cases_malaysia'));
                chart.draw(data, options);
            }

            function drawChart_deaths_malaysia() {
                var data = google.visualization.arrayToDataTable(lel);

                var options = {
                    chartArea: {
                        width: '100%',
                        height: '100%'
                    },
                    legend: {position: 'bottom'},
                    series: {
                            0: {
                                color: '#3c4044'
                            }
                    },
                    hAxis: {
                        //ticks: [5000,10000,15000,20000]
                        textPosition: 'none'
                        },
                    vAxis: {
                        ticks: [60,120,180,240],
                        gridlines: {
                            color: "rgb(234,234,234)"
                        },
                        baselineColor: '#c4c5c7'
                    }
                };

                var chart = new google.visualization.AreaChart(document.getElementById('chart_div_deaths_malaysia'));
                chart.draw(data, options);
            }

            function drawChart_vax_malaysia() {
                var data = google.visualization.arrayToDataTable(lal);

                var options = {
                    chartArea: {
                        width: '100%',
                        height: '100%'
                    },
                    legend: {position: 'bottom'},
                    series: {
                            0: {
                                color: '#58af61'
                            },
                            1: {
                                color: '#58af61'
                            }
                    },
                    hAxis: {
                        //ticks: [5000,10000,15000,20000]
                        textPosition: 'none'
                        },
                    vAxis: {
                        ticks: [3500000,7000000,10500000,14000000],
                        gridlines: {
                            color: "rgb(234,234,234)"
                        },
                        baselineColor: '#58af61'
                    }
                };

                var chart = new google.visualization.AreaChart(document.getElementById('chart_div_vax_malaysia'));
                chart.draw(data, options);
            }

            $(window).resize(function(){
                drawChart_cases_malaysia();
                drawChart_deaths_malaysia();
                drawChart_vax_malaysia();
            });
        </script>

        <script>
            

        </script>

    <body>
        <div id="layout" style="margin: 14px 12px">
            <!--
                <div id="container" style="margin: 20px 0"></div>
            
                <input id="slider" type="range" min="2021" max="2021" step="1" value="2021"> 
                <p id="year">2021</p>
            -->
            <div></div>

            <div>
                <h5 style="margin: 15px 0">Vaccinations</h5>

                <div id="hi-progress" style="grid-template-columns: <?php echo $vaccinatedratio;?>% auto">
                    <div style="height: 100%; width: 100%; background: #58af61"></div>
                    <div style="height: 100%; width: 100%; background: rgb(240,240,240)"></div>
                </div>

                <div style="display: grid; font-size: 12px; margin: 12px 0 36px 0; color: #3c4043">
                    {{number_format($vaccinatedpercentage, 1)}}% of Malaysians have fully vaccinated ({{number_format($malaysiavaccinated)}} out of {{number_format($malaysiapopulation)}}) since 25 February 2021.
                    If it continues with the average 2-dose vaccination rate for the past 7 days ({{number_format($vaccinationrate2_lastweek, 0)}} per day), we are expected to reach 80% vaccination rate (possible herd immunity)
                    in {{$daystohi_int}} days, which is by {{$datetohi}}.
                </div>

                <!--
                <div id="hi-progress" style="grid-template-columns: 77% 6% 17%">
                    <div style="height: 100%; width: 100%;"></div>
                    <div style="height: 100%; width: 100%; text-align: center">80%</div>
                    <div style="height: 100%; width: 100%; "></div>
                </div>
                -->
                
                <h5 style="margin: 15px 0">Statistics</h5>

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">New cases</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Deaths</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Vaccinations</button>
                    </li>
                    <li class="nav-iem" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Tests</button>
                    </li>
                </ul>

                <div style="display: grid; font-size: 12px; margin: 12px 0 36px 0; color: #3c4043">
                From Wikipedia and others - Last updated: 4 hours ago
                </div>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div id="chart_div_cases_malaysia" style="height: 170px; margin: -1px 0"></div>
                    </div>

                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div id="chart_div_deaths_malaysia" style="height: 170px; margin: -1px 0"></div>
                    
                    </div>

                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <div id="chart_div_vax_malaysia" style="height: 170px; margin: -1px 0"></div>
                    </div>

                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    
                    </div>
                </div>

                <div style="display: grid; margin: 20px 0; border-top: 1px solid #ebebeb"></div>
                <div style="display: grid; color: rgb(150,150,150); font-size: 12px">
                Each day shows new cases reported since the previous day
                </div>

                <div style="display: grid; color: rgb(150,150,150); font-size: 12px">
                <u>About this data</u>
                </div>

                <h5 style="margin: 15px 0">Cases overview</h5>
                <div style="display: grid; font-size: 12px">
                From Wikipedia and others - Last updated: 4 hours ago
                </div>

                <div style="display: grid; margin: 20px 0; border-top: 1px solid #ebebeb"></div>
            </div>

            <div></div>


            
        </div>

@endsection

    



