<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCheckoutRequest extends FormRequest
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
            'full_name' => 'required|min:3|max:40',
            'country' => 'required',
            'address' => 'required',
            'zip_code' => 'required',
            'phone' => 'required|min:8',
            'city' => 'required',
            'coupon' => 'sometimes',
            'state' => 'required',
            'radio' => 'required'
        ];
    }
}
