<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>Hello World</title>
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    </head>

    <body>
        <div class="row">
            <div class="col-2" style="height:100vh; background-color:rgb(0,0,0,0.2)">...</div>
            
            <div class="col-8" style="height:100vh">
                <p style="text-align:center; font-size:20px; font-weight:bold; line-height:0px">COVID-19 CORONAVIRUS PANDEMIC</p>
                <p style="text-align:center; font-size: 10px; font-style:italic; color: rgba(255,255,255,0.5)">Last updated: </p>

                <p style="text-align:center; margin-top:30px">
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

                <p style="text-align:center; margin-top:60px">Coronavirus Cases:</p>
                <p style="text-align:center; margin-top:30px">{{ $world_cases }}</p>
                
                <p style="text-align:center; margin-top:30px">
                    <a href="#" style="margin-top:30px">View by country</a>
                </p>
                
                <p style="text-align:center; margin-top:30px">Deaths:</p>
                <p style="text-align:center; margin-top:30px">{{ $world_deaths }}</p>

                <p style="text-align:center; margin-top:30px">Recovered:</p>
                <p style="text-align:center; margin-top:30px">{{ $world_recovered }}</p>
            </div>
            
            <div class="col-2" style="height:100vh; background-color:rgb(0,0,0,0.2)">...</div>
        </div>    
    
        
    
    </body>
</html>