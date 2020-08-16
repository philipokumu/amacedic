<?php

namespace App\Paypal;

use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\WebProfile;
use PayPal\Api\InputFields;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use App\Order;


class CreatePayment extends Paypal
{

    public function create()
    {

        $newOrder = session()->get('newOrder');

        $order = Order::find($newOrder['id']);

        if ($order->status != 'unpaid') {

            return redirect(route('user.unassigned.index'))->with('info','Confirm that you are not double paying this order');

        } else {

            $totalPrice = floatval($order->totalPrice);
            $currency = substr($order->currency,5);
            $client = auth()->id();
    
            $item1 = new Item();
            $item1->setName("Order #:".$order->id)
                ->setCurrency($currency)
                ->setQuantity(1)
                ->setSku("Client:".$client)
                ->setPrice($totalPrice);
    
            $itemList = new ItemList();
            $itemList->setItems(array($item1));
    
            $inputFields = new InputFields();
            $inputFields->setNoShipping(1);
    
            $webProfile = new WebProfile();
            $webProfile->setName('test'.uniqid())->setInputFields($inputFields);
            
            $amount = new Amount();
            $amount->setCurrency($currency)
                ->setTotal($order->totalPrice);
    
            $webProfileId = $webProfile->create($this->apiContext)->getId();
    
    
            $payment = new Payment();
            $payment->setIntent("sale")
                ->setPayer($this->Payer())
                ->setRedirectUrls($this->RedirectUrls())
                ->setTransactions(array($this->Transaction($itemList, $amount)));
    
            $payment->setExperienceProfileId($webProfileId);
    
            try {
    
                $payment->create($this->apiContext);
                
            } catch (Exception $ex) {
                
                exit(1);
            }
    
            $approvalUrl = $payment->getApprovalLink($order);
        
            return redirect($approvalUrl);
        }
    }
    
    protected function Payer() {

        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        return $payer;
    }

    protected function Transaction($itemList, $amount) {

        $transaction = new Transaction();
        $transaction->setAmount($amount)
                ->setItemList($itemList)
                ->setDescription("Payment description")
                ->setInvoiceNumber(uniqid());

        return $transaction;
    }

    protected function RedirectUrls() {

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(config('services.paypal.url.redirect'))
            ->setCancelUrl(config('services.paypal.url.cancel'));

        return $redirectUrls;
    }

}