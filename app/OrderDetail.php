<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    public function users()
    {
        return $this->belongsTo('App\User', 'vendor_id', 'id');
    }

    public function variant(){
        return $this->belongsTo('App\ProductVariant', 'product_variant_id', 'id');
    }
    public function orders(){
        return $this->belongsTo('App\Orders', 'order_id');
     }
}
