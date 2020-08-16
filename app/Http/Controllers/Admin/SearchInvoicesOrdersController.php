<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use App\Writer;
use App\Admin;
use App\Editor;
use App\Invoice;
use App\AdminCoin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Auth;

class SearchInvoicesOrdersController extends Controller
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
        //
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
    public function show($role, $user,Invoice $invoice)
    {

        if($invoice->invoicer=='adminexpenses') {

            $searchOrders = Order::where(['expensesInvoice_id'=>$invoice->id])
                ->orderBy('created_at','DESC')
                ->select('id','expensesAmount','noOfPages','approved_at')
                ->paginate(10);
            
            $totalAmount = number_format((float)$searchOrders->sum('expensesAmount'),2, '.', '');
        
        }

        else if($invoice->invoicer=='editor' && $invoice->invoicer==$role) {

            $searchOrders = Order::where(['editorInvoice_id'=>$invoice->id])
                ->orderBy('created_at','DESC')
                ->select('id','editorAmount','noOfPages','approved_at')
                ->paginate(10);

            $totalAmount = number_format((float)$searchOrders->sum('editorAmount'),2, '.', '');

        }

        else if($invoice->invoicer=='writer' && $invoice->invoicer==$role) {

            $searchOrders = Order::where(['writerInvoice_id'=>$invoice->id])
                ->orderBy('created_at','DESC')
                ->select('id','writerAmount','noOfPages','approved_at')
                ->paginate(10);

            $totalAmount = number_format((float)$searchOrders->sum('writerAmount'),2, '.', '');

        }

        else if($invoice->invoicer=='admin') {

            $searchOrders = AdminCoin::where(['adminInvoice_id'=>$invoice->id])
                ->orderBy('created_at','DESC')
                ->select('id','amount','order_id')
                ->paginate(10);

                $totalAmount = number_format((float)$searchOrders->sum('amount'),2, '.', '');
        }

        else {

            return back()->with('info','No such invoice exists!');

        }

        return view('admin.order.invoices.searchinvoices.searchorders.show', compact('invoice','searchOrders','totalAmount'));

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
