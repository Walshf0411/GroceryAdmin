<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    protected $table = 'address';
    protected $fillable = [
        'customer_id' ,'address_line_1','address_line_2','city','state', 'pincode','address_type'
     ];

    public function getCompleteAddressAttribute() {
        return $this->address_line_1 . "\n"
                . $this->address_line_1 . "\n"
                . $this->city . ", " . $this->state . ", " . $this->pincode;
    }
}
