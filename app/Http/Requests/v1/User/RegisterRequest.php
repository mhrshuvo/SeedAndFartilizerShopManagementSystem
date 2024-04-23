<?php

namespace App\Http\Requests\v1\User;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string',
            'email'=> 'required|email|unique:users',
            'phone_no'=>'required|numeric|min_digits:11|max_digits:11|unique:users',
            'password'=>'required|min:4',
            'avatar'=> 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            
        ];
    }
}
