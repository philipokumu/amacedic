<?php

namespace App\Http\Controllers\Writer;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\IneditingOrderEvent;
use App\Traits\GeneralTraits;
use App\Traits\WriterTraits;
use Carbon\Carbon;
use Carbon\CarbonInterval;

class InprogressOrderController extends Controller
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
        $inprogressOrders = Order::where(['status'=> 'inprogress', 'writer_id'=>auth()->id()])
                    ->orderBy('created_at','DESC')
                    ->select('id','title','noOfPages','status','currency','writerAmount','writerEndDate','user_id','isUrgent')
                    ->paginate(10);

            return view('writer.order.inprogress.index', compact('inprogressOrders'));
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
        $writerDeadline = $this->setDeadline($order)[1];

        /* secondly call the messages from writer traits*/
        $messages = $this->writerMessages($order);

        /* History with customer*/
        $historyOrders = Order::where(['writer_id'=>auth()->id(),'user_id'=>$order->user_id])
            ->orderBy('created_at','DESC')->get();

        /* writer calculated time extensions*/
        $writerExtensions = $this->extension($order);
        // dd($writerExtensions);

        /* then use them to call show*/

            $inprogressOrder = $order;

            return view('writer.order.inprogress.show', compact('inprogressOrder',
                                    'messages','writerDeadline','historyOrders','writerExtensions'));

        } else

            return redirect(route('writer.inprogress.index'));
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

        $order->update(['status'=>'inediting-unpicked']);

        event(new IneditingOrderEvent($order));

        return redirect(route('writer.inediting.index'))->with('success', 'Congratulations, Order is now in editing');
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

    public function extension($order)
    {

        $extension = collect();

        for ($i = 4; $i <= 20; $i+=4) {
            
            $writerTime = Carbon::parse($order->writerEndDate)->addHours($i);

            $writerMaximumTime = Carbon::parse($order->writerMaximumExtensionDate);

            $extension;
            
            if ($writerTime->lessThanOrEqualTo($writerMaximumTime)) {

                $extension = $extension->push($i);

            }
            else if ($writerTime->gt($writerMaximumTime)){

                if ($extension->isNotEmpty()) {

                    $extension;
                }

                else {
                    $extension = collect();
                }
            }
            else {
                $extension = collect();
            }

        }
        return $extension;
    }
}
