<?php

namespace App\Http\Controllers\Writer;

use App\Http\Controllers\Controller;
use App\Bid;
use App\Order;
use Illuminate\Http\Request;
use Auth;

class MakeBidsController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:writer');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bids = Bid::where(['writer_id'=>auth()->id()])->pluck('order_id');

        $myBiddedOrders = Order::whereIn('id',$bids)
            ->orderBy('created_at','DESC')
            ->select('id','title','noOfPages','status','writerAmount','writerEndDate','user_id')
            ->paginate(20);

        return view('writer.order.bids.index',compact('myBiddedOrders'));
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
        if (auth()->user()->status == 'active') {
            
            Bid::create(['writer_id' => Auth::id(),'order_id' => $request->order_id]);
    
            return back()->with('success','You have made a bid for this order');
            
        } else {
            
            return back()->with('info','You cannot bid for this order');
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bid  $bid
     * @return \Illuminate\Http\Response
     */
    public function show(Bid $bid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bid  $bid
     * @return \Illuminate\Http\Response
     */
    public function edit(Bid $bid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bid  $bid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bid $bid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bid  $bid
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bid $bid)
    {
        $bid->delete();

        return back()->with('success','Bid successfully deleted.');
    }
}
