<?php

namespace App\Http\Controllers\Writer;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class MyRatingsController extends Controller
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
        $myRatedOrders = Order::where(['writer_id'=>auth()->id(),'status'=>'approved'])
            ->orderBy('created_at','DESC')
            ->select('id','rating','ratingComment','approved_at')
            ->paginate(20);
        
        $avgRating = $myRatedOrders->avg('rating');

        return view('writer.myreviews.index',compact('myRatedOrders','avgRating'));
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
        Bid::create(['writer_id' => Auth::id(),'order_id' => $request->order_id]);

        return back()->with('success','You have made a bid for this order');
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
