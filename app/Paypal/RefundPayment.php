<?php

namespace App\Paypal;

use PayPal\Api\Amount;
use PayPal\Api\Refund;
use PayPal\Api\RefundRequest;
use PayPal\Api\Sale;

class RefundPayment extends Paypal
{

    // public function refund($order)
    // {

    //     $saleId = '9HU26752AP6982019';

    //     $totalPrice = floatval($order->totalPrice);
    //     $currency = substr($order->currency,5);

    //     $amt = new Amount();
    //     $amt->setCurrency($currency)
    //         ->setTotal($order->totalPrice);

    //     $refundRequest = new RefundRequest();
    //     $refundRequest->setAmount($amt);
        
    //     $sale = new Sale();
    //     $sale->setId($saleId);

    //     try {
        
    //         $refundedSale = $sale->refundSale($refundRequest, $this->apiContext);

    //         return $refundedSale;

    //     } catch (Exception $ex) {

    //         echo $ex->getCode();
    //         echo $ex->getData();

    //         exit(1);
    //     }
    // }
}