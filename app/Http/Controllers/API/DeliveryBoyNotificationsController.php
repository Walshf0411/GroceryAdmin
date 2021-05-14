<?php

namespace App\Http\Controllers\API;

use App\Model\DeliveryBoy;
use Illuminate\Http\Request;

class DeliveryBoyNotificationsController extends NotificationsController {

    public function getUserObjectFromId($userId) {
        return DeliveryBoy::findOrFail($userId);
    }
}
