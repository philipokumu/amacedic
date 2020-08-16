<?php

namespace App\Http\Controllers\Admin;

use App\Writer;
use App\Admin;
use App\Editor;
use App\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchInvoicesController extends Controller
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
        $writers = Writer::select('id','name','status')->paginate(10);
        $editors = Editor::select('id','name','status')->paginate(10);
        $admins = Admin::select('id','name','status')->paginate(10);

        $writers->map(function ($writer) { return $writer->role = 'writer';});
        $admins->map(function ($admin) { return $admin->role = 'admin';});
        $editors->map(function ($editor) { return $editor->role = 'editor';});

        return view('admin.order.invoices.searchinvoices.index', compact('writers','editors','admins'));
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
    public function show($role, $user)
    {

        if ($role=='admin') {
            
            $invoices = Invoice::where(['invoicer_id'=>$user])
                                ->where(function ($query) use ($role){
                                    $query->where('invoicer','adminexpenses')
                                        ->orWhere('invoicer', '=', $role);
                                        })->orderBy('created_at','DESC')->paginate(10);

        }    

        else {
            
            $invoices = Invoice::where(['invoicer'=>$role, 'invoicer_id'=>$user])
            ->orderBy('created_at','DESC')
            ->paginate(10);
        }

        return view('admin.order.invoices.searchinvoices.show', compact('invoices','role','user'));

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
