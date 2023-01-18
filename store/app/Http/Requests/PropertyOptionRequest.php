<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyOptionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'    => ['required'],
            'name_en' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required'    => 'Поле обязательное к заполнению!',
            'name_en.required' => 'Поле обязательное к заполнению!',
        ];
    }
}
