<?php

namespace App\Http\Controllers\API ;
use App\Http\Controllers\Controller;
// namespace App\Http\Controllers;
use App\Model\TempVendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Email;
use App\Http\RestClients\SmsRestClient;


class OtpApiController extends Controller
{
    private SmsRestClient $smsRestClient;

    public function __construct(SmsRestClient $smsRestClient) {
        $this->smsRestClient = $smsRestClient;
    }

    public function sendOtp(Request $request){
        $otp = $this->generateOTP();
        $message = "From Aahar App - Your OTP is : " . $otp;
        $this->smsRestClient->sendSms($request->mobile_number, $message);

        return response()->json(["otp" => $otp]);
    }

    public function generateOTP(){
        $otp = mt_rand(100000,999999);
        return $otp;
    }
}
