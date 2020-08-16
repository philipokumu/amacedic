<?php

namespace App\Traits;

use App\Message;

trait AdminTraits
{

    public function adminMessages($order) {

        return Message::where(['order_id'=>$order->id])->get();

    }

}