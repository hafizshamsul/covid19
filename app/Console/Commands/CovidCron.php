<?php
    namespace App\Console\Commands;

    use Illuminate\Console\Command;
    use Illuminate\Support\Facades\Config;

    class CovidCron extends Commands
    {
        protected $signature = 'covid:cron';
        protected $description = 'Command description';

        public function __construct(){
            parent::__construct();
        }

        public function handle(){
            Log::info('Covid Cron Working Properly...');

            getApi2();
            getApi3();
        }

        public function getApi2(){
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
        
        public function getApi3(){
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
    }
?>
