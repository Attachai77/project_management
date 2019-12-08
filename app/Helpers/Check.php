<?php

namespace App\Helpers;
use Request;
use Illuminate\Support\Facades\DB;

class Check
{
    public static function fileExist($url , $fullURL = false) {
        if(!$fullURL){
            $url = url('/') . $url;
        }
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
        if ($code == 200) {
            $status = true;
        } else {
            $status = false;
        }
        curl_close($ch);
        return $status;
    }
}

