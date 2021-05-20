<?php


namespace App\Helpers\Curl;


class Curl
{

    public function post(string $url, $params) {
        $curl   =   curl_init();
        curl_setopt($curl,CURLOPT_URL,$url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
        $out = curl_exec($curl);
        curl_close($curl);
        return $out;
    }

    public function get(string $link) {
        $ch =   curl_init();
        curl_setopt($ch, CURLOPT_URL, $link);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $exec   =   curl_exec($ch);
        curl_close($ch);
        return $exec;
    }

}
