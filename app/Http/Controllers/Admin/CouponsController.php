<?php

namespace App\Http\Controllers\Admin;

use App\Coupon;
use App\Order;
use Carbon\Carbon;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Rules\DiscountRule;

class CouponsController extends Controller
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
        
        $coupons = Coupon::orderBy('created_at','DESC')->paginate(10);
        
        return view('admin.coupon.index',compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $lastCouponId = Coupon::orderBy('id', 'desc')->pluck('id')->first() + 1;
        $lastuserId = User::orderBy('id', 'desc')->pluck('id')->first() + 1;
        $codeSuffix = $lastuserId.$lastCouponId;

        $orderBasedCouponSelect = $this->orderBasedCouponSelect();

        return view('admin.coupon.create',compact('codeSuffix','orderBasedCouponSelect'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = tap($request->validate([
            'couponName'=>'required',
            'description'=>'required',
            'codePrefix'=>'required|max:6',
            'codeSuffix'=>'required',
            'type'=>'required',
            'discountValue'=>["required", new DiscountRule($request->get('type'))],
            'startDate'=>'required_with:endDate',
            'endDate'=>'required_with:startDate',
            
            ]), function () {
                if (request()->couponName == 'Order-based') {
                    request()->validate([
                        'orderNumber'=>'required'
                ]);
            }
        });

        if ($data['type']=='percent') {
            if (isset($data['startDate']) && isset($data['endDate']) && ($data['couponName']!='Order-based')) {
                Coupon::create([
                    'couponName'=>$data['couponName'],
                    'couponCode'=>$data['codePrefix'].$data['codeSuffix'],
                    'description'=>$data['description'],
                    'type'=>$data['type'],
                    'percent_off'=>$data['discountValue'],
                    'starts_at'=>(Carbon::parse($data['startDate']))->format('Y-m-d H:i:s'),
                    'ends_at'=>(Carbon::parse($data['endDate']))->format('Y-m-d H:i:s'),
                ]);

                return back()->with('success','Coupon generated succesfully');

            } else if (is_null($data['startDate']) && is_null($data['endDate']) && ($data['couponName']!='Order-based')){
                Coupon::create([
                    'couponName'=>$data['couponName'],
                    'couponCode'=>$data['codePrefix'].$data['codeSuffix'],
                    'description'=>$data['description'],
                    'type'=>$data['type'],
                    'percent_off'=>$data['discountValue'],
                ]);
                return back()->with('success','Coupon generated succesfully');

            } else if (isset($data['startDate']) && isset($data['endDate']) && ($data['couponName']=='Order-based')){
                Coupon::create([
                    'couponName'=>$data['couponName'],
                    'couponCode'=>$data['codePrefix'].$data['codeSuffix'],
                    'orderBasedCouponValue'=>$request->orderNumber,
                    'description'=>$data['description'],
                    'type'=>$data['type'],
                    'percent_off'=>$data['discountValue'],
                    'starts_at'=>(Carbon::parse($data['startDate']))->format('Y-m-d H:i:s'),
                    'ends_at'=>(Carbon::parse($data['endDate']))->format('Y-m-d H:i:s'),
                ]);
                return back()->with('success','Coupon generated succesfully');

            } else if (is_null($data['startDate']) && is_null($data['endDate']) && ($data['couponName']=='Order-based')){
                Coupon::create([
                    'couponName'=>$data['couponName'],
                    'couponCode'=>$data['codePrefix'].$data['codeSuffix'],
                    'orderBasedCouponValue'=>$request->orderNumber,
                    'description'=>$data['description'],
                    'type'=>$data['type'],
                    'percent_off'=>$data['discountValue'],
                ]);
                return back()->with('success','Coupon generated succesfully');
            }

        }
        else {
            if (isset($data['startDate']) && isset($data['endDate']) && ($data['couponName']!='Order-based')) {
                Coupon::create([
                    'couponName'=>$data['couponName'],
                    'couponCode'=>$data['codePrefix'].$data['codeSuffix'],
                    'description'=>$data['description'],
                    'type'=>$data['type'],
                    'page_off'=>$data['discountValue'],
                    'starts_at'=>(Carbon::parse($data['startDate']))->format('Y-m-d H:i:s'),
                    'ends_at'=>(Carbon::parse($data['endDate']))->format('Y-m-d H:i:s'),
                ]);

                return back()->with('success','Coupon generated succesfully');

            } else if (is_null($data['startDate']) && is_null($data['endDate']) && ($data['couponName']!='Order-based')){
                Coupon::create([
                    'couponName'=>$data['couponName'],
                    'couponCode'=>$data['codePrefix'].$data['codeSuffix'],
                    'description'=>$data['description'],
                    'type'=>$data['type'],
                    'page_off'=>$data['discountValue'],
                ]);
                return back()->with('success','Coupon generated succesfully');

            } else if (isset($data['startDate']) && isset($data['endDate']) && ($data['couponName']=='Order-based')){
                Coupon::create([
                    'couponName'=>$data['couponName'],
                    'couponCode'=>$data['codePrefix'].$data['codeSuffix'],
                    'orderBasedCouponValue'=>$request->orderNumber,
                    'description'=>$data['description'],
                    'type'=>$data['type'],
                    'page_off'=>$data['discountValue'],
                    'starts_at'=>(Carbon::parse($data['startDate']))->format('Y-m-d H:i:s'),
                    'ends_at'=>(Carbon::parse($data['endDate']))->format('Y-m-d H:i:s'),
                ]);
                return back()->with('success','Coupon generated succesfully');

            } else if (is_null($data['startDate']) && is_null($data['endDate']) && ($data['couponName']=='Order-based')){
                Coupon::create([
                    'couponName'=>$data['couponName'],
                    'couponCode'=>$data['codePrefix'].$data['codeSuffix'],
                    'orderBasedCouponValue'=>$request->orderNumber,
                    'description'=>$data['description'],
                    'type'=>$data['type'],
                    'page_off'=>$data['discountValue'],
                ]);
                return back()->with('success','Coupon generated succesfully');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        return view('admin.coupon.show',compact('coupon'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return back()->with('success','Coupon successfully deleted.');
    }

    public function orderBasedCouponSelect()
    {

        $orderBasedSelect = collect();
            
        $usedCoupons = Order::where('coupon','<>',NULL)->pluck('coupon');

        $qualifiedCoupons = Coupon::where('orderBasedCouponValue','<>',NULL)->whereIn('couponCode', $usedCoupons)->pluck('orderBasedCouponValue');
        $defaultCoupons = Coupon::where('orderBasedCouponValue','<>',NULL)->pluck('orderBasedCouponValue');
            
        if ($qualifiedCoupons->isNotEmpty()) {

            $maxValue = $qualifiedCoupons->max();

        }else {
            
            $maxValue = $defaultCoupons->max();
        }

        for ($i = 1; $i <= 5; $i++) {

            $maxValue = $maxValue + 10;
            
            $orderBasedSelect = $orderBasedSelect->push($maxValue);

        }

        return $orderBasedSelect;
    }
}