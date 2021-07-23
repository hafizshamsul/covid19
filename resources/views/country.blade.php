<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>Coronavirus Index | Home</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
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
    
        //Historical
        $historical = json_decode($response4, true);
        $sizehistorical = sizeof($historical['timeline']['cases']);

        $arrayx;
        $x=0;
        foreach($historical['timeline']['cases'] as $his){
            //$arrayx[$x] = $his
            $x++;
            $leh = $his;
        }

        //Country
        $count = json_decode($response5, true);
        $countupdated = $count['updated'];
        $countcountry = $count['country'];
        $countinfo_id = $count['countryInfo']['_id'];
        $countinfoiso2 = $count['countryInfo']['iso2'];
        $countinfoiso3 = $count['countryInfo']['iso3'];
        $countinfolat = $count['countryInfo']['lat'];
        $countinfolong = $count['countryInfo']['long'];
        $countinfoflag = $count['countryInfo']['flag'];
        $countpopulation = number_format($count['population'], 0,'.',',');;
        $countcontinent = $count['continent'];

        $countcases = number_format($count['cases'], 0,'.',',');
        $counttodayCases = number_format($count['todayCases'], 0,'.',',');
        $countcasesPerOneMillion = number_format($count['casesPerOneMillion'], 0,'.',',');

        $countdeaths = number_format($count['deaths'], 0,'.',',');
        $counttodayDeaths = number_format($count['todayDeaths'], 0,'.',',');
        $countdeathsPerOneMillion = number_format($count['deathsPerOneMillion'], 0,'.',',');

        $countrecovered = number_format($count['recovered'], 0,'.',',');
        $countrecoveredPerOneMillion = number_format($count['recoveredPerOneMillion'], 0,'.',',');

        $countactive = number_format($count['active'], 0,'.',',');
        $countactivePerOneMillion = number_format($count['activePerOneMillion'], 0,'.',',');

        $countcritical = number_format($count['critical'], 0,'.',',');
        $countcriticalPerOneMillion = number_format($count['criticalPerOneMillion'], 0,'.',',');

        $counttests = number_format($count['tests'], 0,'.',',');
        $counttestsPerOneMillion = number_format($count['testsPerOneMillion'], 0,'.',',');

    ?>

    <body style="margin:0; height:100vh">
        <!--Header-->
        <div style="display:grid; grid-template-columns:auto; border-bottom: 1px solid rgb(230,230,230);">
            <div style="text-align:center; font-size:20px; font-weight:300; padding:10px 0">COVID-19 CORONAVIRUS INDEX</div>
        </div>

        <!--
            <div>{{$countryurl}} {{$x}} {{$leh}} {{$countcountry}}</div>
        -->

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
        <div style="display:grid; grid-template-columns: auto 70% auto; margin: 6px 0 0 0 ">
            <!--
                <p style="text-align:center; font-size: 10px; font-style:italic;">Last updated: {{$lastupdated}} GMT</p>
            -->
            <div></div>
            <div>
                <p style="text-align:center; font-size: 10px; font-style:italic; color:rgb(130,130,130)">Live data from Worldometer, John Hopkins University CSSE, New York Times, Apple and Govs</p>
            </div>
            <div></div>
        </div>

        <!--Country Info-->
        <div class="grid-container" style="margin: 10px 0 22px 0">
            <div>
            </div>

            <div style="margin:0 auto">
                <div style="font-size:18px; font-weight:600; margin-bottom:4px; text-align:center">Coronavirus Cases Breakdown in {{$countcountry}}</div>
                
                <div style="display:grid; grid-template-columns:auto  34px auto; margin-bottom:8px">
                    <div></div>

                    <div>
                        <img src="{{$countinfoflag}}" style="height:14px; float:left;"/>
                    </div>

                    <div style="color:rgb(130,130,130); font-size:12px; font-style:italic;">
                        Population: {{$countpopulation}}&nbsp;&nbsp;&nbsp;Continent: {{$countcontinent}}
                    </div>
                </div>
            </div>

            <div></div>
        </div>

        <!--Main stats-->
        <div class="grid-container" style="margin: 10px 0 2px 0">
            <div></div>

            <div>
                <div>
                    <div style="display:grid; grid-template-columns: 33.33% 33.33% 33.33%; margin-bottom:20px">
                        <div>
                            <div class="labelstats" style="text-align:center;">Total Cases:</div>
                            <div class="mainstats">{{ $countcases }}</div>
                        </div>
                        
                        <div>
                            <div class="labelstats" style="text-align:center;">Today Cases:</div>
                            <div class="mainstats">+{{ $counttodayCases }}</div>
                        </div>
                            
                        <div>
                            <div class="labelstats" style="text-align:center;">Cases per 1M:</div>
                            <div class="mainstats">{{ $countcasesPerOneMillion }}</div>
                        </div>  
                    </div>

                    <div style="margin:0 auto; margin:6px 0">
                        <div style="height:1px; background:rgb(220,220,220)"></div>
                    </div>
                    <div style="display:grid; grid-template-columns: 33.33% 33.33% 33.33%; margin-bottom:20px">
                        <div>
                            <div class="labelstats" style="text-align:center;">Total Deaths:</div>
                            <div class="mainstats">{{ $countdeaths }}</div>
                        </div>
                        
                        <div>
                            <div class="labelstats" style="text-align:center;">Today Deaths:</div>
                            <div class="mainstats">+{{ $counttodayDeaths }}</div>
                        </div>
                            
                        <div>
                            <div class="labelstats" style="text-align:center;">Deaths per 1M:</div>
                            <div class="mainstats">{{ $countdeathsPerOneMillion }}</div>
                        </div>  
                    </div>

                    <div style="margin:0 auto; margin:6px 0">
                        <div style="height:1px; background:rgb(220,220,220)"></div>
                    </div>
                    <div style="display:grid; grid-template-columns: 33.33% 33.33% 33.33%; margin-bottom:20px">
                        <div>
                            <div class="labelstats" style="text-align:center;">Total Recovered:</div>
                            <div class="mainstats">{{ $countrecovered }}</div>
                        </div>
                            
                        <div>
                            <div class="labelstats" style="text-align:center;">Recovered per 1M:</div>
                            <div class="mainstats">{{ $countrecoveredPerOneMillion }}</div>
                        </div>

                        <div></div>
                    </div>

                    <div style="margin:0 auto; margin:6px 0">
                        <div style="height:1px; background:rgb(220,220,220)"></div>
                    </div>
                    <div style="display:grid; grid-template-columns: 33.33% 33.33% 33.33%; margin-bottom:20px">
                        <div>
                            <div class="labelstats" style="text-align:center;">Total Critical:</div>
                            <div class="mainstats">{{ $countcritical }}</div>
                        </div>
                            
                        <div>
                            <div class="labelstats" style="text-align:center;">Critical per 1M:</div>
                            <div class="mainstats">{{ $countcriticalPerOneMillion }}</div>
                        </div>

                        <div></div>
                    </div>

                    <div style="margin:0 auto; margin:6px 0">
                        <div style="height:1px; background:rgb(220,220,220)"></div>
                    </div>
                    <div style="display:grid; grid-template-columns: 33.33% 33.33% 33.33%; margin-bottom:20px">
                        <div>
                            <div class="labelstats" style="text-align:center;">Total Tests:</div>
                            <div class="mainstats">{{ $counttests }}</div>
                        </div>
                            
                        <div>
                            <div class="labelstats" style="text-align:center;">Tests per 1M:</div>
                            <div class="mainstats">{{ $counttestsPerOneMillion }}</div>
                        </div>

                        <div></div>
                    </div>
                </div>
            </div>

            <div></div>
        </div>
        
        <div style="text-align:center">
            <a href="https://indexcoronavirus.com"><  Return to Home</a>
        </div>
    </body>
</html>