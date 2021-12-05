<?php

namespace App\Model;

class RiderLocation {

    public function __construct($location_latitude, $location_longitude) {
        $this->latitude = $location_latitude;
        $this->longitude = $location_longitude;
    }
}