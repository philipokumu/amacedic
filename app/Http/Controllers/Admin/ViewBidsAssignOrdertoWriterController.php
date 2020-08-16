<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Events\AssignedOrderEvent;
use App\Events\ReassignedOrderEvent;
use App\Order;
use App\Bid;
use App\Writer;
use Illuminate\Http\Request;

class ViewBidsAssignOrdertoWriterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Order $order)
    {
        $writerIds = Bid::where('order_id', $order->id)->get('writer_id');
        $writers = Writer::whereIn('id',$writerIds)->where('status','active')->select('id','name')->get();
        $otherWriters = Writer::whereNotIn('id',$writerIds)->where('status','active')->select('id','name')->get();
        $orderBids = $order->id;
        $preferredWriter = $order->preferredWriter;
        $userId = $order->user_id;

        return view ('admin.order.bids.index',compact('writers','otherWriters',
                                    'orderBids','userId','preferredWriter')); 
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
        //
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
        if ($request->has('writer_id')){
            $writerId = $request->input('writer_id');
            
            if ($order->writer_id != NULL) {
                $oldWriterId = $order->writer_id;
                event(new ReassignedOrderEvent($order, $oldWriterId));
            }

            $order->update(['writer_id'=> $writerId, 'status'=>'assigned','writerAmount'=>$order->originalWriterAmount]);

            event(new AssignedOrderEvent($order));
            
            return redirect(route('admin.assigned.show', $order))->with('success', 'writer assigned');
        }
        else if ($request->has('status')){ 
            if ($order->writer_id != NULL) {
                $oldWriterId = $order->writer_id;
                event(new ReassignedOrderEvent($order, $oldWriterId));
            }
            $order->update(['writer_id'=> NULL, 'status'=>'unassigned','writerAmount'=>$order->originalWriterAmount]);

            return redirect(route('admin.unassigned.show', $order))->with('success', 'Order returned to bidding');
        }  

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
