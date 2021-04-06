<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCard extends Model
{
    protected $table = 'user_card';
    
    public function user()
    {
        return $this->belongs('App\User');
    }
}
