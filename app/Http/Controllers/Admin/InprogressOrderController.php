<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\GeneralTraits;
use App\Traits\AdminTraits;
use Carbon\Carbon;

class InprogressOrderController extends Controller
{
    use GeneralTraits, AdminTraits;

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
        $inprogressOrders = Order::where(['status'=> 'inprogress'])
        ->orderBy('created_at','DESC')
        ->select('id','title','noOfPages','status','currency','totalPrice','writerEndDate','user_id','isUrgent')
        ->paginate(10);

            return view('admin.order.inprogress.index', compact('inprogressOrders'));
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
        
        if ($order->status == 'inprogress') {

            /*first call deadlines from general traits */
            $deadline = $this->setDeadline($order)[0];
            $writerDeadline = $this->setDeadline($order)[1];

            /* secondly call the messages from admin traits*/
            $messages = $this->adminMessages($order);

            /* History of writer and client*/
            $historyOrders = Order::where(['user_id'=>$order->user_id,'writer_id'=>$order->writer_id])
            ->orderBy('created_at','DESC')->get();

            /* then use them to call show*/

            // For adjusting writer deadline 
            $endDate = Carbon::parse($order->endDate)->format('m-d-y'); 
            $writerEndDate = Carbon::parse($order->writerEndDate)->format('m-d-y'); 

            $inprogressOrder = $order;

            return view('admin.order.inprogress.show', compact('inprogressOrder','deadline','writerDeadline',
                                        'messages','historyOrders','endDate','writerEndDate'));
        
        } else

            return redirect(route('admin.inprogress.index'));
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
