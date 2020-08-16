<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'message', 'messageSender', 'order_id', 'recipient','hasClientRead',
        'hasAdminRead','hasEditorRead','hasWriterRead'
    ];
    
    public function order(){
        return $this->belongsTo(Order::class);
    }
}
