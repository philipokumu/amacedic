<?php

namespace App\Traits;
use App\Message;
use Carbon\Carbon;

trait WriterTraits
{

    public function writerMessages($order) {

        return Message::where(['order_id'=>$order->id])
                ->where(function ($query) {
                    $query->where('messageSender','writer')
                        ->orWhere('recipient', '=', 'writer');
                })->get();
    }

    // public function extension($order)
    // {
    //     $extension = collect();
    //     for ($i = 4; $i <= 20; $i+=4) {
    //         $writerTime = Carbon::parse($order->writerEndDate)->addHours($i);
    //         $clientTime = Carbon::parse($order->endDate);
    //         $allowedExtension = $clientTime->diff($writerTime);
    //         if ($writerTime->lessThanOrEqualTo($clientTime)) {

    //             $extension = $extension->push($i);
    //         }
    //         else
    //             $extension = collect();
    //     }
    //      return $extension;
    // }

}