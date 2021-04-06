<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductVariantReviews extends Model
{
    public function productVarient(){
        return $this->belongsTo('App\ProductVariant', 'product_variant_id');
    }
}
