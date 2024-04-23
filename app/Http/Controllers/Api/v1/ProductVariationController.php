<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\Product\ColourResource;
use App\Models\v1\ProductVariation;
use Illuminate\Http\Request;

class ProductVariationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProductVariation::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        ProductVariation::create($request->all());
        return [
            "message" => 'variation created successful'
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductVariation $productVariation)
    {
        return $productVariation->load('product');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductVariation $productVariation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductVariation $productVariation)
    {
        //
    }

    public function color(){
        return ColourResource::collection( ProductVariation::where('attribute','Color')->get());
    }
}
