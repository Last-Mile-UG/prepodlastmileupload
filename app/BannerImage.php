<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BannerImage extends Model
{
    protected $table = 'banner_images';

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
    // public function getImageAttribute($value){
    //     return asset('uploads/banners'. $value);
    // }
    public function getImageAttribute($value){
        return asset('uploads/images/banners/'. $value);
   }
}
