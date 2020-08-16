<?php

namespace App\Http\Controllers\Writer;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\GeneralTraits;
use App\Traits\WriterTraits;

class IneditingOrderController extends Controller
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
        $ineditingOrders = Order::where([
            'writer_id'=>auth()->id()])->whereIn('status', ['inediting','inediting-unpicked'])
                    ->orderBy('created_at','DESC')
                    ->select('id','title','noOfPages','status','currency','writerAmount','writerEndDate','user_id','isUrgent')
                    ->paginate(10);

        return view('writer.order.inediting.index', compact('ineditingOrders')); 
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
        
        if ($order->status == 'inediting') {

            /*first call deadlines from general traits */
            $writerDeadline = $this->setDeadline($order)[1];

            /* secondly call the messages from writer traits*/
            $messages = $this->writerMessages($order);
            
            /* thirdly call revisions from general traits*/
            $inrevisionInstructions = $this->showRevisions($order);

            /* History with customer*/
            $historyOrders = Order::where(['writer_id'=>auth()->id(),'user_id'=>$order->user_id])
            ->orderBy('created_at','DESC')->get();

            $ineditingOrder = $order;

            return view('writer.order.inediting.show', compact('ineditingOrder','inrevisionInstructions','messages','writerDeadline','historyOrders'));
          
        } else if ($order->status == 'inediting-unpicked') {

            /*first call deadlines from general traits */
            $writerDeadline = $this->setDeadline($order)[1];

            /* secondly call the messages from writer traits*/
            $messages = $this->writerMessages($order);

            $historyOrders = Order::where(['writer_id'=>auth()->id(),'user_id'=>$order->user_id])
            ->orderBy('created_at','DESC')->paginate(10);
            
            $ineditingOrder = $order;

            return view('writer.order.ineditingunpicked.show', compact('ineditingOrder','messages','writerDeadline','historyOrders'));

        } else

            return redirect(route('writer.inediting.index'));
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
