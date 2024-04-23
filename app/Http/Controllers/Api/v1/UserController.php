<?php

namespace App\Http\Controllers\Api\v1;

use App\Filament\Resources\CouponResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\Order\OrderResource;
use App\Http\Resources\v1\User\CouponResource as UserCouponResource;
use App\Models\user;
use App\Models\v1\Coupon;
use Illuminate\Http\Request;

class UserController extends Controller
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
    public function show(user $user)
    {
        // return $user->orders()->with('order_products')->latest()->get();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, user $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(user $user)
    {
        //
    }

    public function myOrderHistory()
    {

        return OrderResource::collection(
            Auth()->user()
                ->orders()
                ->limit(10)
                ->latest()
                ->get()
        );
    }

    public function myCoupons()
    {
        return response()->json(

            UserCouponResource::collection(
                Coupon::where('owned_by', Auth()->user()->id)
                    
                    ->get()

            )

        );
    }
}
