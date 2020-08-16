<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use App\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\GeneralTraits;
use App\Traits\AdminTraits;

class UnpaidOrderController extends Controller
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
        $unpaidOrders = Order::where(['status'=> 'unpaid'])
                        ->orderBy('created_at','DESC')
                        ->select('id','title','noOfPages','status','currency','totalPrice')
                        ->paginate(10);

            return view('admin.order.unpaid.index', compact('unpaidOrders'));
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
        if ($order->status == 'unpaid') {

            /* Firstly call the messages from admin traits*/
            $messages = $this->AdminMessages($order);

            /* then use them to call show*/

            $unpaidOrder = $order;

            return view('admin.order.unpaid.show', compact('unpaidOrder','messages'))
                    ->withInput(['tab' => 'messages']);

        } else

            return redirect(route('admin.unpaid.index'));
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
        Message::where(['order_id'=>$order->id])->delete();
        
        $order->delete();

        return redirect()->route('admin.unpaid.index')->with('success','Order successfully deleted.');
    }
}
