<?php

namespace App\Http\Controllers\Writer;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\InprogressOrderEvent;
use App\Events\UnassignedOrderEvent;
use App\Traits\GeneralTraits;
use Auth;

class AssignedOrderController extends Controller
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
            $assignedOrders = Order::where(['writer_id'=>auth()->id(),'status'=>'assigned'])
                    ->orderBy('created_at','DESC')
                    ->select('id','title','noOfPages','status','currency','writerAmount','writerEndDate','writer_id','user_id','isUrgent')
                    ->paginate(10);

            return view('writer.order.assigned.index', compact('assignedOrders'));
            
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
        
        $this->authorize('view', $order);
        
        if ($order->status == 'assigned') {

        /*first call deadlines from general traits */
        $deadline = $this->setDeadline($order)[0];
        $writerDeadline = $this->setDeadline($order)[1];

        /* History with customer*/
        $historyOrders = Order::where(['writer_id'=>auth()->id(),'user_id'=>$order->user_id])
            ->orderBy('created_at','DESC')->get();

        /* then use them to call show*/

            $assignedOrder = $order;
    
            return view('writer.order.assigned.show', compact('assignedOrder','writerDeadline','historyOrders'));
        }

        else return redirect(route('writer.assigned.index'));

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
        $this->authorize('update', $order);

        if ($request->has('accept')){
            $order->update(['status'=>'inprogress']);
            
            event(new InprogressOrderEvent($order));
            return redirect(route('writer.inprogress.show',$order))->with('success', 'Congratulations, start working on the order');

        }
        else if ($request->has('reject')){
            $order->update(['status'=>'unassigned']);

            event(new UnassignedOrderEvent($order));
            
            return redirect(route('writer.assigned.index'))->with('success', 'Order withdrawn');
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
