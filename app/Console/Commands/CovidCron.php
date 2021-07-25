<?php
    namespace App\Console\Commands;

    use Illuminate\Console\Command;
    use Illuminate\Support\Facades\Config;

    class CovidCron extends Command
    {
        protected $signature = 'covid:cron';
        protected $description = 'Command description';

        public function __construct(){
            parent::__construct();
        }

        public function handle(){
            Log::info('Covid Cron Working Properly...');
            if (Cache::has('csvToJson'))
            {
                Cache::forget('csvToJson');
            }
            csvToJson();
        }
       
        public function csvToJson(){
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
    }
?>