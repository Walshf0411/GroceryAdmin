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
        'payment_id',
        'comment'
     ];

    public function customer() {
        return $this->belongsTo("App\Model\Customer", "customer_id");
    }

    public function products() {
        return $this->hasMany("App\Model\OrderDescription", "order_id");
    }
    public function deliveryboy() {
        return $this->hasOne("App\Model\DeliveryBoy", "rider_id");
    }
}
