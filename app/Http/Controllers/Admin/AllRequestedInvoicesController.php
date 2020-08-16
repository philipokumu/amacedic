<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use App\Invoice;
use App\AdminCoin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AllRequestedInvoicesController extends Controller
{
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
        $requestedInvoices = Invoice::where(['status'=>'requested'])
            ->orderBy('created_at','DESC')  
            ->select('id','amount','created_at','invoicer','invoicer_id')
            ->paginate(10);

        $totalRequestedAmount = number_format((float)$requestedInvoices->sum('amount'),2, '.', '');

        return view('admin.order.invoices.allinvoices.requested.index', compact('requestedInvoices','totalRequestedAmount')); 
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
     * @param  \App\Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        if ($invoice->status == 'requested') {

            if($invoice->invoicer=='writer') {
            
                $requestedOrders = Order::where(['status'=> 'approved','writerInvoice_id'=>$invoice->id])
                        ->orderBy('created_at','DESC')      
                        ->select('id','writerAmount','approved_at','noOfPages')->paginate(10);

                $totalRequestedAmount = number_format((float)$requestedOrders->sum('writerAmount'),2, '.', '');

            }

            elseif ($invoice->invoicer=='editor') {
            
                $requestedOrders = Order::where(['status'=> 'approved','editorInvoice_id'=>$invoice->id])
                    ->orderBy('created_at','DESC')      
                    ->select('id','editorAmount','approved_at','noOfPages')->paginate(10);

                $totalRequestedAmount = number_format((float)$requestedOrders->sum('editorAmount'),2, '.', '');

            }

            elseif($invoice->invoicer=='adminexpenses') {
            
                $requestedOrders = Order::where(['status'=> 'approved','expensesInvoice_id'=>$invoice->id])
                            ->orderBy('created_at','DESC')      
                            ->select('id','expensesAmount','approved_at','noOfPages')->paginate(10);
    
                $totalRequestedAmount = number_format((float)$requestedOrders->sum('expensesAmount'),2, '.', '');
    
            }
            
            elseif ($invoice->invoicer=='admin') {
            
                $requestedOrders = AdminCoin::where(['adminInvoice_id'=>$invoice->id])
                            ->orderBy('created_at','DESC')  
                            ->select('id','order_id','amount')
                            ->paginate(10);

                $totalRequestedAmount = number_format((float)$requestedOrders->sum('amount'),2, '.', '');
                
            }
        }

        else {
            
            return back()->with('info','invalid Invoice number');
        }

        return view('admin.order.invoices.allinvoices.requested.show', compact('requestedOrders',
                    'invoice','totalRequestedAmount')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        $requestedInvoice = $invoice->update(['status'=>'paid']);

        return redirect(route('admin.allrequestedinvoices.index'))->with('success','Invoice marked as paid. Check in the paid invoice page');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
