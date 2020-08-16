<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{

    protected $fillable = [
        'couponCode', 'couponName', 'type', 'percent_off', 'page_off', 'user_id',
        'expires_at','couponDuration','description','isUsed','starts_at','ends_at',
        'orderBasedCouponValue',
    ];

    public static function findByCoupon($coupon) {
        return self::where('couponCode', $coupon)->first();
    }

    public function value(){
        if ($this->type=='percent') {
            return $this->percent_off;
        }
        else if ($this->type=='page') {
            return $this->page_off;
        }
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function orders(){
        return $this->hasMany(Order::class,'coupon','couponCode');
    }
}
