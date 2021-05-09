<?php

namespace App\Service;

use App\Model\DeliveryBoy;

class DeliveryBoyService1 {

    public function getDeliveryBoyAvailability($riderId) {
        return DeliveryBoy::findOrFail($riderId)->is_available;
    }

    public function updateDeliveryBoy(int $riderId, $data) {
        DeliveryBoy::findOrFail($riderId)->update($data);
    }
}
