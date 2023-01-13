<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => ['required', 'email']
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Поле обязательное для заполнения.',
            'email.email' => 'Поле должно быть типом email.',
        ];
    }
}
