<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Category\CategoryStoreRequest;
use App\Http\Resources\v1\Category\CategoryListResource;
use App\Http\Resources\v1\Product\ProductListResource;
use App\Http\Resources\v1\Product\ProductResource;
use App\Models\v1\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CategoryListResource::collection(Category::where('is_active', 1)->inRandomOrder()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        $input = $request->validated();
        Category::create(
            [
                'title' => Str::title($input['title']),
                'slug' => Str::lower(Str::slug($input['title'], '-')),
                'icon' => $input['icon']->store('images/category', 'public'),
            ]
        );
        return Response(['message' => 'category added successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $product = $category->load(['products'])->products()->paginate(Request()->input('limit', 25));

        return ProductResource::collection($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }

}
