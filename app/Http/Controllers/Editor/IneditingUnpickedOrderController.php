<?php

namespace App\Http\Controllers\Editor;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\GeneralTraits;

class ineditingUnpickedOrderController extends Controller
{
    use GeneralTraits;
    
    public function __construct()
    {
        $this->middleware('auth:editor');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->status=='active') {
            
            $ineditingUnpickedOrders = Order::where('status', 'inediting-unpicked')
                        ->orderBy('created_at','DESC')
                        ->select('id','title','noOfPages','status','currency','editorAmount','writerEndDate','user_id','isUrgent')
                        ->paginate(10);
    
        } else {
                
            $ineditingUnpickedOrders = collect();
            
        }

        return view('editor.order.ineditingunpicked.index', compact('ineditingUnpickedOrders'));
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
        if ($order->status == 'inediting-unpicked' && auth()->user()->status=='active') {

            /*first call deadlines from general traits */
            $deadline = $this->setDeadline($order)[0];
            $writerDeadline = $this->setDeadline($order)[1];
            
            $ineditingUnpickedOrder = $order;

            return view('editor.order.ineditingunpicked.show', compact('ineditingUnpickedOrder','deadline','writerDeadline'));

        } else

            return redirect(route('editor.ineditingunpicked.index'));
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
        if ($order->status == 'inediting-unpicked' && auth()->user()->status=='active') {
        
            $order->update(['editor_id'=>auth()->id(), 'status'=> 'inediting']);

            return redirect(route('editor.inediting.show',$order))->with('success', 'Congratulations, You can edit the order');
    
        }

        else return redirect(route('editor.ineditingunpicked.index'))->with('info', 'The order has already been picked by another editor');
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
