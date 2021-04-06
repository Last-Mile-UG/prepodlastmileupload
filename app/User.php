<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Carbon\Carbon;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasApiTokens;

    protected $guard = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders(){
      return $this->hasMany('App\Orders');
    }
    public function ordershistory(){
      return $this->hasMany('App\OrderHistory','vendor_id','id');
    }

    public function detail(){
        return $this->hasOne('App\UserDetail','user_id','id');
   }

   public function locations(){
       return $this->hasMany('App\UserLocation','user_id','id');
   }
   public function cards(){
    return $this->hasMany('App\UserCard','user_id','id');
}

   public function deliveryOptions(){
        return $this->belongsToMany(DeliveryOption::class, 'delivery_option_user', 'user_id', 'delivery_option_id');
   }

   public function products(){
        return $this->hasMany('App\Products', 'vendor_id');
    }

    public function productvariant()
    {
        return $this->hasMany('App\ProductVariant', 'vendor_id');

    }
    public function orderDetails(){
        return $this->hasMany('App\OrderDetail', 'vendor_id');
    }

    public function serviceRequests(){
        return $this->hasMany('App\ServiceRequests', 'customer_id');
    }

    public function reviews(){
        return $this->hasMany('App\VendorReviews', 'vendor_id');
   }
   public function service()
   {
    return $this->hasMany('App\Service', 'vendor_id');
   }
   public function transactions()
   {
    return $this->hasMany('App\Transaction','user_id','id');
   }
   public function getCreatedAtAttribute($value)
   {
       return date(config('app.date_format'), strtotime($value));
   }
   public function banner()
   {
       return $this->hasMany('App\BannerImage','user_id','id');
   }
   public function vendorCategories()
   {
       return $this->belongsToMany('App\VendorCategory');
   }
}

