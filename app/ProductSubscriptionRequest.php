<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSubscriptionRequest extends Model
{
    public function product(){
        return $this->belongsTo('App\Products');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
   }
   public function orders()
   {
       return $this->belongsTo('App\Orders','order_id','id');
   }
}
