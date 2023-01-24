<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCouponRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'coupon' => ['required', 'min:6', 'max:8', 'exists:coupons,code'],
        ];
    }

    public function messages()
    {
        return [
            'coupon.required' => 'Поле обязательно для заполнения!',
            'coupon.min' => 'Купон должен содержать минимум 6 символов!',
            'coupon.max' => 'Купон должен содержать максимум 8 символов!',
            'coupon.exists' => 'Такого купона не существует!',
        ];
    }
}
