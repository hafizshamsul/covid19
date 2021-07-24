@extends('layout.mainlayout')

@section('content')
        <?php
        $lastupdated = date("d-m-Y, h:i");
    
        //Historical
        /*$historical = json_decode($response4, true);
        $sizehistorical = sizeof($historical['timeline']['cases']);

        $arrayx;
        $x=0;
        foreach($historical['timeline']['cases'] as $his){
            //$arrayx[$x] = $his
            $x++;
            $leh = $his;
        }*/

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
       <nav class="navbar navbar-expand-lg navbar-light" style="padding: 14px 26px; box-shadow: rgb(0 0 0 / 30%) 0px 1px 4px;">
            <div class="container-fluid">
                <a class="navbar-brand" href="/" style="font-size: 18px; text-decoration: none">COVID-19 INDEX</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="#">Overview</a>
                    <a class="nav-link" href="#">Malaysia</a>
                </div>
                </div>
            </div>
        </nav>

        <!--Country Info-->
        <div class="grid-container" style="margin: 22px 0">
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
        
    </body>

@endsection

