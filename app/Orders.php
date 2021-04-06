<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Orders extends Model
{
   public $timestamps = true;

   public function details(){
      return $this->hasMany('App\OrderDetail', 'order_id');
   }

   public function user(){
     return $this->belongsTo('App\User', 'user_id');
   }
   public function transaction()
   {
      return $this->hasMany('App\Transaction','order_id','id');
   }
   public function productSubscribe()
   {
      return $this->hasMany('App\ProductSubscriptionRequest','order_id','id');
   }
   public function getCreatedAtAttribute($value)
    {
      // $a = Carbon::parse($value)->format('h:i A');
      return date(config('app.date_format'), strtotime($value));
      
        
    }
   //  public function getCreatedAtAttribute($value)
   //  {
   //  }
}
