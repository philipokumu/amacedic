<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\Message;
use App\AdminCoin;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $unassignedOrders = count(Order::where('status','unassigned')->get());

        $approvedOrders = Order::where(['status'=>'approved','writerInvoice_id'=>NULL,'editorInvoice_id'=>NULL,'expensesInvoice_id'=>NULL])->select('totalPriceInKsh')->get();
        $approvedOrdersCount = count($approvedOrders);

        $cancelledOrders = count(Order::where(['status'=>'cancelled'])->get());

        $completedOrders = count(Order::where(['status'=>'completed'])->get());

        $messagesCount = count((Message::where('hasAdminRead','no'))->get());

        $myApprovedOrders = AdminCoin::where(['admin_id'=>auth()->id(),'adminInvoice_id'=>NULL])->select('amount')->get();

        $ongoingOrders = Order::whereNotIn('status',['approved','cancelled'])->select('totalPriceInKsh')->get();

        $writerAmount = Order::where(['status'=>'approved','writerInvoice_id'=>NULL])->get('writerAmount');
        $editorAmount = Order::where(['status'=>'approved','status'=>'approved','editorInvoice_id'=> NULL])->get('editorAmount');
        $expensesAmount = Order::where(['status'=>'approved','expensesInvoice_id'=>NULL])->get('expensesAmount');
        $adminAmount = AdminCoin::where(['adminInvoice_id'=>NULL])->get('amount');

        $allApprovedAmount = number_format((float)$writerAmount->sum('writerAmount'),2, '.', '') +
                        number_format((float)$editorAmount->sum('editorAmount'),2, '.', '') +
                        number_format((float)$expensesAmount->sum('expensesAmount'),2, '.', '') +
                        number_format((float)$adminAmount->sum('amount'),2, '.', '');

        $allOngoingAmount = number_format((float)$ongoingOrders->sum('totalPriceInKsh'),2, '.', '');

        $myApprovedBalance = number_format((float)$myApprovedOrders->sum('amount'),2, '.', '');

        return view('admin.home',compact('unassignedOrders','approvedOrders','approvedOrdersCount','cancelledOrders', 'myApprovedBalance',
                                'completedOrders','messagesCount','allApprovedAmount','allOngoingAmount'));
    }
}
