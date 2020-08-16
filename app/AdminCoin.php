<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminCoin extends Model
{
    protected $fillable = [
        'admin_id','amount','order_id','adminInvoice_id'
    ];

    public function admin(){
        return $this->belongsTo(Admin::class);
    }
    public function order(){
        return $this->belongsTo(Order::class);
    }
}
