<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>Hello World</title>
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
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
                    
                    $world_cases = $world['cases'];
                    $world_deaths = $world['deaths'];
                    $world_recovered = $world['recovered'];
                ?>

                <div style="text-align:center; margin-top:50px; color:rgba(255,255,255,0.8)">Coronavirus Cases:</div>
                <div style="text-align:center; font-size:50px; font-weight:450">{{ $world_cases }}</div>

                <div style="text-align:center; margin-top:30px; color:rgba(255,255,255,0.8)">Deaths:</div>
                <div style="text-align:center; font-size:50px; font-weight:450">{{ $world_deaths }}</div>

                <div style="text-align:center; margin-top:30px; color:rgba(255,255,255,0.8)">Recovered:</div>
                <div style="text-align:center; font-size:50px; font-weight:450">{{ $world_recovered }}</div>
            </div>
            
            <div class="col-2" style="height:100vh; background-color:rgb(0,0,0,0.2)"></div>
        </div>    
    
        
    
    </body>
</html>