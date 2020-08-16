<?php

namespace App\Traits;
use App\Message;
use App\RevisionInstruction;
use App\Order;
use App\Coupon;

trait UserTraits
{

    public function userMessages($order) {
    
        return Message::where(['order_id'=>$order->id])
                ->where(function ($query) {
                    $query->where('messageSender','client')
                        ->orWhere('recipient', '=', 'client');
                })->get();
    }

    public function createRevisionInstructions($request, $order) {
        return RevisionInstruction::create([
            'messageSender' => 'client',
            'revisionInstructions' => $request->revisionInstructions,
            'order_id'=>$order->id
            ]);

    }

    public function displayCoupons() {

        $usedCoupons = Order::where(['user_id'=>auth()->id()])->where('coupon','<>',NULL)->pluck('coupon');
        $noOfThisUserOrders = count(Order::where(['user_id'=> auth()->id()])->get());

        $coupons = Coupon::whereNotIn('couponCode',$usedCoupons)
                    ->where(function ($query) {
                        $query->where('user_id',NULL)
                        ->orWhere('user_id', '=', auth()->id());
                    })
                    ->where(function ($query) use ($noOfThisUserOrders){
                        $query->where('orderBasedCouponValue',NULL)
                        ->orWhere('orderBasedCouponValue', '<', $noOfThisUserOrders);
                    })
                    ->orderBy('created_at','DESC')
                    ->paginate(5);

        return $coupons;
    }
}