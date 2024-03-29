<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product2 extends Model
{
    protected $table = 'product2';

    //
    protected $fillable = [
    'vendor_id', 'name', 'description', 'price','unit','discount', 'images', 'created_at', 'updated_at'
    ];


    public function __set($key, $value)
    {
        $this->setAttribute($key, $value);
    }

    /**
     * Get the user that owns the Product2
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function orderDescriptions() {
        return $this->hasMany("App\Model\OrderDescription", "product_id");
    }
}
