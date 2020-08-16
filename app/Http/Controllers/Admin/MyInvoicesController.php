<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use App\Invoice;
use App\AdminCoin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Auth;

class MyInvoicesController extends Controller
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
        $adminCoinInvoices = AdminCoin::where(['admin_id'=>auth()->id(),'adminInvoice_id'=>NULL])
            ->orderBy('created_at','DESC')
            ->select('id','order_id','amount')
            ->paginate(10);

        $totalAdminCoinAmount = number_format((float)$adminCoinInvoices->sum('amount'),2, '.', '');

        $requestedInvoices = Invoice::where(['invoicer_id'=>auth()->id(), 'invoicer'=> 'admin', 'status'=>'requested'])
            ->orderBy('created_at','DESC')
            ->select('id','amount','created_at')
            ->paginate(10);

        $totalRequestedAmount = number_format((float)$requestedInvoices->sum('amount'),2, '.', '');

        $paidInvoices = Invoice::where(['invoicer_id'=>auth()->id(), 'invoicer'=> 'admin', 'status'=>'paid'])
            ->orderBy('created_at','DESC')
            ->select('id','amount','updated_at')
            ->paginate(10);

        $totalPaidAmount = number_format((float)$paidInvoices->sum('amount'),2, '.', '');

        return view('admin.order.invoices.myinvoices.index', compact('adminCoinInvoices','requestedInvoices','paidInvoices',
                                                            'totalAdminCoinAmount','totalRequestedAmount','totalPaidAmount')); 
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
        $requestedAdminCoins = AdminCoin::where(['admin_id'=>auth()->id(),'adminInvoice_id'=>NULL])
        ->orderBy('created_at','DESC');
        
        $totalAmount = $requestedAdminCoins->sum('amount');

        if ($totalAmount<20){
            
            return back()->with('info','Your invoice amount cannot be less than Ksh. 2,000');
        }
        else
        
        $invoice = Invoice::create([
            'invoicer_id'=>auth()->id(),
            'invoicer'=> 'admin',
            'status'=>'requested',
            'amount'=>$totalAmount
            ]);
            
        $requestedAdminCoins->update(['adminInvoice_id'=>$invoice->id]);

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
        $this->authorize('view', $invoice);

        if ($invoice->status == 'requested') {
            
            $adminCoinInvoices = AdminCoin::where(['admin_id'=>auth()->id(),'adminInvoice_id'=>$invoice->id])
                ->orderBy('created_at','DESC')
                ->select('id','order_id','amount')
                ->paginate(10);

        $totalRequestedAmount = number_format((float)$adminCoinInvoices->sum('amount'),2, '.', '');

        return view('admin.order.invoices.myinvoices.requested.show', compact('adminCoinInvoices','invoice','totalRequestedAmount')); 

        }
        else if ($invoice->status == 'paid') {

            $adminCoinPaidInvoices = AdminCoin::where(['admin_id'=>auth()->id(),'adminInvoice_id'=>$invoice->id])
                ->orderBy('created_at','DESC')
                ->select('id','order_id','amount')
                ->paginate(10);
                
                $totalPaidAmount = number_format((float)$adminCoinPaidInvoices->sum('amount'),2, '.', '');
                
        return view('admin.order.invoices.myinvoices.paid.show', compact('adminCoinPaidInvoices','invoice','totalPaidAmount'));

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
