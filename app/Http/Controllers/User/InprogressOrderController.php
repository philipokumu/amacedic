<?php

namespace App\Http\Controllers\User;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\GeneralTraits;
use App\Traits\UserTraits;

class InprogressOrderController extends Controller
{
    use GeneralTraits, UserTraits;

    public function __construct()
    {
        $this->middleware('auth:web');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inprogressOrders = Order::where(['status'=> 'inprogress', 'user_id'=>auth()->id()])
                        ->orderBy('created_at','DESC')
                        ->select('id','title','noOfPages','status','currency','totalPrice','writerEndDate','isUrgent')
                        ->paginate(10);

            return view('users.order.inprogress.index', compact('inprogressOrders'));
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

        if ($order->status == 'inprogress') {

        /*first call deadlines from general traits */
        $deadline = $this->setDeadline($order)[0];

        /* secondly call the messages from user traits*/
        $messages = $this->userMessages($order);

        /* History with writer*/
        $historyOrders = Order::where(['user_id'=>auth()->id(),'writer_id'=>$order->writer_id])
                        ->orderBy('created_at','DESC')->get();

        /* then use them to call show*/

            $inprogressOrder = $order;

            return view('users.order.inprogress.show', compact('inprogressOrder','deadline','messages','historyOrders'))
                    ->withInput(['tab' => 'messages']);

        } else

            return redirect(route('user.inprogress.index'));
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
