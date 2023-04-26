<?php

 namespace Nicholasmt\Switchappgo;

 use Illuminate\Support\Facades\Facade;

 class Switchappgo extends Facade
 {
       public static function callAPI($method, $url, $data){
            $curl = curl_init();
            switch ($method){
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
            }
            // OPTIONS:
            curl_setopt($curl, CURLOPT_URL, $url);
            $secret_key = env('SWITCHAPP_SECRET_KEY');
            // curl_setopt($curl, CURLOPT_HTTPHEADER, 'authorization: bearer sk_test_tuCSw88fmkP8DsBMKBU2kbTtv');
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
              'authorization: '.$secret_key.' ',
             'Content-Type: application/json',
             ));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            // EXECUTE:
            $result = curl_exec($curl);
            if(!$result){die("Connection Failure");}
            curl_close($curl);
            return $result;
        }
        
    }
