<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'code' => ['required', 'min:6', 'max:8'],
            'value' => ['required'],
            'currency_id' => ['required_with:type'],
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'Поле обязательно к заполнению',
            'value.required' => 'Поле обязательно к заполнению',
            'code.min' => 'Поле должно содержать не менее 6 символов',
            'code.max' => 'Поле должно содержать не более 8 символов',
            'currency_id.required_with' => 'Вы забыли указать валюту',
        ];
    }
}
