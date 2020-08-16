<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\CostPerPage;
use App\Invoice;
use App\AdminCoin;

class FinancesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $approvedOrders = Order::where(['status'=>'approved','writerInvoice_id'=>NULL,'editorInvoice_id'=>NULL,'expensesInvoice_id'=>NULL])->select('totalPriceInKsh')->get();
        $approvedOrdersCount = count($approvedOrders);

        $allPaidInvoices = Invoice::where(['status'=>'paid'])->get('amount');

        $ongoingOrders = Order::whereNotIn('status',['approved','cancelled'])->select('totalPriceInKsh')->get();

        $writerAmount = Order::where(['status'=>'approved','writerInvoice_id'=>NULL])->get('writerAmount');
        $editorAmount = Order::where(['status'=>'approved','status'=>'approved','editorInvoice_id'=> NULL])->get('editorAmount');
        $expensesAmount = Order::where(['status'=>'approved','expensesInvoice_id'=>NULL])->get('expensesAmount');
        $adminAmount = AdminCoin::where(['adminInvoice_id'=>NULL])->get('amount');

        $allApprovedAmount = number_format((float)$writerAmount->sum('writerAmount'),2, '.', '') +
                        number_format((float)$editorAmount->sum('editorAmount'),2, '.', '') +
                        number_format((float)$expensesAmount->sum('expensesAmount'),2, '.', '') +
                        number_format((float)$adminAmount->sum('amount'),2, '.', '');

        $allOngoingAmount = number_format((float)$ongoingOrders->sum('totalPriceInKsh'),2, '.', '');
        $allPaidAmount = number_format((float)$allPaidInvoices->sum('amount'),2, '.', '');

        $costPerPage = CostPerPage::first();

        return view('admin.order.invoices.allfinances.index',compact('allPaidAmount','allApprovedAmount','allOngoingAmount','costPerPage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CostPerPage  $CostPerPage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CostPerPage $cost)
    {
        if (auth()->id() != 1) {

            return back()->with('info','You are not supposed to edit this page. Talk to the super admin');

        } else {

            $dt = $request->validate([
                'writerPageCPP'=> 'required|numeric|max:5',
                'writerUrgentPageCPP'=> 'required|numeric|max:6',
                'writerPowerpointCPP'=> 'required|numeric|max:4',
                'writerUrgentPPTCPP'=> 'required|numeric|max:5',
                'editorPageCPP'=> 'required|numeric|max:1',
                'editorPowerpointCPP'=> 'required|numeric|max:1',
                'expensesPageCPP'=> 'required|numeric|max:1',
                'expensesPowerpointCPP'=> 'required|numeric|max:1',
            ]);
    
            $cost->update($request->all());
    
            return back()->with('success','Information updated');
        }
    }
}
