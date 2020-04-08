<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>Hello World</title>
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
        <link rel="stylesheet" href="{{ asset('css/odometer-theme-default.css') }}">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/odometer.js/0.4.8/odometer.min.js"></script>
    </head>

    <body>
        <div class="row">
            <div class="col-2" style="height:100vh; background-color:rgb(0,0,0,0.2)"></div>

            <div class="col-8" style="height:100vh">
                

                

                <?php
                    $lastupdated = date("d-m-Y, h:i");
                ?>
            
                <p style="text-align:center; font-size:20px; font-weight:bold; line-height:0px">COVID-19 CORONAVIRUS PANDEMIC</p>
                <p style="text-align:center; font-size: 10px; font-style:italic; color: rgba(255,255,255,0.5)">Last updated: {{$lastupdated}} GMT</p>

                <p style="text-align:center; margin-top:40px">
                    <a href="#">Graphs</a>
                    <a href="#">Countries</a>
                    <a href="#">Death Rate</a>
                    <a href="#">Incubation</a>
                    <a href="#">Age</a>
                    <a href="#">Symptoms</a>
                    <a href="#">News</a>
                </p>

                <?php
                    $world = json_decode($response2, true);
                    
                    $raw_cases = $world['cases'];
                    $world_cases = number_format($world['cases'], 0,'.',',');
                    
                    $raw_deaths = $world['deaths'];
                    $world_deaths = number_format($world['deaths'], 0,'.',',');

                    $raw_recovered = $world['recovered'];
                    $world_recovered = number_format($world['recovered'], 0,'.',',');
                    

                    //
                    $raw_todaycases = $world['todayCases'];
                    $world_todaycases = number_format($world['todayCases'], 0,'.',',');
                    
                    $raw_todaydeaths = $world['todayDeaths'];
                    $world_todaydeaths = number_format($world['todayDeaths'], 0,'.',',');
                    
                    //

                    $raw_active = $raw_cases - $raw_deaths - $raw_recovered;
                    $world_active = number_format($raw_active, 0,'.',',');

                    $raw_closed = $raw_deaths + $raw_recovered;
                    $world_closed = number_format($raw_closed, 0,'.',',');

                    //

                    $raw_critical = $world['critical'];
                    $world_critical = number_format($raw_critical, 0,'.',',');

                    $raw_mild = $raw_closed - $raw_critical;
                    $world_mild = number_format($raw_mild, 0,'.',',');
                 
                    $pie_cases = 100;
                    $pie_recovered = round($world['recovered']/$world['cases']*$pie_cases, 2);
                    $pie_deaths = round($world['deaths']/$world['cases']*$pie_cases, 2);
                    $pie_pending = round($pie_cases - $pie_recovered - $pie_deaths, 2);
                ?>

                

                <div class="row">
                    <div class="col-4">
                        <div style="text-align:center; margin-top:50px; color:rgba(255,255,255,0.85)">Total Cases:</div>
                        <div id="i" class="odometer" style="margin-top:2px"></div>
                        <script>
                            document.addEventListener(
                            'DOMContentLoaded', 
                            function() {
                                var i = document.getElementById("i");
                                i.textContent = {{$raw_cases}};
                            }, false);
                        </script>
                        <div style="text-align:center;  margin-top:2px; font-size:12px; font-weight:450; color: #64C2AF">Today: +{{ $world_todaycases }}</div>

                        <!--
                            <div style="text-align:center;  margin-top:2px; font-size:50px; font-weight:450">{{ $world_cases }}</div>
                        -->
                        
                        <div style="text-align:center; margin-top:30px; color:rgba(255,255,255,0.85)">Total Deaths:</div>
                        <div id="j" class="odometer" style="margin-top:2px"></div>
                        <script>
                            document.addEventListener(
                            'DOMContentLoaded', 
                            function() {
                                var j = document.getElementById("j");
                                j.textContent = {{$raw_deaths}};
                            }, false);
                        </script>
                        <div style="text-align:center;  margin-top:2px; font-size:12px; font-weight:450; color: #F78A8C">Today: +{{ $world_todaydeaths }}</div>

                        <!--
                            <div style="text-align:center; margin-top:2px; font-size:50px; font-weight:450">{{ $world_deaths }}</div>
                        -->

                        <div style="text-align:center; margin-top:30px; color:rgba(255,255,255,0.85)">Total Recovered:</div>
                        <div id="k" class="odometer" style="margin-top:2px"></div>
                        <script>
                            document.addEventListener(
                            'DOMContentLoaded', 
                            function() {
                                var k = document.getElementById("k");
                                k.textContent = {{$raw_recovered}};
                            }, false);
                        </script>

                        <!--
                            <div style="text-align:center; margin-top:2px; font-size:50px; font-weight:450">{{ $world_recovered }}</div>
                        -->
    
                    </div>
                    
                    <div class="col-4">
                        <div style="text-align:center; margin-top:50px; color:rgba(255,255,255,0.85)">Active Cases:</div>
                        <div style="text-align:center; margin-top:2px; font-size:30px; font-weight:450">{{ $world_active }}</div>

                            <div class="col-6">
                                <div style="text-align:center; margin-top:2px; font-size:12px; font-weight:450">Mild:</div>
                                <div style="text-align:center; margin-top:2px; font-size:20px; font-weight:450">{{ $world_mild }}</div>
                            </div>

                            <div class="col-6">
                                <div style="text-align:center; margin-top:2px; font-size:12px; font-weight:450">Critical:</div>
                                <div style="text-align:center; margin-top:2px; font-size:20px; font-weight:450">{{ $world_critical }}</div>
                            </div>

                        <div style="text-align:center; margin-top:120px; color:rgba(255,255,255,0.85)">Closed Cases:</div>
                        <div style="text-align:center; margin-top:2px; font-size:30px; font-weight:450">{{ $world_closed }}</div>

                            <div class="col-6">
                                <div style="text-align:center; margin-top:2px; font-size:12px; font-weight:450">Recovered:</div>
                                <div style="text-align:center; margin-top:2px; font-size:20px; font-weight:450">{{ $world_recovered }}</div>
                            </div>

                            <div class="col-6">
                                <div style="text-align:center; margin-top:2px; font-size:12px; font-weight:450">Deaths:</div>
                                <div style="text-align:center; margin-top:2px; font-size:20px; font-weight:450">{{ $world_deaths }}</div>
                            </div>
                        
                    </div>

                    <div class="col-4">
                        <div style="text-align:center; margin-top:50px; color:rgba(255,255,255,0.8)">Breakdown of Cases:</div>    
                        <canvas id="graph" height="230" width="260" style="margin-top:14px; padding: 28px 0 12px 0; background-color: rgba(0,0,0,0.12); border-radius:16px"></canvas>
                        <script>
                            var ctx = document.getElementById('graph').getContext('2d');
                            var chart = new Chart(ctx, {
                                type: 'doughnut',

                                data: {
                                    labels: [" Recovered", " Deaths", " Pending"],
                                    datasets: [{
                                        label: ["Recovered", "Deaths", "Pending"],
                                        backgroundColor: [
                                            "#00ACFF", "#DBECF8", "#73A6C9"
                                        ],
                                        data: [{{$pie_recovered}}, {{$pie_deaths}}, {{$pie_pending}}],
                                        }
                                    ]
                                },

                                options: {
                                    elements: {
                                        arc: {
                                            borderWidth: 0
                                        }
                                    },
                                    responsive: false,
                                    legend: {
                                            display: true,
                                            position: 'bottom',
                                            
                                            labels: {
                                                fontFamily: 'Inter',
                                                fontColor: 'rgba(255,255,255,0.95)',
                                                fontSize: 13,
                                                usePointStyle: true,
                                                boxWidth: 7,
                                                padding: 34
                                            }
                                        },
                                    tooltips: {
                                            enabled: true,
                                            mode: 'index',
                                            bodyFontFamily: 'Inter',
                                        callbacks: {
                                            label: function (tooltipItems, data) {
                                                var i, label = [], l = data.datasets.length;
                                                for (i = 0; i < l; i += 1) {
                                                    label[i] = '  ' + data.datasets[i].label[tooltipItems.index] + ': ' + data.datasets[0].data[tooltipItems.index].toFixed(2) + '% ';                                        }
                                                return label;
                                            }
                                        }
                                    }
                                }
                            });
                        </script>
                    </div>
                </div>

                
            
                
            </div>

            <div class="col-2" style="height:100vh; background-color:rgb(0,0,0,0.2)"></div>
        </div>        
    </body>
</html>