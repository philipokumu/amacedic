<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RevisionInstruction extends Model
{
    protected $fillable = [
        'revisionInstructions', 'messageSender', 'order_id',
    ];
    
    public function order(){
        return $this->belongsTo(Order::class);
    }
}
