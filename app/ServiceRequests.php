<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceRequests extends Model
{
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User', 'customer_id');
    }
}
