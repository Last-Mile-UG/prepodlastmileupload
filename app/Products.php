<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
   public function user(){
        return $this->belongsTo('App\User', 'vendor_id');
   }

   public function productSubscriptionRequest(){
       return $this->hasMany('App\ProductSubscriptionRequest');
   }
   
   public function reviews(){
       return $this->hasMany('App\ProductReviews', 'product_id');
   }

   public function getImageAttribute($value){
        return asset('uploads/images/product/'. $value);
   }

   public function variants(){
       return $this->hasMany('App\ProductVariant', 'product_id','id');
   }
   
   public function category(){
    return $this->belongsTo('App\Service', 'service', 'id');
    }
    // public function orderhistory(){
    //     return $this->belongsTo('App\OrderHistory','product_id','id');
    //     }
}