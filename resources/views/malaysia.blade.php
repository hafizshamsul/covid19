@extends('layout.mainlayout')

@section('content')
    <?php
        $jsonFix_cases_malaysia = urldecode($csvToJson_cases_malaysia);
        $cases_malaysia = json_decode($jsonFix_cases_malaysia, true);

        $jsonFix_deaths_malaysia = urldecode($csvToJson_deaths_malaysia);
        $deaths_malaysia = json_decode($jsonFix_deaths_malaysia, true);
        
        $jsonFix_vax_malaysia = urldecode($csvToJson_vax_malaysia);
        $vax_malaysia = json_decode($jsonFix_vax_malaysia, true);

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

    <body>
        <div style="margin: 0 12px">
            <div id="container" style="margin: 20px 0"></div>
            <!--
                <input id="slider" type="range" min="2021" max="2021" step="1" value="2021"> 
                <p id="year">2021</p>
            -->
            
            <h4 style="margin: 15px 0">Statistics</h4>

            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">New cases</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Deaths</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Vaccinations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Tests</a>
                </li>
            </ul>
            <div id="chart_div_cases_malaysia" style="height: 150px; margin: 30px 0"></div>
            <div id="chart_div_deaths_malaysia" style="height: 150px; margin: 30px 0"></div>
            <div id="chart_div_vax_malaysia" style="height: 150px; margin: 30px 0"></div>

            <hr>
            <div style="display: grid; color: rgb(150,150,150); font-size: 12px">
            Each day shows new cases reported since the previous day
            </div>

            <div style="display: grid; color: rgb(150,150,150); font-size: 12px">
            <u>About this data</u>
            </div>

            <h4 style="margin: 15px 0">Cases overview</h4>
            <div style="display: grid; font-size: 12px">
            From Wikipedia and others - Last updated: 4 hours ago
            </div>

            <hr>
        </div>
    
    

    <!--cases_malaysia-->
    <div style="display: grid">
        <div>Total<div>
        <div>Today<div>
    <div>

    <!--cases_state-->
    <div style="display: grid">
        <div>Total<div>
        <div>Today<div>
    <div>

    <!--tests_malaysia-->
    <div style="display: grid">
        <div>Total<div>
        <div>Today<div>
    <div>

    <!--clusters-->
    <div style="display: grid">
        <div>Total<div>
        <div>Today<div>
    <div>

    <!--deaths_malaysia-->
    <div style="display: grid">
        <div>Total<div>
        <div>Today<div>
    <div>

    <!--deaths_state-->
    <div style="display: grid">
        <div>Total<div>
        <div>Today<div>
    <div>

    <!--pkrc-->
    <div style="display: grid">
        <div>Total<div>
        <div>Today<div>
    <div>

    <!--hospital-->
    <div style="display: grid">
        <div>Total<div>
        <div>Today<div>
    <div>

    <!--icu-->
    <div style="display: grid">
        <div>Total<div>
        <div>Today<div>
    <div>

@endsection

    



