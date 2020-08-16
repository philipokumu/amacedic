<?php

namespace App\Http\Controllers\User;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Events\ApprovedOrderEvent;
use App\Events\CancelledOrderEvent;
use App\Events\InrevisionOrderEvent;
use App\Traits\GeneralTraits;
use App\Traits\UserTraits;
use Carbon\Carbon;

class CompletedOrderController extends Controller
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
        $completedOrders = Order::where(['user_id'=> Auth::id(), 'status'=> 'completed'])
            ->orderBy('created_at','DESC')
            ->select('id','title','noOfPages','status','currency','totalPrice','writerEndDate','isUrgent')
            ->paginate(10);

        return view('users.order.completed.index', compact('completedOrders'));
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
    public function store(Request $request, Order $order)
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
        
        if ($order->status == 'completed') {

            
            /*first call deadlines from general traits */
            $deadline = $this->setDeadline($order)[0];

            /* secondly call the messages from user traits*/
            $messages = $this->userMessages($order);

            /* thirdly call revisions from general traits*/
            $inrevisionInstructions = $this->showRevisions($order);

            /* fourthly check if order time is minimal to give user power to provide revision timeline*/
            $OrderRemainingTime = (Carbon::now())->diffInHours(Carbon::parse($order->endDate),false);

            if ($OrderRemainingTime <= 3) {

                $needsTimer = 'yes';
            } else {

                $needsTimer = 'no';
            }
            
            /* fifthly check for history with writer*/
            $historyOrders = Order::where(['user_id'=>auth()->id(),'writer_id'=>$order->writer_id])
            ->orderBy('created_at','DESC')->get();

            $completedOrder = $order;
            
            return view('users.order.completed.show', compact('completedOrder','inrevisionInstructions'
                                                ,'messages','deadline','historyOrders','needsTimer'));
            
        } else
        
            return redirect(route('user.completed.index'));
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
            
            if($request->has('approve')) {
                
                $data = $request->validate([
                    'rating'=> 'required',
                    'ratingComment' => 'sometimes'
                    ]);

                    $this->payAdmins($order);
                    
                    $order->update(['status'=>'approved', 'rating'=> $data['rating'],
                        'ratingComment'=>$data['ratingComment'],'approved_at'=>Carbon::now()]);

                    event(new ApprovedOrderEvent($order));
                    
                    return redirect(route('user.completed.index'))->with('success', 'Thank you for trusting us. Feel free to make another order');
                }
            else if ($request->has('revision')) {
                    
                $data = $request->validate([
                    'revisionInstructions'=> 'required',
                    'revisionDuration'=> 'sometimes',
                    ]);

                $revisionInstruction = $this->createRevisionInstructions($request, $order);

                if ($request->has('revisionDuration')) {

                    /*start from here*/
                    
                    $order->update([
                        'status'=>'inrevision',
                        'endDate' => $this->deadlines($request->revisionDuration)[0],
                        'writerEndDate' => $this->deadlines($request->revisionDuration)[1],
                        'writerMaximumExtensionDate' => $this->deadlines($request->revisionDuration)[2],
                    ]);

                } else {

                    $order->update(['status'=>'inrevision']);
                    
                }

                event(new InrevisionOrderEvent($order, $revisionInstruction));
                
                return redirect(route('user.inrevision.index'))->with('success', 'The writer has been informed and will address your concerns');
            }

            else if ($request->has('cancel')) {

                $data = $request->validate([
                    'clientCancelReason' => 'required'
                    ]);

                $order->update(['status'=>'cancelled','clientCancelReason'=>$data['clientCancelReason']]);

                event(new CancelledOrderEvent($order));

                return redirect(route('user.cancelled.index'))->with('success', 'We will review your reasons first before refunding you back');
        
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
