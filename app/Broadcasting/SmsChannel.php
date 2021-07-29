<?php

namespace App\Broadcasting;

use App\User;
use Illuminate\Notifications\Notification;

class SmsChannel
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param  \App\User  $user
     * @return array|bool
     */
    // public function join(User $user)
    // {
    //     //
    // }

    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toSms($notifiable);
        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', env("SMS_API_ENDPOINT"), ['query' => [
            'sms_api_secret' => env("SMS_API_KEY"), 
            'sms_api_key' => env("SMS_API_SECRET"), 
            'phone_number' => $notifiable->mobile_number,
            'message' => $message,
        ]]);

        // url will be: http://my.domain.com/test.php?key1=5&key2=ABC;

        $response->getStatusCode();
        $response->getBody();

        dd($statusCode, $content);
    }
}
