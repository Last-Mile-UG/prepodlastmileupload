<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class OrderHistory extends Model
{
    protected $table = 'order_history'; 

    // public function products()
    // {
    //     return $this->hasMany('App\Products','product_id','id');
    // }
    public function users()
    {
        return $this->belongsTo('App\User','vendor_id','id');
    }
    // public function getCreatedAtAttribute($value)
    // {
    //     return date(config('app.date_format'), strtotime($value));
    // }
    public function getImageAttribute($value){
        return asset('uploads/images/orderhistory/'. $value);
   }
public function getCreatedAtAttribute($value)
    {
      return Carbon::parse($value)->format('h:i A');
    }
}
