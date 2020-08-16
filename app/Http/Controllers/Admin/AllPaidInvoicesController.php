<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use App\Invoice;
use App\AdminCoin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AllPaidInvoicesController extends Controller
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
        $paidInvoices = Invoice::where(['status'=>'paid'])
            ->orderBy('created_at','DESC')
            ->select('id','amount','updated_at','invoicer','invoicer_id')
            ->paginate(10);

        $totalPaidAmount = number_format((float)$paidInvoices->sum('amount'),2, '.', '');

        return view('admin.order.invoices.allinvoices.paid.index', compact('paidInvoices','totalPaidAmount')); 
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
        if ($invoice->status == 'paid') {

            if($invoice->invoicer=='writer') {
            
                $paidOrders = Order::where(['status'=> 'approved','writerInvoice_id'=>$invoice->id])
                    ->orderBy('created_at','DESC')  
                    ->select('id','writerAmount','approved_at','noOfPages')->paginate(10);

                $totalPaidAmount = number_format((float)$paidOrders->sum('writerAmount'),2, '.', '');

            }

            elseif ($invoice->invoicer=='editor') {
            
                $paidOrders = Order::where(['status'=> 'approved','editorInvoice_id'=>$invoice->id])
                    ->orderBy('created_at','DESC')  
                    ->select('id','editorAmount','approved_at','noOfPages')->paginate(10);

                $totalPaidAmount = number_format((float)$paidOrders->sum('editorAmount'),2, '.', '');

            }

            elseif($invoice->invoicer=='adminexpenses') {
            
                $paidOrders = Order::where(['status'=> 'approved','expensesInvoice_id'=>$invoice->id])
                    ->orderBy('created_at','DESC')
                    ->select('id','expensesAmount','approved_at','noOfPages')->paginate(10);
    
                $totalPaidAmount = number_format((float)$paidOrders->sum('expensesAmount'),2, '.', '');
    
            }
            
            elseif ($invoice->invoicer=='admin') {
            
                $paidOrders = AdminCoin::where(['adminInvoice_id'=>$invoice->id])
                    ->orderBy('created_at','DESC')  
                    ->select('id','order_id','amount')->paginate(10);

                $totalPaidAmount = number_format((float)$paidOrders->sum('amount'),2, '.', '');
    
            }
        }

        else {

            return back()->with('info','invalid Invoice number');
        }

        return view('admin.order.invoices.allinvoices.paid.show', compact('paidOrders',
                    'invoice','totalPaidAmount')); 
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
