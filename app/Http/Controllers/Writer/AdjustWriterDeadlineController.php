<?php

namespace App\Http\Controllers\Writer;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class AdjustWriterDeadlineController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:writer');
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
            'extensionHours'=>'required',
        ]);
        
        $writerEndDate = Carbon::parse($order->writerEndDate)->addHours($request->extensionHours);

        $order->update(['writerEndDate'=>$writerEndDate]);

        return back()->with('success','Writer deadline adjusted');
    }

}
