<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCouponRequest extends FormRequest
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
            'coupon_code' =>  [
                'required',
                Rule::unique('coupons')->ignore($this->id),
            ],
            'discount' => 'required',
            'max_usage' => 'required|min:1',
            'expiry' => 'required',
            'status' => 'required',
        ];
    }
}
