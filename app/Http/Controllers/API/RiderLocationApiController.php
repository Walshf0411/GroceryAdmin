<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Controller;
use App\Service\RiderLocationService;
use App\Model\RiderLocation;

class RiderLocationApiController extends Controller {

    public function __construct(RiderLocationService $riderLocationService){
        $this->riderLocationService = $riderLocationService;
    }

    public function getRiderLocation($riderId) {
        $riderLocation = $this->riderLocationService->getRiderLocation($riderId);

        return response()->json([
            "rider_location" => $riderLocation
        ]);
    }
    
    public function addOrUpdateRiderLocation(Request $request, $riderId) {
        $validator = Validator::make($request->all(), [
            "latitude" => "required|numeric",
            "longitude" => "required|numeric"
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $riderLocation = new RiderLocation($request->latitude, $request->longitude);
        $this->riderLocationService->addOrUpdateRiderLocation($riderId, $riderLocation);

        return response()->json([
            "status" => "Success",
            "message" => "Rider location update successfully"
        ]);
    }
}