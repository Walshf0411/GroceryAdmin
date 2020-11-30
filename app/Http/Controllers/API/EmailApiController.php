<?php

namespace App\Http\Controllers\API ;
use App\Http\Controllers\Controller;
// namespace App\Http\Controllers;
use App\Model\TempVendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Email;


class EmailApiController extends Controller
{

        public function sendEmail(Request $request){

        $otp = $this->generateOTP();
        $email_id = $request->email_id;
        Mail::to($email_id)->send(new Email($otp));
        return response()->json(["otp"=>$otp]);
}
        public function generateOTP(){
            $otp = mt_rand(100000,999999);
        return $otp;
        }


}
