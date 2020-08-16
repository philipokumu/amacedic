<?php

namespace App\Http\Controllers\User;

use App\Coupon;
use Carbon\Carbon;
use App\Order;
use App\Traits\UserTraits;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CouponsController extends Controller
{
    use UserTraits;

    public function __construct()
    {
        $this->middleware('auth:web');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = $this->displayCoupons();

        return view('users.coupon.index',compact('coupons'));
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
        $data = Validator::make($request->all(), [
        'couponCode'=>'required',
    ]);

        if($data->fails()) {
            return response()->json(['errors'=>$data->errors()],422);
        }


        /*first check if its a used coupon */
        $usedCoupons = Order::where(['user_id'=>auth()->id()])->where('coupon','<>',NULL)->pluck('coupon')->toArray();

        if (in_array($request->couponCode, $usedCoupons)){
            return response()->json(['couponerror'=>'You have already used this coupon before'],422);
            
        }
        
        $coupon = Coupon::where('couponCode', $request->couponCode)
                ->where(function ($query) {
                $query->where('user_id',NULL)
                ->orWhere('user_id', '=', auth()->id());
                })->first();
                
            /*secondly check if coupon exists */
            
            if(!$coupon) {
                return response()->json(['couponerror'=>'Invalid coupon code'],422);
                
            }
            
            /*thirdly check if coupon has expired */
            
            if ($coupon['starts_at']!=NULL && $coupon['ends_at'] !=NULL) {
                $start = Carbon::parse($coupon['starts_at']);
                $end = Carbon::parse($coupon['ends_at']);
                
                if (Carbon::now()->isBetween($start,$end)==false) {
                    return response()->json(['couponerror'=>'Coupon not in use'],422);
                }
            }
            /*fourthly check if user qualifies for this coupon */
            $noOfThisUserOrders = Order::where(['user_id'=> auth()->id(),'status'=>'approved'])->count();

            if ($coupon->orderBasedCouponValue !=NULL) {
                if ($coupon->orderBasedCouponValue > $noOfThisUserOrders) {
                    return response()->json(['couponerror'=>'you are not qualified for this coupon'],422);
                }
            }

        $couponCode = $coupon->couponCode;
        $couponType = $coupon->type;
        $couponValue = $coupon->value();

        return response()->json([
            "couponCode"=> $couponCode,
            "couponType"=> $couponType,
            "couponValue"=> $couponValue,
            ], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        $this->authorize('view', $coupon);

        $usedCoupons = Order::where(['user_id'=>auth()->id()])->where('coupon','<>',NULL)->pluck('coupon')->toArray();

        if (in_array($coupon->couponCode, $usedCoupons)){

            return redirect(route('user.coupon.index'))->with('info','There is no such coupon here');
        }

        else 

            return view('users.coupon.show',compact('coupon'));
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
        //
    }
}
