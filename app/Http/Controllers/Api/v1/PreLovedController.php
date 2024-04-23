<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\PreLovedRequest;
use App\Models\v1\PreLoved;
use Illuminate\Http\Request;

class PreLovedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PreLovedRequest $request)
    {
        $data = $request->all();
        $data["user_id"] = auth()->user()->id;
        foreach ($request->file('image') as $gallery) {
            $paths[] = $gallery->store('images/pre_loved_product', 'public');
        }
        $data['image'] = $paths;
        $data['payout_account'] = json_decode($request->payout_account);


        $preLoved = PreLoved::create($data);

        foreach (json_decode($request->products) as $product) {
            $preLoved->pre_loved_products()->create(
                [
                    'product_name' => $product->product_name,
                    'buy_price' => $product->buy_price??null,
                    'used_status' => $product->used_status,
                    'condition' => $product->condition,
                    'sell_price' => $product->sell_price??null,
                    'buy_date' => $product->buy_date,
                ]
            );
        }

        return response()->json(['message' => 'Pre-loved product added successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(PreLoved $preLoved)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PreLoved $preLoved)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PreLoved $preLoved)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PreLoved $preLoved)
    {
        //
    }


    public function getMyPrelovedProducts()
    {
        $preLoveds = PreLoved::where('user_id', auth()->user()->id)->latest()->get();
        return response()->json($preLoveds->load('pre_loved_products'), 200);
    }
}
