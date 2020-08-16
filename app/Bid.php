<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $fillable = [
        'order_id', 'writer_id'
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function writer(){
        return $this->belongsTo(Writer::class);
    }
}
