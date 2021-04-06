<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorCategory extends Model
{
    protected $table = 'vendor_category';

    public function vendors()
    {
        return $this->belongsToMany('App\User');
    }
    public function getImageAttribute($value){
        return asset('uploads/category/'.$value);
    }
}
