<?php

namespace App\Http\RestClients;

use Illuminate\Support\Facades\Log;

class SmsRestClient {
    
    private $client;

    public function __construct() {
        $this->client = new \GuzzleHttp\Client();
    }
    
    public function sendSms(String $mobileNumber, String $message) {
        Log::info("Sending sms to contact: " . $mobileNumber . " with content: " . $message);
        
        $startTime = microtime(true); 

        $endPoint = str_replace("contacts", "contacts=".$mobileNumber, env('SMS_API_ENDPOINT'));
        $endPoint = str_replace("msg", "msg=".$message, $endPoint);

        $response = $this->client->request('GET', $endPoint,[ 
            'on_stats' => function (\GuzzleHttp\TransferStats $stats) use (&$url) {
                $url = $stats->getEffectiveUri();
                Log::info("Url used to send sms: " . $url);
            }
        ]);

        $endTime = microtime(true); 
        $execution_time = ($endTime - $startTime);
        Log::info("Sms api took " . $execution_time . " seconds to execute");

        $responseCode = $response->getStatusCode();
        $responseBody = $response->getBody();

        Log::info("Sms api returned response code: " . $responseCode);
        Log::info("Sms api returned response body: " . $responseBody);
        
        return $response->getStatusCode() <= 200;
    }
}