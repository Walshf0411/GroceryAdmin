<?php

namespace App\Service;

use App\Model\TempVendor;
use App\Model\Vendor;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class VendorLoginService{
    public function login(Request $request){
        $credentials = request()->only(['email_id','password' ]);
        $token = auth('vendor')->attempt($credentials);
        if($token){
            // $vendor = Vendor::where('email_id', $request->email_id)->where('password', Hash::make($request->password));
            $vendor = DB::select('select * from vendors where email_id = ? ', [$request->email_id]);
            return response()->json(["token"=>$token, 'vendor'=>$vendor['0']],200);
        }else{
            return response()->json(["error"=> "wrong credentials"],401);
        }
    }

    public function checkToken(Request $request){
        // try {
        //     // attempt to verify the credentials and create a token for the user
        //     $apy = JWTAuth::getPayload($request->token)->toArray();

        // } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

        //     return response()->json(['token_expired'], 500);

        // } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

        //     return response()->json(['token_invalid'], 500);

        // } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

        //     return response()->json(['token_absent' => $e->getMessage()], 500);

        // }
        $tokenParts = explode(".", $request->token);
        $tokenHeader = base64_decode($tokenParts[0]);
        $tokenPayload = base64_decode($tokenParts[1]);
        $jwtHeader = json_decode($tokenHeader);
        $jwtPayload = json_decode($tokenPayload);

        return response()->json([$jwtPayload]);

    }
}
