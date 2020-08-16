<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'newsItem', 'recipient', 'admin_id', 'title'
    ];
    
    public function admin(){
        return $this->belongsTo(Admin::class);
    }
}
