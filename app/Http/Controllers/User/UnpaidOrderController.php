<?php

namespace App\Http\Controllers\User;

use App\Order;
use App\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\GeneralTraits;
use App\Traits\UserTraits;
use App\Paypal\CreatePayment;

class UnpaidOrderController extends Controller
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
        $unpaidOrders = Order::where(['status'=> 'unpaid', 'user_id'=>auth()->id()])
                        ->orderBy('created_at','DESC')
                        ->select('id','title','noOfPages','status','currency','totalPrice')
                        ->paginate(10);

            return view('users.order.unpaid.index', compact('unpaidOrders'));
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

        if ($order->status == 'unpaid') {

        /* Firstly call the messages from user traits*/
        $messages = $this->userMessages($order);

        /* then use them to call show*/

            $unpaidOrder = $order;

            return view('users.order.unpaid.show', compact('unpaidOrder','messages'))
                    ->withInput(['tab' => 'messages']);

        } else

            return redirect(route('user.unpaid.index'));
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
        $newOrder = $order->toArray();

        session()->put('newOrder', $newOrder);

        $payment = new CreatePayment();

        return $payment->create();

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

        return redirect()->route('user.unpaid.index')->with('success','Order successfully deleted.');
    }
}
