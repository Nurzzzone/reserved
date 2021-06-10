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

    public function postToken($url,$token = '', $data = [], $status = true) {
        $curl   =   curl_init();
        if ($token !== '') {
            curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json' , 'Authorization: Bearer '.$token]);
        } else {
            curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        }
        curl_setopt($curl,CURLOPT_URL,$url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl,CURLOPT_POST, true);
        if (sizeof($data) > 0) {
            if ($status) {
                curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
            } else {
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            }
        }
        $out = curl_exec($curl);
        curl_close($curl);
        return $out;
    }

    public function postTokenReserve($url,$token = '', $data = []) {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL             =>  $url,
            CURLOPT_RETURNTRANSFER  =>  true,
            CURLOPT_ENCODING        =>  '',
            CURLOPT_MAXREDIRS       =>  10,
            CURLOPT_TIMEOUT         =>  0,
            CURLOPT_FOLLOWLOCATION  =>  true,
            CURLOPT_HTTP_VERSION    =>  CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST   =>  'POST',
            CURLOPT_POSTFIELDS      =>  json_encode($data),
            CURLOPT_HTTPHEADER      =>  [
                'Authorization: Bearer '.$token,
                'Content-Type: application/json'
            ],
        ]);

        /*
         '{
    		"organizationId": "'.$data['organizationId'].'",
    		"terminalGroupId": "'.$data['terminalGroupId'].'",
    		"customer": {},
    		"phone": "'.$data['phone'].'",
    		"guestsCount": '.$data['guestsCount'].',
    		"durationInMinutes": '.$data['durationInMinutes'].',
    		"order": {
                 "items": [
                        {
                            "type": "Product",
                            "productId": "ac18f6a7-059e-4deb-8d72-0bc12289544e",
                            "amount": 1
                        }
                    ],
                    "payments": [
                        {
                            "paymentTypeKind": "Card",
                            "sum": 4000,
                            "paymentTypeId": "e46b4e6c-10d5-a739-8fb1-b6674d1e65e7",
                            "isProcessedExternally": true
                        }
                    ]
                },
                "tableIds": [
                    "0e40bb44-52d8-47d8-ad8b-fc708e0d0c00"
                ],
                "shouldRemind": true,
                "estimatedStartTime": "2021-06-02 22:55:00.000"
            }'
         */
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
}
