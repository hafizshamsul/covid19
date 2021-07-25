<?php

use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $response2 = Cache::remember('api_2', 10, function () {
        return getApi2();
    });

    $response3 = Cache::remember('api_3', 10, function () {
        return getApi3();
    });

    $csvToJson = Cache::remember('csvToJson', Carbon::now()->endOfDay(), function () {
        return csvToJson();
    });
    
    return view('home', compact('response2', 'response3', 'csvToJson'));
});

Route::get('country/{countryurl}', function ($countryurl) {
    $response5 = Cache::remember('api_5', 10, function () {
        return getApi5();
    });
    
    return view('country', compact('response5', 'countryurl'));
});

Route::get('welcome', function () {
    return view('welcome');
});

function getApi2(){
    $curl2 = curl_init();

    curl_setopt_array($curl2, array(
    CURLOPT_URL => "https://corona.lmao.ninja/v2/all",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    ));

    $response2 = curl_exec($curl2);
    curl_close($curl2);

    return $response2;
}

function getApi3(){
    $curl3 = curl_init();

    curl_setopt_array($curl3, array(
    CURLOPT_URL => "https://corona.lmao.ninja/v2/countries",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    ));

    $response3 = curl_exec($curl3);
    curl_close($curl3);

    return $response3;
}

function getApi5($countryurl){
    $curl5 = curl_init();

    curl_setopt_array($curl5, array(
        CURLOPT_URL => "https://disease.sh/v2/countries/$countryurl?yesterday=false&strict=true&allowNull=false",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
    ));

    $response5 = curl_exec($curl5);
    curl_close($curl5);

    return $response5;
}

function csvToJson(){
    // Set your CSV feed
    $feed = 'https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/cases_malaysia.csv';

    // Arrays we'll use later
    $keys = array();
    $newArray = array();
    // Do it
    $data = csvToArray($feed, ',');

    // Set number of elements (minus 1 because we shift off the first row)
    $count = count($data) - 1;
    
    //Use first row for names  
    $labels = array_shift($data);  

    foreach ($labels as $label) {
        $keys[] = $label;
    }

    // Add Ids, just in case we want them later
    $keys[] = 'id';

    for ($i = 0; $i < $count; $i++) {
        $data[$i][] = $i;
    }
    
    // Bring it all together
    for ($j = 0; $j < $count; $j++) {
        $d = array_combine($keys, $data[$j]);
        $newArray[$j] = $d;
    }

    // Print it out as JSON
    return json_encode($newArray);
}

// Function to convert CSV into associative array
function csvToArray($file, $delimiter) { 
    if (($handle = fopen($file, 'r')) !== FALSE) { 
      $i = 0; 
      while (($lineArray = fgetcsv($handle, 4000, $delimiter, '"')) !== FALSE) { 
        for ($j = 0; $j < count($lineArray); $j++) { 
          $arr[$i][$j] = $lineArray[$j]; 
        } 
        $i++; 
      } 
      fclose($handle); 
    } 
    return $arr; 
} 
