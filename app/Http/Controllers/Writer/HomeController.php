<?php

namespace App\Http\Controllers\Writer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\Message;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:writer');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $totalOrders = count(Order::where('writer_id',auth()->id())->get());

        $approvedOrders = Order::where(['writer_id'=>auth()->id(),'status'=>'approved','writerInvoice_id'=>NULL])->select('writerAmount')->get();
        $approvedOrdersCount = count($approvedOrders);

        $cancelledOrders = count(Order::where(['writer_id'=>auth()->id(),'status'=>'cancelled'])->get());

        $completedOrders = count(Order::where(['writer_id'=>auth()->id(),'status'=>'completed'])->get());

        $messagesCount = count((Message::where('hasClientRead','no')->whereIn('order_id', Order::where('writer_id',auth()->id())->get('id')))->get());

        $ongoingOrders = Order::where('writer_id',auth()->id())->whereNotIn('status',['approved','cancelled'])->get();
        $ongoingOrdersCount = count($ongoingOrders);

        $approvedBalance = number_format((float)$approvedOrders->sum('writerAmount'),2, '.', '');

        $ongoingBalance = number_format((float)$ongoingOrders->sum('writerAmount'),2, '.', '');

        return view('writer.home',compact('totalOrders','ongoingBalance','ongoingOrdersCount','approvedOrdersCount','cancelledOrders',
                                        'completedOrders','messagesCount','approvedBalance'));
    }
}
