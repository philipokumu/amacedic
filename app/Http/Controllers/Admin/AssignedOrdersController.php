<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\GeneralTraits;


class AssignedOrdersController extends Controller
{
    use GeneralTraits;

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assignedOrders = Order::where(['status'=> 'assigned'])
        ->orderBy('created_at','DESC')
        ->select('id','title','noOfPages','status','currency','totalPrice','writer_id','writerEndDate','user_id','isUrgent') 
        ->paginate(20);

        return view('admin.order.assigned.index', compact('assignedOrders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $assignedOrder = $order;

        if ($order->status == 'assigned') {

        /*first call deadlines from general traits */
        $deadline = $this->setDeadline($order)[0];
        $writerDeadline = $this->setDeadline($order)[1];

        /* History of writer and client*/
        $historyOrders = Order::where(['user_id'=>$order->user_id,'writer_id'=>$order->writer_id])
        ->orderBy('created_at','DESC')->get();

        /* then use them to call show*/

        return view('admin.order.assigned.show', compact('assignedOrder','deadline','writerDeadline','historyOrders'));

        }

        else return redirect(route('admin.assigned.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
