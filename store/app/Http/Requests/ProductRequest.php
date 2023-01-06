<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'name'        => ['required', 'min:3', 'max:255'],
            'description' => ['required', 'min:5', 'max:500'],
            'price'       => ['required', 'numeric', 'min:1'],
            'category_id' => ['required'],
        ];

        if($this->route()->named('products.store')) {
            $rules['slug'] = ['required', 'unique:products'];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required'        => 'Поле обязательное для заполнения!',
            'name.min'             => 'Поле должно содержать не менее 3 символов!',
            'name.max'             => 'Поле должно содержать не более 255 символов!',
            'slug.required'        => 'Поле Slug обязательное для заполнения!',
            'slug.unique'          => 'Данный товар уже существует!',
            'description.required' => 'Поле обязательное для заполнения!',
            'description.min'      => 'Поле должно содержать не менее 5 символов!',
            'description.max'      => 'Поле должно содержать не более 500 символов!',
            'price.required'       => 'Поле обязательное для заполнения!',
            'price.numeric'        => 'Поле должно быть целочисленного типа!',
            'price.min'            => 'Значение поля должно быть не менее 1!',
            'category_id.required' => 'Поле обязательное для заполнения!',
        ];
    }
}
