<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubjectArea extends Model
{
    protected $fillable = [
        'subjectArea','account_id','accountType',
    ];

    public function writer(){
        return $this->belongsTo(Writer::class);
    }

    public function editor(){
        return $this->belongsTo(Editor::class);
    }
}
