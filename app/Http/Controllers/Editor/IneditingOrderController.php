<?php

namespace App\Http\Controllers\Editor;

use App\Order;
use App\EditorToWriterNote;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Events\CompletedOrderEvent;
use App\Events\InrevisionOrderEvent;
use App\Traits\GeneralTraits;
use App\Traits\EditorTraits;

class IneditingOrderController extends Controller
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
            $ineditingOrders = Order::where(['status'=> 'inediting', 'editor_id'=>auth()->id()])
                        ->orderBy('created_at','DESC')
                        ->select('id','title','noOfPages','status','currency','editorAmount','writerEndDate','user_id','isUrgent')
                        ->paginate(10);

            return view('editor.order.inediting.index', compact('ineditingOrders')); 
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
            $deadline = $this->setDeadline($order)[0];
            $writerDeadline = $this->setDeadline($order)[1];

            /* secondly call the messages from editor traits*/
            $messages = $this->editorMessages($order);
            
            /* thirdly call revisions from general traits*/
            $inrevisionInstructions = $this->showRevisions($order);

            $ineditingOrder = $order;

            return view('editor.order.inediting.show', compact('ineditingOrder','inrevisionInstructions','messages','deadline','writerDeadline'));

        } else

            return redirect(route('editor.inediting.index'));
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

            if ($request->has('completed')) {

                if ($request->noteToWriter != NULL || $request->rating != NULL) {

                    $noteToWriter = $request->validate([
                        'rating'=>'required_with:noteToWriter',
                        'noteToWriter'=>'required_with:rating',
                    ]);

                    EditorToWriterNote::create([
                        'order_id'=>$order->id,
                        'writer_id'=>$order->writer_id,
                        'editor_id'=>$order->editor_id,
                        'noteToWriter'=>$request->noteToWriter,
                        'rating'=>$request->rating
                    ]);
                }

                $order->update(['status'=>'completed','completed_at'=>Carbon::now()]);
        
                event(new CompletedOrderEvent($order));
        
                return redirect(route('editor.completed.index'))->with('success', 'Congratulations, Order is marked as complete');
            }

            else if ($request->has('revision')) {
                $data = $request->validate([
                    'revisionInstructions'=> 'required',
                    ]);
                    
                $revisionInstruction = $this->createRevisionInstructions($request, $order);

                $order->update(['status'=>'inrevision']);
                        
                event(new InrevisionOrderEvent($order, $revisionInstruction));
                
                return redirect(route('editor.inediting.index'))->with('success', 'The writer has been informed and will address your concerns');
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
