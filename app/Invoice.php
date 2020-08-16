<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'invoicer_id','invoicer','status','amount',
    ];
    
    public function writer(){
        return $this->belongsTo(Writer::class,'invoicer_id');
    }

    public function editor(){
        return $this->belongsTo(Editor::class,'invoicer_id');
    }

    public function admin(){
        return $this->belongsTo(Admin::class,'invoicer_id');
    }
}
