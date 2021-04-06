<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorReviews extends Model
{
    public function user(){
        return $this->belongsTo('App\User', 'vendor_id');
    }
}
