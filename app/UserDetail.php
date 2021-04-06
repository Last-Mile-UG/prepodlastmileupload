<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UserDetail extends Model
{
    public function user(){
      return $this->belongsTo('App\User', 'user_id','id');
   }

   public function getImageAttribute($value){
      return asset('uploads/images/profile/'. $value);
   }

   public function getOpeningTimeAttribute($value)
   {
      if($value)
      {
         return Carbon::parse($value)->format('H:i');

      }
      else
      {
         return null;
      }
   }
   public function getClosingTimeAttribute($value)
   {
      if($value)
      {
         return Carbon::parse($value)->format('H:i');

      }
      else
      {
         return null;
      }
   }

}
