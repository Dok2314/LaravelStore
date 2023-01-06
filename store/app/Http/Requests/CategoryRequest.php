<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        ];

        if($this->route()->named('categories.store')) {
            $rules['slug'] = ['required', 'unique:categories'];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required'        => 'Поле обязательно для заполнения!',
            'name.min'             => 'Поле должно содержать минимум 3 символа!',
            'name.max'             => 'Поле должно содержать максимум 255 символов!',
            'slug.required'        => 'Поле slug обязательно для заполнения!',
            'slug.unique'          => 'Данная категория уже существует!',
            'description.required' => 'Поле обязательно для заполнения!',
            'description.min'      => 'Поле должно содержать минимум 5 символа!',
            'description.max'      => 'Поле должно содержать максимум 500 символов!',
        ];
    }
}
