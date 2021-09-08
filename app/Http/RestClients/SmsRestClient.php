<?php

namespace App\Http\RestClients;

use Illuminate\Support\Facades\Log;

class SmsRestClient {
    
    private $client;

    public function __construct() {
        $this->client = new \GuzzleHttp\Client();
    }
    
    public function sendSms(String $mobileNumber, String $message) {
        try {
            Log::info("Sending sms to contact: " . $mobileNumber . " with content: " . $message);
            
            $startTime = microtime(true); 
            $smsEndPoint = "http://jskbulksms.in/app/smsapi/index.php?key=36107BAE7E6D41&campaign=1&routeid=48&type=text&contacts=".$mobileNumber."&senderid=SOCSDP&msg=".$message;

            $response = $this->client->request('GET', $smsEndPoint,[ 
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
            
            return $response->getStatusCode() < 400;
        } catch(Exception $e) {
            Log::error("Failed to call sms endpoint".$e);
            return false;
        }
        
    }
}