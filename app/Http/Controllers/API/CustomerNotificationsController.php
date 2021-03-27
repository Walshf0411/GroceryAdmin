<?php

namespace App\Http\Controllers\API;

use App\Model\Customer;
use Illuminate\Http\Request;

class CustomerNotificationsController extends NotificationsController {

    public function getUserObjectFromId($userId) {
        return Customer::findOrFail($userId);
    }
}
