<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use App\FileUpload;
use App\Message;
use App\User;
use App\Events\PaidOrderEvent;
use App\Traits\GeneralTraits;
use Illuminate\Http\Request;
use App\Rules\ZeroRule;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use App\Http\Controllers\Controller;
use session;
use Auth;

class UnassignedOrdersController extends Controller
{
    use GeneralTraits;

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
        $orders = Order::where('status', 'unassigned')
                ->orderBy('created_at','DESC')
                ->select('id','title','user_id','noOfPages','status','currency','totalPrice','writerEndDate','isUrgent')
                ->paginate(10);
        return view('admin.order.unassigned.index', compact('orders')); 

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($referredBy=null, $referralId=null)
    {
        return view('admin.order.unassigned.create');

    }

        /**
     * Confirm a newly created resource before storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function confirm(Request $request)

    {

        $newOrder = $request->validate([
            'academicLevel'=>'required',
            'typeOfPaper'=>'required',
            'subjectArea'=>'required',
            'title'=>'required|min:3',
            'paperInstructions'=>'required|min:3',
            'citation'=>'required',
            'spacing'=>'required',
            'powerpointSlides'=>'sometimes',
            'noOfPages'=> ["required", new ZeroRule($request->get('powerpointSlides'))],
            'sources'=>'sometimes',
            'deadline'=>'required',
            'coupon'=>'sometimes',
            'discount'=>'sometimes',
            'currency'=>'required',
            'totalPrice'=>'required|min:1',
            'fileUuid'=>'sometimes',
            'referredBy'=>'sometimes',
            'referralId'=>'sometimes',

        ]);

        /** start setting of payment amounts */
        $writerAmount = 5 * $newOrder['noOfPages'] + 3 * $newOrder['powerpointSlides'];
        $editorAmount = 1 * $newOrder['noOfPages'] + 1 * $newOrder['powerpointSlides'];
        $expensesAmount = 2;
        $balance = $this->payAmount() - ($writerAmount + $editorAmount + $expensesAmount);
        
        /** End setting of payment amounts */

            $newOrder = array_merge($newOrder, [
                'deadline' => $this->deadlines()[0], 
                'writerDeadline' => $this->deadlines()[1],
                'writerAmount' => $writerAmount, 
                'editorAmount' => $editorAmount,
                'expensesAmount' => $expensesAmount,
                'balance' => $balance,
                'visitor'=>request()->ip(),
                ]);

        session()->put('newOrder', $newOrder);

        return view('admin.order.unassigned.confirm',compact('newOrder'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newOrder = session()->get('newOrder');

        $order = Order::create(array_merge($newOrder, ['user_id' => Auth::id(),'unassigned_at'=>Carbon::now()]));

        FileUpload::where('fileUuid', $newOrder['fileUuid'])->update(['order_id'=>$order->id,'fileUuid'=> NULL]);

        event(new PaidOrderEvent());

        return redirect(route('admin.order.unassigned.show',$order))->with('success', 'Order generated')/*->header('Cache-Control','nocache')*/;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        if ($order->status == 'unassigned') {
            /*first call deadlines from general traits */
            $deadline = $this->setDeadline($order)[0];
            $writerDeadline = $this->setDeadline($order)[1];

            /* then use them to call show*/

            return view('admin.order.unassigned.show', compact('order','deadline','writerDeadline'));

        } else

        return redirect(route('admin.unassigned.index'));

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

