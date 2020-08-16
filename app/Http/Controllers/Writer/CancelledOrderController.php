<?php

namespace App\Http\Controllers\Writer;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\GeneralTraits;
use App\Traits\WriterTraits;
use Auth;

class CancelledOrderController extends Controller
{
    use GeneralTraits, WriterTraits;
    
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
        $cancelledOrders = Order::where(['writer_id'=> Auth::id(), 'status'=> 'cancelled'])
                ->orderBy('created_at','DESC')
                ->select('id','title','noOfPages','status','currency','writerAmount','writerEndDate','user_id')
                ->paginate(10);

        return view('writer.order.cancelled.index', compact('cancelledOrders'));
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
        
        if ($order->status == 'cancelled') {

            /*first call deadlines from general traits */
            $writerDeadline = $this->setDeadline($order)[1];

            /* secondly call the messages from writer traits*/
            $messages = $this->writerMessages($order);

            /* thirdly call revisions from general traits*/
            $inrevisionInstructions = $this->showRevisions($order);

            /* History with customer*/
            $historyOrders = Order::where(['writer_id'=>auth()->id(),'user_id'=>$order->user_id])
            ->orderBy('created_at','DESC')->get();

            $cancelledOrder = $order;
            
            return view('writer.order.cancelled.show', compact('cancelledOrder','inrevisionInstructions','messages','writerDeadline','historyOrders'));
            
        } else
        
            return redirect(route('writer.cancelled.index'));
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
