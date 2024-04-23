<?php

namespace App\Http\Requests\v1\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'sell_price' => 'required|numeric',
            'stock' => 'required|numeric',
            'original' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            'thumbnail' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            'gallery' => 'required|array',
            'gallery.*' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            'variation.*.value' => 'required',
            // 'categories' => 'array',
        ];
    }
}
