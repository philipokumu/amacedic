<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdjustWriterAmountController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
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
        $adjustWriterAmount = $request->validate([
            'origWriterAmount'=>'present',
            'writerAmount'=>'required|lte:origWriterAmount'
        ]);
        
        $order->update(['writerAmount'=>$request->writerAmount]);

        return back()->with('success','Writer amount adjusted');
    }

}
