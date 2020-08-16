<?php

namespace App\Traits;

use App\Message;
use App\RevisionInstruction;

trait EditorTraits
{

    public function editorMessages($order) {
        return Message::where(['order_id'=>$order->id])
                ->where(function ($query) {
                    $query->where('messageSender','editor')
                        ->orWhere('recipient', '=', 'editor');
                })->get();
    }

    public function createRevisionInstructions($request, $order) {
        return RevisionInstruction::create([
            'messageSender' => 'editor',
            'revisionInstructions' => $request->revisionInstructions,
            'order_id'=>$order->id
            ]);
    }
}