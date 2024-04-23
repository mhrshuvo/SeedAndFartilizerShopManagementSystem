<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Product\ProductStoreRequest;
use App\Http\Resources\v1\Product\ProductListResource;
use App\Http\Resources\v1\Product\ProductResource;
use App\Models\v1\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::latest()->where('active', 1)
            ->paginate(
                Request()->input('limit', 10)
            );
        // return  ProductResource::collection(
        //     $product
        // );
        return ProductListResource::collection($product);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        $input = $request->validated();
        $input['sku'] =  substr(Str::uuid(), 4, 8) . Carbon::now()->format('s');
        $input['slug'] = Str::lower(Str::slug($request->get('name'), '-'));
        $input['name'] = Str::title($input['name']);
        $product = Product::create($input);

        $product->categories()->sync(json_decode($request->categories, true));

        $product->image()->create([
            'original' => $request->file('original')->store('images/product', 'public'),
            'thumbnail' => $request->file('thumbnail')->store('images/product', 'public')
        ]);
        // foreach ($request->file('gallery') as $gallery) {
        //     $product->gallery()->create([
        //         'original' => $gallery->store('images/product', 'public'),
        //         // 'thumbnail' => $gallery->store('images/product', 'public')
        //     ]);
        // }
        $product->variation()->sync(json_decode($request->variation, true));
        return response()->json(['message' => 'product added successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return response()->json(
            ProductResource::make(
                $product->load(
                    [
                        'categories',
                        'image',
                        'gallery',
                        'variation',
                        'company'
                    ]
                )
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

    public function search()
    {
        $categories = Request()->input('category', '');
        $categorySlugs = explode(',', $categories);
        $colors =  Request()->input('color', '');
        $color = explode(',', $colors);
        $searchQuery = Request()->input('q');


        $product = Product::query()
            ->when(request()->has('category') && !empty($categorySlugs), function ($query) use ($categorySlugs) {
                $query->whereHas('categories', function ($sub_query) use ($categorySlugs) {
                    $sub_query->whereIn('slug', $categorySlugs);
                });
            })
            ->when(request()->has('color') && !empty($color), function ($query) use ($color) {

                $query->whereHas('variation', function ($sub_query) use ($color) {
                    $sub_query->whereIn('value', $color);
                });
            })
            ->when(request()->has('q'), function ($query) use ($searchQuery) {
                $query->whereLike(
                    ['sku', 'name', 'description'],
                    $searchQuery
                );
            })
            ->when(request()->has('sort') && request()->get('sort') == 'LowToHigh', function ($query) {
                $query->orderBy('sell_price', 'asc');
            })
            ->when(request()->has('sort') && request()->get('sort') == 'HighToLow', function ($query) {
                $query->orderBy('sell_price', 'desc');
            })

            ->where('stock', '>', 0)
            ->where('active', 1)
            // ->inRandomOrder()
            ->latest()
            ->paginate(Request()->input('limit', 10))
            ->appends(request()->query());

        // return  ProductResource::collection($product);
        return ProductListResource::collection($product);
    }
}
