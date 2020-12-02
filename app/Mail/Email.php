<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;
use App\Model\TempVendor;

class Email extends Mailable
{
    use Queueable, SerializesModels;
        // public $mymailid;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($otp)
    {
        //
        // $tempvendor = new TempVendor;
        // $tempvendor->email_id = $request->email_id;
        $this->my_mail_data = $otp;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('xyz@xyz.com','Grocery Mart')->subject('Welcome User!')->view('mail.mailview',['mail_data' =>$this->my_mail_data]);
        // return $this->from(env('MAIL_FROM_ADDRESS'),'Grocery Mart')->subject('Welcome User!')->view('mail.mailview',['mail_data' =>$this->my_mail_data]);
    }



}
