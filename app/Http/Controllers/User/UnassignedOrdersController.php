<?php

namespace App\Http\Controllers\User;

use App\Order;
use Carbon\Carbon;
use App\CostPerPage;
use App\FileUpload;
use App\Coupon;
use App\User;
use App\Writer;
use App\Admin;
use App\Events\PaidOrderEvent;
use App\Http\Controllers\Controller;
use App\Traits\GeneralTraits;
use Illuminate\Http\Request;
use App\Rules\ZeroRule;
use Carbon\CarbonInterval; 
use App\Paypal\CreatePayment;
use App\Paypal\ExecutePayment;
use session;
use Auth;

class UnassignedOrdersController extends Controller
{
    use GeneralTraits;
    
    public function __construct()
    {
        $this->middleware('auth:web')->except(['create']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $writerEmails = Admin::pluck('email');

        // foreach ($writerEmails as $email) {
        //     dd($email);
        // }

        $orders = Order::where(['user_id'=> Auth::id(),'status'=>'unassigned'])
                ->orderBy('created_at','DESC')
                ->select('id','title','noOfPages','status','currency','totalPrice','writerEndDate','isUrgent')
                ->paginate(10);

        return view('users.order.unassigned.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($referredBy=null, $referralId=null)
    {
        if ($referredBy && $referralId)  {

            $view = view('users.order.create',compact('referredBy','referralId'));
        }
        else {
            $view = view('users.order.create');
        }

        return $view;
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
            'preferredWriter_id'=>'sometimes',
            'coupon'=>'sometimes',
            'discount'=>'sometimes',
            'currency'=>'required',
            'totalPrice'=>'required|min:1',
            'fileUuid'=>'sometimes',
            'referredBy'=>'sometimes',
            'referralId'=>'sometimes', 
        ]);

        /*Start confirm that the total amount is not manipulated */
        $academicLevel = floatval(substr($request->academicLevel,0,3));
        $spacing = floatval(substr($request->spacing,0,3));
        $deadline = floatval(substr($request->deadline,0,4));
        $subjectArea = floatval(substr($request->subjectArea,0,3));
        $currency = floatval(substr($request->currency,0,4));
        $noOfPages = floatval($request->noOfPages);
        $powerpointSlides = floatval($request->powerpointSlides);

        $totalPagesPrice = $academicLevel * $spacing * $deadline * $noOfPages * $currency * $subjectArea;
        $totalPptPrice = $academicLevel * ($deadline - 8) * $powerpointSlides * $currency * $subjectArea;

        $serverPriceTotal = $totalPagesPrice + $totalPptPrice;

        $difference = intval($serverPriceTotal - $request->totalPrice);

        if ($difference >= -1 && $difference <= 1) {

            /** start setting of payment amounts */
            $costPerPage = CostPerPage::first();
            $editorAmount = ($costPerPage->editorPageCPP * $newOrder['noOfPages'] + $costPerPage->editorPowerpointCPP * $newOrder['powerpointSlides']) * 100;
            $expensesAmount = ($costPerPage->expensesPageCPP * $newOrder['noOfPages'] + $costPerPage->expensesPowerpointCPP * $newOrder['powerpointSlides']) * 100;
            
            /** End setting of payment amounts */

            /** Check if order is urgent */
            $OrderRemainingTime = ($this->deadlines($newOrder['deadline'])[2])->diffInHours(Carbon::now());

            if ($OrderRemainingTime <= 12) {

                $writerAmount = ($costPerPage->writerUrgentPageCPP * $newOrder['noOfPages'] + $costPerPage->writerUrgentPPTCPP * $newOrder['powerpointSlides']) * 100;

                $balance = $this->payAmount() - ($writerAmount + $editorAmount + $expensesAmount);

                $newOrder = array_merge($newOrder, [
                    'writerAmount' => $writerAmount, 
                    'originalWriterAmount' => $writerAmount, 
                    'editorAmount' => $editorAmount,
                    'expensesAmount' => $expensesAmount,
                    'balance' => $balance,
                    'totalPriceInKsh' => $this->payAmount(),
                    'visitor'=>request()->ip(),
                    'isUrgent'=>'yes'
                ]);
                
            } else {

                $writerAmount = ($costPerPage->writerPageCPP * $newOrder['noOfPages'] + $costPerPage->writerPowerpointCPP * $newOrder['powerpointSlides']) * 100;
                
                $balance = $this->payAmount() - ($writerAmount + $editorAmount + $expensesAmount);

                $newOrder = array_merge($newOrder, [
                    'writerAmount' => $writerAmount,
                    'originalWriterAmount' => $writerAmount,
                    'editorAmount' => $editorAmount,
                    'expensesAmount' => $expensesAmount,
                    'balance' => $balance,
                    'totalPriceInKsh' => $this->payAmount(),
                    'visitor'=>request()->ip(),
                ]);
            }

            session()->put('newOrder', $newOrder);

            return view('users.order.confirm',compact('newOrder'));

        } else {
            
            return back()->with('info','Please refill the form, the price computation was wrong');
            
        }
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
        
        $newOrder = array_merge($newOrder,['id' => $order->id]);

        session()->put('newOrder', $newOrder);
        
        FileUpload::where('fileUuid', $newOrder['fileUuid'])->update(['order_id'=>$order->id,'fileUuid'=> NULL]);

        $payment = new CreatePayment();

        return $payment->create();
    
    }    

    public function execute()
    {
        $payment = new ExecutePayment;

        return $payment->execute();  
             
    }

    public function cancel()
    {
        return 'cancelled';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {

        /*first call deadlines from general traits */
        $deadline = $this->setDeadline($order)[0];
        $writerDeadline = $this->setDeadline($order)[1];

        /* then use them to call show*/

        $this->authorize('view', $order);
        
        if ($order->status == 'unassigned') {

            return view('users.order.unassigned.show', compact('order','deadline'));
        }
        else 
            
            return redirect(route('user.unassigned.index'));

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

