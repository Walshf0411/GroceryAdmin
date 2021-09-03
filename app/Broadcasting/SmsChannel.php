<?php

namespace App\Broadcasting;

use App\User;
use Illuminate\Notifications\Notification;
use App\Http\RestClients\SmsRestClient;

class SmsChannel
{
    private SmsRestClient $smsRestClient;

    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct(SmsRestClient $smsRestClient)
    {
        $this->smsRestClient = $smsRestClient;
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
        $this->smsRestClient->sendSms($notifiable->mobile_number, $message);
    }
}
