<?php

namespace App\Http\Requests\v1\Order;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'address' => 'required|string',
            'contact_no' => 'required|numeric|min_digits:11|max_digits:11',
            'coupon_code' => 'string|exists:coupons,coupon_code',
            'district_id' => 'required|exists:districts,id',
            'division_id' => 'required|exists:divisions,id',
            'delivery_charge' => 'required|numeric|in:60,120,100,80,0',
            'product' =>'required|array|min:1',
            'product.*.product_id'=>'required|string|exists:products,sku',
            'product.*.qty' => 'required|numeric',
            'note' => 'string',

        ];
    }
}
