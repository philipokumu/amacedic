<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class AdjustWriterDeadlineController extends Controller
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
        $adjustWriterDeadline = $request->validate([
            'endDate'=>'required|date',
            'writerEndDate'=>'required|date|before_or_equal:endDate'
        ]);
        
        $order->update(['writerEndDate'=>Carbon::parse($request->writerEndDate)]);

        return back()->with('success','Writer deadline adjusted');
    }

}
