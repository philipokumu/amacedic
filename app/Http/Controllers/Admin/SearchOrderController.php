<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\GeneralTraits;
use App\Traits\AdminTraits;
use Carbon\Carbon;

class SearchOrderController extends Controller
{
    use GeneralTraits, AdminTraits;

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $allOrders = Order::when($request->order_id, function($query) use ($request){
            $query->where('id', 'like','%'.$request->order_id);
            })
            ->when($request->title, function($query) use ($request){
                $query->where('title', 'like', '%'.$request->title.'%');
            })
            ->when($request->client_id, function($query) use ($request){
                $query->where('user_id', 'like', '%'.$request->client_id.'%');
            })
            ->when($request->writer_id, function($query) use ($request){
                $query->where('writer_id', 'like', '%'.$request->writer_id.'%');
            })
            ->select('id','title','user_id','noOfPages','status','currency','totalPrice','writerEndDate','isUrgent')
            ->paginate(10);

            return view('admin.order.search.index', compact('allOrders'));
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
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
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
        //        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
