<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Delivery_cost extends Model
{
    //
    protected $table= 'delivery_costs';
    protected $fillable = ['delivery_charges'];
}
