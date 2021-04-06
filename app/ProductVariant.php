<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    public function product(){
        return $this->belongsTo('App\Products');
    }

    public function vendors(){
        return $this->belongsTo('App\User');
    }

    
   public function getImageAttribute($value){
        return asset('uploads/images/product/'. $value);
    }

    public function reviews(){
        return $this->hasMany('App\ProductVariantReviews', 'product_variant_id');
   }
}
