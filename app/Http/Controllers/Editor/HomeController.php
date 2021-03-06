<?php

namespace App\Http\Controllers\Editor;

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
        $this->middleware('auth:editor');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalOrders = count(Order::where('editor_id',auth()->id())->get());

        $approvedOrders = Order::where(['editor_id'=>auth()->id(),'status'=>'approved','editorInvoice_id'=>NULL])->select('editorAmount')->get();
        $approvedOrdersCount = count($approvedOrders);

        $cancelledOrders = count(Order::where(['editor_id'=>auth()->id(),'status'=>'cancelled'])->get());

        $completedOrders = count(Order::where(['editor_id'=>auth()->id(),'status'=>'completed'])->get());

        $messagesCount = count((Message::where('hasClientRead','no')->whereIn('order_id', Order::where('editor_id',auth()->id())->get('id')))->get());

        $ongoingOrders = Order::where('editor_id',auth()->id())->whereNotIn('status',['approved','cancelled'])->get();
        $ongoingOrdersCount = count($ongoingOrders);

        $approvedBalance = number_format((float)$approvedOrders->sum('editorAmount'),2, '.', '');

        $ongoingBalance = number_format((float)$ongoingOrders->sum('editorAmount'),2, '.', '');

        return view('editor.home',compact('totalOrders','ongoingBalance','ongoingOrdersCount','approvedOrdersCount','cancelledOrders',
                                        'completedOrders','messagesCount','approvedBalance'));
    }
}
