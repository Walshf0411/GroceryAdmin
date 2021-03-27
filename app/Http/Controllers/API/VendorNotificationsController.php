<?php

namespace App\Http\Controllers\API;

use App\Model\Vendor;
use Illuminate\Http\Request;

class VendorNotificationsController extends NotificationsController {

    public function getUserObjectFromId($userId) {
        return Vendor::findOrFail($userId);
    }
}
