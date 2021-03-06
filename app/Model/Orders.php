<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    //
    protected $table = 'orders';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'biginteger';

    public $timestamps = true;

    protected $fillable = [
        'customer_id' ,
        'address_id',
        'amount',
        'delivery_charges',
        'total_amount',
        'timeslot',
        'status' ,
        'rider_id',
        'mode_of_payment',
        'date_of_delivery',
        'payment_id'
     ];
}
