<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFilterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [];

        if($this->price_from) {
            $rules['price_from'] = ['numeric', 'min:0'];
        }

        if($this->price_to) {
            $rules['price_to'] = ['numeric', 'min:0'];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'price_from.numeric'  => 'Поле "Цена от" должно быть целочисленным!',
            'price_from.min'      => 'Поле "Цена от" должно быть не менее 0!',
            'price_to.numeric'    => 'Поле "до" должно быть целочисленным!',
            'price_to.min'        => 'Поле "до" должно быть не менее 0!',
        ];
    }
}
