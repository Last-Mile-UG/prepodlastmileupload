<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLocation extends Model
{
    protected $table = "user_locations";
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
