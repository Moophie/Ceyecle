<?php

namespace App\Classes;

use App\Models\User;

class HelperFunctions
{
    public static function get_string_between($string, $start, $end)
    {
        $string = " " . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) {
            return "";
        }
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;

        return substr($string, $ini, $len);
    }

    public static function sendNotification($title, $body, $registration_ids)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
          
        $serverKey = env('FIREBASE_SERVER_KEY');
  
        $data = [
            "registration_ids" => $registration_ids,
            "notification" => [
                "title" => $title,
                "body" => $body,
            ]
        ];

        $encodedData = json_encode($data);
    
        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
      
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);

        // Execute post
        $result = curl_exec($ch);

        if ($result === false) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);

        dd($result);
    }
}
