<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>Coronavirus Index | Home</title>
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

        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/dataTables.semanticui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.js"></script>

        <!--
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css">
            <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.semanticui.min.css">
        -->

        <script>
            $(document).ready( function () {
                var t = $('#myTable').DataTable({
                    "columnDefs": [ {
                        "searchable": true,
                        "orderable": false,
                        "targets": 0,
                    } ],
                    "order": [[ 0, 'asc' ]],
                    "paging": false,
                    "searching": true,
                    
                    "initComplete": function(){
                        $("#myTable_filter").detach().appendTo('#new-search-area');
                        $("#myTable_filter input").attr("placeholder", "Search country..");
                    },
                    "language": { "search": "" }
                });

                t.on( 'order.dt', function () {
                    t.column(0, {order:'applied'}).nodes().each( function (cell, i) {
                        cell.innerHTML = i+1;
                    } );
                } ).draw();
            } );
        </script>
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

        array_multisort(array_column($countries, "cases"), SORT_DESC, $countries);
       
        for($i=0; $i<$sizecountries; $i++){
            $asc[$i]['rank'] = $i+1;
            $asc[$i]['country'] = $countries[$i]['country'];
            $asc[$i]['cases'] = $countries[$i]['cases'];
            $asc[$i]['todayCases'] = $countries[$i]['todayCases'];
            $asc[$i]['deaths'] = $countries[$i]['deaths'];
            $asc[$i]['todayDeaths'] = $countries[$i]['todayDeaths'];
            $asc[$i]['recovered'] = $countries[$i]['recovered'];
            $asc[$i]['active'] = $countries[$i]['active'];
            $asc[$i]['countryiso3'] = $countries[$i]['countryInfo']['iso3'];
            $asc[$i]['countryflag'] = $countries[$i]['countryInfo']['flag'];
        }
        
    ?>



    <body style="margin:0; height:100vh">
        <!--Header-->
        <div style="display:grid; grid-template-columns:auto; border-bottom: 1px solid rgb(230,230,230)">
            <div style="text-align:center; font-size:20px; font-weight:300; padding:10px 0">COVID-19 CORONAVIRUS INDEX</div>
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

        <!--Main stats-->
        <div class="grid-container" style="margin: 10px 0 22px 0">
            <div></div>

            <div>
                <div>
                    
                    <div style="display:grid; grid-template-columns: auto auto auto">
                        <div>
                            <div class="labelstats" style="text-align:center;">Total Cases:</div>
                            <div class="mainstats">{{ $world_cases }}</div>
                        </div>
                        
                        <div>
                            <div class="labelstats" style="text-align:center;">Total Deaths:</div>
                            <div class="mainstats">{{ $world_deaths }}</div>
                        </div>
                            
                        <div>
                            <div class="labelstats" style="text-align:center;">Total Recovered:</div>
                            <div class="mainstats">{{ $world_recovered }}</div>
                        </div>  
                    </div>
                </div>
            </div>

            <div></div>
        </div>

        <div class="grid-container" style="margin: 0 0 20px 0">
            <div></div>

            <div>
                <div id="new-search-area">
                </div>
                <table id="myTable" style="width:100%;">
                    <thead>
                        <tr style="font-weight:700; font-size:12px;width:100%">
                            <th style="width:6%">#</th>
                            <th class="tdcountry" style="width:14%;">Country</th>
                            <th class="tdtitle" style="width:10%">Total Cases</th>
                            <th class="tdtitle" style="width:10%">New Cases</th>
                            <th class="tdtitle" style="width:10%">Total Deaths</th>
                            <th class="tdtitle" style="width:10%">New Deaths</th>
                            <th class="tdtitle" style="width:10%; padding-right:14px">Total Recovered</th>
                        </tr>
                    </thead>
                    
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

                            if($asc[$i]['country']=='UK' || $asc[$i]['country']=='Netherlands'){
                                if($asc[$i]['recovered']==0){
                                    //$recovered = 'N/A';
                                }
                            }
                            if($asc[$i]['todayCases'] == 0){
                                //$todayCases = '';
                            }
                            if($asc[$i]['todayDeaths'] == 0){
                                //$todayDeaths = '';
                            }

                            $countryiso3 = $asc[$i]['countryiso3'];
                            $countryflag = $asc[$i]['countryflag'];

                            echo "
                                <tr>
                                    <td>$index</td>
                                    <td class='tdcountry' style='max-width:40px;'>
                                        <img src='{$countryflag}' style='width:15px; margin: 0 4px 0 0; vertical-align:middle'/>
                                        <a href='country/$countryiso3'>$country</a>
                                    </td>
                                    <td class='tdnum'>$cases</td>
                                    <td class='tdnum'>$todayCases</td>
                                    <td class='tdnum'>$deaths</td>
                                    <td class='tdnum'>$todayDeaths</td>
                                    <td class='tdnum' style=' padding-right:14px'>$recovered</td>
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


