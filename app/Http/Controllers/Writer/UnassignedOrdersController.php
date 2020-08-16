<?php

namespace App\Http\Controllers\Writer;

use App\Http\Controllers\Controller;
use App\Order;
use App\Traits\GeneralTraits;
use Illuminate\Http\Request;

class UnassignedOrdersController extends Controller
{
    use GeneralTraits;
    
    public function __construct()
    {
        $this->middleware('auth:writer');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (auth()->user()->status=='active') {
            
            $orders = Order::where('status', 'unassigned')
                    ->orderBy('created_at','DESC')
                    ->select('id','title','noOfPages','status','currency','writerAmount','writerEndDate','user_id','isUrgent')
                    ->paginate(10);
    
        } else {

            $orders = collect();

        }
        
        return view('writer.order.unassigned.index',compact('orders'));
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
        if ($order->status == 'unassigned' && auth()->user()->status=='active') {

            /*first call deadlines from general traits */
            $writerDeadline = $this->setDeadline($order)[1];
    
            /* then use them to call show*/
    
            return view('writer.order.unassigned.show', compact('order','writerDeadline'));
            
        } else {

            return view('writer.order.unassigned.show');
            
        }


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

