<?php

namespace App\Service;

use App\Model\DeliveryBoy;

class RiderLocationService{ 

    public function getRiderLocation($riderId) {
        $rider = DeliveryBoy::findOrFail($riderId);

        return $rider->getLocation();
    }

    public function addOrUpdateRiderLocation($riderId, $riderLocation) {
        $rider = DeliveryBoy::findOrFail($riderId);

        $rider->updateLocation($riderLocation);
    }
}