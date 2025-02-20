<?php

namespace App\Http\Requests;

use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'gender' => ['required', 'string', 'in:male,female,other'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        var_dump($validator->errors()->first());exit(); //todo: разобраться как отдавать json вместо страницы
    }
}
