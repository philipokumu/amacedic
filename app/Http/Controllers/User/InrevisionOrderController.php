<?php

namespace App\Http\Controllers\User;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\GeneralTraits;
use App\Traits\UserTraits;
use Auth;

class InrevisionOrderController extends Controller
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
        $inrevisionOrders = Order::where(['user_id'=> Auth::id(), 'status'=> 'inrevision'])
                    ->orderBy('created_at','DESC')
                    ->select('id','title','noOfPages','status','currency','totalPrice','writerEndDate','isUrgent')
                    ->paginate(10);

        return view('users.order.inrevision.index', compact('inrevisionOrders'));
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
        
        if ($order->status == 'inrevision') {
            
            /*first call deadlines from general traits */
            $deadline = $this->setDeadline($order)[0];

            /* secondly call the messages from user traits*/
            $messages = $this->userMessages($order);

            /* thirdly call revisions from general traits*/
            $inrevisionInstructions = $this->showRevisions($order);

            /* History with writer*/
            $historyOrders = Order::where(['user_id'=>auth()->id(),'writer_id'=>$order->writer_id])
            ->orderBy('created_at','DESC')->get();

            $inrevisionOrder = $order;

            return view('users.order.inrevision.show', compact('inrevisionOrder', 'inrevisionInstructions','messages','deadline','historyOrders'));
            
        } else
        
            return redirect(route('user.inrevision.index'));
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
