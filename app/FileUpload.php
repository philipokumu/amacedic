<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileUpload extends Model
{
    protected $fillable = [
        'filename','order_id','uploader_id','uploader','fileUuid',
    ];

    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }
}
