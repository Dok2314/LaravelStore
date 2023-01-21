<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SkuRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'count' => ['required', 'numeric', 'min:1'],
            'price' => ['required', 'numeric', 'min:0'],
        ];
    }

    public function messages()
    {
        return [
            'count.required' => 'Поле обязательно для заполнения!',
            'count.numeric' => 'Поле должно быть целочисленным!',
            'count.min' => 'Минимальное кол-во должно = 1!',
            'price.required' => 'Поле обязательно для заполнения!',
            'price.numeric' => 'Поле должно быть целочисленным!',
            'price.min' => 'Цена не может быть меньше 0!',
        ];
    }
}
