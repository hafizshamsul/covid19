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

    return view('home', compact('response2', 'response3'));
});

Route::get('country/{countryurl}', function ($countryurl) {
    $curl4 = curl_init();

    curl_setopt_array($curl4, array(
        CURLOPT_URL => "https://disease.sh/v2/historical/usa?lastdays=all",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
    ));
    
    $response4 = curl_exec($curl4);
    curl_close($curl4);

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

    return view('country', compact('response4', 'response5', 'countryurl'));
});

Route::get('welcome', function () {
    return view('welcome');
});