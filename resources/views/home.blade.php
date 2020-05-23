<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>Coronavirus Index</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="{{ asset('css/main.scss') }}">
        <link rel="stylesheet" href="{{ asset('css/odometer-theme-default.css') }}">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/odometer.js/0.4.8/odometer.min.js"></script>
        <script data-ad-client="ca-pub-5183629226749487" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    </head>

    <?php
        $lastupdated = date("d-m-Y, h:i");

        //All
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
        //
        $pie_cases = 100;
        $pie_recovered = round($world['recovered']/$world['cases']*$pie_cases, 2);
        $pie_deaths = round($world['deaths']/$world['cases']*$pie_cases, 2);
        $pie_pending = round($pie_cases - $pie_recovered - $pie_deaths, 2);

        //Countries
        $countries = json_decode($response3, true);

        $sizecountries = sizeof($countries);
        
        $sort = 'countrydesc';

        if($sort == 'countrydesc'){
            array_multisort(array_column($countries, "cases"), SORT_DESC, $countries);
        }
        else{
            array_multisort(array_column($countries, "cases"), SORT_ASC, $countries);
        }
        
        
        for($i=0; $i<$sizecountries; $i++){
            $asc[$i]['country'] = $countries[$i]['country'];
            $asc[$i]['cases'] = $countries[$i]['cases'];
            $asc[$i]['todayCases'] = $countries[$i]['todayCases'];
            $asc[$i]['deaths'] = $countries[$i]['deaths'];
            $asc[$i]['todayDeaths'] = $countries[$i]['todayDeaths'];
            $asc[$i]['recovered'] = $countries[$i]['recovered'];
            $asc[$i]['active'] = $countries[$i]['active'];
        }
        
    ?>

    <body style="margin:0; height:100vh">
        <!--Header-->
        <div style="display:grid; border-bottom: 1px solid rgb(200,200,200)">
            <p style="text-align:center; font-size:20px; font-weight:bold; line-height:0px">COVID-19 CORONAVIRUS PANDEMIC</p>
        </div>

        <!--Navbar-->
        <!--
            <div style="display:grid;">
                <p style="text-align:center; margin-top:40px">
                    <a href="#">Graphs</a>
                    <a href="#">Countries</a>
                    <a href="#">Death Rate</a>
                    <a href="#">Incubation</a>
                    <a href="#">Age</a>
                    <a href="#">Symptoms</a>
                    <a href="#">News</a>
                </p>
            </div>
        -->
        
        <!--Last updated-->
        <div style="display:grid; margin: 20px 0 0 0 ">
            <p style="text-align:center; font-size: 10px; font-style:italic;">Last updated: {{$lastupdated}} GMT</p>
        </div>

        <!--Main stats-->
        <div style="display:grid; grid-template-columns: auto 50% auto; margin: 4px 0 22px 0">
            <div></div>

            <div>
                <div>
                    <!--
                        <div>
                        <div class="right2" style="border:1px solid black">
                            <div>
                                <div style="text-align:center;">Total Cases:</div>
                                <div style="text-align:center;  margin-top:2px; font-size:50px; font-weight:800">{{ $world_cases }}</div>
                            </div>
                            
                            <div style="text-align:center; margin-top:30px;">Total Deaths:</div>
                            <div style="text-align:center; margin-top:2px; font-size:50px; font-weight:800">{{ $world_deaths }}</div>
                        
                            <div style="text-align:center; margin-top:30px;">Total Recovered:</div>
                            <div style="text-align:center; margin-top:2px; font-size:50px; font-weight:800">{{ $world_recovered }}</div>
                        </div>

                        <div class="right2"  style="border:1px solid black">
                            <div style="text-align:center;">Active Cases:</div>
                            <div style="text-align:center; margin-top:2px; font-size:30px; font-weight:800">{{ $world_active }}</div>
                                <table style="margin:0 auto; margin-top:8px">
                                    <tr>
                                        <td style="padding-right:6px; text-align:center; margin-top:2px; font-size:12px; font-weight:400">Mild:</td>
                                        <td style="padding-left:6px; text-align:center; margin-top:2px; font-size:12px; font-weight:400">Critical:</td>
                                    </tr>
                                    <tr>
                                        <td style="padding-right:6px; text-align:center; margin-top:2px; font-size:20px; font-weight:800">{{ $world_mild }}</td>    
                                        <td style="padding-left:6px; text-align:center; margin-top:2px; font-size:20px; font-weight:800">{{ $world_critical }}</td>
                                    </tr>
                                </table> 

                            <div style="text-align:center; margin-top:30px;">Closed Cases:</div>
                            <div style="text-align:center; margin-top:2px; font-size:30px; font-weight:800">{{ $world_closed }}</div>

                            <table style="margin:0 auto; margin-top:8px">
                                <tr>
                                    <td style="padding-right:6px; text-align:center; margin-top:2px; font-size:12px; font-weight:400">Recovered:</td>
                                    <td style="padding-left:6px; text-align:center; margin-top:2px; font-size:12px; font-weight:400">Deaths:</td>
                                </tr>
                                <tr>
                                    <td style="padding-right:6px; text-align:center; margin-top:2px; font-size:20px; font-weight:800">{{ $world_recovered }}</td>
                                    <td style="padding-left:6px; text-align:center; margin-top:2px; font-size:20px; font-weight:800">{{ $world_recovered }}</td>
                                </tr>
                            </table>       
                        </div>
                    </div>
                    -->
                    
                    <div style="display:grid; grid-template-columns: auto auto auto">
                        <div>
                            <div style="text-align:center;">Total Cases:</div>
                            <div style="text-align:center;  margin-top:2px; font-size:30px; font-weight:800">{{ $world_cases }}</div>
                        </div>
                        
                        <div>
                            <div style="text-align:center;">Total Deaths:</div>
                            <div style="text-align:center; margin-top:2px; font-size:30px; font-weight:800">{{ $world_deaths }}</div>
                        </div>
                            
                        <div>
                            <div style="text-align:center;">Total Recovered:</div>
                            <div style="text-align:center; margin-top:2px; font-size:30px; font-weight:800">{{ $world_recovered }}</div>
                        </div>  
                    </div>


                </div>

            </div>

            <div></div>
        </div>
        

        <div style="display:grid; grid-template-columns: auto 70% auto; margin: 0 0 20px 0">
            <div></div>

            <div>
                <table style="width:100%;">
                    <tr style="font-size:14px; font-weight:700">
                        <td>#</td><td style="max-width:170px">Country</td><td>Total Cases</td><td>New Cases</td><td>Total Deaths</td><td>New Deaths</td><td>Total Recovered</td><td>Active Cases</td>
                    </tr>

                    <?php
                        
                        for($i=0; $i<$sizecountries; $i++){
                            $index = $i+1;
                            $country = $asc[$i]['country'];
                            $cases = number_format($asc[$i]['cases'], 0,'.',',');;
                            $todayCases = number_format($asc[$i]['todayCases'], 0,'.',','); ;
                            $deaths = number_format($asc[$i]['deaths'], 0,'.',','); ;
                            $todayDeaths = number_format($asc[$i]['todayDeaths'], 0,'.',','); ;
                            $recovered = number_format($asc[$i]['recovered'], 0,'.',','); ;
                            $active = number_format($asc[$i]['active'], 0,'.',','); ;
                            echo "
                                <tr>
                                    <td>$index</td>
                                    <td class='tdcountry' style='max-width:170px'>$country</td>
                                    <td class='tdnum'>$cases</td>
                                    <td class='tdnum'>$todayCases</td>
                                    <td class='tdnum'>$deaths</td>
                                    <td class='tdnum'>$todayDeaths</td>
                                    <td class='tdnum'>$recovered</td>
                                    <td class='tdnum'>$active</td>
                                </tr>
                            ";
                        }
                    ?>
                </table>
            </div>

            <div></div>
        </div>
    </body>
</html>