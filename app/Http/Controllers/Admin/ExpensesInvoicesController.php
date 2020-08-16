<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use App\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Auth;

class ExpensesInvoicesController extends Controller
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
        $approvedInvoiceOrders = Order::where(['status'=> 'approved','expensesInvoice_id'=>NULL])
            ->orderBy('created_at','DESC')      
            ->select('id','expensesAmount','approved_at')
            ->paginate(10);

        $totalApprovedAmount = number_format((float)$approvedInvoiceOrders->sum('expensesAmount'),2, '.', '');

        $requestedInvoices = Invoice::where(['invoicer'=> 'adminexpenses', 'status'=>'requested'])
            ->orderBy('created_at','DESC')    
            ->select('id','amount','created_at')
            ->paginate(10);
            
        $expenses = 1;

        $totalRequestedAmount = number_format((float)$requestedInvoices->sum('amount'),2, '.', '');

        $paidInvoices = Invoice::where(['invoicer'=> 'adminexpenses', 'status'=>'paid'])
            ->orderBy('created_at','DESC')    
            ->select('id','amount','updated_at')
            ->paginate(10);

        $totalPaidAmount = number_format((float)$paidInvoices->sum('amount'),2, '.', '');

        return view('admin.order.invoices.expensesinvoices.index', compact('approvedInvoiceOrders','requestedInvoices','paidInvoices',
                                                            'totalApprovedAmount','totalRequestedAmount','totalPaidAmount','expenses')); 
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
        $requestedOrders = Order::where(['status'=>'approved', 'expensesInvoice_id'=>NULL])
                ->orderBy('created_at','DESC')    
                ->select('id','expensesAmount','approved_at','noOfPages');
        
        $totalAmount = $requestedOrders->sum('expensesAmount');

        if ($totalAmount<6){
            
            return back()->with('info','Invoice amount cannot be less than Ksh. 1,000');
        }
        else
        
        $invoice = Invoice::create([
            'invoicer_id'=>auth()->id(),
            'invoicer'=> 'adminexpenses',
            'status'=>'requested',
            'amount'=>$totalAmount
            ]);
            
        $requestedOrders->update(['expensesInvoice_id'=>$invoice->id,'expensesAmountRequested_at'=>Carbon::now()]);

        return back()->with('success','Invoice generated, Confirm your payment details are correct')
                     ->withInput(['tab' => 'paymentdetails']);
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
            
            $requestedOrders = Order::where(['status'=> 'approved','expensesInvoice_id'=>$invoice->id])
                ->orderBy('created_at','DESC')    
                ->select('id','expensesAmount','approved_at','noOfPages')
                ->paginate(10);

            $totalRequestedAmount = number_format((float)$requestedOrders->sum('expensesAmount'),2, '.', '');

            return view('admin.order.invoices.expensesinvoices.requested.show', compact('requestedOrders','invoice','totalRequestedAmount')); 

        }
        else if ($invoice->status == 'paid') {

            $paidOrders = Order::where(['status'=> 'approved','expensesInvoice_id'=>$invoice->id])
                ->orderBy('created_at','DESC')    
                ->select('id','expensesAmount','approved_at','noOfPages')
                ->paginate(10); 
                
                $totalPaidAmount = number_format((float)$paidOrders->sum('expensesAmount'),2, '.', '');
                
        return view('admin.order.invoices.expensesinvoices.paid.show', compact('paidOrders','invoice','totalPaidAmount'));

        }

        else
            return back()->with('info','invalid Invoice number');
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
        //
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
