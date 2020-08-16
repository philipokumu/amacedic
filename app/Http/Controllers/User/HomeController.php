<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\Message;
use App\Coupon;
use App\Traits\UserTraits;

class HomeController extends Controller
{
    use UserTraits;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalOrders = count(Order::where('user_id',auth()->id())->get());

        $approvedOrders = count(Order::where(['user_id'=>auth()->id(),'status'=>'approved'])->get());

        $cancelledOrders = count(Order::where(['user_id'=>auth()->id(),'status'=>'cancelled'])->get());

        $completedOrders = count(Order::where(['user_id'=>auth()->id(),'status'=>'completed'])->get());

        $messagesCount = count((Message::where('hasClientRead','no')->whereIn('order_id', Order::where('user_id',auth()->id())->get('id')))->get());

        $coupons = $this->displayCoupons();

        $couponCount = count($coupons);
        
        $ongoingOrders = count(Order::where('user_id',auth()->id())->whereIn('status',['completed','inediting-unpicked','inediting','inprogress','inrevision'])->get());

        return view('users.home',compact('totalOrders','ongoingOrders','approvedOrders','cancelledOrders',
                                        'completedOrders','messagesCount','coupons','couponCount'));
    }
}
