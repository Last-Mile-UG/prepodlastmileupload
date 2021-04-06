<?php

namespace App;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

use Illuminate\Database\Eloquent\Model;

 class Service extends Model // implements Searchable
{
   protected $table = 'services';

   public function vendors()
   {
    return $this->belongsTo('App\User', 'vendor_id');
   }

   public function products(){
      return $this->hasMany('App\Products', 'service', 'id');
   }

}
