<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\v1\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coupon $coupon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        //
    }

    public function verify(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'coupon_code' => 'required|string|exists:coupons,coupon_code',
            'sub_total' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                422
            );
        } else {
            $coupon =  Coupon::where('coupon_code', $request->coupon_code)->first();
            if (!empty($coupon) && Carbon::make($coupon->expired_at)->isFuture() && intval($request->sub_total) >= intval($coupon->min_spend) && ($coupon->used_by ==null || !in_array(Auth()->user()->id,json_decode($coupon->used_by)))) {
                if ($coupon->type == 'flat') {
                    return response()->json(
                        [
                            'discount_amount' => floatval($coupon->discount)
                        ],
                        200
                    );
                } else if ($coupon->type == 'percent') {
                    $discount = (floatval($request->sub_total) * floatval($coupon->discount_percent) / 100);
                    return response()->json(
                        [
                            'discount_amount' => floatval($discount)
                        ],
                        200
                    );
                }else{
                    return response()->json(
                        [
                            'discount_amount' => 20
                        ],
                        200
                    );
                }
            } else {
                return response()->json(
                    [
                        'message' => 'expired coupon'
                    ],
                    200
                );
            }
        }
    }
}
