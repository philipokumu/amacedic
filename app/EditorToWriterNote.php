<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EditorToWriterNote extends Model
{
    protected $fillable = [
        'noteToWriter', 'editor_id', 'writer_id', 'order_id','hasWriterRead','hasAdminRead','rating'
    ];

    public function writer(){
        return $this->belongsTo(Writer::class);
    }

    public function editor(){
        return $this->belongsTo(Editor::class);
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
