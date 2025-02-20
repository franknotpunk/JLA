<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class RefreshRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'token' => ['required', 'string'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        var_dump($validator->errors()->first());exit(); //todo: разобраться как отдавать json вместо страницы
    }
}
