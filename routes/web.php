<?php

use Illuminate\Support\Facades\Route;

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
    //$response2 = getApi2();
    //$response3 = getApi3();

    $response2 = Cache::remember('api_2', 10, function () {
        return getApi2();
    });

    $response3 = Cache::remember('api_3', 10, function () {
        return getApi3();
    });
    
    return view('home', compact('response2', 'response3'));
});

Route::get('country/{countryurl}', function ($countryurl) {
    //$response5 = getApi5($countryurl);

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
