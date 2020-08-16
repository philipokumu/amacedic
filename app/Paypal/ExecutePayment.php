<?php

namespace App\Paypal;

use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Amount;
use App\Events\PaidOrderEvent;
use App\User;
use App\Coupon;
use App\Traits\GeneralTraits;
use App\Order;

class ExecutePayment extends Paypal
{
    use GeneralTraits;

    public function execute()
    {

        $newOrder = session()->get('newOrder');

        $order = Order::find($newOrder['id']);

        if ($order->status != 'unpaid') {

            return redirect(route('user.unassigned.index'))->with('info','Confirm that you are not double paying this order');

        } else {

            $paymentId = request('paymentId');
            $payment = Payment::get($paymentId, $this->apiContext);
    
            $execution = new PaymentExecution();
            $execution->setPayerId(request('PayerID'));
    
            try {
            
                $result = $payment->execute($execution, $this->apiContext);
                
            } catch (Exception $ex) {
                
                echo $ex->getCode();
                echo $ex->getData();
                exit(1);
    
            }
    
            if ($result->state=='approved') {
    
                event(new PaidOrderEvent($newOrder['id']));
    
                Order::find($newOrder['id'])->update([
                    'status'=>'unassigned',
                    'endDate' => $this->deadlines($newOrder['deadline'])[1],
                    'writerEndDate' => $this->deadlines($newOrder['deadline'])[2],
                    'writerMaximumExtensionDate' => $this->deadlines($newOrder['deadline'])[3],
                ]);
    
                /* Check if user referral links exist.*/
                if (isset($newOrder['referredBy']) && isset($newOrder['referralId'])) {
                    
                    $user = User::where([
                        'id'=>auth()->id(), //Check if this new user account exists
                        'referredBy'=> $newOrder['referredBy'], //Check if user was referred before account creation, not after
                        'isFirstOrderPaid'=>'no']) //Check if this is client's first order
                        ->where('id','<>',$newOrder['referredBy']) //Check client is not referring him/herself
                        ->first();
                        
                    if ($user) {
    
                    $auth = auth()->id();
                    $lastCouponId = Coupon::orderBy('id', 'desc')->pluck('id')->first() + 1;
    
                    Coupon::create([
                        'user_id'=>$newOrder['referredBy'],
                        'couponName'=>'referral',
                        'couponCode'=> 'REF'.$auth.$lastCouponId,
                        'type'=> 'percent',
                        'description'=> 'New referral',
                        'percent_off'=> 10,
                        ]);
                        
                    $user->update(['isFirstOrderPaid'=>'yes']);
    
                    $returnResponse = redirect(route('user.unassigned.show',$newOrder['id']))->with('success', 'Order generated successfully. Referral link was good')/*->header('Cache-Control','nocache')*/;
    
                    }
    
                    else {
    
                        $returnResponse = redirect(route('user.unassigned.show',$newOrder['id']))->with('success', 'Order generated successfully. The refferal link was not applicable')/*->header('Cache-Control','nocache')*/;
                    }
                } 
    
                else {
    
                    $returnResponse = redirect(route('user.unassigned.show',$newOrder['id']))->with('success', 'Order generated successfully')/*->header('Cache-Control','nocache')*/;
                } 
            
                return $returnResponse;

            } else {
        
                return $result->state;
            }
        }
    }
}