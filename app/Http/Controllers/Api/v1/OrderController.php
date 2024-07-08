<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Order\OrderRequest;
use App\Http\Resources\v1\Order\OrderResource;
use App\Jobs\SendInvoice;
use App\Models\v1\Coupon;
use App\Models\v1\Order;
use App\Models\v1\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return OrderResource::collection(Order::all()->load('order_products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        $input = $request->all();
        $input['tracking_id'] =  substr(Str::uuid(), 4, 9) . Carbon::now()->format('s');
        if (!empty(Auth()->user()->id)) {
            $input['user_id'] = Auth()->user()->id;
        }else{
            return response()->json(
                [
                    'message' => 'user not found',
                ],
                404
            );
        }
        $subTotal = 0;

        for ($i = 0; $i < count($request->{"product"}); $i++) {
            $subTotal += floatval(Product::where('sku', $request->{"product"}[$i]["product_id"])->get()->implode("sell_price")) * $request->{"product"}[$i]["qty"];
        }
        $input['sub_total'] = $subTotal;

        $coupon_discount = 0;

        if ($request->has('coupon_code')) {
            $coupon =  Coupon::where('coupon_code', $request->coupon_code)->first();
            if (!Carbon::make($coupon->expired_at)->isFuture() && intval($subTotal) >= intval($coupon->min_spend)) {
                $input['coupon_code'] = NULL;
            }
            if (!empty($coupon) && Carbon::make($coupon->expired_at)->isFuture() && intval($subTotal) >= intval($coupon->min_spend)) {
                if ($coupon->type == 'flat') {
                    $coupon_discount = floatval($coupon->discount);
                } else if ($coupon->type == 'percent') {
                    $discount = (floatval($subTotal) * floatval($coupon->discount_percent) / 100);
                    $coupon_discount = floatval($discount);
                } else {
                    $coupon_discount = 20;
                }


                if($coupon->used_by == null){
                    $coupon->used_by = [Auth()->user()->id];
                }
                else{
                    $coupon->used_by = array_merge(json_decode($coupon->used_by), [Auth()->user()->id]);
                }
                $coupon->update([
                    'used' => $coupon->used + 1,
                    'used_by' => $coupon->used_by
                ]);

            }
        }


        // return $input;
        $input['coupon_discount'] = $coupon_discount;
        $input['total_price'] = $subTotal - $coupon_discount + $input['delivery_charge'] + $input['vat'];
        $order = Order::create($input);

        for ($i = 0; $i < count($request->{"product"}); $i++) {
            $productDetails = Product::where('sku', $request->{"product"}[$i]["product_id"])->get();
            $size = $request->{"product"}[$i]["size"] ?? '';
            $color = $request->{"product"}[$i]["color"] ?? '';
            $order->order_products()->create(
                [
                    'product_id' =>  $productDetails->implode("id"),
                    'product_name' =>  $productDetails->implode('name') . " - " . $color . ", " . $size,
                    'size' => $size,
                    'color' => $color,
                    'price' =>  $productDetails->implode("sell_price"),
                    'qty' => $request->{"product"}[$i]["qty"]
                ]
            );
            $productDetails->first()->update([
                'stock' => $productDetails->first()->stock - $request->{"product"}[$i]["qty"]
            ]);
            if($request->{"product"}[$i]["size"] != null){


                $productDetails->first()->variation()->where('value', $request->{"product"}[$i]["size"])->update([
                    'quantity' => $productDetails->first()->variation()->where('value', $request->{"product"}[$i]["size"])->first()->pivot->quantity - $request->{"product"}[$i]["qty"]
                ]);
            }

        }

        // $url = 'http://bulksmsbd.net/api/smsapi?api_key=r8YHEDHLddKtxsLlziw1&type=text&number=' . $input['contact_no'] . '&senderid=8809617615316&message=' . 'Your order ' . $input['tracking_id'] . " is received. We'll confirm after a call. For assistance, call 01810098953. Thank you for shopping with KiPorbo";
        // if (!config('app.debug')) {
        //     Http::get($url);
        // }
        // if (!empty(Auth()->user()->email)) {
        //     dispatch(new SendInvoice(Auth()->user()->email, $order));
        // }
        return OrderResource::make($order->load('order_products'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return  OrderResource::make($order->load(
            "order_products"
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }

    public function invoice(Order $order)
    {

        return view('pdf', ['order' => $order->load(
            "order_products.product",
        )]);
    }
}
