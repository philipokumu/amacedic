<?php

namespace App\Http\Controllers\Editor;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\CompletedOrderEvent;
use App\Traits\GeneralTraits;
use App\Traits\EditorTraits;
use Auth;

class InrevisionOrderController extends Controller
{
    use GeneralTraits, EditorTraits;
    
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
        $inrevisionOrders = Order::where(['editor_id'=> Auth::id(), 'status'=> 'inrevision'])
                    ->orderBy('created_at','DESC')
                    ->select('id','title','noOfPages','status','currency','editorAmount','writerEndDate','user_id','isUrgent')
                    ->paginate(10);

        return view('editor.order.inrevision.index', compact('inrevisionOrders'));
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
            $writerDeadline = $this->setDeadline($order)[1];

            /* secondly call the messages from editor traits*/
            $messages = $this->editorMessages($order);
            
            /* thirdly call revisions from general traits*/
            $inrevisionInstructions = $this->showRevisions($order);

            $inrevisionOrder = $order;

            return view('editor.order.inrevision.show', compact('inrevisionOrder', 'inrevisionInstructions','messages','deadline','writerDeadline'));
            
        } else
        
            return redirect(route('editor.inrevision.index'));
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

        if ($order->status == 'inrevision') {

            $order->update(['status'=>'completed']);
    
            $userEmail = $order->user->email;
            $writerEmail = $order->writer->email;
    
            event(new CompletedOrderEvent($userEmail, $writerEmail));
    
            return redirect(route('editor.inrevision.index'))->with('success',  'Congratulations, Order is marked as complete');

        }

        else return redirect(route('editor.inediting.show',$order))->with('info', 'The writer has changed the order status to inediting. Edit and mark as completed from here');

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
